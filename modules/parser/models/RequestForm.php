<?php

namespace app\modules\parser\models;


use yii\base\Model;

class RequestForm extends Model
{
	public $request;
	
	public function rules()
	{
		return [
			 [['request'], 'string', 'max' => 255],
		];
	}
	
}