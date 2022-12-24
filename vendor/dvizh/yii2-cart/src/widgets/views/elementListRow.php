<?php
use yii\helpers\Html;
use yii\helpers\Url;
use dvizh\cart\widgets\ChangeCount;
use dvizh\cart\widgets\DeleteButton;
use dvizh\cart\widgets\ElementPrice;
use dvizh\cart\widgets\ElementCost;

if ($options && !empty($allOptions)) {
	$productOptions = '';
	foreach ($options as $optionId => $valueId)
	{
		if ($optionId == 1){
			if ($optionData = $allOptions[$optionId]) {
				$optionName = $optionData['name'];
				$optionValue = $valueId == 1 ? '' : $optionData['variants'][$valueId];
				// $productOptions .= Html::tag('div', Html::tag('strong', Yii::t('front', $optionName)) . ': ' . Html::tag('span', $optionValue, [
					// 'class' => 'cart-product-variant'
				// ]));
			}
		}
	}
	// echo Html::tag('div', $productOptions, [
		// 'class' => 'dvizh-cart-show-options'
	// ]);
}

?>

<?php
    if (Yii::$app->devicedetect->isMobile()) {
?>
        <div class="cart-product" data-product-id="<?= $model->item_id ?>" data-currency="<?= $currency ?>" data-id="<?= $model->comment ?>" data-name="<?= $name ?>" data-price="<?= round($model->price) ?>">
            <div class="row">
                <div class="col-auto pr-0">
                    <a href="<?= $url ?>" class="d-block border border-gray-400 text-center" style="
                        width: 100px; 
                        height: 100px;
                        background: url('<?= $image ?>') center center / contain no-repeat;
                    ">
                    </a>
                </div>
                <div class="col">
                    <div class="float-right">
                        <?= DeleteButton::widget([
                                'model' => $model,
                                'deleteElementUrl' => Url::to([$controllerActions['delete']]),
                                'lineSelector' => 'list-group-item',
                                'cssClass' => 'delete cart-delete',
                                'text' => '<img src="/images/cart_delete.svg" style="width:16px">',
                            ])
                        ?>
                    </div>
                    <p class="font-weight-bold">
                        <?= $name ?> <?= $optionValue ?>
                    </p>
                    
                <?php
                    if ($model->item_id == Yii::$app->params['gift']['product_id']) {
                ?>
                        <p class="text-danger"><?= Yii::t('front', 'Подарок') ?></p>
                <?php
                    }
                ?>
                    
                <?php 
                    if (!empty($otherFields)) {
                        foreach ($otherFields as $fieldName => $field) {
                            if (isset($product->$field)){
                                echo Html::tag('p', $fieldName . ': ' . Html::tag('strong', $product->$field));
                            }
                        }
                    }
                ?>
                </div>
            </div>
            <div class="row justify-content-between align-items-center m-0">
                <div class="col-auto">
                    <?= ElementPrice::widget([
                            'model' => $model,
                            'currency' => $currency,
                            'htmlTag' => 'h4',
                            'cssClass' => 'font-weight-normal text-nowrap mb-0 d-inline text-right',
                        ]);
                    ?>
                </div>
                <div class="col-auto">
                    <?= ChangeCount::widget([
                            'model' => $model,
                            'showArrows' => $showCountArrows,
                            'actionUpdateUrl' => Url::to([$controllerActions['update']]),
                        ]);
                    ?>
                </div>
                <div class="col-auto">
                    <?= ElementCosl::widget([
                            'model' => $model,
                            'currency' => $currency,
                            'htmlTag' => 'h4',
                            'cssClass' => 'font-weight-normal text-nowrap mb-0 d-inline text-right',
                        ]);
                    ?>
                </div>
            </div>
        </div>
<?php
    } else {
?>
        <div class="cart-product" data-product-id="<?= $model->item_id ?>" data-currency="<?= $currency ?>" data-id="<?= $model->comment ?>" data-name="<?= $name ?>" data-price="<?= round($model->price) ?>">
            <div class="row justify-content-between">
                <div class="col">
                    <div class="row">
                        <div class="col-auto">
                            <a href="<?= $url ?>" class="d-block border border-gray-400 text-center" style="
                                width: 150px; 
                                height: 150px;
                                background: url('<?= $image ?>') center center / contain no-repeat;
                            ">
                            </a>
                        </div>
                        <div class="col">
                            <div class="row h-100">
                                <div class="col-12 align-self-start">
                                    <p class="font-weight-bold mt-1">
                                        <?= $name ?> <?= $optionValue ?>
                                    </p>
                                    
                                <?php
                                    if ($model->item_id == Yii::$app->params['gift']['product_id']) {
                                ?>
                                        <p class="text-danger"><?= Yii::t('front', 'Подарок') ?></p>
                                <?php
                                    }
                                ?>
                                    
                                    <?php 
                                        if (!empty($otherFields)) {
                                            foreach ($otherFields as $fieldName => $field) {
                                                if (isset($product->$field)){
                                                    echo Html::tag('p', $fieldName . ': ' . Html::tag('strong', $product->$field));
                                                }
                                            }
                                        }
                                    ?>
                                </div>
                                <div class="col-12 align-self-end">
                                    <?= ChangeCount::widget([
                                            'model' => $model,
                                            'showArrows' => $showCountArrows,
                                            'actionUpdateUrl' => Url::to([$controllerActions['update']]),
                                        ]);
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-auto">
                    <div class="row h-100">
                        <div class="col-12 align-self-start text-right mt-1">
                            <?= DeleteButton::widget([
                                    'model' => $model,
                                    'deleteElementUrl' => Url::to([$controllerActions['delete']]),
                                    'lineSelector' => 'list-group-item',
                                    'cssClass' => 'delete cart-delete',
                                    'text' => '<img src="/images/cart_delete.svg" style="width:16px">',
                                ])
                            ?>
                        </div>
                        <div class="col-12 align-self-end text-right mb-0_5">
                            <?= ElementPrice::widget([
                                    'model' => $model,
                                    'currency' => $currency,
                                    'htmlTag' => 'h4',
                                    'cssClass' => 'font-weight-normal text-nowrap mb-0 d-inline text-right',
                                ]);
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
<?php
    }
?>

<hr class="my-1_5">