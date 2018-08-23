<?php
use yii\db\Migration;
class m170403_182830_create_baocaotaphopkthd_table extends Migration
{
	public function up()
	{
		$this->createBaoCaoTapHopKtHdTable();
	}

	private function createBaoCaoTapHopKtHdTable()
	{
		$this->createTable(
			'{{%baocaotaphopkthd}}',
			[
				'id' => $this->primaryKey(),
				'coQuanThue' => $this->string(),
				'soHsPhaiKiemTra' => $this->integer(),
				'soHsktDaHt' => $this->integer(),
				'soHsktCoSaiSotNghiVan' => $this->integer(),
				'tomTatNdSaiSotNghiVan' => $this->text(),
				'cacKienNghiVeHsDaKt' => $this->text(),
				'soTienPhatViPhamQuaKt' => $this->decimal(20,3),
				'soTienPhatDaNop' => $this->decimal(20,3),
				'ngayBatDauKyBaoCao' => $this->dateTime(),
				'ngayKetThucKyBaoCao' => $this->dateTime(),
			],
			'ENGINE=InnoDB'
		);
	}

}