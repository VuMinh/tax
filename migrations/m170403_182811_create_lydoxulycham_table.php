<?php
use yii\db\Migration;
class m170403_182811_create_lydoxulycham_table extends Migration
{
	public function up()
	{
		$this->createLyDoXuLyChamTable();
		$this->createLyDoXuLyChamForeignKeys();
	}

	private function createLyDoXuLyChamTable()
	{
		$this->createTable(
			'{{%lydoxulycham}}',
			[
				'id' => $this->primaryKey(),
				'mst' => $this->integer(11),
                'soQdktId'=> $this->integer(7),
				'ngayBc' => $this->string(),
				'vuongMacChinhSach' => $this->boolean(),
				'chuaThongNhatSoLieuGiaiTrinhCham' => $this->boolean(),
				'dvCoCongVanXinTamLui' => $this->boolean(),
				'doiChieuSoLieuVoiCucThue' => $this->boolean(),
				'chuyenHsSangCqCongAnThanhTra' => $this->boolean(),
				'motSoNnKhac' => $this->boolean(),
				'toTrinhBcLanhDao' => $this->boolean(),
				'trichYeuNoiDungTonDong' => $this->text(),
			],
			'ENGINE=InnoDB'
		);
	}
	private function createLyDoXuLyChamForeignKeys()
	{
		$this->addForeignKey('fk_lydoxulycham_mst', 'lydoxulycham','mst', 'nguoinopthue', 'id', 'CASCADE');
        $this->addForeignKey('fk_lydoxulycham_soQdktId', 'lydoxulycham','soQdktId', 'quyetdinhkiemtra', 'id', 'CASCADE');
	}

}