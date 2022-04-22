<?php

use yii\helpers\Html;

$this->title = json_decode($post->name)->{Yii::$app->language};

// $this->params['breadcrumbs'][] = $this->title;

?>

<div class="container-fluid mb-5 mt-1_5 px-lg-2 px-xl-3 px-xxl-5">
    <div id="blog-post">
        <div class="row">
            <div class="col-12">
                <h1 id="blog-post-title" class="h4 font-weight-light">
                    <?= json_decode($post->name)->{Yii::$app->language} ?>
                </h1>
            </div>
            <div id="blog-post-content" class="col-sm-10 col-md-8 col-lg-7 col-xl-6 col-xxl-5">
                <?= str_replace('<img ', '<img class="img-fluid mx-auto" loading="lazy" ', json_decode($post->text)->{Yii::$app->language}) ?>
            </div>
        </div>
    </div>
</div>