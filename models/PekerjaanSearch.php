<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Pekerjaan;

/**
 * PekerjaanSearch represents the model behind the search form of `app\models\Pekerjaan`.
 */
class PekerjaanSearch extends Pekerjaan
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'biodata_id', 'tahun'], 'integer'],
            [['nama_perusahaan', 'posisi'], 'safe'],
            [['pendapatan'], 'number'],
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
        $query = Pekerjaan::find();

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
            'id' => $this->id,
            'biodata_id' => $this->biodata_id,
            'pendapatan' => $this->pendapatan,
            'tahun' => $this->tahun,
        ]);

        $query->andFilterWhere(['ilike', 'nama_perusahaan', $this->nama_perusahaan])
            ->andFilterWhere(['ilike', 'posisi', $this->posisi]);

        return $dataProvider;
    }
}
