<?php

namespace common\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Relacion;

/**
 * RelacionSearch represents the model behind the search form about `common\models\Relacion`.
 */
class RelacionSearch extends Relacion
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['r03_id', 'c01_color', 'a01_id', 'c08_persona', 'r03_status', 'r03_usercreate', 'r03_userupdate', 'cambiarAmigos', 'agregarUsuarios', 'hacerRecomendaciones', 'verCalendario', 'asignarObjetos', 'cambiarPermisos', 'cambiarObjetos'], 'integer'],
            [['r03_datecreate', 'r03_dateupdate'], 'safe'],
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
        $query = Relacion::find();
        if($id){
            $query->where(['c08_persona'=>$id]);
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
            'r03_id' => $this->r03_id,
            'c01_color' => $this->c01_color,
            'a01_id' => $this->a01_id,
            'c08_persona' => $this->c08_persona,
            'r03_status' => $this->r03_status,
            'r03_usercreate' => $this->r03_usercreate,
            'r03_datecreate' => $this->r03_datecreate,
            'r03_userupdate' => $this->r03_userupdate,
            'r03_dateupdate' => $this->r03_dateupdate,
            'cambiarAmigos' => $this->cambiarAmigos,
            'agregarUsuarios' => $this->agregarUsuarios,
            'hacerRecomendaciones' => $this->hacerRecomendaciones,
            'verCalendario' => $this->verCalendario,
            'asignarObjetos' => $this->asignarObjetos,
            'cambiarPermisos' => $this->cambiarPermisos,
            'cambiarObjetos' => $this->cambiarObjetos,
        ]);

        return $dataProvider;
    }
}
