<?php
use yii\db\Migration;
class m170403_181838_create_nganhnghe_table extends Migration
{
	public function up()
	{
		$this->createNganhNgheTable();
	}

	private function createNganhNgheTable()
	{
		$this->createTable(
			'{{%nganhnghe}}',
			[
				'id' => $this->primaryKey(),
				'maNganhNgheKdChinh' => $this->string(),
				'tenNganhNgheKdChinh' => $this->string(),
				'ghiChu' => $this->text(),
			],
			'ENGINE=InnoDB'
		);
	}

}