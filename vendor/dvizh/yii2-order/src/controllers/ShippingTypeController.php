<?php
namespace dvizh\order\controllers;

use yii;
use dvizh\order\models\ShippingType;
use dvizh\order\models\tools\ShippingTypeSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use backend\models\Langs;

class ShippingTypeController  extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => Yii::$app->getModule('order')->adminRoles,
                    ]
                ]
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    public function actionIndex()
    {
        $searchModel = new ShippingTypeSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        
        $languages = Langs::find()->all();

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'languages' => $languages,
        ]);
    }

    public function actionCreate()
    {
        $model = new ShippingType();

        if ($model->load(Yii::$app->request->post())) {
            if ($model->save()){
                Yii::$app->session->setFlash('success', Yii::t('back', 'Элемент успешно создан'));
            } else {
                Yii::$app->session->setFlash('danger', Yii::t('back', 'Ошибка создания элемента'));
            }
            return $this->redirect(['index']);
        }
        
        $languages = Langs::find()->all();

        return $this->render('create', [
            'model' => $model,
            'languages' => $languages,
        ]);
    }

    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            if ($model->save()){
                Yii::$app->session->setFlash('success', Yii::t('back', 'Изменения сохранены'));
            } else {
                Yii::$app->session->setFlash('danger', Yii::t('back', 'Ошибка сохранения'));
            }

            if ($model->saveAndExit){
                return $this->redirect(['index']);
            }
        }
        
        $languages = Langs::find()->all();

        return $this->render('update', [
            'model' => $model,
            'languages' => $languages,
        ]);
    }

    public function actionDelete($id)
    {
        if ($this->findModel($id)->delete()){
            Yii::$app->session->setFlash('success', Yii::t('back', 'Элемент успешно удалён'));
        } else {
            Yii::$app->session->setFlash('danger', Yii::t('back', 'Ошибка удаления элемента'));
        }

        return $this->redirect(['index']);
    }
    
    protected function findModel($id)
    {
        if (($model = ShippingType::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('back', 'The requested page does not exist.'));
    }

    public function actionActive($id)
    {
        $model = $this->findModel($id);
        $model->active = $model->active ? 0 : 1;
        if ($model->save()){
            Yii::$app->session->setFlash('success', Yii::t('back', 'Изменения сохранены'));
        } else {
            Yii::$app->session->setFlash('danger', Yii::t('back', 'Ошибка сохранения'));
        }

        if (Yii::$app->request->isAjax){
            $this->actionIndex();
        } else {
            return $this->redirect(['index']);
        }
    }
}