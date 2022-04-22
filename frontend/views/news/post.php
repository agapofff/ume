<?php

use yii\helpers\Url;
use yii\helpers\Html;

$this->title = json_decode($post->name)->{Yii::$app->language};
$postName = $this->title;
// $this->params['breadcrumbs'][] = $this->title;

?>

<div class="container-lg container-xl container-xxl">

    <div class="row">
        <div class="col-md-8">
            <div class="news-header position-relative pl-xl-7">
                <a href="<?= Url::to(['/news']) ?>" class="news-back d-block position-absolute top-0 left-0"></a>
                <p class="blog-post-date mb-1 opacity-50">
                    <?= Yii::$app->formatter->asDatetime($post->date_published, 'php:d.m.Y') ?>
                </p>
                <h1 class="h2 mb-3">
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
        <div class="col-md-4 pl-md-2">
        <?php
            if ($posts) {
                foreach ($posts as $post) {
                    $image = $post->getImage();
                    $name = json_decode($post->name)->{Yii::$app->language};
        ?>
                    <a href="<?= Url::to(['/news/' . $post->slug]) ?>" class="news-post card rounded-0 border-gray-800 mb-2 transition">
                        <img src="<?= $image->getUrl('500x500') ?>" alt="<?= $image->alt ?: $name ?>" class="card-img transition">
                        <div class="card-img-overlay p-1_5">
                            <p class="blog-post-date mb-2 opacity-50">
                                <?= Yii::$app->formatter->asDatetime($post->date_published, 'php:d.m.Y') ?>
                            </p>
                            <h5 class="mb-3 text-gray-800">
                                <?= $name ?>
                            </h5>
                            <p class="mb-0 d-none">
                                <?= json_decode($post->description)->{Yii::$app->language} ?>
                            </p>
                        </div>
                    </a>
        <?php
                }
            }
        ?>
        </div>
    </div>
</div>