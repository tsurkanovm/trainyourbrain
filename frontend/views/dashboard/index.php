<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\DetailView;
use common\component\ListViewWithoutSummary;

/* @var $this yii\web\View */
/* @var $model frontend\models\DashboardForm */
/* @var $form ActiveForm */
?>
<div class="dashboard-index">

    <div class="row">
        <div class="col-lg-5">

            <?=
            Yii::$app->formatter->asImage($model->photo, ['width' => "70", 'height' => "70"]);
            ?>
            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    'name',
                    'role',
                ],
            ]) ?>

            <?= Html::a('Edit user profile', ['dashboard/profile']) ?>

        </div>
    </div>

    <br/>
    <br/>

    <div class="row">
        <div class="col-lg-5">

            <?= ListViewWithoutSummary::widget([
            'dataProvider' => $dataProvider,
            'itemView' => 'itemListResult',
            ]);?>
        </div>
    </div>

    <br/>
    <br/>
    <?= Html::a('LogOut', ['dashboard/logout'], ['class' => 'btn btn-primary', 'name' => 'logOut', 'data-method' => 'post']) ?>


</div><!-- dashboard-index -->
