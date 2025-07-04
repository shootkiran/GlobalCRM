<?php

return [

    'label' => 'Вимкнути',

    'modal' => [

        'heading' => 'Вимкнення аутентифікатора',

        'description' => 'Ви впевнені, що хочете припинити використання аутентифікатора? Це призведе до зменшення рівня безпеки вашого облікового запису.',

        'form' => [

            'code' => [

                'label' => 'Введіть 6-значний код з аутентифікатора',

                'validation_attribute' => 'код',

                'actions' => [

                    'use_recovery_code' => [
                        'label' => 'Натомість використати резервний код',
                    ],

                ],

                'messages' => [

                    'invalid' => 'Введений вами код недійсний.',

                ],

            ],

            'recovery_code' => [

                'label' => 'Або введіть резервний код',

                'validation_attribute' => 'резервний код',

                'messages' => [

                    'invalid' => 'Введений вами резервний код недійсний.',

                ],

            ],

        ],

        'actions' => [

            'submit' => [
                'label' => 'Вимкнути аутентифікатор',
            ],

        ],

    ],

    'notifications' => [

        'disabled' => [
            'title' => 'Аутентифікатор вимкнено',
        ],

    ],

];
