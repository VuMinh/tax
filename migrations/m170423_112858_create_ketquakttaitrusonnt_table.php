<?php
use yii\db\Migration;
class m170423_112858_create_ketquakttaitrusonnt_table extends Migration
{
	public function up()
	{
		$this->createKetQuaKtTaiTruSoNntTable();
		$this->createKetQuaKtTaiTruSoNntForeignKeys();
	}

	private function createKetQuaKtTaiTruSoNntTable()
	{
		$this->createTable(
			'{{%ketquakttaitrusonnt}}',
			[
				'id' => $this->primaryKey(),
				'chiTieuKiemTraId' => $this->integer(11),
				'nhiemVuKiemTra' => $this->string(),
				'soQdkt' => $this->string(),
				'ngayQdkt' => $this->dateTime(),
				'nguoiNopThueId' => $this->integer(11),
				'noiDungChuyenDe' => $this->string(),
				'tienDoThucHien' => $this->boolean(),
				'soQdXuLy' => $this->string(),
				'ngayQdxl' => $this->dateTime(),
				'soKetLuan' => $this->string(),
				'ngayKetLuan' => $this->dateTime(),
				'doanhNghiepCoViPham' => $this->string(),
				'loaiQuyMoDoanhNghiepId' => $this->integer(11),
                'loaiNoiDungChuyenDeId' => $this->integer(11),
				'ngayTao' => $this->dateTime(),
				'ngayCapNhat' => $this->dateTime(),
				'loaiKhuVucDoanhNghiepId' => $this->integer(11),
				'soThueTruyThuVat' => $this->decimal(),
				'soThueTruyThuTndn' => $this->decimal(),
				'soThueTruyThuTncn' => $this->decimal(),
				'soThueTruyThuTtdb' => $this->decimal(),
				'soThueTruyThuKhac' => $this->decimal(),
				'soThueKhongDuocHoan' => $this->decimal(),
				'soThueTruyHoan' => $this->decimal(),
				'anDinh' => $this->decimal(),
				'tienPhat' => $this->decimal(),
				'tienKkSai' => $this->decimal(),
				'tienPhatNopCham' => $this->decimal(),
				'tienPhatViPhamHanhChinhKhac' => $this->decimal(),
				'noDongNamTruoc' => $this->decimal(),
				'noPhatSinhTrongNam' => $this->decimal(),
				'daNopChoNoDongNamTruoc' => $this->decimal(),
				'daNopPhatSinhTrongNam' => $this->decimal(),
				'conPhaiNopDongNamTruoc' => $this->decimal(),
				'conPhaiNopPhatSinhTrongNam' => $this->decimal(),
				'soThueDuocGiamTheoKeKhai' => $this->decimal(),
				'soThueDuocGiamTheoTtkt' => $this->decimal(),
				'chenhLech' => $this->decimal(),
				'giamLo' => $this->decimal(),
				'giamKhauTru' => $this->decimal(),
                'ghiChu1' => $this->string(),
                'ghiChu2' => $this->string(),
                'ghiChu3' => $this->string(),
                'ghiChu4' => $this->string(),
                'ghiChu5' => $this->string(),
                'ghiChu6' => $this->string(),
			],
			'ENGINE=InnoDB'
		);
	}
	private function createKetQuaKtTaiTruSoNntForeignKeys()
	{
		$this->addForeignKey('fk_ketquakttaitrusonnt_chitieu', 'ketquakttaitrusonnt','chiTieuKiemTraId', 'chitieukiemtra', 'id', 'CASCADE');
		$this->addForeignKey('fk_ketquakttaitrusonnt_mst', 'ketquakttaitrusonnt','nguoiNopThueId', 'nguoinopthue', 'id', 'CASCADE');
		$this->addForeignKey('fk_ketquakttaitrusonnt_phanloaitheoquymo', 'ketquakttaitrusonnt','loaiQuyMoDoanhNghiepId', 'loaiquymodoanhnghiep', 'id', 'CASCADE');
		$this->addForeignKey('fk_ketquakttaitrusonnt_phanloaitheohtsh', 'ketquakttaitrusonnt','loaiKhuVucDoanhNghiepId', 'loaikhuvucdoanhnghiep', 'id', 'CASCADE');
        $this->addForeignKey('fk_ketquakttaitrusonnt_phanloaitheonccd', 'ketquakttaitrusonnt','loaiNoiDungChuyenDeId', 'loainoidungkiemtra', 'id', 'CASCADE');
	}

}