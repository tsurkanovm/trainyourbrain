<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\DetailView;
use yii\widgets\Pjax;
use yii\bootstrap\Modal;
use common\components\ListViewWithoutSummary;
use frontend\assets\DashboardAsset;


DashboardAsset::register($this);
?>
<div class="dashboard-index">

    <div class="row">
        <div class="col-lg-5">

            <?=
            Yii::$app->formatter->asImage($user_model->photo, ['width' => "70", 'height' => "70"]);
            ?>
            <?= DetailView::widget([
                'model' => $user_model,
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

    <?php
    Modal::begin([
        'header'=>'<h4>Результаты</h4>',
        'id' => 'modal',
        'size'=>'modal-lg',
    ]);

    echo "<div id='modalContent'></div>";

    Modal::end();
    ?>

</div><!-- dashboard-index -->
