<?php

use yii\web\View;
use yii\helpers\Url;
use yii\helpers\Html;

$this->title = Yii::t('front', 'Новости');

// $this->params['breadcrumbs'][] = $this->title;

?>

<div class="mt-1_5" style="
    height: 35vw;
    background: url('/images/blog/mountains_1.jpg') center bottom /cover no-repeat;
">
    <div class="container-fluid px-lg-2 px-xl-3 px-xxl-5">
        <div class="row">
            <div class="col-12">
                <h1 class="ttfirsneue text-uppercase display-2 mb-0 position-relative d-inline-block red_dot">
                    <?= Yii::t('front', 'Новости') ?>
                </h1>
            </div>
        </div>
    </div>
</div>

<div id="blog-container" class="position-relative px-0">
    <div class="marquee h2 font-weight-light text-white">
        <?= Yii::t('front', 'бегущая строка', [
            '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'
        ]) ?>
    </div>
    
    <div class="container-fluid">
        <div class="row">
            <div id="blog" class="mx-auto col-md-10 col-lg-6 mt-5">
                <div id="blog-categories" class="row justify-content-between flex-nowrap overflow-x-auto overflow-y-hidden">
                    <div class="col-auto">
                        <a href="#all" class="blog-category d-inline-block mb-1 text-white text-decoration-none" data-category="all">
                            <?= Yii::t('front', 'Все') ?>
                        </a>
                    </div>
            <?php
                foreach ($categories as $category) {
            ?>
                    <div class="col-auto">
                        <a href="#<?= $category->slug ?>" class="blog-category d-inline-block mb-1 text-white text-decoration-none opacity-50" data-category="<?= $category->slug ?>">
                            <?= json_decode($category->name)->{Yii::$app->language} ?>
                        </a>
                    </div>
            <?php
                }
            ?>
                </div>
                <hr class="border-white mt-0 mb-2">
                <div id="blog-posts">
            <?php
                foreach ($posts as $post) {
            ?>
                    <div class="blog-post" data-category="<?= $post->category->slug ?>">
                        <a href="<?= Url::to(['/news/' . $post->slug]) ?>" class="text-decoration-none" 
                            data-toggle="lightbox" 
                            data-title="<?= json_decode($post->name)->{Yii::$app->language} ?>" 
                            data-footer="<?= json_decode($post->publisher)->{Yii::$app->language} ?>, <?= Yii::$app->formatter->asDatetime($post->date_published, 'php:d.m.Y') ?>" 
                            data-remote="<?= Url::to(['/news/' . $post->slug]) ?> #blog-post"
                            data-modal-class="p-0" 
                            data-modal-dialog-class="max-vw-50 border-0 mx-auto my-0" 
                            data-modal-content-class="m-0 border-0 vh-100 vw-50" 
                            data-modal-header-class="align-items-center flex-nowrap py-md-2 px-md-1 px-lg-2 px-xl-3" 
                            data-modal-title-tag="span" 
                            data-modal-title-class="ttfirsneue h5 m-0 font-weight-light" 
                            data-close-button-class="p-0 float-none" 
                            data-close-button-content="<svg width='53' height='53' viewBox='0 0 53 53' fill='none' xmlns='http://www.w3.org/2000/svg'><line x1='13.7891' y1='12.3744' x2='39.9521' y2='38.5373' stroke='black' stroke-width='2'></line><line x1='12.3749' y1='38.5379' x2='38.5379' y2='12.3749' stroke='black' stroke-width='2'></line></svg>" 
                            data-modal-body-class="h-100 overflow-y-scroll py-0 px-md-1 px-lg-2 px-xl-3 hide-h1" 
                            data-modal-footer-class="px-md-1 px-lg-2 px-xl-3 py-md-2" 
                        >
                            <div class="row py-0_5">
                                <div class="col-auto">
                                    <?= Html::img($post->getImage()->getUrl('140x140'), [
                                            'alt' => json_decode($post->name)->{Yii::$app->language}
                                        ])
                                    ?>
                                </div>
                                <div class="col">
                                    <div class="row h-100">
                                        <div class="col-12 align-self-start">
                                            <p class="blog-post-publisher text-white opacity-50">
                                                <?= json_decode($post->publisher)->{Yii::$app->language} ?>
                                            </p>
                                            <p class="blog-post-name text-white">
                                                <?= json_decode($post->name)->{Yii::$app->language} ?>
                                            </p>
                                        </div>
                                        <div class="col-12 align-self-end">
                                            <p class="blog-post-date mb-0 text-white opacity-50">
                                                <?= Yii::$app->formatter->asDatetime($post->date_published, 'php:d.m.Y') ?>
                                            </p>                                
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                        <hr class="border-white my-2">
                    </div>
            <?php
                }
            ?>
                </div>
            </div>
        </div>
    </div>
</div>
