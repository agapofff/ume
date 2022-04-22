<?php

namespace backend\models;

use Yii;

class Langs extends \yii\db\ActiveRecord
{
    
    public $saveAndExit;
    
    public static function tableName()
    {
        return '{{%langs}}';
    }

    public function rules()
    {
        return [
            [['name', 'code', 'currency'], 'required'],
            [['publish', 'saveAndExit'], 'integer'],
            [['name', 'code', 'currency'], 'string', 'max' => 255],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => Yii::t('back', 'ID'),
            'name' => Yii::t('back', 'Название'),
            'code' => Yii::t('back', 'Код (ISO-639)'),
            'publish' => Yii::t('back', 'Включено'),
            'currency' => Yii::t('back', 'Валюта (ISO-4217)'),
        ];
    }
}
