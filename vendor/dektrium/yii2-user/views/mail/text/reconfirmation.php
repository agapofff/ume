<?php

/*
 * This file is part of the Dektrium project.
 *
 * (c) Dektrium project <http://github.com/dektrium>
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

/**
 * @var dektrium\user\models\Token $token
 */
?>
<?= Yii::t('front', 'Здравствуйте') ?>,

<?= Yii::t(
    'front',
    'Мы получили запрос на смену e-mail адреса для Вашей учётной записи на сайте {0}',
    Yii::$app->name
) ?>.
<?= Yii::t('front', 'Для завершения операции, пожалуйста, перейдите по ссылке ниже') ?>.

<?= $token->url ?>

<?= Yii::t('front', 'Если у Вас не получается перейти по ссылке, скопируйте её в адресную строку браузера') ?>.

<?= Yii::t('front', 'Если Вы не отправляли этот запрос, просто проигнорируйте это письмо') ?>.
