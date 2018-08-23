<?php
use yii\db\Migration;
class m170403_182926_create_baocaothanhtra_table extends Migration
{
	public function up()
	{
		$this->createBaoCaoThanhTraTable();
		$this->createBaoCaoThanhTraForeignKeys();
	}

	private function createBaoCaoThanhTraTable()
	{
		$this->createTable(
			'{{%baocaothanhtra}}',
			[
				'id' => $this->primaryKey(),
				'soQdThanhTraId' => $this->integer(11),
				'mst' => $this->integer(11),
				'truongDoan' => $this->string(),
				'vatTruyThu' => $this->decimal(20,3),
				'tndn' => $this->decimal(20,3),
				'ttdb' => $this->decimal(20,3),
				'tncn' => $this->decimal(20,3),
				'monBai' => $this->decimal(20,3),
				'tienPhat1020' => $this->decimal(20,3),
				'tienPhat005' => $this->decimal(20,3),
				'soQdTruyThuId' => $this->integer(11),
                'doiKiemTra' => $this->string()
			],
			'ENGINE=InnoDB'
		);
	}
	private function createBaoCaoThanhTraForeignKeys()
	{
		$this->addForeignKey('fk_baocaothanhtra_soqdthanhtra', 'baocaothanhtra','soQdThanhTraId', 'quyetdinhthanhtra', 'id', 'CASCADE');
		$this->addForeignKey('fk_baocaothanhtra_mst', 'baocaothanhtra','mst', 'nguoinopthue', 'id', 'CASCADE');
		$this->addForeignKey('fk_baocaothanhtra_soqdtruythu', 'baocaothanhtra','soQdTruyThuId', 'quyetdinhtruythu', 'id', 'CASCADE');
	}

}