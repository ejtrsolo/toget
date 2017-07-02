<?php

namespace common\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Mensajes;

/**
 * MensajesSearch represents the model behind the search form about `common\models\Mensajes`.
 */
class MensajesSearch extends Mensajes
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['c04_id', 'c05_tipo', 'g02_tipo_mjs', 'c04_status', 'c04_usercreate', 'c04_userupdate'], 'integer'],
            [['c04_mensaje', 'c04_datecreate', 'c04_dateupdate'], 'safe'],
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
        $query = Mensajes::find()->where(['c04_status'=>$active]);

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
            'c04_id' => $this->c04_id,
            'c05_tipo' => $this->c05_tipo,
            'g02_tipo_mjs' => $this->g02_tipo_mjs,
            'c04_status' => $this->c04_status,
            'c04_usercreate' => $this->c04_usercreate,
            'c04_datecreate' => $this->c04_datecreate,
            'c04_userupdate' => $this->c04_userupdate,
            'c04_dateupdate' => $this->c04_dateupdate,
        ]);

        $query->andFilterWhere(['like', 'c04_mensaje', $this->c04_mensaje]);

        return $dataProvider;
    }
}
