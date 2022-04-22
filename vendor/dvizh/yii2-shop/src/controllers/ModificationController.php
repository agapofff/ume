<?php
namespace dvizh\shop\controllers;

use dvizh\shop\models\Modification;
use dvizh\shop\models\Product;
use dvizh\shop\models\ModificationToOption;
use yii\helpers\Url;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use Yii;
use yii\helpers\Html;

use dvizh\filter\models\FilterVariant;

use backend\models\Stores;

class ModificationController extends Controller
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
                    // 'delete' => ['post'],
                    'edittable' => ['post'],
                ],
            ],
        ];
    }

    public function actionAddPopup($productId)
    {
        $this->layout = 'mini';
        
        $model = new Modification;
        
        $model->product_id = (int)$productId;
        // $model->available = 1;
        $model->lang = 'ru';
        $model->store_type = 0;
        
        if ($model->load(Yii::$app->request->post()))
        {
                
            $filterLang = FilterVariant::findOne(Yii::$app->request->post('filterValue')[3]);
            $lang = $filterLang->value;
            
            $filterStoreType = FilterVariant::findOne(Yii::$app->request->post('filterValue')[4]);
            $storeType = array_search($filterStoreType->value, Yii::$app->params['store_types']);
            
            $store = Stores::find()
                ->where([
                    'type' => $storeType,
                    'lang' => $lang,
                ])
                ->one();
                
            $request = json_decode(file_get_contents('https://api.sessia.com/api/market/' . $store->store_id . '/showcase-tree'), true);
            
            if ($request){
                foreach ($request as $val) {
                    if (isset($val['goods_list'])) {
                        foreach ($val['goods_list'] as $good){
                            if ($good['id'] == $model->sku){
                                $modificationFound = true;
                                $model->available = $good['is_purchasable'] ? 1 : 0;
                                $model->amount = $good['is_purchasable'] ? 99 : 0;
                                $model->code = $good['vendor_code'];
                                $model->sort = (int)$good['sort'];
                                $price = (int)$good['price'];
                                $old_price = isset($good['retail_price']) ? (int)$good['retail_price'] : 0;
                            }
                        }
                    }
                }
                
                if ($modificationFound){
                    if ($model->save()){
                        $model->setPrice($price, 1);
                        $model->setOldPrice($old_price);
                        
                        // if($prices = Yii::$app->request->post('Price')) {
                            // foreach($prices as $typeId => $price) {
                                // $model->setPrice($price['price'], $typeId);
                            // }
                        // }

                        if($filterValue = Yii::$app->request->post('filterValue')) {
                            ModificationToOption::deleteAll(['modification_id' => $model->id]);
                            foreach($filterValue as $filterId => $variantId) {
                                $rel = new ModificationToOption;
                                $rel->modification_id = $model->id;
                                $rel->option_id = $filterId;
                                $rel->variant_id = $variantId;
                                $rel->save();
                            }
                        }

                        // Yii::$app->session->setFlash('modification-success-added', 'Модификация успешно добавлена', false);
                        Yii::$app->session->setFlash('success', Yii::t('back', 'Элемент успешно создан'));
                        // return $this->redirect([
                            // 'product/update',
                            // 'id' => $model->product_id
                        // ]);
                        return Html::script("window.parent.$('.modal').modal('hide');");

                        // return '<script>parent.document.location = "'.Url::to(['/shop/product/update', 'id' => $model->product_id]).'";</script>';
                    }
                } else {
                    Yii::$app->session->setFlash('error', Yii::t('back', 'Ошибка: товар с таким ID не найден в выдаче API Sessia для этого магазина'));
                }
            } else {
                Yii::$app->session->setFlash('error', Yii::t('back', 'Ошибка получения данных от API Sessia'));
            }
        }

        $productModel = Product::findOne($productId);
        
        if (!$productModel) {
            throw new NotFoundHttpException('The requested product does not exist.');
        }

        return $this->render('create', [
            'model' => $model,
            'module' => $this->module,
            'productModel' => $productModel
        ]);
    }
    
    public function actionCreate()
    {
        $model = new Modification;

        if ($model->load(Yii::$app->request->post())) {
            
            $store = Stores::find()
                ->where([
                    'type' => $model->store_type,
                    'lang' => $model->lang
                ])
                ->one();
            $request = json_decode(file_get_contents('https://api.sessia.com/api/market/' . $store->store_id . '/showcase-tree?node=' . $model->sku . '&view=extra-plain&lang_id=1'), true);

            if ($request){
                $entry = $request[0]['container'];
                $model->available = $entry['is_purchasable'] ? 1 : 0;
                $model->code = $entry['vendor_code'];
                $model->sort = (int)$entry['sort'];
            }
            $model->save();
            $model->setPrice((int)$entry['price'], 1);
            if (isset($entry['retail_price'])){
                $model->setOldPrice($entry['retail_price']);
            }
            
            if ($prices = Yii::$app->request->post('Price')) {
                foreach($prices as $typeId => $price) {
                    $model->setPrice($price['price'], $typeId);
                }
            }

            if ($filterValue = Yii::$app->request->post('filterValue')) {
                ModificationToOption::deleteAll(['modification_id' => $model->id]);
                foreach($filterValue as $filterId => $variantId) {
                    $rel = new ModificationToOption;
                    $rel->modification_id = $model->id;
                    $rel->option_id = $filterId;
                    $rel->variant_id = $variantId;
                    $rel->save();
                }
            }

            $this->redirect(Yii::$app->request->referrer);
        }
        
        $this->redirect(Yii::$app->request->referrer);
    }

    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            if($prices = Yii::$app->request->post('Price')) {
                foreach($prices as $typeId => $price) {
                    $model->setPrice($price['price'], $typeId);
                }
            }

            if($filterValue = Yii::$app->request->post('filterValue')) {
                ModificationToOption::deleteAll(['modification_id' => $model->id]);
                foreach($filterValue as $filterId => $variantId) {
                    $rel = new ModificationToOption;
                    $rel->modification_id = $model->id;
                    $rel->option_id = $filterId;
                    $rel->variant_id = $variantId;
                    $rel->save();
                }
            }

            return $this->redirect(['update', 'id' => $model->id]);
        } else {
            $productModel = $model->product;

            return $this->render('update', [
                'productModel' => $productModel,
                'module' => $this->module,
                'model' => $model,
            ]);
        }
    }
    
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();
        // $this->redirect(Yii::$app->request->referrer);
        // return true;
        return Html::script("
            $.pjax.reload({
                container: '#product-modifications',
                async: false
            });
        ");
    }

    public function actionEditField()
    {
        $name = Yii::$app->request->post('name');
        $value = Yii::$app->request->post('value');
        $pk = unserialize(base64_decode(Yii::$app->request->post('pk')));
        $model = new Modification;
        $model::editField($pk, $name, $value);
    }

    protected function findModel($id)
    {
        $model = new Modification;
        
        if (($model = $model::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
    public function actionPublish($id)
    {
        $model = Modification::findOne($id);
        $model->available = $model->available ? 0 : 1;
        $model->save();
        if (!Yii::$app->request->isAjax){
            return $this->redirect([
                'product/update',
                'id' => $model->product_id
            ]);
        }
    }
    
}
