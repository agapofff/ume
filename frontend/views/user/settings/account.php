<?php

    use yii\helpers\Url;
    use yii\helpers\Html;
    use yii\widgets\ActiveForm;
    use yii\widgets\Pjax;
    use yii\web\View;

    /**
     * @var yii\web\View $this
     * @var yii\widgets\ActiveForm $form
     * @var dektrium\user\models\User $user
     * @var dektrium\user\models\SettingsForm $model
     */

    $this->title = Yii::t('front', 'Аккаунт');
    // $this->params['breadcrumbs'][] = $this->title;
    
?>

<div class="container-fluid mt-13 px-lg-2 px-xl-3 px-xxl-5 d-none">
    <div class="row justify-content-center">
        <div class="col-lg-6 mb-4 d-none d-lg-block">
            <?= $this->render('_menu') ?>
        </div>
        <div class="col-12 col-sm-10 col-md-8 col-lg-6">
        
            <h1 class="ttfirsneue text-uppercase font-weight-light text-center d-lg-none mb-3">
                <?= $this->title ?>
            </h1>
            
            <?php
                $form = ActiveForm::begin([
                    'id' => 'account-form',
                    // 'action' => '/account',
                    // 'method' => 'get',
                    'enableAjaxValidation' => true,
                    'enableClientValidation' => false,
                    'validateOnBlur' => false,
                    'validateOnType' => false,
                    'validateOnChange' => false,
                ]);
            ?>
            
                <div class="row justify-content-between align-items-center mb-3">
                    <div class="col-auto font-weight-bold text-uppercase">
                        <?= Yii::t('front', 'Персональные данные') ?>
                    </div>
                    <div class="col-auto">
                        <button type="button" class="btn btn-link text-uppercase px-0" onclick="$('#account-form').submit();">
                            <?= Yii::t('front', 'Сохранить') ?>
                        </button>
                    </div>
                </div>
                
                <?= $form
                        ->field($model, 'first_name', [
                            'inputOptions' => [
                                // 'autofocus' => 'autofocus',
                                'class' => 'form-control font-weight-normal mb-0 px-0',
                                'required' => true,
                                'autocomplete' => rand(),
                                'placeholder' => ' ',
                                'value' => $profile->first_name,
                            ],
                            'options' => [
                                'class' => 'form-group mb-3 position-relative floating-label',
                            ],
                            'template' => '{input}{label}{hint}{error}',
                        ])
                        ->label(Yii::t('front', 'Имя'))
                ?>
                
                <?= $form
                        ->field($model, 'last_name', [
                            'inputOptions' => [
                                'class' => 'form-control font-weight-normal mb-0 px-0',
                                'autocomplete' => rand(),
                                'placeholder' => ' ',
                                'value' => $profile->last_name,
                            ],
                            'options' => [
                                'class' => 'form-group mb-3 position-relative floating-label',
                            ],
                            'template' => '{input}{label}{hint}{error}',
                        ])
                        ->label(Yii::t('front', 'Фамилия'))
                ?>
                
                <?= $form
                        ->field($model, 'email', [
                            'inputOptions' => [
                                'class' => 'form-control font-weight-normal mb-0 px-0',
                                'autocomplete' => rand(),
                                'placeholder' => ' ',
                                // 'value' => $profile->email,
                            ],
                            'options' => [
                                'class' => 'form-group mb-3 position-relative floating-label',
                            ],
                            'template' => '{input}{label}{hint}{error}',
                        ])
                ?>
                
                <?= $form
                        ->field($model, 'phone', [
                            'inputOptions' => [
                                'class' => 'form-control font-weight-normal mb-0 px-0',
                                'autocomplete' => rand(),
                                'placeholder' => ' ',
                                'value' => $profile->phone,
                            ],
                            'options' => [
                                'class' => 'form-group mb-3 position-relative floating-label',
                            ],
                            'template' => '{input}{label}{hint}{error}',
                        ])
                ?>
                
                <?= $form
                        ->field($model, 'birthday', [
                            'inputOptions' => [
                                'class' => 'form-control font-weight-normal mb-0 px-0',
                                'placeholder' => ' ',
                                'value' => $profile->birthday,
                            ],
                            'options' => [
                                'class' => 'form-group mb-3 position-relative floating-label',
                            ],
                            'template' => '{input}{label}{hint}{error}',
                        ])
                        ->textInput([
                            'type' => 'date',
                            'placeholder' => ' ',
                        ])
                        ->label(Yii::t('front', 'Дата рождения'))
                ?>
                
                <div class="row justify-content-between align-items-center mt-5 mb-3">
                    <div class="col-auto font-weight-bold text-uppercase">
                        <?= Yii::t('front', 'Пароль') ?>
                    </div>
                    <div class="col-auto">
                        <button type="button" class="btn btn-link text-uppercase px-0" onclick="$('#account-form').submit();">
                            <?= Yii::t('front', 'Сохранить') ?>
                        </button>
                    </div>
                </div>
                
                <?= $form
                        ->field($model, 'current_password', [
                            'inputOptions' => [
                                // 'autofocus' => 'autofocus',
                                'class' => 'form-control font-weight-normal mb-0 px-0',
                                // 'required' => true,
                                'autocomplete' => rand(),
                                'placeholder' => ' ',
                            ],
                            'options' => [
                                'class' => 'form-group mb-3 position-relative floating-label',
                            ],
                            'template' => '{input}{label}{hint}{error}',
                        ])
                        ->passwordInput()
                        // ->hint(Yii::t('front', 'Введите текущий пароль для Вашей учётной записи'))
                ?>
                
                <?= $form
                        ->field($model, 'new_password', [
                            'inputOptions' => [
                                'class' => 'form-control font-weight-normal mb-0 px-0',
                                // 'required' => true,
                                'autocomplete' => rand(),
                                'placeholder' => ' ',
                            ],
                            'options' => [
                                'class' => 'form-group position-relative floating-label',
                            ],
                            'template' => '{input}{label}{hint}{error}',
                        ])
                        ->passwordInput()
                        // ->hint(Yii::t('front', 'Не менее 6 латинских букв, цифр и спец. символов'))
                ?>
                    
                <?= Html::hiddenInput('sex', $model->sex) ?>
                <?= Html::hiddenInput('lang', Yii::$app->language) ?>
                <?= Html::hiddenInput('agree', Yii::$app->language) ?>
                <?= Html::hiddenInput('comment', Yii::$app->language) ?>
                <?= Html::hiddenInput('lottery', Yii::$app->language) ?>

            <?php ActiveForm::end(); ?>
            
        </div>
    </div>
</div>



    
<?php if ($model->module->enableAccountDelete) { ?>
    <hr/>
    <div class="row">
        <div class="col-xs-12 col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2 col-lg-6 col-lg-offset-3">
            <h3 class="text-center"><?= Yii::t('user', 'Delete account') ?></h3>
            <p><?= Yii::t('user', 'Внимание! Удаление аккаунта - необратимая операция') ?>!</p>
            <p><?= Yii::t('user', 'Будут удалены все данные, связанные с Вашей учётной записью') ?>.</p>
            <?= Html::a(Yii::t('user', 'Удалить аккаунт'), ['delete'], [
                'class' => 'btn btn-danger',
                'data-method' => 'post',
                'data-confirm' => Yii::t('user', 'Вы уверены, что хотите удалить Вашу учётную запись без возможности восстановления?'),
            ]) ?>
        </div>
    </div>
<?php } ?>


<?php
    $this->registerJs("
        $('body').on('input', '#settings-form-new_password', function () {
            $('#settings-form-current_password')
                .attr('required', 'required')
                .attr('aria-required', 'true');
        });
    ",
    View::POS_READY,
    'new-password-require');
?>
