<?php

namespace backend\controllers;

use Yii;
use backend\models\Common;
use backend\models\CommonSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\UploadedFile;

class CommonController extends Controller
{

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    public function actionIndex()
    {
        $model = $this->findModel(1);

        if ($model->load(Yii::$app->request->post())) {
            
            $model->imageFile = UploadedFile::getInstance($model, 'imageFile');
            $model->backgroundFile = UploadedFile::getInstance($model, 'backgroundFile');
            
            $images = [];
            if ($model->imageFile) $images['image'] = $model->imageFile;
            if ($model->backgroundFile) $images['background'] = $model->backgroundFile;

            if (!empty($images)) {
                foreach ($images as $key => $image) {
                    $fileName = md5(date('YmdHis').rand(111,999));
                    switch ($key) {
                        case 'image': 
                            $folder = 'main/'; 
                            break;
                        case 'background': 
                            $folder = 'backgrounds/'; 
                            break;
                        default: 
                            $folder = ''; 
                            break;
                    }
                    if ($model->upload($fileName, $key)) {
                        $model->{$key} = '/images/' . $folder . $fileName . '.' . $model->{$key.'File'}->extension;
                    } else {
                        Yii::$app->session->setFlash('danger', Yii::t('back', 'Ошибка загрузки изображения'));
                    }
                    $model->{$key.'File'} = null;
                }
            }
            
            if ($model->save()) {
                Yii::$app->session->setFlash('success', Yii::t('back', 'Изменения сохранены'));
            } else {
                Yii::$app->session->setFlash('danger', Yii::t('back', 'Ошибка сохранения'));
            }
            // return $this->refresh();
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    protected function findModel($id)
    {
        if (($model = Common::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('back', 'The requested page does not exist.'));
    }
}
