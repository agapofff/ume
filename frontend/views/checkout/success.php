<?php
    use yii\web\View;
    use yii\helpers\Url;
    use yii\helpers\Html;
    
    $this->title = Yii::t('front', 'Ваш заказ успешно оформлен');
?>


<div class="container-xl">
    <div class="row">
        <div class="col-12 text-center">
            <h1 class="font-weight-light mb-3">
                <?= Yii::t('front', 'Ваш заказ успешно оформлен') ?>
            </h1>
            <h2 class="font-weight-light">
                <?= Yii::t('front', 'Мы отправим письмо с подтверждением заказа на Ваш e-mail') ?>
            </h2>
        </div>
    </div>
</div>

<?php
    $this->registerJs("
        // ymPurchase('" . date('YmdHis') . "', '" . json_encode($products) . "', '" . Yii::$app->params['currency'] . "');
        // fbqPurchase('" . json_encode($products) . "', '" . $sum . "', '" . Yii::$app->params['currency'] . "');
    ", View::POS_READY);
?>