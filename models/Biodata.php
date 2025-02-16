<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "biodata".
 *
 * @property int $id
 * @property int|null $user_id
 * @property string|null $posisi_dilamar
 * @property string|null $nama
 * @property string $no_ktp
 * @property string|null $tempat_lahir
 * @property string|null $tanggal_lahir
 * @property string|null $jenis_kelamin
 * @property string|null $agama
 * @property string|null $golongan_darah
 * @property string|null $status
 * @property string|null $alamat_ktp
 * @property string|null $alamat_tinggal
 * @property string|null $email
 * @property string|null $no_telp
 * @property string|null $kontak_darurat
 * @property string|null $skill
 * @property bool|null $bersedia_ditempatkan
 * @property float|null $penghasilan_diharapkan
 * @property string|null $created_at
 *
 * @property Pekerjaan[] $pekerjaans
 * @property Pelatihan[] $pelatihans
 * @property Pendidikan[] $pendidikans
 * @property Users $user
 */
class Biodata extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'biodata';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id'], 'integer'],
            [['no_ktp'], 'required'],
            [['tanggal_lahir'], 'date', 'format' => 'php:Y-m-d'], // Pastikan format tanggal sesuai dengan database
            [['created_at'], 'safe'],
            [['alamat_ktp', 'alamat_tinggal', 'skill'], 'string'],
            [['bersedia_ditempatkan'], 'boolean'],
            [['penghasilan_diharapkan'], 'number'],
            [['posisi_dilamar', 'tempat_lahir'], 'string', 'max' => 100], // Pastikan max 100 karakter
            [['nama', 'email', 'kontak_darurat'], 'string', 'max' => 255],
            [['no_ktp', 'status', 'no_telp'], 'string', 'max' => 20],
            [['jenis_kelamin'], 'string', 'max' => 10],
            [['agama'], 'string', 'max' => 50],
            [['golongan_darah'], 'string', 'max' => 5],
            [['no_ktp'], 'unique'],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => Users::class, 'targetAttribute' => ['user_id' => 'id']],
        ];
    }
    

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'posisi_dilamar' => 'Posisi Dilamar',
            'nama' => 'Nama',
            'no_ktp' => 'No KTP',
            'tempat_lahir' => 'Tempat Lahir',
            'tanggal_lahir' => 'Tanggal Lahir',
            'jenis_kelamin' => 'Jenis Kelamin',
            'agama' => 'Agama',
            'golongan_darah' => 'Golongan Darah',
            'status' => 'Status',
            'alamat_ktp' => 'Alamat KTP',
            'alamat_tinggal' => 'Alamat Tinggal',
            'email' => 'Email',
            'no_telp' => 'No Telepon',
            'kontak_darurat' => 'Kontak Darurat',
            'skill' => 'Keahlian',
            'bersedia_ditempatkan' => 'Bersedia Ditempatkan',
            'penghasilan_diharapkan' => 'Penghasilan Diharapkan',
            'created_at' => 'Dibuat Pada',
        ];
    }

 
    public function beforeSave($insert)
    {
        if ($insert) {
            if (!empty($this->tanggal_lahir)) {
                $this->tanggal_lahir = date('Y-m-d', strtotime($this->tanggal_lahir));
            }
            $this->created_at = date('Y-m-d H:i:s');
        }
        return parent::beforeSave($insert);
    }
    

    public function getTempatTanggalLahir()
    {
        if ($this->tempat_lahir && $this->tanggal_lahir) {
            return $this->tempat_lahir . ', ' . Yii::$app->formatter->asDate($this->tanggal_lahir, 'php:d-m-Y');
        }
        return 'Data tidak tersedia';
    }
    

    

    /**
     * Gets query for [[Pekerjaans]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPekerjaans()
    {
        return $this->hasMany(Pekerjaan::class, ['biodata_id' => 'id']);
    }

    /**
     * Gets query for [[Pelatihans]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPelatihans()
    {
        return $this->hasMany(Pelatihan::class, ['biodata_id' => 'id']);
    }

    /**
     * Gets query for [[Pendidikans]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPendidikans()
    {
        return $this->hasMany(Pendidikan::class, ['biodata_id' => 'id']);
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(Users::class, ['id' => 'user_id']);
    }
}
