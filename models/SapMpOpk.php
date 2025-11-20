<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "sap_mp_opk".
 *
 * @property int $id_sap_mp_opk
 * @property string|null $nrp
 * @property string|null $nrp_bib
 * @property string|null $nama
 * @property string|null $area_dedicated
 * @property string|null $detail_area
 * @property string $created_at
 * @property string $updated_at
 * @property int $uploader
 */
class SapMpOpk extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'sap_mp_opk';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nrp', 'nrp_bib', 'nama', 'area_dedicated', 'detail_area'], 'default', 'value' => null],
            [['created_at', 'updated_at'], 'safe'],
            [['uploader'], 'required'],
            [['uploader'], 'integer'],
            [['nrp', 'nrp_bib', 'nama'], 'string', 'max' => 50],
            [['area_dedicated'], 'string', 'max' => 10],
            [['detail_area'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_sap_mp_opk' => 'Id Sap Mp Opk',
            'nrp' => 'Nrp',
            'nrp_bib' => 'Nrp Bib',
            'nama' => 'Nama',
            'area_dedicated' => 'Area Dedicated',
            'detail_area' => 'Detail Area',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'uploader' => 'Uploader',
        ];
    }

}
