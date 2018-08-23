<?php
use yii\db\Migration;
class m170403_181720_create_nguoinopthue_table extends Migration
{
	public function up()
	{
		$this->createNguoiNopThueTable();
	}

	private function createNguoiNopThueTable()
	{
		$this->createTable(
			'{{%nguoinopthue}}',
			[
				'id' => $this->primaryKey(),
				'maSoThue' => $this->string(),
				'tenNguoiNop' => $this->string(),
				'ghiChu' => $this->text(),
				'nganhNgheKdChinh' => $this->string(),
				'diaChi' => $this->string(500),
				'emailTbThue' => $this->string(),
				'tenNganhNgheKdChinh' => $this->string(),
				'nganhNgheId' => $this->string(),
			],
			'ENGINE=InnoDB'
		);
	}

}