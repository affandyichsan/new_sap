<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "sap_setting_plan".
 *
 * @property int $id_sap_setting_plan
 * @property string $perusahaan
 * @property string $departement
 * @property string $jabatan
 * @property string $golongan_jabatan
 * @property int $kta
 * @property int $tta
 * @property int $obs
 * @property int $ins
 * @property int $s_meet
 * @property int $cc
 * @property int $wuc
 * @property int $opk
 * @property string $created_at
 * @property string $updated_at
 */
class SapSettingPlan extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'sap_setting_plan';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['perusahaan', 'departement', 'jabatan', 'golongan_jabatan', 'kta', 'tta', 'obs', 'ins', 's_meet', 'cc', 'wuc', 'opk'], 'required'],
            [['kta', 'tta', 'obs', 'ins', 's_meet', 'cc', 'wuc', 'opk'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['perusahaan'], 'string', 'max' => 255],
            [['departement', 'jabatan', 'golongan_jabatan'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_sap_setting_plan' => 'Id Sap Setting Plan',
            'perusahaan' => 'Perusahaan',
            'departement' => 'Departement',
            'jabatan' => 'Jabatan',
            'golongan_jabatan' => 'Golongan Jabatan',
            'kta' => 'Kta',
            'tta' => 'Tta',
            'obs' => 'Obs',
            'ins' => 'Ins',
            's_meet' => 'S Meet',
            'cc' => 'Cc',
            'wuc' => 'Wuc',
            'opk' => 'Opk',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

}
