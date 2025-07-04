<?php

return [

    'label' => 'إعادة إنشاء رموز الاسترداد',

    'modal' => [

        'heading' => 'إعادة إنشاء رموز استرداد تطبيق المصادقة',

        'description' => 'إذا فقدت رموز الاسترداد الخاصة بك، يمكنك إعادة إنشائها هنا. سيتم إبطال رموز الاسترداد القديمة فور إنشاء الجديدة.',

        'form' => [

            'code' => [

                'label' => 'أدخل الرمز المكون من 6 أرقام من تطبيق المصادقة',

                'validation_attribute' => 'الرمز',

                'messages' => [

                    'invalid' => 'الرمز المُدخل غير صحيح.',

                ],

            ],

            'password' => [

                'label' => 'أو أدخل كلمة المرور الحالية',

                'validation_attribute' => 'كلمة المرور',

            ],

        ],

        'actions' => [

            'submit' => [
                'label' => 'إعادة إنشاء رموز الاسترداد',
            ],

        ],

    ],

    'notifications' => [

        'regenerated' => [
            'title' => 'تم إنشاء رموز استرداد جديدة لتطبيق المصادقة',
        ],

    ],

    'show_new_recovery_codes' => [

        'modal' => [

            'heading' => 'رموز الاسترداد الجديدة',

            'description' => 'يرجى حفظ رموز الاسترداد التالية في مكان آمن. سيتم عرضها مرة واحدة فقط، ولكنك ستحتاجها إذا فقدت الوصول إلى تطبيق المصادقة:',

            'actions' => [

                'submit' => [
                    'label' => 'إغلاق',
                ],

            ],

        ],

    ],

];
