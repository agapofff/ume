<?php

    use dektrium\user\widgets\Connect;
    use dektrium\user\models\LoginForm;
    use yii\helpers\Html;
    use yii\widgets\ActiveForm;
    use yii\web\View;

    /**
     * @var yii\web\View $this
     * @var dektrium\user\models\LoginForm $model
     * @var dektrium\user\Module $module
     */

    $this->title = Yii::t('front', 'Авторизация');
    $this->params['breadcrumbs'][] = $this->title;
    
    $this->registerCss('
        .login-by-phone {
            display: none;
        }
    ');
    
?>

<div class="container-xl">    
    <h1 class="text-uppercase mb-3 font-weight-light">
        <?= $this->title ?>
    </h1>
    
    <div class="row justify-content-center">
        <div class="col-xs-12 col-md-10 col-lg-9 col-xl-8">

            <?= $this->render('/_alert', ['module' => Yii::$app->getModule('user')]) ?>

            <?php
                $form = ActiveForm::begin([
                    'id' => 'login-form',
                    'action' => '/login',
                    'enableAjaxValidation' => true,
                    'enableClientValidation' => false,
                    'validateOnBlur' => false,
                    'validateOnType' => false,
                    'validateOnChange' => false,
                ]); 
            ?>
            
                <div class="login-by-email">
                    <?= $form
                            ->field($model, 'login', [
                                'inputOptions' => [
                                    // 'autofocus' => 'autofocus',
                                    'class' => 'form-control form-control-lg',
                                    'autocomplete' => rand(),
                                    'tabindex' => '1',
                                    // 'required' => true,
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
                            ->input('email')
                            ->label(Yii::t('front', 'E-mail'));
                    ?>

                    <?= $form
                            ->field($model, 'password', [
                                'inputOptions' => [
                                    'class' => 'form-control form-control-lg',
                                    'tabindex' => '2',
                                    // 'required' => true,
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
                            ->passwordInput()
                            ->label(Yii::t('front', 'Пароль'))
                            ->hint(Html::tag('div', Html::a(Yii::t('front', 'Забыли пароль?'), ['/request']), [
                                'class' => 'col-md-9 offset-md-3'
                            ]))
                    ?>
                </div>
                
                <div class="login-by-phone">
                    <?= $form
                            ->field($model, 'phone', [
                                'inputOptions' => [
                                    'class' => 'form-control form-control-lg phone-mask',
                                    'tabindex' => '4',
                                    // 'required' => true,
                                    'autocomplete' => rand(),
                                ],
                                'options' => [
                                    'class' => 'form-group row align-items-center mb-2',
                                ],
                                'template' => '{label}<div class="col-sm-9">{input}</div><div class="col-sm-9 offset-sm-3"><div class="row justify-content-between"><div class="col-auto"><small>{hint}</small></div><div class="col-auto text-right"><small>{error}</small></div></div></div>',
                                'labelOptions' => [
                                    'class' => 'col-sm-3 mb-0'
                                ]
                            ])
                    ?>
                </div>
                
                <?= $form
                        ->field($model, 'type')
                        ->hiddenInput()
                        ->label(false)
                ?>
                
                <?= Html::hiddenInput('lang', Yii::$app->language) ?>
                
                <div class="row justify-content-end mt-1 mt-lg-2">
                    <div class="col-md-9">
                        <div class="row justify-content-center justify-content-sm-start">
                            <div class="col-auto mb-1">
                                <?= Html::submitButton(Html::tag('span') .Yii::t('front', 'Авторизация'),
                                    [
                                        'class' => 'btn btn-lg btn-secondary rounded-pill',
                                        'tabindex' => '4',
                                        'title' => Yii::t('front', 'Авторизация')
                                    ]
                                ) ?>
                            </div>
                            <div class="col-auto mb-1">
                                <?= Html::a(Yii::t('front', 'Регистрация'), ['/register'], [
                                        'class' => 'btn btn-lg btn-outline-secondary rounded-pill',
                                    ])
                                ?>
                            </div>
                            <div class="col-12 mb-1">
                                <button type="button" class="btn btn-link login-by-email" onclick="switchLoginForm(1);">
                                    <?= Yii::t('front', 'Войти по СМС-коду') ?>
                                </button>
                                <button type="button" class="btn btn-link login-by-phone" onclick="switchLoginForm(0);">
                                    <?= Yii::t('front', 'Войти по email и паролю') ?>
                                </button>
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
                                                // 'autofocus' => 'autofocus',
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
                                <button id="sms-code-button" type="button" class="btn btn-link text-secondary">
                                    <?= Yii::t('front', 'Отправить СМС-код еще раз') ?>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                
                <?= Connect::widget([
                    'baseAuthUrl' => ['/user/security/auth'],
                ]) ?>

            <?php ActiveForm::end(); ?>

        </div>
    </div>
   
</div>


<?php
    $this->registerJS("

        switchLoginForm = function (byPhone = 0) {
            if (byPhone) {
                // $('.login-by-email').hide();
                $('.login-by-phone').show();
                $('#login-form-type').val('phone');
                $('#login-form-phone').focus();
            } else {
                $('.login-by-email').show();
                // $('.login-by-phone').hide(); 
                $('#login-form-type').val('email');
                $('#login-form-login').focus();
            }
        }
        
        var time = 60;
        
        $('#login-form')
            .on('beforeSubmit', function (event) {
                event.preventDefault();               
console.log('submit');                
                if ($('#login-form-type').val() == 'phone' && !$('#login-form-sms_code').val()) {
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
                    phone: $('#login-form-phone').val()
                });
                $('#login-form-sms_code').val('').focus();
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
            $('#login-form-sms_code').focus();
        });
        
        $('#sms-code-modal').on('hidden.bs.modal', function (event) {
            $('#login-form-sms_code').val('');
        });
    ",
    View::POS_READY);
?>