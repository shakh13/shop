<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "address".
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $contact_name
 * @property string $phone_number
 * @property string $street
 * @property string $apartment
 * @property integer $country_id
 * @property string $state
 * @property integer $city_id
 * @property integer $postcode
 * @property integer $dflt
 * @property integer $status
 * @property string $created_at
 */
class Address extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'address';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'contact_name', 'phone_number', 'street', 'apartment', 'country_id', 'state', 'city_id', 'postcode'], 'required'],
            [['user_id', 'country_id', 'city_id', 'postcode', 'dflt', 'status'], 'integer'],
            [['created_at'], 'safe'],
            [['contact_name', 'street', 'apartment', 'state'], 'string', 'max' => 30],
            [['phone_number'], 'string', 'max' => 15],
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
            'contact_name' => 'Contact Name',
            'phone_number' => 'Phone Number',
            'street' => 'Street',
            'apartment' => 'Apartment',
            'country_id' => 'Country ID',
            'state' => 'State',
            'city_id' => 'City ID',
            'postcode' => 'Postcode',
            'dflt' => 'Dflt',
            'status' => 'Status',
            'created_at' => 'Created At',
        ];
    }

    public function getCountry(){
        return $this->hasOne(Countries::className(), ['id' => 'country_id']);
    }

    public function getCity(){
        return $this->hasOne(Cities::className(), ['id' => 'city_id']);
    }
}
