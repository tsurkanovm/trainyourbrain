<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\SignupForm */
/* @var $form ActiveForm */
$this->title = 'Sign up';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="signup">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>Please fill out the following fields to sign up:</p>

    <?php $form = ActiveForm::begin( ); ?>

        <?= $form->field($model, 'email') ?>
        <?= $form->field($model, 'name') ?>
        <?= $form->field($model, 'password')->passwordInput() ?>
    
        <div class="form-group">
            <?= Html::submitButton(Yii::t('app', 'Submit'), ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div><!-- signup -->
