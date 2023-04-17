<?php
    use yii\helpers\Html;
    use yii\web\View;
    
    $name = json_decode($model->name)->{Yii::$app->language};
    $text = json_decode($model->text)->{Yii::$app->language};
    
    $this->title = Yii::$app->params['title'] ?: $name;
    
    $h1 = Yii::$app->params['h1'] ?: $name;
?>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-xs-12 col-md-10 col-lg-9 col-xl-8 col-xxl-7">
            <h1 class="h4 mb-5 text-uppercase text-center">
                <?= $h1 ?>
            </h1>
            <div id="page-content">
                <?= $text ?>
            </div>
        </div>
    </div>
</div>
