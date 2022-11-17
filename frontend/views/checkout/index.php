<?php

    use dvizh\cart\widgets\CartInformer;
    use dvizh\cart\widgets\ElementsList;
    use dvizh\order\widgets\OrderForm;
    use yii\web\View;
    
    $this->title = Yii::t('front', 'Оформить заказ');
?>

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