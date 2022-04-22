<?php

namespace backend\models;

use Yii;

class Pages extends \yii\db\ActiveRecord
{
    
    public $saveAndExit;

    function behaviors()
    {
        return [
            'slug' => [
                'class' => 'Zelenin\yii\behaviors\Slug',
            ],
        ];
    }
    
    public static function tableName()
    {
        return '{{%pages}}';
    }

    public function rules()
    {
        return [
            [['name', 'slug'], 'required'],
            [['name', 'text'], 'string'],
            [['active', 'saveAndExit'], 'integer'],
            [['slug'], 'string', 'max' => 255],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => Yii::t('back', 'ID'),
            'active' => Yii::t('back', 'Активно'),
            'name' => Yii::t('back', 'Название'),
            'slug' => Yii::t('back', 'Алиас'),
            'text' => Yii::t('back', 'Текст'),
        ];
    }
}
