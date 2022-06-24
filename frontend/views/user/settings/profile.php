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
use yii\bootstrap4\ToggleButtonGroup;
use agapofff\gallery\widgets\Gallery;

/**
 * @var yii\web\View $this
 * @var yii\widgets\ActiveForm $form
 * @var dektrium\user\models\Profile $model
 */

$this->title = Yii::t('front', 'Заполнить профиль');
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="container-lg container-xl container-xxl">
    <h1 class="text-uppercase mb-3 wow fadeIn" data-wow-duration="0.5s">
        <?= Yii::t('front', 'Личный кабинет') ?>
    </h1>
    <h4 class="position-relative text-uppercase font-weight-normal mb-4">
        <?= Yii::t('front', 'Заполнить профиль') ?>
    </h4>
    
    <?php 
        $form = ActiveForm::begin([
            'id' => 'account-form',
            'enableAjaxValidation' => true,
            'enableClientValidation' => false,
            'validateOnBlur' => false,
            'validateOnType' => false,
            'validateOnChange' => false,
            'fieldConfig' => [
                'options' => [
                    'class' => 'form-group row align-items-center mb-1',
                ],
                'labelOptions' => [
                    'class' => 'col-md-4 mb-md-0 font-weight-bold'
                ],
                'template' => '{label}<div class="col-md-8">{input}</div>{hint}{error}',
                'inputOptions' => [
                    'class' => 'form-control form-control-lg',
                    'autocomplete' => rand(),
                ],
            ],
            'options' => [
                'enctype' => 'multipart/form-data',
            ],
        ]);
    ?>
    
        <h4 class="position-relative mb-3">
            <?= Yii::t('front', 'Основная информация о питомце') ?>
        </h4>
    
        <div class="row mb-3">
            <div class="col-md-3">
                <img src="<?= $user->getImage()->getUrl('400x400') ?>" class="img-fluid rounded-pill border border-teal cursor-pointer file-upload-trigger" style="border-width: 3px !important" onclick="$('.file-input').find('input').click();">
                <div class="d-none">
                    <?= Gallery::widget([
                            'model' => $user,
                            'label' => false,
                            'previewSize' => '400x400',
                            'containerClass' => 'row',
                            'elementClass' => 'col-12',
                            // 'deleteButtonClass' => '',
                            'editButtonClass' => 'd-none',
                            'fileInputPluginLoading' => false,
                            'fileInputPluginOptions' => [
                                'showPreview' => false,
                                'language' => 'ru',
                            ],
                        ]);
                    ?>
                </div>
            </div>
            <div class="col-md-8 offset-md-1">
                <?= $form
                        ->field($model, 'name', [
                            'inputOptions' => [
                                'placeholder' => Yii::t('front', 'Мой питомец'),
                            ]
                        ])
                ?>
                
                <?= $form
                        ->field($model, 'sex', [
                            'options' => []
                        ])
                        ->widget(ToggleButtonGroup::class, [
                            'type' => ToggleButtonGroup::TYPE_RADIO,
                            'items' => Yii::$app->params['sex'],
                            'options' => [
                                'class' =>'btn-group btn-group-toggle p-0_25 form-control-lg d-flex rounded-lg border-gray-600 border bg-gray-200',
                            ],
                            'labelOptions' => [
                                'class' => 'btn btn-link form-control-lg align-items-center d-flex h-100 w-50 justify-content-center text-decoration-none text-dark rounded-lg p-0',
                            ],
                        ])
                ?>
                
                <?= $form
                        ->field($model, 'breed')
                        ->dropdownList(ArrayHelper::map($breeds, 'id', function ($breed) {
                            return json_decode($breed->name)->{Yii::$app->language};
                        }), [
                            'prompt' => Yii::t('front', 'Выберите')
                        ])
                ?>
                
                <?php
                    $birthday = explode('-', $model->birthday);
                    
                    $days = [
                        '' => Yii::t('front', 'День')
                    ];
                    for ($d = 1; $d < 32; $d++) {
                        $days[str_pad($d, 2, '0', STR_PAD_LEFT)] = $d;
                    }
                    
                    $months = [
                        '' => Yii::t('front', 'Месяц')
                    ];
                    for ($m = 1; $m < 13; $m++) {
                        $months[str_pad($m, 2, '0', STR_PAD_LEFT)] = Yii::t('front', '{0, date, LLLL}', mktime(0, 0, 0, $m, 10)); 
                    }
                    
                    $years = ['' => Yii::t('front', 'Год')];
                    for ($y = 1970; $y <= date('Y'); $y++) {
                        $years[$y] = $y;
                    }
                ?>
                <div class="form-group row align-items-center mb-1">
                    <label class="col-md-4 mb-md-0 font-weight-bold" for="profile-breed">
                        <?= Yii::t('front', 'Дата рождения') ?>
                    </label>
                    <div class="col-md-8">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <?= Html::dropDownList('days', $birthday[2], $days, [
                                        'id' => 'day',
                                        'class' => 'birthday form-control form-control-lg'
                                    ]) 
                                ?>
                            </div>
                            <?= Html::dropDownList('months', $birthday[1], $months, [
                                    'id' => 'month',
                                    'class' => 'birthday form-control form-control-lg'
                                ]) 
                            ?>
                            <div class="input-group-append">
                                <?= Html::dropDownList('years', $birthday[0], $years, [
                                        'id' => 'year',
                                        'class' => 'birthday form-control form-control-lg'
                                    ]) 
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
                <?= $form
                        ->field($model, 'birthday', [
                            'options' => [
                                'class' => 'd-none',
                            ]
                        ])
                        ->hiddenInput()
                        ->label(false)
                ?>
                
                <?php
                    $weights = [];
                    for ($w = 0; $w < 100; $w++) {
                        $weights[$w] = $w . ' ' . Yii::t('front', 'кг');
                    }
                ?>
                <?= $form
                        ->field($model, 'weight')
                        ->dropdownList($weights, [
                            'prompt' => Yii::t('front', 'Выберите')
                        ])
                ?>
                
                <?= $form
                        ->field($model, 'activity', [
                            'options' => [
                                'class' => 'form-group row mt-1_5 mb-1 field-profile-activity',
                            ],
                        ])
                        ->radioList(Yii::$app->params['activity'], [
                            'item' => function ($index, $label, $name, $checked, $value) {
                                    return '<div class="custom-control custom-radio mb-1"><input type="radio" id="' . $name . $index . '" name="' . $name . '" class="custom-control-input" value="' . $value . '"' . ($checked ? ' checked' : '') . '><label class="custom-control-label" for="' . $name . $index . '">' . $label .'</label></div>';
                                }
                        ])
                ?>
            </div>
        </div>
        
        <h4 class="position-relative mb-3">
            <?= Yii::t('front', 'Контактные данные хозяина') ?>
        </h4>
        
        <div class="row">
            <div class="col-md-8 offset-md-4">
                <?= $form
                        ->field($model, 'first_name', [
                            'inputOptions' => [
                                'placeholder' => Yii::t('front', 'Ваше имя'),
                                'required' => true,
                                'autocomplete' => rand(),
                            ]
                        ])
                ?>
                
                <?= $form
                        ->field($model, 'phone', [
                            'inputOptions' => [
                                'class' => 'form-control form-control-lg phone-mask',
                                'required' => true,
                                'autocomplete' => rand(),
                            ]
                        ])
                ?>
                
                <?= $form
                        ->field($model, 'public_email', [
                            'inputOptions' => [
                                'placeholder' => Yii::t('front', 'Ваш e-mail'),
                                'required' => true,
                                'autocomplete' => rand(),
                            ]
                        ])
                        ->input('email')
                ?>
                
                <div class="row mt-4 mb-3">
                    <div class="col-auto mb-1">
                        <?= Html::submitButton(Yii::t('front', 'Сохранить'), [
                                'class' => 'btn btn-lg btn-secondary rounded-pill',
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
    
    <?php ActiveForm::end(); ?>
    
</div>
