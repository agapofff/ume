<?php

namespace backend\models;

use Yii;

class NewsCategories extends \yii\db\ActiveRecord
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
        return '{{%news_categories}}';
    }

    public function rules()
    {
        return [
            [['name'], 'string'],
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
        ];
    }

    public function getNews()
    {
        return $this->hasMany(News::className(), ['category_id' => 'id']);
    }
}
