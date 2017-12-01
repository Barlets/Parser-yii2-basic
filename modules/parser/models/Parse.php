<?php

namespace app\modules\parser\models;

use app\modules\parser\components\managers\ParserManagerRozetka;
use app\modules\parser\components\managers\ProductManager;
use app\modules\parser\Parser;
use Yii;
use yii\base\Model;


class Parse extends Model
{
	private $url = '';
	private $request = '';
	
	public function parse()
	{
		$config = Parser::getInstance()->params;
		$this->url = $config['rozetka'] . $this->request;
		
		$parser_r = new ParserManagerRozetka();
		$parsingResults = $parser_r->getParsingResult($this->url);

//		$parser = new ParserManagerEnko();
//		$parsingResults = $parser->getParsingResult($this->url);
		
		
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
	
	public function setRequest($request)
	{
		return $this->request = $request;
	}
	
}