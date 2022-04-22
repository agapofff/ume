<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Common */

$this->title = Yii::t('back', 'Основные параметры');
$this->params['breadcrumbs'][] = [
    'label' => $this->title,
    'url' => ['index']
];

$model->updated_at = Date('Y-m-d H:i:s');
?>

<div class="row">
    <div class="col-xs-12 col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2 col-lg-6 col-lg-offset-3">
        <div class="common-update">
            <br>
            <?= $this->render('_form', [
                'model' => $model,
            ]) ?>
            <br>
        </div>
    </div>
</div>