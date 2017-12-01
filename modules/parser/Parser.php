<?php

namespace app\modules\parser;

use Yii;
use yii\base\Application;
use yii\base\BootstrapInterface;
use yii\base\Module;

/**
 * default module definition class
 */
class Parser extends Module implements BootstrapInterface
{
	public $params = [];
	public $modules;
	public $layout = '/parser';
	
	public function init()
	{
		parent::init();
		
		Yii::configure($this, require __DIR__ . '/config/config.php');
		$this->bootstrap(Yii::$app);
	}
	
	/**
	 * Bootstrap method to be called during application bootstrap stage.
	 * @param Application $app the application currently running
	 */
	public function bootstrap($app)
	{
		if ($app instanceof Yii\console\Application) {
			$this->controllerNamespace = 'app\modules\parser\controllers\console';
		}
	}
	
}
