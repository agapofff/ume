<?php

/*
 * This file is part of the Dektrium project.
 *
 * (c) Dektrium project <http://github.com/dektrium>
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\web\View;

/**
 * @var yii\web\View $this
 * @var dektrium\user\models\User $model
 * @var dektrium\user\Module $module
 */

$this->title = Yii::t('front', 'Регистрация');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container-xl">
    <div class="row justify-content-center">
        <div class="col-xs-12 col-md-10 col-lg-9 col-xl-8">
            <h1 class="h2 text-uppercase mb-3 font-weight-light">
                <?= $this->title ?>
            </h1>

            <?php
                $form = ActiveForm::begin([
                    'id' => 'registration-form',
                    // 'action' => '/register',
                    'enableAjaxValidation' => true,
                    'enableClientValidation' => false,
                ]);
            ?>
            
                <?= $form
                        ->field($model, 'first_name', [
                            'inputOptions' => [
                                'autofocus' => 'autofocus',
                                'class' => 'form-control form-control-lg',
                                'tabindex' => '1',
                                'required' => true,
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
                        ->field($model, 'email', [
                            'inputOptions' => [
                                'class' => 'form-control form-control-lg',
                                'tabindex' => '3',
                                'required' => true,
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
                        ->input('email')
                ?>
                
                <?= $form
                        ->field($model, 'phone', [
                            'inputOptions' => [
                                'class' => 'form-control form-control-lg phone-mask',
                                'tabindex' => '4',
                                'required' => true,
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
                



                <?php
                    if ($module->enableGeneratingPassword == false) {
                ?>
                    <?= $form
                            ->field($model, 'password', [
                                'inputOptions' => [
                                    'class' => 'form-control form-control-lg',
                                    'tabindex' => '5',
                                    'required' => true,
                                    'autocomplete' => rand(),
                                ],
                                'options' => [
                                    'class' => 'form-group row align-items-center mb-2',
                                ],
                                'template' => '{label}<div class="col-md-9">{input}</div>{hint}{error}',
                                'labelOptions' => [
                                    'class' => 'col-md-3 mb-md-0 font-weight-bold'
                                ]
                            ])
                            ->passwordInput()
                            ->label(Yii::t('front', 'Пароль'))
                    ?>
                <?php } ?>
                
                <div class="form-group row justify-content-end mt-2 mb-0">
                    <div class="col-md-9">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="agree" name="agree">
                            <label class="custom-control-label" for="agree">
                                <?= Yii::t('front', 'Даю согласие на обработку моих персональных данных.') ?> <?= Html::a(Yii::t('front', 'Подробнее'), [
                                        '/privacy-policy'
                                    ], [
                                        'target' => '_blank',
                                    ]) ?>...
                            </label>
                        </div>
                    </div>
                </div>
                
                <?= Html::hiddenInput('lang', Yii::$app->language) ?>
                
                <div class="row justify-content-end mt-1 mt-lg-2">
                    <div class="col-md-9">
                        <div class="row justify-content-center justify-content-sm-start">
                            <div class="col-auto mb-1">
                                <?= Html::submitButton(Yii::t('front', 'Регистрация'), [
                                        'class' => 'btn btn-lg btn-secondary rounded-pill',
                                        'tabindex' => '6',
                                        'title' => Yii::t('front', 'Регистрация')
                                    ]) 
                                ?>
                            </div>
                            <div class="col-auto mb-1">
                                <?= Html::a(Yii::t('front', 'Авторизация'), ['/login'], [
                                        'class' => 'btn btn-lg btn-outline-secondary rounded-pill',
                                    ])
                                ?>
                            </div>
                        </div>
                        <p>
                            <?= Html::a(Yii::t('front', 'Не получили письмо с подтверждением регистрации?'), [
                                    '/resend'
                                ])
                            ?>
                        </p> 
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
                        ->field($model, 'referal', [
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
    
</div>


<?php
    $this->registerJS("
        var time = 60;
        
        $('#registration-form')
            .on('beforeValidateAttribute', function (event, attr, msg) {
                $('#register-form-username').val($('#register-form-email').val());
            })
            .on('beforeSubmit', function (event) {
                event.preventDefault();
                
                if (!$('#agree').is(':checked')) {
                    toastr.error('" . Yii::t('front', 'Для регистрации учетной записи необходимо Ваше согласие на обработку персональных данных') . "');
                    return false;
                }
                
                if (!$('#register-form-sms_code').val()) {
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
                    phone: $('#register-form-phone').val()
                });
                $('#register-form-sms_code').val('').focus();
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
            $('#register-form-sms_code').focus();
        });
        
        $('#sms-code-modal').on('hidden.bs.modal', function (event) {
            $('#register-form-sms_code').val('');
        });
    ",
    View::POS_READY);
?>
