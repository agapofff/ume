<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Breeds */

$this->title = Yii::t('back', 'Изменить');
$this->params['breadcrumbs'][] = [
    'label' => Yii::t('back', 'Породы'), 
    'url' => ['index']
];
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="row">
    <div class="col-xs-12 col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2 col-lg-6 col-lg-offset-3">
        <div class="breeds-update">

            <h1><?= Html::encode($this->title) ?></h1>

            <?= $this->render('_form', [
                    'model' => $model,
                    'languages' => $languages,
                ]) 
            ?>

        </div>
    </div>
</div>
