<?php

namespace app\models;

use common\models\User;
use Yii;

/**
 * This is the model class for table "shop_ranks".
 *
 * @property integer $id
 * @property integer $shop_id
 * @property integer $user_id
 * @property integer $rank
 * @property string $comment
 * @property string $created_at
 */
class ShopRanks extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'shop_ranks';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['shop_id', 'user_id', 'comment'], 'required'],
            [['shop_id', 'user_id', 'rank'], 'integer'],
            [['created_at'], 'safe'],
            [['comment'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'shop_id' => 'Shop ID',
            'user_id' => 'User ID',
            'rank' => 'Rank',
            'comment' => 'Comment',
            'created_at' => 'Created At',
        ];
    }

    public function getShop(){
        return $this->hasOne(Shops::className(), ['id' => 'shop_id']);
    }

    public function getUser(){
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
