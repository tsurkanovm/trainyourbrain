<?php
use yii\helpers\Html;
use yii\helpers\HtmlPurifier;

//var_dump($widget->dataProvider);
//var_dump($model);
?>
<div class="post">

    <table class="table">
        <thead>
        <tr>
            <th><?= Html::encode($model['title']) ?></th>

        </tr>
        </thead>
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
        </tbody>
    </table>

</div>
