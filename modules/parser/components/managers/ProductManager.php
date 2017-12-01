<?php

namespace app\modules\parser\components\managers;

use app\modules\parser\models\Product;
use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;


class ProductManager extends ActiveRecord
{
	
	public function getNamesFromDB()
	{
		return ArrayHelper::map(Product::find()->all(), 'id', 'name');
	}
	
	public function getNamesFromParsedSite($parsingResults)
	{
		return ArrayHelper::getColumn($parsingResults, 'name');
	}
	
	public function findIdenticalNames($parsingResults, $update)
	{
		$namesInDbHash = $this->getNamesHashFromDb();
		$namesInParsed = $this->getNamesFromParsedSite($parsingResults);
		
		if ($update) {
			return $this->findAndUpdateExistingRows($namesInDbHash, $namesInParsed);
		}
	}
	
	public function findAndUpdateExistingRows($namesInDbHash, $namesInParsed)
	{
		foreach ($namesInParsed as $key => $value) {
			$namesInParsedHash[$key] = md5($value);
			
			if (in_array($namesInParsedHash, $namesInDbHash)) {
				return true;
			} else {
				$id = $this->getProductId($namesInParsedHash, $namesInDbHash);
				$models = $this->getProductById($id);
				$this->updateDuplicateRow($models);
			}
		}
	}
	
	public function getNamesHashFromDb()
	{
		$namesInDbHash = [];
		
		$namesInDb = $this->getNamesFromDB();
		foreach ($namesInDb as $key => $value) {
			$namesInDbHash[$key] = md5($value);
		}
		return $namesInDbHash;
	}
	
	public function getProductById($id)
	{
		return Product::find()->where(['id' => $id])->all();
	}
	
	public function getProductId($result, $namesInDbHash)
	{
		return array_search(implode($result), $namesInDbHash);
	}
	
	public function updateDuplicateRow($models)
	{
		foreach ($models as $model) {
			$model->update();
		}
	}
	
	
}