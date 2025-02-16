<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Biodata;

/**
 * BiodataSearch represents the model behind the search form of `app\models\Biodata`.
 */
class BiodataSearch extends Biodata
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'user_id'], 'integer'],
            [['posisi_dilamar', 'nama', 'no_ktp', 'tempat_lahir', 'tanggal_lahir', 'jenis_kelamin', 'agama', 'golongan_darah', 'status', 'alamat_ktp', 'alamat_tinggal', 'email', 'no_telp', 'kontak_darurat', 'skill', 'created_at'], 'safe'],
            [['bersedia_ditempatkan'], 'boolean'],
            [['penghasilan_diharapkan'], 'number'],
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
        $query = Biodata::find();

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
            'user_id' => $this->user_id,
            'tanggal_lahir' => $this->tanggal_lahir,
            'bersedia_ditempatkan' => $this->bersedia_ditempatkan,
            'penghasilan_diharapkan' => $this->penghasilan_diharapkan,
            'created_at' => $this->created_at,
        ]);

        $query->andFilterWhere(['ilike', 'posisi_dilamar', $this->posisi_dilamar])
            ->andFilterWhere(['ilike', 'nama', $this->nama])
            ->andFilterWhere(['ilike', 'no_ktp', $this->no_ktp])
            ->andFilterWhere(['ilike', 'tempat_lahir', $this->tempat_lahir])
            ->andFilterWhere(['ilike', 'jenis_kelamin', $this->jenis_kelamin])
            ->andFilterWhere(['ilike', 'agama', $this->agama])
            ->andFilterWhere(['ilike', 'golongan_darah', $this->golongan_darah])
            ->andFilterWhere(['ilike', 'status', $this->status])
            ->andFilterWhere(['ilike', 'alamat_ktp', $this->alamat_ktp])
            ->andFilterWhere(['ilike', 'alamat_tinggal', $this->alamat_tinggal])
            ->andFilterWhere(['ilike', 'email', $this->email])
            ->andFilterWhere(['ilike', 'no_telp', $this->no_telp])
            ->andFilterWhere(['ilike', 'kontak_darurat', $this->kontak_darurat])
            ->andFilterWhere(['ilike', 'skill', $this->skill]);

        return $dataProvider;
    }
}
