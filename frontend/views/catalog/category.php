<?php

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

    <div class="row justify-content-center align-items-center no-gutters category-bg">
        <div class="col-12">
            <div class="row align-items-center py-1 py-lg-2 py-xl-3">
                <div class="col-lg-7 text-center pr-lg-0">
                    <img data-src="<?= $category->getImage()->getUrl() ?>" alt="<?= $title ?> <?= Yii::$app->name ?>" class="lazyload pointer-events-none img-fluid my-1">
                </div>
                <div class="col-lg-5 category-text text-uppercase font-weight-bolder lead pl-lg-0 pr-lg-2 pr-xl-3">
                    <?= $categoryText ?>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container-xl mt-2 mt-lg-3">
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
