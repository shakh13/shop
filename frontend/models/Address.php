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
            [['user_id', 'contact_name', 'street', 'apartment', 'city_id', 'postcode', 'phone_number'], 'required', 'message' => 'Заполните поля'],
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
            'user_id' => 'Пользователь',
            'contact_name' => 'Получатель',
            'phone_number' => 'Номер телефона',
            'street' => 'Улица',
            'apartment' => 'Квартира',
            'country_id' => 'Страна',
            'state' => 'Страна',
            'city_id' => 'Город',
            'postcode' => 'Почтовый индекс',
            'dflt' => 'П.У',
            'status' => 'Статус',
            'created_at' => 'Добавлено',
        ];
    }

    public function getCountry(){
        return $this->hasOne(Countries::className(), ['id' => 'country_id']);
    }

    public function getCity(){
        return $this->hasOne(Cities::className(), ['id' => 'city_id']);
    }
}
