<?php

namespace Database\Seeders;

use App\Models\EquipmentItem;
use Illuminate\Database\Seeder;

class EquipmentSeeder extends Seeder
{
    public function run(): void
    {
        $items = [
            ['name' => 'Маса со чаршаф', 'note' => null, 'price' => '600'],
            ['name' => 'Тифани столче', 'note' => null, 'price' => '120'],
            ['name' => 'Коњопои со прекривка', 'note' => null, 'price' => '350'],
            ['name' => 'Тенда (3 × 3)', 'note' => null, 'price' => '700'],
            ['name' => 'Фрижидер за пијалок', 'note' => null, 'price' => '2.000'],
            ['name' => 'Келнер', 'note' => null, 'price' => '2.000'],
            ['name' => 'Изнајмување на скара со готвач', 'note' => 'Подготвување скара на самиот настан, за над 100 особи', 'price' => '4.000'],
        ];

        foreach ($items as $i => $item) {
            EquipmentItem::updateOrCreate(
                ['name' => $item['name']],
                array_merge($item, ['sort_order' => $i, 'is_published' => true]),
            );
        }
    }
}
