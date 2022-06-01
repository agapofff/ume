<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Reviews;

/**
 * ReviewsSearch represents the model behind the search form of `backend\models\Reviews`.
 */
class ReviewsSearch extends Reviews
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'active', 'user_id', 'pet_breed', 'rating', 'product_id', 'booster_id'], 'integer'],
            [['pet_name', 'pet_photo', 'pet_birthday', 'text', 'created', 'language'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Reviews::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'active' => $this->active,
            'user_id' => $this->user_id,
            'pet_breed' => $this->pet_breed,
            'pet_birthday' => $this->pet_birthday,
            'rating' => $this->rating,
            'created' => $this->created,
            'product_id' => $this->product_id,
            'booster_id' => $this->booster_id,
        ]);

        $query->andFilterWhere(['like', 'pet_name', $this->pet_name])
            ->andFilterWhere(['like', 'pet_photo', $this->pet_photo])
            ->andFilterWhere(['like', 'text', $this->text])
            ->andFilterWhere(['like', 'language', $this->language]);

        return $dataProvider;
    }
}
