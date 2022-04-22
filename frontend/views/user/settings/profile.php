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
use dektrium\user\helpers\Timezone;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

/**
 * @var yii\web\View $this
 * @var yii\widgets\ActiveForm $form
 * @var dektrium\user\models\Profile $model
 */

$this->title = Yii::t('front', 'Мой профиль');
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="container">

    <h1 class="text-center acline font-weight-light my-5">
        <?= $this->title ?>
    </h1>

    <div class="row justify-content-start">
        
        <div class="col-12 col-md-4 col-lg-3 mb-5">
            <div class="row d-flex d-md-block justify-content-center justify-content-md-start">
                <div class="mr-3 mr-md-0 mb-3">
                    <?= Html::a(Yii::t('front', 'Мой профиль'), ['/profile']) ?>
                </div>
                <div class="mr-3 mr-md-0 mb-3">
                    <?= Html::a(Yii::t('front', 'Изменить пароль'), ['/pass']) ?>
                </div>
                <div class="mr-3 mr-md-0 mb-3">
                    <?= Html::a(Yii::t('front', 'Выход'), ['/logout']) ?>
                </div>
            </div>
        </div>
        
        <div class="col-12 col-sm-10 col-md-8 col-lg-6">
            
            <?php $form = ActiveForm::begin([
                    'id' => 'profile-form',
                    'action' => '/profile',
                    'enableAjaxValidation' => true,
                    'enableClientValidation' => false,
                    'validateOnBlur' => false,
                    'options' => [
                        'data' => [
                            'pjax' => true
                        ],
                    ],
                ]);
            ?>
            
                <?= $form
                        ->field($model, 'first_name', [
                            'inputOptions' => [
                                'class' => 'form-control mb-0 px-0',
                                'autocomplete' => rand(),
                                'placeholder' => ' ',
                            ],
                            'options' => [
                                'class' => 'form-group mb-5 position-relative floating-label',
                            ],
                            'template' => '{input}{label}{hint}{error}',
                        ])
                        ->label(Yii::t('front', 'Имя'))
                ?>
                
                <?= $form
                        ->field($model, 'last_name', [
                            'inputOptions' => [
                                'class' => 'form-control mb-0 px-0',
                                'autocomplete' => rand(),
                                'placeholder' => ' ',
                            ],
                            'options' => [
                                'class' => 'form-group mb-5 position-relative floating-label',
                            ],
                            'template' => '{input}{label}{hint}{error}',
                        ])
                        ->label(Yii::t('front', 'Фамилия'))
                ?>
                
                <?= $form
                        ->field($model, 'address', [
                            'inputOptions' => [
                                'class' => 'form-control mb-0 px-0',
                                'autocomplete' => rand(),
                                'placeholder' => ' ',
                            ],
                            'options' => [
                                'class' => 'form-group mb-5 position-relative floating-label',
                            ],
                            'template' => '{input}{label}{hint}{error}',
                        ])
                        // ->textarea()
                        ->label(Yii::t('front', 'Адрес'))
                ?>
                
                <?= $form
                        ->field($model, 'birthday', [
                            'inputOptions' => [
                                'class' => 'form-control mb-0 px-0',
                                'placeholder' => Yii::t('front', 'День рождения'),
                            ],
                            'options' => [
                                'class' => 'form-group mb-5 position-relative floating-label',
                            ],
                            'template' => '{input}{label}{hint}{error}',
                        ])
                        ->textInput([
                            'type' => 'date',
                            'placeholder' => Yii::t('front', 'День рождения'),
                        ])
                        ->label(Yii::t('front', 'День рождения'))
                ?>

                <div class="form-group mb-5">
                    <label class="control-label float-left mr-4">
                        <?= Yii::t('front', 'Пол') ?>
                    </label>
                    <?= $form
                            ->field($model, 'sex')
                            ->radioList(
                                [
                                    1 => Yii::t('front', 'Мужской'),
                                    0 => Yii::t('front', 'Женский'),
                                ],
                                [
                                    'item' => function ($index, $label, $name, $checked, $value) {
                                        return '
                                            <div class="custom-control custom-radio d-inline mr-4">
                                                <input type="radio" name="' . $name . '" class="custom-control-input" ' . ($checked ? 'checked': '') . ' id="' . $name . $value . '" value="' . $value . '">
                                                <label class="custom-control-label" for="' . $name . $value . '">' . $label . '</label>
                                            </div>';
                                    }
                                ]
                            )
                            ->label(false)
                    ?>
                </div>

                <?= $form
                        ->field($model, 'comment', [
                            'inputOptions' => [
                                'class' => 'form-control mb-0 px-0',
                                'autocomplete' => rand(),
                                'placeholder' => ' ',
                            ],
                            'options' => [
                                'class' => 'form-group mb-5 position-relative floating-label',
                            ],
                            'template' => '{input}{label}{hint}{error}',
                        ])
                        // ->textarea()
                        ->label(Yii::t('front', 'Комментарий'))
                ?>

                <?= $form
                        ->field($model, 'agree', [
                            'options' => [
                                'class' => 'form-group mb-5',
                            ],
                            'inputOptions' => [
                                'class' => 'custom-control-input',
                                'checked' => ($model->agree ? 'checked' : false),
                            ],
                            'labelOptions' => [
                                'class' => 'custom-control-label',
                            ],
                            'template' => '<div class="custom-control custom-checkbox">{input}{label}</div>',
                        ])
                        ->textInput([
                            'type' => 'checkbox',
                        ])
                        ->label(Yii::t('front', 'Я хочу получать новостную рассылку'))
                ?>

                <div class="text-center my-5">
                    <?= Html::submitButton(Html::tag('span') . Yii::t('front', 'Сохранить'), [
                            'class' => 'btn-nrk',
                            'title' => Yii::t('front', 'Сохранить'),
                        ])
                    ?>
                </div>
                
                <?= Html::hiddenInput('lang', Yii::$app->language) ?>

            <?php ActiveForm::end(); ?>
            
        </div>
        
    </div>
    
</div>
