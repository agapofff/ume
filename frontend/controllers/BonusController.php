<?php

namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use backend\models\Bonus;
use dektrium\user\models\User;
use yii\helpers\Url;
use yii\helpers\Html;

class BonusController extends Controller
{
    public function actionGift(int $user, int $sum)
    {
        $userBonus = Bonus::getUserBonus(Yii::$app->user->id);

        if ($userBonus['total'] < $sum) {
            return $this->asJson([
                'status' => 'error',
                'message' => Yii::t('front', 'На Вашем счету недостаточно UME для проведения этой операции')
            ]);
        }
        
        $friend = User::findOne($user);
        
        $removeBonus = new Bonus();
        $removeBonus->attributes = [
            'active' => 1,
            'user_id' => Yii::$app->user->id,
            'type' => 0,
            'amount' => $sum,
            'reason' => 2,
            'description' => $user,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ];
        
        $addBonus = new Bonus();
        $addBonus->attributes = [
            'active' => 1,
            'user_id' => $user,
            'type' => 1,
            'amount' => $sum,
            'reason' => 2,
            'description' => Yii::$app->user->id,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ];
        
        if ($removeBonus->save() && $addBonus->save()) {
            $html = Html::tag('p', Yii::t('front', 'Поздравляем!')) . 
                    Html::tag('p', Yii::t('front', 'Вы получили в подарок {0} UME от пользователя {1}', [
                        $sum,
                        $friend->profile->name ?: ($friend->profile->first_name ?: $friend->username)
                    ])) . 
                    Html::tag('br') . 
                    Html::tag('div', Html::a(Yii::t('front', 'Подробнее'), Url::home(true), [
                        'style' => '
                            display: inline-block;
                            padding: 24px 60px;
                            color: #ffffff !important;
                            background-color: #474F73;
                            border: 1px solid #474F73;
                            -webkit-border-radius: 50%;
                            -moz-border-radius: 50%;
                            border-radius: 50px;
                            font-size: 24px;
                            font-weight: 400;
                            text-align: center;
                            text-decoration: none !important;
                        ',
                        ]), [
                            'style' => '
                                text-align: center;
                            '
                    ]);
                        
            $mail = Yii::$app->mailer
                ->compose('default', [
                    'content' => $html,
                ])
                ->setFrom([
                    Yii::$app->params['senderEmail'] => Yii::$app->params['senderName']
                ])
                // ->setTo($friend->email)
                ->setTo('agapofff@gmail.com')
                ->setReplyTo(Yii::$app->params['senderEmail'])
                ->setSubject(Yii::t('front', 'Вы получили подарок') . ' - ' . $site->name)
                ->send();
            
            return $this->asJson([
                'status' => 'success',
                'message' => Yii::t('front', 'Ваш подарок успешно отправлен')
            ]);
        } else {
            return $this->asJson([
                'status' => 'error',
                'message' => Yii::t('front', 'Произошла ошибка! Пожалуйста, попробуйте еще раз чуть позже')
            ]);
        }
    }

}
