<?php

namespace common\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Colores;

/**
 * ColoresSearch represents the model behind the search form about `common\models\Colores`.
 */
class ColoresSearch extends Colores
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['c01_id', 'c01_r', 'c01_g', 'c01_b', 'c01_status', 'c01_usercreate', 'c01_userupdate'], 'integer'],
            [['c01_nombre', 'c01_datecreate', 'c01_dateupdate'], 'safe'],
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
    public function search($params, $active=1)
    {
        $query = Colores::find()->where(['c01_status'=>$active]);

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
            'c01_id' => $this->c01_id,
            'c01_r' => $this->c01_r,
            'c01_g' => $this->c01_g,
            'c01_b' => $this->c01_b,
            'c01_status' => $this->c01_status,
            'c01_usercreate' => $this->c01_usercreate,
            'c01_datecreate' => $this->c01_datecreate,
            'c01_userupdate' => $this->c01_userupdate,
            'c01_dateupdate' => $this->c01_dateupdate,
        ]);

        $query->andFilterWhere(['like', 'c01_nombre', $this->c01_nombre]);

        return $dataProvider;
    }
}
