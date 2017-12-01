<?php

namespace app\modules\parser\components\managers;

use app\modules\parser\components\interfaces\ParserInterface;
use app\modules\parser\models\Curl;
use Masterminds\HTML5;

class ParserManagerFotos implements ParserInterface
{
	private $url;
	private $products = [];
	
	function getParsingResult($url = 'https://f.ua/')
	{
		$this->url = $url;
		var_dump($url); die;
		return $this->getSite();
		$this->getData();
		return $this->products;
	}
	
	function getData()
	{
		$product = [];
		foreach ($this->getSite() as $item) {
			$product['name'] = $this->getName($item);
			$product['img'] = $this->getImg($item);
			$product['link'] = $this->getLink($item);
			$product['base_url'] = $this->getBaseUrl();
			$product['price'] = $this->getPrice($item);
			array_push($this->products, $product);
		}
	}
	
	function getSite()
	{
		return $site = Curl::curl($this->url);
	}
	
	function getName($item)
	{
		// TODO: Implement getName() method.
	}
	
	function getImg($item)
	{
		// TODO: Implement getImg() method.
	}
	
	function getPrice($item)
	{
		// TODO: Implement getPrice() method.
	}
	
	function getLink($item)
	{
		// TODO: Implement getLink() method.
	}
	
	function getBaseUrl()
	{
		// TODO: Implement getBaseUrl() method.
	}
	
	function parse($pattern, $item)
	{
		// TODO: Implement parse() method.
	}
}