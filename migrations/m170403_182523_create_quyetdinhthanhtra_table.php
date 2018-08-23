<?php
use yii\db\Migration;
class m170403_182523_create_quyetdinhthanhtra_table extends Migration
{
	public function up()
	{
		$this->createQuyetDinhThanhTraTable();
	}

	private function createQuyetDinhThanhTraTable()
	{
		$this->createTable(
			'{{%quyetdinhthanhtra}}',
			[
				'id' => $this->primaryKey(),
				'soQdThanhTra' => $this->string(),
				'ngayQdThanhTra' => $this->dateTime(),
			],
			'ENGINE=InnoDB'
		);
	}

}