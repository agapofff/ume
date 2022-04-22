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

?>

<?php Pjax::begin(); ?>

    <div class="news-form">
    
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
                    ->field($model, 'date_published')
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
                <ul class="nav nav-pills nav-justified">
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
                                    'id' => 'news_name_'.$lang->code,
                                    'class' => 'form-control json_field',
                                    'data' => [
                                        'field' => 'news-name',
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
            

            <?= $form
                    ->field($model, 'category_id')
                    ->dropDownList(ArrayHelper::map($categories, 'id', function ($category) {
                        return json_decode($category['name'])->{Yii::$app->language};
                    }))
            ?>
            
            <div class="form-group">
                <?= Gallery::widget([
                        'model' => $model,
                        'label' => Yii::t('back', 'Главное изображение'),
                        'previewSize' => '300x300',
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
                <ul class="nav nav-pills nav-justified">
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
                                    'id' => 'news_description_'.$lang->code,
                                    'class' => 'form-control json_field',
                                    'data' => [
                                        'field' => 'news-description',
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
                <ul class="nav nav-pills nav-justified">
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
                                'id' => 'news_text_'.$lang->code,
                                'name' => 'news_text_'.$lang->code,
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
                                ],
                                'plugins' => [
                                    'imagemanager' => 'vova07\imperavi\bundles\ImageManagerAsset',
                                ],
                                'options' => [
                                    'class' => 'json_field',
                                    'data' => [
                                        'field' => 'news-text',
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
                    ->field($model, 'publisher')
                    ->hiddenInput()
                    ->label(false)
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

<?php Pjax::end() ?>
