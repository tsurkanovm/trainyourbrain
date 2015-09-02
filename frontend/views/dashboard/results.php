<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\grid\SerialColumn;

/* @var $this yii\web\View */
/* @var $model frontend\models\DashboardForm */
/* @var $form ActiveForm */
?>

    <div class="row">
        <div class="col-lg-5">


            <?=  GridView::widget([
                'dataProvider' => $dataProvider,
                    'columns' => [['class' => SerialColumn::className()],
                        'date_participate',
                        'result',
                ]]
            ) ?>

            <?= Html::a('Вернуться в кабинет', ['dashboard/index'], ['class' => 'btn btn-primary', 'name' => 'Return',]) ?>
        </div>
    </div>





