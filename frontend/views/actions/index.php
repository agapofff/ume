<?php

use yii\web\View;
use yii\helpers\Url;
use yii\helpers\Html;
use frontend\helpers\ImageHelper;

$this->title = Yii::t('front', 'Акции');

?>

<div class="container-lg container-xl container-xxl">

    <h1 class="mb-3 text-uppercase">
        <?= Yii::t('front', 'Акции') ?>
    </h1>

    <div id="actions" class="row mb-3">
    <?php
        foreach ($actions as $action) {
            $image = $action->getImage();
            $isDark = ImageHelper::isDark(ImageHelper::getMainColor($image->getPath()));
            $cachedImage = '/images/cache/Actions/Actions' . $image->itemId . '/' . $image->urlAlias . '_800x400.' . $image->getExtension();
            $name = json_decode($post->action)->{Yii::$app->language};
    ?>
        <div class="col-md-6">
            <a href="<?= Url::to(['/actions/' . $action->slug]) ?>" class="card rounded-0 border-0 mb-2 text-dark">
                <img src="<?= file_exists(Yii::getAlias('@frontend') . '/web' . $cachedImage) ? $cachedImage : $image->getUrl('800x400') ?>" alt="<?= $image->alt ?: $name ?>" class="card-img rounded-0" loading="lazy">
                <div class="card-img-overlay p-1_5">
                    <div class="row">
                        <div class="col-6">
                            <p class="blog-post-date mb-1_5 opacity-50">
                                <small>
                                    <?= Yii::$app->formatter->asDatetime($action->published, 'php:d.m.Y') ?>
                                </small>
                            </p>
                            <h5 class="font-weight-500 mb-1_5 text-black">
                                <?= Yii::$app->params['actionsTypes'][$action->type] ?>
                            </h5>
                            <p class="mb-1 font-weight-bold text-uppercase text-<?= $isDark ? 'white' : 'orange' ?>">
                                <?= json_decode($action->name)->{Yii::$app->language} ?>
                            </p>
                            <p class="mb-1 font-weight-bold text-black">
                                <?= json_decode($action->description)->{Yii::$app->language} ?>
                            </p>
                        </div>
                    </div>
                </div>
            </a>
        </div>
    <?php
        }
    ?>
    </div>

</div>