<?php

namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use yii\helpers\VarDumper;
use linslin\yii2\curl;

class SmsController extends Controller
{
    public function actionSend($phone, $text, $sender = 'Dadget', $wapurl = false)
    {
        $host = Yii::$app->params['sms']['host'];
        $port = Yii::$app->params['sms']['port'];
        $login = Yii::$app->params['sms']['login'];
        $password = Yii::$app->params['sms']['password'];

        $params = [
            'phone' => preg_replace('/[^0-9]/', '', $phone),
            'text' => $text,
        ];
        
        if ($sender) {
            $params['sender'] = $sender;
        }
        
        if ($wapurl) {
            $params['wapurl'] = $wapurl;
        }
        
        $curl = new curl\Curl();
        
        $response = $curl
            ->setGetParams($params)
            ->setHeaders([
                'Authorization' => base64_encode($login . ':' . $password)
            ])
            ->get($host);

        return $response;
    }
    
    public function actionGetCode($phone)
    {
        $smsCode = rand(1000, 9999);
        Yii::$app->session->set('smsCode', $smsCode);

        $this->actionSend($phone, Yii::t('front', 'Ваш код подтверждения для сайта UME' . ' : ' . $smsCode));
        return $smsCode;
    }
    
    public function actionCheckCode($code)
    {
        return $code == Yii::$app->session->get('smsCode');
    }
}
