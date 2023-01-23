<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\Pjax;
use PELock\ImgOpt\ImgOpt;

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
                <?php
                    $image = $category->getImage();
                    $cachedImage = '/images/cache/Category/Category' . $image->itemId . '/' . $image->urlAlias . '.' . $image->extension;
                    $imageSrc = file_exists(Yii::getAlias('@frontend') . '/web' . $cachedImage) ? $cachedImage : $image->getUrl();
                ?>
                    <?= ImgOpt::widget([
                            'src' => $imageSrc, 
                            'alt' => $this->title,
                            'loading' => 'lazy',
                            'css' => 'pointer-events-none my-1',
                        ])
                    ?>
                </div>
                <div class="col-lg-5 category-text text-uppercase font-weight-bolder lead pl-2 pr-2 pl-lg-0 pr-lg-2 pr-xl-3">
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
                        <div class="col-3 col-sm-auto">
                            <img src="/images/catalog/icon1.svg" class="img-fluid">
                        </div>
                        <div class="col">
                            <p class="h5 text-uppercase font-weight-light mb-0">
                                <?= Yii::t('front', 'Стимулируют иммунную систему') ?>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 my-1 my-lg-2">
                    <div class="row align-items-center">
                        <div class="col-3 col-sm-auto">
                            <img src="/images/catalog/icon2.svg" class="img-fluid">
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
                        <div class="col-3 col-sm-auto">
                            <img src="/images/catalog/icon3.svg">
                        </div>
                        <div class="col">
                            <p class="h5 text-uppercase font-weight-light mb-0">
                                <?= Yii::t('front', 'Улучшает работу сердечно-сосудистой системы и ЖКТ') ?>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 my-1 my-lg-2">
                    <div class="row align-items-center">
                        <div class="col-3 col-sm-auto">
                            <img src="/images/catalog/icon4.svg" class="img-fluid">
                        </div>
                        <div class="col">
                            <p class="h5 text-uppercase font-weight-light mb-0">
                                <?= Yii::t('front', 'Способствуют активному долголетию') ?>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container-xl mt-2 mt-lg-3">
<?php
    if ($products) {
?>
        <div class="row">
    <?php
        foreach ($products as $product) {
            echo $this->render('@frontend/views/catalog/_product', [
                'product' => $product,
                'prices' => $prices,
            ]);
        }
    ?>
        </div>
<?php
    }
?>
