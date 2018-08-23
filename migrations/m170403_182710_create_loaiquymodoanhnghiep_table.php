<?php
use yii\db\Migration;
class m170403_182710_create_loaiquymodoanhnghiep_table extends Migration
{
	public function up()
	{
		$this->createLoaiQuyMoDoanhNghiepTable();
	}

	private function createLoaiQuyMoDoanhNghiepTable()
	{
		$this->createTable(
			'{{%loaiquymodoanhnghiep}}',
			[
				'id' => $this->primaryKey(),
				'loaiQuyMo' => $this->string(),
				'ghiChu' => $this->text(),
			],
			'ENGINE=InnoDB'
		);
	}

}