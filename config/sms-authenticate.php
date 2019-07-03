<?php

return [
    'views' => [
        /*
        |--------------------------------------------------------------------------
        | Edit to set the views data
        |--------------------------------------------------------------------------
        */

        'extend' => 'admin.app',
        'content' => 'content',
        'parsley' => 'content',

    ],
    'guard' => 'web',
    'auth' => 'admin.',
    'route' => null,
    'as' => 'admin.',
    'prefix' => 'admin'

];