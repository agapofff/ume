<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Pjax;
use yii\widgets\ActiveForm;
use kartik\alert\AlertBlock;
use kartik\switchinput\SwitchInput;

/* @var $this yii\web\View */
/* @var $model backend\models\Pages */
/* @var $form yii\widgets\ActiveForm */
?>

<?php Pjax::begin(); ?>

<div class="pages-form">

    <?= AlertBlock::widget([
            'type' => 'growl',
            'useSessionFlash' => true,
            'delay' => 1,
        ]);
    ?>

    <?php $form = ActiveForm::begin(); ?>
    
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
                ->field($model, 'name', [
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
            <div role="tabpanel" class="tab-pane <?php if ($lang->code == Yii::$app->language) {?>active<?php } ?>" id="name_<?= $lang->code ?>_tab" style="padding-left: 0; padding-right: 0;">
                <?= Html::input(
                        'text',
                        'name_'.$lang->code,
                        json_decode($model->name)->{$lang->code},
                        [
                            'id' => 'pages_name_'.$lang->code,
                            'class' => 'form-control json_field',
                            'data' => [
                                'field' => 'pages-name',
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

        <?= $form
                ->field($model, 'slug')
                ->textInput([
                    'maxlength' => true
                ])
        ?>

        <br>
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
            <div role="tabpanel" class="tab-pane <?php if ($lang->code == Yii::$app->language) {?>active<?php } ?>" id="text_<?= $lang->code ?>_tab">
                <?= \vova07\imperavi\Widget::widget([
                        'id' => 'pages_text_'.$lang->code,
                        'name' => 'pages_text_'.$lang->code,
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
                                'field' => 'pages-text',
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