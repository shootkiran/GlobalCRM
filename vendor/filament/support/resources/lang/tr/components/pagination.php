<?php

return [

    'label' => 'Sayfalandırma Navigasyonu',

    'overview' => 'Toplam :total sonuçtan :first ile :last arası görüntüleniyor',

    'fields' => [

        'records_per_page' => [

            'label' => 'sayfa başına',

            'options' => [
                'all' => 'Tümü',
            ],

        ],

    ],

    'actions' => [

        'first' => [
            'label' => 'İlk',
        ],

        'go_to_page' => [
            'label' => ':page. sayfaya git',
        ],

        'last' => [
            'label' => 'Son',
        ],

        'next' => [
            'label' => 'Sonraki',
        ],

        'previous' => [
            'label' => 'Önceki',
        ],

    ],

];
