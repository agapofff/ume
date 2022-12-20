<?php

    use dvizh\cart\widgets\CartInformer;
    use dvizh\cart\widgets\ElementsList;
    use dvizh\order\widgets\OrderForm;
    use yii\web\View;
    
    $this->title = Yii::t('front', 'Оформить заказ');
?>

<div class="container-xl mb-3">
    <h1 class="font-weight-light text-uppercase position-relative d-inline">
        <?= Yii::t('front', 'Корзина') ?>
        <?= CartInformer::widget([
                'htmlTag' => 'sup',
                'cssClass' => 'dvizh-cart-informer text-orange p-0 h2 position-absolute top-0 left-100 ml-1 mt-0 font-weight-light',
                'text' => '{c}'
            ]);
        ?>
    </h1>
</div>

<div class="container-xl">
    <div class="row justify-content-center">    
        <div class="col-12">
            <?= ElementsList::widget([
                    'type' => 'checkout',
                    'currency' => $currency,
                    'lang' => Yii::$app->language,  
                    'showTotal' => true,
                ]);
            ?>
        </div>
        <div class="col-12">
            <?= OrderForm::widget();?>
        </div>
    </div>
</div>
            




<?php
    // $this->registerJs("
        // $(document).ajaxComplete(function (event, xhr) {
            // var url = xhr && xhr.getResponseHeader('X-Redirect');
            // if (url) {
                // window.location.assign(url);
            // }
        // });
    // ",
    // View::POS_READY,
    // 'ajax-redirect');
?>