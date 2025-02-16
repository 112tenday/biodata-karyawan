<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "pendidikan".
 *
 * @property int $id
 * @property int|null $biodata_id
 * @property string|null $jenjang
 * @property string|null $institusi
 * @property string|null $jurusan
 * @property int|null $tahun_lulus
 * @property float|null $ipk
 *
 * @property Biodata $biodata
 */
class Pendidikan extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'pendidikan';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['jenjang', 'institusi', 'jurusan', 'tahun_lulus', 'ipk'], 'required'],
            [['tahun_lulus'], 'integer', 'min' => 1900, 'max' => date('Y')],
            [['ipk'], 'number', 'min' => 0, 'max' => 4],
            [['jenjang', 'institusi', 'jurusan'], 'string', 'max' => 255],
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
            'jenjang' => 'Jenjang',
            'institusi' => 'Institusi',
            'jurusan' => 'Jurusan',
            'tahun_lulus' => 'Tahun Lulus',
            'ipk' => 'Ipk',
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
