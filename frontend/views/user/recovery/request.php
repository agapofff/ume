<?php

    use yii\helpers\Html;
    use yii\widgets\ActiveForm;
    use yii\web\View;

    $this->title = Yii::t('front', 'Восстановить пароль');
    $this->params['breadcrumbs'][] = $this->title;

?>

<div class="container-xl">
    <h1 class="text-uppercase mb-3 font-weight-light">
        <?= $this->title ?>
    </h1>
    <div class="row justify-content-center">
        <div class="col-xs-12 col-md-10 col-lg-9 col-xl-8">
            <?php 
                $form = ActiveForm::begin([
                    'id' => 'password-recovery-form',
                    // 'action' => '/request',
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
                
                <?= Html::hiddenInput('lang', Yii::$app->language) ?>

                <div class="row justify-content-end mt-1 mt-lg-2">
                    <div class="col-md-9">
                        <?= Html::submitButton(Html::tag('span') .Yii::t('front', 'Продолжить'),
                            [
                                'class' => 'btn btn-lg btn-secondary rounded-pill',
                                'tabindex' => '4',
                                'title' => Yii::t('front', 'Продолжить')
                            ]
                        ) ?>
                    </div>
                </div>

            <?php ActiveForm::end(); ?>
        </div>
        
    </div>
    
</div>