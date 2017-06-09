<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\ClientUser;

/**
 * ClientUserSearch represents the model behind the search form about `backend\models\ClientUser`.
 */
class ClientUserSearch extends ClientUser
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'user_id', 'client_id'], 'integer'],
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
        $query = ClientUser::find();

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
            'user_id' => $this->user_id,
            'client_id' => $this->client_id,
        ]);

        return $dataProvider;
    }
/*
    // create ActiveQuery
    $query = ClientUser::find();
    // Important: lets join the query with our previously mentioned relations
    // I do not make any other configuration like aliases or whatever, feel free
    // to investigate that your self
    $query->joinWith(['profile', 'name']);

    $dataProvider = new ActiveDataProvider([
        'query' => $query,
    ]);

    // Important: here is how we set up the sorting
    // The key is the attribute name on our "TourSearch" instance
    $dataProvider->sort->attributes['profile'] = [
        // The tables are the ones our relation are configured to
        // in my case they are prefixed with "tbl_"
        'asc' => ['profile.name' => SORT_ASC],
        'desc' => ['profile.name' => SORT_DESC],
    ];
    // Lets do the same with country now
    $dataProvider->sort->attributes['clientUser'] = [
        'asc' => ['clientUser.user_id' => SORT_ASC],
        'desc' => ['clientUser.user_id' => SORT_DESC],
    ];
    // No search? Then return data Provider
    if (!($this->load($params) && $this->validate())) {
        return $dataProvider;
    }
    // We have to do some search... Lets do some magic
    $query->andFilterWhere([
        //... other searched attributes here
    ])
    // Here we search the attributes of our relations using our previously configured
    // ones in "TourSearch"
    ->andFilterWhere(['like', 'profile.name', $this->profile])
    ->andFilterWhere(['like', 'clientUser.name', $this->clientuser]);

    return $dataProvider;
}*/

}
