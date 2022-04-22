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
// use frontend\models\Votes;
// use frontend\models\MarsForm;
use frontend\models\Help;
// use backend\models\Boutiques;
use backend\models\Countries;
use backend\models\Cities;
use backend\models\Addresses;


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
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
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
    
    
    public function actionContacts()
    {
        $countries = Countries::find()
            ->where([
                'active' => 1
            ])
            ->orderBy([
                'ordering' => SORT_ASC
            ])
            ->all();
        
        $cities = Cities::find()
            ->where([
                'active' => 1
            ])
            ->orderBy([
                'ordering' => SORT_ASC
            ])
            ->all();
        
        $addresses = Addresses::find()
            ->where([
                'active' => 1
            ])
            ->orderBy([
                'ordering' => SORT_ASC
            ])
            ->all();
        
        return $this->render('contacts', [
            'countries' => $countries,
            'cities' => $cities,
            'addresses' => $addresses,
        ]);
    }
    
    
    public function actionHelp()
    {
        $models = Help::find()
            ->where([
                'active' => 1
            ])
            ->orderBy([
                'ordering' => SORT_ASC
            ])
            ->all();
        
        return $this->render('help', [
            'models' => $models,
        ]);
    }
    
    
    public function actionGps()
    {
        $gps = Pages::findOne([
            'slug' => 'gps'
        ]);
        
        return $this->render('gps', [
            'gps' => $gps,
        ]);
    }
    
    
    public function actionAbout($v = 2)
    {
        return $this->render('about' . $v);
    }
    
    
    // public function actionVote()
    // {
        // $question_id = Yii::$app->request->post('question_id');
        // $answer_id = Yii::$app->request->post('answer_id');
        // $ip = Yii::$app->request->userIP;
        // $now = date('Y-m-d H:i:s');

        // $voted = Votes::find()
            // ->where([
                // 'question_id' => $question_id,
                // 'ip' => $ip,
            // ])
            // ->one();
            
        // $model = $voted ?: new Votes();
        
        // $model->attributes = [
            // 'question_id' => $question_id,
            // 'answer_id' => $answer_id,
            // 'ip' => $ip,
            // 'created_at' => $voted ? $model->created_at : $now,
            // 'updated_at' => $now,
        // ];

        // if ($model->save()) {
            // $results = json_encode($model->getResults($question_id));
            // $response = [
                // 'status' => 'success',
                // 'message' => Yii::t('front', 'Спасибо, Ваш голос принят'),
                // 'script' => 'showVoteResults(' . $results . ');',
            // ];
        // } else {
            // $response = [
                // 'status' => 'error',
                // 'message' => Yii::t('front', 'Произошла ошибка! Пожалуйста, попробуйте еще раз чуть позже'),
            // ];
        // }
        
        // return $this->asJson($response);
    // }
    
    
    // public function actionFashionShow()
    // {
        // if (Yii::$app->request->isPost) {
            // $profile = Profile::findOne([
                // 'user_id' => Yii::$app->user->id
            // ]);
            // $profile->lottery = 'on';
            
            // if ($profile->save()) {
                // Yii::$app->session->setFlash('success', Yii::t('front', 'Вы успешно зарегистрировались в конкурсе на посещение показа'));
            // } else {
                // Yii::$app->session->setFlash('error', Yii::t('front', 'Произошла ошибка! Пожалуйста, попробуйте еще раз чуть позже'));
            // }
        // }
        
        // return $this->render('show-info');
    // }
    
    
    // public function actionMarsForm()
    // {        
        // $model = MarsForm::find()
            // ->where([
                // 'OR',
                // ['=', 'user_id', Yii::$app->user->id],
                // ['=', 'session', Yii::$app->session->getId()],
                // ['=', 'ip', Yii::$app->request->userIP]
            // ])
            // ->one();
        // $sent = false;
        // if ($model) {
            // $sent = true;
        // } else {
            // $model = new MarsForm();

            // $model->session = Yii::$app->session->getId();
            // $model->ip = Yii::$app->request->userIP;
            // $model->created_at = $model->updated_at = date('Y-m-d H:i:s');
            // $model->gender = 1;
            
            // if (!Yii::$app->user->isGuest) {
                // $profile = Profile::findOne([
                    // 'user_id' => Yii::$app->user->id
                // ]);
                // $model->name = $profile->first_name . ' ' . $profile->last_name;
                // $model->gender = $profile->sex;
                // $model->email = Yii::$app->user->identity->email;
                // $model->user_id = Yii::$app->user->id;
            // }
            
            // if ($model->load(Yii::$app->request->post())) {            
                // if ($model->save())
                // {
                    // $mail = Yii::$app->mailer->compose('@common/mail/registrationToMars', [
                            // 'model' => $model,   
                        // ])
                        // ->setFrom([
                            // Yii::$app->params['senderEmail'] => Yii::$app->params['senderName']
                        // ])
                        // ->setTo($model->email)
                        // ->setReplyTo(Yii::$app->params['senderEmail'])
                        // ->setSubject(Yii::t('front', 'Заявка на участие в экспедиции') . ' - ' . Yii::$app->name)
                        // ->send();
                        
                    // $mail = Yii::$app->mailer->compose()
                        // ->setFrom([
                            // Yii::$app->params['senderEmail'] => Yii::$app->params['senderName']
                        // ])
                        // ->setTo(Yii::$app->params['adminEmail'])
                        // ->setReplyTo(Yii::$app->params['senderEmail'])
                        // ->setSubject(Yii::t('front', 'Заявка на участие в экспедиции') . ' - ' . Yii::$app->name)
                        // ->setHtmlBody('
                            // <p>Имя: ' . $model->name . '</p>
                            // <p>Пол: ' . ($model->gender ? 'Мужской' : 'Женский') . '</p>
                            // <p>Страна: ' . $model->country . '</p>
                            // <p>Язык: ' . $model->language . '</p>
                            // <p>Возраст: ' . $model->age . '</p>
                            // <p>E-mail: ' . $model->email . '</p>
                        // ')
                        // ->send();
                    
                    // $sent = true;
                    // Yii::$app->session->setFlash('success', Yii::t('front', 'Ваша заявка на участие в экспедиции на Марс была успешно отправлена'));
                // } else {
                    // Yii::$app->session->setFlash('error', Yii::t('front', 'Произошла ошибка! Пожалуйста, попробуйте еще раз чуть позже'));
                // }
            // }
        // }
        
        // return $this->render('mars-form', [
            // 'model' => $model,
            // 'sent' => $sent,
        // ]);
    // }
    
    
    // public function actionBoutiques($slug)
    // {
        // $boutiques = Boutiques::find()
            // ->where([
                // 'active' => 1,
            // ])
            // ->andWhere('category = :slug', [
                // ':slug' => $slug
            // ])
            // ->all();
        
        // return $this->render('boutiques', [
            // 'boutiques' => $boutiques,
            // 'category' => $slug,
        // ]);
    // }
    
    
    // public function actionAboutMars()
    // {
        // return $this->render('about-mars');
    // }
    
    
    // public function actionLookbook()
    // {
        // $images = [
            // 'DSC06241',
            // 'DSC06129',
            // 'DSC06141',
            // 'DSC06169',
            // 'DSC06303',
            // 'DSC06235',
            // 'DSC06151',
            // 'DSC06361',
            // 'DSC06112',
            // 'DSC06322',
            // 'DSC06121',
            // 'DSC06138',
            // 'DSC06428',
            // 'DSC06274',
            // 'DSC06178',
            // 'DSC06102',
            // 'DSC06373',
            // 'DSC06397',
            // 'DSC06436',
            // 'DSC06312',
            // 'DSC06183',
            // 'DSC05999-2',
            // 'DSC06017',
            // 'DSC05967',
            // 'DSC05987',
            // 'DSC05946',
            // 'DSC06080',
            // 'DSC05957',
            // 'DSC06003',
            // 'DSC05979',
            // 'DSC06023',
            // 'DSC06067',
            // 'DSC06009',
            // 'DSC06061',
            // 'DSC05951',
            // 'DSC06016',
        // ];
        
        // return $this->render('lookbook', [
            // 'images' => $images
        // ]);
    // }
    
    
    
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
