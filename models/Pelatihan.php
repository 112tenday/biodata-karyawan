<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "pelatihan".
 *
 * @property int $id
 * @property int|null $biodata_id
 * @property string|null $nama_kursus
 * @property bool|null $sertifikat
 * @property int|null $tahun
 *
 * @property Biodata $biodata
 */
class Pelatihan extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'pelatihan';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['biodata_id', 'nama_kursus', 'tahun'], 'default', 'value' => null],
            [['sertifikat'], 'default', 'value' => 0],
            [['biodata_id', 'tahun'], 'default', 'value' => null],
            [['biodata_id', 'tahun'], 'integer'],
            [['sertifikat'], 'boolean'],
            [['nama_kursus'], 'string', 'max' => 255],
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
            'nama_kursus' => 'Nama Kursus',
            'sertifikat' => 'Sertifikat',
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
