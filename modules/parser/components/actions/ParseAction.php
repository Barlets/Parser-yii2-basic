<?php

namespace app\modules\parser\components\actions;

use app\modules\parser\components\managers\ParserManager;
use app\modules\parser\components\managers\ParserManagerFotos;
use app\modules\parser\components\managers\ProductManager;
use app\modules\parser\models\Product;
use Yii;
use yii\base\Model;


class ParseAction extends Model
{
	
	private $url = 'https://enko.com.ua/shop/telefoniya/mobilnye-telefony/';
	
	public function init()
	{
		$parser_f = new ParserManagerFotos();
		$parsingResults = $parser_f->getParsingResult();
		var_dump($parser_f);
		echo '---------';
		var_dump($parsingResults);
		die;
		
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
			return true;
		}
		
	}
	
}