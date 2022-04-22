<?php

namespace backend\models;

use Yii;
use yii\web\UploadedFile;

class Common extends \yii\db\ActiveRecord
{
    
    public $imageFile;
    
    public $backgroundFile;
    
    public static function tableName()
    {
        return '{{%common}}';
    }

    public function rules()
    {
        return [
            [['title_ru', 'title_vi', 'datetime_ru', 'datetime_vi'], 'required'],
            [['created_at', 'updated_at', 'datetime_ru', 'datetime_vi'], 'safe'],
            [['title_ru', 'title_vi', 'image', 'background', 'meta_title_ru', 'meta_title_vi', 'meta_description_ru', 'meta_description_vi'], 'string', 'max' => 255],
            [['active_color'], 'string', 'max' => 255],
            [['imageFile'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg'],
            [['backgroundFile'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => Yii::t('back', 'ID'),
            'title_ru' => Yii::t('back', 'Заголовок по-русски'),
            'title_vi' => Yii::t('back', 'Заголовок по-вьетнамски'),
            'datetime_ru' => Yii::t('back', 'Дата и время по-русски'),
            'datetime_vi' => Yii::t('back', 'Дата и время по-вьетнамски'),
            'image' => Yii::t('back', 'Основное изображение'),
            'imageFile' => Yii::t('back', 'Основное изображение'),
            'background' => Yii::t('back', 'Фоновое изображение'),
            'backgroundFile' => Yii::t('back', 'Фоновое изображение'),
            'active_color' => Yii::t('back', 'Активный цвет'),
            'meta_title_ru' => Yii::t('back', 'Мета-тэг title по-русски'),
            'meta_title_vi' => Yii::t('back', 'Мета-тэг title по-вьетнамски'),
            'meta_description_ru' => Yii::t('back', 'Мета-тэг description по-русски'),
            'meta_description_vi' => Yii::t('back', 'Мета-тэг description по-вьетнамски'),
            'created_at' => Yii::t('back', 'Created At'),
            'updated_at' => Yii::t('back', 'Updated At'),
        ];
    }
    
    public function upload($fileName, $field)
    {
        if ($this->validate()) {
            switch ($field) {
                case 'image': 
                    $folder = 'main/'; 
                    break;
                case 'background': 
                    $folder = 'backgrounds/'; 
                    break;
                default: 
                    $folder = ''; 
                    break;
            }
            $this->{$field.'File'}->saveAs(Yii::getAlias('@frontend') . '/web/images/' . $folder . $fileName . '.' . $this->{$field.'File'}->extension);
            return true;
        } else {
            return false;
        }
    }
}
