<?php

use yii\helpers\Html;

$this->title = Yii::t('back', 'Update field');
$this->params['breadcrumbs'][] = ['label' => Yii::t('back', 'Orders'), 'url' => ['/order/default/index']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('back', 'Fields'), 'url' => ['index']];
$this->params['breadcrumbs'][] = Yii::t('back', 'Update');
?>
<div class="field-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
