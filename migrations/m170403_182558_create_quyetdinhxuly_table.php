<?php
use yii\db\Migration;
class m170403_182558_create_quyetdinhxuly_table extends Migration
{
	public function up()
	{
		$this->createQuyetDinhXuLyTable();
	}

	private function createQuyetDinhXuLyTable()
	{
		$this->createTable(
			'{{%quyetdinhxuly}}',
			[
				'id' => $this->primaryKey(),
				'soQdXuLy' => $this->string(),
				'ngayQdXuLy' => $this->dateTime(),
			],
			'ENGINE=InnoDB'
		);
	}

}