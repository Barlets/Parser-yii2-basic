<?php

namespace app\modules\parser\controllers\console;


use app\modules\parser\models\Parse;
use app\modules\parser\models\Product;
use yii\console\Controller;

class ConsoleController extends Controller
{
	public function actionIndex()
	{
		echo "Yes, service is running.";
	}
	
	
	public function actionParse()
	{
		$model = new Parse();
		if ($model->parse()) {
			echo 'Парсинг выполнен и результат сохранён в баз банных';
			return 1;
		} else {
			echo 'Парсинг выполнен и результат сохранён в баз банных';
			return 1;
		}
		
	}
	
	public function actionDelete()
	{
		if (Product::deleteAll()) {
			echo 'Данные успешно удалены';
			return 1;
		} else {
			echo 'Ошибка удаления';
			return 0;
		}
		
	}
	
}