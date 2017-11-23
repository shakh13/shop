<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "preferences".
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $category_id
 * @property string $created_at
 */
class Preferences extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'preferences';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'category_id'], 'required'],
            [['user_id', 'category_id'], 'integer'],
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
            'category_id' => 'Category ID',
            'created_at' => 'Created At',
        ];
    }
}
