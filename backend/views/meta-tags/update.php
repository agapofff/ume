<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\MetaTags */

$this->title = Yii::t('back', 'Изменить');
$this->params['breadcrumbs'][] = [
    'label' => Yii::t('back', 'Мета-теги'),
    'url' => ['index']
];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
    <div class="col-xs-12 col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2 col-lg-6 col-lg-offset-3">
        <div class="meta-tags-update">
            <br>
            <?= $this->render('_form', [
                'model' => $model,
            ]) ?>
            <br>
        </div>
    </div>
</div>
