<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "sap_reconcile".
 *
 * @property int $id_sap_reconcile
 * @property string $nrp
 * @property string $jenis_reconcile
 * @property string|null $sub_jenis_reconcile
 * @property string|null $reconcile_json
 * @property string $week
 * @property string $bulan
 * @property string $approvment_departement
 * @property string $approvment_she
 * @property string $approvment_final
 * @property int|null $approval_departement
 * @property int|null $approval_she
 * @property int|null $final_approval
 * @property string $created_at
 * @property string $updated_at
 */
class SapReconcile extends \yii\db\ActiveRecord
{

    /**
     * ENUM field values
     */
    const APPROVMENT_DEPARTEMENT_PENDING = 'pending';
    const APPROVMENT_DEPARTEMENT_APPROVED = 'approved';
    const APPROVMENT_DEPARTEMENT_REJECTED = 'rejected';
    const APPROVMENT_DEPARTEMENT_REVISED = 'revised';
    const APPROVMENT_SHE_PENDING = 'pending';
    const APPROVMENT_SHE_APPROVED = 'approved';
    const APPROVMENT_SHE_REJECTED = 'rejected';
    const APPROVMENT_SHE_REVISED = 'revised';
    const APPROVMENT_FINAL_PENDING = 'pending';
    const APPROVMENT_FINAL_APPROVED = 'approved';
    const APPROVMENT_FINAL_REJECTED = 'rejected';
    const APPROVMENT_FINAL_REVISED = 'revised';

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
            [['sub_jenis_reconcile', 'reconcile_json', 'approval_departement', 'approval_she', 'final_approval'], 'default', 'value' => null],
            [['nrp'], 'default', 'value' => ''],
            [['approvment_final'], 'default', 'value' => 'pending'],
            [['jenis_reconcile', 'week', 'bulan','year'], 'required'],
            [['reconcile_json', 'approvment_departement', 'approvment_she', 'approvment_final','year'], 'string'],
            [['approval_departement', 'approval_she', 'final_approval'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['nrp', 'week', 'bulan'], 'string', 'max' => 50],
            [['jenis_reconcile', 'sub_jenis_reconcile'], 'string', 'max' => 255],
            ['approvment_departement', 'in', 'range' => array_keys(self::optsApprovmentDepartement())],
            ['approvment_she', 'in', 'range' => array_keys(self::optsApprovmentShe())],
            ['approvment_final', 'in', 'range' => array_keys(self::optsApprovmentFinal())],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_sap_reconcile' => 'Id Sap Reconcile',
            'nrp' => 'Nrp',
            'jenis_reconcile' => 'Jenis Reconcile',
            'sub_jenis_reconcile' => 'Sub Jenis Reconcile',
            'reconcile_json' => 'Reconcile Json',
            'week' => 'Week',
            'bulan' => 'Bulan',
            'approvment_departement' => 'Approvment Departement',
            'approvment_she' => 'Approvment She',
            'approvment_final' => 'Approvment Final',
            'approval_departement' => 'Approval Departement',
            'approval_she' => 'Approval She',
            'final_approval' => 'Final Approval',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }


    /**
     * column approvment_departement ENUM value labels
     * @return string[]
     */
    public static function optsApprovmentDepartement()
    {
        return [
            self::APPROVMENT_DEPARTEMENT_PENDING => 'pending',
            self::APPROVMENT_DEPARTEMENT_APPROVED => 'approved',
            self::APPROVMENT_DEPARTEMENT_REJECTED => 'rejected',
            self::APPROVMENT_DEPARTEMENT_REVISED => 'revised',
        ];
    }

    /**
     * column approvment_she ENUM value labels
     * @return string[]
     */
    public static function optsApprovmentShe()
    {
        return [
            self::APPROVMENT_SHE_PENDING => 'pending',
            self::APPROVMENT_SHE_APPROVED => 'approved',
            self::APPROVMENT_SHE_REJECTED => 'rejected',
            self::APPROVMENT_SHE_REVISED => 'revised',
        ];
    }

    /**
     * column approvment_final ENUM value labels
     * @return string[]
     */
    public static function optsApprovmentFinal()
    {
        return [
            self::APPROVMENT_FINAL_PENDING => 'pending',
            self::APPROVMENT_FINAL_APPROVED => 'approved',
            self::APPROVMENT_FINAL_REJECTED => 'rejected',
            self::APPROVMENT_FINAL_REVISED => 'revised',
        ];
    }

    /**
     * @return string
     */
    public function displayApprovmentDepartement()
    {
        return self::optsApprovmentDepartement()[$this->approvment_departement];
    }

    /**
     * @return bool
     */
    public function isApprovmentDepartementPending()
    {
        return $this->approvment_departement === self::APPROVMENT_DEPARTEMENT_PENDING;
    }

    public function setApprovmentDepartementToPending()
    {
        $this->approvment_departement = self::APPROVMENT_DEPARTEMENT_PENDING;
    }

    /**
     * @return bool
     */
    public function isApprovmentDepartementApproved()
    {
        return $this->approvment_departement === self::APPROVMENT_DEPARTEMENT_APPROVED;
    }

    public function setApprovmentDepartementToApproved()
    {
        $this->approvment_departement = self::APPROVMENT_DEPARTEMENT_APPROVED;
    }

    /**
     * @return bool
     */
    public function isApprovmentDepartementRejected()
    {
        return $this->approvment_departement === self::APPROVMENT_DEPARTEMENT_REJECTED;
    }

    public function setApprovmentDepartementToRejected()
    {
        $this->approvment_departement = self::APPROVMENT_DEPARTEMENT_REJECTED;
    }

    /**
     * @return bool
     */
    public function isApprovmentDepartementRevised()
    {
        return $this->approvment_departement === self::APPROVMENT_DEPARTEMENT_REVISED;
    }

    public function setApprovmentDepartementToRevised()
    {
        $this->approvment_departement = self::APPROVMENT_DEPARTEMENT_REVISED;
    }

    /**
     * @return string
     */
    public function displayApprovmentShe()
    {
        return self::optsApprovmentShe()[$this->approvment_she];
    }

    /**
     * @return bool
     */
    public function isApprovmentShePending()
    {
        return $this->approvment_she === self::APPROVMENT_SHE_PENDING;
    }

    public function setApprovmentSheToPending()
    {
        $this->approvment_she = self::APPROVMENT_SHE_PENDING;
    }

    /**
     * @return bool
     */
    public function isApprovmentSheApproved()
    {
        return $this->approvment_she === self::APPROVMENT_SHE_APPROVED;
    }

    public function setApprovmentSheToApproved()
    {
        $this->approvment_she = self::APPROVMENT_SHE_APPROVED;
    }

    /**
     * @return bool
     */
    public function isApprovmentSheRejected()
    {
        return $this->approvment_she === self::APPROVMENT_SHE_REJECTED;
    }

    public function setApprovmentSheToRejected()
    {
        $this->approvment_she = self::APPROVMENT_SHE_REJECTED;
    }

    /**
     * @return bool
     */
    public function isApprovmentSheRevised()
    {
        return $this->approvment_she === self::APPROVMENT_SHE_REVISED;
    }

    public function setApprovmentSheToRevised()
    {
        $this->approvment_she = self::APPROVMENT_SHE_REVISED;
    }

    /**
     * @return string
     */
    public function displayApprovmentFinal()
    {
        return self::optsApprovmentFinal()[$this->approvment_final];
    }

    /**
     * @return bool
     */
    public function isApprovmentFinalPending()
    {
        return $this->approvment_final === self::APPROVMENT_FINAL_PENDING;
    }

    public function setApprovmentFinalToPending()
    {
        $this->approvment_final = self::APPROVMENT_FINAL_PENDING;
    }

    /**
     * @return bool
     */
    public function isApprovmentFinalApproved()
    {
        return $this->approvment_final === self::APPROVMENT_FINAL_APPROVED;
    }

    public function setApprovmentFinalToApproved()
    {
        $this->approvment_final = self::APPROVMENT_FINAL_APPROVED;
    }

    /**
     * @return bool
     */
    public function isApprovmentFinalRejected()
    {
        return $this->approvment_final === self::APPROVMENT_FINAL_REJECTED;
    }

    public function setApprovmentFinalToRejected()
    {
        $this->approvment_final = self::APPROVMENT_FINAL_REJECTED;
    }

    /**
     * @return bool
     */
    public function isApprovmentFinalRevised()
    {
        return $this->approvment_final === self::APPROVMENT_FINAL_REVISED;
    }

    public function setApprovmentFinalToRevised()
    {
        $this->approvment_final = self::APPROVMENT_FINAL_REVISED;
    }
}
