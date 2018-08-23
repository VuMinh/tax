<?php
use yii\db\Migration;
class m170403_182720_create_loainoidungkiemtra_table extends Migration
{
	public function up()
	{
		$this->createLoaiNoiDungKiemTraTable();
	}

	private function createLoaiNoiDungKiemTraTable()
	{
		$this->createTable(
			'{{%loainoidungkiemtra}}',
			[
				'id' => $this->primaryKey(),
				'loaiNd' => $this->string(),
				'ghiChu' => $this->text(),
			],
			'ENGINE=InnoDB'
		);
	}

}