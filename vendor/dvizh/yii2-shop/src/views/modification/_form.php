<?php
use yii\helpers\Html;
use yii\widgets\Pjax;
use yii\widgets\ActiveForm;
use dvizh\shop\models\PriceType;
use dvizh\shop\models\Price;
// use kartik\switchinput\SwitchInput;
use kartik\alert\AlertBlock;

$priceTypes = PriceType::find()->all();
$priceModel = new Price;

if (!$model->id){
    $model->available = 1;
}

?>

<?php Pjax::begin(); ?>


<div class="product-add-modification-form">

    <?= AlertBlock::widget([
            'type' => 'growl',
            'useSessionFlash' => true,
            'delay' => 1,
        ]);
    ?>

    <?php $form = ActiveForm::begin([
            'options' => [
                'enctype' => 'multipart/form-data',
                'onsubmit' => 'window.parent.showLoader()',
            ]
        ]);
    ?>
    
        <?php
            // echo $form
                // ->field($model, 'available')
                // ->widget(SwitchInput::classname(), [
                    // 'pluginOptions' => [
                        // 'onText' => Yii::t('back', 'Да'),
                        // 'offText' => Yii::t('back', 'Нет'),
                        // 'onColor' => 'success',
                        // 'offColor' => 'danger',
                    // ],
                // ]);
            echo $form
                ->field($model, 'available')
                ->textInput([
                    'type' => 'hidden'
                ])
                ->label(false)
        ?>

        <?php
            // echo $form
                // ->field($model, 'lang')
                // ->radioList(
                    // Yii::$app->getModule('languages')->languages, 
                    // [
                        // 'class' => 'btn-group',
                        // 'data-toggle' => 'buttons',
                        // 'unselect' => null,
                        // 'item' => function ($index, $label, $name, $checked, $value) {
                            // return '<label class="btn btn-primary text-white '. ($checked ? ' active' : '') . '">' .
                                        // Html::radio($name, $checked, [
                                            // 'value' => $value,
                                            // 'class' => 'btn-switch'
                                        // ]) . $label . 
                                    // '</label>';
                        // },
                    // ]
                // )
                // ->label(Yii::t('back', 'Язык'), [
                    // 'style' => 'display: block'
                // ]);
            echo $form
                    ->field($model, 'lang')
                    ->textInput()
                    ->label(false);
        ?>

        <?php
            // echo $form
                // ->field($model, 'store_type')
                // ->radioList(
                    // [
                        // 0 => 'не МЛМ',
                        // 1 => 'МЛМ',
                        // 2 => 'Скидка',
                    // ],
                    // [
                        // 'class' => 'btn-group',
                        // 'data-toggle' => 'buttons',
                        // 'unselect' => null,
                        // 'item' => function ($index, $label, $name, $checked, $value) {
                            // return '<label class="btn btn-primary text-white '. ($checked ? ' active' : '') . '">' .
                                        // Html::radio($name, $checked, [
                                            // 'value' => $value,
                                            // 'class' => 'btn-switch'
                                        // ]) . $label . 
                                    // '</label>';
                        // },
                    // ]
                // )
                // ->label(Yii::t('back', 'Тип магазина'), [
                    // 'style' => 'display: block'
                // ]);
            echo $form
                    ->field($model, 'store_type')
                    ->textInput()
                    ->label(false);
        ?>

        <?php if ($filters = $productModel->getOptions()) { ?>
            <div class="filters">
                <?php foreach ($filters as $filter) { ?>
                    <?php if ($variants = $filter->variants) { ?>
                        <div class="form-group required">
                            <label for="filterValue<?= $filter->id; ?>" class="control-label"><?= $filter->name; ?></label>
                            <select id="filterValue<?= $filter->id; ?>" name="filterValue[<?= $filter->id; ?>]" class="form-control">
                                <?php if ($filter->id == 1){?>
                                    <option value="">-</option>
                                <?php }?>
                                <?php foreach ($variants as $variant) { ?>
                                    <option <?php if (in_array($variant->id, $model->filtervariants)) echo ' selected="selected"'; ?>
                                        value="<?= $variant->id; ?>"><?= $variant->value; ?></option>
                                <?php } ?>
                            </select>
                            <div class="help-block"><i><?= $filter->description; ?></i></div>
                        </div>
                    <?php } ?>
                <?php } ?>
            </div>
        <?php } else { ?>
            <p>Значения задаются в <?= Html::a('фильтрах', ['/filter/filter/index'], ['target' => '_blank']); ?>. В
                настоящий момент к категории продукта не привязано ни одного фильтра.</p>
        <?php } ?>
        
        
        <?= $form
                ->field($model, 'code')
                ->textInput([
                    'type' => 'hidden'
                ])
                ->label(false)
        ?>
        
        <?= $form
                ->field($model, 'sku')
                ->textInput([
                    'maxlength' => true
                ])
        ?>

        <?= $form
                ->field($model, 'product_id')
                ->textInput([
                    'type' => 'hidden'
                ])
                ->label(false)
        ?>
        
        <?= $form
                ->field($model, 'name')
                ->textInput([
                    'type' => 'hidden'
                ])
                ->label(false)
        ?>
        
        <?= $form
                ->field($model, 'barcode')
                ->textInput([
                    'type' => 'hidden'
                ])
                ->label(false)
        ?>
        
        <?= $form
                ->field($model, 'amount')
                ->textInput([
                    'type' => 'hidden'
                ])
                ->label(false)
        ?>
        
        <?= $form
                ->field($model, 'sort')
                ->textInput([
                    'type' => 'hidden'
                ])
                ->label(false)
        ?>
        
        <div class="row form-group hidden">
            <?php if (isset($priceTypes) && !empty($priceTypes)) { ?>
                <?php $i = 1;
                foreach ($priceTypes as $priceType) { ?>
                    <div class="col-md-3 col-xs-3">
                        <?= $form->field($priceModel, "[{$priceType->id}]price")->label($priceType->name); ?>
                    </div>
                    <?php $i++;
                } ?>
            <?php } ?>
        </div>

        <div class="container row form-group hidden">
            <?= \agapofff\gallery\widgets\Gallery::widget(
                [
                    'model' => $model,
                    'previewSize' => '150x150',
                    'fileInputPluginLoading' => true,
                    'fileInputPluginOptions' => []
                ]
            ); ?>
        </div>

        <br>
        <div class="form-group text-center">
            <?= Html::submitButton(Html::tag('span', '', [
                'class' => 'glyphicon glyphicon-floppy-saved'
            ]) . '&nbsp;' . Yii::t('back', 'Сохранить'), [
                'class' => 'btn btn-success btn-lg'
            ]) ?>
        </div>

    <?php ActiveForm::end(); ?>

</div>

<?php Pjax::end() ?>

<?php
    $this->registerJS("
        $('#filterValue3').change(function(){
            var lang = $(this).find('option:selected').text();
            $('#modification-lang').val(lang);
        });
        var stores = JSON.parse('" . json_encode((object)array_flip(Yii::$app->params['store_types']), JSON_UNESCAPED_UNICODE) . "');
        $('#filterValue4').change(function(){
            var storeName = $(this).find('option:selected').text();
            $('#modification-store_type').val(stores[storeName]);
        });
    ",
    \yii\web\View::POS_READY,
    'change_options');
?>
