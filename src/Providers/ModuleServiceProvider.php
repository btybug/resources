<?php

namespace Btybug\Resources\Providers;

use Illuminate\Support\ServiceProvider;

class ModuleServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the module services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadTranslationsFrom(__DIR__ . '/../Resources/Lang', 'resources');
        $this->loadViewsFrom(__DIR__ . '/../Resources/Views', 'resources');
        $tubs = [
            'classes' => [
                [
                    'title' => 'Text',
                    'url' => '/admin/resources/styles/text',
                    'icon' => 'glyphicon glyphicon-align-justify'
                ],
                [
                    'title' => 'Images',
                    'url' => '/admin/resources/classes/images',
                    'icon' => 'glyphicon glyphicon-picture'
                ],
                [
                    'title' => 'Containers',
                    'url' => '/admin/resources/classes/containers',
                    'icon' => 'glyphicon glyphicon-grain'
                ],
                [
                    'title' => 'Animation',
                    'url' => '/admin/resources/classes/animations',
                    'icon' => 'fa fa-caret-square-o-right'
                ],
                [
                    'title' => 'Fields',
                    'url' => '/admin/resources/classes/fields',
                    'icon' => 'fa fa-paperclip'
                ],
                [
                    'title' => 'Buttons',
                    'url' => '/admin/resources/classes/buttons',
                    'icon' => 'fa fa-play'
                ],
                [
                    'title' => 'notification',
                    'url' => '/admin/resources/classes/notification',
                    'icon' => 'fa fa-info-circle'
                ],
                [
                    'title' => 'Menu',
                    'url' => '/admin/resources/classes/menu',
                    'icon' => 'fa fa-info-circle'
                ]
            ],

        ];

        \Eventy::action('my.tab', $tubs);


        $tabs = [
            'assets' => [
                [
                    'title' => 'Styles',
                    'url' => '/admin/resources/styles',
                    'icon' => 'fa fa-cub'
                ],
                [
                    'title' => 'Files',
                    'url' => '/admin/resources/files',
                    'icon' => 'fa fa-cub'
                ],
                [
                    'title' => 'JQuery',
                    'url' => '/admin/resources/core_assest',
                    'icon' => 'fa fa-cub'
                ],
                [
                    'title' => 'Images',
                    'url' => '/admin/resources/images',
                    'icon' => 'fa fa-cub'
                ],
                [
                    'title' => 'Libraries',
                    'url' => '/admin/resources/core_assest/fonts',
                    'icon' => 'fa fa-cub'
                ],
                [
                    'title' => 'Css',
                    'url' => '/admin/resources/css',
                    'icon' => 'fa fa-cub'
                ]
            ],

            'units' => [
                [
                    'title' => 'Frontend units',
                    'url' => '/admin/resources/units/frontend',
                    'icon' => 'fa fa-cub'
                ],
                [
                    'title' => 'Backend units ',
                    'url' => '/admin/resources/units/backend',
                    'icon' => 'fa fa-cub'
                ]
            ],

        ];

        \Eventy::action('my.tab', $tabs);
    }


    /**
     * Register the module services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->register(RouteServiceProvider::class);
    }
}
