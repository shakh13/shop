<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "descs".
 *
 * @property integer $id
 * @property string $content
 * @property string $created_at
 */
class Descs extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'descs';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['content'], 'required'],
            [['created_at'], 'safe'],
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
            'content' => 'Content',
            'created_at' => 'Created At',
        ];
    }
}
