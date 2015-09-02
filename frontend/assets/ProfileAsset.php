<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class ProfileAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        "css/fileinput.min.css",
    ];
    public $js = [
        "js/fileinput.min.js",
        "js/fileinput_locale_ru.js",
    //    "js/fileinput_locate_uk.js",

    ];
    public $depends = [
        'yii\web\YiiAsset',
    ];
}
//D:\Mikle\WebDesining\xampp\htdocs\trainyourbrain\vendor\kartik-v\bootstrap-fileinput\js\fileinput.js