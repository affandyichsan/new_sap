<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "sap_indicator_plan_monthly".
 *
 * @property int $id_sap_indicator_plan_monthly
 * @property string $nrp
 * @property string|null $nrp_bib
 * @property string|null $perusahaan
 * @property string|null $departement
 * @property string|null $jabatan
 * @property string|null $golongan_jabatan
 * @property string|null $month
 * @property string|null $year
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
 * @property string $created_at
 * @property string $updated_at
 * @property int $created_by
 */
class SapIndicatorPlanMonthly extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'sap_indicator_plan_monthly';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nrp_bib', 'perusahaan', 'departement', 'jabatan', 'golongan_jabatan', 'month', 'year', 'date', 'kta', 'tta', 'obs', 'ins', 's_meet', 'cc', 'wuc', 'opk', 'opk_detail', 'note_per_date', 'kode_area'], 'default', 'value' => null],
            [['updated_at'], 'default', 'value' => 'now()'],
            [['nrp', 'created_by'], 'required'],
            [['date', 'opk_detail', 'note_per_date', 'created_at', 'updated_at'], 'safe'],
            [['kta', 'tta', 'obs', 'ins', 's_meet', 'cc', 'wuc', 'opk', 'created_by'], 'integer'],
            [['nrp', 'nrp_bib', 'year', 'kode_area'], 'string', 'max' => 50],
            [['perusahaan', 'departement'], 'string', 'max' => 255],
            [['jabatan', 'golongan_jabatan', 'month'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_sap_indicator_plan_monthly' => 'Id Sap Indicator Plan Monthly',
            'nrp' => 'Nrp',
            'nrp_bib' => 'Nrp Bib',
            'perusahaan' => 'Perusahaan',
            'departement' => 'Departement',
            'jabatan' => 'Jabatan',
            'golongan_jabatan' => 'Golongan Jabatan',
            'month' => 'Month',
            'year' => 'Year',
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
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'created_by' => 'Created By',
        ];
    }

}
