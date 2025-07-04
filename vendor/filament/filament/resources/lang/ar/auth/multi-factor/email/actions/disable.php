<?php

return [

    'label' => 'إيقاف',

    'modal' => [

        'heading' => 'تعطيل رموز التحقق عبر البريد الإلكتروني',

        'description' => 'هل أنت متأكد أنك تريد التوقف عن استلام رموز التحقق عبر البريد الإلكتروني؟ تعطيل هذا الخيار سيؤدي إلى إزالة طبقة إضافية من الأمان لحسابك.',

        'form' => [

            'code' => [

                'label' => 'أدخل الرمز المكون من 6 أرقام الذي أرسلناه إلى بريدك الإلكتروني',

                'validation_attribute' => 'الرمز',

                'actions' => [

                    'resend' => [

                        'label' => 'إرسال رمز جديد عبر البريد الإلكتروني',

                        'notifications' => [

                            'resent' => [
                                'title' => 'تم إرسال رمز جديد إلى بريدك الإلكتروني',
                            ],

                        ],

                    ],

                ],

                'messages' => [

                    'invalid' => 'الرمز الذي أدخلته غير صالح.',

                ],

            ],

        ],

        'actions' => [

            'submit' => [
                'label' => 'تعطيل رموز التحقق عبر البريد الإلكتروني',
            ],

        ],

    ],

    'notifications' => [

        'disabled' => [
            'title' => 'تم تعطيل رموز التحقق عبر البريد الإلكتروني',
        ],

    ],

];
