<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\DetailView;
use yii\widgets\Pjax;
use frontend\assets\ProfileAsset;

/* @var $this yii\web\View */
/* @var $model frontend\models\SignupForm */
/* @var $form ActiveForm */

ProfileAsset::register($this);
$this->title = 'User profile';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="signup">

    <h2><?= Html::encode($this->title) ?></h2>

    <?php
    $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]);
    $_user = Yii::$app->user->identity;
    $default_name = $_user->name;
    $default_gender = $_user->gender; ?>


        <?= $form->field($model, 'name', ['inputOptions' => ['value' => $default_name]]) ?>
        <?= $form->field($model, 'gender')->dropDownList(['male' => 'male', 'female' => 'female']) ?>


<div class="form-group">
    <?= $form->field($model, 'photo', ['inputOptions' => ['id'=>'input-2', 'label' => Yii::t('app', 'Выбирете файл аватара'),
        'type'=>'file', 'class'=>'file', 'multiple'=>'false', 'data-show-upload'=>'false', 'data-show-caption'=>'true', 'uploadUrl' => 'dashboard/index']])->fileInput() ?>
</div>

<!--    <input id="input-2" type="file" class="file" multiple="false" data-show-upload="true" data-show-caption="true">-->

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-primary']) ?>
    </div>
    <?php ActiveForm::end();
    ?>

</div><!-- signup -->
