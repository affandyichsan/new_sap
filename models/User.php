<?php

namespace app\models;

use Yii;
use yii\base\NotSupportedException;
// use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;


class User extends ActiveRecord implements IdentityInterface
{
    const STATUS_DELETED    = 0;
    const STATUS_INACTIVE   = 9;
    const STATUS_ACTIVE     = 10;

    #change password
    public $oldPassword;
    public $newPassword;
    public $confirmPassword;

    #pengolahan user
    // public $id;
    public $username;
    public $password;
    public $password_hash;
    public $confrim_password;
    public $authKey;
    public $nama;
    public $password_reset_token;
    public $verification_token;
    // public $role;
    public $nrp;


    public static function tableName()
    {
        return '{{%sap_user_data}}';
    }
    public function rules()
    {
        return [
            [['username', 'email', 'password_hash', 'role', 'status', 'oldPassword', 'newPassword', 'confirmPassword'], 'required'],
            [['username', 'password_hash', 'password', 'confrim_password', 'verification_token', 'role', 'password'], 'string'],
            [['password_reset_token','created_at', 'updated_at','nrp'], 'safe'],
            [['email'], 'email'],
            ['status', 'default', 'value' => self::STATUS_INACTIVE],
            ['status', 'in', 'range' => [self::STATUS_ACTIVE, self::STATUS_INACTIVE, self::STATUS_DELETED]],
            ['confirmPassword', 'compare', 'compareAttribute' => 'newPassword', 'message' => "Passwords don't match"],
        ];
    }
    public function attributeLabels()
    {
        return [
            'id'                    => 'ID',
            'username'              => 'Username',
            'auth_key'              => 'Auth Key',
            'password_hash'         => 'Password Hash',
            'password_reset_token'  => 'Password Reset Token',
            'email'                 => 'Email',
            'status'                => 'Status',
            'role'                  => 'Role',
            'created_at'            => 'Created At',
            'updated_at'            => 'Updated At',
            'verification_token'    => 'Verification Token',
        ];
    }
    // private static $users = [
    //     '100' => [
    //         'id' => '100',
    //         'username' => 'admin',
    //         'password' => 'admin',
    //         'authKey' => 'test100key',
    //         'accessToken' => '100-token',
    //     ],
    //     '101' => [
    //         'id' => '101',
    //         'username' => 'demo',
    //         'password' => 'demo',
    //         'authKey' => 'test101key',
    //         'accessToken' => '101-token',
    //     ],
    // ];

    private static function getLogin()
    {
        $data = SapUserData::find()->all();
        $UserData = [];
        foreach ($data as $row) {
            $UserData[$row['id']] = [
                'id'                    => @$row['id'],
                'username'              => @$row['username'],
                'password'              => @$row['password_hash'],
                'authKey'               => @$row['authKey'],
                'nrp'                   => @$row['nrp'],
                'status'                => @$row['status'],
                'email'                 => @$row['email'],
                'password_reset_token'  => @$row['password_reset_token'],
                'verification_token'    => @$row['verification_token'],
                'role'                  => @$row['role'],
            ];
        }
        return $UserData;
    }
    /**
     * {@inheritdoc}
     */
    public static function findIdentity($id)
    {
        return (isset(self::getLogin()[$id]) && SapUserData::findOne(['id' => self::getLogin()[$id], 'status' => self::STATUS_ACTIVE])) ? new static(self::getLogin()[$id]) : null;
        // return static::findOne($id);
    }

    /**
     * {@inheritdoc}
     */

    public static function findIdentityByAccessToken($token, $type = null)
    {
        foreach (self::getLogin() as $user) {
            if ($user['email'] === $token) {
                return new static($user);
            }
        }
        return null;
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($nrp)
    {
        foreach (self::getLogin() as $user) {
            if (strcasecmp($user['nrp'], $nrp) === 0 && SapUserData::findOne(['id' => self::getLogin()[$user['id']], 'status' => self::STATUS_ACTIVE])) {
                return new static($user);
            }
        }
        return null;
    }

    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * {@inheritdoc}
     */
    public function getAuthKey()
    {
        return $this->authKey;
    }

    /**
     * {@inheritdoc}
     */
    public function validateAuthKey($authKey)
    {
        return $this->authKey === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function setPassword($password)
    {
        $this->password_hash = Yii::$app->getSecurity()->generatePasswordHash($password);
    }
    public function validatePassword($password)
    {
        $dataarray = $this->getLogin()[$this->id];
        return Yii::$app->getSecurity()->validatePassword($password, $dataarray['password']);
    }


    public function validatePasswordChange($password)
    {
        $dataarray = $this->getLogin()[@Yii::$app->user->identity->id];
        return Yii::$app->security->validatePassword($password, $dataarray['password']);
    }
    public function validatePasswordChangeUser($password)
    {
        $dataarray = $this->getLogin()[$this->id];
        return Yii::$app->security->validatePassword($password, $dataarray['password']);
    }
    public function generateAuthKey()
    {
        $this->authKey = Yii::$app->security->generateRandomString();
    }

    public function generateEmailVerificationToken()
    {
        $this->verification_token = Yii::$app->security->generateRandomString() . '_' . time();
    }

    public static function findByPasswordResetToken($token)
    {
        if (!static::isPasswordResetTokenValid($token)) {
            return null;
        }
        return static::findOne([
            'password_reset_token' => $token,
            'status' => self::STATUS_ACTIVE,
        ]);
    }

    public static function isPasswordResetTokenValid($token)
    {
        if (empty($token)) {
            return false;
        }
        $expire = Yii::$app->params['user.passwordResetTokenExpire']; // misal 3600*24
        $timestamp = (int) substr($token, strrpos($token, '_') + 1);
        return $timestamp + $expire >= time();
    }
    public function generatePasswordResetToken()
    {
        $this->password_reset_token = Yii::$app->security->generateRandomString() . '_' . time();
    }
    public function removePasswordResetToken()
    {
        $this->password_reset_token = null;
    }
}
