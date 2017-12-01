<?php

namespace app\modules\parser\controllers;

use app\modules\parser\components\actions\DeleteAction;
use app\modules\parser\components\actions\ParseAction;
use app\modules\parser\models\Product;
use yii\web\Controller;

class DefaultController extends Controller
{
	
	public function actionIndex()
	{
		return $this->render('index');
	}
	
	public function actionList()
	{
		$model = Product::find()->asArray()->all();
		
		return $this->render('list', [
			 'model' => $model
		]);
	}
	
	public function actionParse()
	{
		new ParseAction();
		
		return $this->redirect('list');
	}
	
	public function actionDelete()
	{
		new DeleteAction();
		
		return $this->redirect('list');
	}
}