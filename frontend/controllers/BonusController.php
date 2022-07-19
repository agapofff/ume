<?php

namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use backend\models\Bonus;

class BonusController extends Controller
{
    public function actionGift(int $user, int $sum)
    {
        $userBonus = Bonus::getUserBonus(Yii::$app->user->id);

        if ($userBonus['total'] < $sum) {
            return $this->asJson([
                'status' => 'error',
                'message' => Yii::t('front', 'На Вашем счету недостаточно бонусов для проведения этой операции')
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
