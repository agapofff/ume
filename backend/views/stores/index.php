<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\grid\GridView;
use yii\widgets\Pjax;
use kartik\alert\AlertBlock;

use backend\models\Stores;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\StoresSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('back', 'Магазины');
$this->params['breadcrumbs'][] = $this->title;

?>

<?= AlertBlock::widget([
        'type' => 'growl',
        'useSessionFlash' => true,
        'delay' => 1,
    ]);
?>

<div class="stores-index">

    <?php
        if (Yii::$app->user->can('/stores/create')) {
            echo Html::a(Html::tag('span', '', [
                        'class' => 'glyphicon glyphicon-plus'
                    ]) . '&nbsp;' . Yii::t('back', 'Создать'), ['create'], [
                        'class' => 'btn btn-success'
                    ]);
        }
    ?>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

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
                    if (Yii::$app->user->can('/stores/active')) {
                        return Html::a(
                            Html::tag('big', 
                                Html::tag('span', '', [
                                    'class' => 'glyphicon ' . ( $data->active ? 'glyphicon-ok text-success' : 'glyphicon-remove text-danger')
                                ])
                            ),
                            [
                                'active',
                                'id' => $data->id
                            ],
                            [
                                'class' => 'pjax'
                            ]);
                    } else {
                        return Html::tag('big', Html::tag('span', '', [
                                    'class' => 'glyphicon ' . ( $data->active ? 'glyphicon-ok text-success' : 'glyphicon-remove text-danger')
                                ]));
                    }
                },
                'headerOptions' => [
                    'class' => 'text-center'
                ],
                'contentOptions' => [
                    'class' => 'text-center'
                ],
            ],
            
            [
                'attribute' => 'store_id',
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
                    if (Yii::$app->user->can('/stores/update')) {
                        return Html::a($model->name, [
                            'update',
                            'id' => $model->id
                        ], [
                            'title' => Yii::t('back', 'Изменить'),
                            'data-pjax' => 0,
                        ]);
                    } else {
                        return $model->name;
                    }
                },
                'headerOptions' => [
                    'class' => 'text-center'
                ],
                'contentOptions' => [
                    'class' => 'text-center'
                ],
            ],
            
            [
                'attribute' => 'lang',
                'format' => 'html',
                'filter' => Html::activeDropDownList(
                    $searchModel,
                    'lang',
                    ArrayHelper::map($languages, 'code', 'code'),
                    [
                        'class' => 'form-control',
                        'prompt' => Yii::t('back', 'Все'),
                    ]
                ),
                'value' => function ($model) {
                    return strtoupper($model->lang);
                },
                'headerOptions' => [
                    'class' => 'text-center'
                ],
                'contentOptions' => [
                    'class' => 'text-center'
                ],
            ],
            
            [
                'attribute' => 'type',
                'format' => 'html',
                'filter' => Html::activeDropDownList(
                    $searchModel,
                    'type',
                    Yii::$app->params['store_types'],
                    [
                        'class' => 'form-control',
                        'prompt' => Yii::t('back', 'Все'),
                    ]
                ),
                'value' => function ($data) {
                    return ArrayHelper::getValue(Yii::$app->params['store_types'], $data->type);
                },
                'headerOptions' => [
                    'class' => 'text-center'
                ],
                'contentOptions' => [
                    'class' => 'text-center'
                ],
            ],
            
            [
                'attribute' => 'currency',
                'filter' => Html::activeDropDownList(
                    $searchModel,
                    'currency',
                    ArrayHelper::map($currency, 'currency', 'currency'),
                    [
                        'class' => 'form-control',
                        'prompt' => Yii::t('back', 'Все'),
                    ]
                ),
                'headerOptions' => [
                    'class' => 'text-center'
                ],
                'contentOptions' => [
                    'class' => 'text-center'
                ],
            ],
            
            [
                'attribute' => 'description',
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
                        if (Yii::$app->user->can('/stores/update')) {
                            return Html::a('', $url, [
                                'class' => 'glyphicon glyphicon-pencil btn btn-primary btn-xs',
                                'title' => Yii::t('back', 'Изменить'),
                                'data-pjax' => 0,
                            ]);
                        }
                    },
                    'delete' => function ($url, $model) {
                        if (Yii::$app->user->can('/stores/delete')) {
                            return Html::a('', $url, [
                                'class' => 'glyphicon glyphicon-trash btn btn-danger btn-xs',
                                'title' => Yii::t('back', 'Удалить'),
                                'data' => [
                                    'pjax' => 0,
                                    'confirm' => Yii::t('back', 'Вы уверены, что хотите удалить этот элемент?'),
                                    'method' => 'post'
                                ]
                            ]);
                        }
                    },
                ]
            ],
            
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
