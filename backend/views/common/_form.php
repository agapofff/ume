<?php

use yii\helpers\Html;
use yii\widgets\Pjax;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\alert\AlertBlock;
use kartik\datecontrol\Module;
use kartik\datecontrol\DateControl;
use alexantr\colorpicker\ColorPicker;

/* @var $this yii\web\View */
/* @var $model backend\models\Common */
/* @var $form yii\widgets\ActiveForm */
?>

<?php Pjax::begin(); ?>

<div class="common-form">

    <?= AlertBlock::widget([
            'type' => 'growl',
            'useSessionFlash' => true,
            'delay' => 1,
        ]);
    ?>

    <?php $form = ActiveForm::begin(); ?>

        <?= $form
                ->field($model, 'title_ru')
                ->textarea([
                    'rows' => 3,
                    'cols' => 5,
                    'maxlength' => true,
                ])
        ?>

        <?= $form
                ->field($model, 'title_vi')
                ->textarea([
                    'rows' => 3,
                    'cols' => 5,
                    'maxlength' => true,
                ])
        ?>
        
        <?= $form
                ->field($model, 'datetime_ru')
                ->widget(DateControl::classname(), [
                    'type' => 'datetime',
                    'displayFormat' => 'php:d F Y, H:i',
                    'saveFormat' => 'php:Y-m-d H:i:s',
                    'saveTimezone' => 'Europe/Moscow',
                    'displayTimezone' => 'Europe/Moscow',
                    'widgetOptions' => [
                        'pluginOptions' => [
                            'autoclose' => true,
                            'format' => 'php:d F Y, H:i',
                            'minuteStep' => 10,
                        ],
                        'layout' => '{picker}{input}{remove}',
                        'options' => [
                            'placeholder' => Yii::t('back', 'Выберите дату и время')
                        ],
                    ],
                    'language' => 'ru',
                ]);
        ?>
        
        <?= $form
                ->field($model, 'datetime_vi')
                ->widget(DateControl::classname(), [
                    'type' => 'datetime',
                    'displayFormat' => 'php:d F Y, H:i',
                    'saveFormat' => 'php:Y-m-d H:i:s',
                    'saveTimezone' => 'Europe/Moscow',
                    'displayTimezone' => 'Europe/Moscow',
                    'widgetOptions' => [
                        'pluginOptions' => [
                            'autoclose' => true,
                            'format' => 'php:d F Y, H:i',
                            'minuteStep' => 10,
                        ],
                        'layout' => '{picker}{input}{remove}',
                        'options' => [
                            'placeholder' => Yii::t('back', 'Выберите дату и время')
                        ],
                    ],
                    'language' => 'ru',
                ]);
        ?>
        
        <hr>
        
        <?= $form
                ->field($model, 'imageFile')
                ->fileInput([
                    'class' => 'image-input'
                ])
        ?>
        
        <div id="common-imagefile-embed" class="form-group">
            <?php if ($model->image) { ?>
                <img src="<?= $model->image ?>" class="img-responsive">
            <?php } ?>
        </div>
        
        <?= $form
                ->field($model, 'image')
                ->hiddenInput(['maxlength' => true])
                ->label(false)
        ?>
        
        <hr>
        
        <?= $form
                ->field($model, 'backgroundFile')
                ->fileInput([
                    'class' => 'image-input'
                ])
        ?>
        
        <div id="common-backgroundfile-embed" class="form-group">
            <?php if ($model->background) { ?>
                <img src="<?= $model->background ?>" class="img-responsive">
            <?php } ?>
        </div>
        
        <?= $form
                ->field($model, 'background')
                ->hiddenInput(['maxlength' => true])
                ->label(false)
        ?>
        
        <hr>
        
        <?= $form
                ->field($model, 'active_color')
                ->widget(ColorPicker::classname())
        ?>
        
        
        
        <?= $form
                ->field($model, 'meta_title_ru')
                ->hiddenInput(['maxlength' => true])
                ->label(false)
        ?>

        <?= $form
                ->field($model, 'meta_title_vi')
                ->hiddenInput(['maxlength' => true])
                ->label(false)
        ?>
        
        <?= $form
                ->field($model, 'meta_description_ru')
                ->hiddenInput(['maxlength' => true])
                ->label(false)
        ?>

        <?= $form
                ->field($model, 'meta_description_vi')
                ->hiddenInput(['maxlength' => true])
                ->label(false)
        ?>

        <?= $form
                ->field($model, 'created_at')
                ->hiddenInput()
                ->label(false)
        ?>

        <?= $form
                ->field($model, 'updated_at')
                ->hiddenInput()
                ->label(false)
        ?>

        <br>
        <div class="form-group text-center">
            <?= Html::submitButton(Html::tag('span', '', [
                'class' => 'glyphicon glyphicon-ok'
            ]) . '&nbsp;' . Yii::t('back', 'Сохранить'), [
                'class' => 'btn btn-success btn-lg'
            ]) ?>
        </div>

    <?php ActiveForm::end(); ?>

</div>

<?php Pjax::end(); ?>