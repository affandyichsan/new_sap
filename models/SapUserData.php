<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "sap_user_data".
 *
 * @property int $id
 * @property string $nrp
 * @property string $username
 * @property string $password
 * @property string $password_hash
 * @property string $confrim_password
 * @property string|null $authKey
 * @property string|null $email
 * @property string|null $password_reset_token
 * @property string|null $verification_token
 * @property string|null $role
 * @property int|null $id_file
 * @property string|null $lastlogin
 * @property int|null $flag
 * @property string|null $created_at
 * @property string|null $updated_at
 * @property int|null $status
 */
class SapUserData extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'sap_user_data';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['authKey', 'email', 'password_reset_token', 'verification_token', 'role', 'id_file', 'lastlogin', 'flag', 'status'], 'default', 'value' => null],
            [['updated_at'], 'default', 'value' => 'now()'],
            [['nrp', 'username', 'password', 'password_hash', 'confrim_password'], 'required'],
            [['id_file', 'flag', 'status'], 'integer'],
            [['lastlogin', 'created_at', 'updated_at'], 'safe'],
            [['nrp', 'role'], 'string', 'max' => 50],
            [['username', 'password', 'password_hash', 'confrim_password', 'authKey', 'password_reset_token', 'verification_token'], 'string', 'max' => 255],
            [['email'], 'string', 'max' => 400],
            [['nrp'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nrp' => 'Nrp',
            'username' => 'Username',
            'password' => 'Password',
            'password_hash' => 'Password Hash',
            'confrim_password' => 'Confrim Password',
            'authKey' => 'Auth Key',
            'email' => 'Email',
            'password_reset_token' => 'Password Reset Token',
            'verification_token' => 'Verification Token',
            'role' => 'Role',
            'id_file' => 'Id File',
            'lastlogin' => 'Lastlogin',
            'flag' => 'Flag',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'status' => 'Status',
        ];
    }

}
