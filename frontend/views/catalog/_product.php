<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\HtmlPurifier;
use dvizh\shop\widgets\ShowPrice;
use dvizh\cart\widgets\BuyButton;
use dvizh\cart\widgets\ChangeCount;
use dvizh\cart\widgets\ChangeOptions;

$productName = json_decode($product->name)->{Yii::$app->language};
?>

<a href="<?= Url::to(['/product/' . $product->slug]) ?>" class="col-sm-6 mb-1 mb-sm-3 mb-xl-5 text-dark text-decoration-none">
    <div class="col-sm-12 col-md-11 col-lg-10 col-xl-11 py-3 px-3 bg-gray-200 position-relative h-100">
        <img data-src="<?= $product->getImage()->getUrl() ?>" class="lazyload img-fluid d-xl-none mb-1" alt="<?= $productName ?>">
        <h4 class="mb-2 font-weight-bolder">
            <?= $productName ?>
        </h4>
        <div class="row no-gutters h-50">
            <div class="col-xl-7">
                <div class="mb-2 font-weight-bolder">
                    <?= json_decode($product->text)->{Yii::$app->language} ?>
                </div>
                <?= BuyButton::widget([
                        'model' => $product,
                        'price' => $prices[$product->id]['price'],
                        'count' => 1,
                        'comment' => $prices[$product->id]['code'],
                        'htmlTag' => 'button',
                        'cssClass' => 'btn btn-secondary rounded-pill py-1 px-2 d-flex',
                        'text' => Yii::t('front', 'Купить') . ' ' . ShowPrice::widget([
                            'htmlTag' => 'span',
                            'cssClass' => 'text-nowrap ml-0_5',
                            'model' => $product,
                            'price' => $prices[$product->id]['price'],
                        ]),
                    ]);
                ?>
            </div>
        </div>
    </div>
    <div class="col-8 position-absolute bottom-0 right-0 d-none d-xl-block" style="transform: translate(7%, 10%);">
        <img data-src="<?= $product->getImage()->getUrl() ?>" class="lazyload img-fluid pointer-events-none" alt="<?= $productName ?>">
    </div>
</a>