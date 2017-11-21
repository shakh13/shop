<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "cards".
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $card_num
 * @property integer $mm
 * @property integer $yy
 * @property string $security_code
 * @property string $first_name
 * @property string $last_name
 * @property integer $dflt
 * @property integer $status
 * @property string $created_at
 */
class Cards extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cards';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'card_num', 'mm', 'yy', 'security_code', 'first_name', 'last_name'], 'required'],
            [['user_id', 'card_num', 'mm', 'yy', 'security_code', 'dflt', 'status'], 'integer'],
            [['created_at'], 'safe'],
            [['first_name', 'last_name'], 'string', 'max' => 15],
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
            'card_num' => 'Card Num',
            'mm' => 'Mm',
            'yy' => 'Yy',
            'security_code' => 'Security Code',
            'first_name' => 'First Name',
            'last_name' => 'Last Name',
            'dflt' => 'Dflt',
            'status' => 'Status',
            'created_at' => 'Created At',
        ];
    }
}
