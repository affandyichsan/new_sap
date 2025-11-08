<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "file_image".
 *
 * @property int $id_file
 * @property string $filename
 * @property string $filetype
 * @property string $filelocation
 * @property int $filesize
 * @property string $filecontent
 * @property string $create_at
 * @property string $update_at
 */
class FileImage extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'file_image';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['filename', 'filetype', 'filelocation', 'filesize', 'filecontent'], 'required'],
            [['filesize'], 'integer'],
            [['filecontent'], 'string'],
            [['create_at', 'update_at'], 'safe'],
            [['filename', 'filetype', 'filelocation'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_file' => 'Id File',
            'filename' => 'Filename',
            'filetype' => 'Filetype',
            'filelocation' => 'Filelocation',
            'filesize' => 'Filesize',
            'filecontent' => 'Filecontent',
            'create_at' => 'Create At',
            'update_at' => 'Update At',
        ];
    }

}
