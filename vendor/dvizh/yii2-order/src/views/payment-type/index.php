<?php
use yii\helpers\Html;
use yii\grid\GridView;
use dvizh\order\models\OrderFieldType;
use yii\helpers\ArrayHelper;

use yii\widgets\Pjax;
use kartik\alert\AlertBlock;

use dvizh\order\assets\Asset;
Asset::register($this);

$this->title = Yii::t('back', 'Способы оплаты');
// $this->params['breadcrumbs'][] = ['label' => Yii::t('back', 'Orders'), 'url' => ['/order/default/index']];
$this->params['breadcrumbs'][] = $this->title;

?>

<?php Pjax::begin(); ?>

<?= AlertBlock::widget([
        'type' => 'growl',
        'useSessionFlash' => true,
        'delay' => 1,
    ]);
?>

<div class="paymenttype-index">

    <?= Html::a(Html::tag('span', '', [
            'class' => 'glyphicon glyphicon-plus'
        ]) . '&nbsp;' . Yii::t('back', 'Создать'), [
            'create',
        ], [
            'class' => 'btn btn-success',
            'data-pjax' => 0,
        ])
    ?>
    
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        // 'export' => false,
        'summary' => false,
        'columns' => [
        
            // ['attribute' => 'id', 'options' => ['style' => 'width: 55px;']],
            
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
                        ]);
                },
                'headerOptions' => [
                    'class' => 'text-center'
                ],
                'contentOptions' => [
                    'class' => 'text-center',
                    // 'style' => 'width: 50px;'
                ],
            ],
            
            [
                'attribute' => 'name',
                'format' => 'raw',
                'value' => function($model){
                    return Html::a($model->name, [
                        'update',
                        'id' => $model->id
                    ], [
                        'data-pjax' => 0,
                    ]);
                },
                'headerOptions' => [
                    'class' => 'text-center',
                    // 'style' => 'width: 20%'
                ],
                'filterInputOptions' => [
                    'class' => 'form-control text-center',
                    'placeholder' => Yii::t('back', 'Поиск...'),
                ],
            ],
            
            // 'widget',
            
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{update} {delete}',
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
    ]); ?>

</div>

<?php Pjax::end() ?>