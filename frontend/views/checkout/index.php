<?php

    use dvizh\cart\widgets\CartInformer;
    use dvizh\cart\widgets\ElementsList;
    use dvizh\order\widgets\OrderForm;
    use yii\web\View;
    
    $this->title = Yii::t('front', 'Оформить заказ');
?>

<div class="container-xl">
    <div class="row justify-content-center">    
        <h1 class="font-weight-light text-uppercase mb-3">
            <?= Yii::t('front', 'Корзина') ?>
            <?= CartInformer::widget([
                    'htmlTag' => 'sup',
                    'cssClass' => 'text-orange p-0',
                    'text' => '{c}'
                ]);
            ?>
        </h1>
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