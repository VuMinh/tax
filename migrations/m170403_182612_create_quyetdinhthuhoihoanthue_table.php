<?php
use yii\db\Migration;
class m170403_182612_create_quyetdinhthuhoihoanthue_table extends Migration
{
	public function up()
	{
		$this->createQuyetDinhThuHoiHoanThueTable();
	}

	private function createQuyetDinhThuHoiHoanThueTable()
	{
		$this->createTable(
			'{{%quyetdinhthuhoihoanthue}}',
			[
				'id' => $this->primaryKey(),
				'soQdThuHoiHoan' => $this->string(),
				'ngayQdThuHoiHoan' => $this->dateTime(),
                'soTienThueThuHoi' => $this->decimal()
			],
			'ENGINE=InnoDB'
		);
	}

}