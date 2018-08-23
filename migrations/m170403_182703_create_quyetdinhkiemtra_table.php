<?php
use yii\db\Migration;
class m170403_182703_create_quyetdinhkiemtra_table extends Migration
{
	public function up()
	{
		$this->createQuyetDinhKiemTraTable();
		$this->createQuyetDinhKiemTraForeignKeys();
	}

	private function createQuyetDinhKiemTraTable()
	{
		$this->createTable(
			'{{%quyetdinhkiemtra}}',
			[
				'id' => $this->primaryKey(),
				'soQdKiemTra' => $this->string(),
				'ngayQdKiemTra' => $this->dateTime(),
				'noDongKyTruocChuyenSang' => $this->boolean(),
				'phatSinhTrongKy' => $this->boolean(),
				'nienDoKiemTra' => $this->string(),
				'truongDoanId' => $this->integer(11),
				'ngayCongBoQdkt' => $this->dateTime(),
				'ngayTrinhVbTamDungKt' => $this->dateTime(),
			],
			'ENGINE=InnoDB'
		);
	}
	private function createQuyetDinhKiemTraForeignKeys()
	{
		$this->addForeignKey('fk_quyetdinhkiemtra_truongdoankiemtra', 'quyetdinhkiemtra','truongDoanId', 'truongdoankiemtra', 'id', 'CASCADE');
	}

}