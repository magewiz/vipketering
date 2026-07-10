<?php

namespace App\Console\Commands;

use App\Support\ImageOptimizer;
use Illuminate\Console\Command;
use Symfony\Component\Finder\Finder;

class OptimizeImages extends Command
{
    protected $signature = 'images:optimize
        {--path= : Optimize only this directory instead of the default ones}
        {--force : Re-optimize files whose .webp sibling is already up to date}';

    protected $description = 'Downscale, recompress and generate WebP siblings for public/img and admin uploads';

    public function handle(ImageOptimizer $optimizer): int
    {
        $dirs = $this->option('path')
            ? [$this->option('path')]
            : array_filter([public_path('img'), storage_path('app/public/uploads')], 'is_dir');

        $before = $after = 0;
        $done = $skipped = 0;

        foreach (Finder::create()->files()->in($dirs)->name('/\.(jpe?g|png)$/i') as $file) {
            $path = $file->getRealPath();

            if (! $this->option('force') && $optimizer->isOptimized($path)) {
                $skipped++;

                continue;
            }

            $size = filesize($path);

            if (! $optimizer->optimize($path)) {
                $this->warn("skip (unreadable): {$file->getRelativePathname()}");

                continue;
            }

            clearstatcache(true, $path);
            $before += $size;
            $after += filesize($path);
            $done++;
            $this->line(sprintf('%s  %s → %s (+ .webp)',
                $file->getRelativePathname(),
                $this->kb($size),
                $this->kb(filesize($path)),
            ));
        }

        $this->info(sprintf('Optimized %d image(s), skipped %d already done. %s → %s',
            $done, $skipped, $this->kb($before), $this->kb($after)));

        return self::SUCCESS;
    }

    private function kb(int $bytes): string
    {
        return round($bytes / 1024).'KB';
    }
}
