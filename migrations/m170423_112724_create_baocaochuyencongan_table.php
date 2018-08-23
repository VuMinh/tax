<?php
use yii\db\Migration;
class m170423_112724_create_baocaochuyencongan_table extends Migration
{
	public function up()
	{
		$this->createBaoCaoChuyenCongAnTable();
		$this->createBaoCaoChuyenCongAnForeignKeys();
	}

	private function createBaoCaoChuyenCongAnTable()
	{
		$this->createTable(
			'{{%baocaochuyencongan}}',
			[
				'id' => $this->primaryKey(),
				'phongChiCuc' => $this->string(),
				'mst' => $this->integer(11),
				'soKetLuanThanhKiemTraDaBanHanh' => $this->string(),
				'doanhSo' => $this->decimal(),
				'thueGtgt' => $this->decimal(),
                'tongSoHoaDon' => $this->integer(),
				'ngayBaoCao' => $this->dateTime(),
				'ngayCapNhat' => $this->dateTime(),
                'ngayKetLuan' => $this->dateTime(),
                'ghiChu' => $this->string(),
                'ghiChu1' => $this->string(),
                'ghiChu2' => $this->string(),
			],
			'ENGINE=InnoDB'
		);
	}
	private function createBaoCaoChuyenCongAnForeignKeys()
	{
		$this->addForeignKey('fk_baocaochuyencongan_mst', 'baocaochuyencongan','mst', 'nguoinopthue', 'id', 'CASCADE');
	}

}