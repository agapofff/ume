<?php

/*
 * This file is part of the Dektrium project.
 *
 * (c) Dektrium project <http://github.com/dektrium>
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

use yii\web\View;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var yii\web\View $this
 * @var yii\widgets\ActiveForm $form
 * @var dektrium\user\models\SettingsForm $model
 */

$this->title = Yii::t('user', 'Account settings');
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="container-xl">
    <h1 class="text-uppercase font-weight-light mb-3">
        <?= Yii::t('front', 'Личный кабинет') ?>
    </h1>
    <h3 class="text-uppercase font-weight-light mb-3">
        <?= Yii::t('front', 'Заполнить профиль') ?>
    </h3>
    
    <div class="row justify-content-center">
        <div class="col-xs-12 col-md-10 col-lg-9 col-xl-8">
        
            <?php 
                $form = ActiveForm::begin([
                    'id' => 'account-form',
                    'enableAjaxValidation' => true,
                    'enableClientValidation' => true,
                    'validateOnBlur' => true,
                    'validateOnType' => true,
                    'validateOnChange' => true,
                ]); 
            ?>

                <?= $form
                        ->field($model, 'first_name', [
                            'inputOptions' => [
                                'class' => 'form-control form-control-lg',
                                'autocomplete' => rand(),
                                'placeholder' => ' ',
                            ],
                            'options' => [
                                'class' => 'form-group row align-items-center mb-2',
                            ],
                            'template' => '{label}<div class="col-md-9">{input}</div>{hint}{error}',
                            'labelOptions' => [
                                'class' => 'col-md-3 mb-md-0 font-weight-bold'
                            ]
                        ])
                ?>

                <?= $form
                        ->field($model, 'last_name', [
                            'inputOptions' => [
                                'class' => 'form-control form-control-lg',
                                'autocomplete' => rand(),
                                'placeholder' => ' ',
                            ],
                            'options' => [
                                'class' => 'form-group row align-items-center mb-2',
                            ],
                            'template' => '{label}<div class="col-md-9">{input}</div>{hint}{error}',
                            'labelOptions' => [
                                'class' => 'col-md-3 mb-md-0 font-weight-bold'
                            ]
                        ])
                ?>
                
                <?= $form
                        ->field($model, 'email', [
                            'inputOptions' => [
                                'class' => 'form-control form-control-lg',
                                'autocomplete' => rand(),
                                'placeholder' => ' ',
                            ],
                            'options' => [
                                'class' => 'form-group row align-items-center mb-2',
                            ],
                            'labelOptions' => [
                                'class' => 'col-md-3 mb-md-0 font-weight-bold'
                            ],
                            'template' => '{label}<div class="col-md-9">{input}</div>{hint}{error}',
                        ])
                        ->input('email')
                ?>
                
                <?= $form
                        ->field($model, 'phone', [
                            'inputOptions' => [
                                'class' => 'form-control form-control-lg phone-mask',
                                'autocomplete' => rand(),
                            ],
                            'options' => [
                                'class' => 'form-group row align-items-center mb-2',
                            ],
                            'labelOptions' => [
                                'class' => 'col-md-3 mb-md-0 font-weight-bold'
                            ],
                            'template' => '{label}<div class="col-md-9">{input}</div>{hint}{error}',
                        ])
                ?>

                <hr class="mb-2"/>
                
                <?= $form
                        ->field($model, 'current_password', [
                            'inputOptions' => [
                                'class' => 'form-control form-control-lg',
                                'autocomplete' => rand(),
                            ],
                            'options' => [
                                'class' => 'form-group row align-items-center mb-2',
                            ],
                            'labelOptions' => [
                                'class' => 'col-md-3 mb-md-0 font-weight-bold'
                            ],
                            'template' => '{label}<div class="col-md-9">{input}</div>{hint}{error}',
                        ])
                ?>
                
                <?= $form
                        ->field($model, 'new_password', [
                            'inputOptions' => [
                                'class' => 'form-control form-control-lg',
                                'autocomplete' => rand(),
                            ],
                            'options' => [
                                'class' => 'form-group row align-items-center mb-2',
                            ],
                            'labelOptions' => [
                                'class' => 'col-md-3 mb-md-0 font-weight-bold'
                            ],
                            'template' => '{label}<div class="col-md-9">{input}</div>{hint}{error}',
                        ])
                ?>

                <div class="row justify-content-end mt-1 mt-lg-2">
                    <div class="col-md-9">
                        <div class="row justify-content-center justify-content-sm-start">
                            <div class="col-auto mb-1">
                                <?= Html::submitButton(Yii::t('front', 'Сохранить'), [
                                        'class' => 'btn btn-lg btn-secondary rounded-pill',
                                        'title' => Yii::t('front', 'Сохранить')
                                    ]) 
                                ?>
                            </div>
                            <div class="col-auto mb-1">
                                <?= Html::a(Yii::t('front', 'Отмена'), ['/account'], [
                                        'class' => 'btn btn-lg btn-outline-secondary rounded-pill',
                                    ])
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
                
                
                <div class="modal fade" id="sms-code-modal" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header border-0 pb-0">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <img src="/images/modal_close.svg">
                                </button>
                            </div>
                            <div class="modal-body pt-0">
                                <h5 class="modal-title text-center mb-2">
                                    <?= Yii::t('front', 'Подтвердите Ваш номер телефона') ?>
                                </h5>
                                <p class="text-center mb-2">
                                    <?= Yii::t('front', 'Введите смс-код из сообщения, отправленного на указанный Вами номер телефона') ?>
                                </p>
                                <?= $form
                                        ->field($model, 'sms_code', [
                                            'inputOptions' => [
                                                'autofocus' => 'autofocus',
                                                'class' => 'form-control form-control-lg text-center',
                                                'tabindex' => '7',
                                                'autocomplete' => rand(),
                                                'style' => '
                                                    font-family: monospace;
                                                    font-size: 250%;
                                                    padding: 0.1em;
                                                    height: auto;
                                                ',
                                                'oninput' => "this.value=this.value.replace(/[^\d]/,'')",
                                            ],
                                            'options' => [
                                                'class' => 'form-group row align-items-center justify-content-center mb-2',
                                            ],
                                            'labelOptions' => [
                                                'class' => 'col-md-3 mb-md-0 font-weight-bold'
                                            ],
                                            'template' => '<div class="col-10 col-md-8 text-center">{input}{hint}{error}</div>',
                                        ])
                                        ->label(false)
                                ?>
                                <div class="text-center mb-0_5">
                                    <button type="submit" class="btn btn-secondary btn-lg rounded-pill">
                                        <?= Yii::t('front', 'Подтвердить') ?>
                                    </button>
                                </div>
                            </div>
                            <div class="modal-footer justify-content-center">
                                <button id="sms-code-button" type="button" class="btn btn-link text-secondary">&nbsp;</button>
                            </div>
                        </div>
                    </div>
                </div>
                
                <?= $form
                        ->field($model, 'username', [
                            'template' => '{input}',
                            'options' => [
                                'class' => 'd-none',
                            ],
                        ])
                        ->hiddenInput()
                        ->label(false)
                ?>

                <?php ActiveForm::end(); ?>
            </div>
        </div>

        <?php if ($model->module->enableAccountDelete): ?>
            <div class="panel panel-danger">
                <div class="panel-heading">
                    <h3 class="panel-title"><?= Yii::t('user', 'Delete account') ?></h3>
                </div>
                <div class="panel-body">
                    <p>
                        <?= Yii::t('user', 'Once you delete your account, there is no going back') ?>.
                        <?= Yii::t('user', 'It will be deleted forever') ?>.
                        <?= Yii::t('user', 'Please be certain') ?>.
                    </p>
                    <?= Html::a(Yii::t('user', 'Delete account'), ['delete'], [
                        'class' => 'btn btn-danger',
                        'data-method' => 'post',
                        'data-confirm' => Yii::t('user', 'Are you sure? There is no going back'),
                    ]) ?>
                </div>
            </div>
        <?php endif ?>
    </div>
</div>


<?php
    $this->registerJS("
        var time = 60;
        
        $('#account-form')
            .on('beforeValidateAttribute', function (event, attr, msg) {
                $('#settings-form-username').val($('#settings-form-email').val());
            })
            .on('beforeSubmit', function (event) {
                event.preventDefault();
                
                if ($('#settings-form-phone').val() != '" . $model->phone . "' && !$('#settings-form-sms_code').val()) {
                    $('#sms-code-modal').modal('show');
                    sendSmsCode();
                    return false;
                }
            });
            
        $(document).on('click', '#sms-code-button', function () {
            sendSmsCode();
        });
        
        sendSmsCode = function () {
            if (time === 60) {
                var sendCode = $.get('/" . Yii::$app->language . "/sms/get-code', {
                    phone: $('#settings-form-phone').val()
                });
                $('#settings-form-sms_code').val('').focus();
                setTimer();
            }
            return false;
        }
        
        setTimer = function () {
            var timer = setInterval(function () {
                if (time === 0) {
                    $('#sms-code-button')
                        .removeAttr('disabled')
                        .text('" . Yii::t('front', 'Отправить СМС-код ещё раз') . "');
                    time = 60;
                    clearInterval(timer);
                    return false;
                } else if (time === 60) {
                    $('#sms-code-button')
                        .attr('disabled', true)
                        .text('" . Yii::t('front', 'Отправить СМС-код ещё раз') . ': ' . Yii::t('front', 'подождите') . " ' + time + ' " . Yii::t('front', 'сек.') . "');
                } else {
                    $('#sms-code-button').text('" . Yii::t('front', 'Отправить СМС-код ещё раз') . ': ' . Yii::t('front', 'подождите') . " ' + time + ' " . Yii::t('front', 'сек.') . "');
                }
                time = time - 1;
            }, 1000);
        }
        
        $('#sms-code-modal').on('shown.bs.modal', function (event) {
            $('#settings-form-sms_code').focus();
        });
        
        $('#sms-code-modal').on('hidden.bs.modal', function (event) {
            $('#settings-form-sms_code').val('');
        });
    ",
    View::POS_READY);
?>