<?php
use yii\helpers\Html;
use yii\helpers\HtmlPurifier;

//var_dump($widget->dataProvider);
//var_dump($model);
?>
<div class="post">

    <table class="table">

            <h4> <?=Html::encode($model->title) ?> </h4>

        <tbody>

        <tr class="success">
            <td>Лучший результат</td>
            <td><?=HtmlPurifier::process( $model->bestResultDate )?></td>
            <td><?=HtmlPurifier::process( $model->bestResult )?></td>
        </tr>


        <tr class="info">
            <td>Последний результат</td>
            <td><?=HtmlPurifier::process( $model->lastResultDate )?></td>
            <td><?=HtmlPurifier::process($model->lastResult)?></td>
        </tr>

        <tr>
            <td>
                <?= Html::a("Все результаты", ['dashboard/results', 'testid' => $model->testid ]) ?>
            </td>
            <td>
                <?= Html::a("Запустить тест", ['dashboard/test', 'testid' => $model->testid ], ['class' => 'btn btn-success', 'name' => 'Test']) ?>
            </td>
            <td>

            </td>


        </tr>

        </tbody>

    </table>


</div>
