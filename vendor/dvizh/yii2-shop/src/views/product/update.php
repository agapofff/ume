<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use dosamigos\grid\columns\EditableColumn;

$this->title = json_decode($model->name)->{Yii::$app->language};
$this->params['breadcrumbs'][] = [
    'label' => Yii::t('back', 'Товары'),
    'url' => ['index']
];
$this->params['breadcrumbs'][] = Yii::t('back', 'Обновить');
\dvizh\shop\assets\BackendAsset::register($this);
?>

<div class="row">
    <div class="col-xs-12 col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2 col-lg-6 col-lg-offset-3">
        <div class="product-update">
            <?= $this->render('_form', [
                    'model' => $model,
                    'searchModel' => $searchModel,
                    'modificationDataProvider' => $modificationDataProvider,
                    'searchModificationModel' => $searchModificationModel,                        
                    'languages' => $languages,
                    'priceModel' => $priceModel,
                    'dataProvider' => $dataProvider,
                    'stores' => $stores,
                ])
            ?>
        </div>
    </div>
</div>