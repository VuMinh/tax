<?php
use yii\db\Migration;
class m170403_182852_create_baocaobaohiemxahoi_table extends Migration
{
	public function up()
	{
		$this->createBaoCaoBaoHiemXaHoiTable();
		$this->createBaoCaoBaoHiemXaHoiForeignKeys();
	}

	private function createBaoCaoBaoHiemXaHoiTable()
	{
		$this->createTable(
			'{{%baocaobaohiemxahoi}}',
			[
				'id' => $this->primaryKey(),
				'mst' => $this->integer(11),
				'soQdxlId' => $this->integer(11),
				'viPhamBhxh' => $this->boolean(),
				'viPhamKpcd' => $this->boolean(),
				'ghiChu' => $this->text(),
				'coKtndKpcd' => $this->boolean(),
				'coKtndBhxh' => $this->boolean(),
				'soDvThanhTraKiemTraHoanThanh' => $this->integer(),
                'phongChiCucThue' =>$this->string()
			],
			'ENGINE=InnoDB'
		);
	}
	private function createBaoCaoBaoHiemXaHoiForeignKeys()
	{
		$this->addForeignKey('fk_baocaobaohiemxahoi_mst', 'baocaobaohiemxahoi','mst', 'nguoinopthue', 'id', 'CASCADE');
		$this->addForeignKey('fk_baocaobaohiemxahoi_soqdxl', 'baocaobaohiemxahoi','soQdxlId', 'quyetdinhxuly', 'id', 'CASCADE');
	}

}