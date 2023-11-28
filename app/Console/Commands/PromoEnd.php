<?php

namespace App\Console\Commands;

use App\Models\Menu;
use App\Models\Promo;
use App\Models\PromoMenu;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Cache;

class PromoEnd extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'promo:end';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check if there is any promo to end';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $endedpromo = Promo::where('end_time', '<=', now())->where('is_active', 1)->first();

        if ($endedpromo){
            $endedpromo->update(['is_active' => 0]);
            $promomenus = PromoMenu::where('promo_id', $endedpromo->id)->get();
            foreach ($promomenus as $promomenu){
                $menu = Menu::findOrFail($promomenu->menu_id);
                $menu->update(['price' => $menu->original_price]);
            }
            
            Cache::forget('menus');
        }
    }
}
