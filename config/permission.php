<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Table names
    |--------------------------------------------------------------------------
    |
    | Here you may specify the table names for the permissions and roles tables.
    |
    */

    'tables' => [
        'roles' => 'roles',                // Changed from 'roles' to 'role' (singular)
        'permission' => 'permission',    // Change from 'permissions' to 'permission' (singular)
        'model_has_roles' => 'model_has_roles',
        'model_has_permissions' => 'model_has_permissions',
        'role_has_permissions' => 'role_has_permissions',
    ],

    /*
    |--------------------------------------------------------------------------
    | Cache settings
    |--------------------------------------------------------------------------
    |
    | Specify the cache settings for the permission package.
    |
    */

    'cache' => [
        'expiration_time' => 60,          // Cache expiration time in minutes
        'key' => 'spatie.permission.cache',
        'store' => null,                  // Use default cache store
    ],

    /*
    |--------------------------------------------------------------------------
    | Guard names
    |--------------------------------------------------------------------------
    |
    | If you're using multiple guards, you can specify them here.
    |
    */

    'guards' => [
        'web' => 'App\Models\User',      // Specify the user model
    ],

    /*
    |--------------------------------------------------------------------------
    | Model settings
    |--------------------------------------------------------------------------
    |
    | These are the models that the package will use. If you need to customize
    | them, you can specify your own models here.
    |
    */

    'models' => [
        'role' => \Spatie\Permission\Models\Role::class,
        'permission' => \Spatie\Permission\Models\Permission::class,
    ],
];
