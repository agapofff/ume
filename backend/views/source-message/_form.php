<?php

use yii\helpers\Html;
use yii\widgets\Pjax;
use yii\widgets\ActiveForm;
use kartik\alert\AlertBlock;

use kartik\datecontrol\Module;
use kartik\datecontrol\DateControl;

/* @var $this yii\web\View */
/* @var $model backend\models\SourceMessage */
/* @var $form yii\widgets\ActiveForm */
?>

<?php Pjax::begin(); ?>

<div class="source-message-form">

    <?= AlertBlock::widget([
            'type' => 'growl',
            'useSessionFlash' => true,
            'delay' => 1,
        ]);
    ?>

    <?php $form = ActiveForm::begin(); ?>

        <?= $form
                ->field($model, 'category')
                ->dropDownList([
                    'front' => 'front',
                    'back' => 'back',
                    // 'app' => 'app',
                ])
                ->label('Выберите категорию');
        ?>

        <?= $form
                ->field($model, 'message')
                ->textArea([
                    'maxlength' => true,
                    'rows' => 5
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