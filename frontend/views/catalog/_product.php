<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\HtmlPurifier;
use dvizh\shop\widgets\ShowPrice;
use dvizh\cart\widgets\BuyButton;
use dvizh\cart\widgets\ChangeCount;
use dvizh\cart\widgets\ChangeOptions;
use PELock\ImgOpt\ImgOpt;

$productName = json_decode($product->name)->{Yii::$app->language};

$image = $product->getImage();
$cachedImage = '/images/cache/Product/Product' . $image->itemId . '/' . $image->urlAlias . '_' . Yii::$app->params['productImageSizes']['S'] . 'x.' . $image->extension;
$imageUrl = file_exists(Yii::getAlias('@frontend') . '/web' . $cachedImage) ? $cachedImage : $image->getUrl(Yii::$app->params['productImageSizes']['S'] . 'x');
?>

<a href="<?= Url::to(['/product/' . $product->slug]) ?>" class="col-sm-6 mb-1 mb-sm-3 mb-xl-5 text-dark text-decoration-none">
    <div class="col-sm-12 col-md-11 col-lg-10 col-xl-11 py-3 px-3 bg-gray-200 position-relative h-100">
        <?= ImgOpt::widget([
                'src' => $imageUrl, 
                'alt' => $productName,
                'loading' => 'lazy',
                'css' => 'lazyload img-fluid d-xl-none mb-1',
            ])
        ?>
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
                        'cssClass' => 'btn btn-secondary rounded-pill py-1 px-2 d-flex' . ($prices[$product->id]['price'] ? '' : ' hidden pointer-events-none'),
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
        <?= ImgOpt::widget([
                'src' => $imageUrl, 
                'alt' => $productName,
                'loading' => 'lazy',
                'css' => 'lazyload img-fluid',
            ])
        ?>
    </div>
</a>