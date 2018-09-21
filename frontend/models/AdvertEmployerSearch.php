<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Advert;

/**
 * AdvertSearch represents the model behind the search form about `common\models\Advert`.
 */
class AdvertEmployerSearch extends Advert
{

    public $company;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'start_advert', 'end_advert', 'number_of_days', 'created_at', 'isPublished', 'number_of_positions', 'type', 'anonymously', 'payment', 'user_id', 'payment_status'], 'integer'],
            [['position', 'web_address', 'contact_email', 'contact_person', 'location', 'category', 'description', 'company'], 'safe'],
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
    public function search($params, $type)
    {
        $query = Advert::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 5,
            ],
             'sort'=> ['defaultOrder' => ['start_advert'=>SORT_DESC]]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions

        $query->andFilterWhere([
            'isPublished' => 1,
            'payment_status' => 1,
            'user_id' => $this->user_id,
        ]);

        if($type == "active"){
            $query->andFilterWhere(['>=', 'end_advert', Yii::$app->formatter->asTimestamp(date("Y-m-d H:i:s"))]);

        }else if($type == "inactive"){
            $query->andFilterWhere(['<', 'end_advert', Yii::$app->formatter->asTimestamp(date("Y-m-d H:i:s"))]);
        }

        return $dataProvider;
    }
}
