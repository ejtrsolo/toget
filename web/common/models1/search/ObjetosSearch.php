<?php

namespace common\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Objetos;

/**
 * ObjetosSearch represents the model behind the search form about `common\models\Objetos`.
 */
class ObjetosSearch extends Objetos
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['c06_id', 'c05_tipo', 'c07_dispositivo', 'c08_persona', 'c06_status', 'c06_usercreate', 'c06_userupdate'], 'integer'],
            [['c06_nombre', 'c06_imagen', 'c06_datecreate', 'c06_dateupdate'], 'safe'],
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
    public function search($params, $id=null)
    {
        $query = Objetos::find();
        if($id){
            $query->where(['c08_persona'=>$id, 'c06_status'=>1]);
        }

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
            'c06_id' => $this->c06_id,
            'c05_tipo' => $this->c05_tipo,
            'c07_dispositivo' => $this->c07_dispositivo,
            'c08_persona' => $this->c08_persona,
            'c06_status' => $this->c06_status,
            'c06_usercreate' => $this->c06_usercreate,
            'c06_datecreate' => $this->c06_datecreate,
            'c06_userupdate' => $this->c06_userupdate,
            'c06_dateupdate' => $this->c06_dateupdate,
        ]);

        $query->andFilterWhere(['like', 'c06_nombre', $this->c06_nombre])
            ->andFilterWhere(['like', 'c06_imagen', $this->c06_imagen]);

        return $dataProvider;
    }
}
