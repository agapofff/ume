<?php

use yii\helpers\Url;
use yii\helpers\Html;

$this->title = Yii::$app->name;

?>

<div id="index1" class="container-lg container-xl container-xxl mb-5">
    <div class="row align-items-center mb-2 wow fadeIn" data-wow-duration="0.5s">
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

<div id="index2" class="container-lg container-xl container-xxl mb-2 mb-lg-4">
    <div class="row">
        <div class="col-lg-6 col-xl-5 offset-xl-1 mb-3 mb-lg-0">
            <div id="about" class="accordion">
                <div class="wow fadeInUp">
                    <h4 id="us-label" class="d-flex mb-1 mr-1 text-uppercase">
                        <a href="#us" class="d-block w-100 text-decoration-none text-dark accordion-arrow" data-toggle="collapse" aria-expanded="true" aria-controls="us" onclick="owlGoTo('#about-slider', 0);">
                            <div class="row align-items-center">
                                <div class="col-auto">
                                    <?= Yii::t('front', 'Мы') ?>
                                </div>
                                <div class="col-auto justify-content-end arrow text-right pl-4 pr-0 transition">
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
                </div>
                <div class="wow fadeInUp">
                    <hr class="my-0">
                    <h4 id="philosophy-label" class="d-flex mt-1 mb-1 mr-1 text-uppercase">
                        <a href="#philosophy" class="d-block w-100 text-decoration-none text-dark accordion-arrow" data-toggle="collapse" aria-expanded="false" aria-controls="philosophy" onclick="owlGoTo('#about-slider', 1);">
                            <div class="row align-items-center">
                                <div class="col-auto">
                                    <?= Yii::t('front', 'Философия') ?>
                                </div>
                                <div class="col-auto justify-content-end arrow text-right pl-4 pr-0 transition">
                                    <img src="/images/arrow_corner.svg" class="arrow-corner">
                                </div>
                            </div>
                        </a>
                    </h4>
                    <div id="philosophy" class="collapse" aria-labelledby="philosophy-label" data-parent="#about">
                        <p>
                            <?= Yii::t('front', 'Лучше узнать животных с использованием искусственного интеллекта, чтобы общаться со своими питомцами на одном языке') ?>
                        </p>
                    </div>
                </div>
                <div class="wow fadeInUp">
                    <hr class="my-0">
                    <h4 id="target-label" class="d-flex mt-1 mb-1 mr-1 text-uppercase">
                        <a href="#target" class="d-block w-100 text-decoration-none text-dark accordion-arrow" data-toggle="collapse" aria-expanded="false" aria-controls="target" onclick="owlGoTo('#about-slider', 2);">
                            <div class="row align-items-center">
                                <div class="col-auto">
                                    <?= Yii::t('front', 'Цель') ?>
                                </div>
                                <div class="col-auto justify-content-end arrow text-right pl-4 pr-0 transition">
                                    <img src="/images/arrow_corner.svg" class="arrow-corner">
                                </div>
                            </div>
                        </a>
                    </h4>
                    <div id="target" class="collapse" aria-labelledby="target-label" data-parent="#about">
                        <p>
                            <?= Yii::t('front', 'Обеспечить четвероногих друзей высококачественной, здоровой и полезной едой, которая непременно придётся им по вкусу') ?>
                        </p>
                    </div>
                </div>
                <div class="wow fadeInUp">
                    <hr class="my-0">
                    <h4 id="mission-label" class="d-flex mt-1 mb-1 mr-1 text-uppercase">
                        <a href="#mission" class="d-block w-100 text-decoration-none text-dark accordion-arrow" data-toggle="collapse" aria-expanded="false" aria-controls="mission" onclick="owlGoTo('#about-slider', 3);">
                            <div class="row align-items-center">
                                <div class="col-auto">
                                    <?= Yii::t('front', 'Миссия') ?>
                                </div>
                                <div class="col-auto justify-content-end arrow text-right pl-4 pr-0 transition">
                                    <img src="/images/arrow_corner.svg" class="arrow-corner">
                                </div>
                            </div>
                        </a>
                    </h4>
                    <div id="mission" class="collapse" aria-labelledby="mission-label" data-parent="#about">
                        <p>
                            <?= Yii::t('front', 'Развитие технологий и создание продуктов, которые помогают людям лучше понимать и качественнее обеспечивать потребности питомца, а также заботиться о его здоровье.') ?>
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6 wow fadeIn">
            <div id="about-slider" class="owl-carousel owl-theme owl-fade">
                <img src="/images/main/banner3.jpg" class="img-fluid border border-gray-500" alt="<?= $title ?>">
                <img src="/images/main/banner2.jpg" class="img-fluid border border-gray-500" alt="<?= $title ?>">
                <img src="/images/main/banner5.jpg" class="img-fluid border border-gray-500" alt="<?= $title ?>">
                <img src="/images/main/banner7.jpg" class="img-fluid border border-gray-500" alt="<?= $title ?>">
            </div>
        </div>
    </div>
</div>

<div id="index3" class="position-relative mb-5">

    <div class="container-lg container-xl container-xxl sticky-top title">
        <div class="row">
            <div class="col-lg-12 col-xl-11 offset-xl-1">
                <h2 class="text-uppercase mb-2 wow fadeInUp">
                    <?= Yii::t('front', 'Преимущества') ?>
                </h2>
            </div>
        </div>
    </div>
    
    <div class="container-lg container-xl container-xxl description transition pb-2">
        <div class="row">
            <div class="col-lg-12 col-xl-11 offset-xl-1">
                <div class="row position-relative">
                    <div class="col-md-9 col-lg-8 col-xl-7 offset-lg-1 offset-xl-2">
                        <h5 class="text-uppercase wow fadeInUp">
                            <?= Yii::t('front', 'Мы знаем, какую важную роль в жизни домашних питомцев играет правильное питание, и используем революционные идеи, чтобы достичь максимальной пользы и безопасности наших кормов.') ?>
                        </h5>
                    </div>
                    <?= Html::img('/images/arrow.svg', [
                            'class' => 'position-absolute bottom-0 right-0 d-none d-md-block mr-0_5 wow fadeIn',
                            'style' => '
                                width: 4.5em;
                                -webkit-transform: rotate(135deg);
                                -moz-transform: rotate(135deg);
                                transform: rotate(135deg);
                            ',
                        ])
                    ?>
                </div>
            </div>
        </div>
    </div>

    <div class="container-lg container-xl container-xxl sticky-top advantages">
        <a href="<?= Url::to(['/about#innovations']) ?>" class="d-block mb-0_5 text-dark text-decoration-none">
            <div class="row">
                <div class="col-lg-11 offset-lg-1">
                    <div class="row">
                        <div class="col-sm-2">
                            <div class="display-1 text-white transition">
                                01
                            </div>
                        </div>
                        <div class="col-sm-10 pt-1_5">
                            <hr class="m-0 border-dark">
                            <div class="row pt-2">
                                <div class="col-md-4">
                                    <h5 class="mb-1">
                                        <?= Yii::t('front', 'Инновации и ИИ') ?>
                                    </h5>
                                    <?= Html::img('/images/arrow_small.svg', [
                                            'class' => 'd-none d-md-block wow rotateIn',
                                            'style' => '
                                                width: 3em;
                                                margin-left: -0.5em;
                                            ',
                                        ])
                                    ?>
                                </div>
                                <div class="col-md-8">
                                    <img src="/images/main/banner4.jpg" class="img-fluid border border-gray-500" alt="<?= $title ?>">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </a>
    </div>
        
    <div class="container-lg container-xl container-xxl sticky-top advantages">
        <a href="<?= Url::to(['/about#alternatives']) ?>" class="d-block mb-0_5 text-dark text-decoration-none">
            <div class="row">
                <div class="col-lg-11 offset-lg-1">
                    <div class="row">
                        <div class="col-sm-2">
                            <div class="display-1 text-white transition">
                                02
                            </div>
                        </div>
                        <div class="col-sm-10 pt-1_5">
                            <hr class="m-0 border-dark">
                            <div class="row pt-2">
                                <div class="col-md-4">
                                    <h5 class="mb-1">
                                        <?= Yii::t('front', 'Альтернативные источники белка') ?>
                                    </h5>
                                    <?= Html::img('/images/arrow_small.svg', [
                                            'class' => 'd-none d-md-block wow rotateIn',
                                            'style' => '
                                                width: 3em;
                                                margin-left: -0.5em;
                                            ',
                                        ])
                                    ?>
                                </div>
                                <div class="col-md-8">
                                    <img src="/images/main/banner5.jpg" class="img-fluid border border-gray-500" alt="<?= $title ?>">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </a>
    </div>
    
    <div class="container-lg container-xl container-xxl sticky-top advantages">    
        <a href="<?= Url::to(['/about#ginseng']) ?>" class="d-block mb-0_5 text-dark text-decoration-none">
            <div class="row">
                <div class="col-lg-11 offset-lg-1">
                    <div class="row">
                        <div class="col-sm-2">
                            <div class="display-1 text-white transition">
                                03
                            </div>
                        </div>
                        <div class="col-sm-10 pt-1_5">
                            <hr class="m-0 border-dark">
                            <div class="row pt-2">
                                <div class="col-md-4">
                                    <h5 class="mb-1">
                                        <?= Yii::t('front', 'Белый императорский женьшень') ?>
                                    </h5>
                                    <?= Html::img('/images/arrow_small.svg', [
                                            'class' => 'd-none d-md-block wow rotateIn',
                                            'style' => '
                                                width: 3em;
                                                margin-left: -0.5em;
                                            ',
                                        ])
                                    ?>
                                </div>
                                <div class="col-md-8">
                                    <video autoplay loop muted playsinline class="d-block w-100 border border-gray-500">
                                        <source src="/video/ginseng_small.mp4" type="video/mp4">
                                        <source src="/video/ginseng_small.ogv" type="video/ogv">
                                        <source src="/video/ginseng_small.webm" type="video/webm">
                                    </video>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </a>
    </div>
        
    <div class="container-lg container-xl container-xxl sticky-top advantages">
        <a href="<?= Url::to(['/about#hypoallergenic']) ?>" class="d-block mb-0_5 text-dark text-decoration-none">
            <div class="row">
                <div class="col-lg-11 offset-lg-1">
                    <div class="row">
                        <div class="col-sm-2">
                            <div class="display-1 text-white transition">
                                04
                            </div>
                        </div>
                        <div class="col-sm-10 pt-1_5">
                            <hr class="m-0 border-dark">
                            <div class="row pt-2">
                                <div class="col-md-4">
                                    <h5 class="mb-1">
                                        <?= Yii::t('front', 'Гипоаллергенная беззерновая формула') ?>
                                    </h5>
                                    <?= Html::img('/images/arrow_small.svg', [
                                            'class' => 'd-none d-md-block wow rotateIn',
                                            'style' => '
                                                width: 3em;
                                                margin-left: -0.5em;
                                            ',
                                        ])
                                    ?>
                                </div>
                                <div class="col-md-8">
                                    <img src="/images/main/banner7.jpg" class="img-fluid border border-gray-500" alt="<?= $title ?>">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </a>    
    </div>
    
</div>

<div id="index4" class="container-lg container-xl container-xxl mt-3 mt-lg-5 mb-3 wow fadeIn">
    <div class="row">
        <div class="col-12">
            <video autoplay loop muted playsinline class="d-block w-100">
                <source src="/video/UME_dog_001_1200px.mp4" type="video/mp4">
                <source src="/video/UME_dog_001_1200px.ogv" type="video/ogv">
                <source src="/video/UME_dog_001_1200px.webm" type="video/webm">
            </video>
        </div>
    </div>
</div>

<?php
    if ($products) {
?>
        <div id="index5" class="container-lg container-xl container-xxl mt-5 mt-lg-7 mb-1">
            <div class="row">
                <div class="col-lg-12 col-xl-11 offset-xl-1">
                    <h2 class="text-uppercase wow fadeInUp">
                        <?= Yii::t('front', 'Каталог кормов и аксессуаров') ?>
                    </h2>
                    <p class="wow fadeInUp">
                        <?= Yii::t('front', 'Ознакомьтесь с нашими кормами') ?>
                    </p>
                </div>
            </div>
        </div>
        <div class="owl-carousel owl-theme" data-items="1-1-2-2-2-4" data-loop="true" data-dots="true" data-center="true" data-margin="30">
    <?php
        foreach ($products as $product) {
    ?>
            <a href="<?= '#' // Url::to(['/product/' . $product->slug]) ?>" class="card bg-gray-200 rounded-0 text-dark text-decoration-none">
                <div class="row">
                    <div class="col-6 py-2">
                    <?php
                        $productName = json_decode($product->name)->{Yii::$app->language};
                        $image = $product->getImage();
                        $cachedImage = '/images/cache/Product/Product' . $image->itemId . '/' . $image->urlAlias . '_x300.' . $image->getExtension();
                    ?>
                        <img src="<?= file_exists(Yii::getAlias('@frontend') . '/web' . $cachedImage) ? $cachedImage : $image->getUrl('x300') ?>" class="img-fluid" alt="<?= $image->alt ? $image->alt : $productName ?>" loading="lazy">
                    </div>
                    <div class="col-6 pt-3 pb-2">
                        <div class="row h-100">
                            <div class="col-12 align-self-start">
                                <h5>
                                    <?= $productName ?>
                                </h5>
                            </div>
                            <div class="col-12 align-self-end">
                                <p class="m-0">
                                    <?= Yii::t('front', 'Подробнее') ?>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
    <?php
        }
    ?>
        </div>
<?php
    }
?>

<?php
    if ($reviews) {
?>
        <div class="container-lg container-xl container-xxl mt-5 mt-lg-7 mb-3 overflow-x-hidden">
            <div class="row">
                <div class="col-lg-12 col-xl-11 offset-xl-1 position-relative">
                    <h2 class="text-uppercase text-teal wow fadeInUp">
                        <?= Yii::t('front', 'Отзывы ваших питомцев') ?>
                    </h2>
                    <p class="wow fadeInUp">
                        <?= Yii::t('front', 'Посмотрите, что говорят наши собаки о корме') ?> <span class="text-uppercase font-weight-bold"><?= Yii::t('front', 'For ultra{0}high-net-worth{1}dogs', [' ', ' ']) ?></span>
                    </p>
                </div>
                <div class="col-12 mt-5 mt-lg-7">
                    <div class="reviews-carousel">
                <?php
                    foreach ($reviews as $r => $review) {
                        $petPhoto = $review->getImage();
                        $cachedImage = $petPhoto ? '/images/cache/Reviews/Reviews' . $petPhoto->itemId . '/' . $petPhoto->urlAlias . '_300x300.' . $petPhoto->getExtension() : '/images/placeholder.png';
                        
                        $age = $review->pet_birthday ? explode(',', Yii::$app->formatter->asDuration((new DateTime())->setTimestamp(time())->diff(new DateTime($review->pet_birthday)), ',', ''))[0] : null;
                ?>
                        <div class="review mx-1" data-id="<?= $r ?>">
                            <div class="row">
                                <div class="col-12 col-sm-auto pet-photo position-relative text-teal ">
                                    <img src="<?= file_exists(Yii::getAlias('@frontend') . '/web' . $cachedImage) ? $cachedImage : $petPhoto->getUrl('300x300') ?>" class="img-fluid border-teal rounded-pill mt-3 mx-1" alt="<?= $review->pet_name ?>" loading="lazy">
                                </div>
                                <div class="col-12 col-sm p-0 overflow-hidden content position-relative">
                                    <div class="mt-1 mr-2 ml-0_5 mb-0">
                                        <p class="font-weight-light">
                                            <?= $review->text ?>
                                        </p>
                                        <p class="font-weight-bold">
                                            <?= $review->pet_name ?>, <?= json_decode($review->breed->name)->{Yii::$app->language} ?><?= $age ? ', ' . $age : '' ?>
                                        </p>
                                        <div class="rating">
                                        <?php
                                            for ($i = 0; $i <= $review->rating; $i++) {
                                                echo Html::img('/images/rating_star_mini.svg');
                                            }
                                        ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                <?php
                    }
                ?>
                    </div>
                </div>
            </div>
        </div>
<?php
    }
?>

<?php
    if ($news) {
?>
        <div class="container-lg container-xl container-xxl mt-5 mt-lg-7 mb-3">
            <div class="row">
                <div class="col-lg-12 col-xl-11 offset-xl-1 mb-2">
                    <h2 class="text-uppercase wow fadeInUp">
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

