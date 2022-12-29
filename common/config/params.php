<?php
return [
    'adminEmail' => 'info@ume.tech',
    'supportEmail' => 'info@ume.tech',
    'senderEmail' => 'info@ume.tech',
    'senderName' => 'UME',
    'phone' => '8 800 555 27 21',
    'user.passwordResetTokenExpire' => 3600,
    'user.passwordMinLength' => 8,
    // 'languages' => [
        // 'Русский' => 'ru',
        // 'English' => 'en',
        // 'Việt nam' => 'vi',
        // 'Deutsch' => 'de',
        // 'Қазақ' => 'kz',
        // "O'zbek" => 'uz',
        // 'Українська' => 'ua',
    // ],
    'h1' => '',
    'title' => '',
    'description' => '',
    'colors' => [
        'primary',
        'info',
        'secondary',
        'warning',
        'light',
        'dark',
    ],
    'store_types' => [
        0 => 'не МЛМ',
        1 => 'МЛМ',
        2 => 'Скидка',
    ],
    'default_store_type' => 0,
    'store_type' => 0,
    'currency' => 'RUB',
    'socials' => [
        'ok' => '#',
        'vk' => '#',
        'tg' => 'https://t.me/ume_petpoint',
    ],
    
    'actionsTypes' => [
        0 => 'Розыгрыш',
        1 => 'Подарок',
        2 => 'Конкурс',
        3 => 'Специальное предложение',
        4 => 'Другое',
    ],
    
    'activity' => [
        0 => 'Умеренно (менее 1 часа прогулок в день)',
        1 => 'Средне (1-2 часа прогулок в день)',
        2 => 'Очень (более 2 часов прогулок в день)',
    ],
    
    'sex' => [
        0 => 'Девочка',
        1 => 'Мальчик',
    ],
    
    'bonus' => [
        // minus = 0
        [
            'Покупка',
            'Участие в розыгрыше',
            'Подарок другу',
            'Другое',
        ],
        // plus = 1
        [
            'Регистрация по приглашению',
            'Покупка по подписке',
            'Подарок от друга',
            'Другое',
        ]
    ],
    'referalBonus' => 5,
    
    'apps' => [
        'google' => '#',
        'apple' => '#',
    ],
    
    'productImageSizes' => [
        'XXS' => 100,
        'XS' => 200,
        'S' => 500,
        'M' => 700,
        'L' => 2000,
        'XL' => 3500,
    ],

    // 'hideNotAvailable' => false, // скрывать недоступные товары
    // 'scanToWin' => [
        // 'considerOrderStatus' => false, // учитывать статус чека в розыгрыше (активно / не активно)
    // ],
    
    
    
    // товар в подарок
    // 'gift' => [
        // 'product_id' => 84,
        // 'count' => 1,
        // 'price' => 0,
        // 'disableAddToCart' => true,
    // ],
	
	
];
