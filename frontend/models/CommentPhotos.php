<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "comment_photos".
 *
 * @property integer $id
 * @property integer $comment_id
 * @property string $path
 */
class CommentPhotos extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'comment_photos';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['comment_id', 'path'], 'required'],
            [['comment_id'], 'integer'],
            [['path'], 'string', 'max' => 128],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'comment_id' => 'Comment ID',
            'path' => 'Path',
        ];
    }
}
