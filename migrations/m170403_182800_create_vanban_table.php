<?php
use yii\db\Migration;
class m170403_182800_create_vanban_table extends Migration
{
	public function up()
	{
		$this->createVanBanTable();
	}

	private function createVanBanTable()
	{
		$this->createTable(
			'{{%vanban}}',
			[
				'id' => $this->primaryKey(),
				'soVb' => $this->string(),
				'ghiChu' => $this->text(),
				'ngayVb' => $this->string(),
				'soTienThue' => $this->decimal(20,3),
				'soTienLai' => $this->decimal(20,3),
			],
			'ENGINE=InnoDB'
		);
	}

}