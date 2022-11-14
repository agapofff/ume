<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use dvizh\shop\models\Category;
use dvizh\shop\models\Producer;
use kartik\export\ExportMenu;

use yii\widgets\Pjax;
use kartik\alert\AlertBlock;

$this->title = Yii::t('back', 'Товары');
$this->params['breadcrumbs'][] = [
    'label' => Yii::t('back', 'Магазин'),
    'url' => ['/shop/default/index']
];
$this->params['breadcrumbs'][] = $this->title;

\dvizh\shop\assets\BackendAsset::register($this);
?>

<?php Pjax::begin(); ?>

<?= AlertBlock::widget([
        'type' => 'growl',
        'useSessionFlash' => true,
        'delay' => 1,
    ]);
?>

<div class="product-index">
    
    <!--
    <div class="row">
        <div class="col-md-6">
            <?php
                /*
                $gridColumns = [
                    'id',
                    'code',
                    'category.name',
                    'producer.name',
                    'name',
                    'price',
                    'amount',
                ];
                echo ExportMenu::widget([
                    'dataProvider' => $dataProvider,
                    'columns' => $gridColumns
                ]);
                */
            ?>
            <div class="btn-group">
                <button type="button" class="btn btn-default dropdown-toggle dvizh-mass-controls disabled" data-toggle="dropdown">
                    <span class="glyphicon glyphicon-cog "></span>
                    <span class="caret "></span>
                </button>
                <ul class="dropdown-menu dvizh-model-control">
                    <li data-action="edit">
                        <a data-toggle="modal" data-target="#modal-control-model" data-model="<?= $dataProvider->query->modelClass ?>" class="dvizh-mass-edit" href="#">Редактиовать выбранные</a>
                    </li>
                    <li data-action="delete" >
                        <a  data-model="<?= $dataProvider->query->modelClass ?>" data-action="<?= Url::to(['/shop/product/mass-deletion']) ?>" class="dvizh-mass-delete" href="#">Удалить выбранные</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    -->

    
    <?= Html::a(Html::tag('span', '', [
        'class' => 'glyphicon glyphicon-plus'
    ]) . '&nbsp;' . Yii::t('back', 'Создать'), [
        'create',
        'category_id' => Yii::$app->request->get('ProductSearch')['category_id']
    ], [
        'class' => 'btn btn-success',
        'data-pjax' => 0,
    ]) ?>
    
    <br style="clear: both;"></div>
    
    <?php
        echo \yii\grid\GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'summary' => false,
            'columns' => [
                // ['class' => '\kartik\grid\CheckboxColumn'],
                
                // ['class' => 'yii\grid\SerialColumn'],
                
                [
                    'attribute' => 'id',
                    'contentOptions' => [
                        'class' => 'text-center'
                    ],
                    'headerOptions' => [
                        'class' => 'text-center'
                    ],
                    'filterInputOptions' => [
                        'class' => 'form-control text-center',
                        'placeholder' => Yii::t('back', 'Поиск...'),
                    ],
                ],
                
                [
                    'attribute' => 'name',
                    'format' => 'raw',
                    'contentOptions' => [
                        'class' => 'text-center',
                        'style' => 'vertical-align: center',
                    ],
                    'headerOptions' => [
                        'class' => 'text-center'
                    ],
                    'filterInputOptions' => [
                        'class' => 'form-control text-center',
                        'placeholder' => Yii::t('back', 'Поиск...'),
                    ],
                    'value' => function($model){
                        $name = json_decode($model->name)->{Yii::$app->language};
						$image = $model->getImage();
                        if ($image){
							$cachedImage = '/images/cache/Products/Product' . $image->itemId . '/' . $image->urlAlias . '_50x50.jpg';
							
                            return Html::a(Html::tag('div', Html::tag('div', Html::img(file_exists(Yii::getAlias('@frontend') . '/web' . $cachedImage) ? $cachedImage : $image->getUrl('50x50')), [
                                'class' => 'media-left'
                            ]) . Html::tag('div', $name, [
                                'class' => 'media-body media-middle text-left'
                            ]), [
                                'class' => 'media'
                            ]), [
                                'update',
                                'id' => $model->id,
                                'ref' => Url::current([], true),
                            ], [
                                'data-pjax' => 0,
                            ]);
                        } else {
                            return Html::a($name, [
                                'update',
                                'id' => $model->id,
                                'ref' => Url::current([], true),
                            ], [
                                'data-pjax' => 0,
                            ]);
                        }
                    }
                ],
                
                /*
                [
                    'attribute' => 'images',
                    'format' => 'images',
                    'filter' => false,
                    'content' => function($model){
                        if ($image = $model->getImage()->getUrl('50x50')){
                            return Html::a(Html::img($image), ['update', 'id' => $model->id]);
                        }
                    }
                ],
                */
                /*
                [
                    'attribute' => 'code',
                    'format' => 'raw',
                    'contentOptions' => [
                        // 'style' => 'min-width: 200px'
                    ],
                    'headerOptions' => [
                        'class' => 'text-center',
                        'style' => 'width: 20%'
                    ],
                    'filterInputOptions' => [
                        'class' => 'form-control text-center',
                        'placeholder' => Yii::t('back', 'Поиск...'),
                    ],
                ],
                */
                /*
                [
                    'attribute' => 'amount',
                    'contentOptions' => [
                        'class' => 'text-center'
                    ],
                    'format' => 'raw',
                    'filter' => false,
                    'value' => function($data){
                        return $data->amount > 0 ? Html::tag('span', '', [
                            'class' => 'glyphicon glyphicon-ok text-success'
                        ]) : Html::tag('span', '', [
                            'class' => 'glyphicon glyphicon-remove text-danger'
                        ]);
                    },
                ],
                */
                
                /*
                [
                    'attribute' => 'price',
                    'label' => Yii::t('back', 'Цена'),
                    'headerOptions' => [
                        'class' => 'text-center',
                    ],
                    'filterInputOptions' => [
                        'class' => 'form-control text-center',
                        'placeholder' => Yii::t('back', 'Поиск...'),
                    ],
                    'contentOptions' => [
                        'class' => 'text-right',
                    ],
                    'content' => function ($model) {
                        $prices = '';
                        foreach($model->prices as $price){
                            $prices .= Html::tag('p', Html::tag('span', $price->price, [
                                'title' => $price->name
                            ]));
                            // $return .= "<p class=\"productsMenuPrice\"><span title=\"{$price->name}\">{$price->price}</span></p>";
                        }
                        return $prices;
                    }
                ],
                */
				
                [
                    'attribute' => 'active',
                    'format' => 'raw',
                    'contentOptions' => [
                        'class' => 'text-center'
                    ],
                    'headerOptions' => [
                        'class' => 'text-center',
                        'style' => 'min-width: 90px'
                    ],
                    'filter' => Html::activeDropDownList(
                        $searchModel,
                        'active',
                        [
                            0 => Yii::t('back', 'Нет'),
                            1 => Yii::t('back', 'Да'),
                        ], [
                            'class' => 'form-control',
                            'prompt' => Yii::t('back', 'Все'),
                        ]
                    ),
                    'value' => function($data){
                        return Html::a(
                            Html::tag('big', 
                                Html::tag('span', '', [
                                    'class' => 'glyphicon ' . ( $data->active ? 'glyphicon-ok text-success' : 'glyphicon-remove text-danger')
                                ])
                            ), [
                                'active',
                                'id' => $data->id
                            ], [
                                'class' => 'pjax'
                            ]
                        );
                    },
                ],
                
                // [
                    // 'attribute' => 'available',
                    // 'format' => 'raw',
                    // 'contentOptions' => [
                        // 'class' => 'text-center'
                    // ],
                    // 'headerOptions' => [
                        // 'class' => 'text-center',
                        // 'style' => 'min-width: 90px'
                    // ],
                    // 'filter' => Html::activeDropDownList(
                        // $searchModel,
                        // 'available',
                        // [
                            // 0 => Yii::t('back', 'Нет'),
                            // 1 => Yii::t('back', 'Да'),
                        // ], [
                            // 'class' => 'form-control',
                            // 'prompt' => Yii::t('back', 'Все'),
                        // ]
                    // ),
                    // 'value' => function($data){
                        // return Html::a(
                            // Html::tag('big', 
                                // Html::tag('span', '', [
                                    // 'class' => 'glyphicon ' . ( $data->available ? 'glyphicon-ok text-success' : 'glyphicon-remove text-danger')
                                // ])
                            // ), [
                                // 'available',
                                // 'id' => $data->id
                            // ], [
                                // 'class' => 'pjax'
                            // ]
                        // );
                    // },
                // ],
				
                // [
                    // 'attribute' => 'is_new',
                    // 'format' => 'raw',
                    // 'contentOptions' => [
                        // 'class' => 'text-center'
                    // ],
                    // 'headerOptions' => [
                        // 'class' => 'text-center',
                        // 'style' => 'min-width: 90px'
                    // ],
                    // 'filter' => Html::activeDropDownList(
                        // $searchModel,
                        // 'is_new',
                        // [
                            // 0 => Yii::t('back', 'Нет'),
                            // 1 => Yii::t('back', 'Да'),
                        // ], [
                            // 'class' => 'form-control',
                            // 'prompt' => Yii::t('back', 'Все'),
                        // ]
                    // ),
                    // 'value' => function($data){
                        // return Html::a(
                            // Html::tag('big', 
                                // Html::tag('span', '', [
                                    // 'class' => 'glyphicon ' . ( $data->is_new ? 'glyphicon-ok text-success' : 'glyphicon-remove text-danger')
                                // ])
                            // ), [
                                // 'new',
                                // 'id' => $data->id
                            // ], [
                                // 'class' => 'pjax'
                            // ]
                        // );
                    // },
                // ],
				
                // [
                    // 'attribute' => 'is_popular',
                    // 'format' => 'raw',
                    // 'contentOptions' => [
                        // 'class' => 'text-center'
                    // ],
                    // 'headerOptions' => [
                        // 'class' => 'text-center',
                        // 'style' => 'min-width: 90px'
                    // ],
                    // 'filter' => Html::activeDropDownList(
                        // $searchModel,
                        // 'is_popular',
                        // [
                            // 0 => Yii::t('back', 'Нет'),
                            // 1 => Yii::t('back', 'Да'),
                        // ], [
                            // 'class' => 'form-control',
                            // 'prompt' => Yii::t('back', 'Все'),
                        // ]
                    // ),
                    // 'value' => function($data){
                        // return Html::a(
                            // Html::tag('big', 
                                // Html::tag('span', '', [
                                    // 'class' => 'glyphicon ' . ( $data->is_popular ? 'glyphicon-ok text-success' : 'glyphicon-remove text-danger')
                                // ])
                            // ), [
                                // 'popular',
                                // 'id' => $data->id
                            // ], [
                                // 'class' => 'pjax'
                            // ]
                        // );
                    // },
                // ],
				
                // [
                    // 'attribute' => 'is_promo',
                    // 'format' => 'raw',
                    // 'contentOptions' => [
                        // 'class' => 'text-center'
                    // ],
                    // 'headerOptions' => [
                        // 'class' => 'text-center',
                        // 'style' => 'min-width: 90px'
                    // ],
                    // 'filter' => Html::activeDropDownList(
                        // $searchModel,
                        // 'is_promo',
                        // [
                            // 0 => Yii::t('back', 'Нет'),
                            // 1 => Yii::t('back', 'Да'),
                        // ], [
                            // 'class' => 'form-control',
                            // 'prompt' => Yii::t('back', 'Все'),
                        // ]
                    // ),
                    // 'value' => function($data){
                        // return Html::a(
                            // Html::tag('big', 
                                // Html::tag('span', '', [
                                    // 'class' => 'glyphicon ' . ( $data->is_promo ? 'glyphicon-ok text-success' : 'glyphicon-remove text-danger')
                                // ])
                            // ), [
                                // 'promo',
                                // 'id' => $data->id
                            // ], [
                                // 'class' => 'pjax'
                            // ]
                        // );
                    // },
                // ],
                
                [
                    'attribute' => 'category_id',
                    'format' => 'raw',
                    'headerOptions' => [
                        'class' => 'text-center',
                        'style' => 'min-width: 150px;'
                    ],
                    'filter' => Html::activeDropDownList(
                        $searchModel,
                        'category_id',
                        Category::buildTextTree(),
                        [
                            'class' => 'form-control',
                            'prompt' => Yii::t('back', 'Все'),
                        ]
                    ),
                    // 'value' => 'category.name'
                    'value' => function($model){
                        $html = '';
                        foreach ($model->categories as $category){
                            $html .= Html::tag('div', Html::a(
                            ($category->parent_id ? '-- ' : '') . json_decode($category->name)->{Yii::$app->language},
                            [
                                'category/update',
                                'id' => $category->id,
                            ], [
                                'data-pjax' => 0,
                            ]), [
                                'style' => 'white-space: nowrap',
                            ]);
                        }
                        return $html;
                        
                        // $ban = Category::find()->where([
                            // 'not in', 'id', ArrayHelper::getColumn($model->categories, 'id')
                        // ])->all();
                        // $categories = Category::buildTextTree($category->parent_id, 0, ArrayHelper::getColumn($ban, 'id'));
                        // print_r($categories);
                        // $html = '';
                        // foreach ($categories as $key => $val){
                            // $html .= Html::tag('div', Html::a($val, [
                                // 'category/update',
                                // 'id' => $key,
                            // ], [
                                // 'data-pjax' => 0,
                            // ]), [
                                // 'style' => 'white-space: nowrap',
                            // ]);
                        // }
                        // return $html;
                    }
                ],
                
                /*
                [
                    'attribute' => 'producer_id',
                    'contentOptions' => [
                        'class' => 'text-center'
                    ],
                    'headerOptions' => [
                        'class' => 'text-center'
                    ],
                    'filter' => Html::activeDropDownList(
                        $searchModel,
                        'producer_id',
                        ArrayHelper::map(Producer::find()->orderBy('name')->all(), 'id', 'name'),
                        ['class' => 'form-control', 'prompt' => 'Производитель']
                    ),
                    'value' => 'producer.name'
                ],
                */
                
                [
                    'class' => 'yii\grid\ActionColumn',
                    'template' => '{update} {copy} {delete}',
                    'contentOptions' => [
                        'class' => 'text-center'
                    ],
                    'buttons' => [
                        'update' => function($url, $model){
                            return Html::a('', $url, [
                                'class' => 'glyphicon glyphicon-pencil btn btn-primary btn-xs',
                                'title' => Yii::t('back', 'Изменить'),
                                'data-pjax' => 0,
                            ]);
                        },
                        'copy' => function($url, $model){
                            return Html::a('', [
								'copy',
								'id' => $model->id,
							], [
                                'class' => 'glyphicon glyphicon-duplicate btn btn-info btn-xs',
                                'title' => Yii::t('back', 'Копировать'),
                                'data-pjax' => 0,
                            ]);
                        },
                        'delete' => function($url, $model){
                            return Html::a('', $url, [
                                'class' => 'glyphicon glyphicon-trash btn btn-danger btn-xs',
                                'title' => Yii::t('back', 'Удалить'),
                                'data' => [
                                    'pjax' => 0,
                                    'confirm' => Yii::t('back', 'Вы уверены, что хотите удалить этот элемент?'),
                                    'method' => 'post'
                                ]
                            ]);
                        },
                    ]
                ],
            ],
        ]);

    ?>

</div>

<?php Pjax::end(); ?>

<!--

<div class="modal fade" id="modal-control-model">
    <div class="modal-dialog modal-mass-update">
        <div class="modal-content">
            <div class="notification-error text-center" style="display: none;">
                <div class="col-xs-12 alert alert-danger">
                    <button class="close">×</button>
                    <div class="glyphicon glyphicon-exclamation-sign"></div>
                    Вы ничего не выбрали
                    <div>
                    </div>

                </div>
            </div>
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h3 class="modal-title">Выберите поля для редактирования</h3>
                <p>Вы можете редактировать одновременно несколько записей.
                    Выберете записи из списка выше, отметьте галочкой поля,
                    которые нужно отредактировать, и нажмите на кнопку
                    "Редактировать выбранные".</p>
            </div>
            <div class="modal-body mass-update-body">
                <ul class="nav nav-tabs nav-mass-update">
                    <li class="active"><a href="#product-fields" data-toggle="tab">Поля</a></li>
                    <li><a href="#product-filters" data-toggle="tab">Фильтры</a></li>
                    <li><a href="#product-more-fields" data-toggle="tab">Доп. поля</a></li>
                    <li>
                        <a href="#empty">
                            <?=  Html::checkbox('images', false, [
                                'label' => 'Картинки',
                                'value' => 'images',
                                'class' => 'dvizh-mass-edit-images'
                            ]) ?>
                        </a>
                    </li>
                    <li>
                        <a href="#empty">
                            <?=  Html::checkbox('prices', false, [
                                'label' => 'Цены',
                                'value' => 'prices',
                                'class' => 'dvizh-mass-edit-prices'
                            ]) ?>
                        </a>
                    </li>
                </ul>
                <div class="tab-content product-updater">
                    <div class="tab-pane active" id="product-fields">
                        <?php if(!empty($model)) { ?>
                            <div class="row dvizh-mass-edit-filds">
                                <?php foreach ($model->attributeLabels() as $nameAttribute => $labelAttribute) { ?>
                                    <?php if(ArrayHelper::isIn($nameAttribute, $ignoreAttribute)) continue; ?>
                                    <div class="col-sm-4">
                                        <?=  Html::checkbox($nameAttribute, true, ['label' => $labelAttribute, 'value' => $nameAttribute,]) ?>
                                    </div>
                                <?php } ?>
                            </div>
                            <p class="cm-check-items-group">
                                <a class="cm-check-items cm-on" data-type="filds">Выбрать все</a> |
                                <a class="cm-check-items cm-off" data-type="filds">Снять выделение со всех</a>
                            </p>
                        <?php } ?>
                    </div>
                    <div class="tab-pane" id="product-filters">
                        <?php if(!empty($filters)) { ?>
                            <div class="row dvizh-mass-edit-filters">
                                <?php foreach ($filters as $filter) { ?>
                                    <div class="col-sm-4">
                                        <?=  Html::checkbox($filter->slug, false, [
                                            'label' => $filter->name,
                                            'value' => $filter->id,
                                        ]) ?>
                                    </div>
                                <?php } ?>
                                <div class="col-sm-12">
                                    <p class="cm-check-items-group">
                                        <a class="cm-check-items cm-on" data-type="filters">Выбрать все</a> |
                                        <a class="cm-check-items cm-off" data-type="filters">Снять выделение со всех</a>
                                    </p>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                    <div class="tab-pane" id="product-more-fields">
                        <div class="row dvizh-mass-edit-more-fields">
                            <?php if (!empty($model)){ ?>
                                <?php foreach ($model->getFields() as $filter) { ?>
                                    <div class="col-sm-4">
                                        <?=  Html::checkbox($filter->slug, false, [
                                            'label' => $filter->name,
                                            'value' => $filter->id,
                                        ]) ?>
                                    </div>
                                <?php } ?>
                            <?php } ?>
                            <div class="col-sm-12">
                                <p class="cm-check-items-group">
                                    <a class="cm-check-items cm-on" data-type="more-fields">Выбрать все</a> |
                                    <a class="cm-check-items cm-off" data-type="more-fields">Снять выделение со всех</a>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="product-images">
                        <div class="row dvizh-mass-edit-images">
                            <div class="col-sm-4">
                                <?=  Html::checkbox('images', false, ['label' => 'Картинки', 'value' => 'images']) ?>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="product-prices">
                        <div class="row dvizh-mass-edit-prices">
                            <div class="col-sm-12">
                                <b>Цены</b>
                            </div>
                            <div class="col-sm-4">
                                <?=  Html::checkbox('prices', false, ['label' => 'Цены', 'value' => 'prices']) ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <?= Html::a(null, ['product/mass-update'], [
                    'data-method' => 'POST',
                    'data-params' => null,
                    'data-role' => 'link-mass-update'
                ]) ?>
                <button type="button" class="btn btn-default" data-dismiss="modal">Отмена</button>
                <button type="button" class="btn btn-primary dvizh-mass-update-btn">Редактировать выбранные</button>

            </div>
        </div>
    </div>
</div>

-->