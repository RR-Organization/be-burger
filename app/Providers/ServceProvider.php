<?php

namespace App\Providers;


use App\Interfaces\MenuInterfaces;
use App\Interfaces\PageInterfaces;
use App\Repository\MenuRepository;
use App\Repository\PageRepository;
use Illuminate\Support\ServiceProvider;

class ServceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
       
        $this->app->bind(PageInterfaces::class, PageRepository::class);
        $this->app->bind(MenuInterfaces::class, MenuRepository::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
