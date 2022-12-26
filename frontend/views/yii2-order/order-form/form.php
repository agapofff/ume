<?php
    use yii\helpers\Html;
    use yii\helpers\Url;
    use yii\widgets\ActiveForm;
    use yii\web\View;
    use kartik\depdrop\DepDrop;
    use kartik\select2\Select2;
    use yii\web\JsExpression;
    use yii\helpers\ArrayHelper;
    use dvizh\cart\widgets\CartInformer;

    if (Yii::$app->session->hasFlash('orderError')){
        $errors = Yii::$app->session->getFlash('orderError');
        $orderModel->addErrors(unserialize($errors));
    }

?>

<h3 class="font-weight-light text-uppercase mb-2">
    <?= Yii::t('front', 'Оформление заказа') ?>
</h3>

<div id="order" class="dvizh_order_form">

    <?php
        $form = ActiveForm::begin([
            'action' => Url::toRoute(['/order/order/create']),
            'validateOnBlur' => false,
            'validateOnType' => false,
            'validateOnChange' => false,
            // 'enableClientValidation' => false,
            'options' => [
                'id' => 'order-form',
            ]
        ]);
    ?>
        
        <?= Html::hiddenInput(Yii::$app->request->csrfParam, Yii::$app->request->csrfToken) ?>

        <p class="h4 mb-2">
            <?= Yii::t('front', 'Контактная информация') ?>
        </p>
            
        <div class="row">
            <div class="col-sm-10 col-md-9 col-lg-8 col-xl-7">
                    
                <?= $form
                        ->field($orderModel, 'client_name', [
                            'inputOptions' => [
                                'class' => 'form-control form-control-lg',
                                'autocomplete' => rand(),
                                'placeholder' => ' ',
                            ],
                            'options' => [
                                'class' => 'form-group row align-items-center mb-2',
                            ],
                            'template' => '{label}<div class="col-md-9">{input}</div>{hint}{error}',
                            'labelOptions' => [
                                'class' => 'col-md-3 mb-md-0 font-weight-bold'
                            ]
                        ])
                ?>
                
                <?= $form
                        ->field($orderModel, 'phone', [
                            'inputOptions' => [
                                'class' => 'form-control form-control-lg',
                                'autocomplete' => rand(),
                                'placeholder' => ' ',
                            ],
                            'options' => [
                                'class' => 'form-group row align-items-center mb-2',
                            ],
                            'template' => '{label}<div class="col-md-9">{input}</div>{hint}{error}',
                            'labelOptions' => [
                                'class' => 'col-md-3 mb-md-0 font-weight-bold'
                            ]
                        ])
                ?>

                <?= $form
                        ->field($orderModel, 'email', [
                            'inputOptions' => [
                                'class' => 'form-control form-control-lg',
                                'autocomplete' => rand(),
                                'placeholder' => ' ',
                            ],
                            'options' => [
                                'class' => 'form-group row align-items-center mb-2',
                            ],
                            'template' => '{label}<div class="col-md-9">{input}</div>{hint}{error}',
                            'labelOptions' => [
                                'class' => 'col-md-3 mb-md-0 font-weight-bold'
                            ]
                        ])
                ?>
                
                <div id="block-country" class="form-group row align-items-center mb-2 required" data-select2>
                    <label class="control-label col-md-3 mb-md-0 font-weight-bold" for="country">
                        <?= Yii::t('front', 'Страна') ?>
                    </label>
                    <div class="col-md-9">
                        <?= Select2::widget([
                                'id' => 'country',
                                'name' => 'country',
                                'value' => $fieldsDefaultValues['country_id'],
                                'bsVersion' => '4.x',
                                'language' => Yii::$app->language,
                                'theme' => Select2::THEME_BOOTSTRAP,
                                'data' => $countriesList,
                                'size' => 'lg',
                                'disabled' => true,
                                'options' => [
                                    'class' => 'form-control form-control-lg',
                                    'placeholder' => ' ',
                                    'autocomplete' => rand(),
                                    'options' => $countriesOptions,
                                    'size' => 'lg',
                                ],
                                'pluginOptions' => [
                                    'allowClear' => false,
                                    'dropdownParent' => new JsExpression("$('#block-country')"),
                                    // 'minimumInputLength' => 2,
                                    // 'ajax' => [
                                        // 'url' => Url::to('/checkout/get-cities'),
                                        // 'dataType' => 'json',
                                        // 'data' => new JsExpression("function(params){
                                            // return {
                                                // country_id:$('#order-country_id').val(),
                                                // lang:'" . Yii::$app->language . "',
                                                // q:params.term
                                            // };
                                        // }"),
                                    // ],
                                ],
                            ]);
                        ?>
                    </div>
                </div>
                
                <div id="block-city" class="form-group row align-items-center mb-2  required" data-select2>
                    <label class="control-label col-md-3 mb-md-0 font-weight-bold" for="city">
                        <?= Yii::t('front', 'Город') ?>
                    </label>
                    <div class="col-md-9">
                        <?= Select2::widget([
                                'id' => 'city',
                                'name' => 'city',
                                'value' => $fieldsDefaultValues['city_id'],
                                'bsVersion' => '4.x',
                                'language' => Yii::$app->language,
                                'theme' => Select2::THEME_BOOTSTRAP,
                                'data' => $citiesList,
                                'disabled' => true,
                                'options' => [
                                    'class' => 'form-control form-control-lg',
                                    'placeholder' => ' ',
                                    'autocomplete' => rand(),
                                ],
                                'pluginOptions' => [
                                    'allowClear' => false,
                                    'dropdownParent' => new JsExpression("$('#block-city')"),
                                    // 'minimumInputLength' => 0,
                                    'ajax' => [
                                        'url' => Url::to(['/checkout/get-cities']),
                                        'dataType' => 'json',
                                        'data' => new JsExpression("
                                            function(params){
                                                return {
                                                    country_id:$('#country').val(),
                                                    lang:'" . Yii::$app->language . "',
                                                    q:params.term
                                                };
                                            }
                                        "),
                                    ],
                                    'cache' => true,
                                ],
                            ]);
                        ?>
                    </div>
                </div>
                        
                
                <p class="h4 mb-2">
                    <?= Yii::t('front', 'Способ доставки') ?>
                </p>
                
                <?= $form
                        ->field($orderModel, 'shipping_type_id')
                        // ->textInput()
                        ->hiddenInput()
                        ->label(false)
                ?>
            
                <div id="shipping_types_list" class="form-group" role="tablist">
                    <div class="row">
                    <?php
                        foreach ($shippingTypesList as $key => $sht) {
                    ?>
                            <div class="col-12 col-md-6">
                                <div class="custom-control custom-radio shipping_type_switcher border pt-1 pl-4 rounded-lg <?php if ($orderModel->shipping_type_id == $sht->id) { ?>border-primary<?php } ?>">
                                    <input 
                                        type="radio" 
                                        id="shipping-type-tab-link-<?= $sht->id ?>" 
                                        name="shipping_type_switcher" 
                                        value="<?= $sht->id ?>" 
                                        class="custom-control-input" 
                                        data-target="#shipping-type-tab-<?= $sht->id ?>" 
                                        <?php if ($orderModel->shipping_type_id == $sht->id) { ?>
                                            checked
                                        <?php } ?>
                                    >
                                    <label class="custom-control-label d-block pb-1" for="shipping-type-tab-link-<?= $sht->id ?>">
                                        <p class="font-weight-bold mb-0_5">
                                            <?= Yii::t('front', $sht->name) ?>
                                        </p>
                                        <p class="h5 font-weight-light mt-0_5">
                                            <?= Yii::t('front', 'от') ?> <?= Yii::$app->formatter->asCurrency($sht->cost, Yii::$app->params['currency']) ?>
                                        </p>
                                    </label>
                                </div>
                            </div>
                    <?php
                        }
                    ?>
                    </div>
                </div>
            
                <div id="shipping_options_section" class="tab-content m-0">
                
            <?php
                foreach ($shippingTypesList as $key => $sht) {
            ?>  
                    <div id="shipping-type-tab-<?= $sht->id ?>" class="tab-pane mt-2 mt-md-3 <?php if ($orderModel->shipping_type_id == $sht->id) { ?>active<?php } ?>">
                    
                <?php 
                    if ($sht->id == 1) {
// print_r($deliveryList); 
                ?>
                        <div id="block-delivery" class="form-group position-relative d-none">
                            <label class="control-label" for="pickup">
                                <?= Yii::t('front', 'Способ доставки') ?>
                            </label>
                            <?= Select2::widget([
                                    'id' => 'delivery',
                                    'name' => 'delivery',
                                    'value' => (empty($deliveryList) ? null : $fieldsDefaultValues['delivery_id']),
                                    'bsVersion' => '4.x',
                                    'language' => Yii::$app->language,
                                    'theme' => Select2::THEME_BOOTSTRAP,
                                    'data' => $deliveryList,
                                    'options' => [
                                        'class' => 'form-control mb-0 px-0',
                                        'placeholder' => Yii::t('front', 'Выберите способ доставки'),
                                        'autocomplete' => rand(),
                                    ],
                                    'hideSearch' => true,
                                    'pluginOptions' => [
                                        'allowClear' => false,
                                        'dropdownParent' => new JsExpression("$('#block-delivery')"),
                                        // 'minimumInputLength' => 2,
                                        'ajax' => [
                                            'url' => Url::to(['/checkout/get-delivery']),
                                            'dataType' => 'json',
                                            'data' => new JsExpression("function(params){
                                                return {
                                                    country_id:$('#country').val(),
                                                    city_id:$('#city').val(),
                                                    type:'delivery',
                                                    q:params.term
                                                };
                                            }"),
                                            'success' => new JsExpression("function(response){
                                                console.log(response);
                                            }"),
                                        ],
                                        'selectOnClose' => true,
                                        'cache' => true,
                                    ],
                                ]);
                            ?>
                        </div>			
                <?php
                    }
                ?>
                    
                <?php
                    if ($sht->id == 2){
// print_r($pickupsList); 
                ?>
                        <div id="block-pickup" class="form-group position-relative d-none">
                            <label class="control-label" for="pickup">
                                <?= Yii::t('front', 'Пункт самовывоза') ?>
                            </label>
                            <?= Select2::widget([
                                    'id' => 'pickups',
                                    'name' => 'pickups',
                                    'value' => (empty($pickupsList) ? null : $fieldsDefaultValues['delivery_id']),
                                    'bsVersion' => '4.x',
                                    'language' => Yii::$app->language,
                                    'theme' => Select2::THEME_BOOTSTRAP,
                                    'data' => $pickupsList,
                                    'options' => [
                                        'class' => 'form-control mb-0 px-0',
                                        'placeholder' => Yii::t('front', 'Выберите пункт самовывоза'),
                                        'autocomplete' => rand(),
                                    ],
                                    'hideSearch' => true,
                                    'pluginOptions' => [
                                        'allowClear' => false,
                                        'dropdownParent' => new JsExpression("$('#block-pickup')"),
                                        // 'minimumInputLength' => 2,
                                        'minimumResultsForSearch' => 'Infinity',
                                        // 'ajax' => [
                                            // 'url' => Url::to(['/checkout/get-delivery']),
                                            // 'dataType' => 'json',
                                            // 'data' => new JsExpression("function(params){
                                                // return {
                                                    // country_id:$('#country').val(),
                                                    // city_id:$('#city').val(),
                                                    // type:'pickups',
                                                    // q:params.term
                                                // };
                                            // }"),
                                            // 'success' => new JsExpression("function(response){
                                                // console.log(response);
                                            // }"),
                                        // ],
                                        'selectOnClose' => true,
                                        'cache' => true,
                                    ],
                                ]);
                            ?>
                        </div>
                        
                        <h6 class="mt-2 mb-1_5">
                            <?= Yii::t('front', 'Выбрать адрес самовывоза') ?>
                        </h6>
                        <div id="pickupsList" class="row"></div>
                <?php
                    }
                ?>
                    
                    </div>
            <?php
                }
            ?>
                
                </div>
                
                <div id="address" class="row justify-content-center mt-1 mt-md-2">
                    <div class="col-12">
                        <?= $form
                                ->field($orderModel, 'address', [
                                    'inputOptions' => [
                                        'class' => 'form-control form-control-lg',
                                        'autocomplete' => rand(),
                                        'placeholder' => ' ',
                                    ],
                                    'options' => [
                                        'class' => 'form-group row align-items-center mb-2',
                                    ],
                                    'template' => '{label}<div class="col-md-9">{input}</div>{hint}{error}',
                                    'labelOptions' => [
                                        'class' => 'col-md-3 mb-md-0 font-weight-bold'
                                    ]
                                ])
                        ?>
                    </div>
                </div>
                
                <div class="position-relative">
            <?php
                if ($fields) {
                    foreach ($fields as $field) {
            ?>
                        <div id="<?= $field->name ?>" class="row justify-content-center d-none- <?= $field->required == 'yes' ? 'required' : '' ?>"
                        <?php
                            if ($field->name != 'postcode') {
                        ?>
                                style="
                                    position: absolute;
                                    top: 0;
                                    left: 0;
                                    right: 0;
                                    opacity: 0;
                                    z-index: -1;
                                "
                        <?php 
                            }
                        ?>
                        >
                            <div class="col-12 order-custom-field-<?= $field->id ?>">
                            <?php
                                if ($widget = $field->type->widget) {
                                    echo $widget::widget([
                                        'form' => $form,
                                        'fieldModel' => $field,
                                        'defaultValue' => $fieldsDefaultValues[$field->name],
                                    ]);
                                } else {
                                    echo $form
                                            ->field($fieldValueModel, 'value['.$field->id.']')
                                            ->label($field->name)
                                            ->textInput([
                                                'required' => ($field->required == 'yes')
                                            ]);
                                }
                            ?>
                            </div>
                        </div>
            <?php
                    }
                }
            ?>
                </div>
                


        <?php if ($paymentTypes) { ?>
                <div id="block-payment_type_id" class="form-group mt-2 mb-3 position-relative required d-none" data-select2>
                    <p class="control-label text-uppercase font-weight-bold mb-1" for="payment_type_id">
                        <?= Yii::t('front', 'Оплата') ?>
                    </p>
                    <div class="pointer-events-none opacity-75">
                        <?= Select2::widget([
                                'id' => 'payment_type_id',
                                'name' => 'Order[payment_type_id]',
                                'value' => ($fieldsDefaultValues['payment_type_id'] ?: 2),
                                'bsVersion' => '4.x',
                                'language' => Yii::$app->language,
                                'theme' => Select2::THEME_BOOTSTRAP,
                                'data' => $paymentTypes,
                                'options' => [
                                    'class' => 'form-control mb-0 px-0',
                                    'placeholder' => ' ',
                                    'autocomplete' => rand(),
                                ],
                                'pluginOptions' => [
                                    'allowClear' => false,
                                    'dropdownParent' => new JsExpression("$('#block-payment_type_id')"),
                                ],
                            ]);
                        ?>
                    </div>
                </div>
        <?php } ?>
                
                
                <div id="order_comment" class="row justify-content-center mt-2">
                    <div class="col-12">
                        <?= $form
                                ->field($orderModel, 'comment', [
                                    'inputOptions' => [
                                        'class' => 'form-control form-control-lg',
                                        'autocomplete' => rand(),
                                        // 'placeholder' => ' ',
                                        'rows' => 2,
                                        'style' => '
                                            resize: none;
                                            margin-top: 4px;
                                            border: 1px solid rgba(0, 0, 0, 0.2);
                                        ',
                                    ],
                                    'options' => [
                                        'class' => 'form-group mb-3 position-relative',
                                    ],
                                    'labelOptions' => [
                                        'class' => 'font-weight-bold'
                                    ],
                                    'template' => '{label}{input}{hint}{error}',
                                ])
                                ->textArea()
                        ?>
                    </div>
                </div>
                
                <div id="order_total" class="mb-3">
                    <p class="h4 mb-2">
                        <?= Yii::t('front', 'Общая стоимость') ?>
                    </p>
                    <div class="row justify-content-between">
                        <div class="col-auto">
                            <p>
                                <?= Yii::t('front', 'Количество товаров') ?>
                            </p>
                        </div>
                        <div class="col-auto">
                            <p>
                                <?= CartInformer::widget([
                                        'htmlTag' => 'strong',
                                        'cssClass' => '',
                                        'text' => '{c}'
                                    ]);
                                ?> <?= Yii::t('front', 'шт.') ?>
                            </p>
                        </div>
                    </div>
                    <div class="row justify-content-between">
                        <div class="col-auto">
                            <p>
                                <?= Yii::t('front', 'Сумма заказа') ?>
                            </p>
                        </div>
                        <div class="col-auto">
                            <?= CartInformer::widget([
                                    'htmlTag' => 'p',
                                    'cssClass' => '',
                                    'text' => '{p}',
                                    'currency' => Yii::$app->params['currency'],
                                ]);
                            ?>
                        </div>
                    </div>
                    <div class="row justify-content-between">
                        <div class="col-auto">
                            <p id="delivery_time"></p>
                        </div>
                        <div class="col-auto">
                            <p>
                                <strong id="delivery_price"></strong>
                            </p> 
                        </div>
                    </div>
                    <div class="row justify-content-between">
                        <div class="col-auto">
                            <p></p>
                        </div>
                        <div class="col-auto">
                            <p>
                                <strong id="delivery_price"></strong>
                            </p> 
                        </div>
                    </div>
                    <hr class="mt-0 mb-1_5">
                    <div class="row justify-content-between">
                        <div class="col-auto">
                            <p class="h4">
                                <?= Yii::t('front', 'Итого') ?>:
                            </p>
                        </div>
                        <div class="col-auto">
                            <p id="total" class="h4">
                                <?= $total ?>
                            </p>
                        </div>
                    </div>
                    
                    <div class="<?= Yii::$app->user->isGuest ? 'form-group mt-2 mb-0 ' : 'd-none' ?>">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="agree" name="agree" <?php if (!Yii::$app->user->isGuest){?>checked="checked"<?php }?>>
                            <label class="custom-control-label" for="agree">
                                <?= Yii::t('front', 'Даю согласие на обработку моих персональных данных.') ?> <?= Html::a(Yii::t('front', 'Подробнее'), [
                                        '/privacy-policy'
                                    ], [
                                        'target' => '_blank',
                                    ]) ?>...
                            </label>
                        </div>
                    </div>
                    
                    <div id="submit" class="row my-3">
                        <div id="order_submit" class="col-12">
                            <?= Html::submitButton(Html::tag('span', Yii::t('front', 'Оплатить'), [
                                    'id' => 'submit-payment-text',
                                    'style' => 'display: none',
                                ]) . Html::tag('span', Yii::t('front', 'Оформить заказ'), [
                                    'id' => 'submit-finish-text'
                                ]), [
                                    'id' => 'order-form-submit-button',
                                    'class' => 'btn btn-secondary rounded-pill py-1 px-2',
                                ])
                            ?>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>

        <?= Html::hiddenInput('lang_id', $lang_id, [
                'id' => 'lang_id'
            ])
        ?>
        
        <?= $form
                ->field($orderModel, 'id')
                ->hiddenInput()
                ->label(false)
        ?>
        
    <?php ActiveForm::end(); ?>
        
</div>

<?php
    $this->registerCssFile('https://cdn.jsdelivr.net/npm/suggestions-jquery@latest/dist/css/suggestions.min.css');
    $this->registerJsFile('https://cdn.jsdelivr.net/npm/suggestions-jquery@latest/dist/js/jquery.suggestions.min.js', [
        'depends' => [
            \yii\web\JqueryAsset::class
        ]
    ]);
?>

<?php // phone mask
    $this->registerJs("
        $.mask.definitions['h'] = '[0-9]';
        
        function setPhoneMask(){
            var mask = $('#country option:selected').attr('data-code') + ' ' + $('#country option:selected').attr('data-phonemask');
            $('#order-phone').mask(mask.replace(/_/g, 'h'), {
                autoclear: false
            });
        }
        
        setPhoneMask();
    ", 
    View::POS_READY);
?>

<?php
    $this->registerJs(
    "
        var dadataServiceUrl = 'https://dadata.ru/api/v2',
            dadataToken = '" . Yii::$app->params['dadataApiKey'] . "';
            
        $('[data-field=\"currency\"]').val('" . Yii::$app->params['currency'] . "');
            
        // переключатель способов доставки
        // $('.shipping_type_switcher').click(function () {
            // $('.shipping_type_switcher').removeClass('border-primary');
            // $(this).addClass('border-primary');
            // $(this).find('input').tab('show');
            // $(this).find('input').removeClass('active').prop('checked', true);
            // $('#order-shipping_type_id').val($(this).find('input').val()).trigger('change');
        // });
        
        $('input[name=\"shipping_type_switcher\"]').click(function () {
            $(this).tab('show');
            $(this).removeClass('active');
            $('.shipping_type_switcher').removeClass('border-primary');
            $(this).parent().addClass('border-primary');
            $('#order-shipping_type_id').val($(this).val()).trigger('change');
        });
        
        $('#country').change(function () {
            $('#order-phone').val('');
            $('#city').val(null).trigger('change');
            $('[data-field=\"country_id\"]').val($('#country').val());
            $('[data-field=\"country_name\"]').val($('#country option:selected').text());
            $('#order-shipping_type_id').trigger('change');
            setPhoneMask();
        });
        
        $('#city').change(function () {
            $('[data-field=\"city_id\"]').val($('#city').val());
            $('[data-field=\"city_name\"]').val($('#city option:selected').text());
            shippingTypeChange(true);
        });
        
        $('#order-shipping_type_id').change(function () {
// console.log('shippingType change');
            shippingTypeChange();
        });

        
        shippingTypeChange = function (isCityChanged = false) {
// console.log('shippingTypeChange = ' + isCityChanged);
            clearDeliveryParams();
            toggleAddress();
            setPaymentOptions();
            
            if ($('#country_id input').val() === '1' && $('#city_name input').val() !== '') {
                daDataInit();
            } else {
                $('#order-address').suggestions().disable();
            }
            
            // if (isCityChanged) {
                $('#delivery, #pickups').empty();
            // }
            
            $('#delivery').val(null);
            $('#pickups').val(null);
            
            $('#pickupsList').html('');
            
            
            // if (!isCityChanged) {
                if ($('#order-shipping_type_id').val() === '1') {
                    var shippingType = 'delivery';
                    // $('#delivery').val($('#delivery option').eq(1).attr('value'));
                } else if ($('#order-shipping_type_id').val() === '2') {
                    var shippingType = 'pickups';
                    // $('#pickups').val($('#pickups option').eq(1).attr('value'));
                }
                
                $.ajax({
                    url: '" . Url::to(['/checkout/get-delivery']) . "',
                    // beforeRequest: function () {
                        // loading();
                    // },
                    data: {
                        country_id: $('#country').val(),
                        city_id: $('#city').val(),
                        // type: shippingType,
                        term: '',
                    },
                    success: function (response) {
// console.log('checking');

                        var data = JSON.parse(response);
// console.log(data);
                        $.each(data, function (dataType, options) {
                            if (dataType == shippingType) {
// console.log(options);
                                $.each(options, function (key, option) {
// console.log(option);
                                    var newOption = new Option(option.text, option.id, false, false);
                                    $('#' + shippingType).append(newOption);
                                });
                            }
                        });

                        if (shippingType == 'pickups') {
                            $('#pickupsList').html('');
                            $.each(data.pickups, function (k, pickup) {
                                var pickupData;
                                $.each(data.details, function (d, detail) {
                                    if (d == pickup.id) {
                                        pickupData = detail;
                                    }
                                });
                                
                                $('#pickupsList').append('<div class=\"col-12 col-md-6\"><div class=\"select-pickup border rounded-lg pt-1 px-1_5 h-100 cursor-pointer ' + (k ? '' : ' border-primary') + '\" data-id=\"' + pickup.id + '\"><div class=\"row h-100\"><div class=\"col-12\"><p class=\"font-weight-bold\">' + pickup.text +'</p></div><div class=\"col-12 align-self-end\"><p><a class=\"btn btn-link show-map text-dark px-0 text-decoration-underline d-flex\" data-toggle=\"lightbox\" href=\"https://maps.google.com/maps?width=100%&height=500&hl=" . Yii::$app->language . "&q=' + pickupData.lat + ',' + pickupData.lon + '&t=&z=16&ie=UTF8&iwloc=B&output=embed\" data-title=\"' + pickupData.delivery_service.name + '\" data-max-height=\"510\">" . Yii::t('front', 'Посмотреть на карте') . "</a></p></div></div></div>');
                            });
                        }
                        $('#' + shippingType).trigger('change');
                    },
                    // complete: function () {
                        // loading(false);
                    // }
                });
            // }
            // $('#delivery').trigger('change');
            // $('#pickups').trigger('change');
        }
        
        $(document).on('click', '.select-pickup', function () {
            $('.select-pickup').removeClass('border-primary');
            $(this).addClass('border-primary');
            $('#pickups').val($(this).data('id')).trigger('change');
        });
        
        $('#delivery').change(function () {
// console.log('deivery chacnge');
            if ($('#delivery').val()) {
                $('[data-field=\"delivery_id\"]').val($('#delivery').val());
                $('[data-field=\"delivery_name\"]').val($('#delivery option:selected').text());
                getDeliveryParams($('#delivery').val());
            }
        });
        
        $('#pickups').change(function () {
// console.log('pickup chacnge');
            if ($('#pickups').val()) {
                $('[data-field=\"delivery_id\"]').val($('#pickups').val());
                $('[data-field=\"delivery_name\"]').val($('#pickups option:selected').text());
                getDeliveryParams($('#pickups').val());
            }
        });
        
        getDeliveryParams = function (shippingId) {
// console.log('shippingId: ' + shippingId);
            $.ajax({
                url: '" . Url::to(['/checkout/get-delivery']) . "',
                method: 'get',
                data: {
                    country_id: $('#country').val(),
                    city_id: $('#city').val(),
                    type: 'details',
                    shipping_id: shippingId
                },
                beforeSend: function () {
                    loading();
                },
                success: function (response) {
					if (response == null) {
						location.reload();
					} else {
						setDeliveryParams(response);
                        setPaymentOptions();
					}
                },
                error: function (response) {
console.log('Ошибка расчёта доставки');
console.log(response);
                    toastr.error('" . Yii::t('front', 'Произошла ошибка! Пожалуйста, попробуйте еще раз чуть позже') . "');
                },
                complete: function () {
                    loading(false);
                }
            });
        }
		
		$(document).on('dvizhCartChanged', function () {
			if ($('#order-shipping_type_id').val() === '1') {
				$('#delivery').trigger('change');
			} else if ($('#order-shipping_type_id').val() === '2') {
				$('#pickups').trigger('change');
			} else {
				location.reload();
			}
		});
		
		setMap = function (lat, lon, name, comment) {
            var map = new ymaps.Map('delivery_image', {
                    center: [lat, lon],
                    zoom: 15
                }, {
                    autoFitToViewport: 'always'
                });
            
            map.balloon.open([lat, lon], {
                contentHeader: name,
                contentBody: comment,
            });
		}
        
        clearDeliveryParams = function () {
            $('#order_total').hide();
            $('#total').text('');
            $('#delivery_price').text(' ');
            $('#delivery_time').text(' ');
            $('#delivery_comment').html('');
            $('#delivery_comment').addClass('d-none');
			$('#delivery_image').empty().hide();
            $('[data-field=\"delivery_cost\"]').val('');
            $('[data-field=\"delivery_comment\"]').val('');
            $('[data-field=\"postcode\"]').val('');
            $('#order-address').val('');
            $('[data-field=\"delivery_id\"]').val('');
            $('[data-field=\"delivery_name\"]').val('');
        }
        
        setDeliveryParams = function (data) {
			var params = JSON.parse(data);
            
			if (params !== null && 'total' in params) {
				$('#total').text(params.total);
				$('#order_total').show();
				$('#delivery_price').text(params.price);
				$('#delivery_time').text($('input[name=\"shipping_type_switcher\"]:checked').siblings('label').find('p').eq(0).text() + ' (' + params.time + ')');
				$('#delivery_comment').html(params.comment);
				$('#delivery_comment').toggleClass('d-none', params.comment === '');
                // if (params.lat && params.lon) {
                    // $('#delivery_image').empty();
                    // ymaps.ready(setMap(params.lat, params.lon, params.delivery_service.name, '<p>' + params.comment + '</p><p>' + params.text + '</p>'));
                    // $('#delivery_image').show();
                // }
				$('[data-field=\"delivery_cost\"]').val(params.cost);
				$('[data-field=\"delivery_comment\"]').val(params.comment);
                
                if ($('[data-field=\"delivery_cost\"]').val() == '') {
                    toastr.error('" . Yii::t('front', 'Доставка выбранным способом невозможна. Выберите другой способ доставки') . "');
                }
			} else {
				location.reload();
			}
        }
        
        toggleAddress = function () {
// console.log($('#country_id input').val());
            $('#address, #postcode')
                .toggleClass('d-none', $('#order-shipping_type_id').val() === '2')
                .toggleClass('required', $('#order-shipping_type_id').val() === '1');
            $('#postcode').toggleClass('d-none', $('#country_id input').val() === '1');
        }
        toggleAddress();
        
        daDataInit = function () {
            $('#order-address').suggestions({
                token: dadataToken,
                type: 'ADDRESS',
                bounds: 'street-house-apartment',
                count: 10,
                hint: false,
                autoSelectFirst: true,
                geoLocation: false,
                language: '" . Yii::$app->language . "',
                constraints: {
                    locations: {
                        country: $('#country_name input').val(),
                        city: $('#city_name input').val().split('(')[0].trim(),
                    }
                },
                // restrict_value: true,
                onSelect: function (suggestion) {
    // console.log(suggestion);
                    if (suggestion.data.house){
                        $('#fieldvalue-value-8').val(suggestion.data.postal_code);
                    } else {
                        $('#fieldvalue-value-8').val('');
                        toastr.error('" . Yii::t('front', 'Введите адрес с точностью до дома') . "');
                    }
                },
                onSelectNothing: function(){
                    $('#fieldvalue-value-8').val('');
                    toastr.error('" . Yii::t('front', 'Введите Ваш адрес') . "');
                },
            });
        }
        daDataInit();

        setPaymentOptions = function () {
            var moscowCourier = parseFloat($('[data-field=\"delivery_id\"]').val()) === 74265;
            $('#payment_type_id').val(moscowCourier ? 2 : 1).trigger('change');
            $('#order-form-submit-button').toggleClass('moscowCourier', moscowCourier);
            $('#submit-finish-text').toggle(moscowCourier);
            $('#submit-payment-text').toggle(!moscowCourier);
        }
        setPaymentOptions();
        
        
        shippingTypeChange();
        $(document).on('renderCart', function () {
            shippingTypeChange();
        });
        

        validateOrderForm = function () {
            var errors = false;
            
            if ($('#order-form').find('.has-error').length > 0) {
                errors = true;
                var message = $('#order-form').find('.has-error').first().find('.help-block').text();
				
                toastr.error(message);
                return false;
            } 
            
            if ($('[data-field=\"delivery_cost\"]').val() == '') {
                toastr.error('" . Yii::t('front', 'Доставка выбранным способом невозможна. Выберите другой способ доставки') . "');
                return false;
            }
        
            if (errors) {
                return false;
            }
            
            $('#order-form').find('.required').each(function () {
                if ($(this).find('input, select, textarea').val() == '') {
                    errors = true;
                    
                    var label = $(this).find('label').text() === 'Стоимость доставки' ? '" . Yii::t('front', 'Способ доставки') . "' : $(this).find('label').text(),
						message = " . (Yii::$app->language == 'ru' ? "'" . Yii::t('front', 'Заполните') . " «' + label + '»';" : "'«' + label + '» ' + '" . Yii::t('front', 'не может быть пустым') . "';") . ";
                        
                    toastr.error(message);
                    return false;
                }
            });
            
            if (errors) {
                return false;
            }
            
            return true;
        }
        
        $('#order-form')
            .on('afterValidate', function (e) {
                return validateOrderForm();
            })
            .on('beforeSubmit', function (e) {
                if (!$('#agree').is(':checked')) {
                    toastr.error('" . Yii::t('front', 'Необходимо согласиться с обработкой персональных данных') . "');
                    return false;
                }
                
                if (validateOrderForm()) {
// return true;
                    var orderData = {
                        delivery_method: $('input[data-field=\"delivery_id\"]').val(),
                        delivery_address: {
                            country: $('input[data-field=\"country_id\"]').val(),
                            city: $('input[data-field=\"city_id\"]').val(),
                            city_name: $('input[data-field=\"city_name\"]').val(),
                            post_code: $('input[data-field=\"postcode\"]').val(),
                            address1: $('#order-address').val(),
                            full_name: $('#order-client_name').val()
                        },
                        products: null,
                        name: $('#order-client_name').val(),
                        email: $('#order-email').val(),
                        country_code: $('#country option:selected').data('code'),
                        phone: $('#order-phone').val().replace(/[^+\d]/g, ''),
                        lang_id: " . $lang_id . ",
                        response_lang_id: " . $lang_id . ",
                        success_url: '" . Url::to(['/checkout/success'], true) . "',
                        fail_url: '" . Url::to(['/checkout/error'], true) . "',
                        campaign_id: '" . Yii::$app->request->cookies->getValue('promo') . "',
                        comment: $('#order-comment').val()
                    };
                    
                    loading();
                    
                    $.ajax({
                        url: '" . Url::to(['/checkout/get-products']) . "',
                        method: 'get',
                        async: false,
                        beforeSend: function () {
                            loading();
                        },
                        success: function (products) {
                            orderData.products = JSON.parse(products);
console.log(orderData);
                            $.ajax({
                                url: 'https://api.sessia.com/api/market/" . $store_id . "/ordersAnonymous',
                                method: 'post',
                                data: orderData,
                                async: false,
                                beforeSend: function () {
                                    loading();
                                    $('[data-field=\"log_request\"]').val(JSON.stringify(orderData));
                                },
                                success: function (response) {
                                    $('[data-field=\"log_response\"]').val(JSON.stringify(response));
                                    $('#order-id').val(response.id);
                                    $('[data-field=\"id_order_sessia\"]').val(response.id);
                                    loading();
                                    $('#order-form')[0].submit();
                                    return;
                                },
                                error: function (response) {
console.log(response);
                                    var errors = response.responseJSON;
                                    for (var error in errors) {
                                        if (errors[error][0] !== undefined) {
                                            if (Array.isArray(errors[error])) {
                                                toastr.error(errors[error][0]);
                                            } else {
                                                toastr.error(errors[error]);
                                            }
                                        } else {
                                            if (errors[error].message !== undefined) {
                                                toastr.error(errors[error].message);
                                            } else {
                                                for (var msg in errors[error]) {
                                                    if (errors[error][msg][0] !== undefined) {
                                                        toastr.error(errors[error][msg][0]);
                                                    } else {
                                                        toastr.error(errors[error]);
                                                    }
                                                }
                                            }
                                        }
                                        
                                    }
                                    return false;
                                },
                                complete: function(){
                                    loading(false);
                                }
                            });
                        },
                        error: function (response) {
console.log(response);
                            toastr.error('" . Yii::t('front', 'Произошла ошибка! Пожалуйста, попробуйте еще раз чуть позже') . "');
                            return false;
                        },
                        complete: function () {
                            loading(false);
                        }
                    });
                }
                
                return false;
            });
    ",
    View::POS_READY);
?>

<?php
    // $this->registerJs(
    // "
        // $(document).on('click', '.next', function (e) {
            // e.preventDefault();
            // var errors = false,
                // target = $(this).attr('data-target'),
                // parentCollapse = $(this).parents('.collapse');
            
            // if ($(parentCollapse).find('.has-error').length > 0){
                // errors = true;
                // var message = $(parentCollapse).find('.has-error').find('.help-block').text();
                // toastr.error(message);
                // return false;
            // } 
            
            // $(parentCollapse).find('.required').each(function(){
                // if ($(this).find('input, select, textarea').val() == ''){
                    // errors = true;
                    // var message = $(this).find('label').text() + ' " . Yii::t('front', 'не может быть пустым') . "';
                    // toastr.error(message);
                    // return false;
                // }
            // });
            
            // if (!errors){
                // $(target).collapse('show');
            // }
        // })
    // ");
?>
