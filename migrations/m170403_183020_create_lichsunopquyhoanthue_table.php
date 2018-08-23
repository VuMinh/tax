<?php
use yii\db\Migration;
class m170403_183020_create_lichsunopquyhoanthue_table extends Migration
{
	public function up()
	{
		$this->createLichSuNopQuyHoanThueTable();
		$this->createLichSuNopQuyHoanThueForeignKeys();
	}

	private function createLichSuNopQuyHoanThueTable()
	{
		$this->createTable(
			'{{%lichsunopquyhoanthue}}',
			[
				'id' => $this->primaryKey(),
				'soQdThuHoiId' => $this->integer(11),
				'thoiDiemNop' => $this->dateTime(),
				'daNopThueThuHoi' => $this->decimal( 20,3),
				'daNopTienPhatViPham' => $this->decimal( 20,3),
				'daNopTienChamNop' => $this->decimal( 20,3),
			],
			'ENGINE=InnoDB'
		);
	}
	private function createLichSuNopQuyHoanThueForeignKeys()
	{
		$this->addForeignKey('fk_lichsunopquyhoanthue_soqdthuhoihoan', 'lichsunopquyhoanthue','soQdThuHoiId', 'quyetdinhthuhoihoanthue', 'id', 'CASCADE');
	}

}