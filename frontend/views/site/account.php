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
use yii\widgets\Pjax;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

/**
 * @var yii\web\View $this
 * @var yii\widgets\ActiveForm $form
 * @var dektrium\user\models\Profile $profile
 */

$this->title = Yii::t('front', 'Профиль');
$this->params['breadcrumbs'][] = $this->title;

$inviteLink = Url::to(['/join/' . base64_encode(Yii::$app->user->id)], true);

?>

<div class="container-xl">
    <h1 class="text-uppercase font-weight-light mb-3">
        <?= Yii::t('front', 'Личный кабинет') ?>
    </h1>
    <h3 class="text-uppercase font-weight-light mb-3 position-relative">
        <?= Yii::t('front', 'Профиль') ?>
        <a href="<?= Url::to(['/logout']) ?>">
            <img src="/images/arrow_lk_active.svg" class="position-absolute top-0 right-0 d-none d-md-block transition" style="
                width: 1.5em;
                -webkit-transform: rotate(-45deg);
                -moz-transform: rotate(-45deg);
                transform: rotate(-45deg);
            ">
        </a>
    </h3>
    
    <div class="row align-items-baseline">
        <div class="col-auto mb-1">
            <h3 class="font-weight-bolder mb-0_25 ml-md-1 ml-lg-2 ml-xl-3">
                <?= Yii::t('front', 'Владелец') ?>
            </h3>
        </div>
        <div class="col-auto mb-1">
            <p class="mb-0">
                <a href="<?= Url::to(['/account/edit']) ?>" class="text-gray-400">
                    <?= Yii::t('front', 'Редактировать') ?>
                </a>
            </p>
        </div>
    </div>
    <div class="row justify-content-center mt-2">
        <div class="col-xs-12 col-md-10 col-lg-9 col-xl-8">
            <div class="row align-items-center mb-1_5">
                <div class="col-md-3">
                    <p class="mb-md-0 font-weight-bold">
                        <?= Yii::t('front', 'Имя') ?>
                    </p>
                </div>
                <div class="col-md-9">
                    <p class="h3 mb-0 font-weight-normal">
                        <?= $user->first_name ?: '&nbsp;' ?>
                    </p>
                </div>
            </div>
            <div class="row align-items-center mb-1_5">
                <div class="col-md-3">
                    <p class="mb-md-0 font-weight-bold">
                        <?= Yii::t('front', 'Фамилия') ?>
                    </p>
                </div>
                <div class="col-md-9">
                    <p class="h3 mb-0 font-weight-normal">
                        <?= $user->last_name ?: '&nbsp;' ?>
                    </p>
                </div>
            </div>
            <div class="row align-items-center mb-1_5">
                <div class="col-md-3">
                    <p class="mb-md-0 font-weight-bold">
                        <?= Yii::t('front', 'Телефон') ?>
                    </p>
                </div>
                <div class="col-md-9">
                    <p class="h3 mb-0 font-weight-normal">
                        <?= $user->phone ?: '&nbsp;' ?>
                    </p>
                </div>
            </div>
            <div class="row align-items-center mb-1_5">
                <div class="col-md-3">
                    <p class="mb-md-0 font-weight-bold">
                        <?= Yii::t('front', 'E-mail') ?>
                    </p>
                </div>
                <div class="col-md-9">
                    <p class="h3 mb-0 font-weight-normal">
                        <?= $user->email ?: '&nbsp;' ?>
                    </p>
                </div>
            </div>
        </div>
    </div>
    <p class="mb-0_25 ml-md-1 ml-lg-2 ml-xl-3">
        <a href="<?= Url::to(['/logout']) ?>" class="btn btn-outline-secondary rounded-pill">
            <?= Yii::t('front', 'Выйти') ?>
        </a>
    </p>
    
    <hr class="my-3">
    
    <h3 class="text-uppercase font-weight-light mb-1">
        <?= Yii::t('front', 'Мои заказы') ?>
    </h3>
    

</div>