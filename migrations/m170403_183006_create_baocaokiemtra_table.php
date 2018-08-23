<?php
use yii\db\Migration;
class m170403_183006_create_baocaokiemtra_table extends Migration
{
	public function up()
	{
		$this->createBaoCaoKiemTraTable();
		$this->createBaoCaoKiemTraForeignKeys();
	}

	private function createBaoCaoKiemTraTable()
	{
		$this->createTable(
			'{{%baocaokiemtra}}',
			[
				'id' => $this->primaryKey(),
                'doiKiemTra' => $this->string(),
				'mst' => $this->integer(11),
                'nganhNgheKinhDoanh' => $this->string(),
				'soQdktId' => $this->integer(11),
				'qdHtThuocKhRuiRoTrongNam' => $this->boolean(),
				'loaiKhuVucId' => $this->integer(11),
				'loaiQuyMoId' => $this->integer(11),
				'loaiNdktId' => $this->integer(11),
				'kiemTraTheoQuyetToanChiDao' => $this->boolean(),
				'ngayKyBbkt' => $this->dateTime(),
				'soQdXuLyId' => $this->integer(11),
				'truyThuThueGtgt' => $this->decimal( 20,3),
				'truyThuThueTndn' => $this->decimal( 20,3),
				'truyThuTtdb' => $this->decimal( 20,3),
				'monBai' => $this->decimal( 20,3),
				'truyThuThueTncn' => $this->decimal( 20,3),
				'truyThuThueKhac' => $this->decimal( 20,3),
				'truyHoanThueGtgt' => $this->decimal( 20,3),
				'truyHoanThueTncn' => $this->decimal( 20,3),
				'truyHoanThueKhac' => $this->decimal( 20,3),
				'phatTronThue' => $this->decimal( 20,3),
				'tienHoaDon' => $this->decimal( 20,3),
				'phatHanhChinhKhac1020' => $this->decimal( 20,3),
				'phat005' => $this->decimal( 20,3),
				'phatChamNop' => $this->decimal( 20,3),
				'phatKhac' => $this->decimal( 20,3),
				'noDongNamTruocChuyenSang' => $this->decimal( 20,3),
				'noDongPhatSinhTrongNam' => $this->decimal( 20,3),
				'thueMienGiamTheoKeKhai' => $this->decimal( 20,3),
				'thueMienGiamTheoKiemTra' => $this->decimal( 20,3),
				'mienGiamChenhLech' => $this->decimal( 20,3),
				'giamKhauTru' => $this->decimal( 20,3),
				'thueKhongDuocHoan' => $this->decimal( 20,3),
				'anDinh' => $this->text(),
				'giamLo' => $this->decimal( 20,3),
				'ghiChu' => $this->text(),
				'hanhViViPham' => $this->text(),
				'moTaCachThucPhatHien' => $this->text(),
				'trangThaiHoSo' => $this->string(),
			],
			'ENGINE=InnoDB'
		);
	}
	private function createBaoCaoKiemTraForeignKeys()
	{
		$this->addForeignKey('fk_baocaokiemtra_masothue', 'baocaokiemtra','mst', 'nguoinopthue', 'id', 'CASCADE');
		$this->addForeignKey('fk_baocaokiemtra_soqdkt', 'baocaokiemtra','soQdktId', 'quyetdinhkiemtra', 'id', 'CASCADE');
		$this->addForeignKey('fk_baocaokiemtra_loaidnhoanthanhtheokhuvuc', 'baocaokiemtra','loaiKhuVucId', 'loaikhuvucdoanhnghiep', 'id', 'CASCADE');
		$this->addForeignKey('fk_baocaokiemtra_loaidnhoanthanhtheoquymo', 'baocaokiemtra','loaiQuyMoId', 'loaiquymodoanhnghiep', 'id', 'CASCADE');
		$this->addForeignKey('fk_baocaokiemtra_loaindkt', 'baocaokiemtra','loaiNdktId', 'loainoidungkiemtra', 'id', 'CASCADE');
		$this->addForeignKey('fk_baocaokiemtra_soquyetdinhxuly', 'baocaokiemtra','soQdXuLyId', 'quyetdinhxuly', 'id', 'CASCADE');
	}

}