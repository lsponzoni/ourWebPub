<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Publicador;

/**
 * PublicadorSearch represents the model behind the search form about `app\models\Publicador`.
 */
class PublicadorSearch extends Publicador
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idPublicador', 'convidadoPor'], 'integer'],
            [['nome', 'login', 'senha', 'endereco', 'email'], 'safe'],
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
        $query = Publicador::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'idPublicador' => $this->idPublicador,
            'convidadoPor' => $this->convidadoPor,
        ]);

        $query->andFilterWhere(['like', 'nome', $this->nome])
            ->andFilterWhere(['like', 'login', $this->login])
            ->andFilterWhere(['like', 'senha', $this->senha])
            ->andFilterWhere(['like', 'endereco', $this->endereco])
            ->andFilterWhere(['like', 'email', $this->email]);

        return $dataProvider;
    }
}
