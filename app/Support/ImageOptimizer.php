<?php

namespace App\Support;

use Imagick;
use Throwable;

/**
 * Shrinks site images for the web: downscales oversized files, re-encodes
 * them, strips metadata and writes a `<file>.webp` sibling that nginx serves
 * to browsers advertising WebP support. Used on every admin upload
 * (MediaController) and in bulk by the `images:optimize` command.
 */
class ImageOptimizer
{
    /** Longest allowed side; larger images are scaled down proportionally. */
    public const MAX_DIMENSION = 1920;

    public const JPEG_QUALITY = 80;

    public const WEBP_QUALITY = 68;

    /** Images at least this wide also get a mobile "@960" variant for srcset. */
    public const VARIANT_THRESHOLD = 1200;

    public const VARIANT_WIDTH = 960;

    /**
     * Mobile variants serve as full-viewport hero backgrounds under gradient
     * overlays, so they tolerate stronger compression than content images.
     */
    public const VARIANT_WEBP_QUALITY = 60;

    /**
     * Optimize a single image in place. Returns false for formats we leave
     * alone (webp/gif/avif/svg) or unreadable files.
     */
    public function optimize(string $path): bool
    {
        $ext = strtolower(pathinfo($path, PATHINFO_EXTENSION));

        if (! in_array($ext, ['jpg', 'jpeg', 'png'], true) || ! is_file($path)) {
            return false;
        }

        try {
            $image = new Imagick($path);

            $rotated = $this->bakeInOrientation($image);

            $resized = max($image->getImageWidth(), $image->getImageHeight()) > self::MAX_DIMENSION;
            if ($resized) {
                $image->resizeImage(self::MAX_DIMENSION, self::MAX_DIMENSION, Imagick::FILTER_LANCZOS, 1, true);
            }

            $image->stripImage();

            // WebP sibling first (from the freshly resized pixels), then the original format.
            $webp = clone $image;
            $webp->setImageFormat('webp');
            $webp->setImageCompressionQuality(self::WEBP_QUALITY);
            $webp->writeImage($path.'.webp');
            $webp->clear();

            // Only rewrite the source when its pixels changed — re-encoding an
            // already well-compressed file often makes it bigger. Untouched
            // files still shrink via the lossless pass (only-if-smaller).
            if ($resized || $rotated) {
                if ($ext !== 'png') {
                    $image->setImageCompressionQuality(self::JPEG_QUALITY);
                    $image->setInterlaceScheme(Imagick::INTERLACE_PLANE);
                }
                $image->writeImage($path);
            }

            $this->writeMobileVariant($image, $path, $ext);

            $image->clear();

            $this->losslessPass($path, $ext);

            // Mark as done for isOptimized(): the sibling must not be older than the source.
            touch($path.'.webp');

            return true;
        } catch (Throwable) {
            return false;
        }
    }

    /**
     * srcset value for an image URL path (e.g. "/img/hero-1.jpg"), offering
     * the "@960" mobile variant when it exists on disk. Null when there is
     * no variant — callers then simply omit the srcset attribute.
     */
    public static function srcset(?string $src): ?string
    {
        if (! $src || ! str_starts_with($src, '/')) {
            return null;
        }

        $variant = preg_replace('/\.(jpe?g|png)$/i', '@'.self::VARIANT_WIDTH.'.$1', $src);
        $file = public_path(ltrim($src, '/'));

        if ($variant === $src || ! is_file($file) || ! is_file(public_path(ltrim($variant, '/')))) {
            return null;
        }

        [$width] = getimagesize($file);

        return sprintf('%s %dw, %s %dw', $variant, self::VARIANT_WIDTH, $src, $width);
    }

    /**
     * An image is considered optimized when its .webp sibling exists and is
     * at least as new as the source — replacing the source resets this.
     */
    public function isOptimized(string $path): bool
    {
        $webp = $path.'.webp';

        return is_file($webp) && filemtime($webp) >= filemtime($path);
    }

    /** Downscaled copy for phones, offered to browsers via srcset (see srcset()). */
    private function writeMobileVariant(Imagick $image, string $path, string $ext): void
    {
        // Skip images that already are variants, and anything not clearly larger.
        if (str_contains(basename($path), '@'.self::VARIANT_WIDTH.'.')
            || $image->getImageWidth() < self::VARIANT_THRESHOLD) {
            return;
        }

        $variantPath = preg_replace('/\.(jpe?g|png)$/i', '@'.self::VARIANT_WIDTH.'.$1', $path);

        $variant = clone $image;
        $variant->resizeImage(self::VARIANT_WIDTH, 0, Imagick::FILTER_LANCZOS, 1);

        $webp = clone $variant;
        // Light denoise: photographic grain compresses terribly in WebP and
        // is invisible at mobile hero sizes under the gradient overlays.
        $webp->gaussianBlurImage(0, 0.6);
        $webp->setImageFormat('webp');
        $webp->setImageCompressionQuality(self::VARIANT_WEBP_QUALITY);
        $webp->writeImage($variantPath.'.webp');
        $webp->clear();

        if ($ext !== 'png') {
            $variant->setImageCompressionQuality(self::JPEG_QUALITY);
            $variant->setInterlaceScheme(Imagick::INTERLACE_PLANE);
        }
        $variant->writeImage($variantPath);
        $variant->clear();

        $this->losslessPass($variantPath, $ext);
        touch($variantPath.'.webp');
    }

    /**
     * Rotate pixels per EXIF orientation before metadata is stripped
     * (this Imagick build has no autoOrientImage()).
     */
    private function bakeInOrientation(Imagick $image): bool
    {
        $angle = match ($image->getImageOrientation()) {
            Imagick::ORIENTATION_BOTTOMRIGHT => 180,
            Imagick::ORIENTATION_RIGHTTOP => 90,
            Imagick::ORIENTATION_LEFTBOTTOM => -90,
            default => 0,
        };

        if ($angle !== 0) {
            $image->rotateImage('#000', $angle);
        }

        $image->setImageOrientation(Imagick::ORIENTATION_TOPLEFT);

        return $angle !== 0;
    }

    /** Extra lossless squeeze via jpegoptim/optipng when the binaries exist. */
    private function losslessPass(string $path, string $ext): void
    {
        if (! function_exists('exec')) {
            return;
        }

        $arg = escapeshellarg($path);

        if ($ext === 'png' && is_executable('/usr/bin/optipng')) {
            exec("/usr/bin/optipng -quiet -o2 $arg 2>/dev/null");
        } elseif (is_executable('/usr/bin/jpegoptim')) {
            // --max only re-encodes files saved above that quality, so this
            // shrinks near-lossless camera exports but never touches a file twice.
            exec('/usr/bin/jpegoptim --quiet --strip-all --all-progressive --max='.self::JPEG_QUALITY." $arg 2>/dev/null");
        }
    }
}
