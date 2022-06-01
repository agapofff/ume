<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use yii\widgets\Pjax;
use yii\widgets\ActiveForm;
use kartik\alert\AlertBlock;
use kartik\switchinput\SwitchInput;
use kartik\datecontrol\Module;
use kartik\datecontrol\DateControl;
use agapofff\gallery\widgets\Gallery;

/* @var $this yii\web\View */
/* @var $model backend\models\Reviews */
/* @var $form yii\widgets\ActiveForm */
?>

<?php Pjax::begin(); ?>

    <div class="reviews-form">
    
        <?= AlertBlock::widget([
                'type' => 'growl',
                'useSessionFlash' => true,
                'delay' => 1,
            ]);
        ?>

        <?php 
            $form = ActiveForm::begin([
                'options' => [
                    'enctype' => 'multipart/form-data',
                ]
            ]);
        ?>

            <?= $form
                ->field($model, 'active')
                ->widget(SwitchInput::classname(), [
                    'pluginOptions' => [
                        'onText' => Yii::t('back', 'Да'),
                        'offText' => Yii::t('back', 'Нет'),
                        'onColor' => 'success',
                        'offColor' => 'danger',
                    ],
                ]);
            ?>
            
            <?= $form
                    ->field($model, 'created')
                    ->widget(DateControl::classname(), [
                        'type' => 'date',
                        'displayFormat' => 'php:d F Y',
                        'saveFormat' => 'php:Y-m-d',
                        'saveTimezone' => 'Europe/Moscow',
                        'displayTimezone' => 'Europe/Moscow',
                        'widgetOptions' => [
                            'pluginOptions' => [
                                'autoclose' => true,
                                'format' => 'php:d F Y',
                            ],
                            'layout' => '{picker}{input}{remove}',
                            'options' => [
                                'placeholder' => Yii::t('back', 'Выберите дату')
                            ],
                        ],
                        'language' => 'ru',
                    ]);
            ?>
            
            <?= $form
                    ->field($model, 'language')
                    ->radioList(
                        ArrayHelper::map($languages, 'code', 'code'), 
                        [
                            'class' => 'btn-group',
                            'data-toggle' => 'buttons',
                            'unselect' => null,
                            'item' => function ($index, $label, $name, $checked, $value) {
                                return '<label class="btn btn-primary text-white '. ($checked ? ' active' : '') . '">' .
                                            Html::radio($name, $checked, [
                                                'value' => $value,
                                                'class' => 'btn-switch'
                                            ]) . strtoupper($label) . 
                                        '</label>';
                            },
                        ]
                    )
                    ->label(Yii::t('back', 'Язык'), [
                        'style' => 'display: block'
                    ])
            ?>
            
            <?= $form
                    ->field($model, 'product_id')
                    ->dropDownList(ArrayHelper::map($products, 'id', function ($product) {
                        return json_decode($product['name'])->{Yii::$app->language};
                    }), [
                        'prompt' => Yii::t('back', 'Нет')
                    ])
            ?>

            <?= $form
                    ->field($model, 'booster_id')
                    ->hiddenInput() 
                    ->label(false)
            ?>

            <?= $form
                    ->field($model, 'user_id')
                    ->dropDownList(ArrayHelper::map($users, 'id', 'username'))
            ?>
            
            <?= Gallery::widget([
                    'model' => $model,
                    'label' => Yii::t('back', 'Фотография питомца'),
                    'previewSize' => '200x200',
                    'fileInputPluginOptions' => [
                        'showPreview' => false,
                    ],
                    'containerClass' => 'row',
                    'elementClass' => 'col-xs-6',
                    // 'deleteButtonClass' => 'btn btn-sm btn-danger position-absolute top-0 right-0',
                    'deleteButtonText' => Html::tag('i', '', ['class' => 'fa fa-trash']),
                    // 'editButtonClass' => 'btn btn-sm btn-info position-absolute bottom-0 right-0',
                    'editButtonText' => Html::tag('i', '', ['class' => 'fa fa-edit']),
                ]);
            ?>
            <br>

            <?= $form
                    ->field($model, 'pet_name')
                    ->textInput([
                        'maxlength' => true
                    ]) 
            ?>

            <?= $form
                    ->field($model, 'pet_breed')
                    ->dropDownList(ArrayHelper::map($breeds, 'id', function ($breed) {
                        return json_decode($breed->name)->{Yii::$app->language};
                    }))
            ?>

            <?= $form
                    ->field($model, 'pet_birthday')
                    ->widget(DateControl::classname(), [
                        'type' => 'date',
                        'displayFormat' => 'php:d F Y',
                        'saveFormat' => 'php:Y-m-d',
                        'saveTimezone' => 'Europe/Moscow',
                        'displayTimezone' => 'Europe/Moscow',
                        'widgetOptions' => [
                            'pluginOptions' => [
                                'autoclose' => true,
                                'format' => 'php:d F Y',
                            ],
                            'layout' => '{picker}{input}{remove}',
                            'options' => [
                                'placeholder' => Yii::t('back', 'Выберите дату')
                            ],
                        ],
                        'language' => 'ru',
                    ]);
            ?>

            <?= $form
                    ->field($model, 'rating')
                    ->radioList(
                        range(1, 5), 
                        [
                            'class' => 'btn-group',
                            'data-toggle' => 'buttons',
                            'unselect' => null,
                            'item' => function ($index, $label, $name, $checked, $value) {
                                return '<label class="btn btn-primary text-white '. ($checked ? ' active' : '') . '">' . Html::radio($name, $checked, [
                                        'value' => $value,
                                        'class' => 'btn-switch'
                                    ]) . strtoupper($label) . 
                                '</label>';
                            },
                        ]
                    )
                    ->label(Yii::t('back', 'Рейтинг'), [
                        'style' => 'display: block'
                    ])
            ?>

            <?= $form
                    ->field($model, 'text')
                    ->textarea([
                        'rows' => 6
                    ]) 
            ?>

            <?= $form
                    ->field($model, 'saveAndExit')
                    ->hiddenInput([
                        'class' => 'saveAndExit'
                    ])
                    ->label(false)
            ?>

            <br>
            <div class="form-group text-center">
                <?= Html::submitButton(Html::tag('span', '', [
                    'class' => 'glyphicon glyphicon-floppy-saved'
                ]) . '&nbsp;' . Yii::t('back', 'Сохранить'), [
                    'class' => 'btn btn-success btn-lg'
                ]) ?>
                
                <?php if ($model->id) { ?>
                    <?= Html::submitButton(Html::tag('span', '', [
                        'class' => 'glyphicon glyphicon-floppy-remove'
                    ]) . '&nbsp;' . Yii::t('back', 'Сохранить и закрыть'), [
                        'class' => 'btn btn-default btn-lg saveAndExit'
                    ]) ?>
                <?php } ?>
            </div>

        <?php ActiveForm::end(); ?>

    </div>

<?php Pjax::end(); ?>