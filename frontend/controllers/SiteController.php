<?php
namespace frontend\controllers;

// use frontend\models\ResendVerificationEmailForm;
// use frontend\models\VerifyEmailForm;
use Yii;
use yii\base\InvalidArgumentException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\db\Expression;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\Product;
use dvizh\shop\models\product\ProductSearch;
use yii\db\Query;
use yii\helpers\ArrayHelper;
use dektrium\user\models\Profile;
use dektrium\user\models\User;
use frontend\models\Pages;
use backend\models\Countries;
use backend\models\Cities;
use backend\models\Addresses;
use backend\models\NewsCategories;
use backend\models\News;
use backend\models\Actions;


/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'signup'],
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            // 'verbs' => [
                // 'class' => VerbFilter::className(),
                // 'actions' => [
                    // 'logout' => ['post'],
                // ],
            // ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        $products = Product::find()
            ->where([
                'is_promo' => 1,
                'active' => 1
            ])
            ->orderBy(new Expression('rand()'))
            // ->limit(16)
            ->all();
            
        $modifications = Product::getAllProductsPrices($collectionProductsIDs);

        $modificationsPrices = ArrayHelper::map($modifications, 'product_id', 'price');
        $modificationsOldPrices = ArrayHelper::map($modifications, 'product_id', 'price_old');
            
        Yii::$app->params['currency'] = \backend\models\Langs::findOne([
            'code' => Yii::$app->language
        ])->currency;
            
        return $this->render('index', [
            'products' => $products,
            'prices' => $modificationsPrices,
            'prices_old' => $modificationsOldPrices,
        ]);
        
    }
    
    public function actionBlog()
    {
        $categories = NewsCategories::findAll([
            'active' => 1
        ]);
        
        $posts = News::find()
            ->where([
                'active' => 1
            ])
            ->orderBy([
                'date_published' => SORT_DESC
            ])
            ->limit(6)
            ->all();
            
        $actions = Actions::find()
            ->where([
                'active' => 1
            ])
            ->orderBy([
                'published' => SORT_DESC
            ])
            ->limit(4)
            ->all();
        
        return $this->render('blog', [
            'categories' => $categories,
            'posts' => $posts,
            'actions' => $actions,
        ]);
    }
    
    
    public function actionAbout()
    {
        return $this->render('about');
    }

    
    public function actionCookiesNotificationShown()
    {
        Yii::$app->session->set('cookiesNotificationShown', true);
        return true;
    }
    
    
    public function actionSitemap()
    {
        $categories = \dvizh\shop\models\Category::buildTree(true);
        return $this->render('sitemap', [
            'categories' => $categories,
        ]);
    }

}
