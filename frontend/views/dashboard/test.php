<?php
/* @var $this yii\web\View */
use frontend\assets\TestPerfofmingAsset;

TestPerfofmingAsset::register($this);
?>
<h1>dashboard/test</h1>

<div>
    <span id="clock">0</span>s
</div>
<div id="board" data-user = <?=$user?> data-test = <?=$test?>>


</div>

<div id="test_tool" data-title = '121212' >
Наведи на меня
</div>