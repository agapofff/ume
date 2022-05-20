<?php

use yii\helpers\Url;
use yii\helpers\Html;

$this->title = json_decode($action->name)->{Yii::$app->language};
$actionName = $this->title;
// $this->params['breadcrumbs'][] = $this->title;

?>

<div class="container-lg container-xl container-xxl">
    <div class="row">
        <div class="col-md-8">
            <div class="news-header position-relative pl-xl-5">
                <a href="<?= Url::to(['/actions']) ?>" class="news-back d-none d-xl-block position-absolute top-0 left-0"></a>
                <p class="blog-post-date mb-1 opacity-50">
                    <?= Yii::$app->formatter->asDatetime($action->published, 'php:d.m.Y') ?>
                </p>
                <h1 class="h2 mb-3 text-uppercase font-weight-600 text-orange">
                    <?= $actionName ?>
                </h1>
            </div>
        </div>
    </div>
    <div id="action-description" class="row">
        <div class="col-12">
            <div class="px-xl-5">
            <?php
                $images = $action->getImages();
                if (count($images) > 1) {
                    $image = $images[1];
                    $cachedImage = '/images/cache/Actions/Actions' . $image->itemId . '/' . $image->urlAlias . '_1000x.' . $image->getExtension();
                    $img = file_exists(Yii::getAlias('@frontend') . '/web' . $cachedImage) ? $cachedImage : $image->getUrl('1000x');
                    echo Html::img($img, [
                        'class' => 'img-fluid mx-auto mb-4',
                        'loading' => 'lazy',
                        'alt' => $image->alt ?: $actionName,
                    ]);
                }
            ?>
                <h2 class="position-relative mb-3 text-uppercase">
                    <?= Yii::t('front', 'Условия') ?>
                </h2>
                <?= str_replace('<img ', '<img class="img-fluid mx-auto" loading="lazy" ', json_decode($action->text)->{Yii::$app->language}) ?>
            </div>
        </div>
    </div>
</div>