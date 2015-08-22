<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
//use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\models\SignupForm */
/* @var $form ActiveForm */
$this->title = 'User profile';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="signup">

    <h2><?= Html::encode($this->title) ?></h2>

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]);
    $_user = Yii::$app->user->identity;
    $default_name = $_user->name;
    $default_gender = $_user->gender;?>

    <?= $form->field($model, 'name', ['inputOptions' => ['value' => $default_name]]) ?>
    <?= $form->field($model, 'gender', ['inputOptions' => ['value' => $default_gender]])->dropDownList(['male' => 'male', 'female' => 'female']) ?>
    <?= $form->field($model, 'photo')->fileInput() ?>

<!--    @todo use ajax for showing photo after choosing the file -->
<!--    //= DetailView::widget([
//        'model' => $model,
//        'attributes' => [
//            'photo:image',
//        ],
//    ]) ?> -->

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-primary']) ?>
    </div>
    <?php ActiveForm::end(); ?>

</div><!-- signup -->
