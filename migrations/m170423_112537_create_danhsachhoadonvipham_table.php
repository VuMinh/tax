<?php
use yii\db\Migration;
class m170423_112537_create_danhsachhoadonvipham_table extends Migration
{
	public function up()
	{
		$this->createDanhSachHoaDonViPhamTable();
		$this->createDanhSachHoaDonViPhamForeignKeys();
	}

	private function createDanhSachHoaDonViPhamTable()
	{
		$this->createTable(
			'{{%danhsachhoadonvipham}}',
			[
				'id' => $this->primaryKey(),
				'ngayBaoCao' => $this->dateTime(),
				'coQuanQuanLyThueDnMua' => $this->string(),
				'mstDnMua' => $this->integer(11),
				'kyHieuHoaDon' => $this->string(),
				'soHoaDon' => $this->string(),
				'ngayPhatHanhHoaDon' => $this->dateTime(),
				'tenHangHoa' => $this->string(),
				'giaTriHangChuaThue' => $this->decimal(20,3),
				'thueVat' => $this->decimal(20,3),
				'dauHieuViPham' => $this->text(),
				'tenChuDn' => $this->string(),
				'cmt' => $this->string(),
				'ngayThayDoiChuSoHuuGanNhat' => $this->dateTime(),
				'ngayThayDoiDiaDiemGanNhat' => $this->dateTime(),
				'thongBaoBoTron' => $this->string(),
				'ngayBoTron' => $this->dateTime(),
				'coQuanThueQuanLyDnBan' => $this->string(),
				'mstDnBan' => $this->integer(11),
				'coQuanThueRaQdxl' => $this->string(),
				'ghiChu' => $this->string(),
                'ghiChu1' => $this->string(),
                'ghiChu2' => $this->string(),
			],
			'ENGINE=InnoDB'
		);
	}
	private function createDanhSachHoaDonViPhamForeignKeys()
	{
		$this->addForeignKey('fk_danhsachhoadonvipham_mstdnmua', 'danhsachhoadonvipham','mstDnMua', 'nguoinopthue', 'id', 'CASCADE');
		$this->addForeignKey('fk_danhsachhoadonvipham_mstdnban', 'danhsachhoadonvipham','mstDnBan', 'nguoinopthue', 'id', 'CASCADE');
	}

}