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
        <a href="<?= Url::to(['/logout']) ?>" class="btn btn-outline-secondary rounded-pill px-2 py-0_5">
            <?= Yii::t('front', 'Выйти') ?>
        </a>
    </p>
    
<?php
    if ($orders) {
?>
        <hr class="my-3">
        
        <h3 class="text-uppercase font-weight-light mb-2">
            <?= Yii::t('front', 'Мои заказы') ?>
        </h3>
        
    <?php
        foreach ($orders as $order) {
    ?>
            <div class="row cursor-pointer" data-toggle="lightbox" data-remote="<?= Url::to(['/orders/' . $order->id], true) ?> #order-content" data-title="<?= Yii::t('front', 'Заказ') ?> №<?= $order->id ?>" data-modal-dialog-class="modal-dialog-scrollable" data-modal-header-class="border-0 pb-0" data-modal-body-class="pt-0" data-modal-title-class="w-100 text-center" data-close-button-content="<img src='/images/modal_close.svg'>">
                <div class="col-12 bg-gray-200 py-1">
                    <div class="row justify-content-center">
                        <div class="col mx-md-1 mx-lg-2 mx-xl-3">
                            <div class="row justify-content-between align-items-center">
                                <div class="col-auto">
                                    <h5>
                                        <span class="font-weight-bolder"><?= Yii::t('front', 'Заказ') ?></span> №<?= $order->id ?>
                                    </h5>
                                    <p class="font-weight-light mb-0">
                                        <?= Yii::$app->formatter->asDate($order->date) ?>
                                    </p>
                                </div>
                                <div class="col-auto text-right">
                                    <h5>
                                        <?= Yii::$app->formatter->asCurrency($order->cost, Yii::$app->params['currency']) ?>
                                    </h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 py-0_5">
                    <div class="row justify-content-center">
                        <div class="col mx-md-1 mx-lg-2 mx-xl-3">
                            <div class="row justify-content-between align-items-center">
                                <div class="col-auto">
                                    <h5>
                                        <span class="font-weight-bolder"><?= Yii::t('front', ArrayHelper::getValue(ArrayHelper::map($shippingTypes, 'id', 'name'), $order->shipping_type_id)) ?></span>
                                    </h5>
                                    <div class="mt-1">
                                        <span class="btn btn-sm btn-<?= $order-status == 'done' ? 'primary' : 'secondary' ?>">
                                            <?= Yii::t('front', Yii::$app->getModule('order')->orderStatuses[$order->status]) ?>
                                        </span>
                                    </div>
                                </div>
                                <div class="col-auto text-right">
                                    <div class="row justify-content-end">
                                <?php
                                    foreach ($order->elements as $element) {
                                        $product = $element->model;
                                ?>
                                        <div class="col">
                                            <a href="<?= Url::to(['/product/' . $product->slug]) ?>">
                                                <img src="<?= $product->getImage()->getUrl('100x100') ?>" class="img-thumbnail">
                                            </a>
                                        </div>
                                <?php
                                    }
                                ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>                
                <div class="col-12 px-0">
                    <hr class="my-2">
                </div>
            </div>
    <?php
        }
    ?>
<?php
    }
?>

</div>