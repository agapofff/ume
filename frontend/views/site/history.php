<?php
use yii\helpers\Url;
use yii\helpers\Html;
use PELock\ImgOpt\ImgOpt;

$this->title = Yii::t('front', 'История') . ' - ' . Yii::$app->name;
?>

<div class="container-xl mb-2 mb-lg-3">
    <h1 class="text-uppercase font-weight-light mb-2 mb-lg-3">
        <?= Yii::t('front', 'О UME') ?>
    </h1>
    
    <div class="row align-items-center position-relative">
        <div class="col-12">
            <img data-src="/images/history/main.jpg" class="lazyload pointer-events-none img-fluid" alt="<?= $title ?>" width="1620" height="770">
        </div>
        <div class="col-9 col-sm-9 col-md-8 col-lg-8 col-xl-7 position-absolute h-100">
            <div class="row h-100 align-items-center">
                <div class="col-12 pl-2 pl-lg-3 pl-xl-4">
                    <h2 class="h1 text-uppercase font-weight-light mb-2 d-none d-sm-block">
                        <?= Yii::t('front', 'История бренда UME') ?>
                    </h2>
                    <h2 class="h3 text-uppercase font-weight-light mb-1 mt-0_5 d-sm-none">
                        <?= Yii::t('front', 'История бренда UME') ?>
                    </h2>
                    <p class="text-uppercase font-weight-bolder">
                        <?= Yii::t('front', 'Нарек любит фильм') ?>
                        <br>
                        <?= Yii::t('front', '"Хатико: Самый верный друг"') ?>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

<h3 class="h2 font-weight-light text-center text-uppercase mb-2 mb-lg-3">
    <?= Yii::t('front', 'История зацепила,{0}и родилась идея UME', ['<br>']) ?>
</h3> 

<div class="container-xl mb-2 mb-lg-3">
    <div class="row align-items-center">
        <div class="col-md-6 order-md-last mb-1 mb-md-0 pl-md-0">
            <img data-src="/images/history/narek.jpg" class="lazyload pointer-events-none img-fluid" alt="<?= $title ?>" width="811" height="811">
        </div>
        <div class="col-md-6 px-md-1_5 px-lg-2 px-xl-4">
            <p class="h4 font-weight-light mb-md-2 mb-lg-3">
                <?= Yii::t('front', 'Идея создания экосистемы UME появилась у Нарека Сираканяна во время дружеского ужина. Один из гостей, зоопсихолог по профессии, рассказал реальную историю Хатико - собаки, которая в течение девяти лет ждала погибшего хозяина на железнодорожной станции') ?>
            </p>
            <p class="font-weight-light">
                <?= Yii::t('front', 'Зоопсихолог сообщил, что одним из мотивов пса могла быть не преданность человеку, а инстинкт, приводящий животное туда, где ему комфортно. Туда, где есть еда и забота. Нарек подумал, что все люди, у которых есть домашние питомцы, могут элементарно не понимать, чего в конкретный момент хотят их животные, что они чувствуют по отношению к владельцу, и как правильно выстраивать отношения.') ?>
            </p>
        </div>
    </div>
</div>

<div class="container-xl mb-3 mb-lg-4">
    <div class="row">
        <div class="col-md-6 pr-md-0">
            <img data-src="/images/history/redhead.jpg" class="lazyload pointer-events-none img-fluid" alt="<?= $title ?>" width="812" height="554">
        </div>
        <div class="col-md-6 col-lg-5 offset-lg-1 px-md-1_5 pr-lg-2 pr-xl-4 pl-lg-0 pt-1 pt-md-2 pt-lg-3">
            <p class="font-weight-light mb-md-2 mb-lg-3">
                <?= Yii::t('front', 'С другой стороны, миллиарды одиноких людей, получив возможность реально считывать желания собак и кошек, смогли бы найти себе настоящего друга. Того, с кем можно, в буквальном смысле слова, пребывать на одной волне.') ?>
            </p>
            <p class="h3 font-weight-light text-uppercase">
                <?= Yii::t('front', 'Так во вселенной Нарека Сираканяна появился бренд UME') ?>
            </p>
        </div>
    </div>
</div>

<div class="container-xl mb-3 mb-lg-4">
    <div class="row justify-content-center">
        <div class="col-md-11 col-lg-10 col-xl-9">
            <h4 class="h3 font-weight-light text-center text-uppercase">
                <?= Yii::t('front', 'Продукты UME создаются на базе высоких технологий и подлинных запросов гигантской аудитории') ?>
            </h4>
        </div>
    </div>
</div>

<div class="container-xl mb-2 mb-lg-3">
    <div class="row">
        <div class="col-md-6 order-md-last mb-1 mb-md-0 pl-md-0">
            <img data-src="/images/history/laptop.jpg" class="lazyload pointer-events-none img-fluid" alt="<?= $title ?>" width="811" height="656">
        </div>
        <div class="col-md-6 px-md-1_5 px-lg-2 px-xl-4">
            <?= Html::img('/images/arrow.svg', [
                    'class' => 'd-none d-md-block mt-1 mt-lg-2 mb-2 mb-lg-3',
                    'style' => '
                        width: 4.5em;
                        transform: rotate(45deg);
                    ',
                ])
            ?>
            <p class="font-weight-light">
                <?= Yii::t('front', 'Искусственный интеллект на основе анализа метаданных о поведении животных способен классифицировать пищевые предпочтения, причины для смены настроений, состояние здоровья и множество других факторов. Человек получает возможность общаться с близким существом, вызывая в нем настоящую любовь и преданность.') ?>
            </p>
        </div>
    </div>
</div>

<div class="container-xl mb-3 mb-lg-4">
    <div class="row justify-content-center">
        <div class="col-md-11 col-lg-10 col-xl-9">
            <h4 class="h3 font-weight-light text-center text-uppercase">
                <?= Yii::t('front', 'А значит, мы найдем друг друга. Потому что каждый сможет жить с ощущением:') ?>
            </h4>
            <h4 class="h1 text-uppercase font-weight-light text-center mt-2 mt-lg-3">
                <?= Yii::t('front', '«я тебя понимаю,{0} я совсем как ты»', ['<br>&nbsp;']) ?>
            </h4>
        </div>
    </div>
</div>