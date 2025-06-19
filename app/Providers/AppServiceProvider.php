<?php

namespace App\Providers;

use Illuminate\Support\Facades\Event;
use Illuminate\Support\ServiceProvider;
use JeroenNoten\LaravelAdminLte\Events\BuildingMenu;

class AppServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        Event::listen(BuildingMenu::class, function (BuildingMenu $event) {

            if (\Auth::user()->role === 'admin') {
                $menu = [
                    [
                        'text' => "Dashboard",
                        'url' => "/dashboard",
                        'icon' => 'nav-icon fas fa-tachometer-alt'
                    ],
                    [
                        'text' => "User",
                        'url' => "/user",
                        'icon' => 'nav-icon fas fa-user'
                    ],

                ];
            } else {
                $menu = [
                    [
                        'text' => "Dashboard",
                        'url' => "/dashboard",
                        'icon' => 'nav-icon fas fa-tachometer-alt'
                    ],
                    [
                        'text' => "Kategori",
                        'url' => "/kategori",
                        'icon' => 'nav-icon fas fa-th-large'
                    ],
                    [
                        'text' => "Wallet",
                        'url' => "/wallet",
                        'icon' => 'nav-icon fas fa-wallet'
                    ],
                    [
                        'text' => "Transaksi",
                        'url' => "/transaksi",
                        'icon' => 'nav-icon fas fa-cash-register'
                    ],
                    [
                        'text' => "Transfer",
                        'url' => "/transfer",
                        'icon' => 'nav-icon fas fa-credit-card'
                    ],
                ];
            }
            foreach ($menu as $item) {
                $event->menu->add($item);
            }
        });
    }
    public function register(): void
    {
        //
    }
}
