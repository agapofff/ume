<?php

/*
 * This file is part of the Dektrium project.
 *
 * (c) Dektrium project <http://github.com/dektrium>
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

use yii\helpers\Url;
use yii\helpers\Html;
use dektrium\user\widgets\UserMenu;

/**
 * @var dektrium\user\models\User $user
 */
 
if (Yii::$app->user->isGuest) {
    $menuItems = [
        [
            'label' => Yii::t('front', 'Избранное'),
            'url' => Url::to(['/wishlist'])
        ],
        [
            'label' => Yii::t('front', 'Войти'),
            'url' => Url::to(['/account'])
        ],
    ];
} else {
    $user = Yii::$app->user->identity;

    $menuItems = [
        [
            'label' => Yii::t('front', 'Аккаунт'),
            'url' => Url::to(['/account'])
        ],
        [
            'label' => Yii::t('front', 'Заказы'),
            'url' => Url::to(['/orders'])
        ],
        [
            'label' => Yii::t('front', 'Избранное'),
            'url' => Url::to(['/wishlist'])
        ],
        [
            'label' => Yii::t('front', 'Выйти'),
            'url' => Url::to(['/logout']),
            'options' => [
                'data-method' => 'POST'
            ]
        ],
    ];
}

?>

<div id="user-menu">
<?php
    foreach ($menuItems as $menuItem) {
        $active = $menuItem['url'] == Url::to();
?>
        <div class="mb-1 pb-1_5">
            <a href="<?= $menuItem['url'] ?>" class="h1 ttfirsneue font-weight-light text-uppercase text-decoration-none position-relative mb-0 <?= $active ? 'border-bottom' : '' ?>" 
            <?php 
                if ($menuItem['options']) {
                    foreach ($menuItem['options'] as $key => $val) {
                        echo $key . '="' . $val . '" ';
                    }
                }
            ?>
            >
                <?= $menuItem['label'] ?>
            </a>
        </div>
<?php
    }
?>
</div>