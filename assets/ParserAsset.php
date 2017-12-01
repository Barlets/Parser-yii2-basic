<?php

namespace app\assets;

use yii\web\AssetBundle;

/**
 * Additional frontend application asset bundle.
 */
class ParserAsset extends AssetBundle
{
	public $basePath = '@webroot';
	public $baseUrl = '@web';
	public $css = [
		 'css/site.css',
	];
	public $js = [
	];
	public $depends = [
	
	];
}