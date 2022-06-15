<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%banners}}".
 *
 * @property int $id
 * @property int $active
 * @property string|null $category
 * @property string|null $text
 * @property string|null $link
 * @property int $show_button
 * @property string|null $button_text
 * @property int $content_align
 */
class Banners extends \yii\db\ActiveRecord
{
    
    public $saveAndExit;
    
    function behaviors()
    {
        return [
            'images' => [
                'class' => 'agapofff\gallery\behaviors\AttachImages',
                'mode' => 'single',
                'quality' => 80,
                'galleryId' => 'banners',
                'allowExtensions' => ['jpg', 'jpeg', 'png'],
            ],
        ];
    }
    
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%banners}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['active', 'show_button', 'content_align', 'saveAndExit'], 'integer'],
            [['text', 'button_text'], 'string'],
            [['category', 'link'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('back', 'ID'),
            'active' => Yii::t('back', 'Активно'),
            'category' => Yii::t('back', 'Категория'),
            'text' => Yii::t('back', 'Текст'),
            'link' => Yii::t('back', 'Ссылка'),
            'show_button' => Yii::t('back', 'Показать кнопку'),
            'button_text' => Yii::t('back', 'Текст на кнопке'),
            'content_align' => Yii::t('back', 'Выровнять контент'),
        ];
    }
}
