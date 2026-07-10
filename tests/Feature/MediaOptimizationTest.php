<?php

namespace Tests\Feature;

use App\Models\User;
use App\Support\ImageOptimizer;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class MediaOptimizationTest extends TestCase
{
    use RefreshDatabase;

    public function test_uploaded_image_is_resized_and_gets_a_webp_sibling(): void
    {
        Storage::fake('public');
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post('/admin/media', [
            'file' => UploadedFile::fake()->image('big.jpg', 3000, 1600),
        ]);

        $response->assertOk()->assertJsonStructure(['src']);

        $src = $response->json('src');
        $relative = str_replace('/storage/', '', $src);
        Storage::disk('public')->assertExists($relative);

        $stored = Storage::disk('public')->path($relative);
        [$width] = getimagesize($stored);
        $this->assertLessThanOrEqual(ImageOptimizer::MAX_DIMENSION, $width);

        $this->assertFileExists($stored.'.webp');
    }

    public function test_small_upload_keeps_its_dimensions(): void
    {
        Storage::fake('public');
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post('/admin/media', [
            'file' => UploadedFile::fake()->image('small.jpg', 400, 300),
        ]);

        $stored = Storage::disk('public')->path(str_replace('/storage/', '', $response->json('src')));
        [$width, $height] = getimagesize($stored);
        $this->assertSame(400, $width);
        $this->assertSame(300, $height);
        $this->assertFileExists($stored.'.webp');
    }

    public function test_optimize_command_processes_a_directory_idempotently(): void
    {
        $dir = storage_path('framework/testing/img-'.uniqid());
        mkdir($dir, 0775, true);

        $img = imagecreatetruecolor(2500, 1000);
        imagejpeg($img, "$dir/wide.jpg", 95);
        imagedestroy($img);

        $this->artisan('images:optimize', ['--path' => $dir])->assertSuccessful();

        [$width] = getimagesize("$dir/wide.jpg");
        $this->assertLessThanOrEqual(ImageOptimizer::MAX_DIMENSION, $width);
        $this->assertFileExists("$dir/wide.jpg.webp");

        // Wide images also get a mobile srcset variant (+ webp sibling).
        $this->assertFileExists("$dir/wide@960.jpg");
        $this->assertFileExists("$dir/wide@960.jpg.webp");
        $this->assertSame(ImageOptimizer::VARIANT_WIDTH, getimagesize("$dir/wide@960.jpg")[0]);

        // Second run must skip the already-optimized file (webp sibling is newer).
        $mtime = filemtime("$dir/wide.jpg");
        $this->artisan('images:optimize', ['--path' => $dir])->assertSuccessful();
        clearstatcache();
        $this->assertSame($mtime, filemtime("$dir/wide.jpg"));

        array_map('unlink', glob("$dir/*"));
        rmdir($dir);
    }
}
