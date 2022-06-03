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
<div class="container-lg container-xl container-xxl">

    <div class="row justify-content-center">

        <div class="col-xs-12 col-md-10 col-lg-9 col-xl-8 col-xxl-7">
        
            <h1 class="h2 text-center text-uppercase mb-5">
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
                        ->field($model, 'email', [
                            'inputOptions' => [
                                'autofocus' => 'autofocus',
                                'class' => 'form-control form-control-lg',
                                'tabindex' => '2',
                                'required' => true,
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
                        ->field($model, 'username', [
                            'template' => '{input}',
                            'options' => [
                                'class' => 'd-none',
                            ],
                        ])
                        ->hiddenInput()
                        ->label(false)
                ?>

                <?php
                    if ($module->enableGeneratingPassword == false) {
                ?>
                    <?= $form
                            ->field($model, 'password', [
                                'inputOptions' => [
                                    'class' => 'form-control form-control-lg',
                                    'tabindex' => '2',
                                    'required' => true,
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
                
                <div class="row justify-content-center mt-2 mt-md-4 mb-3">
                    <div class="col-auto mb-1">
                        <?= Html::submitButton(Html::tag('span') .Yii::t('front', 'Регистрация'),
                            [
                                'class' => 'btn btn-lg btn-secondary rounded-pill',
                                'tabindex' => '4',
                                'title' => Yii::t('front', 'Регистрация')
                            ]
                        ) ?>
                    </div>
                    <div class="col-auto mb-1">
                        <?= Html::a(Yii::t('front', 'Авторизация'), ['/login'], [
                                'class' => 'btn btn-lg btn-outline-secondary rounded-pill',
                            ])
                        ?>
                    </div>
                </div>

                <p class="text-center">
                    <?= Html::a(Yii::t('front', 'Не получили письмо с подтверждением регистрации?'), [
                            '/resend'
                        ])
                    ?>
                </p>            

            <?php ActiveForm::end(); ?>
            
        </div>

    </div>
    
</div>

<?php
    $this->registerJS("
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
            })
    ",
    View::POS_READY);
?>
