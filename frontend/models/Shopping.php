<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "shopping".
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $basket_id
 * @property integer $card_id
 * @property integer $address_id
 * @property integer $status
 * @property string $product_is_in
 * @property string $created_at
 */
class Shopping extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'shopping';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'basket_id', 'card_id', 'address_id'], 'required'],
            [['user_id', 'basket_id', 'card_id', 'address_id', 'status'], 'integer'],
            [['created_at'], 'safe'],
            [['product_is_in'], 'string', 'max' => 128],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'Идентификатор',
            'user_id' => 'Пользователь',
            'basket_id' => 'Корзина',
            'card_id' => 'Карточка',
            'address_id' => 'Адрес',
            'status' => 'Статус',
            'product_is_in' => 'Товар в (места)',
            'created_at' => 'Заказано',
        ];
    }

    public function getBasket(){
        return $this->hasOne(Basket::className(), ['id' => 'basket_id']);
    }

    public function getCard(){
        return $this->hasOne(Cards::className(), ['id' => 'card_id']);
    }

    public function getAddress(){
        return $this->hasOne(Address::className(), ['id' => 'address_id']);
    }
}
