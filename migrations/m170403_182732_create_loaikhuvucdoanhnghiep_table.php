<?php
use yii\db\Migration;
class m170403_182732_create_loaikhuvucdoanhnghiep_table extends Migration
{
	public function up()
	{
		$this->createLoaiKhuVucDoanhNghiepTable();
	}

	private function createLoaiKhuVucDoanhNghiepTable()
	{
		$this->createTable(
			'{{%loaikhuvucdoanhnghiep}}',
			[
				'id' => $this->primaryKey(),
				'loaiKhuVuc' => $this->string(),
				'ghiChu' => $this->text(),
			],
			'ENGINE=InnoDB'
		);
	}

}