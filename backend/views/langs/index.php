<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\grid\GridView;
use yii\widgets\Pjax;
use kartik\alert\AlertBlock;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\LangsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('back', 'Языки');
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="langs-index">

    <?php
        if (Yii::$app->user->can('/langs/create')) {
            echo Html::a(Html::tag('span', '', [
                        'class' => 'glyphicon glyphicon-plus'
                    ]) . '&nbsp;' . Yii::t('back', 'Создать'), ['create'], [
                        'class' => 'btn btn-success'
                    ]);
        }
    ?>

    <?php Pjax::begin(); ?>
    
        <?= AlertBlock::widget([
                'type' => 'growl',
                'useSessionFlash' => true,
                'delay' => 1,
            ]);
        ?>
    
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
                    'label' => Yii::t('back', 'Активно'),
                    'format' => 'html',
                    'filter' => Html::activeDropDownList(
                        $searchModel,
                        'active',
                        [
                            0 => Yii::t('back', 'Нет'),
                            1 => Yii::t('back', 'Да'),
                        ], [
                            'class' => 'form-control',
                            'prompt' => '---'
                        ]
                    ),
                    'value' => function ($data) {
                        if (Yii::$app->user->can('/langs/active')) {
                            return Html::a(
                                Html::tag('big', 
                                    Html::tag('span', '', [
                                        'class' => 'glyphicon ' . ( $data->active ? 'glyphicon-ok text-success' : 'glyphicon-remove text-danger')
                                    ])
                                ),
                                [
                                    'active',
                                    'id' => $data->id
                                ], [
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
                    'attribute' => 'name',
                    'format' => 'raw',
                    'value' => function ($model) {
                        if (Yii::$app->user->can('/langs/update')) {
                            return Html::a($model->name, [
                                        'update',
                                        'id' => $model->id,
                                    ], [
                                        'data-pjax' => 0
                                    ]);
                        } else {
                            return $model->name;
                        }
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
                    'attribute' => 'code',
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
                    'attribute' => 'currency',
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
                            if (Yii::$app->user->can('/langs/update')) {
                                return Html::a('', $url, [
                                    'class' => 'glyphicon glyphicon-pencil btn btn-primary btn-xs',
                                    'title' => Yii::t('back', 'Изменить'),
                                    'data-pjax' => 0,
                                ]);
                            }
                        },
                        'delete' => function ($url, $model) {
                            if (Yii::$app->user->can('/langs/delete')) {
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
        ]);?>

    <?php Pjax::end(); ?>

</div>
