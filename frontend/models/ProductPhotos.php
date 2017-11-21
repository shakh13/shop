<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "product_photos".
 *
 * @property integer $id
 * @property integer $product_id
 * @property integer $reklama
 * @property string $path
 * @property string $color
 * @property integer $status
 * @property string $created_at
 */
class ProductPhotos extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'product_photos';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['product_id', 'path'], 'required'],
            [['product_id', 'status', 'reklama'], 'integer'],
            [['created_at'], 'safe'],
            [['path'], 'string', 'max' => 128],
            [['color'], 'string', 'max' => 32],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'product_id' => 'Product ID',
            'path' => 'Path',
            'color' => 'Color',
            'status' => 'Status',
            'created_at' => 'Created At',
        ];
    }

    public function getProduct(){
        return $this->hasOne(Products::className(), ['id' => 'product_id']);
    }
}
