<?php

namespace backend\models;

use Yii;

class Stores extends \yii\db\ActiveRecord
{
    
    public $saveAndExit;
    
    public static function tableName()
    {
        return '{{%stores}}';
    }

    public function rules()
    {
        return [
            [['active', 'type', 'store_id', 'saveAndExit'], 'integer'],
            [['lang', 'type', 'store_id'], 'required'],
            [['lang', 'name', 'currency', 'description'], 'string', 'max' => 255],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => Yii::t('back', 'ID'),
            'active' => Yii::t('back', 'Активно'),
            'lang' => Yii::t('back', 'Язык'),
            'type' => Yii::t('back', 'Тип'),
            'store_id' => Yii::t('back', 'ID магазина'),
            'name' => Yii::t('back', 'Название'),
            'currency' => Yii::t('back', 'Валюта'),
            'description' => Yii::t('back', 'Описание'),
        ];
    }
    
}
