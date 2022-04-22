<?php

namespace backend\models;

use Yii;

class MetaTags extends \yii\db\ActiveRecord
{
    
    public $saveAndExit;
    
    public static function tableName()
    {
        return '{{%meta_tags}}';
    }

    public function rules()
    {
        return [
            // [['link', 'title', 'description', 'h1'], 'required'],
            [['description'], 'string'],
            [['saveAndExit', 'active'], 'integer'],
            [['link', 'title', 'h1'], 'string', 'max' => 255],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => Yii::t('back', 'ID'),
            'active' => Yii::t('back', 'Активно'),
            'link' => Yii::t('back', 'Ссылка'),
            'title' => Yii::t('back', 'Title'),
            'description' => Yii::t('back', 'Description'),
            'h1' => Yii::t('back', 'H1'),
        ];
    }
}
