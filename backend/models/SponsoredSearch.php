<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Sponsored;

/**
 * SponsoredSearch represents the model behind the search form about `backend\models\Sponsored`.
 */
class SponsoredSearch extends Sponsored
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'isPublished'], 'integer'],
            [['html','title'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
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
        $query = Sponsored::find();

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
            'isPublished' => $this->isPublished,
        ]);

        $query->andFilterWhere(['like', 'LOWER(html)', strtolower($this->html)]);
        $query->andFilterWhere(['like', 'LOWER(title)', strtolower($this->title)]);

        return $dataProvider;
    }
}
