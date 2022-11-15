<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\ListView;
use yii\widgets\Pjax;

$categoryName = json_decode($category->name)->{Yii::$app->language};
$categoryText = json_decode($category->text)->{Yii::$app->language};

$this->title = Yii::$app->params['title'] ?: $categoryName;
if (!Yii::$app->params['description']) {
    $this->registerMetaTag([
        'name' => 'description',
        'content' => $categoryText
    ]);
}

$h1 = Yii::$app->params['h1'] ?: $this->title;

// \yii\web\YiiAsset::register($this);

?>

<div class="container-xl">
    <h1 class="text-uppercase font-weight-light mb-3">
        <?= $h1 ?>
    </h1>

    <div class="row justify-content-center align-items-center no-gutters category-bg d-none">
        <div class="col-12">
            <div class="row align-items-center py-1 py-lg-2 py-xl-3">
                <div class="col-lg-7 text-center pr-lg-0">
                    <img data-src="<?= $category->getImage()->getUrl() ?>" alt="<?= $title ?> <?= Yii::$app->name ?>" class="lazyload pointer-events-none img-fluid my-1">
                </div>
                <div class="col-lg-5 category-text text-uppercase font-weight-bolder lead pl-2 pr-2 pl-lg-0 pr-lg-2 pr-xl-3">
                    <?= $categoryText ?>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container-xl mt-2 mt-lg-3 d-none">
    <div class="row justify-content-center align-items-center">
        <div class="col-lg-11 col-xl-10">
            <div class="row">
                <div class="col-lg-6 my-1 my-lg-2">
                    <div class="row align-items-center">
                        <div class="col-auto">
                            <img src="/images/catalog/icon1.svg">
                        </div>
                        <div class="col">
                            <p class="h5 text-uppercase font-weight-light mb-0">
                                <?= Yii::t('front', 'Стимулируют иммуную систему') ?>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 my-1 my-lg-2">
                    <div class="row align-items-center">
                        <div class="col-auto">
                            <img src="/images/catalog/icon2.svg">
                        </div>
                        <div class="col">
                            <p class="h5 text-uppercase font-weight-light mb-0">
                                <?= Yii::t('front', 'Повышает выносливость и стрессоустойчивость') ?>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 my-1 my-lg-2">
                    <div class="row align-items-center">
                        <div class="col-auto">
                            <img src="/images/catalog/icon3.svg">
                        </div>
                        <div class="col">
                            <p class="h5 text-uppercase font-weight-light mb-0">
                                <?= Yii::t('front', 'Улучшает работу середечно-сусудистой системы и ЖКТ') ?>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 my-1 my-lg-2">
                    <div class="row align-items-center">
                        <div class="col-auto">
                            <img src="/images/catalog/icon4.svg">
                        </div>
                        <div class="col">
                            <p class="h5 text-uppercase font-weight-light mb-0">
                                <?= Yii::t('front', 'Способствуют актвиному долголетию') ?>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container-xl mt-2 mt-lg-3 d-none">
<?php
    if ($products) {
?>
        <div class="row">
    <?php
        foreach ($products as $product) {
            $productName = json_decode($product->name)->{Yii::$app->language};
    ?>
            <a href="<?= Url::to(['/product/' . $product->slug]) ?>" class="col-sm-6 mb-1 mb-sm-3 mb-xl-5 text-dark text-decoration-none">
                <div class="col-sm-12 col-md-11 col-lg-10 col-xl-11 py-3 px-3 bg-gray-200 position-relative h-100">
                    <img src="<?= $product->getImage()->getUrl() ?>" class="img-fluid d-xl-none mb-1" alt="<?= $productName ?>">
                    <h4 class="mb-2 font-weight-bolder">
                        <?= $productName ?>
                    </h4>
                    <div class="row no-gutters h-50">
                        <div class="col-xl-8 col-xxl-7">
                            <p class="mb-3 font-weight-bolder">
                                <?= Yii::t('front', 'Полнорационный стерилизованный влажный корм UME с энтопротеином и белым императорским женьшенем') ?>
                            </p>
                            <p class="h3 font-weight-light">
                                <?= Yii::$app->formatter->asCurrency($prices[$product->id]['price'], $store->currency) ?>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-5 position-absolute bottom-0 right-0 d-none d-xl-block" style="transform: translate(0, 10%);">
                    <img src="<?= $product->getImage()->getUrl() ?>" class="img-fluid" alt="<?= $productName ?>">
                </div>
            </a>
    <?php
        }
    ?>
        </div>
<?php
    }
?>
