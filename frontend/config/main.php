<?php
use yii\db\Query;
use yii\web\Cookie;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use yii\helpers\VarDumper;
use backend\models\Langs;
use backend\models\Stores;
use backend\models\MetaTags;
use backend\models\Promocodes;
use backend\models\Redirects;
use backend\models\Addresses;
use frontend\models\PhoneCodes;
use dvizh\filter\models\Product;
use dvizh\filter\models\FilterVariant;
use dektrium\user\models\User;
use dektrium\user\controllers\RegistrationController;
use dektrium\user\controllers\SecurityController;
use backend\models\Bonus;
use dvizh\shop\models\Price;

$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [

    'basePath' => dirname(__DIR__),
    'bootstrap' => [
        'assetsAutoCompress',
        // 'log',
        'languagesDispatcher',
        'devicedetect',
    ],
    'controllerNamespace' => 'frontend\controllers',
    'sourceLanguage' => 'ru',
    'language' => 'ru',
    'on beforeRequest' => function () {
        
        $pathInfo = Yii::$app->request->pathInfo;
        $query = Yii::$app->request->queryString;
        if (!empty($pathInfo) && substr($pathInfo, -1) === '/') {
            $url = '/' . substr($pathInfo, 0, -1);
            if ($query) {
                $url .= '?' . $query;
            }
            Yii::$app->response->redirect($url, 301);
            Yii::$app->end();
        }
        
        // кладём активные языки в параметры
        $languages = Langs::findAll([
            'active' => 1,
            'available' => 1,
        ]);
        Yii::$app->params['languages'] = ArrayHelper::map($languages, 'code', 'code');
        
        // добавляем активные языки из базы в модуль переключения языков
        // $langs = Yii::$app->db
            // ->createCommand('SELECT * FROM {{%langs}} WHERE publish = 1')
            // ->queryAll();
        // $languages = \Yii\helpers\ArrayHelper::map($langs, 'code', 'code');
        // Yii::$app->getModule('languages')->languages = $languages;
        
        
        // 301-е редиректы
        if (Yii::$app->request->pathInfo) {
            $query = Redirects::getDb()->cache(
                fn() => Redirects::find()
                    ->where([
                        'active' => 1,
                        'link_from' => Yii::$app->request->absoluteUrl
                    ])
                    ->one()
            );
                
            if (!$query) {
                $query = Redirects::getDb()->cache(
                    fn() => Redirects::find()
                        ->where([
                            'active' => 1
                        ])
                        ->andWhere([
                            'like', 'link_from', Yii::$app->request->pathInfo
                        ])
                        ->one()
                );
            }
            
            if ($query) {
                Yii::$app->getResponse()->redirect($query['link_to'], 301);
                Yii::$app->end();
            }
        }

        $redirect = false;
        
        // кладём валюту магазина в параметры 
        // $lang = Yii::$app->db
            // ->createCommand('SELECT * FROM {{%langs}} WHERE code = :code')
            // ->bindValue(':code', Yii::$app->language)
            // ->queryOne();
        // if (Yii::$app->request->cookies->getValue('currency') != $lang['currency']) {
            // Yii::$app->response->cookies->add(new \yii\web\Cookie([
                // 'name' => 'currency',
                // 'value' => $lang['currency'],
            // ]));
            // $redirect = true;
        // }
        
        // Yii::$app->params['currency'] = Yii::$app->request->cookies->getValue('currency');
        // Yii::$app->params['currency'] = $lang['currency'];
        
        
        $store_type = Yii::$app->params['default_store_type'];
        
        // кладём дефолтный тип магазина в куки
        
        if (!Yii::$app->request->cookies->has('store_type')) {
            Yii::$app->response->cookies->add(new Cookie([
                'name' => 'store_type',
                'value' => $store_type,
            ]));
            // $redirect = true;
        }
        
        
        // получаем промо-код
        $promo = Yii::$app->request->get('promo');
        
        // кладём промокод в куки
        if ($promo && Yii::$app->request->cookies->getValue('promo') != $promo) {
            Yii::$app->response->cookies->add(new Cookie([
                'name' => 'promo',
                'value' => $promo,
            ]));
            $redirect = true;
        }
        
        // переключение магазина
        if ($promo) {
            $store = Promocodes::getDb()->cache(
                fn() => Promocodes::find()
                    ->where('code = :code', [
                        ':code' => $promo
                    ])
                    ->one()
            );
            
            if ($store) {
                $store_type = $store->type;
                if (Yii::$app->request->cookies->getValue('store_type') != $store_type) {
                    Yii::$app->response->cookies->add(new Cookie([
                        'name' => 'store_type',
                        'value' => $store_type,
                    ]));
                    // Yii::$app->cart->truncate();
                    $redirect = true;
                }
            }
        }
        
        
        // обработка ссылок из приложения
        if ($storeId = Yii::$app->request->get('store')) {
            $store = Stores::getDb()->cache(
                fn() => Stores::find()
                    ->where('store_id = :store_id', [
                        ':store_id' => $storeId
                    ])
                    ->one()
            );
                
            if ($store) {
                $store_type = $store->type;
                if (Yii::$app->request->cookies->getValue('store_type') != $store_type) {
                    Yii::$app->response->cookies->add(new Cookie([
                        'name' => 'store_type',
                        'value' => $store_type,
                    ]));
                    // Yii::$app->cart->truncate();
                    $redirect = true;
                }
            }
        }
       
        
        if ($redirect) {
            Yii::$app->response->redirect(Yii::$app->request->absoluteUrl, 301)->send();
            Yii::$app->end();
        }


        Yii::$app->params['store_type'] = Yii::$app->request->cookies->getValue('store_type', $store_type);

        
        // МЕТА-параметры
        $meta = MetaTags::getDb()->cache(
            fn() => MetaTags::find()
                ->where('link = :link', [
                    ':link' => Yii::$app->request->absoluteUrl
                ])
                ->andWhere([
                    'active' => 1
                ])
                ->one()
        );
            
        if ($meta) {
            if ($meta->title) {
                Yii::$app->params['title'] = $meta->title;
            }
            if ($meta->description) {
                Yii::$app->params['description'] = $meta->description;
            }
            if ($meta->h1) {
                Yii::$app->params['h1'] = $meta->h1;
            }
        }


        // кладём валюту магазина в параметры
        $currency = Langs::findOne([
            'code' => $langCode,
        ])->currency;
        
        if ($currency) {
            Yii::$app->params['currency'] = $currency;
        }
    },
            

    'on afterAction' => function () {
        $store = Stores::findOne([
            'type' => Yii::$app->params['store_type'],
            'lang' => Yii::$app->language
        ]);
        
        // переадресация главных страниц на языковую локаль
        if (strpos(Yii::$app->request->absoluteUrl, Yii::$app->language) === false) {
            $homeUrl = Url::home(true);
            $localeUrl = preg_replace("#/$#", "", str_replace($homeUrl, $homeUrl . Yii::$app->language . '/', Yii::$app->request->absoluteUrl));

            Yii::$app->response->redirect($localeUrl, 301);
            Yii::$app->end();
        }
        
        // $langs = \backend\models\Langs::find()->select('code')->column();
        // if (empty(array_intersect(explode('/', Yii::$app->request->absoluteUrl), $langs))) {
            // Yii::$app->response->redirect($localeUrl, 301);
            // Yii::$app->end();
        // }
        

        // кладём валюту в сессию

        // $currency = \backend\models\Langs::findOne([
            // 'code' => Yii::$app->language
        // ])->currency;
        
        // if (!Yii::$app->request->cookies->has('currency') || Yii::$app->request->cookies->getValue('currency') != $currency) {
            // Yii::$app->response->cookies->add(new \yii\web\Cookie([
                // 'name' => 'currency',
                // 'value' => $currency,
            // ]));
            // Yii::$app->getResponse()->redirect(Yii::$app->request->absoluteUrl, 301);
            // Yii::$app->end();
        // }
        
        
        // транкейт корзины при несовпадении языка или типа магазина
        if ($cartElements = Yii::$app->cart->elements) {
            foreach ($cartElements as $element) {
                $productID = $element->comment;
                $cartElementStoreId = Price::findOne(['code' => $element->comment])->name;
                if ((float)$cartElementStoreId != (float)$store->store_id) {
                    Yii::$app->cart->truncate();
                    Yii::$app->response->redirect('/catalog')->send();
                }
            }
        }
        
        
        // кладём язык в базу
        if (!Yii::$app->user->isGuest) {
            $user = User::getDb()->cache(fn() => User::findOne(Yii::$app->user->identity->id));
            if ($user->lang != Yii::$app->language) {
                $user->lang = Yii::$app->language;
                $user->save();
            }
        }
    },
    
    'modules' => [
        'user' => [
            'class' => 'dektrium\user\Module',
            'admins' => ['admin'],
            'enableGeneratingPassword' => false,
            'controllerMap' => [
                'registration' => [
                    'class' => RegistrationController::className(),
                    'on ' . RegistrationController::EVENT_AFTER_CONFIRM => function ($e) {
                        if (Yii::$app->user->identity->referal) {
                            if ($user = User::findOne(base64_decode(Yii::$app->user->identity->referal))) {
                                $addBonus = new Bonus();
                                $addBonus->attributes = [
                                    'active' => 1,
                                    'user_id' => $user->id,
                                    'type' => 1,
                                    'amount' => 5,
                                    'reason' => 0,
                                    'description' => (string) Yii::$app->user->id,
                                    'created_at' => date('Y-m-d H:i:s'),
                                    'updated_at' => date('Y-m-d H:i:s'),
                                ];
                                $addBonus->save();
                            }
                        }
                    },
                ],
                'security' => [
                    'class' => SecurityController::className(),
                    'on ' . SecurityController::EVENT_AFTER_LOGIN => function ($e) {
// echo \yii\helpers\VarDumper::dump(Yii::$app->request->getBodyParam('ref'), 999, true); exit;
                        Yii::$app->response->redirect(Yii::$app->request->getBodyParam('ref'))->send();
                    }
                ],
            ],
        ],     
    ],
    
    'components' => [
    
        'request' => [
            'baseUrl' => '',
            // 'class' => 'klisl\languages\Request',
            'csrfParam' => '_csrf-frontend',
            'cookieValidationKey' => 'Rb96MyfFjM3RfzzXQDD5kzgwzlPYFbv6',
            // 'enableCookieValidation' => false,
        ],
        
        'assetManager' => [
            'class' => 'yii\web\AssetManager',
            'bundles' => [
                'yii\bootstrap\BootstrapAsset' => false,
                'yii\bootstrap\BootstrapAssetPlugin' => false,
                'dvizh\filter\assets\Asset' => false,
                'dvizh\cart\assets\WidgetAsset' => [
                    'css' => [],
                    'depends' => [
                        'yii\web\JqueryAsset',
                    ],
                ],
                'dvizh\shop\assets\ModificationConstructAsset' => [
                    'css' => [],
                    'depends' => [
                        'yii\web\JqueryAsset',
                    ],
                ],
                'dvizh\filter\assets\FrontendAsset' => false,
                'dvizh\filter\assets\FrontendAjaxAsset' => false,
            ],
            'linkAssets' => false,
        ],
        
        'cache' => [
            // 'class' => 'yii\caching\FileCache',
            'class' => 'yii\caching\DummyCache',
        ],
        
        /*
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-frontend', 'httpOnly' => true],
        ],
        */
        
        'session' => [
            'name' => 'ume-frontend',
        ],
        
        // 'log' => [
            // 'traceLevel' => YII_DEBUG ? 3 : 0,
            // 'targets' => [
                // [
                    // 'class' => 'yii\log\FileTarget',
                    // 'levels' => ['error', 'warning'],
                // ],
            // ],
        // ],
        
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        
        'view' => [
            'theme' => [
                'pathMap' => [
                    '@dektrium/user/views' => '@frontend/views/user',
                    '@vendor/dvizh/yii2-order/src/widgets/views' => '@frontend/views/yii2-order',
                    '@vendor/dvizh/yii2-filter/src/widgets' => '@frontend/views/yii2-filter',
                ],
            ],
        ],
        
        'languagesDispatcher' => [
            'class' => 'cetver\LanguagesDispatcher\Component',
            'languages' => function () {
                return Yii::$app->urlManager->languages;
            },
            // Order is important
            'handlers' => [
                [
                    // Detects a language based on host name
                    'class' => 'cetver\LanguagesDispatcher\handlers\HostNameHandler',
                    'request' => 'request', // optional, the Request component ID.                    
                    'hostMap' => function () {
                        $langs = Yii::$app->urlManager->languages;
                        $hostMap = [];
                        foreach ($langs as $lang) {
                            $hostMap[Url::to(['/'], true) . $lang] = $lang;
                        }
                        return $hostMap;
                    }
                    // 'hostMap' => [ // An array that maps hostnames to languages or a callable function that returns it.
                        // 'en.example.com' => 'en',
                        // 'ru.example.com' => 'ru'
                    // ]
                ],
                [
                    // Detects a language from the query parameter.
                    'class' => 'cetver\LanguagesDispatcher\handlers\QueryParamHandler',
                    'request' => 'request', // optional, the Request component ID.
                    'queryParam' => 'language' // optional, the query parameter name that contains a language.
                ],
                [
                    // Detects a language from the session.
                    // Writes a language to the session, regardless of what handler detected it.
                    'class' => 'cetver\LanguagesDispatcher\handlers\SessionHandler',
                    'session' => 'session', // optional, the Session component ID.
                    'key' => 'language' // optional, the session key that contains a language.
                ],
                [
                    // Detects a language from the cookie.
                    // Writes a language to the cookie, regardless of what handler detected it.
                    'class' => 'cetver\LanguagesDispatcher\handlers\CookieHandler',
                    'request' => 'request', // optional, the Request component ID.
                    'response' => 'response', // optional, the Response component ID.
                    'cookieConfig' => [ // optional, the Cookie component configuration.
                        'class' => 'yii\web\Cookie',
                        'name' => 'language',
                        'domain' => '',
                        'expire' => strtotime('+1 year'),
                        'path' => '/',
                        'secure' => true | false, // depends on Request::$isSecureConnection
                        'httpOnly' => true,
                    ]
                ],
                [
                    // Detects a language from an authenticated user.
                    // Writes a language to an authenticated user, regardless of what handler detected it.
                    // Note: The property "identityClass" of the "User" component must be an instance of "\yii\db\ActiveRecord"
                    'class' => 'cetver\LanguagesDispatcher\handlers\UserHandler',
                    'user' => 'user',  // optional, the User component ID.
                    'languageAttribute' => 'language_code' // optional, an attribute that contains a language.
                ],
                [
                    // Detects a language from the "Accept-Language" header.
                    'class' => 'cetver\LanguagesDispatcher\handlers\AcceptLanguageHeaderHandler',
                    'request' => 'request', // optional, the Request component ID.
                ],
                [
                    // Detects a language from the "language" property.
                    'class' => 'cetver\LanguagesDispatcher\handlers\DefaultLanguageHandler',
                    'language' => 'ru' // the default language.
                    /*
                    or
                    'language' => function () {
                        return \app\models\Language::find()
                            ->select('code')
                            ->where(['is_default' => true])
                            ->createCommand()
                            ->queryScalar();
                    },
                    */
                ]

            ],
        ],
        
        'assetsAutoCompress' => [
            'class' => '\skeeks\yii2\assetsAuto\AssetsAutoCompressComponent',
            'enabled' => true, // YII_ENV_DEV ? false : true,
            'readFileTimeout' => 3,
            'jsCompress' => true,
            'jsCompressFlaggedComments' => true,
            'cssCompress' => true,
            'cssFileCompile' => true,
            'cssFileRemouteCompile' => false,
            'cssFileCompress' => true,
            'cssFileBottom' => false,
            'cssFileBottomLoadOnJs' => false,
            'jsFileCompile' => true,
            'jsFileRemouteCompile' => false,
            'jsFileCompress' => true,
            'jsFileCompressFlaggedComments' => false,
            'noIncludeJsFilesOnPjax' => true,
            'noIncludeCssFilesOnPjax' => true,
            'htmlFormatter' => [
                'class' => 'skeeks\yii2\assetsAuto\formatters\html\TylerHtmlCompressor',
                'extra' => true,
                'noComments' => true,
                'maxNumberRows' => 5000000,
            ],
        ],
        
        'devicedetect' => [
            'class' => 'alexandernst\devicedetect\DeviceDetect'
        ],

        'urlManager' => [           
            'class' => 'cetver\LanguageUrlManager\UrlManager',
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'enableStrictParsing' => false,
            'languages' => function () {
                return Langs::find()
                    ->select('code')
                    ->where([
                        'active' => 1,
                        'available' => 1,
                    ])
                    ->column();
            },
            'existsLanguageSubdomain' => false,
            'blacklist' => [

            ],
            'queryParam' => 'language',            
            'normalizer' => [
                'class' => 'yii\web\UrlNormalizer',
                'normalizeTrailingSlash' => true,
                'collapseSlashes' => true,
            ],
            'rules' => [
                // 'languages' => 'languages/default/index', //для модуля мультиязычности KLISL
                
                '/' => 'site/index',
                
                'login' => 'user/security/login',
                'logout' => 'user/security/logout',
                'register' => 'user/registration/register',
                'resend' => 'user/registration/resend',
                'request' => 'user/recovery/request',
                'account' => 'site/account',
                // 'account/edit' => 'user/settings/profile',
                'account/edit' => 'user/settings/account',
                
                'join/<referal>' => 'site/join',
                
                // 'catalog' => 'catalog/index',
                // 'catalog/<slug>' => 'catalog/index',
                // 'catalog/<slug>/<collection>' => 'catalog/index',
                // '<catalog:(slug)>' => 'catalog/index',
                
                'catalog' => 'catalog/index',
                'catalog/<slug>' => 'catalog/category',
                // [
                    // 'pattern' => 'catalog/<collectionSlug>/<categorySlug>',
                    // 'route' => 'catalog',
                    // 'defaults' => [
                        // 'collectionSlug' => null,
                        // 'categorySlug' => null,
                    // ],
                // ],
                
                'product/<slug>' => 'product/index',
                
                'checkout' => 'checkout/index',
                'checkout/pay' => 'checkout/pay',
                'checkout/error' => 'checkout/error',
                'checkout/success' => 'checkout/success',
                
                'cookies-notification-shown' => 'site/cookies-notification-shown',

                'about' => 'site/about',
                'history' => 'site/history',
                'bonus' => 'site/bonus',

                // 'orders' => 'orders/index',
                'orders/<id>' => 'orders/view',
                // 'blog' => 'site/blog',
                'news' => 'news/index',
                'news/<slug>' => 'news/post',
                
                'actions' => 'actions/index',
                'actions/<slug>' => 'actions/view',
                
                'synchro' => 'synchro/index', // !!!!!!!!!!!!!!!!!!!!!!!!!
                
                'facebook-conversions' => 'facebook-conversions/index',
                
                'sitemap' => 'site/sitemap',
                
                'curl' => 'curl/index',
                
                // 'wishlist' => 'wishlist/index',

                // '<controller>/<action>' => '<controller>/<action>',
                '<slug>' => 'pages/index',
                
                
                
                // '<lang:([a-z]{2,3}(-[A-Z]{2})?)>/<controller>/<action>/' => '<controller>/<action>',
                // '<action:(contact|language|about|signup|test)>' => 'site/<action>',
            ],
            
        ],

    ],

    'params' => $params,
];
