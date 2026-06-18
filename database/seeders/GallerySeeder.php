<?php

namespace Database\Seeders;

use App\Models\GalleryImage;
use Illuminate\Database\Seeder;

class GallerySeeder extends Seeder
{
    public function run(): void
    {
        // Home — "Од нашата кујна" food strip (no captions / no lightbox)
        $home = ['food-01', 'food-05', 'food-08', 'food-11'];
        foreach ($home as $i => $name) {
            $this->put('home-food', $i, "/img/{$name}.jpg", 'square');
        }

        // Menia — masonry food gallery (lightbox, no captions)
        $menia = [
            ['food-01', 'square'], ['food-02', '3/4'], ['food-03', 'square'], ['food-04', '4/5'],
            ['food-05', '3/4'], ['food-06', 'square'], ['food-07', '4/5'], ['food-08', 'square'],
            ['food-09', '3/4'], ['food-10', 'square'], ['food-11', '4/5'], ['food-12', 'square'],
        ];
        foreach ($menia as $i => [$name, $aspect]) {
            $this->put('menia', $i, "/img/{$name}.jpg", $aspect);
        }

        // Oprema — décor gallery (lightbox + captions)
        $oprema = [
            ['equip-01', 'Маси и столчиња'],
            ['equip-02', 'Коњопои и шведска маса'],
            ['equip-03', 'Декорација на двор за свадба'],
            ['equip-04', 'Шведска маса и тенда'],
            ['equip-05', 'Невестинска маса'],
            ['equip-06', 'Декорација за роденден'],
            ['equip-07', 'Сервирана округла маса'],
            ['equip-08', 'Столчиња со китенки'],
            ['equip-09', 'Декорација на маса'],
            ['equip-10', 'Декорација за прием на гости'],
            ['equip-11', 'Венец за на врата'],
            ['equip-12', 'Декорирани маси со свежо цвеќе'],
        ];
        foreach ($oprema as $i => [$name, $caption]) {
            $this->put('oprema', $i, "/img/{$name}.jpg", '4/5', $caption);
        }
    }

    private function put(string $collection, int $order, string $src, ?string $aspect = null, ?string $caption = null): void
    {
        GalleryImage::updateOrCreate(
            ['collection' => $collection, 'src' => $src],
            [
                'alt' => $caption,
                'caption' => $caption,
                'aspect' => $aspect,
                'sort_order' => $order,
                'is_published' => true,
            ],
        );
    }
}
