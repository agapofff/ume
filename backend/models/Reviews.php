<?php

namespace backend\models;

use Yii;
use backend\models\Breeds;
use dektrium\user\models\User;
use dvizh\shop\models\Product;

/**
 * This is the model class for table "{{%reviews}}".
 *
 * @property int $id
 * @property int $active
 * @property int $user_id
 * @property string|null $pet_name
 * @property string|null $pet_photo
 * @property int $pet_breed
 * @property string|null $pet_birthday
 * @property int $rating
 * @property string $text
 * @property string|null $created
 * @property int $product_id
 * @property int $booster_id
 * @property string|null $language
 */
class Reviews extends \yii\db\ActiveRecord
{
    public $saveAndExit; 
    
    function behaviors()
    {
        return [
            'images' => [
                'class' => 'agapofff\gallery\behaviors\AttachImages',
                'mode' => 'gallery',
                'quality' => 80,
                'galleryId' => 'reviews',
                'allowExtensions' => ['jpg', 'jpeg', 'png'],
            ],
        ];
    }
    
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%reviews}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['active', 'user_id', 'pet_breed', 'rating', 'product_id', 'booster_id', 'saveAndExit'], 'integer'],
            [['user_id', 'pet_breed', 'rating', 'text'], 'required'],
            [['pet_birthday', 'created'], 'safe'],
            [['text'], 'string'],
            [['pet_name', 'pet_photo'], 'string', 'max' => 255],
            [['language'], 'string', 'max' => 2],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
            [['pet_breed'], 'exist', 'skipOnError' => true, 'targetClass' => Breeds::className(), 'targetAttribute' => ['pet_breed' => 'id']],
            [['product_id'], 'exist', 'skipOnError' => true, 'targetClass' => Product::className(), 'targetAttribute' => ['product_id' => 'id']],
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
            'user_id' => Yii::t('back', 'Пользователь'),
            'pet_name' => Yii::t('back', 'Питомец'),
            'pet_photo' => Yii::t('back', 'Фото'),
            'pet_breed' => Yii::t('back', 'Порода'),
            'pet_birthday' => Yii::t('back', 'Дата рождения'),
            'rating' => Yii::t('back', 'Рейтинг'),
            'text' => Yii::t('back', 'Отзыв'),
            'created' => Yii::t('back', 'Дата'),
            'product_id' => Yii::t('back', 'Товар'),
            'booster_id' => Yii::t('back', 'Бустер'),
            'language' => Yii::t('back', 'Язык'),
        ];
    }
    
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
    
    public function getBreed()
    {
        return $this->hasOne(Breeds::className(), ['id' => 'pet_breed']);
    }
    
    public function getProduct()
    {
        return $this->hasOne(Product::className(), ['id' => 'product_id']);
    }
}
