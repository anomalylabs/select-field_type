<?php

return [
    'mode'          => [
        'label'        => 'Mode',
        'instructions' => 'What kind of input would you like to display?',
        'option'       => [
            'search'   => 'Ara',
            'buttons'  => 'Butonlar',
            'dropdown' => 'Dropdown',
            'radio'    => 'Radyo Butonlar',
        ],
    ],
    'options'       => [
        'label'        => 'Seçenekler',
        'instructions' => 'Seçenekleri <strong>anahtar: Değer</strong> veya yalnızca <strong>Değer</strong> şeklinde girin. Her bir seçeneği yeni satırda ekleyin.',
        'placeholder'  => 'anahtar: Değer',
    ],
    'default_value' => [
        'label'        => 'Varsayılan Değer',
        'instructions' => 'Varsayılan değeri girin.',
    ],
    'separator'     => [
        'label'        => 'Ayırıcı',
        'instructions' => 'Özel bir <strong>anahtar:değer</strong> ayırıcı belirtin.',
        'placeholder'  => ':',
    ],
];
