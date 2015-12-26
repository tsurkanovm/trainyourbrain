<?php
/* @var $this yii\web\View */
use frontend\assets\TestPerfofmingAsset;

TestPerfofmingAsset::register($this);
?>
<h1>dashboard/test</h1>

<div>
    Here is the clock:<span id="clock">0</span>s
</div>
<div id="board">
    <button id="btn_start">Start</button>
    <button id="btn_stop">Pause</button>
    <br/>
    <br/>
</div>

