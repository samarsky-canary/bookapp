<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Employee;

/**
 * EmployeeSearch represents the model behind the search form of `app\models\Employee`.
 */
class EmployeeSearch extends Employee
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['firstname', 'secondname', 'thirdname', 'passport_series', 'passport_code', 'post'], 'safe'],
            [['id'], 'integer'],
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
        $query = Employee::find();

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
        ]);

        $query->andFilterWhere(['ilike', 'firstname', $this->firstname])
            ->andFilterWhere(['ilike', 'secondname', $this->secondname])
            ->andFilterWhere(['ilike', 'thirdname', $this->thirdname])
            ->andFilterWhere(['ilike', 'passport_series', $this->passport_series])
            ->andFilterWhere(['ilike', 'passport_code', $this->passport_code])
            ->andFilterWhere(['ilike', 'post', $this->post]);

        return $dataProvider;
    }
}
