<?php

namespace App\Console\Commands;

use App\Models\Menu;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Cache;

class DiscountMenuStart extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'discountmenu:start';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Start discount menu';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        if (now()->format('H:i') === '07:00') {
            $menus = Menu::all();

            foreach ($menus as $menu) {
                $menu->update(['price' => $menu->price * 0.5]);
            }

            Cache::forget('menus');
        }
    }
}
