<?php

return [
    'locale' => [
        'default' => getenv('APP_LOCALE') ? : 'en',
        'locales' => [
            'en' => 'en',
            'ru' => 'ru'
        ],
    ],
];