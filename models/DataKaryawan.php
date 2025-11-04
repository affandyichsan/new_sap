<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "data_karyawan".
 *
 * @property int $id_data_karyawan
 * @property string|null $nrp
 * @property string|null $nrp_bib
 * @property string|null $status
 * @property string|null $lemari_file
 * @property int|null $no_file
 * @property string|null $history_file
 * @property string|null $nama_karyawan
 * @property string|null $perusahaan
 * @property string|null $departemen
 * @property string|null $jabatan
 * @property string|null $update_jabatan
 * @property string|null $jenis_kelamin
 * @property string|null $agama
 * @property string|null $tempat_lahir
 * @property string|null $tanggal_lahir
 * @property string|null $poh
 * @property string|null $kategori_poh
 * @property string|null $doh_site_bib
 * @property string|null $keretangan_in
 * @property string|null $doh_ppa
 * @property int|null $umur_tahun
 * @property string|null $masa_kerja
 * @property string|null $kontrak_status
 * @property string|null $marital_status_ss6
 * @property string|null $mess
 * @property string|null $nama_mess
 * @property string|null $kategori_jabatan
 * @property string $created_at
 * @property string $updated_at
 */
class DataKaryawan extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'data_karyawan';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nrp', 'nrp_bib', 'status', 'lemari_file', 'no_file', 'history_file', 'nama_karyawan', 'perusahaan', 'departemen', 'jabatan', 'update_jabatan', 'jenis_kelamin', 'agama', 'tempat_lahir', 'tanggal_lahir', 'poh', 'kategori_poh', 'doh_site_bib', 'keretangan_in', 'doh_ppa', 'umur_tahun', 'masa_kerja', 'kontrak_status', 'marital_status_ss6', 'mess', 'nama_mess', 'kategori_jabatan'], 'default', 'value' => null],
            [['no_file', 'umur_tahun'], 'integer'],
            [['tanggal_lahir', 'doh_site_bib', 'doh_ppa', 'created_at', 'updated_at'], 'safe'],
            [['nrp', 'nrp_bib', 'status', 'lemari_file', 'history_file', 'kategori_poh', 'marital_status_ss6', 'nama_mess', 'kategori_jabatan'], 'string', 'max' => 50],
            [['nama_karyawan', 'jabatan', 'update_jabatan', 'tempat_lahir', 'masa_kerja', 'kontrak_status'], 'string', 'max' => 255],
            [['perusahaan', 'departemen', 'agama', 'poh'], 'string', 'max' => 100],
            [['jenis_kelamin'], 'string', 'max' => 10],
            [['keretangan_in', 'mess'], 'string', 'max' => 150],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_data_karyawan' => 'Id Data Karyawan',
            'nrp' => 'Nrp',
            'nrp_bib' => 'Nrp Bib',
            'status' => 'Status',
            'lemari_file' => 'Lemari File',
            'no_file' => 'No File',
            'history_file' => 'History File',
            'nama_karyawan' => 'Nama Karyawan',
            'perusahaan' => 'Perusahaan',
            'departemen' => 'Departemen',
            'jabatan' => 'Jabatan',
            'update_jabatan' => 'Update Jabatan',
            'jenis_kelamin' => 'Jenis Kelamin',
            'agama' => 'Agama',
            'tempat_lahir' => 'Tempat Lahir',
            'tanggal_lahir' => 'Tanggal Lahir',
            'poh' => 'Poh',
            'kategori_poh' => 'Kategori Poh',
            'doh_site_bib' => 'Doh Site Bib',
            'keretangan_in' => 'Keretangan In',
            'doh_ppa' => 'Doh Ppa',
            'umur_tahun' => 'Umur Tahun',
            'masa_kerja' => 'Masa Kerja',
            'kontrak_status' => 'Kontrak Status',
            'marital_status_ss6' => 'Marital Status Ss6',
            'mess' => 'Mess',
            'nama_mess' => 'Nama Mess',
            'kategori_jabatan' => 'Kategori Jabatan',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

}
