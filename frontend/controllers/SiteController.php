<?php
namespace frontend\controllers;

// use frontend\models\ResendVerificationEmailForm;
// use frontend\models\VerifyEmailForm;
use Yii;
use yii\base\InvalidArgumentException;
use yii\web\BadRequestHttpException;
use yii\web\ForbiddenHttpException;
use yii\web\NotFoundHttpException;
use yii\web\Controller;
use yii\db\Expression;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use dvizh\shop\models\Category;
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
use backend\models\Breeds;
use backend\models\Bonus;
use backend\models\Stores;


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
                        'actions' => ['account', 'logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
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
        
        
        // временно - вывод на главной только влажного корма
        
        $category = Category::findOne(27);

        $store = Stores::findOne([
            'lang' => Yii::$app->language,
            'type' => Yii::$app->params['store_type']
        ]);
        
        $prices = Price::find()
            ->where([
                'name' => $store->store_id
            ])
            ->asArray()
            ->all();

        $products = $category->products;
            
        return $this->render('index', [
            'news' => $news,
            'reviews' => $reviews,
            'banners' => $banners,
            'products' => $products,
            'category' => $category,
            'store' => $store,
            'prices' => ArrayHelper::index($prices, 'item_id'),
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
    
    public function actionAccount()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(['/login']);
        }
        
        $user = Yii::$app->user->identity;
        $userBonus = Bonus::getUserBonus(Yii::$app->user->id);
        $profile = Yii::$app->user->identity->profile;
        
        $breed = $profile->breed ? Breeds::findOne($profile->breed)->name : null;
        
        $breeds = Breeds::find()
            ->where([
                'active' => 1
            ])
            ->indexBy('id')
            ->asArray()
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
            
        $friends = User::find()
            ->where([
                'referal' => base64_encode(Yii::$app->user->id),
            ])
            ->orWhere([
                'id' => base64_decode(Yii::$app->user->identity->referal),
            ])
            ->all();
        
        return $this->render('account', [
            'user' => $user,
            'profile' => $profile,
            'breed' => $breed,
            'breeds' => $breeds,
            'actions' => $actions,
            'friends' => $friends,
            'userBonus' => $userBonus,
        ]);
    }
    
    
    public function actionAbout()
    {
        return $this->render('about');
    }    
    
    public function actionBonus()
    {
        return $this->render('bonus');
    }    
    
    public function actionHistory()
    {
        return $this->render('history');
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
    
    public function actionJoin()
    {
        return Yii::$app->response->redirect([
            'register',
            'referal' => Yii::$app->request->get('referal')
        ]);
    }

}
