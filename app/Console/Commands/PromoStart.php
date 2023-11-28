<?php

namespace App\Console\Commands;

use App\Models\Menu;
use App\Models\Promo;
use App\Models\PromoMenu;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Cache;

class PromoStart extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'promo:start';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check if there is any promo to start';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $startedpromo = Promo::where('start_time', now())->where('is_active', 0)->first();

        if ($startedpromo){
            $startedpromo->update(['is_active' => 1]);
            $promomenus = PromoMenu::where('promo_id', $startedpromo->id)->get();
            foreach ($promomenus as $promomenu){
                $menu = Menu::findOrFail($promomenu->menu_id);
                $menu->update(['price' => $menu->price * (100 - $startedpromo->discount) / 100]);
            }
            
            Cache::forget('menus');
        }
    }
}
