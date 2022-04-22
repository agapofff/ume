<?php

use yii\helpers\Html;

$this->title = Yii::t('back', 'Create field');
$this->params['breadcrumbs'][] = ['label' => Yii::t('back', 'Orders'), 'url' => ['/order/default/index']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('back', 'Fields'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="field-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
