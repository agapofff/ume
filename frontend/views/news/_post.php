<?php

use yii\helpers\Url;
use yii\helpers\Html;

$image = $post->getImage();
$cachedImage = '/images/cache/News/News' . $image->itemId . '/' . $image->urlAlias . '_500x500.' . $image->getExtension();
$name = json_decode($post->name)->{Yii::$app->language};
?>

<a href="<?= Url::to(['/news/' . $post->slug]) ?>" class="news-post card rounded-0 border-gray-600 mb-2 transition text-dark overflow-hidden">
    <div class="news-img-zoom">
        <img src="<?= file_exists(Yii::getAlias('@frontend') . '/web' . $cachedImage) ? $cachedImage : $image->getUrl('500x500') ?>" alt="<?= $image->alt ?: $name ?>" class="card-img transition rounded-0">
    </div>
    <div class="card-img-overlay p-1_5">
        <p class="h6 blog-post-date mb-2 opacity-50 small">
            <?= Yii::$app->formatter->asDatetime($post->date_published, 'php:d.m.Y') ?>
        </p>
        <p class="h5 font-weight-500 mb-2">
            <?= $name ?>
        </p>
        <p class="mb-0 lead text-dark d-sm-none d-md-block d-lg-none d-xl-block">
            <?= json_decode($post->description)->{Yii::$app->language} ?>
        </p>
    </div>
</a>
