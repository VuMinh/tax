<?php
use yii\db\Migration;
class m170403_182349_create_quyetdinhtruythu_table extends Migration
{
	public function up()
	{
		$this->createQuyetDinhTruyThuTable();
	}

	private function createQuyetDinhTruyThuTable()
	{
		$this->createTable(
			'{{%quyetdinhtruythu}}',
			[
				'id' => $this->primaryKey(),
				'soQdTruyThu' => $this->string(),
				'ngayQdTruyThu' => $this->dateTime(),
			],
			'ENGINE=InnoDB'
		);
	}

}