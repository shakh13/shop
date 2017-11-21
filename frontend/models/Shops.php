<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "shops".
 *
 * @property integer $id
 * @property string $name
 * @property string $content
 * @property string $photo_path
 * @property string $address
 * @property string $created_at
 */
class Shops extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */

    public $imageFile;

    public static function tableName()
    {
        return 'shops';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'content', 'imageFile'], 'required'],
            [['created_at'], 'safe'],
            [['name', 'content', 'address'], 'string', 'max' => 255],
            [['photo_path'], 'string', 'max' => 128],
        ];
    }

    public function upload(){
        if ($this->validate()){
            $this->imageFile->saveAs('images/shops/'.$this->name.$this->address.'.'.$this->imageFile->extension);
            $this->photo_path = $this->name.$this->address.'.'.$this->imageFile->extension;
            return true;
        }
        else {
            return false;
        }
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'content' => 'Content',
            'photo_path' => 'Photo Path',
            'address' => 'Address',
            'created_at' => 'Created At',
        ];
    }

    public function getProducts(){
        return $this->hasMany(Products::className(), ['shop_id' => 'id']);
    }
}
