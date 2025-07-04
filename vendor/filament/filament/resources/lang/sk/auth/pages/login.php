<?php

return [

    'title' => 'Prihlásenie',

    'heading' => 'Prihláste sa',

    'actions' => [

        'register' => [
            'before' => 'alebo',
            'label' => 'si založte účet',
        ],

        'request_password_reset' => [
            'label' => 'Zabudnuté heslo?',
        ],

    ],

    'form' => [

        'email' => [
            'label' => 'Emailová adresa',
        ],

        'password' => [
            'label' => 'Heslo',
        ],

        'remember' => [
            'label' => 'Zapamätať si prihlásenie',
        ],

        'actions' => [

            'authenticate' => [
                'label' => 'Prihlásiť sa',
            ],

        ],

    ],

    'multi_factor' => [

        'heading' => 'Overte svoju identitu',

        'subheading' => 'Na pokračovanie prihlásenia musíte overiť svoju identitu.',

        'form' => [

            'provider' => [
                'label' => 'Ako si želáte overiť svoju identitu?',
            ],

            'actions' => [

                'authenticate' => [
                    'label' => 'Potvrdiť prihlásenie',
                ],

            ],

        ],

    ],

    'messages' => [

        'failed' => 'Zadané údaje sú nesprávne.',

    ],

    'notifications' => [

        'throttled' => [
            'title' => 'Príliš veľa pokusov o prihlásenie',
            'body' => 'Prosím počkajte :seconds sekúnd.',
        ],

    ],

];
