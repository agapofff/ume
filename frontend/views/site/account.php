<?php

/*
 * This file is part of the Dektrium project.
 *
 * (c) Dektrium project <http://github.com/dektrium>
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

use yii\helpers\Url;
use yii\helpers\Html;
use dektrium\user\helpers\Timezone;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

/**
 * @var yii\web\View $this
 * @var yii\widgets\ActiveForm $form
 * @var dektrium\user\models\Profile $profile
 */

$this->title = Yii::t('front', 'Профиль');
$this->params['breadcrumbs'][] = $this->title;

$inviteLink = Url::to(['/join/' . base64_encode(Yii::$app->user->id)], true);

?>

<div class="container-lg container-xl container-xxl">
    <h1 class="text-uppercase mb-2 wow fadeIn" data-wow-duration="0.5s">
        <?= Yii::t('front', 'Личный кабинет') ?>
    </h1>
    
    <div id="account" class="accordion">
    
        <a href="#profile" class="h4 position-relative d-block text-uppercase text-decoration-none font-weight-normal text-dark" data-toggle="collapse" aria-expanded="true" aria-controls="profile">
            <?= Yii::t('front', 'Профиль') ?>
            <?= Html::img('/images/arrow_lk_active.svg', [
                    'class' => 'position-absolute top-0 right-0 d-none d-md-block transition',
                ])
            ?>
        </a>
        <div id="profile" class="collapse show" data-parent="#account">
            <p>
                <a href="<?= Url::to(['/account/edit']) ?>" class="text-gray-400">
                    <?= Yii::t('front', 'Редактировать') ?>
                </a>
            </p>
            <div class="row">
                <div class="col-md-3 pt-4">
                    <a href="<?= Url::to(['/account/edit']) ?>">
                        <img src="<?= $user->getImage()->getUrl('400x400') ?>" class="img-fluid rounded-pill border border-teal cursor-pointer file-upload-trigger" style="border-width: 3px !important">
                    </a>
                </div>
                <div class="col-md-8 offset-md-1">
                    <h2 class="mb-2">
                        <?= $profile->name ?: Yii::t('front', 'Мой питомец') ?>
                    </h2>
                    <div class="row mb-0_5">
                        <div class="col-4 font-weight-bold">
                            <?= Yii::t('front', 'Пол') ?>
                        </div>
                        <div class="col-8">
                            <?= Yii::t('front', !is_null($profile->sex) ? Yii::t('front', Yii::$app->params['sex'][$profile->sex]) : '') ?>
                        </div>
                    </div>
                    <div class="row mb-0_5">
                        <div class="col-4 font-weight-bold">
                            <?= Yii::t('front', 'Порода') ?>
                        </div>
                        <div class="col-8">
                            <?= json_decode($breed)->{Yii::$app->language} ?>
                        </div>
                    </div>
                    <div class="row mb-0_5">
                        <div class="col-4 font-weight-bold">
                            <?= Yii::t('front', 'Дата рождения') ?>
                        </div>
                        <div class="col-8">
                            <?= $profile->birthday ? Yii::$app->formatter->asDate($profile->birthday, 'dd.MM.yyyy') : '' ?>
                        </div>
                    </div>
                    <div class="row mb-0_5">
                        <div class="col-4 font-weight-bold">
                            <?= Yii::t('front', 'Вес') ?>
                        </div>
                        <div class="col-8">
                            <?= $profile->weight ? $profile->weight . ' ' . Yii::t('front', 'кг') : '' ?>
                        </div>
                    </div>
                    <div class="row mb-0_5">
                        <div class="col-4 font-weight-bold">
                            <?= Yii::t('front', 'Активность') ?>
                        </div>
                        <div class="col-8">
                            <?= $profile->activity ? Yii::t('front', Yii::$app->params['activity'][$profile->activity]) : '' ?>
                        </div>
                    </div>
                    <hr>
                    <h4 class="mt-2 mb-1_5">
                        <?= Yii::t('front', 'Хозяин') ?>
                    </h4>
                    <div class="row mb-0_5">
                        <div class="col-4 font-weight-bold">
                            <?= Yii::t('front', 'ФИО') ?>
                        </div>
                        <div class="col-8">
                            <?= implode(' ', [$profile->first_name, $profile->last_name]) ?>
                        </div>
                    </div>
                    <div class="row mb-0_5">
                        <div class="col-4 font-weight-bold">
                            <?= Yii::t('front', 'Телефон') ?>
                        </div>
                        <div class="col-8">
                            <?= $profile->phone ?>
                        </div>
                    </div>
                    <div class="row mb-0_5">
                        <div class="col-4 font-weight-bold">
                            <?= Yii::t('front', 'E-mail') ?>
                        </div>
                        <div class="col-8">
                            <?= $user->email ?>
                        </div>
                    </div>
                    <hr>
                    <h4 class="mt-2 mb-1_5">
                        <?= Yii::t('front', 'Подписка') ?>
                    </h4>
                </div>
            </div>
        </div>
        
        <hr>
        
        <a href="#orders" class="h4 position-relative d-block text-uppercase text-decoration-none font-weight-normal text-dark" data-toggle="collapse" aria-expanded="false" aria-controls="orders">
            <?= Yii::t('front', 'Покупки') ?>
            <?= Html::img('/images/arrow_lk_active.svg', [
                    'class' => 'position-absolute top-0 right-0 d-none d-md-block transition',
                ])
            ?>
        </a>
        <div id="orders" class="collapse" data-parent="#account">
            <p class="lead">
                <?= Yii::t('front', 'Здесь пока пусто') ?>
            </p>
        </div>
        
        <hr>
        
        <a href="#bonus" class="h4 position-relative d-block text-uppercase text-decoration-none font-weight-normal text-dark" data-toggle="collapse" aria-expanded="false" aria-controls="bonus">
            <?= Yii::t('front', 'Кошелек') ?>
            <?= Html::img('/images/arrow_lk_active.svg', [
                    'class' => 'position-absolute top-0 right-0 d-none d-md-block transition',
                ])
            ?>
        </a>
        <div id="bonus" class="collapse" data-parent="#account">
            <p class="lead">
                <?= Yii::t('front', 'Здесь пока пусто') ?>
            </p>
        </div>
        
        <hr>
        
        <a href="#friends" class="h4 position-relative d-block text-uppercase text-decoration-none font-weight-normal text-dark" data-toggle="collapse" aria-expanded="false" aria-controls="friends">
            <?= Yii::t('front', 'Друзья') ?>
            <?= Html::img('/images/arrow_lk_active.svg', [
                    'class' => 'position-absolute top-0 right-0 d-none d-md-block transition',
                ])
            ?>
        </a>
        <div id="friends" class="collapse" data-parent="#account">
            <div class="mb-4 mt-3 px-xl-5">
        <?php
            if ($friends) {
        ?>
                <h2 class="mb-3 text-uppercase">
                    <?= Yii::t('front', 'Оформите подарок другу') ?>
                </h2>
                <p class="lead font-weight-bold mb-3">
                    <?= Yii::t('front', 'Выберите сумму для перевода') ?>
                </p>
                <div class="mb-1">
            <?php
                foreach ($friends as $f => $friend) {
            ?>
                    <div class="row my-2">
                        <div class="col-auto">
                            <img src="<?= $friend->getImage()->getUrl('100x100') ?>" class="rounded-pill">
                        </div>
                        <div class="col-auto">
                            <div class="row align-items-baseline">
                                <div class="col-auto">
                                    <h4 class="d-inline mb-0 mr-1">
                                        <?= $friend->profile->first_name ?: ($friend->profile->first_name ?: $friend->username) ?>
                                    </h4>
                                    <h6 class="d-inline">
                                        <?= $friend->profile->breed ? Yii::$app->params['breeds'][$friend->profile->breed] : '' ?>
                                        <?= $friend->profile->breed && $friend->profile->birthday ? ', ' : '' ?>
                                        <?= $friend->profile->birthday ? explode(',', Yii::$app->formatter->asDuration((new DateTime())->setTimestamp(time())->diff(new DateTime($friend->profile->birthday)), ',', ''))[0] : '' ?>
                                    </h6>
                                </div>
                            </div>
                            <div class="row d-none">
                                <div class="col-auto">
                                
                                </div>
                                <div class="col-auto">
                                    <button type="button" class="btn btn-secondary btn-lg rounded-pill give-to-friend">
                                        <?= Yii::t('front', 'Подарить') ?>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php
                    if ($f < count($friends)-1){
                ?>
                    <hr>
            <?php
                    }
                }
            ?>
                </div>
        <?php
            }
        ?>
                <div class="text-center mt-3">
                    <button type="button" class="btn btn-secondary btn-lg rounded-pill" data-toggle="modal" data-target="#invite">
                        <?= Yii::t('front', 'Пригласить') ?>
                    </button>
                </div>
            </div>
            
            <div class="modal fade" id="invite" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header border-0 pb-0">
                            <h5 class="modal-title text-center mb-2">
                                <?= Yii::t('front', 'Пригласить') ?>
                            </h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <img src="/images/modal_close.svg">
                            </button>
                        </div>
                        <div class="modal-body pt-0">
                            <div class="form-group">
                                <label class="form-control-label">
                                    <?= Yii::t('front', 'Отправьте эту ссылку Вашим друзьям и знакомым:') ?>
                                </label>
                                <input type="text" value="<?= $inviteLink ?>" class="form-control form-control-lg" id="invite-input" onclick="copyToClipboard('<?= $inviteLink ?>', '<?= Yii::t('front', 'Ссылка скопирована') ?>', '<?= Yii::t('front', 'Произошла ошибка! Пожалуйста, попробуйте еще раз чуть позже') ?>')" readonly>
                                <div class="help text-right">
                                    <a href="#" onclick="copyToClipboard('<?= $inviteLink ?>', '<?= Yii::t('front', 'Ссылка скопирована') ?>', '<?= Yii::t('front', 'Произошла ошибка! Пожалуйста, попробуйте еще раз чуть позже') ?>')">
                                        <?= Yii::t('front', 'Скопировать ссылку') ?>
                                    </a>
                                </div>
                            </div>
                            <div class="text-center mt-1 mb-0_5">
                                <p class="text-center lead m-0">
                                    <?= Yii::t('front', 'Отправить') ?>
                                </p>
                                <script src="https://yastatic.net/share2/share.js"></script>
                                <div class="ya-share2" 
                                    data-size="l" 
                                    data-shape="round" 
                                    data-color-scheme="whiteblack" 
                                    data-services="vkontakte,odnoklassniki,telegram,twitter,viber,whatsapp" 
                                    data-copy="hidden" 
                                    data-description="<?= Yii::t('front', 'Здравствуйте') ?>! <?= Yii::t('front', 'Приглашаю вас в {0}', [Yii::$app->name]) ?>: <?= $inviteLink ?>" 
                                    data-image="<?= Url::to(['/images/share1.jpg'], true) ?>" 
                                    data-lang="<?= Yii::$app->language ?>" 
                                    data-title="<?= Yii::t('front', 'Приглашение в {0}', [Yii::$app->name]) ?>" 
                                    data-url="<?= $inviteLink ?>"
                                ></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <hr>
        
        <a href="#actions" class="h4 position-relative d-block text-uppercase text-decoration-none font-weight-normal text-dark" data-toggle="collapse" aria-expanded="false" aria-controls="actions">
            <?= Yii::t('front', 'Акции') ?>
            <?= Html::img('/images/arrow_lk_active.svg', [
                    'class' => 'position-absolute top-0 right-0 d-none d-md-block transition',
                ])
            ?>
        </a>
        <div id="actions" class="collapse" data-parent="#account">
            <div class="row mb-4 mt-3 px-xl-5">
        <?php
            foreach ($actions as $action) {
        ?>
                <div class="col-md-6">
                    <?= $this->render('/actions/_post', [
                            'action' => $action
                        ])
                    ?>
                </div>
        <?php
            }
        ?>
                <div class="col-12">
                    <p class="lead my-1">
                        <a href="<?= Url::to(['/actions']) ?>" class="text-dark">
                            <?= Yii::t('front', 'Архив акций') ?>
                        </a>
                    </p>
                </div>
            </div>
        </div>
        
        <hr>
    </div>
</div>