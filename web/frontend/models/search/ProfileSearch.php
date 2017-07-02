<?php

namespace frontend\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\Profile;

/**
 * ProfileSearch represents the model behind the search form about `frontend\models\Profile`.
 */
class ProfileSearch extends Profile
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['a02_id', 'a01_id', 'c03_id', 'c02_id', 'a02_status', 'a02_usercreate', 'a02_userupdate'], 'integer'],
            [['a02_name', 'a02_flastname', 'a02_slastname', 'a02_photo', 'a02_datecreate', 'a02_dateupdate'], 'safe'],
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
        $query = Profile::find()->where(['a02_status'=>1]);

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
            'a02_id' => $this->a02_id,
            'a01_id' => $this->a01_id, ///
            'c03_id' => $this->c03_id,
            'c02_id' => $this->c02_id,
            'a02_status' => $this->a02_status,
            'a02_usercreate' => $this->a02_usercreate,
            'a02_datecreate' => $this->a02_datecreate,
            'a02_userupdate' => $this->a02_userupdate,
            'a02_dateupdate' => $this->a02_dateupdate,
        ]);

        $query->andFilterWhere(['like', 'a02_name', $this->a02_name])
            ->andFilterWhere(['like', 'a02_flastname', $this->a02_flastname])
            ->andFilterWhere(['like', 'a02_slastname', $this->a02_slastname])
            ->andFilterWhere(['like', 'a02_photo', $this->a02_photo]);

        return $dataProvider;
    }
}
