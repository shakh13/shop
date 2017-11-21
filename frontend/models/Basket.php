<?php

namespace app\models;

use common\models\User;
use Yii;

/**
 * This is the model class for table "basket".
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $product_id
 * @property integer $p_size_id
 * @property integer $p_photo_id
 * @property integer $status
 * @property integer $count
 * @property string $created_at
 */
class Basket extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'basket';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'product_id'], 'required'],
            [['user_id', 'product_id', 'p_size_id', 'p_photo_id', 'status', 'count'], 'integer'],
            [['created_at'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'product_id' => 'Product ID',
            'p_size_id' => 'P Size ID',
            'p_photo_id' => 'P Photo ID',
            'status' => 'Status',
            'count' => 'Count',
            'created_at' => 'Created At',
        ];
    }

    public function getUser(){
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    public function getProduct(){
        return $this->hasOne(Products::className(), ['id' => 'product_id']);
    }

    public function getSize(){
        return $this->hasOne(ProductSizes::className(), ['id' => 'p_size_id']);
    }

    public function getColor(){
        return $this->hasOne(ProductPhotos::className(), ['id' => 'p_photo_id']);
    }
}
