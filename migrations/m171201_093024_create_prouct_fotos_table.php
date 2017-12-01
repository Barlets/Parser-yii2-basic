<?php

use yii\db\Migration;

/**
 * Handles the creation of table `prouct_fotos`.
 */
class m171201_093024_create_prouct_fotos_table extends Migration
{
	/**
	 * @inheritdoc
	 */
	public function up()
	{
		$this->createTable('prouct_fotos', [
			 'id'       => $this->primaryKey(),
			 'name'     => $this->string(),
			 'img'      => $this->string(),
			 'link'     => $this->string(),
			 'base_url' => $this->string(),
			 'price'    => $this->integer(),
			 'date'     => $this->date()
		]);
	}
	
	/**
	 * @inheritdoc
	 */
	public function down()
	{
		$this->dropTable('prouct_fotos');
	}
}
