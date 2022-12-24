<?php
namespace dvizh\cart\widgets;

use yii\helpers\Html;

class ElementCost extends \yii\base\Widget
{
    public $model = NULL;
    public $cssClass = NULL;
    public $htmlTag = 'span';
    public $currency = NULL;

    public function init()
    {
        parent::init();
        return true;
    }

    public function run()
    {
        return Html::tag($this->htmlTag, Yii::$app->formatter->asCurrency((float)$this->model->getCost(), $this->currency ?: Yii::$app->params['currency']), [
            'class' => "dvizh-cart-element-cost{$this->model->getId()} {$this->cssClass}",
        ]);
    }
}