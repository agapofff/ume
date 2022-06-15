<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use yii\widgets\Pjax;
use yii\widgets\ActiveForm;
use kartik\alert\AlertBlock;
use kartik\switchinput\SwitchInput;
use agapofff\gallery\widgets\Gallery;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model backend\models\Banners */
/* @var $form yii\widgets\ActiveForm */
?>

<?php Pjax::begin(); ?>

    <div class="banners-form">
    
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
            
            <?= Gallery::widget([
                    'model' => $model,
                    'label' => Yii::t('back', 'Изображение'),
                    'previewSize' => '200x200',
                    'fileInputPluginOptions' => [
                        'showPreview' => false,
                    ],
                    'containerClass' => 'row',
                    'elementClass' => 'col-xs-6',
                    'deleteButtonText' => Html::tag('i', '', ['class' => 'fa fa-trash']),
                    'editButtonText' => Html::tag('i', '', ['class' => 'fa fa-edit']),
                ]);
            ?>
            <br>

            <?= $form->field($model, 'category')->widget(Select2::classname(), [ 
                    'data' => $categories,
                    'options' => [
                        'placeholder' => 'Выберите или введите категорию'
                    ],
                    'pluginOptions' => [
                        'tags' => true,
                        'tokenSeparators' => [','],
                        'maximumInputLength' => 30
                    ],
                ]);
            ?>

            <div class="form-group-json">
                <?= $form
                        ->field($model, 'text', [
                            'labelOptions' => [
                                'style' => 'text-align: left; margin-bottom: 0;',
                            ],
                        ])
                        ->hiddenInput([
                            'class' => 'is_json'
                        ])
                ?>
                <ul class="nav nav-pills">
            <?php
                foreach ($languages as $key => $lang) {
            ?>
                    <li <?php if ($lang->code == Yii::$app->language) {?>class="active"<?php } ?>>
                        <a href="#text_<?= $lang->code ?>_tab" aria-controls="text_<?= $lang->code ?>_tab" role="tab" data-toggle="tab"><?= strtoupper($lang->code) ?></a>
                    </li>
            <?php
                }
            ?>
                </ul>
                <div class="tab-content">
            <?php
                foreach ($languages as $key => $lang) {
            ?>
                    <div role="tabpanel" class="tab-pane <?php if ($lang->code == Yii::$app->language) { ?>active<?php } ?>" id="text_<?= $lang->code ?>_tab" style="padding-left: 0; padding-right: 0;">
                        <?= Html::input(
                                'text',
                                'text_'.$lang->code,
                                json_decode($model->text)->{$lang->code},
                                [
                                    'id' => 'banners_text_'.$lang->code,
                                    'class' => 'form-control json_field',
                                    'data' => [
                                        'field' => 'banners-text',
                                        'lang' => $lang->code,
                                    ]
                                ]
                            )
                        ?>
                    </div>
            <?php
                }
            ?>
                </div>
            </div>
            
            <?= $form
                    ->field($model, 'link')
                    ->textInput([
                        'maxlength' => true
                    ]) 
            ?>

            <?= $form
                ->field($model, 'show_button')
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
                    ->field($model, 'button_text')
                    ->textInput([
                        'maxlength' => true
                    ]) 
            ?>

            <?= $form
                    ->field($model, 'content_align')
                    ->radioList([
                        'Слева',
                        'По центру',
                        'Справа',
                    ], [
                        'class' => 'btn-group',
                        'data-toggle' => 'buttons',
                        'unselect' => null,
                        'item' => function ($index, $label, $name, $checked, $value) {
                            return '<label class="btn btn-primary text-white '. ($checked ? ' active' : '') . '">' .
                                        Html::radio($name, $checked, [
                                            'value' => $value,
                                            'class' => 'btn-switch'
                                        ]) . $label . 
                                    '</label>';
                        },
                    ])
                    ->label(Yii::t('back', 'Расположение контента'), [
                        'style' => 'display: block'
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