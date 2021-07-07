<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Lendbook;

/**
 * LendbookSearch represents the model behind the search form of `app\models\Lendbook`.
 */
class LendbookSearch extends Lendbook
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'book_id', 'customer_id', 'employee_id', 'condition_arrived'], 'integer'],
            [['date_lending', 'date_expire_at', 'date_actual_return'], 'safe'],
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
        $query = Lendbook::find();

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
            'book_id' => $this->book_id,
            'customer_id' => $this->customer_id,
            'employee_id' => $this->employee_id,
            'date_lending' => $this->date_lending,
            'date_expire_at' => $this->date_expire_at,
            'date_actual_return' => $this->date_actual_return,
            'condition_arrived' => $this->condition_arrived,
        ]);

        return $dataProvider;
    }
}
