<?php

use yii\helpers\Url;
use yii\helpers\Html;

$this->title = Yii::$app->name;

?>

<div id="index1" class="container-lg container-xl container-xxl mb-5">
    <div class="row align-items-center mb-3">
        <div class="col-auto">
            <h1 class="text-uppercase">
                <?= Yii::t('front', 'Just like you') ?>!
            </h1>
        </div>
        <div class="col-auto">
            <h5 class="text-uppercase">
                <?= Yii::t('front', 'For ultra{0}high-net-worth{1}dogs', ['<br>', ' ']) ?>
            </h5>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <img src="/images/main/banner1.jpg" class="img-fluid" alt="<?= $title ?>">
        </div>
    </div>
</div>

<div id="index2" class="container-lg container-xl container-xxl">
    <div class="row">
        <div class="col-lg-6 col-xl-5 offset-xl-1">
            <div id="about" class="accordion">
                <h4 id="us-label" class="text-uppercase mb-1 d-flex">
                    <a href="#us" class="d-block w-100 text-decoration-none text-dark accordion-arrow" data-toggle="collapse" aria-expanded="true" aria-controls="us">
                        <div class="row align-items-center">
                            <div class="col-auto">
                                <?= Yii::t('front', 'Мы') ?>
                            </div>
                            <div class="col-auto justify-content-end arrow text-right pl-4 transition">
                                <img src="/images/arrow_corner.svg" class="arrow-corner">
                            </div>
                        </div>
                    </a>
                </h4>
                <div id="us" class="collapse show" aria-labelledby="us-label" data-parent="#about">
                    <p>
                        <?= Yii::t('front', 'Чтобы лучше понимать домашних животных, мы с помощью новейших технологий собрали множество данных об их предпочтениях. Теперь ваш пёс может сам выбрать свое меню, приготовленное из вкусных и полезных продуктов.') ?>
                    </p>
                </div>
                <hr class="my-1">
                <h4 id="philosophy-label" class="text-uppercase mb-0 d-flex">
                    <a href="#philosophy" class="text-decoration-none text-dark accordion-arrow" data-toggle="collapse" aria-expanded="false" aria-controls="philosophy">
                        <?= Yii::t('front', 'Философия') ?>
                    </a>
                </h4>
                <div id="philosophy" class="collapse" aria-labelledby="philosophy-label" data-parent="#about">
                    <p>
                        <?= Yii::t('front', 'Чтобы лучше понимать домашних животных, мы с помощью новейших технологий собрали множество данных об их предпочтениях. Теперь ваш пёс может сам выбрать свое меню, приготовленное из вкусных и полезных продуктов.') ?>
                    </p>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <img src="/images/main/banner2.jpg" class="img-fluid" alt="<?= $title ?>">
        </div>
    </div>
</div>