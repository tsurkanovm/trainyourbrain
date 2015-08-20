<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\DashboardForm */
/* @var $form ActiveForm */
?>
<div class="dashboard-index">

    <div class="row">
        <div class="col-lg-5">
            <?php
            echo "<p>{$model->name}</p>";
            echo "<p>{$model->role}</p>";
            echo "<p>{$model->gender}</p>";
            echo "<p>{$model->test1_name}</p>";
            echo "<p>{$model->test1_best_result}</p>";
            echo "<p>{$model->test1_best_result_date}</p>";
            echo "<p>{$model->test2_name}</p>";
            echo "<p>{$model->test3_name}</p>";
            echo "<p>{$model->test4_name}</p>";


            ?>
            <?= Html::a('LogOut', ['dashboard/logout'], ['class' => 'btn btn-primary', 'name' => 'logOut', 'data-method' => 'post']) ?>
        </div>
    </div>

</div><!-- dashboard-index -->
