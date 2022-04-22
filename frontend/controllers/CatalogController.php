<?php

namespace frontend\controllers;

use Yii;
use backend\models\Stores;
use backend\models\Langs;
use common\models\Product;
use common\models\Category;
use dvizh\filter\models\Filter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\data\ActiveDataProvider;
use yii\helpers\ArrayHelper;

class CatalogController extends \yii\web\Controller
{
    
    public function actionIndex($collectionSlug = null, $categorySlug = null)
    {
        $collIDs = [
            16, // 2021
            17, // 2021 дети
            9, // 2020
        ];
        
        if ($collectionSlug && !in_array(Category::findOne(['slug' => $collectionSlug])->id, $collIDs)) {
            $categorySlug = $collectionSlug;
            $collectionSlug = null;
        }
        
        $collectionsIDs = $collectionSlug ? [Category::findOne(['slug' => $collectionSlug])->id] : $collIDs;
        
        $category = $categorySlug ? Category::findOne(['slug' => $categorySlug]) : null;

        $collections = [];
        
// print_r($allProductsSizes);
        
        foreach ($collectionsIDs as $collectionID) {
            $collectionCategories = [];
            $collectionProductsIDs = [];
            $products = null;
            $allProductPrices = [];
            
            $collection = Category::findOne([
                'id' => $collectionID,
                'active' => 1
            ]);
            
            if ($collection) {
                $collectionProducts = $collection->products;
                
                if ($collectionProducts) {
                    $collectionCategoriesIDs = [];
                    
                    foreach ($collectionProducts as $collectionProduct) {
                        $collectionProductCategories = $collectionProduct->categories;
                        if ($collectionProductCategories) {
                            foreach ($collectionProductCategories as $collectionProductCategory) {
                                if ($collectionProductCategory->id != $collectionID) {
                                    $collectionCategoriesIDs[] = $collectionProductCategory->id;
                                }
                                if (!$categorySlug || $collectionProductCategory->slug == $categorySlug) {
                                    $collectionProductsIDs[] = $collectionProduct->id;
                                }
                            }
                        }
                    }
                    
                    $collectionCategoriesIDs = array_unique($collectionCategoriesIDs);

                    $collectionCategories = Category::find()
                        ->where([
                            'id' => array_unique($collectionCategoriesIDs),
                            'active' => 1,
                        ])
                        ->orderBy([
                            'sort' => SORT_ASC
                        ])
                        ->all();
                        
                    $modifications = Product::getAllProductsPrices($collectionProductsIDs);
                    
                    $modificationsSizes = Product::getAllProductsSizes($collectionProductsIDs);

                    $modificationsPrices = ArrayHelper::map($modifications, 'product_id', 'price');
                    $modificationsOldPrices = ArrayHelper::map($modifications, 'product_id', 'price_old');
                        
                    $goods = Product::find()
                        ->where([
                            'active' => 1,
                            'id' => $collectionProductsIDs
                        ]);
                        
                    if (Yii::$app->request->get('filter')) {
                        $goods = $goods->filtered();
                    }
                    
                    $goods = $goods->all();
                    
                    $products = [];
                    
                    if ($goods) {
                        foreach ($goods as $key => $product) {
                            // $productSizes = $product->getCartOptions()[1]['variants'];
// print_r($product->getCartOptions()[1]['variants']);
                            $productSizes = array_filter($modificationsSizes, function ($modificationsSizes) use ($product) {
                                return $modificationsSizes['product_id'] == $product->id;
                            });

                            $products[] = [
                                'model' => $product,
                                'name' => json_decode($product->name)->{Yii::$app->language},
                                'price' => (float) $modificationsPrices[$product->id],
                                'oldPrice' => (float) $modificationsOldPrices[$product->id],
                                'sizes' => ArrayHelper::map($productSizes, 'id', 'id'), // $productSizes ?: [],
                            ];
                        }
                    }
// echo \yii\helpers\VarDumper::dump($products, 99, true);
                    
                    $price = Yii::$app->request->get('price');
                    if ($price) {
                        $price = explode(';', $price);
                        $products = array_filter($products, function ($product) use ($price) {
                            return $product['price'] >= (float) $price[0] && $product['price'] <= (float) $price[1];
                        });
                    }

                    $sizes = Yii::$app->request->get('sizes');
                    if ($sizes) {
                        $products = array_filter($products, function ($product) use ($sizes) {
                            return !empty(array_intersect($product['sizes'], $sizes));
                        });
                    }
                    
                    $sort = Yii::$app->request->get('sort');
                    if ($sort) {
                        $isDesc = mb_substr($sort, 0, 1) == '-';
                        $sortField = $isDesc ? mb_substr($sort, 1) : $sort;
                        $sortDir = $isDesc ? SORT_DESC : SORT_ASC;
                        ArrayHelper::multisort($products, [$sortField], [$sortDir]);
                    }

                    $collections[$collectionID] = [
                        'collection' => $collection,
                        'subCategories' => $collectionCategories,
                        'products' => $products,
                        'productsSizes' => array_unique(ArrayHelper::map($modificationsSizes, 'id', 'value')),
                        'productsPrices' => array_unique($modificationsPrices),
                    ];
                }
            }
        }
        
        Yii::$app->params['currency'] = Langs::findOne([
            'code' => Yii::$app->language
        ])->currency;
        
        if ($collectionSlug && $categorySlug) {
            $title = json_decode($collection->name)->{Yii::$app->language} . ' - ' . json_decode($category->name)->{Yii::$app->language};
        } elseif ($categorySlug) {
            $title = json_decode($category->name)->{Yii::$app->language};
        } elseif ($collectionSlug) {
            $title = json_decode($collection->name)->{Yii::$app->language};
        } else {
            $title = Yii::t('front', 'Каталог');
        }

        return $this->render('index', [
            'collections' => $collections,
            'collectionSlug' => $collectionSlug,
            'categorySlug' => $categorySlug,
            'category' => $category,
            'title' => $title,
        ]);
    }

    
}