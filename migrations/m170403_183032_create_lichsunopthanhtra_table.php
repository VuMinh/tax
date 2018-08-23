<?php
use yii\db\Migration;
class m170403_183032_create_lichsunopthanhtra_table extends Migration
{
	public function up()
	{
		$this->createLichSuNopThanhTraTable();
		$this->createLichSuNopThanhTraForeignKeys();
	}

	private function createLichSuNopThanhTraTable()
	{
		$this->createTable(
			'{{%lichsunopthanhtra}}',
			[
				'id' => $this->primaryKey(),
				'soQdThanhTra' => $this->integer(11),
				'ngayNop' => $this->dateTime(),
				'daNopThue' => $this->decimal( 20,3),
			],
			'ENGINE=InnoDB'
		);
	}
	private function createLichSuNopThanhTraForeignKeys()
	{
//		$this->addForeignKey('fk_lichsunopthanhtra_soqdthanhtra', 'lichsunopthanhtra','soQdThanhTra', 'baocaothanhtra', 'id', 'CASCADE');
	}

}