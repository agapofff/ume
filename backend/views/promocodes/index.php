<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\grid\GridView;
use yii\widgets\Pjax;
use kartik\alert\AlertBlock;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\PromocodesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('back', 'Промокоды');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="promocodes-index">

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
        
        <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'summary' => false,
            'columns' => [
            
                // ['class' => 'yii\grid\SerialColumn'],
                
                // 'id',
                
                [
                    'attribute' => 'publish',
                    'format' => 'html',
                    'filter' => Html::activeDropDownList(
                        $searchModel,
                        'publish',
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
                                    'class' => 'glyphicon ' . ( $data->publish ? 'glyphicon-ok text-success' : 'glyphicon-remove text-danger')
                                ])
                            ),
                            [
                                'publish',
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
                    'attribute' => 'code',
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
