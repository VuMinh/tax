<?php
use yii\db\Migration;
class m170403_182749_create_lydohoanthue_table extends Migration
{
	public function up()
	{
		$this->createLyDoHoanThueTable();
	}

	private function createLyDoHoanThueTable()
	{
		$this->createTable(
			'{{%lydohoanthue}}',
			[
				'id' => $this->primaryKey(),
				'maLyDoHoanThue' => $this->string(),
				'ghiChu' => $this->text(),
				'lyDoHoanThue' => $this->text(),
			],
			'ENGINE=InnoDB'
		);
	}

}