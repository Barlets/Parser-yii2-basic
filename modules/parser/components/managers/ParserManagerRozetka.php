<?php

namespace app\modules\parser\components\managers;

use app\modules\parser\components\interfaces\ParserInterface;
use app\modules\parser\models\Curl;
use phpQuery;

class ParserManagerRozetka implements ParserInterface
{
	private $url;
	private $products = [];
	
	function getParsingResult($url = '')
	{
		$this->url = $url;
		
		
		$this->getData();
		return ($this->products);
	}
	
	function getData()
	{
		$product = [];
		
		foreach ($this->getSite()->find('.g-i-tile-l > .g-i-tile.g-i-tile-catalog') as $item) {
			
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
		return phpQuery::newDocument($site);
	}
	
	public function getName($item)
	{
		$item = pq($item);
		return $item->find('.over-wraper a > img')->attr('alt');
	}
	
	public function getImg($item)
	{
		$item = pq($item);
		return $item->find('.over-wraper a > img')->attr('src');
	}
	
	public function getLink($item)
	{
		$item = pq($item);
		return $item->find('.over-wraper a')->attr('href');
	}
	
	public function getPrice($item)
	{
		$item = pq($item);
		$item->find('.over-wraper .g-price-uah > span')->attr('id');
		return 1;
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