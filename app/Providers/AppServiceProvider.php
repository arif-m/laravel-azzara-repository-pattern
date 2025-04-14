<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\User\IUserRepository;
use App\Repositories\User\UserRepository;
use App\Repositories\GroupUser\IGroupUserRepository;
use App\Repositories\GroupUser\GroupUserRepository;
use App\Repositories\Menu\IMenuRepository;
use App\Repositories\Menu\MenuRepository;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(IUserRepository::class, UserRepository::class);
        $this->app->bind(IGroupUserRepository::class, GroupUserRepository::class);
        $this->app->bind(IMenuRepository::class, MenuRepository::class);

    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
