<?php

namespace app\models;

use Yii;
use yii\base\Object;

/**
 * This is the model class for table "descriptions".
 *
 * @property integer $id
 * @property string $content
 * @property string $created_at
 */
class Descriptions extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'descriptions';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['content'], 'required'],
            [['created_at'], 'safe'],
            [['content'], 'string', 'max' => 255],
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

    public function getParse(){
        $a = [];
        $s = $this->content;
        $desc_id = '';
        $value = '';
        $i = -1;
        $j = -1;
        $k = -1;

        do{
            $i = strpos($s, '[**');
            $j = strpos($s, '**]');
            $k = strpos($s, '!=!');
            if ($i > -1 && $j > 1 && $k > 1){
                $desc_id = substr($s, $i+3, $k - $i - 3);
                $value = substr($s, $k + 3, $j - $k - 3);
                $a[] = (object)[
                    'desc_id' => $desc_id,
                    'content' => $value,
                    'description' => Descs::findOne($desc_id),
                ];
                $s = substr($s, $j + 3, strlen($s) - $j - 3);
            }
        }
        while ($i > -1 && $j > -1 && $k > -1);

        return (object)$a;
    }

    public function createDescription($d_ids, $d_content){
        $s = '';
        foreach ($d_ids as $name => $item){
            $s .= '[**'.$item.'!=!'.$d_content[$name].'**]';
        }

        return $s;
    }
}
