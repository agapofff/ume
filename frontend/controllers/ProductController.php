<?php

namespace frontend\controllers;
use Yii;
use yii\web\Controller;
use backend\models\Stores;
use dvizh\shop\models\Product;
use dvizh\shop\models\Category;
use dvizh\shop\models\Price;
use yii\db\Query;
use yii\web\NotFoundHttpException;
use yii\helpers\ArrayHelper;
use Facebook\Facebook;
use linslin\yii2\curl;

class ProductController extends \yii\web\Controller
{
    public function actionIndex($slug)
    {
        $product = Product::find()
            ->where('slug = :slug', [
                ':slug' => $slug
            ])
            ->one();
        
        if (!$product) {
            throw new NotFoundHttpException(Yii::t('front', 'Товар не найден'));
        }
        
        $category = $product->category;
// print_r($category->attributes); exit;
        
        $store = Stores::findOne([
            'lang' => Yii::$app->language,
            'type' => Yii::$app->params['store_type']
        ]);
        
        $price = Price::find()
            ->where([
                'name' => $store->store_id,
                'item_id' => $product->id
            ])
            ->one();
        
        return $this->render('index', [
            'product' => $product,
            'price' => $price,
            'category' => $category,
            'store' => $store,
        ]);
    }

}