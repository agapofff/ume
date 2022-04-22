<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use kartik\alert\AlertBlock;

$this->title = Yii::t('back', 'Страны');
$this->params['breadcrumbs'][] = $this->title;

$sort = Yii::$app->request->get('sort');

?>

<div class="countries-index">

    <?= Html::a(Html::tag('span', '', [
            'class' => 'glyphicon glyphicon-plus'
        ]) . '&nbsp;' . Yii::t('back', 'Создать'), ['create'], [
            'class' => 'btn btn-success'
        ]);
    ?>

    <?php Pjax::begin(); ?>
    
        <?= AlertBlock::widget([
                'type' => 'growl',
                'useSessionFlash' => true,
                'delay' => 1,
            ]);
        ?>

        <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'summary' => false,
                'tableOptions' => [
                    'class' => 'table table-striped table-bordered' . ($sort == 'ordering' || $sort == '-ordering' ? ' sortable' . (substr($sort, 0, 1) == '-' ? ' desc' : '') : ''),
                ],
                'rowOptions' => function ($model) {
                    return [
                        'data-id' => $model->id,
                        'data-url' => Url::to([
                            'ordering',
                            'id' => $model->id
                        ]),
                    ];
                },
                'columns' => [
                    // ['class' => 'yii\grid\SerialColumn'],
                    // 'id',
                    
                    [
                        'attribute' => 'ordering',
                        'format' => 'html',
                        'filter' => false,
                        'value' => function ($model) use ($sort) {
                            return Html::tag('i', '', [
                                'class' => 'fa fa-sort ' . ($sort == 'ordering' || $sort == '-ordering' ? 'text-info sort-handler' : 'text-muted')
                            ]);
                        },
                        'headerOptions' => [
                            'class' => 'text-center',
                            'style' => 'width: 50px;',
                        ],
                        'contentOptions' => [
                            'class' => 'text-center'
                        ],
                    ],
                    
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
                        'attribute' => 'name',
                        'format' => 'raw',
                        'value' => function ($model) {
                            return Html::a(json_decode($model->name)->{Yii::$app->language}, [
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
            ]);
        ?>

    <?php Pjax::end(); ?>

</div>
