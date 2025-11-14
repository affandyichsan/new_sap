<?php

namespace app\models\search;

use app\models\ActionSap;
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
            [['id_sap_reconcile', 'approval_departement', 'approval_she', 'final_approval'], 'integer'],
            [['nrp', 'jenis_reconcile', 'sub_jenis_reconcile', 'reconcile_json', 'week', 'bulan', 'approvment_departement', 'approvment_she', 'approvment_final', 'created_at', 'updated_at'], 'safe'],
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
        $data  = ActionSap::getDataUser();
        $query = @SapReconcile::find()->where(['nrp'=>$data['nrp']]);

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
            'approval_departement' => $this->approval_departement,
            'approval_she' => $this->approval_she,
            'final_approval' => $this->final_approval,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'nrp', $this->nrp])
            ->andFilterWhere(['like', 'jenis_reconcile', $this->jenis_reconcile])
            ->andFilterWhere(['like', 'sub_jenis_reconcile', $this->sub_jenis_reconcile])
            ->andFilterWhere(['like', 'reconcile_json', $this->reconcile_json])
            ->andFilterWhere(['like', 'week', $this->week])
            ->andFilterWhere(['like', 'bulan', $this->bulan])
            ->andFilterWhere(['like', 'approvment_departement', $this->approvment_departement])
            ->andFilterWhere(['like', 'approvment_she', $this->approvment_she])
            ->andFilterWhere(['like', 'approvment_final', $this->approvment_final]);

        return $dataProvider;
    }
}
