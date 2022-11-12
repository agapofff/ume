<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\Pjax;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use dvizh\shop\models\Category;
use agapofff\gallery\widgets\Gallery;
use kartik\select2\Select2;
use dvizh\seo\widgets\SeoForm;
use kartik\switchinput\SwitchInput;
use kartik\alert\AlertBlock;
?>

<?php Pjax::begin(); ?>

<div class="category-form">

    <?= AlertBlock::widget([
            'type' => 'growl',
            'useSessionFlash' => true,
            'delay' => 1,
        ]);
    ?>

    <?php $form = ActiveForm::begin([
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

            <br>
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
            <ul class="nav nav-pills nav-justified">
        <?php
            foreach ($languages as $key => $lang){
        ?>
                <li <?php if ($lang->code == Yii::$app->language){?>class="active"<?php } ?>>
                    <a href="#name_<?= $lang->code ?>_tab" aria-controls="name_<?= $lang->code ?>_tab" role="tab" data-toggle="tab"><?= strtoupper($lang->code) ?></a>
                </li>
        <?php
            }
        ?>
            </ul>
            <div class="tab-content">
        <?php
            foreach ($languages as $key => $lang){
        ?>
                <div role="tabpanel" class="tab-pane <?php if ($lang->code == Yii::$app->language){?>active<?php } ?>" id="name_<?= $lang->code ?>_tab" style="padding-left: 0; padding-right: 0;">
                    <?= Html::input(
                            'text',
                            'name_'.$lang->code,
                            json_decode($model->name)->{$lang->code},
                            [
                                'class' => 'form-control json_field',
                                'data' => [
                                    'field' => 'category-name',
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
            
        
        <br>
        <?= $form
                ->field($model, 'slug')
                ->textInput()
        ?>
        
        <?= $form
                ->field($model, 'parent_id')
                ->widget(Select2::classname(), [
                    'data' => Category::buildTextTree(null, 1, [$model->id]),
                    'language' => 'ru',
                    'options' => [
                        'placeholder' => Yii::t('back', 'Выберите категорию')
                    ],
                    'pluginOptions' => [
                        'allowClear' => true
                    ],
                ]);
        ?>
        
        
        <?= $form
                ->field($model, 'sort')
                ->textInput([
                    'type' => 'number',
                    'min' => 0,
                    'max' => 99,
                ])
        ?>
        
        
        <label class="control-label" for="category-sort">Изображение</label>
        <?= Gallery::widget([
                'model' => $model,
                'previewSize' => '300x300',
                'fileInputPluginOptions' => [
                    'showPreview' => false,
                ]
            ]);
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
        <ul class="nav nav-pills nav-justified">
    <?php
        foreach ($languages as $key => $lang){
    ?>
            <li <?php if ($lang->code == Yii::$app->language){?>class="active"<?php } ?>>
                <a href="#text_<?= $lang->code ?>_tab" aria-controls="text_<?= $lang->code ?>_tab" role="tab" data-toggle="tab"><?= strtoupper($lang->code) ?></a>
            </li>
    <?php
        }
    ?>
        </ul>
        <div class="tab-content">
    <?php
        foreach ($languages as $key => $lang){
    ?>
            <div role="tabpanel" class="tab-pane <?php if ($lang->code == Yii::$app->language){?>active<?php } ?>" id="text_<?= $lang->code ?>_tab">
                <?= \yii\imperavi\Widget::widget([
                        'id' => 'text_'.$lang->code,
                        'value' => json_decode($model->text)->{$lang->code},
                        'plugins' => [
                            'fontcolor',
                        ],
                        'options' => [
                            'lang' => Yii::$app->language,
                            'buttonsHide' => [
                                'html',
                                'image',
                                'file',
                            ],
                            'minHeight' => 100,
                            'maxHeight' => 200,
                            // 'imageUpload' => Url::toRoute(['tools/upload-imperavi'])
                        ],
                        'htmlOptions' => [
                            'class' => 'json_field',
                            'data' => [
                                'field' => 'category-text',
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


        


        
        
        <div class="hidden">
        <?= \dvizh\seo\widgets\SeoForm::widget([
                'model' => $model, 
                'form' => $form, 
            ]);
        ?>
        </div>
        
        <?= $form
                ->field($model, 'saveAndExit')
                ->hiddenInput(['class' => 'saveAndExit'])
                ->label(false)
        ?>

        <br>
        <div class="form-group text-center">
            <?= Html::submitButton(Html::tag('span', '', [
                'class' => 'glyphicon glyphicon-floppy-saved'
            ]) . '&nbsp;' . Yii::t('back', 'Сохранить'), [
                'class' => 'btn btn-success btn-lg'
            ]) ?>
            
            <?php if ($model->id){ ?>
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