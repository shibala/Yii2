<?php
/**
 * Created by PhpStorm.
 */

namespace app\assets;


use yii\web\AssetBundle;

class CalenderAsset extends AssetBundle
{
    public $sourcePath = '@app/views/calender';

    public $css = [
        'css/calender.css',
    ];
    public $js = [
        'js/calenderScript.js',
    ];
    public $depends = [
        '\app\assets\AppAsset',
    ];
}