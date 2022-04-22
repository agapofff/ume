<?php

namespace dvizh\order\models;

use yii;

class ShippingType extends \yii\db\ActiveRecord
{
    
    public $saveAndExit = 0;
    
    public static function tableName()
    {
        return '{{%order_shipping_type}}';
    }

    public function rules()
    {
        return [
            [['name'], 'required'],
            [['order', 'active', 'saveAndExit'], 'integer'],
            [['cost', 'free_cost_from'], 'double'],
            [['description'], 'string'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'name' => Yii::t('back', 'Название'),
            'order' => Yii::t('back', 'Порядок'),
            'cost' => Yii::t('back', 'Стоимость'),
            'free_cost_from' => Yii::t('back', 'Бесплатно от'),
            'active' => Yii::t('back', 'Активно'),
            'description' => Yii::t('back', 'Описание'),
        ];
    }
}
