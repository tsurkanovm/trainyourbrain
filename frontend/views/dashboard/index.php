<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\models\DashboardForm */
/* @var $form ActiveForm */
?>
<div class="dashboard-index">

    <div class="row">
        <div class="col-lg-5">


            <?= DetailView::widget([
                       'model' => $model,
                        'attributes' => [
                                'name',
                                'role',
                                'gender',
                                'test1_name',
                                'test1_best_result',
                                'test1_best_result_date',
                                'test2_name',
                                'test3_name',
                                'test4_name',
                                'photo:image',
                            ],
                    ]) ?>
            <?= Html::a('LogOut', ['dashboard/logout'], ['class' => 'btn btn-primary', 'name' => 'logOut', 'data-method' => 'post']) ?>
        </div>
    </div>

</div><!-- dashboard-index -->
