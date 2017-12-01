<?php

namespace app\modules\parser\components\actions;


use app\modules\parser\models\Product;
use yii\base\Model;


class DeleteAction extends Model
{
	public function init()
	{
		return Product::deleteAll();
	}
	
}