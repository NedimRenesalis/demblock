<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Advert;

/**
 * AdvertSearch represents the model behind the search form about `common\models\Advert`.
 */
class AdvertSearch extends Advert
{

    public $company;
    public $order;

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
    public function search($params, $position)
    {
        $query = Advert::find()
            ->leftJoin('user', 'user_id=user.id');

        // add conditions that should always apply here

        $this->load($params);

        $order = SORT_DESC;
        if(isset($params['AdvertSearch']) && isset($params['AdvertSearch']['order']) && $params['AdvertSearch']['order'] == '2'){
            $order = SORT_ASC;
        }

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 10,
            ],
            'sort'=> ['defaultOrder' => ['start_advert'=>$order]]
        ]);


        if (!$this->validate()) {
            $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions

        if ($position) {
            $query->andFilterWhere(['or',
                ['like', 'position', $this->position],
                ['and', ['like', 'user.company_name', $this->position], ['anonymously' => 0]]]);
        }

        $query->andFilterWhere([
            'isPublished' => 1,
            'payment_status' => 1
        ]);

        $query->andFilterWhere(['>=', 'end_advert', ((int)Yii::$app->formatter->asTimestamp(date("Y-m-d H:i:s"))) + 2 * 60 * 60]);
        $query->andFilterWhere(['<=', 'start_advert',  ((int)Yii::$app->formatter->asTimestamp(date("Y-m-d H:i:s"))) + 2 * 60 * 60]);

        $query->andFilterWhere(['like', 'advert.location', $this->location])
            ->andFilterWhere(['like', 'advert.category', $this->category]);

        return $dataProvider;
    }
}
