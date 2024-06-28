<?php

return [
    /*
     *  Automatic registration of routes will only happen if this setting is `true`
     */
    'enabled' => true,

    /*
     * Controllers in these directories that have routing attributes
     * will automatically be registered.
     *
     * Optionally, you can specify group configuration by using key/values
     */
    'directories' => [
      app_path('Domain/Statistics/Application/Index') => [
         'middleware' => ['web', 'auth']
        ],
        app_path('Domain/User/Application/Create') => [
           'middleware' => ['web', 'auth']
        ],
        app_path('Domain/User/Application/Delete') => [
           'middleware' => ['web', 'auth']
        ],
        app_path('Domain/User/Application/Edit') => [
           'middleware' => ['web', 'auth']
        ],
        app_path('Domain/User/Application/Index') => [
           'middleware' => ['web', 'auth']
        ],
        app_path('Domain/User/Application/Show') => [
           'middleware' => ['web', 'auth']
        ],
        app_path('Domain/User/Application/Store') => [
           'middleware' => ['web', 'auth']
        ],
        app_path('Domain/User/Application/Update') => [
           'middleware' => ['web', 'auth']
        ],
        app_path('Domain/Category/Application/Create') => [
           'middleware' => ['web', 'auth']
        ],
        app_path('Domain/Category/Application/Delete') => [
           'middleware' => ['web', 'auth']
        ],
        app_path('Domain/Category/Application/Edit') => [
           'middleware' => ['web', 'auth']
        ],
        app_path('Domain/Category/Application/Index') => [
           'middleware' => ['web', 'auth']
        ],
        app_path('Domain/Category/Application/Store') => [
           'middleware' => ['web', 'auth']
        ],
        app_path('Domain/Category/Application/Update') => [
           'middleware' => ['web', 'auth']
        ],
    ],

    /**
     * This middleware will be applied to all routes.
     */
    'middleware' => [
        \Illuminate\Routing\Middleware\SubstituteBindings::class
    ]
];
