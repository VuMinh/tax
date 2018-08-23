<?php

use yii\db\Migration;

class m170521_151640_update_type_data_all_table extends Migration
{
    public function up()
    {
        /*update baocaobaohiemxahoitheonam*/
        $this->alterColumn('baocaobaohiemxahoitheonam', 'soBhxhPhaiNop', 'decimal(20,0)');
        $this->alterColumn('baocaobaohiemxahoitheonam', 'soBhxhDaNop', 'decimal(20,0)');
        $this->alterColumn('baocaobaohiemxahoitheonam', 'soKpcdPhaiNop', 'decimal(20,0)');
        $this->alterColumn('baocaobaohiemxahoitheonam', 'soKpcdDaNop', 'decimal(20,0)');

        /*update baocaokiemtra*/
        $this->alterColumn('baocaokiemtra', 'truyThuThueGtgt', 'decimal(20,0)');
        $this->alterColumn('baocaokiemtra', 'truyThuThueTndn', 'decimal(20,0)');
        $this->alterColumn('baocaokiemtra', 'truyThuTtdb', 'decimal(20,0)');
        $this->alterColumn('baocaokiemtra', 'monBai', 'decimal(20,0)');
        $this->alterColumn('baocaokiemtra', 'truyThuThueTncn', 'decimal(20,0)');
        $this->alterColumn('baocaokiemtra', 'truyThuThueKhac', 'decimal(20,0)');
        $this->alterColumn('baocaokiemtra', 'truyHoanThueGtgt', 'decimal(20,0)');
        $this->alterColumn('baocaokiemtra', 'truyHoanThueTncn', 'decimal(20,0)');
        $this->alterColumn('baocaokiemtra', 'truyHoanThueKhac', 'decimal(20,0)');
        $this->alterColumn('baocaokiemtra', 'phatTronThue', 'decimal(20,0)');
        $this->alterColumn('baocaokiemtra', 'tienHoaDon', 'decimal(20,0)');
        $this->alterColumn('baocaokiemtra', 'phatHanhChinhKhac1020', 'decimal(20,0)');
        $this->alterColumn('baocaokiemtra', 'phat005', 'decimal(20,0)');
        $this->alterColumn('baocaokiemtra', 'phatChamNop', 'decimal(20,0)');
        $this->alterColumn('baocaokiemtra', 'phatKhac', 'decimal(20,0)');
        $this->alterColumn('baocaokiemtra', 'noDongNamTruocChuyenSang', 'decimal(20,0)');
        $this->alterColumn('baocaokiemtra', 'noDongPhatSinhTrongNam', 'decimal(20,0)');
        $this->alterColumn('baocaokiemtra', 'thueMienGiamTheoKeKhai', 'decimal(20,0)');
        $this->alterColumn('baocaokiemtra', 'thueMienGiamTheoKiemTra', 'decimal(20,0)');
        $this->alterColumn('baocaokiemtra', 'mienGiamChenhLech', 'decimal(20,0)');
        $this->alterColumn('baocaokiemtra', 'giamKhauTru', 'decimal(20,0)');
        $this->alterColumn('baocaokiemtra', 'thueKhongDuocHoan', 'decimal(20,0)');
        $this->alterColumn('baocaokiemtra', 'giamLo', 'decimal(20,0)');

        /*update baocaotaphopkthd*/
        $this->alterColumn('baocaotaphopkthd', 'soTienPhatViPhamQuaKt', 'decimal(20,0)');
        $this->alterColumn('baocaotaphopkthd', 'soTienPhatDaNop', 'decimal(20,0)');

        /*update baocaothanhtra*/
        $this->alterColumn('baocaothanhtra', 'vatTruyThu', 'decimal(20,0)');
        $this->alterColumn('baocaothanhtra', 'tndn', 'decimal(20,0)');
        $this->alterColumn('baocaothanhtra', 'ttdb', 'decimal(20,0)');
        $this->alterColumn('baocaothanhtra', 'tncn', 'decimal(20,0)');
        $this->alterColumn('baocaothanhtra', 'monBai', 'decimal(20,0)');
        $this->alterColumn('baocaothanhtra', 'tienPhat1020', 'decimal(20,0)');
        $this->alterColumn('baocaothanhtra', 'tienPhat005', 'decimal(20,0)');

        /*update danhsachhoadonvipham*/
        $this->alterColumn('danhsachhoadonvipham', 'giaTriHangChuaThue', 'decimal(20,0)');
        $this->alterColumn('danhsachhoadonvipham', 'thueVat', 'decimal(20,0)');

        /*update lichsunopquyhoanthue*/
        $this->alterColumn('lichsunopquyhoanthue', 'daNopThueThuHoi', 'decimal(20,0)');
        $this->alterColumn('lichsunopquyhoanthue', 'daNopTienPhatViPham', 'decimal(20,0)');
        $this->alterColumn('lichsunopquyhoanthue', 'daNopTienChamNop', 'decimal(20,0)');

        /*update lichsunopsaukiemtra*/
        $this->alterColumn('lichsunopsaukiemtra', 'daNopDongNamTruoc', 'decimal(20,0)');
        $this->alterColumn('lichsunopsaukiemtra', 'daNopPhatSinhTruyThu', 'decimal(20,0)');
        $this->alterColumn('lichsunopsaukiemtra', 'daNopPhatSinhTruyHoan', 'decimal(20,0)');
        $this->alterColumn('lichsunopsaukiemtra', 'daNopTienPhat', 'decimal(20,0)');

        /*update lichsunopthanhtra*/
        $this->alterColumn('lichsunopthanhtra', 'daNopThue', 'decimal(20,0)');
        /*update quyetdinhthuhoihoanthue*/
        $this->alterColumn('quyetdinhthuhoihoanthue', 'soTienThueThuHoi', 'decimal(20,0)');

        /*update quyetdinhxuphat*/
        $this->alterColumn('quyetdinhxuphat', 'soTienPhatViPham', 'decimal(20,0)');
        $this->alterColumn('quyetdinhxuphat', 'tienChamNop', 'decimal(20,0)');
        $this->alterColumn('quyetdinhxuphat', 'phatChamNopThueVat', 'decimal(20,0)');
        $this->alterColumn('quyetdinhxuphat', 'phatChamNopThueTncn', 'decimal(20,0)');
        $this->alterColumn('quyetdinhxuphat', 'phatChamNopThueTtdb', 'decimal(20,0)');
        $this->alterColumn('quyetdinhxuphat', 'phatChamNopThueKhac', 'decimal(20,0)');
        $this->alterColumn('quyetdinhxuphat', 'tienPhat1', 'decimal(20,0)');
        $this->alterColumn('quyetdinhxuphat', 'tienPhat2', 'decimal(20,0)');
        $this->alterColumn('quyetdinhxuphat', 'tienPhat3', 'decimal(20,0)');
        $this->alterColumn('quyetdinhxuphat', 'tienPhat4', 'decimal(20,0)');
        $this->alterColumn('quyetdinhxuphat', 'tienPhat5', 'decimal(20,0)');
        $this->alterColumn('quyetdinhxuphat', 'tienPhat6', 'decimal(20,0)');
        $this->alterColumn('quyetdinhxuphat', 'tienPhat7', 'decimal(20,0)');

        /*update sotheodoisauhoanthue*/
        $this->alterColumn('sotheodoisauhoanthue', 'soThueDeNghiHoan', 'decimal(20,0)');
        $this->alterColumn('sotheodoisauhoanthue', 'soThueKhongDuocHoan', 'decimal(20,0)');
        $this->alterColumn('sotheodoisauhoanthue', 'soTienThuHoi', 'decimal(20,0)');
        /*update vanban*/
        $this->alterColumn('vanban', 'soTienThue', 'decimal(20,0)');
        $this->alterColumn('vanban', 'soTienLai', 'decimal(20,0)');

    }

    public function down()
    {
        echo "m170521_151640_update_type_data_all_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }

    public function safeDown()
    {
    }
    */
}
