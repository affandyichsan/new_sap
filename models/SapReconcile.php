<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "sap_reconcile".
 *
 * @property int $id_sap_reconcile
 * @property int $id_sap_user
 * @property string $reconcile_json
 * @property string $jenis_reconcile
 * @property string $week
 * @property string $bulan
 * @property string $created_at
 * @property string $updated_at
 * @property string $approvment
 */
class SapReconcile extends \yii\db\ActiveRecord
{

    /**
     * ENUM field values
     */
    const APPROVMENT_PENDING = 'pending';
    const APPROVMENT_APPROVED = 'approved';
    const APPROVMENT_REJECTED = 'rejected';
    const APPROVMENT_REVISED = 'revised';

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'sap_reconcile';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['approvment'], 'default', 'value' => 'pending'],
            [['id_sap_user', 'reconcile_json', 'jenis_reconcile', 'week', 'bulan', 'created_at', 'updated_at'], 'required'],
            [['id_sap_user'], 'integer'],
            [['reconcile_json', 'approvment'], 'string'],
            [['created_at', 'updated_at'], 'safe'],
            [['jenis_reconcile'], 'string', 'max' => 255],
            [['week', 'bulan'], 'string', 'max' => 50],
            ['approvment', 'in', 'range' => array_keys(self::optsApprovment())],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_sap_reconcile' => 'Id Sap Reconcile',
            'id_sap_user' => 'Id Sap User',
            'reconcile_json' => 'Reconcile Json',
            'jenis_reconcile' => 'Jenis Reconcile',
            'week' => 'Week',
            'bulan' => 'Bulan',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'approvment' => 'Approvment',
        ];
    }


    /**
     * column approvment ENUM value labels
     * @return string[]
     */
    public static function optsApprovment()
    {
        return [
            self::APPROVMENT_PENDING => 'pending',
            self::APPROVMENT_APPROVED => 'approved',
            self::APPROVMENT_REJECTED => 'rejected',
            self::APPROVMENT_REVISED => 'revised',
        ];
    }

    /**
     * @return string
     */
    public function displayApprovment()
    {
        return self::optsApprovment()[$this->approvment];
    }

    /**
     * @return bool
     */
    public function isApprovmentPending()
    {
        return $this->approvment === self::APPROVMENT_PENDING;
    }

    public function setApprovmentToPending()
    {
        $this->approvment = self::APPROVMENT_PENDING;
    }

    /**
     * @return bool
     */
    public function isApprovmentApproved()
    {
        return $this->approvment === self::APPROVMENT_APPROVED;
    }

    public function setApprovmentToApproved()
    {
        $this->approvment = self::APPROVMENT_APPROVED;
    }

    /**
     * @return bool
     */
    public function isApprovmentRejected()
    {
        return $this->approvment === self::APPROVMENT_REJECTED;
    }

    public function setApprovmentToRejected()
    {
        $this->approvment = self::APPROVMENT_REJECTED;
    }

    /**
     * @return bool
     */
    public function isApprovmentRevised()
    {
        return $this->approvment === self::APPROVMENT_REVISED;
    }

    public function setApprovmentToRevised()
    {
        $this->approvment = self::APPROVMENT_REVISED;
    }
}
