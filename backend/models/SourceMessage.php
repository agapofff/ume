<?php

namespace backend\models;

use Yii;

class SourceMessage extends \yii\db\ActiveRecord
{
    
    public $saveAndExit;
    
    public static function tableName()
    {
        return '{{%source_message}}';
    }

    public function rules()
    {
        return [
            [['message'], 'string'],
            [['saveAndExit'], 'integer'],
            [['category'], 'string', 'max' => 255],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => Yii::t('back', 'ID'),
            'category' => Yii::t('back', 'Категория'),
            'message' => Yii::t('back', 'Константа'),
        ];
    }

    public function getMessages()
    {
        return $this->hasMany(Message::className(), ['id' => 'id']);
    }
}
