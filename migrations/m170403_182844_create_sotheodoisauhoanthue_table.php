<?php
use yii\db\Migration;
class m170403_182844_create_sotheodoisauhoanthue_table extends Migration
{
	public function up()
	{
		$this->createSoTheoDoiSauHoanThueTable();
		$this->createSoTheoDoiSauHoanThueForeignKeys();
	}

	private function createSoTheoDoiSauHoanThueTable()
	{
		$this->createTable(
			'{{%sotheodoisauhoanthue}}',
			[
				'id' => $this->primaryKey(),
				'mst' => $this->integer(11),
				'maChuong' => $this->string(),
				'laToChuc' => $this->boolean(),
				'loaiHoanThueId' => $this->integer(11),
				'soThueDeNghiHoan' => $this->decimal(20,3),
				'soThueKhongDuocHoan' => $this->decimal(20,3),
				'soQdThanhTraId' => $this->integer(11),
				'soQdKtId' => $this->integer(11),
				'thoiKyThanhTra' => $this->string(),
				'soVbHoanThueId' => $this->integer(11),
				'ghiChu' => $this->text(),
                'soQdThuHoiHoanId' => $this->integer(11),
                'soQdXuPhatId' => $this->integer(11),
				'chiTietHanhViViPham' => $this->text(),
                'truocHoanSauHoan' => $this->boolean(),
			],
			'ENGINE=InnoDB'
		);
	}
	private function createSoTheoDoiSauHoanThueForeignKeys()
	{
		$this->addForeignKey('fk_sotheodoisauhoanthue_masothue', 'sotheodoisauhoanthue','mst', 'nguoinopthue', 'id', 'CASCADE');
		$this->addForeignKey('fk_sotheodoisauhoanthue_truonghophoanthue', 'sotheodoisauhoanthue','loaiHoanThueId', 'lydohoanthue', 'id', 'CASCADE');
		$this->addForeignKey('fk_sotheodoisauhoanthue_soqdthanhtrasauhoan', 'sotheodoisauhoanthue','soQdThanhTraId', 'quyetdinhthanhtra', 'id', 'CASCADE');
		$this->addForeignKey('fk_sotheodoisauhoanthue_soqdkiemtrasauhoan', 'sotheodoisauhoanthue','soQdKtId', 'quyetdinhkiemtra', 'id', 'CASCADE');
		$this->addForeignKey('fk_sotheodoisauhoanthue_sovbhoanthue', 'sotheodoisauhoanthue','soVbHoanThueId', 'vanban', 'id', 'CASCADE');
        $this->addForeignKey('fk_sotheodoisauhoanthue_soqdthuhoihoanthue', 'sotheodoisauhoanthue', 'soQdThuHoiHoanId', 'quyetdinhthuhoihoanthue', 'id', 'CASCADE');
        $this->addForeignKey('fk_sotheodoisauhoanthue_soqdxuphat', 'sotheodoisauhoanthue', 'soQdXuPhatId', 'quyetdinhthuhoihoanthue', 'id', 'CASCADE');
	}

}