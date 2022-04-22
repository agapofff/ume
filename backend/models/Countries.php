<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%countries}}".
 *
 * @property int $id
 * @property int $active
 * @property int $ordering
 * @property string|null $name
 * @property int $slug
 *
 * @property Cities[] $cities
 * @property Registration[] $registrations
 */
class Countries extends \yii\db\ActiveRecord
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
    
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%countries}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['active', 'ordering', 'saveAndExit'], 'integer'],
            [['name', 'slug', 'iso'], 'string'],
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
            'ordering' => Yii::t('back', 'Порядок'),
            'name' => Yii::t('back', 'Название'),
            'slug' => Yii::t('back', 'Алиас'),
            'iso' => Yii::t('back', 'ISO'),
        ];
    }

    /**
     * Gets query for [[Cities]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCities()
    {
        return $this->hasMany(Cities::className(), ['country_id' => 'id']);
    }

    /**
     * Gets query for [[Registrations]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRegistrations()
    {
        return $this->hasMany(Registration::className(), ['country' => 'id']);
    }
}
