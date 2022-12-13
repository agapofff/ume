<?php
use yii\helpers\Url;
use yii\helpers\Html;

$this->title = Yii::t('front', 'Программа лояльности') . ' - ' . Yii::$app->name;
?>

<div class="container-xl mb-2 mb-lg-3">
    <h1 class="text-uppercase font-weight-light mb-2 mb-lg-3">
        <?= Yii::t('front', 'Программа лояльности') ?>
    </h1>
    
    <div class="row align-items-center position-relative">
        <div class="col-12">
            <img data-src="/images/bonus_banner.jpg" class="lazyload pointer-events-none img-fluid" alt="<?= $title ?>">
        </div>
        <div class="col-9 col-sm-9 col-md-8 col-lg-8 col-xl-7 position-absolute h-100">
            <div class="row h-100 align-items-center">
                <div class="col-12 pl-2 pl-lg-3 pl-xl-6">
                    <h2 class="h1 text-uppercase font-weight-light mb-2 d-none d-sm-block">
                        <?= Yii::t('front', 'Программа привилегий') ?>
                    </h2>
                    <h2 class="h3 text-uppercase font-weight-light mb-1 mt-0_5 d-sm-none">
                        <?= Yii::t('front', 'Программа привилегий') ?>
                    </h2>
                    <p class="text-uppercase font-weight-bolder d-none d-sm-block" style="max-width: 300px">
                        <?= Yii::t('front', 'Эффективный сервис услуг и систем поощрения ваших питомцев') ?>
                    </p>
                    <p class="text-uppercase font-weight-bolder small d-sm-none" style="max-width: 150px">
                        <?= Yii::t('front', 'Эффективный сервис услуг и систем поощрения ваших питомцев') ?>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container-xl mb-2 mb-lg-3">
    <div class="row justify-content-center">
        <div class="col-12 px-md-1_5 px-lg-2 px-xl-6">
            <h2 class="text-uppercase font-weight-light d-none d-sm-block">
                <?= Yii::t('front', 'Общие положения программы привилегий подписчикам и покупателям UME') ?>
            </h2>
            <h2 class="h4 text-uppercase font-weight-light d-sm-none">
                <?= Yii::t('front', 'Общие положения программы привилегий подписчикам и покупателям UME') ?>
            </h2>
            <p class="font-weight-light">
                <?= Yii::t('front', 'Питомцу автоматически начисляются баллы (UME) за покупки и подписки по программе привилегий. Накапливая UME, он повышает свой статус и получает эксклюзивные привилегии и услуги. ') ?>
            </p>
        </div>
    </div>
</div>

<div class="container-xl mb-2 mb-lg-3">
    <hr class="m-0 border-dark">
</div>

<div class="container-xl mb-2 mb-lg-3">
    <div class="row justify-content-center">
        <div class="col-12 px-md-1_5 px-lg-2 px-xl-6">
            <h3>
                <?= Yii::t('front', 'Стоимость 1 UME') ?>
            </h3>
            <div class="container-xl p-0">
                <div class="row mt-2 mt-lg-3">
                    <div class="col-sm-6 mb-1 mb-sm-0">
                        <div class="card rounded-0 border-dark">
                            <div class="card-body text-center py-2 py-lg-3">
                                <div class="row align-items-center h-100">
                                    <div class="col-12">
                                        <p class="h2 font-weight-bold mb-0_5 text-secondary">UME</p>
                                    </div>
                                    <div class="col-12">
                                        <p class="h3 font-weight-bold mb-0_5 text-secondary">$1</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="card h-100 rounded-0 border-dark">
                            <div class="card-body text-center py-2 py-lg-3">
                                <div class="row align-items-center h-100">
                                    <div class="col-12">
                                        <p class="h4 font-weight-normal mb-0_5">Другие проекты</p>
                                    </div>
                                    <div class="col-12">
                                        <p class="h3 font-weight-bold mb-0_5 text-secondary">$2</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container-xl mb-2 mb-lg-3">
    <hr class="m-0 border-dark">
</div>

<div class="container-xl mb-2 mb-lg-3">
    <div class="row justify-content-center">
        <div class="col-12 px-md-1_5 px-lg-2 px-xl-6 mb-1_5 mb-lg-2">
            <h3>
                <?= Yii::t('front', 'Статусы') ?>
            </h3>
        </div>
        <div class="col-12">
            <div class="row no-gutters justify-content-between px-1 px-md-1_5 px-lg-2 px-xl-5 py-1_5 py-lg-2 bg-gray-200">
                <div class="col">
                    <p class="h4 m-0">
                        <?= Yii::t('front', 'Серебро') ?>
                    </p>
                </div>
                <div class="col text-right">
                    <p class="h4 font-weight-bold text-secondary m-0">
                        1 000 UME
                    </p>
                </div>
            </div>
        </div>
        <div class="col-12">
            <div class="row no-gutters justify-content-between px-1 px-md-1_5 px-lg-2 px-xl-5 py-1_5 py-lg-2">
                <div class="col">
                    <p class="h4 m-0">
                        <?= Yii::t('front', 'Золото') ?>
                    </p>
                </div>
                <div class="col text-right">
                    <p class="h4 font-weight-bold text-secondary m-0">
                        2 500 UME
                    </p>
                </div>
            </div>
        </div>
        <div class="col-12">
            <div class="row no-gutters justify-content-between px-1 px-md-1_5 px-lg-2 px-xl-5 py-1_5 py-lg-2 bg-gray-200">
                <div class="col">
                    <p class="h4 m-0">
                        <?= Yii::t('front', 'Платина') ?>
                    </p>
                </div>
                <div class="col text-right">
                    <p class="h4 font-weight-bold text-secondary m-0">
                        5 000 UME
                    </p>
                </div>
            </div>
        </div>
        <div class="col-12">
            <div class="row no-gutters justify-content-between px-1 px-md-1_5 px-lg-2 px-xl-5 py-1_5 py-lg-2">
                <div class="col">
                    <p class="h4 m-0">
                        <?= Yii::t('front', 'Voyage, поездка с питомцем') ?>
                    </p>
                </div>
                <div class="col text-right">
                    <p class="h4 font-weight-bold text-secondary m-0">
                        10 000 UME
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container-xl mb-2 mb-lg-3">
    <div class="row justify-content-center">
        <div class="col-12 px-md-1_5 px-lg-2 px-xl-6">
            <ol class="text-blue pl-1">
                <li class="mb-1">
                    <?= Yii::t('front', 'При достижении очередного статуса из набранной суммы UME списывается его стоимость.') ?>
                    <br>
                    <?= Yii::t('front', 'Чтобы достичь статусов Золото и Платина, нужно набрать:') ?>
                    <ul style="list-style-type: disc;">
                        <li>
                            <?= Yii::t('front', 'Золото') ?> = 1 000 (<?= Yii::t('front', 'Серебро') ?>) + 2 500 = 3 500 UME
                        </li>
                        <li>
                            <?= Yii::t('front', 'Платина') ?> = 1 000 (<?= Yii::t('front', 'Серебро') ?>) + 2 500 (<?= Yii::t('front', 'Золото') ?>) + 5 000 = 8 500 UME
                        </li>
                    </ul>
                </li>
                <li class="mb-1">
                    <?= Yii::t('front', 'Статус действует 1 год с момента достижения. Через год списывается стоимость максимального статуса, для достижения которого хватает накопленных UME.') ?>
                </li>
                <li class="mb-1">
                    <?= Yii::t('front', 'Voyage – это совместный отдых на престижном курорте со своим питомцем. Оплачивается поездка, подготовка документов и активная программа для питомца.') ?>
                </li>
            </ol>
        </div>
    </div>
</div>

<div class="container-xl mb-2 mb-lg-3">
    <hr class="m-0 border-dark">
</div>

<div class="container-xl mb-3 mb-lg-4">
    <div class="row justify-content-center">
        <div class="col-12 px-md-1_5 px-lg-2 px-xl-6 mb-1_5 mb-lg-2">
            <h3>
                <?= Yii::t('front', 'Привилегии') ?>
            </h3>
        </div>
        <div class="col-12 px-md-1_5 px-lg-2 px-xl-6">
            <div class="row mb-1_5">
                <div class="col-4 text-center">
                    <p class="h4 m-0">
                        <?= Yii::t('front', 'Серебро') ?>
                    </p>
                </div>
                <div class="col-4 text-center">
                    <p class="h4 m-0">
                        <?= Yii::t('front', 'Золото') ?>
                    </p>
                </div>
                <div class="col-4 text-center">
                    <p class="h4 m-0">
                        <?= Yii::t('front', 'Платина') ?>
                    </p>
                </div>
                <div class="col-12 mt-2 mb-1_5">
                    <p class="h6 text-center m-0 py-0_5 rounded-pill bg-gray-200 text-blue">
                        <?= Yii::t('front', 'Коэффициент накопления UME') ?>
                    </p>
                </div>
                <div class="col-4 text-center">
                    <p class="h4 font-weight-bold text-secondary m-0">
                        +10%
                    </p>
                </div>
                <div class="col-4 text-center">
                    <p class="h5 font-weight-bold text-secondary m-0">
                        +20%
                    </p>
                </div>
                <div class="col-4 text-center">
                    <p class="h5 font-weight-bold text-secondary m-0">
                        +30%
                    </p>
                </div>
                <div class="col-12 mt-2 mb-1_5">
                    <p class="h6 text-center m-0 py-0_5 rounded-pill bg-gray-200 text-blue">
                        <?= Yii::t('front', 'Скидка при личном заказе в ДР (± неделя)') ?>
                    </p>
                </div>
                <div class="col-4 text-center">
                    <p class="h4 font-weight-bold text-secondary m-0">
                        10%
                    </p>
                </div>
                <div class="col-4 text-center">
                    <p class="h5 font-weight-bold text-secondary m-0">
                        20%
                    </p>
                </div>
                <div class="col-4 text-center">
                    <p class="h5 font-weight-bold text-secondary m-0">
                        50%
                    </p>
                </div>
                <div class="col-12 mt-2 mb-1_5">
                    <p class="h6 text-center m-0 py-0_5 rounded-pill bg-gray-200 text-blue">
                        <?= Yii::t('front', 'Скидка на оплату стоимости доставки личных заказов') ?>
                    </p>
                </div>
                <div class="col-4 text-center">
                    <p class="h4 font-weight-bold text-secondary m-0">
                        20%
                    </p>
                </div>
                <div class="col-4 text-center">
                    <p class="h5 font-weight-bold text-secondary m-0">
                        50%
                    </p>
                </div>
                <div class="col-4 text-center">
                    <p class="h5 font-weight-bold text-secondary text-uppercase m-0">
                        <?= Yii::t('front', 'Бесплатно') ?>
                    </p>
                </div>
                <div class="col-12 mt-2 mb-1_5">
                    <p class="h6 text-center m-0 py-0_5 rounded-pill bg-gray-200 text-blue">
                        <?= Yii::t('front', 'Скидка на покупку подписки UME Standard') ?>
                    </p>
                </div>
                <div class="col-4 text-center">
                    <p class="h4 font-weight-bold text-secondary m-0">
                        2%
                    </p>
                </div>
                <div class="col-4 text-center">
                    <p class="h5 font-weight-bold text-secondary m-0">
                        8%
                    </p>
                </div>
                <div class="col-4 text-center">
                    <p class="h5 font-weight-bold text-secondary m-0">
                        15%
                    </p>
                </div>
                <div class="col-12 mt-2 mb-1_5">
                    <p class="h6 text-center m-0 py-0_5 rounded-pill bg-gray-200 text-blue">
                        <?= Yii::t('front', 'Скидка на покупку подписки UME Premium') ?>
                    </p>
                </div>
                <div class="col-4 text-center">
                    <p class="h4 font-weight-bold text-secondary m-0">
                        8%
                    </p>
                </div>
                <div class="col-4 text-center">
                    <p class="h5 font-weight-bold text-secondary m-0">
                        15%
                    </p>
                </div>
                <div class="col-4 text-center">
                    <p class="h5 font-weight-bold text-secondary m-0">
                        20%
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container-xl mb-2 mb-lg-3">
    <hr class="m-0 border-dark">
</div>

<div class="container-xl mb-3 mb-lg-4">
    <div class="row justify-content-center">
        <div class="col-12 px-md-1_5 px-lg-2 px-xl-6 mb-1_5 mb-lg-2">
            <h3>
                <?= Yii::t('front', 'За что начисляются UME') ?>
            </h3>
        </div>
        <div class="col-12 px-md-1_5 px-lg-2 px-xl-6">
            <table class="table">
                <thead>
                    <tr>
                        <th class="text-blue font-weight-normal border-0 px-0 py-1">
                            <?= Yii::t('front', 'За что начисляются баллы') ?>
                        </th>
                        <th class="text-center text-blue font-weight-normal border-0 px-0 py-1">
                            <?= Yii::t('front', 'Коэффициент') ?>
                        </th>
                    </tr>
                </thead>
                <tbody >
                    <tr>
                        <td class="py-1 px-0">
                            <p class="h5 font-weight-bold m-0">
                                <?= Yii::t('front', 'Личная покупка') ?>
                            </p>
                        </td>
                        <td class="py-1 px-0">
                            <p class="h5 font-weight-bold text-center text-secondary m-0">
                                ×1
                            </p>                        
                        </td>
                    </tr>
                    <tr>
                        <td class="py-1 px-0">
                            <p class="h5 font-weight-bold m-0">
                                <?= Yii::t('front', 'За покупки друзей') ?>
                            </p>
                        </td>
                        <td class="py-1 px-0">
                            <p class="h5 font-weight-bold text-center text-secondary m-0">
                                ×2
                            </p>                        
                        </td>
                    </tr>
                    <tr>
                        <td class="py-1 px-0">
                            <p class="h5 font-weight-bold m-0">
                                <?= Yii::t('front', 'Покупка подписки UME Standart') ?>
                            </p>
                        </td>
                        <td class="py-1 px-0">
                            <p class="h5 font-weight-bold text-center text-secondary m-0">
                                ×3
                            </p>                        
                        </td>
                    </tr>
                    <tr>
                        <td class="py-1 px-0">
                            <p class="h5 font-weight-bold m-0">
                                <?= Yii::t('front', 'Покупка подписки UME Premium') ?>
                            </p>
                        </td>
                        <td class="py-1 px-0">
                            <p class="h5 font-weight-bold text-center text-secondary m-0">
                                ×4
                            </p>                        
                        </td>
                    </tr>
                    <tr>
                        <td class="py-1 px-0">
                            <p class="h5 font-weight-bold m-0">
                                <?= Yii::t('front', 'За каждое активное участие в конкурсах и акция') ?>
                            </p>
                        </td>
                        <td class="py-1 px-0">
                            <p class="h5 font-weight-bold text-center text-secondary m-0">
                                +10 UME
                            </p>                        
                        </td>
                    </tr>
                    <tr>
                        <td class="py-1 px-0 border-bottom">
                            <p class="h5 font-weight-bold m-0">
                                <?= Yii::t('front', 'За 1 пост в день в приложении') ?>
                            </p>
                        </td>
                        <td class="py-1 px-0 border-bottom">
                            <p class="h5 font-weight-bold text-center text-secondary m-0">
                                +10 UME
                            </p>                        
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div class="row justify-content-center mt-2 mt-lg-3">
        <div class="col-12 px-md-1_5 px-lg-2 px-xl-6">
            <ol class="text-blue pl-1">
                <li class="mb-1">
                    <?= Yii::t('front', 'Время накопления UME не ограничено.') ?>
                </li>
                <li class="mb-1">
                    <?= Yii::t('front', 'Время получения UME от активности друзей в течение 12 месяцев. Активным другом считается пользователь, зарегистрировавшийся в приложении UME в течение последних полных 12 месяцев на момент совершения заказа, включая первый месяц заказа.') ?>
                </li>
                <li class="mb-1">
                    <?= Yii::t('front', 'Подписка UME Standard включает в себя приобретение 15 коробок влажного корма и услуги консьержа через приложение. Корм можно получать раз в месяц. Кол-во рассчитано на три месяца.') ?>
                </li>
                <li class="mb-1">
                    <?= Yii::t('front', 'Подписка UME Premium включает в себя приобретение 30 коробок влажного корма, услуги консьержа через приложение и страховка на питомца на 1 год. Корм можно получать раз в месяц. Кол-во рассчитано в среднем на шесть месяцев.') ?>
                </li>
            </ol>
        </div>
    </div>
</div>
