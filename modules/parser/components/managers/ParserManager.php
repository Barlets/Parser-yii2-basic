<?php

namespace app\modules\parser\components\managers;

use app\modules\parser\components\interfaces\ParserInterface;
use app\modules\parser\models\Curl;


class ParserManager implements ParserInterface
{
	private $url;
	private $products = [];

	public function getParsingResult($url = '')
	{
		$this->url = $url;
		$this->getData();
		return $this->products;
	}
	
	public function getData()
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
	
	public function getSite()
	{
		$site = Curl::curl($this->url);
		
		$pattern = "/\<div[^\>]*class\=\"catalog_item\".*/";
		preg_match_all($pattern, $site, $catalog_item);
		return array_pop($catalog_item);
	}
	
	public function getName($item)
	{
		$pattern = '/class="cat_title".+?<h2\>(.+?)<\/h2>/';
		return $this->parse($pattern, $item);
	}
	
	public function getImg($item)
	{
		$pattern = '/<img.+?src="(.+?)".+?/';
		return $this->parse($pattern, $item);
	}
	
	public function getPrice($item)
	{
		$pattern = '/class="iprice_c">(.+?)<\/span>/';
		return $price_int = (int)preg_replace('/\s/', '', $this->parse($pattern, $item));
	}
	
	public function getLink($item)
	{
		$pattern = '/<a.+?href="(.+?)".+?/';
		return $this->parse($pattern, $item);
	}
	
	public function getBaseUrl()
	{
		$pattern = '/(https:\/\/.+?)\//';
		return $this->parse($pattern, $this->url);
	}
	
	public function parse($pattern, $item)
	{
		preg_match_all($pattern, $item, $match);
		$result = array_pop($match);
		return array_pop($result);
	}
	
}