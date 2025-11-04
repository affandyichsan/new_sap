<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "sap_data_view".
 *
 * @property int $id_sap_data_analytic
 * @property string|null $id_sap_indicator_plan
 * @property string|null $nrp
 * @property string|null $nrp_bib
 * @property string|null $perusahaan
 * @property string|null $departement
 * @property string|null $jabatan
 * @property string|null $golongan_jabatan
 * @property string|null $week
 * @property string|null $tahun
 * @property string|null $date
 * @property int|null $kta
 * @property int|null $tta
 * @property int|null $obs
 * @property int|null $ins
 * @property int|null $s_meet
 * @property int|null $cc
 * @property int|null $wuc
 * @property int|null $opk
 * @property string|null $opk_detail
 * @property string|null $note_per_date
 * @property string|null $kode_area
 * @property string|null $nama_karyawan
 * @property int|null $obs_a
 * @property int|null $ins_a
 * @property int|null $kta_a
 * @property int|null $tta_a
 * @property int|null $wuc_a
 * @property int|null $cc_a
 * @property int|null $s_meet_a
 * @property int|null $opk_a
 * @property string|null $opk_a_detail
 * @property float|null $obs_ach
 * @property float|null $ins_ach
 * @property float|null $kta_ach
 * @property float|null $tta_ach
 * @property float|null $wuc_ach
 * @property float|null $cc_ach
 * @property float|null $smeet_ach
 * @property float|null $opk_ach
 * @property string $total_ach
 * @property string $created_at
 * @property string $updated_at
 */
class SapDataView extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'sap_data_view';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_sap_indicator_plan', 'nrp', 'nrp_bib', 'perusahaan', 'departement', 'jabatan', 'golongan_jabatan', 'week', 'tahun', 'date', 'kta', 'tta', 'obs', 'ins', 's_meet', 'cc', 'wuc', 'opk', 'opk_detail', 'note_per_date', 'kode_area', 'nama_karyawan', 'obs_a', 'ins_a', 'kta_a', 'tta_a', 'wuc_a', 'cc_a', 's_meet_a', 'opk_a', 'opk_a_detail', 'obs_ach', 'ins_ach', 'kta_ach', 'tta_ach', 'wuc_ach', 'cc_ach', 'smeet_ach', 'opk_ach'], 'default', 'value' => null],
            [['date', 'created_at', 'updated_at'], 'safe'],
            [['kta', 'tta', 'obs', 'ins', 's_meet', 'cc', 'wuc', 'opk', 'obs_a', 'ins_a', 'kta_a', 'tta_a', 'wuc_a', 'cc_a', 's_meet_a', 'opk_a'], 'integer'],
            [['opk_detail', 'note_per_date', 'kode_area', 'opk_a_detail'], 'string'],
            [['obs_ach', 'ins_ach', 'kta_ach', 'tta_ach', 'wuc_ach', 'cc_ach', 'smeet_ach', 'opk_ach'], 'number'],
            [['total_ach'], 'required'],
            [['id_sap_indicator_plan', 'nrp', 'nrp_bib', 'perusahaan', 'departement', 'jabatan', 'golongan_jabatan', 'week', 'tahun'], 'string', 'max' => 50],
            [['nama_karyawan'], 'string', 'max' => 255],
            [['total_ach'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_sap_data_analytic' => 'Id Sap Data Analytic',
            'id_sap_indicator_plan' => 'Id Sap Indicator Plan',
            'nrp' => 'NRP',
            'nrp_bib' => 'NRP BIB',
            'perusahaan' => 'Perusahaan',
            'departement' => 'Departement',
            'jabatan' => 'Jabatan',
            'golongan_jabatan' => 'Golongan Jabatan',
            'week' => 'Week',
            'tahun' => 'Tahun',
            'date' => 'Date',
            'kta' => 'Kta',
            'tta' => 'Tta',
            'obs' => 'Obs',
            'ins' => 'Ins',
            's_meet' => 'S Meet',
            'cc' => 'Cc',
            'wuc' => 'Wuc',
            'opk' => 'Opk',
            'opk_detail' => 'Opk Detail',
            'note_per_date' => 'Note Per Date',
            'kode_area' => 'Kode Area',
            'nama_karyawan' => 'Nama Karyawan',
            'obs_a' => 'Obs A',
            'ins_a' => 'Ins A',
            'kta_a' => 'Kta A',
            'tta_a' => 'Tta A',
            'wuc_a' => 'Wuc A',
            'cc_a' => 'Cc A',
            's_meet_a' => 'S Meet A',
            'opk_a' => 'Opk A',
            'opk_a_detail' => 'Opk A Detail',
            'obs_ach' => 'Obs Ach',
            'ins_ach' => 'Ins Ach',
            'kta_ach' => 'Kta Ach',
            'tta_ach' => 'Tta Ach',
            'wuc_ach' => 'Wuc Ach',
            'cc_ach' => 'Cc Ach',
            'smeet_ach' => 'Smeet Ach',
            'opk_ach' => 'Opk Ach',
            'total_ach' => 'Total Ach',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

}
