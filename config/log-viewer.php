<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Route Prefix
    |--------------------------------------------------------------------------
    |
    | This is the URI prefix for the log viewer routes. You can change it
    | to whatever you prefer, like 'admin/logs' or 'system/logs'.
    |
    */

    'route_prefix' => 'logs',

    /*
    |--------------------------------------------------------------------------
    | Middleware
    |--------------------------------------------------------------------------
    |
    | These middleware will be assigned to every log viewer route. You can
    | add your own middleware to this list or change these to fit your needs.
    |
    */

    'middleware' => ['web', 'auth'],

    /*
    |--------------------------------------------------------------------------
    | Log Path
    |--------------------------------------------------------------------------
    |
    | This is the path to your Laravel log files. By default, it uses the
    | standard Laravel logs directory.
    |
    */

    'log_path' => storage_path('logs'),

    /*
    |--------------------------------------------------------------------------
    | Logs Per Page
    |--------------------------------------------------------------------------
    |
    | The number of log entries to display per page.
    |
    */

    'per_page' => 25,

    /*
    |--------------------------------------------------------------------------
    | Allowed Users
    |--------------------------------------------------------------------------
    |
    | If you want to restrict access to specific users, add their email
    | addresses or IDs here. Leave empty to allow all authenticated users.
    |
    */

    'allowed_users' => [],

    /*
    |--------------------------------------------------------------------------
    | Allow Clear
    |--------------------------------------------------------------------------
    |
    | Set this to false to disable the ability to clear log files.
    |
    */

    'allow_clear' => true,

    /*
    |--------------------------------------------------------------------------
    | Allow Download
    |--------------------------------------------------------------------------
    |
    | Set this to false to disable the ability to download log files.
    |
    */

    'allow_download' => true,

    /*
    |--------------------------------------------------------------------------
    | Locale
    |--------------------------------------------------------------------------
    |
    | Set the default locale for the log viewer. If set to null, it will use
    | the application's current locale. Users can also switch languages
    | using the language dropdown in the UI.
    |
    */

    'locale' => null,

    /*
    |--------------------------------------------------------------------------
    | Available Locales
    |--------------------------------------------------------------------------
    |
    | The available locales for the language switcher. Each locale should have
    | a corresponding translation file in resources/lang/{locale}/log-viewer.php
    |
    */

    'available_locales' => [
        'en' => 'English',
        'ar' => 'Arabic',
    ],

];
