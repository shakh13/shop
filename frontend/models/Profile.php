<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "profile".
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $first_name
 * @property string $last_name
 * @property string $img_path
 * @property integer $cash
 * @property string $alias
 * @property integer $lng
 * @property integer $currency
 */
class Profile extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'profile';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'first_name', 'last_name'], 'required'],
            [['user_id', 'lng', 'currency'], 'integer'],
            [['first_name', 'last_name', 'alias'], 'string', 'max' => 15],
            [['user_id'], 'unique'],
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
            'first_name' => 'First Name',
            'last_name' => 'Last Name',
            'alias' => 'Alias',
            'lng' => 'Lng',
            'currency' => 'Currency',
        ];
    }

    public function getName(){
        return $this->first_name.' '.$this->last_name;
    }
}
