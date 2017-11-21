<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "countries".
 *
 * @property integer $id
 * @property string $content
 * @property string $iso
 * @property integer $number
 */
class Countries extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'countries';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['content', 'iso'], 'required'],
            [['number'], 'integer'],
            [['content'], 'string', 'max' => 30],
            [['iso'], 'string', 'max' => 3],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'content' => 'Content',
            'iso' => 'Iso',
            'number' => 'Number',
        ];
    }

    public function getCities(){
        return $this->hasMany(Cities::className(), ['country_id' => 'id']);
    }
}
