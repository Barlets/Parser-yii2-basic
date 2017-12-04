<?php

namespace app\modules\parser\controllers\console;

use app\modules\parser\components\actions\DeleteAction;
use app\modules\parser\components\actions\Parse;
use yii\console\Controller;

class ConsoleController extends Controller
{
	public function actionIndex()
	{
		echo "Yes, service is running.";
	}
	
	
	public function actionParse()
	{
		$parse = new Parse();
		if ($parse) {
			echo 'Парсинг выполнен и результат сохранён в баз банных';
			return 1;
		} else {
			echo 'Парсинг выполнен и результат сохранён в баз банных';
			return 1;
		}
		
	}
	
	public function actionDelete()
	{
		$delete = new DeleteAction();
		if ($delete) {
			echo 'Данные успешно удалены';
			return 1;
		} else {
			echo 'Ошибка удаления';
			return 0;
		}
		
	}
	
}