<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;

$this->title = Yii::t('front', 'Контакты');

// $this->params['breadcrumbs'][] = $this->title;

?>

<div class="container-fluid px-lg-2 px-xl-3 px-xxl-5 mt-1_5 mt-1_5 mb-3 mb-md-7">
    <div class="row">
        <div class="col-12">
            <h1 class="ttfirsneue text-uppercase display-2 position-relative d-inline-block mb-0 red_dot">
                <?= Yii::t('front', 'Контакты') ?>
            </h1>
        </div>
    </div>
</div>

<div class="container-fluid px-lg-2 px-xl-3 px-xxl-5 mt-1_5 mt-1_5 mb-2 mb-md-7">
    <div class="row justify-content-between flex-nowrap overflow-x-auto overflow-y-hidden product-types py-0_5">
<?php
    foreach ($countries as $countryKey => $country) {
?>
        <div class="col-auto">
            <?= Html::a(json_decode($country->name)->{Yii::$app->language}, '#' . $country->slug, [
                    'class' => 'ttfirsneue text-uppercase text-decoration-none py-1 ' . ($categorySlug && $subCategory->slug == $categorySlug ? 'text-dark' : 'text-gray-500'),
                    'data-toggle' => 'tab',
                    'role' => 'tab',
                    
                ])
            ?>
        </div>
    <?php
        }
    ?>
    </div>
    <hr class="d-none d-md-block mt-0">
</div>

<div class="container-fluid px-lg-2 px-xl-3 px-xxl-5 mt-1_5 mt-1_5 mb-md-2">
    <div class="row">
        <div class="col-md-4 col-lg-5 col-xl-6 mb-2 mb-md-3">
            <p class="text-uppercase">
                <?= Yii::t('front', 'Часы работы') ?>
            </p>
            <p class="mb-0_5">
                <?= Yii::t('front', 'Будни') ?> 9:00 - 23:00
            </p>
            <p class="mb-0_5">
                <?= Yii::t('front', 'Выходные') ?> 9:00 - 18:00
            </p>
        </div>
        <div class="col-md-8 col-lg-7 col-xl-6">
            <div class="row">
                <div class="col-md-6 mb-2 mb-md-3">
                    <p class="text-uppercase">
                        <?= Yii::t('front', 'Адрес') ?>
                    </p>
                    <p class="mb-0_5">
                        <?= Yii::t('front', Yii::$app->params['contacts']['full_address'][0]) ?>
                    </p>
                    <p class="mb-0_5">
                        <?= Yii::t('front', Yii::$app->params['contacts']['full_address'][1]) ?>
                    </p>
                </div>
                <div class="col-md-6 mb-2 mb-md-3">
                    <p class="text-uppercase">
                        <?= Yii::t('front', 'Контакты') ?>
                    </p>
                    <p class="mb-0_5">
                        <a href="tel:<?= preg_replace('/[D]/', '', Yii::$app->params['contacts']['phone']) ?>" class="text-decoration-none"><?= Yii::$app->params['contacts']['phone'] ?></a>
                    </p>
                    <p class="mb-0_5">
                        <a href="mailto:<?= Yii::$app->params['contacts']['email'] ?>" class="text-decoration-none"><?= Yii::$app->params['contacts']['email'] ?></a>
                    </p>
                </div>
            </div>
        </div>
    </div>

</div>

<div class="mb-3 mb-md-5 vw-100 vh-75">
    <!-- <iframe src="https://snazzymaps.com/embed/349900" width="100%" height="100%" style="border:none;"></iframe> -->
    <!-- <iframe src="https://snazzymaps.com/embed/349900" width="100%" height="100%" style="border:none;"></iframe>-->
    <!-- 
    <iframe id="contacts-map" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2245.6574805053137!2d37.53473712383441!3d55.74708005153804!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x46b54bdcf5c58c73%3A0x6d14c6130e7d0b31!2z0J_RgNC10YHQvdC10L3RgdC60LDRjyDQvdCw0LEuLCA2INGB0YLRgNC-0LXQvdC40LUgMiwg0JzQvtGB0LrQstCwLCAxMjMxMTI!5e0!3m2!1sru!2sru!4v1624208653877!5m2!1sru!2sru" width="100%" height="100%"></iframe>
    -->
    <script async src="//api-maps.yandex.ru/2.0/?load=package.standard&lang=<?= Yii::$app->language ?>-<?= strtoupper(Yii::$app->language) ?>&onload=initMap" type="text/javascript"></script>
    <div id="map" style="width:100%; height:100%;"></div>
    <script type="text/javascript">
        function initMap() {
            var myMap = new ymaps.Map("map", {
                    center: [55.74826, 37.540829],
                    zoom: 16
                }),
                myPlacemark1 = new ymaps.Placemark([
                    55.74826, 37.540829
                ], {
                    hintContent: '<?= Yii::$app->id ?>',
                    balloonContentHeader: '<a href="<?= Url::to(true) ?>" class="text-decoration-none"><?= Yii::$app->id ?></a><br><span class="small text-muted"><?= Yii::t("front", Yii::$app->name) ?></span>',
                    balloonContentBody: '<hr>' + 
                    '<?= Yii::$app->params["contacts"]["full_address"][0] ?>' + 
                    '<br>' + 
                    '<?= Yii::$app->params["contacts"]["full_address"][1] ?>' +
                    '<hr>' + 
                    '<p class="mb-0_5"><a href="tel:<?= preg_replace("/[D]/", "", Yii::$app->params["contacts"]["phone"]) ?>" class="text-decoration-none"><?= Yii::$app->params["contacts"]["phone"] ?></a></p>' +
                    '<p class="mb-0_5"><a href="mailto:<?= Yii::$app->params["contacts"]["email"] ?>" class="text-decoration-none"><?= Yii::$app->params["contacts"]["email"] ?></a></p>',
                }, {
                    iconImageHref: "<?= Url::to('/images/map_pointer.svg', true) ?>",
                    iconImageSize: [88, 92],
                    iconImageOffset: [-65, -80]
                });

            myMap.geoObjects.add(myPlacemark1)
        }
    </script>

</div>