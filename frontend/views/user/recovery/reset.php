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
use yii\widgets\ActiveForm;

/**
 * @var yii\web\View $this
 * @var yii\widgets\ActiveForm $form
 * @var dektrium\user\models\RecoveryForm $model
 */

$this->title = Yii::t('front', 'Новый пароль');
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
                    // 'action' => str_replace('/' . Yii::$app->language, '', Url::to()),
                    'enableAjaxValidation' => true,
                    'enableClientValidation' => false,
                ]);
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
                        ->label(Yii::t('front', 'Новый пароль'));
                ?>
                
                <?= Html::hiddenInput('lang', Yii::$app->language) ?>

                <div class="row justify-content-end mt-2 mt-md-4 mb-3">
                    <div class="col-md-9">
                        <?= Html::submitButton(Html::tag('span') .Yii::t('front', 'Сохранить'),
                            [
                                'class' => 'btn btn-lg btn-secondary rounded-pill',
                                'tabindex' => '3',
                                'title' => Yii::t('front', 'Сохранить')
                            ]
                        ) ?>
                    </div>
                </div>

            <?php ActiveForm::end(); ?>
        </div>
        
    </div>
    
</div>
