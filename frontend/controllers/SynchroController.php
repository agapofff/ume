<?php

namespace frontend\controllers;

use Yii;

use backend\models\Stores;
use backend\models\Langs;
use dvizh\shop\models\Price;
use dvizh\shop\models\Modification;
use yii\helpers\ArrayHelper;
use yii\helpers\Json;
use yii\helpers\VarDumper;

class SynchroController extends \yii\web\Controller
{
    
    public function actionIndex()
    {
        Price::updateAll([
            'price' => 0,
            'price_old' => 0,
            'available' => 'no',
        ]);
        
        $prices = Price::find()->all();
// echo VarDumper::dump($prices, 99, true); exit;
        $stores = Stores::findAll([
            'active' => 1
        ]);
        
        if ($stores) {
            foreach ($stores as $store) {
                $request = @file_get_contents('https://api.sessia.com/api/market/' . $store->store_id . '/showcase-tree');
                if ($request) {
                    $request = json_decode($request, true);
                    foreach ($request as $val) {
                        if (isset($val['goods_list'])) {
                            foreach ($val['goods_list'] as $good) {
                                $price = Price::findOne([
                                    'name' => $store->store_id,
                                    'code' => $good['id'],
                                ]);
                                
                                if ($price) {
                                    $price->price = isset($good['price']) ? (int)$good['price'] : 0;
                                    $price->price_old = isset($good['retail_price']) ? (int)$good['retail_price'] : 0;
                                    $price->available = $good['is_purchasable'] ? 'yes' : 'no';
                                    $price->amount = $good['is_purchasable'] ? 99 : 0;
                                    $price->save();
                                }
                            }
                        }
                    }
                }
            }
        }
        
    }
    
}