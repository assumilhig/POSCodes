<?php

declare(strict_types=1);

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('layouts.app', function ($view) {
            $view
                ->with('sharedNavigations', $this->navigations())
                ->with('sharedProfileNavigations', $this->profiles());
        });
    }

    protected function profiles()
    {
        return  [
            [
                'name' => 'Profile',
                'href' => route('profile.index'),
                'active' => request()->routeIs('profile.index'),
            ],
        ];
    }

    protected function navigations()
    {
        return [
            [
                'with_dropdown' => false,
                'align' => 'left',
                'parent_name' => 'Home',
                'content' => [
                    [
                        'name' => 'Home',
                        'href' => route('home'),
                        'active' => request()->routeIs('home'),
                    ],
                ],
            ],
            [
                'with_dropdown' => true,
                'align' => 'left',
                'parent_name' => 'Access Codes',
                'content' => [
                    [
                        'name' => 'Issue Code',
                        'href' => route('access_codes.issue'),
                        'active' => request()->routeIs('access_codes.issue'),
                    ],
                    [
                        'name' => 'Import Codes',
                        'href' => route('access_codes.import'),
                        'active' => request()->routeIs('access_codes.import'),
                    ],
                ],
            ],
            [
                'with_dropdown' => true,
                'align' => 'left',
                'parent_name' => 'Users Management',
                'content' => [
                    [
                        'name' => 'Users',
                        'href' => '',
                        'active' => '',
                    ],
                    [
                        'name' => 'Import Users',
                        'href' => '',
                        'active' => '',
                    ],
                ],
            ],
        ];
    }
}
