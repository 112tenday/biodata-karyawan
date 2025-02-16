<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "pekerjaan".
 *
 * @property int $id
 * @property int|null $biodata_id
 * @property string|null $nama_perusahaan
 * @property string|null $posisi
 * @property float|null $pendapatan
 * @property int|null $tahun
 *
 * @property Biodata $biodata
 */
class Pekerjaan extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'pekerjaan';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['biodata_id', 'nama_perusahaan', 'posisi', 'pendapatan', 'tahun'], 'default', 'value' => null],
            [['biodata_id', 'tahun'], 'default', 'value' => null],
            [['biodata_id', 'tahun'], 'integer'],
            [['pendapatan'], 'number'],
            [['nama_perusahaan'], 'string', 'max' => 255],
            [['posisi'], 'string', 'max' => 100],
            [['biodata_id'], 'exist', 'skipOnError' => true, 'targetClass' => Biodata::class, 'targetAttribute' => ['biodata_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'biodata_id' => 'Biodata ID',
            'nama_perusahaan' => 'Nama Perusahaan',
            'posisi' => 'Posisi',
            'pendapatan' => 'Pendapatan',
            'tahun' => 'Tahun',
        ];
    }

    /**
     * Gets query for [[Biodata]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getBiodata()
    {
        return $this->hasOne(Biodata::class, ['id' => 'biodata_id']);
    }

}
