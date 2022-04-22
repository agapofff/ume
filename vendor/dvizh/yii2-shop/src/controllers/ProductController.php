<?php
namespace dvizh\shop\controllers;

use Yii;
use dvizh\shop\models\Modification;
use dvizh\shop\models\Product;
use dvizh\shop\models\PriceType;
use dvizh\shop\models\Price;
use dvizh\shop\models\price\PriceSearch;
use dvizh\shop\models\product\ProductSearch;
use dvizh\shop\events\ProductEvent;
use dvizh\shop\models\modification\ModificationSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\UploadedFile;
use yii\helpers\Url;
use backend\models\Langs;
use backend\models\ShopProductToCategory;

class ProductController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => $this->module->adminRoles,
                    ]
                ]
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                    'edittable' => ['post'],
                ],
            ],
        ];
    }

    public function actionIndex()
    {
        $model = null;
        $searchModel = new ProductSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $models = $dataProvider->models;
        if(!empty($models)) $model = array_shift($models);
        $filters = \dvizh\filter\models\Filter::find()->all();
        $ignoreAttribute =  ['amount_in_stock', 'images'];
        
        $languages = Langs::find()->all();

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'model' => $model,
            'filters' => $filters,
            'ignoreAttribute' => $ignoreAttribute,
            'languages' => $languages,
        ]);
    }

    public function actionCreate()
    {
        $model = new Product;
        $priceModel = new Price;

        $priceTypes = PriceType::find()->orderBy('sort DESC')->all();
        
        $languages = Langs::find()->all();

        if ($model->load(Yii::$app->request->post())) {
            
            if ($model->save()){
                if($prices = Yii::$app->request->post('Price')) {
                    foreach($prices as $typeId => $price) {
                        $model->setPrice($price['price'], $typeId);
                    }
                }

                $module = $this->module;
                $productEvent = new ProductEvent(['model' => $model]);
                $this->module->trigger($module::EVENT_PRODUCT_CREATE, $productEvent);
                
                Yii::$app->session->setFlash('success', Yii::t('back', 'Элемент успешно создан'));
                
            } else {
                Yii::$app->session->setFlash('danger', Yii::t('back', 'Ошибка создания элемента'));
            }

            return $this->redirect(['update', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'priceModel' => $priceModel,
                'priceTypes' => $priceTypes,
                'languages' => $languages,
            ]);
        }
    }
	
	
	public function actionCopy($id)
	{
		$product = Product::findOne($id);
		$model = new Product();
		$model->attributes = $product->attributes;

		$categories = ShopProductToCategory::findAll([
			'product_id' => $product->id
		]);

		if ($model->save()){
			$module = $this->module;
			$productEvent = new ProductEvent(['model' => $model]);
			$this->module->trigger($module::EVENT_PRODUCT_CREATE, $productEvent);
			
			if ($categories){
				foreach ($categories as $category){
					$cat = new ShopProductToCategory();
					$cat->product_id = $model->id;
					$cat->category_id = $category->category_id;
					$cat->save();
				}
			}

			Yii::$app->session->setFlash('success', Yii::t('back', 'Элемент успешно скопирован'));
			return $this->redirect([
				'update',
				'id' => $model->id,
			]);
		} else {
			Yii::$app->session->setFlash('danger', Yii::t('back', 'Ошибка копирования элемента'));
			return $this->redirect(['index']);
		}
	}
	

    public function actionMassUpdate()
    {
        $partForm = null;
        $allEntities = null;
        $entitiesName = ['modelsId', 'attributes', 'otherEntities', 'filters', 'fields'];
        $postData = \Yii::$app->request->post();
        foreach ($entitiesName as $name) {
            $allEntities[$name] = explode(',', $postData[$name]);
        }
        $models = Product::findAll($allEntities['modelsId']);
        if(isset($postData['Product'])) {
            foreach ($models as $model) {
                $newData = $postData['Product'][$model->id];
                foreach ($newData as $name => $value) {
                    $model->$name = $value;
                }
                $model->save();
            }
            $models = Product::findAll($allEntities['modelsId']);
        }
        
        $languages = Langs::find()->all();

        return $this->render('_form-mass-update', [
            'models' => $models,
            'allEntities' => $allEntities,
            'entitiesName' => $entitiesName,
            'postData' => $postData,
            'languages' => $languages,
        ]);
    }

    public function actionUpdate($id)
    {
        $ref = Yii::$app->request->get('ref', Yii::$app->request->referrer);
        
        $priceModel = new Price;
        $searchModel = new PriceSearch();
        $model = $this->findModel($id);
        $typeParams = Yii::$app->request->queryParams;
        $typeParams['PriceSearch']['item_id'] = $id;
        $dataProvider = $searchModel->search($typeParams);

        $searchModificationModel = new ModificationSearch();
        $typeParams['ModificationSearch']['product_id'] = $id;
        $modificationDataProvider = $searchModificationModel->search($typeParams);
        $modificationModel = new Modification;
        
        $languages = Langs::find()->all();

        if ($model->load(Yii::$app->request->post())) {
            
            $model->videoFile = UploadedFile::getInstance($model, 'videoFile');
            if ($model->videoFile){
                $fileName = md5(date('YmdHis').rand(111,999));
                if ($model->uploadVideo($fileName)){
                    $model->video = '/video/' . $fileName . '.' . $model->videoFile->extension;
                } else {
                    Yii::$app->session->setFlash('danger', Yii::t('back', 'Ошибка загрузки видео'));
                }
                $model->videoFile = null;
            } else {
                $model->video = '';
            }
            
            if ($model->save()){
                
                $module = $this->module;
                $productEvent = new ProductEvent(['model' => $model]);
                $this->module->trigger($module::EVENT_PRODUCT_UPDATE, $productEvent);
                Yii::$app->session->setFlash('success', Yii::t('back', 'Изменения сохранены'));
                if ($model->saveAndExit){
                    return $this->redirect($ref != Url::current([], true) ? $ref : ['index']);
                }
                
            } else {
                Yii::$app->session->setFlash('danger', Yii::t('back', 'Ошибка сохранения'));
            }
            return $this->redirect(['update', 'id' => $model->id]);
            
        } else {
            
            return $this->render('update', [
                'model' => $model,
                'module' => $this->module,
                'modifications' => Modification::find()->where(['product_id' => $id])->all(),
                'modificationModel' => $modificationModel,
                'searchModificationModel' => $searchModificationModel,
                'modificationDataProvider' => $modificationDataProvider,
                'dataProvider' => $dataProvider,
                'searchModel' => $searchModel,
                'priceModel' => $priceModel,
                'languages' => $languages,
            ]);
        }
    }

    public function actionDelete($id)
    {
        if($model = $this->findModel($id)) {
            if ($this->findModel($id)->delete()){
                $module = $this->module;
                $productEvent = new ProductEvent(['model' => $model]);
                $this->module->trigger($module::EVENT_PRODUCT_DELETE, $productEvent);
                Yii::$app->session->setFlash('success', Yii::t('back', 'Элемент успешно удалён'));
            } else {
                Yii::$app->session->setFlash('danger', Yii::t('back', 'Ошибка удаления элемента'));
            }
        }

        return $this->redirect(['index']);
    }

    public function actionProductInfo()
    {
        $productCode = (int)Yii::$app->request->post('productCode');

        $model = new Product;

        if($model = $model::find()->where('code=:code OR id=:code', [':code' => $productCode])->one()) {
            $json = [
                'status' => 'success',
                'name' => $model->name,
                'code' => $model->code,
                'id' => $model->id,
            ];
        } else {
            $json = [
                'status' => 'fail',
                'message' => Yii::t('back', 'Not found')
            ];
        }

        die(json_encode($json));
    }

    protected function findModel($id)
    {
        $model = new Product;

        if (($model = $model::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionMassDeletion()
    {
        $postData = \Yii::$app->request->post();
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $model = $postData['model'];
        $modelId = $postData['modelId'];
        if(!empty($modelId)) {
            $ranks = $model::findAll($modelId);
            if(!empty($ranks)) {
                foreach ($ranks as $rank) {
                    $rank->delete();
                }
                return  true;
            }
        }

        return  false;
    }

    public function actionAvailable($id)
    {
        $model = Product::findOne($id);
        $model->available = $model->available ? 0 : 1;
        if ($model->save()){
            Yii::$app->session->setFlash('success', Yii::t('back', 'Изменения сохранены'));
        } else {
            Yii::$app->session->setFlash('danger', Yii::t('back', 'Ошибка сохранения'));
        }
        if (Yii::$app->request->isAjax){
            $this->actionIndex();
        } else {
            return $this->redirect(Yii::$app->request->referrer);
        }
    }
	
    public function actionActive($id)
    {
        $model = Product::findOne($id);
        $model->active = $model->active ? 0 : 1;
        if ($model->save()){
            Yii::$app->session->setFlash('success', Yii::t('back', 'Изменения сохранены'));
        } else {
            Yii::$app->session->setFlash('danger', Yii::t('back', 'Ошибка сохранения'));
        }
        if (Yii::$app->request->isAjax){
            $this->actionIndex();
        } else {
            return $this->redirect(Yii::$app->request->referrer);
        }
    }
	
    public function actionNew($id)
    {
        $model = Product::findOne($id);
        $model->is_new = $model->is_new ? 0 : 1;
        if ($model->save()){
            Yii::$app->session->setFlash('success', Yii::t('back', 'Изменения сохранены'));
        } else {
            Yii::$app->session->setFlash('danger', Yii::t('back', 'Ошибка сохранения'));
        }
        if (Yii::$app->request->isAjax){
            $this->actionIndex();
        } else {
            return $this->redirect(Yii::$app->request->referrer);
        }
    }
	
    public function actionPopular($id)
    {
        $model = Product::findOne($id);
        $model->is_popular = $model->is_popular ? 0 : 1;
        if ($model->save()){
            Yii::$app->session->setFlash('success', Yii::t('back', 'Изменения сохранены'));
        } else {
            Yii::$app->session->setFlash('danger', Yii::t('back', 'Ошибка сохранения'));
        }
        if (Yii::$app->request->isAjax){
            $this->actionIndex();
        } else {
            return $this->redirect(Yii::$app->request->referrer);
        }
    }
	
    public function actionPromo($id)
    {
        $model = Product::findOne($id);
        $model->is_promo = $model->is_promo ? 0 : 1;
        if ($model->save()){
            Yii::$app->session->setFlash('success', Yii::t('back', 'Изменения сохранены'));
        } else {
            Yii::$app->session->setFlash('danger', Yii::t('back', 'Ошибка сохранения'));
        }
        if (Yii::$app->request->isAjax){
            $this->actionIndex();
        } else {
            return $this->redirect(Yii::$app->request->referrer);
        }
    }

}
