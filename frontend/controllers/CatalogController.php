<?php

namespace frontend\controllers;

use Yii;
use backend\models\Stores;
use backend\models\Langs;
use dvizh\shop\models\Product;
use dvizh\shop\models\Category;
use dvizh\shop\models\Price;
use dvizh\filter\models\Filter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\data\ActiveDataProvider;
use yii\helpers\ArrayHelper;
use yii\helpers\VarDumper;

class CatalogController extends \yii\web\Controller
{
    
    public function actionIndex()
    {
        return $this->redirect(['/catalog/wet-food']);
        
        $categories = Category::find()
            ->where([
                'active' => 1
            ])
            ->orderBy([
                'sort' => SORT_ASC
            ])
            ->all();
        
        return $this->render('index', [
            'categories' => $categories
        ]);
    }
    
    public function actionCategory($slug)
    {
        $category = Category::find()
            ->where('slug = :slug', [
                ':slug' => $slug
            ])
            ->one();

        $store = Stores::findOne([
            'lang' => Yii::$app->language,
            'type' => Yii::$app->params['store_type']
        ]);

        $prices = [];
        if ($store) {
            $prices = Price::find()
                ->where([
                    'name' => $store->store_id
                ])
                ->asArray()
                ->all();
        }

        $products = $category->products;

        return $this->render('category', [
            'category' => $category,
            'products' => $products,
            'store' => $store,
            'prices' => $store ? ArrayHelper::index($prices, 'item_id') : $prices,
        ]);
    }

    
}