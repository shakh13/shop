<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "product_sizes".
 *
 * @property integer $id
 * @property integer $product_id
 * @property string $content
 */
class ProductSizes extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'product_sizes';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['product_id', 'content'], 'required'],
            [['product_id'], 'integer'],
            [['content'], 'string', 'max' => 15],
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
            'content' => 'Content',
        ];
    }
}
