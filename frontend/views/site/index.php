<?php

use yii\helpers\Url;
use yii\helpers\Html;

$this->title = Yii::$app->name;

?>

<div id="index1" class="container-xl">
    <div class="row align-items-center mb-2 wow fadeIn" data-wow-duration="0.5s">
        <div class="col-auto">
            <h1 class="text-uppercase font-weight-light mb-0">
                <?= Yii::t('front', 'Just like you') ?>!
            </h1>
        </div>
        <div class="col-auto d-none d-sm-block"></div>
        <div class="col-auto">
            <h3 class="text-uppercase font-weight-bolder mb-0">
                <?= Yii::t('front', 'For ultra{0}high-net-worth{1}dogs', ['<br>', ' ']) ?>
            </h3>
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

<div class="container-xl mt-3 mt-lg-5">
    <div class="row flex-nowrap">
        <div class="col">
            <h2 class="text-uppercase font-weight-light mb-1">
                <?= Yii::t('front', 'Продукция UME') ?>
            </h2>
        </div>
        <div class="col-auto d-none d-md-block">
            <?= Html::img('/images/arrow.svg', [
                    'style' => '
                        width: 4.5em;
                        transform: rotate(135deg);
                    ',
                ])
            ?>
        </div>
    </div>
    
    <div class="row mt-1 mt-lg-3">
    <?php
        foreach ($products as $product) {
            echo $this->render('@frontend/views/catalog/_product', [
                'product' => $product,
                'prices' => $prices,
            ]);
        }
    ?>
    </div>
    <!--
    <div class="row mt-1 mt-lg-3 d-none">
        <a href="<?= Url::to(['/catalog/wet-food']) ?>" class="col-sm-6 mb-1 mb-sm-3 mb-xl-5 text-dark text-decoration-none">
            <div class="col-sm-12 col-md-11 col-lg-10 col-xl-11 py-3 px-3 bg-gray-200 position-relative h-100">
                <img src="/images/main/wet-food.png" class="img-fluid d-xl-none mb-2" alt="<?= $this->title ?>">
                <h4 class="mb-2 text-uppercase text-nowrap font-weight-bolder">
                    <?= Yii::t('front', 'Влажный корм') ?>
                </h4>
                <div class="row no-gutters h-50">
                    <div class="col-xl-7">
                        <p class="mb-0 mb-xl-3 font-weight-bolder">
                            <?= Yii::t('front', 'Полнорационный стерилизованный влажный корм UME с энтопротеином и белым императорским женьшенем') ?>
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-8 position-absolute bottom-0 right-0 d-none d-xl-block" style="transform: translate(10%, 20%);">
                <img src="/images/main/wet-food.png" class="img-fluid" alt="<?= $this->title ?>">
            </div>
        </a>
        <a href="<?= Url::to(['/catalog/accessories']) ?>" class="col-sm-6 mb-1 mb-sm-3 mb-xl-5 text-dark text-decoration-none">
            <div class="col-sm-12 col-md-11 col-lg-10 col-xl-11 py-3 px-3 bg-gray-200 position-relative h-100">
                <img src="/images/main/accessories.png" class="img-fluid d-xl-none mb-2" alt="<?= $this->title ?>">
                <h4 class="mb-2 text-uppercase text-nowrap font-weight-bolder">
                    <?= Yii::t('front', 'Аксессуары') ?>
                </h4>
                <div class="row no-gutters h-50">
                    <div class="col-xl-7">
                        <p class="mb-0 mb-xl-3 font-weight-bolder">
                            <?= Yii::t('front', 'Брендированные высококачественные аксессуары для стильных питомцев') ?>
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-8 position-absolute bottom-0 right-0 d-none d-xl-block" style="transform: translate(0, 22%);">
                <img src="/images/main/accessories.png" class="img-fluid" alt="<?= $this->title ?>">
            </div>
        </a>
        <a href="<?= Url::to(['/catalog/dry-food']) ?>" class="col-sm-6 mb-1 mb-sm-3 mb-xl-5 text-dark text-decoration-none">
            <div class="col-sm-12 col-md-11 col-lg-10 col-xl-11 py-3 px-3 bg-gray-200 position-relative h-100">
                <img src="/images/main/dry-food.png" class="img-fluid d-xl-none mb-2" alt="<?= $this->title ?>">
                <h4 class="mb-2 text-uppercase text-nowrap font-weight-bolder">
                    <?= Yii::t('front', 'Сухой корм') ?>
                </h4>
                <div class="row no-gutters h-50">
                    <div class="col-xl-7">
                        <p class="mb-0 mb-xl-3 font-weight-bolder">
                            <?= Yii::t('front', 'Полнорационный сухой корм UME с белком насекомых и женьшенем для всех пород собак') ?>
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-8 position-absolute bottom-0 right-0 d-none d-xl-block" style="transform: translate(18%, 17%);">
                <img src="/images/main/dry-food.png" class="img-fluid" alt="<?= $this->title ?>">
            </div>
        </a>
        <a href="<?= Url::to(['/catalog/treats']) ?>" class="col-sm-6 mb-1 mb-sm-3 mb-xl-5 text-dark text-decoration-none">
            <div class="col-sm-12 col-md-11 col-lg-10 col-xl-11 py-3 px-3 bg-gray-200 position-relative h-100">
                <img src="/images/main/treats.png" class="img-fluid d-xl-none mb-2" alt="<?= $this->title ?>">
                <h4 class="mb-2 text-uppercase text-nowrap font-weight-bolder">
                    <?= Yii::t('front', 'Лакомства') ?>
                </h4>
                <div class="row no-gutters h-50">
                    <div class="col-xl-7">
                        <p class="mb-0 mb-xl-3 font-weight-bolder">
                            <?= Yii::t('front', 'Полезные и вкусные лакомства UME с женьшенем') ?>
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-8 position-absolute bottom-0 right-0 d-none d-xl-block" style="transform: translate(5%, 23%);">
                <img src="/images/main/treats.png" class="img-fluid" alt="<?= $this->title ?>">
            </div>
        </a>
    </div>
    -->
</div>

<div id="app" class="container-xl pt-3 pt-lg-5">
    <div class="row">
        <div class="col-xl-6 mb-3 mb-xl-0">
            <div class="row h-100">
                <div class="col-12 align-self-center">
                    <?= Html::img('/images/arrow.svg', [
                            'class' => 'mb-2 mb-lg-3',
                            'style' => '
                                width: 4.5em;
                                transform: rotate(45deg);
                            ',
                        ])
                    ?>
                    <h2 class="text-uppercase font-weight-light mb-1 mb-lg-1_5">
                        <?= Yii::t('front', 'Приложение UME') ?>
                    </h2>
                    <div class="row">
                        <div class="col-md-11 col-lg-10 col-xl-9 mb-2 mb-lg-4">
                            <h5 class="font-weight-bolder mb-1_5">
                                <?= Yii::t('front', 'Скоро в App Store и Google Play') ?>
                            </h5>
                            <p class="font-weight-bolder mb-1_5">
                                <?= Yii::t('front', 'Быстрый доступ к покупке премиальной продукции UME, и специализированные услуги для вашего питомца.') ?>
                            </p>
                            <p class="font-weight-bolder mb-1_5">
                                <?= Yii::t('front', 'Официальный релиз － февраль 2023г') ?>
                            </p>
                        </div>
                        <div class="col-12 d-none">
                            <div class="row">
                                <div class="col-6 col-md-5 col-lg-4 col-xl-3 pr-xl-0 mb-0_5">
                                    <a href="<?= Yii::$app->params['apps']['google'] ?>" target="_blank" class="text-decoration-none">
                                        <img src="/images/main/google.png" alt="<?= $this->title ?>" class="img-fluid">
                                    </a>
                                </div>
                                <div class="col-6 col-md-5 col-lg-4 col-xl-3 pr-xl-0 mb-0_5">
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
        <div class="col-xl-6 overflow-hidden position-relative stacked-fade">
            <div class="row">
                <div class="col-auto">
                    <div class="owl-carousel-stacked d-none row" data-related="#app-slider-description-1">
                        <div class="col-auto pr-0 pr-sm-1">
                            <img src="/images/main/app-1_<?= Yii::$app->language ?>.png" alt="<?= $this->title ?>" class="img-fluid">
                        </div>
                        <div class="col-auto pr-0 pr-sm-1">
                            <img src="/images/main/app-2_<?= Yii::$app->language ?>.png" alt="<?= $this->title ?>" class="img-fluid">
                        </div>
                        <div class="col-auto pr-0 pr-sm-1">
                            <img src="/images/main/app-3_<?= Yii::$app->language ?>.png" alt="<?= $this->title ?>" class="img-fluid">
                        </div>
                    </div>
                    <hr class="border-gray-800 my-2">
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-auto offset-xl-6 overflow-hidden" style="max-width: 245px;">
            <div id="app-slider-description-1" class="owl-carousel-stacked app-slider-description">
                <div class="bg-white">
                    <p class="font-weight-bolder">
                        <?= Yii::t('front', 'Легко и быстро покупать продукты и накапливать баллы') ?>
                    </p>
                </div>
                <div class="bg-white">
                    <p class="font-weight-bolder">
                        <?= Yii::t('front', 'Создать личный профиль питомца') ?>
                    </p>
                </div>
                <div class="bg-white">
                    <p class="font-weight-bolder">
                        <?= Yii::t('front', 'Создать целую экосистему для питомцев') ?>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container-xl mt-2 mt-lg-4">
    <div class="row">
        <div class="col-12 overflow-hidden">
            <div id="owl-advantages" class="owl-carousel-stacked d-none row">
                <div class="col-auto mr-2 bg-white advantage">
                    <button type="button" class="btn btn-link text-decoration-none owl-next float-right mt-0_25 pr-0" onclick="$('#owl-advantages').trigger('next.owl.carousel');">
                        <img src="/images/main/next.svg">
                    </button>
                    <h2 class="text-uppercase font-weight-light mb-1 mb-lg-2">
                        <?= Yii::t('front', 'Мы') ?>
                    </h2>
                    <img src="/images/main/us.jpg" class="img-fluid">
                    <div class="row">
                        <div class="col-12 col-xl-11 col-xxl-10">
                            <p class="mt-1 mt-lg-1_5 font-weight-bolder">
                                <?= Yii::t('front', 'Чтобы лучше понимать домашних животных, мы с помощью новейших технологий собрали множество данных об их предпочтениях. Теперь ваш пёс может сам выбрать свое меню, приготовленное из вкусных и полезных продуктов.') ?>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-auto mr-2 bg-white advantage">
                    <button type="button" class="btn btn-link text-decoration-none owl-next float-right mt-0_25 pr-0" onclick="$('#owl-advantages').trigger('next.owl.carousel');">
                        <img src="/images/main/next.svg">
                    </button>
                    <h2 class="text-uppercase font-weight-light mb-1 mb-lg-2">
                        <?= Yii::t('front', 'Философия') ?>
                    </h2>
                    <img src="/images/main/philosophy.jpg" class="img-fluid">
                    <div class="row">
                        <div class="col-12 col-xl-11 col-xxl-10">
                            <p class="mt-1 mt-lg-1_5 font-weight-bolder">
                                <?= Yii::t('front', 'Лучше узнать животных с использованием искусственного интеллекта, чтобы общаться со своими питомцами на одном языке') ?>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-auto mr-2 bg-white advantage">
                    <button type="button" class="btn btn-link text-decoration-none owl-next float-right mt-0_25 pr-0" onclick="$('#owl-advantages').trigger('next.owl.carousel');">
                        <img src="/images/main/next.svg">
                    </button>
                    <h2 class="text-uppercase font-weight-light mb-1 mb-lg-2">
                        <?= Yii::t('front', 'Цель') ?>
                    </h2>
                    <img src="/images/main/target.jpg" class="img-fluid">
                    <div class="row">
                        <div class="col-12 col-xl-11 col-xxl-10">
                            <p class="mt-1 mt-lg-1_5 font-weight-bolder">
                                <?= Yii::t('front', 'Обеспечить четвероногих друзей высококачественной, здоровой и полезной едой, которая непременно придётся им по вкусу') ?>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-auto mr-2 bg-white advantage">
                    <button type="button" class="btn btn-link text-decoration-none owl-next float-right mt-0_25 pr-0" onclick="owlGoTo('#owl-advantages', 0, 300)">
                        <img src="/images/main/next.svg">
                    </button>
                    <h2 class="text-uppercase font-weight-light mb-1 mb-lg-2">
                        <?= Yii::t('front', 'Миссия') ?>
                    </h2>
                    <img src="/images/main/mission.jpg" class="img-fluid">
                    <div class="row">
                        <div class="col-12 col-xl-11 col-xxl-10">
                            <p class="mt-1 mt-lg-1_5 font-weight-bolder">
                                <?= Yii::t('front', 'Развитие технологий и создание продуктов, которые помогают людям лучше понимать и качественнее обеспечивать потребности питомца, а также заботиться о его здоровье.') ?>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="bonus" class="container-xl pt-3 pt-lg-5">
    <div class="row">
        <div class="col-xl-6 mb-3 mb-xl-0">
            <div class="row h-100">
                <div class="col-12 align-self-center">
                    <?= Html::img('/images/arrow.svg', [
                            'class' => 'mb-2 mb-lg-3',
                            'style' => '
                                width: 4.5em;
                                transform: rotate(45deg);
                            ',
                        ])
                    ?>
                    <h2 class="text-uppercase font-weight-light mb-1 mb-lg-1_5">
                        <?= Yii::t('front', 'Программа привилегий') ?> UME
                    </h2>
                    <div class="row">
                        <div class="col-md-11 col-lg-10 col-xl-9 ">
                            <p class="font-weight-bolder mb-2 mb-lg-3">
                                <?= Yii::t('front', 'Эффективный сервис услуг и систем поощрения ваших питомцев. Делайте простые действия и получайте баллы.') ?>
                            </p>
                            <a href="<?= Url::to(['/bonus']) ?>" class="btn btn-secondary rounded-pill px-2 py-1 font-weight-bolder">
                                <?= Yii::t('front', 'Подробнее') ?>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-12 align-self-end d-none d-xl-block">
                    <hr class="border-gray-800 my-2" style="margin-right: -30px;">
                </div>
            </div>
        </div>
        <div class="col-xl-6 overflow-hidden position-relative stacked-fade">
            <div class="row">
                <div class="col-auto">
                    <div class="owl-carousel-stacked d-none row" data-related="#app-slider-description-2">
                        <div class="col-auto pr-0 pr-sm-1 max-vw-75">
                            <img src="/images/main/app-4_<?= Yii::$app->language ?>.png" alt="<?= $this->title ?>" class="img-fluid">
                        </div>
                        <div class="col-auto pr-0 pr-sm-1 max-vw-75">
                            <img src="/images/main/app-5_<?= Yii::$app->language ?>.png" alt="<?= $this->title ?>" class="img-fluid">
                        </div>
                        <div class="col-auto pr-0 pr-sm-1 max-vw-75">
                            <img src="/images/main/app-6_<?= Yii::$app->language ?>.png" alt="<?= $this->title ?>" class="img-fluid">
                        </div>
                        <div class="col-auto pr-0 pr-sm-1 max-vw-75">
                            <img src="/images/main/app-7_<?= Yii::$app->language ?>.png" alt="<?= $this->title ?>" class="img-fluid">
                        </div>
                    </div>
                    <hr class="border-gray-800 my-2">
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-auto offset-xl-6 overflow-hidden" style="width: 245px;">
            <div id="app-slider-description-2" class="owl-carousel-stacked app-slider-description">
                <div class="bg-white">
                    <p class="font-weight-bolder">
                        <?= Yii::t('front', 'Покупать товары и получать бонусы') ?>
                    </p>
                </div>
                <div class="bg-white">
                    <p class="font-weight-bolder">
                        <?= Yii::t('front', 'Размещать посты в своей ленте') ?>
                    </p>
                </div>
                <div class="bg-white">
                    <p class="font-weight-bolder">
                        <?= Yii::t('front', 'Приглашать как можно больше друзей') ?>
                    </p>
                </div>
                <div class="bg-white">
                    <p class="font-weight-bolder">
                        <?= Yii::t('front', 'Покупать подписки и услуги консьержа') ?>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
    if ($news) {
?>
        <div class="container-xl mt-2 mt-lg-4 mb-5 mb-lg-9">
            <div class="row">
                <div class="col-12 mb-2">
                    <h2 class="text-uppercase font-weight-light mb-2">
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
