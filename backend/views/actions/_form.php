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
/* @var $model backend\models\Actions */
/* @var $form yii\widgets\ActiveForm */
?>

<?php Pjax::begin(); ?>

    <div class="actions-form">
    
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
                    ->field($model, 'published')
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
                    ->field($model, 'type')
                    ->dropDownList(Yii::$app->params['actionsTypes'])
            ?>

            <div class="form-group-json">
                <?= $form
                        ->field($model, 'name', [
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
                        <a href="#name_<?= $lang->code ?>_tab" aria-controls="name_<?= $lang->code ?>_tab" role="tab" data-toggle="tab"><?= strtoupper($lang->code) ?></a>
                    </li>
            <?php
                }
            ?>
                </ul>
                <div class="tab-content">
            <?php
                foreach ($languages as $key => $lang) {
            ?>
                    <div role="tabpanel" class="tab-pane <?php if ($lang->code == Yii::$app->language) { ?>active<?php } ?>" id="name_<?= $lang->code ?>_tab" style="padding-left: 0; padding-right: 0;">
                        <?= Html::input(
                                'text',
                                'name_'.$lang->code,
                                json_decode($model->name)->{$lang->code},
                                [
                                    'id' => 'actions_name_'.$lang->code,
                                    'class' => 'form-control json_field',
                                    'data' => [
                                        'field' => 'actions-name',
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
                    ->field($model, 'slug')
                    ->textInput([
                        'maxlength' => true
                    ])
            ?>
            
            <div class="form-group">
                <?= Gallery::widget([
                        'model' => $model,
                        'label' => Yii::t('back', 'Главное изображение'),
                        'previewSize' => '800x400',
                        'fileInputPluginOptions' => [
                            'showPreview' => false,
                        ],
                        'containerClass' => 'row',
                        'elementClass' => 'col-xs-12',
                        'deleteButtonText' => Html::tag('i', '', ['class' => 'fa fa-trash']),
                        'editButtonText' => Html::tag('i', '', ['class' => 'fa fa-edit']),
                    ]);
                ?>
            </div>  

            <div class="form-group-json">
                <?= $form
                        ->field($model, 'title', [
                            'labelOptions' => [
                                'style' => 'text-align: left; margin-bottom: 0;',
                            ]
                        ])
                        ->hiddenInput([
                            'class' => 'is_json'
                        ])
                ?>
                <ul class="nav nav-pills">
            <?php
                foreach ($languages as $key => $lang) {
            ?>
                    <li <?php if ($lang->code == Yii::$app->language) { ?>class="active"<?php } ?>>
                        <a href="#title_<?= $lang->code ?>_tab" aria-controls="title_<?= $lang->code ?>_tab" role="tab" data-toggle="tab"><?= strtoupper($lang->code) ?></a>
                    </li>
            <?php
                }
            ?>
                </ul>
                <div class="tab-content">
            <?php
                foreach ($languages as $key => $lang) {
            ?>
                    <div role="tabpanel" class="tab-pane <?php if ($lang->code == Yii::$app->language) { ?>active<?php } ?>" id="title_<?= $lang->code ?>_tab" style="padding-left: 0; padding-right: 0;">
                        <?= Html::input(
                                'text',
                                'title_'.$lang->code,
                                json_decode($model->description)->{$lang->code},
                                [
                                    'id' => 'actions_title_'.$lang->code,
                                    'class' => 'form-control json_field',
                                    'data' => [
                                        'field' => 'actions-title',
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

            <div class="form-group-json">
                <?= $form
                        ->field($model, 'description', [
                            'labelOptions' => [
                                'style' => 'text-align: left; margin-bottom: 0;',
                            ]
                        ])
                        ->hiddenInput([
                            'class' => 'is_json'
                        ])
                ?>
                <ul class="nav nav-pills">
            <?php
                foreach ($languages as $key => $lang) {
            ?>
                    <li <?php if ($lang->code == Yii::$app->language) { ?>class="active"<?php } ?>>
                        <a href="#description_<?= $lang->code ?>_tab" aria-controls="description_<?= $lang->code ?>_tab" role="tab" data-toggle="tab"><?= strtoupper($lang->code) ?></a>
                    </li>
            <?php
                }
            ?>
                </ul>
                <div class="tab-content">
            <?php
                foreach ($languages as $key => $lang) {
            ?>
                    <div role="tabpanel" class="tab-pane <?php if ($lang->code == Yii::$app->language) { ?>active<?php } ?>" id="description_<?= $lang->code ?>_tab" style="padding-left: 0; padding-right: 0;">
                        <?= Html::input(
                                'text',
                                'description_'.$lang->code,
                                json_decode($model->description)->{$lang->code},
                                [
                                    'id' => 'actions_description_'.$lang->code,
                                    'class' => 'form-control json_field',
                                    'data' => [
                                        'field' => 'actions-description',
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

            <div class="form-group-json">
                <?= $form
                        ->field($model, 'text', [
                            'labelOptions' => [
                                'style' => 'text-align: left; margin-bottom: 0;',
                            ]
                        ])
                        ->textarea([
                            'class' => 'is_json hidden'
                        ])
                ?>
                <ul class="nav nav-pills">
            <?php
                foreach ($languages as $key => $lang) {
            ?>
                    <li <?php if ($lang->code == Yii::$app->language) { ?>class="active"<?php } ?>>
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
                    <div role="tabpanel" class="tab-pane <?php if ($lang->code == Yii::$app->language) { ?>active<?php } ?>" id="text_<?= $lang->code ?>_tab">
                        <?= \vova07\imperavi\Widget::widget([
                                'id' => 'actions_text_'.$lang->code,
                                'name' => 'actions_text_'.$lang->code,
                                'value' => json_decode($model->text)->{$lang->code},
                                'settings' => [
                                    'lang' => Yii::$app->language,
                                    // 'buttonsHide' => [
                                        // 'file',
                                    // ],
                                    'minHeight' => 400,
                                    'maxHeight' => 600,
                                    'imageUpload' => Url::toRoute(['/site/image-upload']),
                                    'imageDelete' => Url::toRoute(['/site/image-delete']),
                                    'imageManagerJson' => Url::to(['/site/images-get']),
                                    'plugins' => [
                                        'fullscreen',
                                    ],
                                    'replaceDivs' => false,
                                ],
                                'plugins' => [
                                    'imagemanager' => 'vova07\imperavi\bundles\ImageManagerAsset',
                                ],
                                'options' => [
                                    'class' => 'json_field',
                                    'data' => [
                                        'field' => 'actions-text',
                                        'lang' => $lang->code,
                                    ]
                                ]
                            ]);
                        ?>
                    </div>
            <?php
                }
            ?>
                </div>
            </div>

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
