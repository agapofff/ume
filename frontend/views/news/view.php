<?php

use yii\helpers\Url;
use yii\helpers\Html;

$postName = json_decode($post->name)->{Yii::$app->language};

$this->title = $postName;

?>

<div class="container-lg container-xl container-xxl">
    <div class="row">
        <div class="col-md-8">
            <div class="news-header position-relative pl-xl-5">
                <a href="<?= Url::to(['/news']) ?>" class="news-back d-none d-xl-block position-absolute top-0 left-0"></a>
                <p class="blog-post-date mb-1 opacity-50">
                    <?= Yii::$app->formatter->asDatetime($post->date_published, 'php:d.m.Y') ?>
                </p>
                <h1 class="h2 mb-3 text-uppercase font-weight-600">
                    <?= $postName ?>
                </h1>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-8">
    <?php
        if ($image = $post->getImage()){
    ?>
            <?= Html::img($image->getUrl(), [
                    'class' => 'img-fluid mb-3',
                    'alt' => ($image->alt ?: $postName)
                ])
            ?>
    <?php
        }
    ?>
            <div class="px-xl-7">
                <?= str_replace('<img ', '<img class="img-fluid mx-auto" loading="lazy" ', json_decode($post->text)->{Yii::$app->language}) ?>
            </div>
        </div>
        <div class="col-md-4 pl-md-2 mt-3 mt-md-0">
            <div class="row">
    <?php
        if ($posts) {
            foreach ($posts as $post) {
    ?>
                <div class="col-12 col-sm-6 col-md-12">
                    <?= $this->render('_post', [
                            'post' => $post
                        ])
                    ?>
                </div>
    <?php
            }
        }
    ?>
            </div>
        </div>
    </div>
</div>