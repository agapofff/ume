<?php

namespace backend\models;

use Yii;

class News extends \yii\db\ActiveRecord
{
    
    public $saveAndExit;

    function behaviors()
    {
        return [
            'slug' => [
                'class' => 'Zelenin\yii\behaviors\Slug',
            ],
            'images' => [
                'class' => 'agapofff\gallery\behaviors\AttachImages',
                'mode' => 'gallery',
                'quality' => 80,
                'galleryId' => 'news',
                'allowExtensions' => ['jpg', 'jpeg', 'png'],
            ],
        ];
    }
    
    public static function tableName()
    {
        return '{{%news}}';
    }

    public function rules()
    {
        return [
            [['active', 'category_id', 'saveAndExit', 'show_preview'], 'integer'],
            [['date_published'], 'safe'],
            [['name', 'description', 'text', 'publisher'], 'string'],
            [['category_id'], 'required'],
            [['slug'], 'string', 'max' => 255],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => NewsCategories::className(), 'targetAttribute' => ['category_id' => 'id']],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => Yii::t('back', 'ID'),
            'active' => Yii::t('back', 'Активно'),
            'date_published' => Yii::t('back', 'Дата публикации'),
            'name' => Yii::t('back', 'Название'),
            'category_id' => Yii::t('back', 'Категория'),
            'description' => Yii::t('back', 'Описание'),
            'text' => Yii::t('back', 'Текст'),
            'publisher' => Yii::t('back', 'Издание'),
            'slug' => Yii::t('back', 'Алиас'),
            'show_preview' => Yii::t('back', 'Показать превью на странице новости'),
        ];
    }

    public function getCategory()
    {
        return $this->hasOne(NewsCategories::className(), ['id' => 'category_id']);
    }
}
