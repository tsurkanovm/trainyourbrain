<?php
use yii\helpers\Html;
use yii\helpers\HtmlPurifier;

//var_dump($widget->dataProvider);
//var_dump($model);
?>
<div class="post">
    <h4><?= Html::encode($model['title']) ?></h4>

    <div>
        <?= 'Last result - ' . HtmlPurifier::process(Yii::$app->formatter->asDate($model['lastDate'], 'medium')) ?>
        <?= '  -  ' ?>
        <?= HtmlPurifier::process($model['lastResult']) . ' sec.' ?>
    </div>

    <div>
        <?= 'Best result - ' . HtmlPurifier::process(Yii::$app->formatter->asDate($model['bestDate'], 'medium')) ?>
        <?= '  -  ' ?>
        <?= HtmlPurifier::process($model['bestResult']) . ' sec.' ?>
    </div>

</div>
