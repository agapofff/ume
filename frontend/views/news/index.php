<?php

use yii\web\View;
use yii\helpers\Url;
use yii\helpers\Html;

$this->title = Yii::t('front', 'Новости');

// $this->params['breadcrumbs'][] = $this->title;

?>

<div class="container-lg container-xl container-xxl">

    <h1 class="mb-3 text-uppercase">
        <?= Yii::t('front', 'Новости') ?>
    </h1>

    <div id="news" class="row mb-3">
    <?php
        foreach ($posts as $post) {
            $image = $post->getImage();
            $name = json_decode($post->name)->{Yii::$app->language};
    ?>
        <div class="col-md-6 col-xl-4">
            <a href="<?= Url::to(['/news/' . $post->slug]) ?>" class="news-post card rounded-0 border-gray-800 mb-2 transition">
                <img src="<?= $image->getUrl('500x500') ?>" alt="<?= $image->alt ?: $name ?>" class="card-img transition">
                <div class="card-img-overlay p-1_5">
                    <p class="blog-post-date mb-2 opacity-50">
                        <small>
                            <?= Yii::$app->formatter->asDatetime($post->date_published, 'php:d.m.Y') ?>
                        </small>
                    </p>
                    <h5 class="font-weight-500 mb-3">
                        <?= $name ?>
                    </h5>
                    <p class="mb-0 lead">
                        <?= json_decode($post->description)->{Yii::$app->language} ?>
                    </p>
                </div>
            </a>
        </div>
    <?php
        }
    ?>
    </div>

</div>