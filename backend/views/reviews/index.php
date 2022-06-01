<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\grid\GridView;
use yii\widgets\Pjax;
use kartik\alert\AlertBlock;
use jino5577\daterangepicker\DateRangePicker;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\ReviewsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('back', 'Отзывы');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="reviews-index">

    <?= Html::a(Html::tag('span', '', [
            'class' => 'glyphicon glyphicon-plus'
        ]) . '&nbsp;' . Yii::t('back', 'Создать'), ['create'], [
            'class' => 'btn btn-success'
        ]);
    ?>

    <?php Pjax::begin(); ?>

    <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'summary' => false,
            'columns' => [
                // ['class' => 'yii\grid\SerialColumn'],

                // 'id',
                
                [
                    'attribute' => 'active',
                    'format' => 'html',
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
                    'value' => function ($data) {
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
                            ]);
                    },
                    'headerOptions' => [
                        'class' => 'text-center'
                    ],
                    'contentOptions' => [
                        'class' => 'text-center'
                    ],
                ],
                
                [
                    'attribute' => 'created',
                    'format' => ['date', 'php:d F Y'],
                    'filter' => DateRangePicker::widget([
                        'model' => $searchModel,
                        'attribute' => 'created',
                        'locale' => 'ru-RU',
                        'pluginOptions' => [
                            'format' => 'd.m.Y',
                            'locale' => [
                                'applyLabel' => 'Применить',
                                'cancelLabel' => 'Отмена'
                            ],
                            'autoUpdateInput' => false
                        ],
                        'maskOptions' => [
                            'mask' => '99.99.9999 - 99.99.9999',
                        ],
                        'options' => [
                            'class' => 'form-control text-center',
                            'placeholder' => 'Поиск...'
                        ]
                    ]),
                    'headerOptions' => [
                        'class' => 'text-center'
                    ],
                    'contentOptions' => [
                        'class' => 'text-center'
                    ],
                ],
                
                [   
                    'attribute' => 'rating',
                    'format' => 'raw',
                    'value' => function ($model) {
                        $html = '';
                        for ($i = 0; $i <= $model->rating; $i++) {
                            $html .= Html::tag('i', '&nbsp;', [
                                'class' => 'fa fa-star'
                            ]);
                        }
                        return Html::tag('span', $html, [
                            'style' => 'white-space: nowrap;',
                        ]);
                    },
                    'filter' => Html::activeDropDownList(
                        $searchModel,
                        'user_id',
                        range(1, 5),
                        [
                            'class' => 'form-control',
                            'prompt' => Yii::t('back', 'Все'),
                        ]
                    ),
                    'headerOptions' => [
                        'class' => 'text-center'
                    ],
                ],
                
                [
                    'attribute' => 'text',
                    'format' => 'raw',
                    'value' => function ($model) {
                        return Html::a($model->text, [
                            'update',
                            'id' => $model->id,
                        ], [
                            'data-pjax' => 0,
                        ]);
                    },
                    'filterInputOptions' => [
                        'class' => 'form-control text-center',
                        'placeholder' => 'Поиск...'
                    ],
                    'headerOptions' => [
                        'class' => 'text-center'
                    ],
                ],
                
                [
                    'attribute' => 'user_id',
                    'format' => 'raw',
                    'filter' => Html::activeDropDownList(
                        $searchModel,
                        'user_id',
                        ArrayHelper::map($users, 'id', 'username'), [
                            'class' => 'form-control',
                            'prompt' => Yii::t('back', 'Все'),
                        ]
                    ),
                    'value' => function ($model) use ($users) {
                        return ArrayHelper::index($users, 'id')[$model->user_id]->username;
                    },
                    'headerOptions' => [
                        'class' => 'text-center'
                    ],
                    'contentOptions' => [
                        'class' => 'text-center'
                    ],
                ],
                
                [
                    'attribute' => 'pet_name',
                    'filterInputOptions' => [
                        'class' => 'form-control text-center',
                        'placeholder' => 'Поиск...'
                    ],
                    'contentOptions' => [
                        'class' => 'text-center'
                    ],
                    'headerOptions' => [
                        'class' => 'text-center'
                    ],
                ],
                
                // 'pet_photo',
                //'pet_breed',
                //'pet_birthday',
                
                

                //'product_id',
                //'booster_id',
                [  
                    'attribute' => 'language',
                    'format' => 'raw',
                    'filter' => Html::activeDropDownList(
                        $searchModel,
                        'language',
                        ArrayHelper::map($languages, 'code', 'name'), [
                            'class' => 'form-control',
                            'prompt' => Yii::t('back', 'Все'),
                        ]
                    ),
                    'value' => function ($model) use ($languages) {
                        return ArrayHelper::index($languages, 'code')[$model->language]->name;
                    },
                    'headerOptions' => [
                        'class' => 'text-center'
                    ],
                    'contentOptions' => [
                        'class' => 'text-center'
                    ],
                ],

                [
                    'class' => 'yii\grid\ActionColumn',
                    'template' => '{update} {delete}',
                    'contentOptions' => [
                        'class' => 'text-center'
                    ],
                    'buttons' => [
                        'update' => function ($url, $model) {
                            return Html::a('', $url, [
                                'class' => 'glyphicon glyphicon-pencil btn btn-primary btn-xs',
                                'title' => Yii::t('back', 'Изменить'),
                                'data-pjax' => 0,
                            ]);
                        },
                        'delete' => function ($url, $model) {
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
        ]); ?>

    <?php Pjax::end(); ?>

</div>
