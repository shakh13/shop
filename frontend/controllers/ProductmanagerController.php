<?php

namespace frontend\controllers;

use app\models\Categories;
use app\models\Descriptions;
use app\models\Descs;
use app\models\ProductPhotos;
use app\models\Products;
use app\models\ProductSizes;
use app\models\Shops;
use Yii;
use yii\web\UploadedFile;


class ProductmanagerController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $products = Products::find()->orderBy('created_at')->all();
        return $this->render('index', [
            'products' => $products
        ]);
    }

    /**
     * @return string
     */
    public function actionCreate(){
        $model = new Products();
        $shops = Shops::find()->all();
        $categories = Categories::find()->all();
        $descs = Descs::find()->orderBy('content')->all();

        if (Yii::$app->request->post() && $model->load(Yii::$app->request->post()))
        {

            // save all file

            foreach ($_FILES['Products']['name']['photo'] as $name => $file){
                switch ($name[0]){
                    case 'c':
                        $model->photo[$name] = UploadedFile::getInstance($model, 'photo['.$name.'][file]');
                        break;

                    default:
                        $model->photo[$name] = UploadedFile::getInstance($model, 'photo['.$name.']');
                        break;
                }

                $model->upl();
            }




            // save model

            if ($model->save()){

                // save all photos by id

                foreach ($_FILES['Products']['name']['photo'] as $name => $file){
                    $ppc = new ProductPhotos();
                    $ppc->product_id = $model->id;
                    switch ($name[0]){
                        case 'c':
                            $ppc->path = $file['file'];
                            $ppc->color = $model->p_color[$name];
                            break;
                        case 'r':
                            $ppc->reklama = 1;
                            $ppc->path = $file;
                            break;
                        default:
                            $ppc->path = $file;
                            break;
                    }
                    $ppc->save();
                }

                // save descriptions by id

                $desc = new Descriptions();

                $desc->content = $desc->createDescription($model->description_ids, $model->description_contents);

                $desc->save();

                // update model->description id by descriptions->id

                $model->description_id = $desc->id;
                $model->save();


                // save all sizes by id

                foreach ($model->size as $name => $item){
                    $sizes = new ProductSizes();
                    $sizes->product_id = $model->id;
                    $sizes->content = $item;
                    $sizes->save();
                }

                return $this->redirect(['view', 'id' => $model->id]);
            }
            else {

                // show ERROR message******************************************************************************************
                // uploaded files deleted
                foreach ($_FILES['Products']['name']['photo'] as $name => $file){
                    switch ($name[0]){
                        case 'c':
                            unlink('images/products/'.$file['file']['name']);
                            break;

                        default:
                            unlink('images/products/'.$file['name']);
                            break;
                    }
                }

            }
        }

        return $this->render('create', [
            'model' => $model,
            'shops' => $shops,
            'categories' => $categories,
            'descs' => $descs,
        ]);
    }

    public function actionView(){
        $id = Yii::$app->request->getQueryParam('id');
        if ($id){
            $product = Products::find()->where(['id' => $id, 'status' => 1])->one();
            return $this->render('view', [
                'id' => $id,
                'product' => $product
            ]);
        }
        else {
            return $this->redirect(['index']);
        }
    }

}
