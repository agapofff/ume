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
    
?>

<div class="container-lg container-xl container-xxl">    

    <div class="row justify-content-center">

        <div class="col-xs-12 col-md-10 col-lg-9 col-xl-8 col-xxl-7">
        
            <h1 class="h2 text-center text-uppercase mb-5">
                <?= $this->title ?>
            </h1>

            <?= $this->render('/_alert', ['module' => Yii::$app->getModule('user')]) ?>

            <?php
                $form = ActiveForm::begin([
                    'id' => 'login-form',
                    // 'action' => '/login',
                    'enableAjaxValidation' => true,
                    'enableClientValidation' => false,
                    'validateOnBlur' => false,
                    'validateOnType' => false,
                    'validateOnChange' => false,
                ]); 
            ?>
        
                <?= $form
                        ->field($model, 'login', [
                            'inputOptions' => [
                                'autofocus' => 'autofocus',
                                'class' => 'form-control form-control-lg',
                                'autocomplete' => rand(),
                                'tabindex' => '1',
                                'required' => true,
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
                
                <?= Html::hiddenInput('lang', Yii::$app->language) ?>
                
                <div class="row justify-content-center mt-3 mt-md-5 mb-3">
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
                </div>
                
                <p class="lead text-center">
                    <?= Html::a(Yii::t('front', 'Забыли пароль?'), ['/request'])?>
                </p>
                
                <?= Connect::widget([
                    'baseAuthUrl' => ['/user/security/auth'],
                ]) ?>

            <?php ActiveForm::end(); ?>

        </div>
    </div>
   
</div>