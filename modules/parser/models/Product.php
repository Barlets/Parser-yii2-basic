<?php

namespace app\modules\parser\models;

/**
 * This is the model class for table "product".
 * @property integer $id
 * @property string $name
 * @property string $img
 * @property string $link
 * @property string $base_url
 * @property integer $price
 * @property string $date
 */
class Product extends \yii\db\ActiveRecord
{
	/**
	 * @inheritdoc
	 */
	public static function tableName()
	{
		return 'product';
	}
	
	/**
	 * @inheritdoc
	 */
	public function rules()
	{
		return [
			 [['name', 'img', 'link', 'price'], 'required'],
			 [['name', 'img', 'link', 'base_url'], 'string', 'max' => 255],
			 [['price'], 'integer'],
			 [['date'], 'date', 'format' => 'php:Y-m-d'],
			 [['date'], 'default', 'value' => date('Y-m-d')],
		];
	}
	
	
	/**
	 * @inheritdoc
	 */
	public function attributeLabels()
	{
		return [
			 'id'       => 'ID',
			 'name'     => 'Имя',
			 'img'      => 'Изображение',
			 'link'     => 'Ссылка',
			 'base_url' => 'Base Url',
			 'price'    => 'Цена',
			 'date'     => 'Дата',
		];
	}
}
