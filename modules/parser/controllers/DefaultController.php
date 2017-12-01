<?php

namespace app\modules\parser\controllers;

use app\modules\parser\components\managers\ParserManager;
use app\modules\parser\components\managers\ProductManager;
use app\modules\parser\models\Product;
use yii\web\Controller;
use yii;


class DefaultController extends Controller
{
	private $url = 'https://enko.com.ua/shop/telefoniya/mobilnye-telefony/';
	
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
		$parser = new ParserManager();
		$parsingResults = $parser->getParsingResult($this->url);
		
		if (empty($parsingResults) || !is_array($parsingResults)) {
			Yii::$app->errorHandler->exception;
			return false;
		} else {
			$productManager = new ProductManager();
			$productManager->findIdenticalNames($parsingResults, true);
			
			foreach ($parsingResults as $productItem) {
				$product = new Product();
				$product->load(['Product' => $productItem]);
				$product->save();
			}
		}
		
		return $this->redirect('list');
	}
	
	
	public function actionDeleteAll()
	{
		Product::deleteAll();
		
		return $this->redirect('list');
	}
	
}