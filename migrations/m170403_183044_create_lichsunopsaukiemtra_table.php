<?php
use yii\db\Migration;
class m170403_183044_create_lichsunopsaukiemtra_table extends Migration
{
	public function up()
	{
		$this->createLichSuNopSauKiemTraTable();
		$this->createLichSuNopSauKiemTraForeignKeys();
	}

	private function createLichSuNopSauKiemTraTable()
	{
		$this->createTable(
			'{{%lichsunopsaukiemtra}}',
			[
				'id' => $this->primaryKey(),
				'soQdktId' => $this->integer(11),
				'thoiDiemNop' => $this->dateTime(),
				'daNopDongNamTruoc' => $this->decimal( 20,3),
				'daNopPhatSinhTruyThu' => $this->decimal( 20,3),
				'daNopPhatSinhTruyHoan' => $this->decimal( 20,3),
				'daNopTienPhat' => $this->decimal( 20,3),
			],
			'ENGINE=InnoDB'
		);
	}
	private function createLichSuNopSauKiemTraForeignKeys()
	{
		$this->addForeignKey('fk_lichsunopsaukiemtra_soqdkt', 'lichsunopsaukiemtra','soQdktId', 'baocaokiemtra', 'id', 'CASCADE');
	}

}