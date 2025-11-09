<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "file_image_reconcile".
 *
 * @property int $id_file_image_reconcile
 * @property int $id_sap_reconcile
 * @property string $filename
 * @property string $filetype
 * @property string $filelocation
 * @property int $filesize
 * @property string $filecontent
 * @property string $create_at
 * @property string $update_at
 */
class FileImageReconcile extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'file_image_reconcile';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['update_at'], 'default', 'value' => 'now()'],
            [['id_sap_reconcile', 'filename', 'filetype', 'filelocation', 'filesize', 'filecontent'], 'required'],
            [['id_sap_reconcile', 'filesize'], 'integer'],
            [['filecontent'], 'string'],
            [['created_at', 'updated_at'], 'safe'],
            [['filename', 'filetype', 'filelocation'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_file_image_reconcile' => 'Id File Image Reconcile',
            'id_sap_reconcile' => 'Id Sap Reconcile',
            'filename' => 'Filename',
            'filetype' => 'Filetype',
            'filelocation' => 'Filelocation',
            'filesize' => 'Filesize',
            'filecontent' => 'Filecontent',
            'created_at' => 'Create At',
            'updated_at' => 'Update At',
        ];
    }

}
