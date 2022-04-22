<?php

namespace backend\models;

use Yii;

class Promocodes extends \yii\db\ActiveRecord
{
    
    public $saveAndExit;
    
    public static function tableName()
    {
        return '{{%promocodes}}';
    }

    public function rules()
    {
        return [
            [['publish', 'type', 'saveAndExit'], 'integer'],
            [['code', 'description'], 'required'],
            [['code', 'description'], 'string', 'max' => 255],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => Yii::t('back', 'ID'),
            'publish' => Yii::t('back', 'Активно'),
            'code' => Yii::t('back', 'Промокод'),
            'type' => Yii::t('back', 'Магазин'),
            'description' => Yii::t('back', 'Описание'),
        ];
    }
}
