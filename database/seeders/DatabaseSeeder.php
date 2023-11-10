<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Type;
use App\Models\Menu;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Type::factory(5)->has(Menu::factory()->count(4))->create();
        DB::table('users')->insert(['name' => 'admin', 'email' => 'admin@gmail.com', 'password' => Hash::make('12345678'), 'role' => 'admin']);
    }
}
