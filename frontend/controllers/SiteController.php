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
use dvizh\shop\models\Price;
use dvizh\shop\models\Product;
use dvizh\shop\models\product\ProductSearch;
use yii\db\Query;
use yii\helpers\ArrayHelper;
use yii\helpers\VarDumper;
use dektrium\user\models\Profile;
use dektrium\user\models\User;
use frontend\models\Pages;
use backend\models\Countries;
use backend\models\Cities;
use backend\models\Addresses;
use backend\models\NewsCategories;
use backend\models\News;
use backend\models\Actions;
use backend\models\Langs;
use backend\models\Reviews;
use backend\models\Banners;


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
        $products = [];
        
        $promoProducts = Product::find()
            ->where([
                'is_promo' => 1,
                'active' => 1
            ])
            ->orderBy(new Expression('rand()'))
            ->limit(8)
            ->all();
            
        $priceType = Price::findOne([
            'name' => Yii::$app->language
        ])->type_id;
            
        foreach ($promoProducts as $product) {
            $priceModel = $product->getPriceModel($priceType);
            if ($priceModel->available && $priceModel->price){
                $products[] = $product;
            }
        }
            
        Yii::$app->params['currency'] = Langs::findOne([
            'code' => Yii::$app->language
        ])->currency;
        
        $news = News::find()
            ->where([
                'active' => 1
            ])
            ->orderBy([
                'date_published' => SORT_DESC
            ])
            ->limit(3)
            ->all();
            
        $reviews = Reviews::find()
            ->where([
                'active' => 1,
                'language' => Yii::$app->language,
            ])
            ->orderBy([
                'created' => SORT_DESC
            ])
            ->limit(10)
            ->all();
            
        $banners = Banners::findAll([
            'active' => 1,
            'category' => 'Каталог на Главной',
        ]);
            
        return $this->render('index', [
            'products' => $products,
            'news' => $news,
            'reviews' => $reviews,
            'banners' => $banners,
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
