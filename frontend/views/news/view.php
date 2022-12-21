<?php

use yii\helpers\Url;
use yii\helpers\Html;

$postName = json_decode($post->name)->{Yii::$app->language};

$this->title = $postName;

?>

<div class="container-xl">
    <div class="row">
        <div class="col-12">
            <div class="row">
                <div class="col-1 d-none d-md-block pl-0_5 pr-0">
                    <a href="<?= Url::to(['/news']) ?>">
                        <?= Html::img('/images/arrow.svg', [
                                'class' => 'wow fadeIn',
                                'style' => '
                                    width: 4.5em;
                                    transform: rotate(-135deg);
                                    margin-top: -0.5em;
                                ',
                            ])
                        ?>
                    </a>
                </div>
                <div class="col pl-1">
                    <p class="blog-post-date mb-1 opacity-50">
                        <?= Yii::$app->formatter->asDatetime($post->date_published, 'php:d.m.Y') ?>
                    </p>
                    <h1 class="h2 mb-1 mb-lg-2 text-uppercase font-weight-light">
                        <?= $postName ?>
                    </h1>
                    <h4 class="font-weight-bolder mb-2 mb-lg-3">
                        <?= json_decode($post->description)->{Yii::$app->language} ?>
                    </h4>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-8">
    <?php
        if ($image = $post->getImage()){
    ?>
            <?= Html::img($image->getUrl(), [
                    'class' => 'img-fluid mb-3' . ($post->show_preview ? '' : ' d-none'),
                    'alt' => ($image->alt ?: $postName)
                ])
            ?>
    <?php
        }
    ?>
            <div class="news-post-content px-xl-5">
                <?= str_replace('<img ', '<img loading="lazy" ', json_decode($post->text)->{Yii::$app->language}) ?>
            </div>
        </div>
        <div class="col-xl-4 pl-xl-2 mt-3 mt-md-0">
            <div class="row">
    <?php
        if ($posts) {
            foreach ($posts as $post) {
    ?>
                <div class="col-12 col-sm-6 col-lg-4 col-xl-12">
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