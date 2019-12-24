<?php

namespace app\assets;

use yii\web\AssetBundle;

class AdminAsset extends AssetBundle//it can be delete
{
    public $sourcePath = '@app/modules/admin/web';

    public $css = [];
    public $js = [
        'js/admin.js',
    ];

    public $depends = [];
}