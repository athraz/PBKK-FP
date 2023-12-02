<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Review;
use App\Models\Order;
use App\Models\OrderMenu;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as FakerFactory;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $faker = FakerFactory::create();
        DB::table('types')->insert([
            ['name' => 'Rices'],
            ['name' => 'Noodles'],
            ['name' => 'Breads'],
            ['name' => 'Drinks']
        ]);
        DB::table('menus')->insert([
            ['name' => 'Fried Rice', 'type_id' => 1, 'price' => $price = $faker->randomFloat(2, 15000, 40000), 'original_price' => $price, 'description' => $faker->sentence(mt_rand(20, 40)), 'photo' => '1.jpg'],
            ['name' => 'Seafood Fried Rice', 'type_id' => 1, 'price' => $price = $faker->randomFloat(2, 15000, 40000), 'original_price' => $price, 'description' => $faker->sentence(mt_rand(20, 40)), 'photo' => '2.jpg'],
            ['name' => 'Mentai Rice', 'type_id' => 1, 'price' => $price = $faker->randomFloat(2, 15000, 40000), 'original_price' => $price, 'description' => $faker->sentence(mt_rand(20, 40)), 'photo' => '3.jpg'],
            ['name' => 'Katsu Curry Rice', 'type_id' => 1, 'price' => $price = $faker->randomFloat(2, 15000, 40000), 'original_price' => $price, 'description' => $faker->sentence(mt_rand(20, 40)), 'photo' => '4.jpg'],
            ['name' => 'Fried Noodle', 'type_id' => 2, 'price' => $price = $faker->randomFloat(2, 15000, 40000), 'original_price' => $price, 'description' => $faker->sentence(mt_rand(20, 40)), 'photo' => '5.jpg'],
            ['name' => 'Ramen', 'type_id' => 2, 'price' => $price = $faker->randomFloat(2, 15000, 40000), 'original_price' => $price, 'description' => $faker->sentence(mt_rand(20, 40)), 'photo' => '6.jpg'],
            ['name' => 'Spaghetti', 'type_id' => 2, 'price' => $price = $faker->randomFloat(2, 15000, 40000), 'original_price' => $price, 'description' => $faker->sentence(mt_rand(20, 40)), 'photo' => '7.jpg'],
            ['name' => 'Pad Thai', 'type_id' => 2, 'price' => $price = $faker->randomFloat(2, 15000, 40000), 'original_price' => $price, 'description' => $faker->sentence(mt_rand(20, 40)), 'photo' => '8.jpg'],
            ['name' => 'Croissant', 'type_id' => 3, 'price' => $price = $faker->randomFloat(2, 15000, 40000), 'original_price' => $price, 'description' => $faker->sentence(mt_rand(20, 40)), 'photo' => '9.jpg'],
            ['name' => 'Pretzel', 'type_id' => 3, 'price' => $price = $faker->randomFloat(2, 15000, 40000), 'original_price' => $price, 'description' => $faker->sentence(mt_rand(20, 40)), 'photo' => '10.jpg'],
            ['name' => 'Baguette', 'type_id' => 3, 'price' => $price = $faker->randomFloat(2, 15000, 40000), 'original_price' => $price, 'description' => $faker->sentence(mt_rand(20, 40)), 'photo' => '11.jpg'],
            ['name' => 'Donut', 'type_id' => 3, 'price' => $price = $faker->randomFloat(2, 15000, 40000), 'original_price' => $price, 'description' => $faker->sentence(mt_rand(20, 40)), 'photo' => '12.jpg'],
            ['name' => 'Ice Tea', 'type_id' => 4, 'price' => $price = $faker->randomFloat(2, 15000, 40000), 'original_price' => $price, 'description' => $faker->sentence(mt_rand(20, 40)), 'photo' => '13.jpg'],
            ['name' => 'Mochaccino', 'type_id' => 4, 'price' => $price = $faker->randomFloat(2, 15000, 40000), 'original_price' => $price, 'description' => $faker->sentence(mt_rand(20, 40)), 'photo' => '14.jpg'],
            ['name' => 'Hot Chocolate', 'type_id' => 4, 'price' => $price = $faker->randomFloat(2, 15000, 40000), 'original_price' => $price, 'description' => $faker->sentence(mt_rand(20, 40)), 'photo' => '15.jpg'],
            ['name' => 'Cappuccino', 'type_id' => 4, 'price' => $price = $faker->randomFloat(2, 15000, 40000), 'original_price' => $price, 'description' => $faker->sentence(mt_rand(20, 40)), 'photo' => '16.jpg'],
        ]);

        DB::table('users')->insert(['name' => 'Admin', 'email' => 'admin@gmail.com', 'password' => Hash::make('12345678'), 'role' => 'admin']);
        User::factory(10)->create();
        DB::table('users')->insert(['name' => 'Yanto', 'email' => 'yanto@gmail.com', 'password' => Hash::make('12345678'), 'role' => 'employee']);

        Review::factory(50)->create();
        Order::factory(10)->has(OrderMenu::factory(6))->create();

        $ordermenus = OrderMenu::all();
        foreach ($ordermenus as $ordermenu) {
            $duplicates = OrderMenu::where('id', '!=', $ordermenu->id)
                ->where('order_id', $ordermenu->order_id)
                ->where('menu_id', $ordermenu->menu_id)
                ->get();

            $ordermenu->update(['quantity' => $ordermenu->quantity * ($duplicates->count() + 1)]);
            foreach($duplicates as $duplicate){
                $duplicate->delete();
            }
        }

        $orders = Order::all();
        foreach ($orders as $order) {
            $totalprice = 0;
            $ordermenus = OrderMenu::where('order_id', $order->id)->get();
            foreach ($ordermenus as $ordermenu) {
                $totalprice = $totalprice + $ordermenu->order_price * $ordermenu->quantity;
            }
            $order->update(['total_price' => $totalprice]);
        }

        DB::table('promos')->insert([
            ['name' => 'December Sale', 'discount' => 50, 'start_time' => '2024-12-01 00:00:01', 'end_time' => '2024-12-31 23:59:59', 'is_active' => 0],
            ['name' => 'New Year Sale', 'discount' => 30, 'start_time' => '2025-01-01 00:00:01', 'end_time' => '2025-01-07 23:59:59', 'is_active' => 0]
        ]);

        DB::table('promo_menu')->insert([
            ['promo_id' => 1, 'menu_id' => 2],
            ['promo_id' => 1, 'menu_id' => 6],
            ['promo_id' => 1, 'menu_id' => 9],
            ['promo_id' => 1, 'menu_id' => 10],
            ['promo_id' => 1, 'menu_id' => 15],
            ['promo_id' => 1, 'menu_id' => 16],
            ['promo_id' => 2, 'menu_id' => 1],
            ['promo_id' => 2, 'menu_id' => 2],
            ['promo_id' => 2, 'menu_id' => 3],
            ['promo_id' => 2, 'menu_id' => 4],
        ]);
    }
}
