<?php
use yii\db\Migration;
class m170403_181719_create_truongdoankiemtra_table extends Migration
{
	public function up()
	{
		$this->createTruongDoanKiemTraTable();
	}

	private function createTruongDoanKiemTraTable()
	{
		$this->createTable(
			'{{%truongdoankiemtra}}',
			[
				'id' => $this->primaryKey(),
				'truongDoan' => $this->string(),
				'ghiChu' => $this->text(),
			],
			'ENGINE=InnoDB'
		);
	}

}