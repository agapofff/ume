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

/**
 * @var dektrium\user\Module $module
 * @var dektrium\user\models\User $user
 * @var dektrium\user\models\Token $token
 * @var bool $showPassword
 */
?>

<h1 style="text-align: center;">
    <?= Yii::t('front', 'Благодарим Вас за регистрацию на сайте {0}', Yii::$app->id) ?>
</h1>
<br>
<p style="text-align: center">
    <?php
        if ($showPassword || $module->enableGeneratingPassword) {
    ?>
            <?= Yii::t('front', 'Автоматически сгенерированный пароль для Вашей учётной записи') ?>: 
            <br>
            <strong><?= $user->password ?></strong>
    <?php
        }
    ?>
</p>

<?php 
    if ($token !== null) {
?>
        <p style="text-align: center">
            <?= Yii::t('front', 'Чтобы завершить регистрацию, пожалуйста, пройдите по ссылке ниже') ?>:
        </p>
        <br>
        <p style="text-align: center; ">
            <?= Html::a(Yii::t('front', 'Подтвердить e-mail'), $token->url, [
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
                ]);
            ?>
        </p>
<?php
    }
?>
