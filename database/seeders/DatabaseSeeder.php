<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Initial admin account (change the password after first login).
        User::updateOrCreate(
            ['email' => 'admin@vipketering.mk'],
            ['name' => 'Администратор', 'password' => Hash::make('vipketering2026')],
        );

        $this->call([
            SettingsSeeder::class,
            PagesSeeder::class,
            MenusSeeder::class,
            EquipmentSeeder::class,
            GallerySeeder::class,
        ]);
    }
}
