<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "products".
 *
 * @property integer $id
 * @property string $content
 * @property integer $price
 * @property integer $discount
 * @property integer $discount_from_count
 * @property integer $shop_id
 * @property integer $category_id
 * @property integer $description_id
 * @property string $tags
 * @property integer $quantity
 * @property integer $status
 * @property string $created_at
 */
class Products extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */

    public $size;
    public $photo;
    public $p_color;
    public $colorPhoto;
    public $description_ids;
    public $description_contents;

    public static function tableName()
    {
        return 'products';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['content', 'price', 'shop_id', 'category_id', 'quantity'], 'required'],
            [['price', 'discount', 'discount_from_count', 'shop_id', 'category_id', 'description_id', 'quantity', 'status'], 'integer'],
            [['created_at'], 'safe'],
            [['content'], 'string', 'max' => 255],
            ['tags', 'string'],
            [['p_color', 'size', 'description_ids', 'description_contents'], 'each', 'rule' => ['string']],
        ];
    }

    public function add(){
        if ($this->validate()){

            // add sizes

            // add photos

            // add colors with photos
            $this->save(false);

        }
        else {
            return false;
        }
    }

    public function upl(){
        if ($this->validate()){
            foreach ($this->photo as $name => $file){
                    $file->saveAs('images/products/'.$file->name);
            }
            return true;
        }
        else {
            return false;
        }
    }

    public function addDescriptions(){

    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'content' => 'Content',
            'price' => 'Price',
            'discount' => 'Discount',
            'discount_from_count' => 'Discount From Count',
            'shop_id' => 'Shop ID',
            'category_id' => 'Category ID',
            'description_id' => 'Description ID',
            'tags' => 'Теги',
            'quantity' => 'Quantity',
            'status' => 'Status',
            'created_at' => 'Created At',
        ];
    }

    public function getShop(){
        return $this->hasOne(Shops::className(), ['id' => 'shop_id']);
    }

    public function getCategory(){
        return $this->hasOne(Categories::className(), ['id' => 'category_id']);
    }

    public function getDescriptions(){
        return $this->hasOne(Descriptions::className(), ['id' => 'description_id']);
    }

    public function getSizes(){
        return $this->hasMany(ProductSizes::className(), ['product_id' => 'id']);
    }

    public function getPhotos(){
        return $this->hasMany(ProductPhotos::className(), ['product_id' => 'id'])
            ->where('color IS NULL and reklama IS NULL and status=1');
    }

    public function getColors(){
        return $this->hasMany(ProductPhotos::className(), ['product_id' => 'id'])
            ->where('color IS NOT NULL and reklama IS NULL and status=1');
    }

    public function getReklamaphoto(){
        return $this->hasOne(ProductPhotos::className(), ['product_id' => 'id'])
            ->where('color IS NULL and reklama IS NOT NULL and status=1');
    }

    public function getOnlypic(){
        return $this->hasOne(ProductPhotos::className(), ['product_id' => 'id'])
            ->where('reklama IS NULL and color IS NULL and status=1');
    }

    public function getComments(){
        return $this->hasMany(Comments::className(), ['product_id' => 'id']);
    }
}
