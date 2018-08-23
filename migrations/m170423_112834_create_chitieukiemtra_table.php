<?php
use yii\db\Migration;
class m170423_112834_create_chitieukiemtra_table extends Migration
{
	public function up()
	{
		$this->createChiTieuKiemTraTable();
	}

	private function createChiTieuKiemTraTable()
	{
		$this->createTable(
			'{{%chitieukiemtra}}',
			[
				'id' => $this->primaryKey(),
				'chiTieuKiemTra' => $this->string(),
				'maChiTieu' => $this->string(),
				'ghiChu' => $this->string(),
			],
			'ENGINE=InnoDB'
		);
	}

}