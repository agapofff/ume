<?php

    use yii\helpers\Url;
    use yii\helpers\Html;
    use yii\helpers\ArrayHelper;
    use yii\bootstrap\Nav;
    use yii\bootstrap\NavBar;
    use yii\widgets\Breadcrumbs;
    use frontend\assets\AppAsset;
    // use common\widgets\Alert;
    use yii\web\View;
    use dvizh\cart\widgets\CartInformer;
    use dvizh\cart\widgets\ElementsList;

    AppAsset::register($this);
    
    $this->registerLinkTag([
        'rel' => 'canonical',
        'href' => Url::canonical()
    ]);

    if (Yii::$app->params['title']) {
        $this->title = Yii::$app->params['title'];
    }

    if (Yii::$app->params['description']) {
        $this->registerMetaTag([
            'name' => 'description',
            'content' => Yii::$app->params['description']
        ]);
    }
    
    $this->registerMetaTag([
        'property' => 'og:title',
        'content' => $this->title
    ]);
    if (Yii::$app->params['description']) {
        $this->registerMetaTag([
            'property' => 'og:description',
            'content' => Yii::$app->params['description']
        ]);        
    }
    $this->registerMetaTag([
        'property' => 'og:locale',
        'content' => Yii::$app->language
    ]);
    $this->registerMetaTag([
        'property' => 'og:site_name',
        'content' => Yii::$app->id
    ]);
    $this->registerMetaTag([
        'property' => 'og:type',
        'content' => 'website'
    ]);
    $this->registerMetaTag([
        'property' => 'og:updated_time',
        'content' => Yii::$app->formatter->format('now', 'datetime')
    ]);
    $this->registerMetaTag([
        'property' => 'og:url',
        'content' => Url::canonical()
    ]);


    // кладём валюту текущего языка в параметры
    Yii::$app->params['currency'] = \backend\models\Langs::findOne([
        'code' => Yii::$app->language
    ])->currency;
    
    
    // получаем языки
    $langs = new cetver\LanguageSelector\items\MenuLanguageItems([
        'languages' => Yii::$app->params['languages'],
    ]);
    $langs = $langs->toArray();

    
    $controllerID = Yii::$app->controller->id;
    $actionID = Yii::$app->controller->action->id;
    
    // главная страница?
    $isMainPage = $controllerID == 'site' && $actionID == 'index';
    
    // карточка товара
    $isProductPage = $controllerID == 'product' && $actionID == 'index';
    
    
    // меню
    $menuItems = [
        [
            'label' => Yii::t('front', 'Каталог'),
            'url' => Url::to(['/catalog']),
            'class' => '',
        ],
        [
            'label' => Yii::t('front', 'История UME'),
            'url' => Url::to(['/history']),
            'class' => '',
        ],
        [
            'label' => Yii::t('front', 'Программа лояльности'),
            'url' => Url::to(['/bonus']),
            'class' => '',
        ],
        [
            'label' => Yii::t('front', 'О нас'),
            'url' => Url::to(['/about']),
            'class' => '',
        ],
        [
            'label' => Yii::t('front', 'Новости'),
            'url' => Url::to(['/news']),
            'class' => '',
        ],
    ];
    
    // if (Yii::$app->user->isGuest) {
        // $menuItems[] = [
            // 'label' => Yii::t('front', 'Авторизация'),
            // 'url' => Url::to(['/login']),
            // 'class' => '',
        // ];
    // } else {
        // $menuItems[] = [
            // 'label' => Yii::t('front', 'Личный кабинет'),
            // 'url' => Url::to(['/account']),
            // 'class' => '',
        // ];
    // }
    
    // меню
    $footerMenuItems = [
        [
            'label' => Yii::t('front', 'Каталог'),
            'url' => Url::to(['/catalog']),
            'class' => '',
        ],
        [
            'label' => Yii::t('front', 'История UME'),
            'url' => Url::to(['/history']),
            'class' => '',
        ],
        [
            'label' => Yii::t('front', 'Программа лояльности'),
            'url' => Url::to(['/bonus']),
            'class' => '',
        ],
        [
            'label' => Yii::t('front', 'О нас'),
            'url' => Url::to(['/about']),
            'class' => '',
        ],
        [
            'label' => Yii::t('front', 'Корзина'),
            'url' => Url::to(['/cart']),
            'class' => '',
        ],
        [
            'label' => Yii::t('front', 'Новости'),
            'url' => Url::to(['/news']),
            'class' => '',
        ],
    ];
    
    // if (Yii::$app->user->isGuest) {
        // $footerMenuItems[] = [
            // 'label' => Yii::t('front', 'Авторизация'),
            // 'url' => Url::to(['/login']),
            // 'class' => '',
        // ];
    // } else {
        // $footerMenuItems[] = [
            // 'label' => Yii::t('front', 'Личный кабинет'),
            // 'url' => Url::to(['/account']),
            // 'class' => '',
        // ];
    // }
    
    
    $cart = Yii::$app->cart;
    
    // товар в подарок
    $giftData = null;
    if (Yii::$app->params['gift']) {
        $gift = \dvizh\shop\models\Product::findOne(Yii::$app->params['gift']['product_id']);
        
        $giftOptions = [];
        if ($giftCartOptions = $gift->getCartOptions()) {
            foreach ($giftCartOptions as $key => $giftCartOption) {
                foreach ($giftCartOption['variants'] as $k => $v) {
                    $giftOptions[$key] = $k;
                }
            }
        }

        $giftAttributes = $gift->getModifications()->andWhere([
            'lang' => Yii::$app->language,
            'store_type' => Yii::$app->params['store_type'],
        ])->all();

        if ($giftAttributes && !empty($giftOptions)) {
            $giftData = [
                'model' => \dvizh\shop\models\Product::className(),
                'item_id' => Yii::$app->params['gift']['product_id'],
                'count' => Yii::$app->params['gift']['count'],
                'price' => Yii::$app->params['gift']['price'],
                'options' => $giftOptions,
                'id' => $giftAttributes[0]->sku,
                'lang' => Yii::$app->language,
                'url' => Url::to(['/cart/element/create'])
            ];
            
            if (Yii::$app->params['gift']['disableAddToCart']) {
                $this->registerCss('
                    .product-content .product-buy[data-id="' . Yii::$app->params['gift']['product_id'] . '"],
                    .product-content .price-options[data-id="' . Yii::$app->params['gift']['product_id'] . '"] {
                        display: none;
                    }
                ');
            }
        }
    }

Yii::$app->formatter->locale = strtolower(Yii::$app->params['language']) . '-' . strtoupper(Yii::$app->params['language']);
?>

<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, user-scalable=0"/>
        <meta name="apple-mobile-web-app-capable" content="yes">
        <meta name="mobile-web-app-capable" content="yes">
        <meta name="HandheldFriendly" content="true"/>
        <?php $this->registerCsrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <?php $this->head() ?>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700&display=swap" rel="stylesheet">
        <!--
        <link rel="apple-touch-icon" sizes="57x57" href="/images/favicons/apple-icon-57x57.png">
        <link rel="apple-touch-icon" sizes="60x60" href="/images/favicons/apple-icon-60x60.png">
        <link rel="apple-touch-icon" sizes="72x72" href="/images/favicons/apple-icon-72x72.png">
        <link rel="apple-touch-icon" sizes="76x76" href="/images/favicons/apple-icon-76x76.png">
        <link rel="apple-touch-icon" sizes="114x114" href="/images/favicons/apple-icon-114x114.png">
        <link rel="apple-touch-icon" sizes="120x120" href="/images/favicons/apple-icon-120x120.png">
        <link rel="apple-touch-icon" sizes="144x144" href="/images/favicons/apple-icon-144x144.png">
        <link rel="apple-touch-icon" sizes="152x152" href="/images/favicons/apple-icon-152x152.png">
        <link rel="apple-touch-icon" sizes="180x180" href="/images/favicons/apple-icon-180x180.png">
        <link rel="icon" type="image/png" sizes="192x192" href="/images/favicons/android-icon-192x192.png">
        <link rel="icon" type="image/png" sizes="32x32" href="/images/favicons/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="96x96" href="/images/favicons/favicon-96x96.png">
        <link rel="icon" type="image/png" sizes="16x16" href="/images/favicons/favicon-16x16.png">
        <link rel="manifest" href="/images/favicons/manifest.json">
        <meta name="msapplication-TileColor" content="#ffffff">
        <meta name="msapplication-TileImage" content="/images/favicons/ms-icon-144x144.png">
        <meta name="theme-color" content="#ffffff">
        -->

        
        <?php // обработка ссылок из приложения
            $this->registerJs("
                if (window.location.hash) {
                    var params = [],
                        redirect = false,
                        url = window.location.href.split('#')[0],
                        query = window.location.hash.substring(1).replace('&amp;', '&').split('&');
                        
                    for (var i = 0; i < query.length; i++) {
                        var params = query[i].split('=');
                        if (params[0] === 'store') {
                            url = url.includes('?') ? url + '&store=' + params[1] : url + '?store=' + params[1];
                            redirect = true;
                        }
                        if (params[0] === 'id') {
                            url = url.includes('?') ? url + '&promo=' + params[1] : url + '?promo=' + params[1];
                            redirect = true;
                        }
                    }
                    
                    if (redirect) {
                        window.location.href = url;
                    }
                }
            ",
            View::POS_HEAD);
        ?>
        
        <?php
            if (Yii::$app->language != 'ru') {
        ?>
                <meta name="yandex" content="noindex" />
        <?php
            }
        ?>
        
        <!--
        <script src="https://api-maps.yandex.ru/2.1/?apikey=ba64904a-6f6b-42da-82b6-4483c98a8114&lang=ru_RU" type="text/javascript"></script>
        -->
        
    </head>
    <body 
        data-page="<?= base64_encode($controllerID . '/' . $actionID) ?>"
<?php
    if ($giftData) {
?>
        data-gift="<?= base64_encode(json_encode($giftData)) ?>"
<?php
    }
?>
        class="position-relative">
        
        <div id="loader" class="fixed-top vw-100 vh-100 bg-white opacity-75">
            <div class="d-flex vw-100 vh-100 align-items-center justify-content-center">
                <div class="spinner-border" role="status">
                    <span class="sr-only">Загрузка...</span>
                </div>
            </div>
        </div>

    <?php $this->beginBody() ?>
            
        <nav id="nav" class="fixed-top bg-white px-0 py-0 transition">
            <div id="nav-container" class="container-xl pt-1_5">
                <div class="row justify-content-between align-items-center w-100 flex-nowrap no-gutters">
                    <div id="logo" class="col-auto pr-0 pb-0_25">
                        <a href="<?= Url::home(true) ?><?= Yii::$app->language ?>">
                            <img src="/images/logo/dark.svg" alt="<?= Yii::$app->name ?>">
                        </a>
                    </div>
                    <div class="col-auto pl-0">
                        <div class="row align-items-center justify-content-end">
                            <div id="menu-desktop" class="col-auto d-none d-lg-block">
                                <div class="row align-items-center flex-nowrap no-gutters">
                            <?php
                                foreach ($menuItems as $menuItem) {
                                    $activeMenu = false;
                                    if (isset($menuItem['url'])) {
                                        $activeMenu = $menuItem['url'] == Url::to();
                                    }
                            ?>
                                    <div class="col-auto">
                                        <a href="<?= $menuItem['url'] ?>" class="btn btn-link px-0_5 px-xl-1 text-uppercase text-secondary font-weight-bold text-decoration-<?= $activeMenu ? 'underline' : 'none' ?> <?= $menuItem['class'] ?>">
                                            <?= $menuItem['label'] ?>
                                        </a>
                                    </div>
                            <?php
                                }
                            ?>
                                </div>
                            </div>
                            
                            <div id="nav-lang-select" class="col-auto pl-0 pl-xl-1_5 nav-lang-select dropdown d-none d-sm-block">
                                <a href="#" class="dropdown-toggle text-uppercase text-decoration-none text-secondary font-weight-bold" data-toggle="dropdown">
                                    <?= Yii::$app->language ?>
                                </a>
                                <div class="dropdown-menu text-center">
                                <?php
                                    if ($langs) {
                                        foreach ($langs as $key => $lang) {
                                            if (Yii::$app->language != 'ru' && $lang['label'] == 'ru') {
                                                continue;
                                            }
                                            if ($lang['label'] !== Yii::$app->language) {
                                                echo Html::a($lang['label'], $lang['url'], [
                                                    'class' => 'd-block text-uppercase text-decoration-none px-0_5 text-secondary font-weight-bold'
                                                ]);
                                            }
                                        }
                                    }
                                ?>
                                </div>
                            </div>
                            
                            <!--
                            <div id="search-form-container" class="col-auto pl-0 pl-xl-0_5">
                                <button type="button" class="btn btn-link position-relative text-decoration-none p-0" data-toggle="modal" data-target="#search-modal" aria-label="<?= Yii::t('front', 'Поиск') ?>">
                                    <img src="/images/search.svg">
                                </button>
                            </div>
                            -->
                            <div id="nav-cart-icon" class="col-auto pl-0 pl-xl-0_5">
                                <a href="<?= Url::to(['/checkout']) ?>" class="btn btn-link position-relative text-decoration-none p-0 transition">
                                    <img src="/images/cart_dark.svg">
                                    <?= CartInformer::widget([
                                            'htmlTag' => 'div',
                                            'cssClass' => 'nav-cart-informer position-absolute top-0 right-0 d-flex align-items-center justify-content-center rounded-pill bg-orange text-white p-0',
                                            'text' => '{c}'
                                        ]);
                                    ?>
                                </a>
                            </div>
                            <div id="nav-user-icon" class="col-auto pl-0 pl-xl-0_5">
                                <a href="<?= Yii::$app->user->isGuest ? Url::to(['/login']) : Url::to(['/account']) ?>" class="transition">
                                    <img src="/images/guest_dark.png">
                                </a>
                            </div>
                            <div class="col-auto d-lg-none pl-0">
                                <button id="nav-menu-button" class="btn btn-link text-decoration-none rounded-0 transition p-0" type="button" data-toggle="modal" data-target="#menu" aria-label="<?= Yii::t('front', 'Меню') ?>">
                                    <img src="/images/btn_menu_dark.svg">
                                </button>
                            </div>
                            <!--
                            <div id="nav-wishlist-icon" class="ml-auto mr-2 ml-lg-3 mr-lg-0 ml-xl-4 ml-xxl-5 p-0_25">
                                <a href="<?= Url::to(['/wishlist']) ?>">
                                    <span class="white">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" class="bi bi-heart" viewBox="0 0 16 16">
                                            <path d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01L8 2.748zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143c.06.055.119.112.176.171a3.12 3.12 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15z" fill="white"/>
                                        </svg>
                                    </span>
                                    <span class="black">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="23" height="23" fill="none" class="bi bi-heart" viewBox="0 0 16 16">
                                            <path d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01L8 2.748zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143c.06.055.119.112.176.171a3.12 3.12 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15z" fill="black"/>
                                        </svg>
                                    </span>
                                </a>
                            </div>
                            -->
                        </div>
                    </div>
                </div>
                
                <hr class="border-gray-800 mb-0_5 py-0 w-100 light" style="border-width: 2px">                            
            </div>
        </nav>

        <div id="pagecontent" class="mt-7">

            <?php 
                // echo Breadcrumbs::widget([
                    // 'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                // ]);
            ?>
            
            <?= \lavrentiev\widgets\toastr\NotificationFlash::widget([
                    'options' => [
                        "closeButton" => true,
                        "debug" => false,
                        "newestOnTop" => false,
                        "progressBar" => false,
                        "positionClass" => \lavrentiev\widgets\toastr\NotificationFlash::POSITION_BOTTOM_RIGHT,
                        "preventDuplicates" => true,
                        "onclick" => null,
                        "showDuration" => "300",
                        "hideDuration" => "1000",
                        "timeOut" => "5000",
                        "extendedTimeOut" => "1000",
                        "showEasing" => "swing",
                        "hideEasing" => "linear",
                        "showMethod" => "fadeIn",
                        "hideMethod" => "fadeOut",
                        'escapeHtml' => false,
                    ]
                ])
            ?>

            <div id="content">
                <?= $content ?>
            </div>
            
        </div>


        <footer class="bg-gray-900 text-white pt-4 pb-1 mt-5">
            <div class="container-xl">
                <div class="row justify-content-between">
                    <div class="col-12 col-sm-7 mb-1">
                        <div class="row justify-content-between">
                            <div class="col-auto col-sm-12 col-md-8 col-lg-6 col-xl-5">
                                <div class="mb-2">
                                    <?= Html::img('/images/logo/small_light.svg', [
                                            'id' => 'logo-small',
                                        ])
                                    ?>
                                </div>
                                <p class="h6 text-uppercase font-weight-light">
                                    <?= Yii::t('front', 'For ultra{0}high-net-worth{1}dogs', ['<br>', ' ']) ?>
                                </p>
                            </div>
                            <div class="col-auto col-md-4 col-lg-6 px-xl-0">
                                <div class="row h-100 align-items-end justify-content-center">
                            <?php
                                foreach (Yii::$app->params['apps'] as $name => $link) {
                            ?>
                                    <div class="col-auto mt-1 mt-md-0 mb-0_5 text-center">
                                        <a href="<?= $link ?>" target="_blank">
                                            <img src="/images/<?= $name ?>_white.png" class="img-fluid mb-0_25" style="width:150px">
                                        </a>
                                    </div>
                            <?php
                                }
                            ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-auto col-md-auto col-lg-auto col-xl-4">
                        <div class="row justify-content-between">
                            <div class="col-auto">
                        <?php
                            foreach ($footerMenuItems as $k => $menuItem) {   
                        ?>
                                <p class="mb-1">
                                    <a href="<?= $menuItem['url'] ?>" class="text-decoration-none font-weight-light text-nowrap text-white">
                                        <?= $menuItem['label'] ?>
                                    </a>
                                </p>
                                
                        <?php
                                if ($k == 2) {
                        ?>
                                    </div>
                                    <div class="col-auto pr-3 pr-lg-4">
                        <?php
                                }
                            }
                        ?>
                            </div>
                        </div>
                    </div>
                </div>
                <hr class="mb-2 border-gray-400">
                <div class="row justify-content-between">
                    <div class="col-auto mb-1">
                        <?= Html::a(Yii::t('front', 'Политика конфиденциальности'), [
                                '/privacy-policy'
                            ], [
                                'class' => 'text-decoration-none text-gray-400 font-weight-light m-0'
                            ])
                        ?>
                    </div>
                    <div class="col-auto mb-1">
                        <span class="text-gray-400 font-weight-light m-0">
                            © Copyright ume.tech <?= date('Y') ?>
                        </span>
                    </div>
                    <div class="col-auto mb-1 text-gray-400">
                        <?php
                            foreach (Yii::$app->params['socials'] as $socialName => $socialUrl) {
                                echo Html::a(Html::img('/images/socials/' . $socialName . '_light.svg', [
                                    'class' => 'footer-social-icon',
                                ]), $socialUrl, [
                                    'class' => 'mr-1',
                                    'target' => '_blank',
                                ]);
                            }
                        ?>
                    </div>
                    <div class="col-auto">
                        <a href="mailto:<?= Yii::$app->params['supportEmail'] ?>" class="text-gray-400 font-weight-light text-nowrap text-decoration-none m-0">
                            <?= Yii::$app->params['supportEmail'] ?>
                        </a>
                    </div>
                </div>
            </div>
        </footer>
        
        <div id="menu" class="modal fade side p-0" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog position-absolute top-0 bottom-0 left-0 border-0 m-0">
                <div class="modal-content m-0 border-0 vh-100 bg-secondary text-white rounded-0">
                    <div class="modal-header align-items-center justify-content-end flex-nowrap pl-1_5 pr-0_5 py-1 border-0">
                        <button type="button" class="btn btn-link p-0 float-none" data-dismiss="modal" aria-label="<?= Yii::t('front', 'Закрыть') ?>">
                            <svg width="53" height="53" viewBox="0 0 53 53" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <line x1="13.7891" y1="12.3744" x2="39.9521" y2="38.5373" stroke="white" stroke-width="2"/>
                                <line x1="12.3749" y1="38.5379" x2="38.5379" y2="12.3749" stroke="white" stroke-width="2"/>
                            </svg>
                        </button>
                    </div>
                    
                    <div class="modal-body d-flex align-items-center">
                        <ul class="nav flex-column my-auto w-100">
                            <?php                            
                                foreach ($menuItems as $menuItem) {
                                    $activeMenu = false;
                                    if (isset($menuItem['url'])) {
                                        $activeMenu = $menuItem['url'] == Url::to();
                                    }
                            ?>
                                    <li class="nav-item <?= $activeMenu ? 'active' : '' ?>">
                                    <?php
                                        if (isset($menuItem['url'])) {
                                    ?>
                                            <a href="<?= $menuItem['url'] ?>" class="nav-link text-uppercase text-white p-0 mx-1 my-1 <?= $menuItem['class'] ?> <?= $activeMenu ? 'text-underline' : 'text-decoration-none' ?>"
                                                <?php 
                                                    if (isset($menuItem['options'])) {
                                                        foreach ($menuItem['options'] as $optionKey => $optionVal) {
                                                            echo $optionKey . '="' . $optionVal . '" ';
                                                        }
                                                    }
                                                ?> 
                                            onclick="$('#menu').modal('hide');">
                                                <?= $menuItem['label'] ?>
                                            </a>
                                    <?php
                                        } else {
                                            echo $menuItem['label'];
                                        }
                                    ?>
                                    </li>
                            <?php
                                }
                            ?>
                        </ul>
                    </div>
                    
                    <div class="modal-footer justify-content-start">
                <?php
                    if ($langs) {
                        foreach ($langs as $key => $lang) {
                            if (Yii::$app->language != 'ru' && $lang['label'] == 'ru') {
                                continue;
                            }
                ?>
                            <div class="col-auto">
                                <?= Html::a($lang['label'], $lang['url'], [
                                        'class' => 'text-uppercase text-white ml-0_5 text-' . ($lang['active'] ? 'underline' : 'decoration-none')
                                    ]);
                                ?>
                            </div>
                <?php
                        }
                    }
                ?>
                    </div>
                    
                </div>
            </div>
        </div>
        
<?php
    if (!Yii::$app->session->get('cookiesNotificationShown')) {
        // echo $this->render('@frontend/views/layouts/_cookies');
    }
?>

    <!-- Yandex.Metrika counter -->
    <script type="text/javascript" >
       (function(m,e,t,r,i,k,a){m[i]=m[i]||function(){(m[i].a=m[i].a||[]).push(arguments)};
       m[i].l=1*new Date();
       for (var j = 0; j < document.scripts.length; j++) {if (document.scripts[j].src === r) { return; }}
       k=e.createElement(t),a=e.getElementsByTagName(t)[0],k.async=1,k.src=r,a.parentNode.insertBefore(k,a)})
       (window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym");

       ym(91867334, "init", {
            clickmap:true,
            trackLinks:true,
            accurateTrackBounce:true,
            webvisor:true,
            ecommerce:"dataLayer"
       });
    </script>
    <noscript><div><img src="https://mc.yandex.ru/watch/91867334" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
    <!-- /Yandex.Metrika counter -->
        
    <?php $this->endBody() ?>
    </body>
</html>
<?php $this->endPage() ?>
