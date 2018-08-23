<?php
use yii\db\Migration;
class m170423_112805_create_ketquakiemtrataicoquanthue_table extends Migration
{
	public function up()
	{
		$this->createKetQuaKiemTraTaiCoQuanThueTable();
		$this->createKetQuaKiemTraTaiCoQuanThueForeignKeys();
	}

	private function createKetQuaKiemTraTaiCoQuanThueTable()
	{
		$this->createTable(
			'{{%ketquakiemtrataicoquanthue}}',
			[
				'id' => $this->primaryKey(),
				'phongBan' => $this->string(),
				'ngayTao' => $this->dateTime(),
				'trangThaiHoSoId' => $this->integer(11),
				'ngayCapNhat' => $this->dateTime(),
				'tongThueDieuChinhTang' => $this->decimal(),
				'tongThueDieuChinhGiam' => $this->decimal(),
				'anDinh' => $this->decimal(),
				'giamKhauTru' => $this->decimal(),
				'giamLo' => $this->decimal(),
				'tienDuocMineTang' => $this->decimal(),
				'tienDuocMienGiam' => $this->decimal(),
				'nguoiNopThueId' => $this->integer(11),
                'ghiChu1' => $this->string(),
                'ghiChu2' => $this->string(),
                'ghiChu3' => $this->string(),
			],
			'ENGINE=InnoDB'
		);
	}
	private function createKetQuaKiemTraTaiCoQuanThueForeignKeys()
	{
		$this->addForeignKey('fk_ketquakiemtrataicoquanthue_trangthaihoso', 'ketquakiemtrataicoquanthue','trangThaiHoSoId', 'trangthaihoso', 'id', 'CASCADE');
		$this->addForeignKey('fk_ketquakiemtrataicoquanthue_mst', 'ketquakiemtrataicoquanthue','nguoiNopThueId', 'nguoinopthue', 'id', 'CASCADE');
	}

}