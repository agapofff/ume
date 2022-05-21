<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%breeds}}".
 *
 * @property int $id
 * @property string|null $name
 */
class Breeds extends \yii\db\ActiveRecord
{
    public $saveAndExit;
    
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%breeds}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['active', 'saveAndExit'], 'integer'],
            [['name'], 'string'],
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
            'name' => Yii::t('back', 'Порода'),
        ];
    }
}
