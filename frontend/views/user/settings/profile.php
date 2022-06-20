<?php

/*
 * This file is part of the Dektrium project.
 *
 * (c) Dektrium project <http://github.com/dektrium>
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

use yii\helpers\Url;
use yii\helpers\Html;
use dektrium\user\helpers\Timezone;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

/**
 * @var yii\web\View $this
 * @var yii\widgets\ActiveForm $form
 * @var dektrium\user\models\Profile $model
 */

$this->title = Yii::t('front', 'Профиль');
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="container-lg container-xl container-xxl">
    <h1 class="text-uppercase mb-2 wow fadeIn" data-wow-duration="0.5s">
        <?= Yii::t('front', 'Личный кабинет') ?>
    </h1>
    <h4 class="position-relative text-uppercase font-weight-normal">
        <?= Yii::t('front', 'Профиль') ?>
        <?= Html::img('/images/arrow.svg', [
                'class' => 'position-absolute top-0 right-0 d-none d-md-block',
                'style' => '
                    width: 1.5em;
                    margin: -0.2em -0.2em 0 0;
                    -webkit-transform: rotate(-45deg);
                    -moz-transform: rotate(-45deg);
                    transform: rotate(-45deg);
                ',
            ])
        ?>
    </h4>
    <p>
        <a href="<?= Url::to(['/account']) ?>" class="text-gray-400">
            <?= Yii::t('front', 'Редактировать') ?>
        </a>
    </p>
    
    <div class="row">
        <div class="col-md-3 pt-4">
            <a href="<?= Url::to(['/profile']) ?>" class="rounded-pill border border-teal d-block" style="border-width: 3px !important">
                <img src="<?= $user->getImage()->getUrl('400') ?>" class="img-fluid" class="rounded-pill">
            </a>
        </div>
        <div class="col-md-8 offset-md-1">
            <h2 class="mb-2">
                <?= $model->name ?: Yii::t('front', 'Мой питомец') ?>
            </h2>
            <div class="row mb-0_5">
                <div class="col-4 font-weight-bold">
                    <?= Yii::t('front', 'Пол') ?>
                </div>
                <div class="col-8">
                    <?= Yii::t('front', $model->sex ? Yii::t('front', Yii::$app->params['sex'][$model->sex]) : '') ?>
                </div>
            </div>
            <div class="row mb-0_5">
                <div class="col-4 font-weight-bold">
                    <?= Yii::t('front', 'Порода') ?>
                </div>
                <div class="col-8">
                    <?= json_decode($breed)->{Yii::$app->language} ?>
                </div>
            </div>
            <div class="row mb-0_5">
                <div class="col-4 font-weight-bold">
                    <?= Yii::t('front', 'Дата рождения') ?>
                </div>
                <div class="col-8">
                    <?= $model->birthday ? Yii::$app->formatter->asDate($model->birthday, 'dd.MM.yyyy') : '' ?>
                </div>
            </div>
            <div class="row mb-0_5">
                <div class="col-4 font-weight-bold">
                    <?= Yii::t('front', 'Вес') ?>
                </div>
                <div class="col-8">
                    <?= $model->weight ? $model->weight . ' ' . Yii::t('front', 'кг') : '' ?>
                </div>
            </div>
            <div class="row mb-0_5">
                <div class="col-4 font-weight-bold">
                    <?= Yii::t('front', 'Активность') ?>
                </div>
                <div class="col-8">
                    <?= $model->activity ? Yii::t('front', Yii::$app->params['activity'][$model->activity]) : '' ?>
                </div>
            </div>
            <hr>
            <h4 class="mt-2 mb-1_5">
                <?= Yii::t('front', 'Хозяин') ?>
            </h4>
            <div class="row mb-0_5">
                <div class="col-4 font-weight-bold">
                    <?= Yii::t('front', 'ФИО') ?>
                </div>
                <div class="col-8">
                    <?= implode(' ', [$model->first_name, $model->last_name]) ?>
                </div>
            </div>
            <div class="row mb-0_5">
                <div class="col-4 font-weight-bold">
                    <?= Yii::t('front', 'Телефон') ?>
                </div>
                <div class="col-8">
                    <?= $model->phone ?>
                </div>
            </div>
            <div class="row mb-0_5">
                <div class="col-4 font-weight-bold">
                    <?= Yii::t('front', 'E-mail') ?>
                </div>
                <div class="col-8">
                    <?= $user->email ?>
                </div>
            </div>
            <hr>
            <h4 class="mt-2 mb-1_5">
                <?= Yii::t('front', 'Подписка') ?>
            </h4>
        </div>
    </div>
    
    <hr>
    <a href="<?= Url::to(['/orders']) ?>" class="h4 position-relative d-block text-uppercase text-gray-500 text-decoration-none font-weight-normal">
        <?= Yii::t('front', 'Покупки') ?>
        <?= Html::img('/images/arrow_lk.svg', [
                'class' => 'position-absolute top-0 right-0 d-none d-md-block',
                'style' => '
                    width: 1.5em;
                    margin: -0.2em -0.2em 0 0;
                    -webkit-transform: rotate(-45deg);
                    -moz-transform: rotate(-45deg);
                    transform: rotate(-45deg);
                ',
            ])
        ?>
    </a>
    
    
</div>