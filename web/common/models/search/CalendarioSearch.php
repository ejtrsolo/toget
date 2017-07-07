<?php

namespace common\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Recomendaciones;

/**
 * CalendarioSearch represents the model behind the search form about `common\models\Recomendaciones`.
 */
class CalendarioSearch extends Recomendaciones
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['r01_id', 'c08_persona', 'a01_id', 'c06_objeto', 'r01_repeticion_tiempo', 'r01_status', 'r01_usercreate', 'r01_userupdate'], 'integer'],
            [['r01_fecha_inicio', 'r01_fecha_fin', 'r01_hora', 'r01_descripcion', 'r01_datecreate', 'r01_dateupdate'], 'safe'],
            [['r01_duracion_leds'], 'number'],
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
        $query = Recomendaciones::find();

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
            'r01_id' => $this->r01_id,
            'c08_persona' => $this->c08_persona,
            'a01_id' => $this->a01_id,
            'c06_objeto' => $this->c06_objeto,
            'r01_fecha_inicio' => $this->r01_fecha_inicio,
            'r01_fecha_fin' => $this->r01_fecha_fin,
            'r01_repeticion_tiempo' => $this->r01_repeticion_tiempo,
            'r01_hora' => $this->r01_hora,
            'r01_duracion_leds' => $this->r01_duracion_leds,
            'r01_status' => $this->r01_status,
            'r01_usercreate' => $this->r01_usercreate,
            'r01_datecreate' => $this->r01_datecreate,
            'r01_userupdate' => $this->r01_userupdate,
            'r01_dateupdate' => $this->r01_dateupdate,
        ]);

        $query->andFilterWhere(['like', 'r01_descripcion', $this->r01_descripcion]);

        return $dataProvider;
    }
}
