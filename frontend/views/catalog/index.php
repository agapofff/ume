<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\ListView;
use yii\widgets\Pjax;

$this->title = Yii::$app->params['title'] ?: Yii::t('front', 'Каталог');

$h1 = Yii::$app->params['h1'] ?: $this->title;

// \yii\web\YiiAsset::register($this);

?>

<div class="container-xl">
    <h1 class="text-uppercase font-weight-light mb-3">
        <?= $h1 ?>
    </h1>
    <div class="row mt-1 mt-lg-3">
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
<?php
    /*
    if ($categories) {
        foreach ($categories as $category) {
?>
            <a href="<?= Url::to(['/catalog/' . $category->slug]) ?>" class="row justify-content-center align-items-center no-gutters category-bg mb-2 mb-lg-3 text-decoration-none text-dark">
                <div class="col-12">
                    <div class="row align-items-center py-1 py-lg-2 py-xl-3">
                        <div class="col-lg-7 text-center pr-lg-0">
                            <img data-src="<?= $category->getImage()->getUrl() ?>" alt="<?= $title ?> <?= Yii::$app->name ?>" class="lazyload pointer-events-none img-fluid my-1">
                        </div>
                        <div class="col-lg-5 category-text text-uppercase font-weight-bolder pl-2 pr-2 pl-lg-0 pr-lg-2 pr-xl-3">
                            <h3 class="font-weight-bolder mb-2">
                                <?= json_decode($category->name)->{Yii::$app->language} ?>
                            </h3>
                            <div class="lead">
                                <?= json_decode($category->text)->{Yii::$app->language} ?>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
<?php
        }
    }
    */
?>
</div>