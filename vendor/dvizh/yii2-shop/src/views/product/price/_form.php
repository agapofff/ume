<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use dvizh\shop\models\PriceType;

/* @var $this yii\web\View */
/* @var $model common\models\ProductOption */
/* @var $form yii\widgets\ActiveForm */

?>
<div class="modal fade" id="add-price-modal" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title">
                    <?= Yii::t('back', 'Добавить товар') ?>
                </h4>
            </div>
            <div class="modal-body">
                <div class="product-add-price-form" data-role="price-form">

                    <?php 
                        $form = ActiveForm::begin([
                            'action' => Url::toRoute(['price/create'])
                        ]);
                    ?>

                        <?= $form
                                ->field($model, 'available')
                                    ->textInput([
                                        'type' => 'hidden', 
                                        'value' => 'yes'
                                    ])
                                    ->label(false) 
                        ?>
                        
                        <?= $form
                                ->field($model, 'type_id')
                                    ->textInput([
                                        'type' => 'hidden', 
                                        'value' => 1
                                    ])
                                    ->label(false) 
                        ?>
                        
                        <?= $form
                                ->field($model, 'item_id')
                                    ->textInput([
                                        'type' => 'hidden', 
                                        'value' => $productModel->id
                                    ])
                                    ->label(false) 
                        ?>
                        
                        <?= $form
                                ->field($model, 'name')
                                ->dropdownList(ArrayHelper::map($stores, 'store_id', 'name'));
                        ?>
                        
                        <?= $form
                                ->field($model, 'code')
                                ->textInput() 
                        ?>

                        <?= $form
                                ->field($model, 'price')
                                ->textInput() 
                        ?>
                    
                        <?= $form
                                ->field($model, 'price_old')
                                ->textInput() 
                        ?>

                        <?= $form
                                ->field($model, 'amount')
                                ->textInput([
                                    'type' => 'number',
                                    'value' => 0
                                ]) 
                        ?>
                        
                        
                        <div class="form-group text-center">
                            <?= Html::submitButton($model->isNewRecord ? 'Создать' : 'Редактировать', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
                        </div>

                    <?php ActiveForm::end(); ?>

                </div>
            </div>
        </div>
    </div>
</div>