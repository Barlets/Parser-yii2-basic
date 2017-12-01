<?php

namespace app\modules\parser\components\interfaces;

interface ParserInterface
{
	function getParsingResult($url = '');
	
	function getData();
	
	function getSite();
	
	function getName($item);
	
	function getImg($item);
	
	function getPrice($item);
	
	function getLink($item);
	
	function getBaseUrl();
	
	function parse($pattern, $item);
	
}