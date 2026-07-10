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

    public const WEBP_QUALITY = 78;

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
     * An image is considered optimized when its .webp sibling exists and is
     * at least as new as the source — replacing the source resets this.
     */
    public function isOptimized(string $path): bool
    {
        $webp = $path.'.webp';

        return is_file($webp) && filemtime($webp) >= filemtime($path);
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
