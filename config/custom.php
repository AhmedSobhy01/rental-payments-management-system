<?php

return [
    'pagination_count' => env('PAGINATION_COUNT', 10),

    'currency_name_en' => env('CURRENCY_NAME_EN', 'Egyptian Pound'),
    'currency_symbol_en' => env('CURRENCY_SYMBOL_EN', 'EGP '),

    'currency_name_ar' => env('CURRENCY_NAME_AR', env('CURRENCY_NAME_EN', 'Egyptian Pound')),
    'currency_symbol_ar' => env('CURRENCY_SYMBOL_AR', env('CURRENCY_SYMBOL_EN', 'EGP ')),
];