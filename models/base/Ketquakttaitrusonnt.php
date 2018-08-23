<?php

namespace app\models\base;

use Yii;

/**
 * This is the model class for table "ketquakttaitrusonnt".
 *
 * @property integer $id
 * @property integer $chiTieuKiemTraId
 * @property string $nhiemVuKiemTra
 * @property string $soQdkt
 * @property string $ngayQdkt
 * @property integer $nguoiNopThueId
 * @property string $noiDungChuyenDe
 * @property integer $tienDoThucHien
 * @property string $soQdXuLy
 * @property string $ngayQdxl
 * @property string $soKetLuan
 * @property string $ngayKetLuan
 * @property string $doanhNghiepCoViPham
 * @property integer $loaiQuyMoDoanhNghiepId
 * @property integer $loaiNoiDungChuyenDeId
 * @property string $ngayTao
 * @property string $ngayCapNhat
 * @property integer $loaiKhuVucDoanhNghiepId
 * @property string $soThueTruyThuVat
 * @property string $soThueTruyThuTndn
 * @property string $soThueTruyThuTncn
 * @property string $soThueTruyThuTtdb
 * @property string $soThueTruyThuKhac
 * @property string $soThueKhongDuocHoan
 * @property string $soThueTruyHoan
 * @property string $anDinh
 * @property string $tienPhat
 * @property string $tienKkSai
 * @property string $tienPhatNopCham
 * @property string $tienPhatViPhamHanhChinhKhac
 * @property string $noDongNamTruoc
 * @property string $noPhatSinhTrongNam
 * @property string $daNopChoNoDongNamTruoc
 * @property string $daNopPhatSinhTrongNam
 * @property string $conPhaiNopDongNamTruoc
 * @property string $conPhaiNopPhatSinhTrongNam
 * @property string $soThueDuocGiamTheoKeKhai
 * @property string $soThueDuocGiamTheoTtkt
 * @property string $chenhLech
 * @property string $giamLo
 * @property string $giamKhauTru
 * @property string $ghiChu1
 * @property string $ghiChu2
 * @property string $ghiChu3
 * @property string $ghiChu4
 * @property string $ghiChu5
 * @property string $ghiChu6
 *
 * @property Chitieukiemtra $chiTieuKiemTra
 * @property Nguoinopthue $nguoiNopThue
 * @property Loaikhuvucdoanhnghiep $loaiKhuVucDoanhNghiep
 * @property Loainoidungkiemtra $loaiNoiDungChuyenDe
 * @property Loaiquymodoanhnghiep $loaiQuyMoDoanhNghiep
 */
class Ketquakttaitrusonnt extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ketquakttaitrusonnt';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['chiTieuKiemTraId', 'nguoiNopThueId', 'tienDoThucHien', 'loaiQuyMoDoanhNghiepId', 'loaiNoiDungChuyenDeId', 'loaiKhuVucDoanhNghiepId'], 'integer'],
            [['ngayQdkt', 'ngayQdxl', 'ngayKetLuan', 'ngayTao', 'ngayCapNhat'], 'safe'],
            [['soThueTruyThuVat', 'soThueTruyThuTndn', 'soThueTruyThuTncn', 'soThueTruyThuTtdb', 'soThueTruyThuKhac', 'soThueKhongDuocHoan', 'soThueTruyHoan', 'anDinh', 'tienPhat', 'tienKkSai', 'tienPhatNopCham', 'tienPhatViPhamHanhChinhKhac', 'noDongNamTruoc', 'noPhatSinhTrongNam', 'daNopChoNoDongNamTruoc', 'daNopPhatSinhTrongNam', 'conPhaiNopDongNamTruoc', 'conPhaiNopPhatSinhTrongNam', 'soThueDuocGiamTheoKeKhai', 'soThueDuocGiamTheoTtkt', 'chenhLech', 'giamLo', 'giamKhauTru'], 'number'],
            [['nhiemVuKiemTra', 'soQdkt', 'noiDungChuyenDe', 'soQdXuLy', 'soKetLuan', 'doanhNghiepCoViPham', 'ghiChu1', 'ghiChu2', 'ghiChu3', 'ghiChu4', 'ghiChu5', 'ghiChu6'], 'string', 'max' => 255],
            [['chiTieuKiemTraId'], 'exist', 'skipOnError' => true, 'targetClass' => Chitieukiemtra::className(), 'targetAttribute' => ['chiTieuKiemTraId' => 'id']],
            [['nguoiNopThueId'], 'exist', 'skipOnError' => true, 'targetClass' => Nguoinopthue::className(), 'targetAttribute' => ['nguoiNopThueId' => 'id']],
            [['loaiKhuVucDoanhNghiepId'], 'exist', 'skipOnError' => true, 'targetClass' => Loaikhuvucdoanhnghiep::className(), 'targetAttribute' => ['loaiKhuVucDoanhNghiepId' => 'id']],
            [['loaiNoiDungChuyenDeId'], 'exist', 'skipOnError' => true, 'targetClass' => Loainoidungkiemtra::className(), 'targetAttribute' => ['loaiNoiDungChuyenDeId' => 'id']],
            [['loaiQuyMoDoanhNghiepId'], 'exist', 'skipOnError' => true, 'targetClass' => Loaiquymodoanhnghiep::className(), 'targetAttribute' => ['loaiQuyMoDoanhNghiepId' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'chiTieuKiemTraId' => Yii::t('app', 'Chi Tieu Kiem Tra ID'),
            'nhiemVuKiemTra' => Yii::t('app', 'Nhiem Vu Kiem Tra'),
            'soQdkt' => Yii::t('app', 'So Qdkt'),
            'ngayQdkt' => Yii::t('app', 'Ngay Qdkt'),
            'nguoiNopThueId' => Yii::t('app', 'Nguoi Nop Thue ID'),
            'noiDungChuyenDe' => Yii::t('app', 'Noi Dung Chuyen De'),
            'tienDoThucHien' => Yii::t('app', 'Tien Do Thuc Hien'),
            'soQdXuLy' => Yii::t('app', 'So Qd Xu Ly'),
            'ngayQdxl' => Yii::t('app', 'Ngay Qdxl'),
            'soKetLuan' => Yii::t('app', 'So Ket Luan'),
            'ngayKetLuan' => Yii::t('app', 'Ngay Ket Luan'),
            'doanhNghiepCoViPham' => Yii::t('app', 'Doanh Nghiep Co Vi Pham'),
            'loaiQuyMoDoanhNghiepId' => Yii::t('app', 'Loai Quy Mo Doanh Nghiep ID'),
            'loaiNoiDungChuyenDeId' => Yii::t('app', 'Loai Noi Dung Chuyen De ID'),
            'ngayTao' => Yii::t('app', 'Ngay Tao'),
            'ngayCapNhat' => Yii::t('app', 'Ngay Cap Nhat'),
            'loaiKhuVucDoanhNghiepId' => Yii::t('app', 'Loai Khu Vuc Doanh Nghiep ID'),
            'soThueTruyThuVat' => Yii::t('app', 'So Thue Truy Thu Vat'),
            'soThueTruyThuTndn' => Yii::t('app', 'So Thue Truy Thu Tndn'),
            'soThueTruyThuTncn' => Yii::t('app', 'So Thue Truy Thu Tncn'),
            'soThueTruyThuTtdb' => Yii::t('app', 'So Thue Truy Thu Ttdb'),
            'soThueTruyThuKhac' => Yii::t('app', 'So Thue Truy Thu Khac'),
            'soThueKhongDuocHoan' => Yii::t('app', 'So Thue Khong Duoc Hoan'),
            'soThueTruyHoan' => Yii::t('app', 'So Thue Truy Hoan'),
            'anDinh' => Yii::t('app', 'An Dinh'),
            'tienPhat' => Yii::t('app', 'Tien Phat'),
            'tienKkSai' => Yii::t('app', 'Tien Kk Sai'),
            'tienPhatNopCham' => Yii::t('app', 'Tien Phat Nop Cham'),
            'tienPhatViPhamHanhChinhKhac' => Yii::t('app', 'Tien Phat Vi Pham Hanh Chinh Khac'),
            'noDongNamTruoc' => Yii::t('app', 'No Dong Nam Truoc'),
            'noPhatSinhTrongNam' => Yii::t('app', 'No Phat Sinh Trong Nam'),
            'daNopChoNoDongNamTruoc' => Yii::t('app', 'Da Nop Cho No Dong Nam Truoc'),
            'daNopPhatSinhTrongNam' => Yii::t('app', 'Da Nop Phat Sinh Trong Nam'),
            'conPhaiNopDongNamTruoc' => Yii::t('app', 'Con Phai Nop Dong Nam Truoc'),
            'conPhaiNopPhatSinhTrongNam' => Yii::t('app', 'Con Phai Nop Phat Sinh Trong Nam'),
            'soThueDuocGiamTheoKeKhai' => Yii::t('app', 'So Thue Duoc Giam Theo Ke Khai'),
            'soThueDuocGiamTheoTtkt' => Yii::t('app', 'So Thue Duoc Giam Theo Ttkt'),
            'chenhLech' => Yii::t('app', 'Chenh Lech'),
            'giamLo' => Yii::t('app', 'Giam Lo'),
            'giamKhauTru' => Yii::t('app', 'Giam Khau Tru'),
            'ghiChu1' => Yii::t('app', 'Ghi Chu1'),
            'ghiChu2' => Yii::t('app', 'Ghi Chu2'),
            'ghiChu3' => Yii::t('app', 'Ghi Chu3'),
            'ghiChu4' => Yii::t('app', 'Ghi Chu4'),
            'ghiChu5' => Yii::t('app', 'Ghi Chu5'),
            'ghiChu6' => Yii::t('app', 'Ghi Chu6'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getChiTieuKiemTra()
    {
        return $this->hasOne(Chitieukiemtra::className(), ['id' => 'chiTieuKiemTraId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNguoiNopThue()
    {
        return $this->hasOne(Nguoinopthue::className(), ['id' => 'nguoiNopThueId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLoaiKhuVucDoanhNghiep()
    {
        return $this->hasOne(Loaikhuvucdoanhnghiep::className(), ['id' => 'loaiKhuVucDoanhNghiepId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLoaiNoiDungChuyenDe()
    {
        return $this->hasOne(Loainoidungkiemtra::className(), ['id' => 'loaiNoiDungChuyenDeId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLoaiQuyMoDoanhNghiep()
    {
        return $this->hasOne(Loaiquymodoanhnghiep::className(), ['id' => 'loaiQuyMoDoanhNghiepId']);
    }
}
