<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\Pjax;
use yii\helpers\ArrayHelper;
use kartik\switchinput\SwitchInput;
use kartik\alert\AlertBlock;

/* @var $this yii\web\View */
/* @var $model backend\models\Promocodes */
/* @var $form yii\widgets\ActiveForm */
?>

<?php Pjax::begin(); ?>

<div class="promocodes-form">

    <?= AlertBlock::widget([
            'type' => 'growl',
            'useSessionFlash' => true,
            'delay' => 1,
        ]);
    ?>

    <?php $form = ActiveForm::begin(); ?>
    
        <?= $form
                ->field($model, 'publish')
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
                ->field($model, 'code')
                ->textInput([
                    'maxlength' => true
                ])
        ?>
        
        <?= $form
                ->field($model, 'type')
                ->radioList(Yii::$app->params['store_types'],
                    [
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
                    ]
                )
                ->label(Yii::t('back', 'Тип магазина'), [
                    'style' => 'display: block'
                ])
        ?>

        <?= $form
                ->field($model, 'description')
                ->textInput([
                    'maxlength' => true
                ])
        ?>
        
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