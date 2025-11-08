<?php

namespace app\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\SapReconcile;

/**
 * SapReconcileSearch represents the model behind the search form of `app\models\SapReconcile`.
 */
class SapReconcileSearch extends SapReconcile
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_sap_reconcile', 'id_sap_user'], 'integer'],
            [['reconcile_json', 'jenis_reconcile', 'week', 'bulan', 'created_at', 'updated_at', 'approvment'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
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
     * @param string|null $formName Form name to be used into `->load()` method.
     *
     * @return ActiveDataProvider
     */
    public function search($params, $formName = null)
    {
        $query = SapReconcile::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params, $formName);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id_sap_reconcile' => $this->id_sap_reconcile,
            'id_sap_user' => $this->id_sap_user,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'reconcile_json', $this->reconcile_json])
            ->andFilterWhere(['like', 'jenis_reconcile', $this->jenis_reconcile])
            ->andFilterWhere(['like', 'week', $this->week])
            ->andFilterWhere(['like', 'bulan', $this->bulan])
            ->andFilterWhere(['like', 'approvment', $this->approvment]);

        return $dataProvider;
    }
}
