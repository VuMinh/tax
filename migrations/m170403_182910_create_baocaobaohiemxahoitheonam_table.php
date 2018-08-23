<?php
use yii\db\Migration;
class m170403_182910_create_baocaobaohiemxahoitheonam_table extends Migration
{
	public function up()
	{
		$this->createBaoCaoBaoHiemXaHoiTheoNamTable();
		$this->createBaoCaoBaoHiemXaHoiTheoNamForeignKeys();
	}

	private function createBaoCaoBaoHiemXaHoiTheoNamTable()
	{
		$this->createTable(
			'{{%baocaobaohiemxahoitheonam}}',
			[
				'id' => $this->primaryKey(),
				'mst' => $this->integer(11),
				'soQdxlId' => $this->integer(11),
				'namKtbhxh' => $this->integer(),
				'soBhxhPhaiNop' => $this->decimal(20,3),
				'soBhxhDaNop' => $this->decimal(20,3),
				'soKpcdPhaiNop' => $this->decimal(20,3),
				'soKpcdDaNop' => $this->decimal(20,3),
				'laoDongTrichBhxh' => $this->integer(),
				'laoDongChuaTrichBhxh' => $this->integer(),
				'laoDongTrichKpcd' => $this->integer(),
				'laoDongChuaTrichKpcd' => $this->integer(),
				'ghiChu' => $this->text(),
			],
			'ENGINE=InnoDB'
		);
	}
	private function createBaoCaoBaoHiemXaHoiTheoNamForeignKeys()
	{
		$this->addForeignKey('fk_baocaobaohiemxahoitheonam_mst', 'baocaobaohiemxahoitheonam','mst', 'nguoinopthue', 'id', 'CASCADE');
		$this->addForeignKey('fk_baocaobaohiemxahoitheonam_soqdxl', 'baocaobaohiemxahoitheonam','soQdxlId', 'quyetdinhxuly', 'id', 'CASCADE');
	}

}