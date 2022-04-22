<?php

    use yii\helpers\Url;
    use yii\helpers\Html;
    use yii\widgets\ActiveForm;
    use yii\widgets\Pjax;
    use yii\web\View;

    $this->title = Yii::t('front', 'Избранное');
    
?>

<div class="container-fluid mt-13 px-lg-2 px-xl-3 px-xxl-5">
    <div class="row justify-content-center">
        <div class="col-lg-6 mb-4 d-none d-lg-block">
            <?= $this->render('@frontend/views/user/settings/_menu') ?>
        </div>
        <div class="col-12 col-sm-10 col-md-8 col-lg-6">
        
            <h1 class="ttfirsneue text-uppercase font-weight-light text-center d-lg-none mb-3">
                <?= $this->title ?>
            </h1>
            
    <?php
        if ($items) {
            
            Pjax::begin([
                'enablePushState' => false,
            ]);
            
            foreach ($items as $item) {
    ?>

                <div class="row">
                    <div class="col-4">
                        <a href="<?= Url::to(['/product/' . $item['slug']]) ?>">
                            <img src="<?= $item['image'] ?>" class="img-fluid">
                        </a>
                    </div>
                    <div class="col-5">
                        <div class="row h-100">
                            <div class="col-12 align-self-start">
                                <p class="font-weight-bold">
                                    <?= $item['name'] ?> <?= $item['size'] ?>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="row h-100">
                            <div class="col-12 align-self-start text-right">
                                <span class="dvizh-cart-element-price696 font-weight-bold text-nowrap text-center">
                                    <?= Yii::$app->formatter->asCurrency($item['price'], Yii::$app->params['currency']) ?>
                                </span>
                            </div>
                            <div class="col-12 align-self-end text-right mb-0_5">
                                <a href="<?= Url::to(['/wishlist',
                                    'product_id' => $item['product_id'],
                                    'size' => $item['size']
                                ]) ?>">
                                    <?= Yii::t('front', 'Удалить') ?>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <hr class="my-1_5">

    <?php
            }
            
            Pjax::end();
        }
    ?>
        </div>
    </div>
</div>