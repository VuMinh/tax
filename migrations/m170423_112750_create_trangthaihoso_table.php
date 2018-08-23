<?php
use yii\db\Migration;
class m170423_112750_create_trangthaihoso_table extends Migration
{
	public function up()
	{
		$this->createTrangThaiHoSoTable();
	}

	private function createTrangThaiHoSoTable()
	{
		$this->createTable(
			'{{%trangthaihoso}}',
			[
				'id' => $this->primaryKey(),
				'trangThaiHs' => $this->string(),
				'ghiChu' => $this->string(),
			],
			'ENGINE=InnoDB'
		);
	}

}