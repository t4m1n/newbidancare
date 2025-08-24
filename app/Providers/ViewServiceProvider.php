<?php

namespace App\Providers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        View::composer('layouts.partials.sidebar', function ($view) {
            $sidebarMenus = collect(); // Default ke koleksi kosong

            if (Auth::check()) {
                /** @var \App\Models\User $user */
                $user = Auth::user();
                $user->load('roles.menus.children'); // Eager load untuk efisiensi

                $menus = $user->roles->flatMap(function ($role) {
                    return $role->menus;
                })->unique('id');

                // Filter hanya menu utama & urutkan
                $sidebarMenus = $menus->whereNull('parent_id')->sortBy('order');
            }

            $view->with('sidebarMenus', $sidebarMenus);
        });
    }
}
