<?php

use yii\helpers\Url;
use yii\helpers\Html;

$this->title = Yii::$app->name;

?>

<div id="index1" class="container-xxl mb-5">
    <div class="row align-items-center mb-2 wow fadeIn" data-wow-duration="0.5s">
        <div class="col-auto">
            <h1 class="text-uppercase font-weight-light display-1 m-0">
                <?= Yii::t('front', 'Just like you') ?>!
            </h1>
        </div>
        <div class="col-auto">
            <h4 class="text-uppercase font-weight-normal m-0">
                <?= Yii::t('front', 'For ultra{0}high-net-worth{1}dogs', ['<br>', ' ']) ?>
            </h4>
        </div>
    </div>
    <div class="row wow fadeIn">
        <div class="col-12">
            <video autoplay loop muted playsinline class="d-block w-100">
                <source src="/video/dog_002_blue.mp4" type="video/mp4">
                <source src="/video/dog_002_blue.ogv" type="video/ogv">
                <source src="/video/dog_002_blue.webm" type="video/webm">
            </video>
        </div>
    </div>
</div>

<div class="container-xxl mt-5 mt-lg-8">
    <div class="row flex-nowrap">
        <div class="col">
            <h2 class="display-3 text-uppercase font-weight-light mb-2">
                <?= Yii::t('front', 'Каталог кормов и аксессуаров') ?>
            </h2>
            <p class="h5 font-weight-normal">
                <?= Yii::t('front', 'Ознакомьтесь с нашей продукцией') ?>
            </p>
        </div>
        <div class="col-auto d-none d-md-block">
            <?= Html::img('/images/arrow.svg', [
                    'class' => 'mt-0_5',
                    'style' => '
                        width: 4.5em;
                        transform: rotate(135deg);
                    ',
                ])
            ?>
        </div>
    </div>
    <div class="row mt-3 mt-md-4">
        <a href="<?= Url::to(['/catalog/wet-food']) ?>" class="col-xl-6 mb-1 mb-sm-3 mb-xl-5 text-dark text-decoration-none">
            <div class="col-sm-11 col-lg-10 col-xl-11 py-3 px-3 bg-gray-200 position-relative h-100">
                <div class="row no-gutters h-50">
                    <div class="col-sm-8 col-md-7 col-xl-8 col-xxl-7">
                        <h3 class="mb-2 text-uppercase text-nowrap font-weight-normal">
                            <?= Yii::t('front', 'Влажный корм') ?>
                        </h3>
                        <h5 class="mb-3">
                            <?= Yii::t('front', 'Полнорационный стерилизованный влажный корм UME с энтопротеином и белым императорским женьшенем') ?>
                        </h5>
                        <img src="/images/main/wet-food.png" class="img-fluid d-sm-none" alt="<?= $this->title ?>">
                    </div>
                </div>
            </div>
            <div class="col-5 position-absolute bottom-0 right-0 d-none d-sm-block" style="transform: translate(-10%, 10%);">
                <img src="/images/main/wet-food.png" class="img-fluid" alt="<?= $this->title ?>">
            </div>
        </a>
        <a href="<?= Url::to(['/catalog/accessories']) ?>" class="col-xl-6 mb-1 mb-sm-3 mb-xl-5 text-dark text-decoration-none">
            <div class="col-sm-11 col-lg-10 col-xl-11 py-3 px-3 bg-gray-200 position-relative h-100">
                <div class="row no-gutters h-50">
                    <div class="col-sm-8 col-md-7 col-xl-8 col-xxl-7">
                        <h3 class="mb-2 text-uppercase text-nowrap font-weight-normal">
                            <?= Yii::t('front', 'Аксессуары') ?>
                        </h3>
                        <h5 class="mb-3">
                            <?= Yii::t('front', 'Брендированные высококачественные аксессуары для стильных питомцев') ?>
                        </h5>
                        <img src="/images/main/accessories.png" class="img-fluid d-sm-none" alt="<?= $this->title ?>">
                    </div>
                </div>
            </div>
            <div class="col-8 position-absolute bottom-0 right-0 d-none d-sm-block" style="transform: translate(5%, 15%);">
                <img src="/images/main/accessories.png" class="img-fluid" alt="<?= $this->title ?>">
            </div>
        </a>
        <a href="<?= Url::to(['/catalog/dry-food']) ?>" class="col-xl-6 mb-1 mb-sm-3 mb-xl-5 text-dark text-decoration-none">
            <div class="col-sm-11 col-lg-10 col-xl-11 py-3 px-3 bg-gray-200 position-relative h-100">
                <div class="row no-gutters h-50">
                    <div class="col-sm-8 col-md-7 col-xl-8 col-xxl-7">
                        <h3 class="mb-2 text-uppercase text-nowrap font-weight-normal">
                            <?= Yii::t('front', 'Сухой корм') ?>
                        </h3>
                        <h5 class="mb-3">
                            <?= Yii::t('front', 'Полнорационный сухой корм UME с белком насекомых и женьшенем для всех пород собак') ?>
                        </h5>
                        <img src="/images/main/dry-food.png" class="img-fluid d-sm-none" alt="<?= $this->title ?>">
                    </div>
                </div>
            </div>
            <div class="col-6 position-absolute bottom-0 right-0 d-none d-sm-block" style="transform: translate(3%, 10%);">
                <img src="/images/main/dry-food.png" class="img-fluid" alt="<?= $this->title ?>">
            </div>
        </a>
        <a href="<?= Url::to(['/catalog/treats']) ?>" class="col-xl-6 mb-1 mb-sm-3 mb-xl-5 text-dark text-decoration-none">
            <div class="col-sm-11 col-lg-10 col-xl-11 py-3 px-3 bg-gray-200 position-relative h-100">
                <div class="row no-gutters h-50">
                    <div class="col-sm-8 col-md-6 col-lg-6 col-xl-8 col-xxl-7">
                        <h3 class="mb-2 text-uppercase text-nowrap font-weight-normal">
                            <?= Yii::t('front', 'Лакомства') ?>
                        </h3>
                        <h5 class="mb-3">
                            <?= Yii::t('front', 'Полезные и вкусные лакомства UME с женьшенем') ?>
                        </h5>
                        <img src="/images/main/treats.png" class="img-fluid d-sm-none" alt="<?= $this->title ?>">
                    </div>
                </div>
            </div>
            <div class="col-7 position-absolute bottom-0 right-0 d-none d-sm-block" style="transform: translate(3%, 10%);">
                <img src="/images/main/treats.png" class="img-fluid" alt="<?= $this->title ?>">
            </div>
        </a>
    </div>
</div>

<div class="container-xxl mt-3 mt-lg-8">
    <div class="row">
        <div class="col-xl-6 mb-3 mb-xl-0">
            <div class="row h-100">
                <div class="col-12 align-self-center">
                    <h2 class="display-3 text-uppercase font-weight-light mb-2 mb-xl-4">
                        <?= Yii::t('front', 'Скачайте приложение UME') ?>
                    </h2>
                    <div class="row">
                        <div class="col-md-11 col-lg-10 col-xl-9 ">
                            <p class="h3 font-weight-normal">
                                <?= Yii::t('front', 'Быстрый доступ к покупке премиальной продукции UME и специализированные услуги для вашего питомца.') ?>
                            </p>
                        </div>
                        <div class="col-12 mt-2 mt-xl-4">
                            <div class="row">
                                <div class="col-auto mb-0_5">
                                    <a href="<?= Yii::$app->params['apps']['google'] ?>" target="_blank" class="text-decoration-none">
                                        <img src="/images/main/google.png" alt="<?= $this->title ?>" class="img-fluid">
                                    </a>
                                </div>
                                <div class="col-auto mb-0_5">
                                    <a href="<?= Yii::$app->params['apps']['google'] ?>" target="_blank" class="text-decoration-none">
                                        <img src="/images/main/apple.png" alt="<?= $this->title ?>" class="img-fluid">
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 align-self-end d-none d-xl-block">
                    <hr class="border-gray-800 my-2" style="margin-right: -30px;">
                </div>
            </div>
        </div>
        <div class="col-auto">
            <div class="owl-carousel-stacked row" data-related="#app-slider-description-1">
                <div class="col-12">
                    <img src="/images/main/app-1.png" alt="<?= $this->title ?>" class="img-fluid">
                </div>
                <div class="col-12">
                    <img src="/images/main/app-2.png" alt="<?= $this->title ?>" class="img-fluid">
                </div>
                <div class="col-12">
                    <img src="/images/main/app-3.png" alt="<?= $this->title ?>" class="img-fluid">
                </div>
            </div>
            <hr class="border-gray-800 my-2">
        </div>
        <div class="col-auto offset-xl-6" style="max-width: 360px;">
            <div id="app-slider-description-1" class="owl-carousel owl-theme owl-fade">
                <h5>
                    <?= Yii::t('front', 'Легко и быстро покупать продукты и накапливать баллы') ?>
                </h5>
                <h5>
                    <?= Yii::t('front', 'Создать личный профиль питомца') ?>
                </h5>
                <h5>
                    <?= Yii::t('front', 'Создать целую экосистему для питомцев') ?>
                </h5>
            </div>
        </div>
    </div>
</div>

<div class="container-xxl mt-3 mt-lg-8">
    <div class="row">
        <div class="col-12">
            <div id="owl-advantages" class="owl-carousel-stacked row owl-loop">
                <div class="col-12 vw-75 mr-md-3 mr-lg-4 mr-xl-5 bg-white advantage">
                    <button type="button" class="btn btn-link text-decoration-none owl-next float-right d-none d-md-block" onclick="owlGoTo('#owl-advantages', 1, 1000)">
                        <img src="/images/main/next.svg">
                    </button>
                    <h2 class="display-3 text-uppercase font-weight-light mb-2 mb-xl-3">
                        <?= Yii::t('front', 'Мы') ?>
                    </h2>
                    <img src="/images/main/us.jpg" class="img-fluid">
                    <div class="row">
                        <div class="col-12 col-xl-11 col-xxl-10">
                            <h5 class="mt-2 mt-lg-3">
                                <?= Yii::t('front', 'Чтобы лучше понимать домашних животных, мы с помощью новейших технологий собрали множество данных об их предпочтениях. Теперь ваш пёс может сам выбрать свое меню, приготовленное из вкусных и полезных продуктов.') ?>
                            </h5>
                        </div>
                    </div>
                </div>
                <div class="col-12 vw-75 mr-md-3 mr-lg-4 mr-xl-5 bg-white advantage">
                    <button type="button" class="btn btn-link text-decoration-none owl-next float-right d-none d-md-block" onclick="owlGoTo('#owl-advantages', 2, 1000)">
                        <img src="/images/main/next.svg">
                    </button>
                    <h2 class="display-3 text-uppercase font-weight-light mb-2 mb-xl-3">
                        <?= Yii::t('front', 'Философия') ?>
                    </h2>
                    <img src="/images/main/philosophy.jpg" class="img-fluid">
                    <div class="row">
                        <div class="col-12 col-xl-11 col-xxl-10">
                            <h5 class="mt-2 mt-lg-3">
                                <?= Yii::t('front', 'Лучше узнать животных с использованием искусственного интеллекта, чтобы общаться со своими питомцами на одном языке') ?>
                            </h5>
                        </div>
                    </div>
                </div>
                <div class="col-12 vw-75 mr-md-3 mr-lg-4 mr-xl-5 bg-white advantage">
                    <button type="button" class="btn btn-link text-decoration-none owl-next float-right d-none d-md-block" onclick="owlGoTo('#owl-advantages', 3, 1000)">
                        <img src="/images/main/next.svg">
                    </button>
                    <h2 class="display-3 text-uppercase font-weight-light mb-2 mb-xl-3">
                        <?= Yii::t('front', 'Цель') ?>
                    </h2>
                    <img src="/images/main/target.jpg" class="img-fluid">
                    <div class="row">
                        <div class="col-12 col-xl-11 col-xxl-10">
                            <h5 class="mt-2 mt-lg-3">
                                <?= Yii::t('front', 'Обеспечить четвероногих друзей высококачественной, здоровой и полезной едой, которая непременно придётся им по вкусу') ?>
                            </h5>
                        </div>
                    </div>
                </div>
                <div class="col-12 vw-75 mr-md-3 mr-lg-4 mr-xl-5 bg-white advantage">
                    <button type="button" class="btn btn-link text-decoration-none owl-next float-right d-none d-md-block" onclick="owlGoTo('#owl-advantages', 0, 300)">
                        <img src="/images/main/next.svg">
                    </button>
                    <h2 class="display-3 text-uppercase font-weight-light mb-2 mb-xl-3">
                        <?= Yii::t('front', 'Миссия') ?>
                    </h2>
                    <img src="/images/main/mission.jpg" class="img-fluid">
                    <div class="row">
                        <div class="col-12 col-xl-11 col-xxl-10">
                            <h5 class="mt-2 mt-lg-3">
                                <?= Yii::t('front', 'Развитие технологий и создание продуктов, которые помогают людям лучше понимать и качественнее обеспечивать потребности питомца, а также заботиться о его здоровье.') ?>
                            </h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container-xxl mt-3 mt-lg-6">
    <div class="row">
        <img src="images/arrow.svg" style="transform: rotate(45deg);">
    </div>
    <div class="row">
        <div class="col-xl-6 mb-3 mb-xl-0">
            <div class="row h-100">
                <div class="col-12 align-self-center">
                    <h2 class="display-3 text-uppercase font-weight-light mb-2 mb-xl-4">
                        <?= Yii::t('front', 'Программа привилегий UME') ?>
                    </h2>
                    <div class="row">
                        <div class="col-md-11 col-lg-10 col-xl-9 ">
                            <p class="h3 font-weight-normal mb-2 mb-lg-4">
                                <?= Yii::t('front', 'Эффективный сервис услуг и систем поощрения ваших питомцев. Делайте простые действия и получайте баллы.') ?>
                            </p>
                            <a href="<?= Url::to(['/bonus']) ?>" class="btn btn-lg btn-secondary rounded-pill py-1_5">
                                <span class="h5">
                                    <?= Yii::t('front', 'Подробнее') ?>
                                </span>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-12 align-self-end d-none d-xl-block">
                    <hr class="border-gray-800 my-2" style="margin-right: -30px;">
                </div>
            </div>
        </div>
        <div class="col-auto">
            <div class="owl-carousel-stacked row" data-related="#app-slider-description-2">
                <div class="col-12">
                    <img src="/images/main/app-4.png" alt="<?= $this->title ?>" class="img-fluid">
                </div>
                <div class="col-12">
                    <img src="/images/main/app-5.png" alt="<?= $this->title ?>" class="img-fluid">
                </div>
                <div class="col-12">
                    <img src="/images/main/app-6.png" alt="<?= $this->title ?>" class="img-fluid">
                </div>
                <div class="col-12">
                    <img src="/images/main/app-6.png" alt="<?= $this->title ?>" class="img-fluid">
                </div>
            </div>
            <hr class="border-gray-800 my-2">
        </div>
        <div class="col-auto offset-xl-6" style="max-width: 360px;">
            <div id="app-slider-description-2" class="owl-carousel owl-theme owl-fade">
                <h5>
                    <?= Yii::t('front', 'Покупать товары и получать бонусы') ?>
                </h5>
                <h5>
                    <?= Yii::t('front', 'Размещать посты в своей ленте') ?>
                </h5>
                <h5>
                    <?= Yii::t('front', 'Приглашать как можно больше друзей') ?>
                </h5>
                <h5>
                    <?= Yii::t('front', 'Покупать подписки и услуги консьержа') ?>
                </h5>
            </div>
        </div>
    </div>
</div>

<?php
    if ($news) {
?>
        <div class="container-xxl mt-3 mt-lg-7 mb-5 mb-lg-9">
            <div class="row">
                <div class="col-12 mb-2">
                    <h2 class="display-3 text-uppercase font-weight-light mb-2">
                        <?= Yii::t('front', 'Новости') ?>
                    </h2>
                </div>
                <div class="col-12">
                    <div class="row justify-content-center">
                <?php
                    foreach ($news as $k => $post) {
                ?>
                        <div class="col-sm-6 col-lg-4 <?= $k == 2 ? 'd-none d-sm-block' : '' ?> wow fadeIn">
                            <?= $this->render('/news/_post', [
                                    'post' => $post
                                ])
                            ?>
                        </div>
                <?php
                    }
                ?>
                    </div>
                </div>
                <div class="col-12">
                    <p class="mt-2 text-center">
                        <a href="<?= Url::to(['/news']) ?>">
                            <?= Yii::t('front', 'Все новости') ?>
                        </a>
                    </p>
                </div>
            </div>
        </div>
<?php
    }
?>
