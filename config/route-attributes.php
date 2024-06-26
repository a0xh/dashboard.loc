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
        app_path('Domain/Statistics/Application/Index'),

        app_path('Domain/User/Application/Create'),
        app_path('Domain/User/Application/Delete'),
        app_path('Domain/User/Application/Edit'),
        app_path('Domain/User/Application/Index'),
        app_path('Domain/User/Application/Show'),
        app_path('Domain/User/Application/Store'),
        app_path('Domain/User/Application/Update'),
        /*
        app_path('Http/Controllers/Api') => [
           'prefix' => 'api',
           'middleware' => 'api',
            // only register routes in files that match the patterns
           'patterns' => ['*Controller.php'],
           // do not register routes in files that match the patterns
           'not_patterns' => [],
        ],
        */
    ],

    /**
     * This middleware will be applied to all routes.
     */
    'middleware' => [
        \Illuminate\Routing\Middleware\SubstituteBindings::class
    ]
];
