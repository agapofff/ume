<?php
    use yii\helpers\Html;
    use lo\widgets\SlimScroll;
?>

<aside class="main-sidebar">

    <?= SlimScroll::widget([
        'options' => [
            'height' => '100%',
            'size' => '6px',
        ]
    ]); 
    ?>

    <section class="sidebar">
        
        <?php
        if (Yii::$app->user->isGuest) {
            $menuItems[] = [
                'label' => Yii::t('back', 'Войти'),
                'icon' => 'sign-in',
                'url' => ['/user/login'],
            ];
        } else {
            
            if (
                (
                    Yii::$app->user->can('/source-message/*')
                    || Yii::$app->user->can('/source-message/index')
                ) && (
                    Yii::$app->user->can('/message/*')
                    || Yii::$app->user->can('/message/index')
                )
            ) {
                $menuItems[] = [
                    'label' => Yii::t('back', 'Локализация'),
                    'icon' => 'globe',
                    'items' => [
                        [
                            'label' => Yii::t('back', 'Константы'),
                            'icon' => 'language',
                            'url' => ['/source-message'],
                        ],
                        [
                            'label' => Yii::t('back', 'Переводы'),
                            'icon' => 'exchange',
                            'url' => ['/message']
                        ],
                    ],
                ];
            }
            
            if (
                Yii::$app->user->can('/shop/*')
                || Yii::$app->user->can('/shop/category/*')
                || Yii::$app->user->can('/shop/category/index')
            ) {
                $menuItems[] = [
                    'label' => Yii::t('back', 'Категории'),
                    'icon' => 'indent',
                    'url' => ['/shop/category'],
                ];
            }
            
            if (
                Yii::$app->user->can('/shop/*')
                || Yii::$app->user->can('/shop/product/*')
                || Yii::$app->user->can('/shop/product/index')
            ) {
                $menuItems[] = [
                    'label' => Yii::t('back', 'Товары'),
                    'icon' => 'shopping-basket',
                    'url' => ['/shop/product'],
                ];
            }
            
            if (
                Yii::$app->user->can('/shop/*')
                || Yii::$app->user->can('/order/order/*')
                || Yii::$app->user->can('/order/order/index')
                // || Yii::$app->user->can('/order/operator/*')
                // || Yii::$app->user->can('/order/operator/index')
            ) {
                $menuItems[] = [
                    'label' => Yii::t('back', 'Заказы'),
                    'icon' => 'shopping-cart',
                    // 'url' => ['/order/operator'],
                    'url' => ['/order/order'],
                ];
            }
            
            if (
                Yii::$app->user->can('/stores/*')
                || Yii::$app->user->can('/stores/index')
            ) {
                $menuItems[] = [
                    'label' => Yii::t('back', 'Магазины'),
                    'icon' => 'shopping-bag',
                    'url' => ['/stores'],
                ];
            }
            
            if (
                Yii::$app->user->can('/promocodes/*')
                || Yii::$app->user->can('/promocodes/index')
            ) {
                $menuItems[] = [
                    'label' => Yii::t('back', 'Промокоды'),
                    'icon' => 'hashtag',
                    'url' => ['/promocodes'],
                ];
            }
            
            
            // if (
                // Yii::$app->user->can('/shop/*')
                // || Yii::$app->user->can('/order/payment/*')
                // || Yii::$app->user->can('/order/payment/index')
            // ) {
                // $menuItems[] = [
                    // 'label' => Yii::t('back', 'Транзакции'),
                    // 'icon' => 'money',
                    // 'url' => ['/order/payment'],
                // ];
            // }
            
            if (
                Yii::$app->user->can('/news/*')
                && Yii::$app->user->can('/news-categories/*')
            ) {
                $menuItems[] = [
                    'label' => Yii::t('back', 'Новости'),
                    'icon' => 'bold',
                    'items' => [
                        [
                            'label' => Yii::t('back', 'Посты'),
                            'icon' => 'file-text-o',
                            'url' => ['/news'],
                        ],
                        [
                            'label' => Yii::t('back', 'Категории'),
                            'icon' => 'copy',
                            'url' => ['/news-categories']
                        ],
                    ],
                ];
            }
            
            if (
                Yii::$app->user->can('/actions/*')
            ) {
                $menuItems[] = [
                    'label' => Yii::t('back', 'Акции'),
                    'icon' => 'gift',
                    'url' => ['/actions'],
                ];
            }
            
            if (
                Yii::$app->user->can('/reviews/*')
            ) {
                $menuItems[] = [
                    'label' => Yii::t('back', 'Отзывы'),
                    'icon' => 'commenting',
                    'url' => ['/reviews'],
                ];
            }
            
            if (
                Yii::$app->user->can('/banners/*')
            ) {
                $menuItems[] = [
                    'label' => Yii::t('back', 'Баннеры'),
                    'icon' => 'image',
                    'url' => ['/banners'],
                ];
            }
            
            if (
                Yii::$app->user->can('/pages/*')
            ) {
                $menuItems[] = [
                    'label' => Yii::t('back', 'Страницы'),
                    'icon' => 'files-o',
                    'url' => ['/pages'],
                ];
            }
            
            if (
                Yii::$app->user->can('/breeds/*')
            ) {
                $menuItems[] = [
                    'label' => Yii::t('back', 'Породы'),
                    'icon' => 'paw',
                    'url' => ['/breeds'],
                ];
            }
            
            
            if (
                Yii::$app->user->can('/meta-tags/*')
            ) {
                $menuItems[] = [
                    'label' => Yii::t('back', 'Мета-теги'),
                    'icon' => 'tags',
                    'url' => ['/meta-tags'],
                ];
            }
            
            if (
                Yii::$app->user->can('/redirects/*')
            ) {
                $menuItems[] = [
                    'label' => Yii::t('back', 'Редиректы'),
                    'icon' => 'share-square-o',
                    'url' => ['/redirects'],
                ];
            }
            
            // if (
                // Yii::$app->user->can('/help/*')
            // ) {
                // $menuItems[] = [
                    // 'label' => Yii::t('back', 'Помощь'),
                    // 'icon' => 'question',
                    // 'url' => [
                        // '/help',
                        // 'sort' => 'ordering'
                    // ],
                // ];
            // }
            
            // if (
                // Yii::$app->user->can('/addresses/*')
                // && Yii::$app->user->can('/cities/*')
                // && Yii::$app->user->can('/countries/*')
            // ) {
                // $menuItems[] = [
                    // 'label' => Yii::t('back', 'Контакты'),
                    // 'icon' => 'map-marker',
                    // 'items' => [
                        // [
                            // 'label' => Yii::t('back', 'Страны'),
                            // 'icon' => 'globe',
                            // 'url' => ['/countries'],
                        // ],
                        // [
                            // 'label' => Yii::t('back', 'Города'),
                            // 'icon' => 'map-signs',
                            // 'url' => ['/cities']
                        // ],
                        // [
                            // 'label' => Yii::t('back', 'Адреса'),
                            // 'icon' => 'street-view',
                            // 'url' => ['/addresses']
                        // ],
                    // ],
                // ];
            // }
            
            // if (
                // Yii::$app->user->can('/tests/*')
                // && Yii::$app->user->can('/test-answers/*')
                // && Yii::$app->user->can('/test-questions/*')
                // && Yii::$app->user->can('/test-passings/*')
            // ) {
                // $menuItems[] = [
                    // 'label' => Yii::t('back', 'Тесты'),
                    // 'icon' => 'check-square-o',
                    // 'items' => [
                        // [
                            // 'label' => Yii::t('back', 'Тесты'),
                            // 'icon' => 'check-square-o',
                            // 'url' => ['/tests'],
                        // ],
                        // [
                            // 'label' => Yii::t('back', 'Вопросы'),
                            // 'icon' => 'question-circle-o',
                            // 'url' => ['/test-questions']
                        // ],
                        // [
                            // 'label' => Yii::t('back', 'Ответы'),
                            // 'icon' => 'list-ul',
                            // 'url' => ['/test-answers']
                        // ],
                        // [
                            // 'label' => Yii::t('back', 'Результаты'),
                            // 'icon' => 'list-ol',
                            // 'url' => ['/test-results']
                        // ],
                        // [
                            // 'label' => Yii::t('back', 'Прохождения'),
                            // 'icon' => 'forward',
                            // 'url' => ['/test-passings']
                        // ],
                    // ],
                // ];
            // }
            
            // if (
                // Yii::$app->user->can('/scan-to-win/*')
            // ) {
                // $menuItems[] = [
                    // 'label' => Yii::t('back', 'Розыгрыши'),
                    // 'icon' => 'trophy',
                    // 'items' => [
                        // [
                            // 'label' => Yii::t('back', 'Розыгрыши'),
                            // 'icon' => 'trophy',
                            // 'url' => ['/scan-to-win'],
                        // ],
                        // [
                            // 'label' => Yii::t('back', 'Коды'),
                            // 'icon' => 'barcode',
                            // 'url' => ['/scan-to-win-codes']
                        // ],
                        // [
                            // 'label' => Yii::t('back', 'Магазины'),
                            // 'icon' => 'shopping-bag',
                            // 'url' => ['/scan-to-win-stores']
                        // ],
                    // ],
                // ];
            // }
            
            // if (
                // Yii::$app->user->can('/votes/*')
                // || Yii::$app->user->can('/questions/*')
                // || Yii::$app->user->can('/answers/*')
            // ) {
                // $menuItems[] = [
                    // 'label' => Yii::t('back', 'Голосования'),
                    // 'icon' => 'pie-chart',
                    // 'items' => [
                        // [
                            // 'label' => Yii::t('back', 'Вопросы'),
                            // 'icon' => 'question-circle',
                            // 'url' => ['/questions'],
                        // ],
                        // [
                            // 'label' => Yii::t('back', 'Ответы'),
                            // 'icon' => 'list-ul',
                            // 'url' => ['/answers']
                        // ],
                        // [
                            // 'label' => Yii::t('back', 'Голоса'),
                            // 'icon' => 'bar-chart',
                            // 'url' => ['/votes']
                        // ],
                    // ],
                // ];
            // }
            
            // if (Yii::$app->user->can('/mars-form/*')) {
                // $menuItems[] = [
                    // 'label' => Yii::t('back', 'Заявки на экспедицию'),
                    // 'icon' => 'rocket',
                    // 'url' => ['/mars-form'],
                // ];
            // }
            
            // if (
                // Yii::$app->user->can('/boutiques/*')
            // ) {
                // $menuItems[] = [
                    // 'label' => Yii::t('back', 'Бутики'),
                    // 'icon' => 'shopping-bag',
                    // 'url' => ['/boutiques'],
                // ];
            // }            
            
            if (
                Yii::$app->user->can('/shop/*')
                || Yii::$app->user->can('/order/shipping-type/*')
                || Yii::$app->user->can('/order/shipping-type/index')
            ) {
                $menuItems[] = [
                    'label' => Yii::t('back', 'Способы доставки'),
                    'icon' => 'truck',
                    'url' => ['/order/shipping-type'],
                ];
            }
            
            if (
                Yii::$app->user->can('/shop/*')
                || Yii::$app->user->can('/order/payment-type/*')
                || Yii::$app->user->can('/order/payment-type/index')
            ) {
                $menuItems[] = [
                    'label' => Yii::t('back', 'Способы оплаты'),
                    'icon' => 'credit-card',
                    'url' => ['/order/payment-type'],
                ];
            }
            
            if (
                Yii::$app->user->can('/shop/*')
                || Yii::$app->user->can('/filter/*')
            ) {
                $menuItems[] = [
                    'label' => Yii::t('back', 'Фильтры'),
                    'icon' => 'filter',
                    'url' => ['/filter/filter'],
                ];
            }
            
            // if (
                // Yii::$app->user->can('/shop/*')
                // || Yii::$app->user->can('/field/*')
            // ) {
                // $menuItems[] = [
                    // 'label' => Yii::t('back', 'Доп.поля'),
                    // 'icon' => 'pencil-square-o',
                    // 'url' => ['/field'],
                // ];
            // }
            
            if (
                Yii::$app->user->can('/order/field/*')
            ) {
                $menuItems[] = [
                    'label' => Yii::t('back', 'Доп.поля заказа'),
                    'icon' => 'pencil-square',
                    'url' => ['/order/field'],
                ];
            }
            
            if (
                Yii::$app->user->can('/shop/price-type/*')
            ) {
                $menuItems[] = [
                    'label' => Yii::t('back', 'Типы цен'),
                    'icon' => 'usd',
                    'url' => ['/shop/price-type'],
                ];
            }
            
            if (Yii::$app->user->can('/user/admin/*')) {
                $menuItems[] = [
                    'label' => Yii::t('back', 'Пользователи'),
                    'icon' => 'users',
                    'url' => ['/user/admin']
                ];
            }
            
            if (
                Yii::$app->user->can('/langs/*')
                || Yii::$app->user->can('/langs/index')
            ) {
                $menuItems[] = [
                    'label' => Yii::t('back', 'Языки'),
                    'icon' => 'flag',
                    'url' => ['/langs']
                ];
            }
            
            if (Yii::$app->user->can('/rbac/*')) {
                $menuItems[] = [
                    'label' => Yii::t('back', 'Контроль доступа'),
                    'icon' => 'key',
                    'items' => [
                        [
                            'label' => Yii::t('back', 'Маршруты'),
                            'icon' => 'map-signs',
                            'url' => ['/rbac/route']
                        ],
                        [
                            'label' => Yii::t('back', 'Роли'),
                            'icon' => 'user-circle',
                            'url' => ['/rbac/role']
                        ],
                        [
                            'label' => Yii::t('back', 'Разрешения'),
                            'icon' => 'check-square-o',
                            'url' => ['/rbac/permission']
                        ],
                        [
                            'label' => Yii::t('back', 'Привязки'),
                            'icon' => 'code-fork',
                            'url' => ['/rbac/assignment']
                        ],
                    ],
                ];
            }
            
            if (Yii::$app->user->can('/gii/*') && YII_ENV_DEV) {
                $menuItems[] = [
                    'label' => Yii::t('back', 'Gii'),
                    'icon' => 'file-code-o',
                    'url' => ['/gii']
                ];
            }
            
            if (Yii::$app->user->can('/debug/*')&& YII_ENV_DEV) {
                $menuItems[] = [
                    'label' => Yii::t('back', 'Debug'),
                    'icon' => 'dashboard',
                    'url' => ['/debug']
                ];
            }
            
        }
    ?>

        <?= dmstr\widgets\Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu tree', 'data-widget'=> 'tree'],
                'items' => $menuItems,
            ]
        ) ?>

    </section>
    
    <?= SlimScroll::end(); ?>

</aside>
