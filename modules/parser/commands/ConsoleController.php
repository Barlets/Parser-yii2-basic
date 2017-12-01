<?php

namespace app\modules\parser\commands;

use app\modules\parser\models\Product;
use yii\console\Controller;

class ConsoleController extends Controller
{
	public $url = 'https://enko.com.ua/shop/telefoniya/mobilnye-telefony/';
	
	/**
	 *default test action
	 */
	public function actionIndex()
	{
		echo "Yes, service is running.";
	}
	
	/**
	 * Execute parsing
	 * @return int
	 */
	public function actionParse()
	{

		echo 'Парсинг выполнен и результат сохранён в баз банных';
	}
	
	/**
	 * Execute deleting all entries in db
	 * @return int
	 */
	public function actionDeleteAll()
	{
		if (Product::deleteAll()) {
			echo 'Все записи из базы данных успешно удалены';
			return 1;
		} else {
			echo 'Ошибка удаления';
			return 0;
		}
		
	}
	
}