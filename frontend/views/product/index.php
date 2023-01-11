<?php

use yii\helpers\Url;
use yii\helpers\Html;
use dvizh\shop\widgets\ShowPrice;
use dvizh\cart\widgets\BuyButton;
use dvizh\cart\widgets\ChangeCount;
use dvizh\cart\widgets\ChangeOptions;
use yii\web\View;
use yii\widgets\Pjax;

$images = $product->getImages();

if ($images) {
    $image = $images[0];
    $cachedImage = '/images/cache/Product/Product' . $image->itemId . '/' . $image->urlAlias . '_x600.' . $image->getExtension();
    $this->registerMetaTag([
        'property' => 'og:image',
        'content' => Url::to(file_exists(Yii::getAlias('@frontend') . '/web' . $cachedImage) ? $cachedImage : $image->getUrl('x600'), true)
    ]);
}

$productName = json_decode($product->name)->{Yii::$app->language};
$h1 = Yii::$app->params['h1'] ?: $productName;
$this->title = Yii::$app->params['title'] ?: $productName . ' - ' . Yii::t('front', 'Купить в интернет-магазине') . ' ' . Yii::$app->name;

?>

<div class="container-xl" itemscope itemtype="http://schema.org/Product">
    <div class="row">
        <div class="col-12">
            <div class="row">
                <div class="col-1 d-none d-md-block pl-0_5 pr-0">
                    <a href="<?= Url::to(['/catalog/' . $category->slug]) ?>">
                        <?= Html::img('/images/arrow.svg', [
                                'class' => 'wow fadeIn',
                                'style' => '
                                    width: 4.5em;
                                    transform: rotate(-135deg);
                                    margin-top: -0.5em;
                                ',
                            ])
                        ?>
                    </a>
                </div>
                <div class="col pl-1">
                    <a href="<?= Url::to(['/catalog/' . $category->slug]) ?>" class="blog-post-date mb-1 opacity-50 text-decoration-none">
                        <?= json_decode($category->name)->{Yii::$app->language} ?>
                    </a>
                    <h1 class="h2 mb-1 mb-lg-2 font-weight-light">
                        <?= $productName ?>
                    </h1>
                </div>
            </div>
        </div>
    </div>
    
    <div class="row no-gutters align-items-center bg-gray-200 py-1">
        <div class="col-lg-6 px-xl-2">
            <div class="owl-carousel owl-theme owl-dots">
        <?php
            foreach ($images as $key => $image) {
                // if ($key) {
                    $cachedImage = '/images/cache/Product/Product' . $image->itemId . '/' . $image->urlAlias . '_x600.' . $image->getExtension();
        ?>
                    <img src="<?= file_exists(Yii::getAlias('@frontend') . '/web' . $cachedImage) ? $cachedImage : $image->getUrl('x600') ?>" class="img-fluid" alt="<?= $image->alt ? $image->alt : $productName ?>" loading="lazy">
        <?php
                // }
            }
        ?>
            </div>
        </div>
        <div class="col-lg-6 px-1 px-lg-2 px-xl-3">
            <h4 class="mb-2 mb-lg-3">
                <?= json_decode($product->text)->{Yii::$app->language} ?>
            </h4>
            <div class="row align-items-center mt-2 mt-lg-3 mt-xl-4">
                <div class="col-auto pr-lg-3" itemprop="offers" itemscope itemtype="http://schema.org/Offer">
                    <meta itemprop="price" content="<?= $price->price ?>">
                    <meta itemprop="priceCurrency" content="<?= Yii::$app->params['currency'] ?>">
                    <?= ShowPrice::widget([
                            'htmlTag' => 'p',
                            'cssClass' => 'h3 font-weight-light',
                            'model' => $product,
                            'price' => $price->price,
                            // 'priceOld' => $priceOld,
                        ])
                    ?>
                </div>
                <div class="col-6">
                    <?= BuyButton::widget([
                            'model' => $product,
                            'price' => $price->price,
                            'count' => 1,
                            'comment' => $price->code,
                            'htmlTag' => 'button',
                            'cssClass' => 'btn btn-secondary rounded-pill py-1 px-2 text-nowrap',
                            'text' => Yii::t('front', 'В корзину'),
                        ]);
                    ?>
                </div>
            </div>
        </div>
    </div>
    
    <div class="row justify-content-center mt-3 mt-lg-4">
        <div class="col-12 col-lg-11 col-xl-10">
            <h3 class="font-weight-light text-uppercase mb-2">
                <?= Yii::t('front', 'Описание') ?>
            </h3>
    <?php
        if ($product->short_text){
    ?>
            <div id="product-description" class="product-table-content">
                <?= json_decode($product->short_text)->{Yii::$app->language} ?>
            </div>
    <?php
        }
    ?>
    
    <?php
        if ($product->additives){
    ?>
            <div id="product-additives" class="product-table-content">
                <?= json_decode($product->additives)->{Yii::$app->language} ?>
            </div>
    <?php
        }
    ?>
    
    <?php
        if ($product->components){
    ?>
            <div id="product-components" class="product-table-content">
                <?= json_decode($product->components)->{Yii::$app->language} ?>
            </div>
    <?php
        }
    ?>
    
    <?php
        if ($product->feeding){
    ?>
            <div id="product-feeding" class="product-table-content">
                <?= json_decode($product->feeding)->{Yii::$app->language} ?>
            </div>
    <?php
        }
    ?>
    
    <?php
        if ($product->howtouse){
    ?>
            <div id="product-howtouse">
                <?= json_decode($product->howtouse)->{Yii::$app->language} ?>
            </div>
    <?php
        }
    ?>
        </div>
    </div>
</div>



<?php
    $this->registerJs("
        outOfStock = function () {
            toastr.error('" . Yii::t('front', 'Нет в наличии') . "');
        }
    ");
?>

<?php
    $this->registerJs("
        $('table').addClass('table mb-0').wrap('<div class=\"table-responsive\"></div>');
        $('.table-responsive').each(function () {
            if (!$(this).parent().is('#product-feeding')) {
                $(this).find('tr').each(function () {
                    $(this).find('td').eq(0).addClass('col-7 font-weight-bloder');
                    $(this).find('td').eq(1).addClass('col-5');
                });
                $(this).find('tr').eq(0).find('td').addClass('bg-gray-600 text-white font-weight-bold');
            }
        });
        $('#product-feeding').find('tr').eq(0).find('td').addClass('bg-secondary text-white font-weight-bold');
    ", View::POS_READY);
?>

<?php
    $this->registerJS("
            // function setProductOptionsOnLoad() {
                // $($('.dvizh-option-values-before').get().reverse()).each(function () {
                    // $(this).trigger('change');
                // });
            // }
        
            // setProductOptionsOnLoad();
            
            // var id,
                // options = {};
            // $('.dvizh-option').each(function () {
                // var option = $(this).find('.dvizh-option-values-before:first'),
                    // optionId = $(option).data('filter-id'),
                    // optionVal = $(option).val();
                // options[optionId] = optionVal;
            // });

// console.log(options);
            // $('.dvizh-cart-buy-button').data('options', options);
            // $('.dvizh-cart-buy-button').attr('data-options', options);
            
            // $('.dvizh-option-values-before:first').trigger('click');
            
            // $('#option1 option:first').trigger('click');
            // $(document).trigger('beforeChangeCartElementOptions', id);
        ",
        View::POS_READY,
        'set-product-options-on-load'
    );
?>


<?php // Yandex Ecommerce
    $this->registerJs("
        // var id = $('.dvizh-cart-buy-button').attr('data-comment'),
            // name = '" . $product_name . "',
            // price = '" . round($price) . "',
            category = '" . json_decode($categoryName)->{Yii::$app->language} . "',
            // variant = $('.dvizh-option:first').find('.dvizh-option-values-before:checked').closest('label').text().trim(),
            // currency = '" . Yii::$app->params['currency'] . "';
            
        // ymDetail(id, name, price, variant, currency);
        // fbqViewContent(id, name, price, variant, currency);
    ", View::POS_READY);
?>

<?php
    $this->registerJs("
        // $(document).on('click', '.dvizh-cart-buy-button', function () {
            // var id = $('.dvizh-cart-buy-button').attr('data-comment'),
                // name = '" . $product_name . "',
                // quantity = 1,
                // price = '" . round($price) . "',
                // category = '" . json_decode($categoryName)->{Yii::$app->language} . "',
                // variant = $('.dvizh-option:first').find('.dvizh-option-values-before:checked').closest('label').text().trim(),
                // currency = '" . Yii::$app->params['currency'] . "';
                
            // ymAdd(id, name, price, variant, currency);
            // fbqAddToCart(id, name, price, variant, currency);
        // });
    ", View::POS_READY);
?>
