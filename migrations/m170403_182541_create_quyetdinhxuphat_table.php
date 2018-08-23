<?php
use yii\db\Migration;
class m170403_182541_create_quyetdinhxuphat_table extends Migration
{
	public function up()
	{
		$this->createQuyetDinhXuPhatTable();
	}

	private function createQuyetDinhXuPhatTable()
	{
		$this->createTable(
			'{{%quyetdinhxuphat}}',
			[
				'id' => $this->primaryKey(),
				'soQdXuPhat' => $this->string(),
				'ngayQdXuPhat' => $this->dateTime(),
				'soTienPhatViPham' => $this->decimal(20,3),
				'tienChamNop' => $this->decimal(20,3),
			],
			'ENGINE=InnoDB'
		);
	}

}