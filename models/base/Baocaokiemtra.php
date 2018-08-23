<?php

namespace app\models\base;

use Yii;

/**
 * This is the model class for table "baocaokiemtra".
 *
 * @property integer $id
 * @property string $doiKiemTra
 * @property integer $mst
 * @property string $nganhNgheKinhDoanh
 * @property integer $soQdktId
 * @property integer $soQdTruyThuId
 * @property integer $qdHtThuocKhRuiRoTrongNam
 * @property integer $loaiKhuVucId
 * @property integer $loaiQuyMoId
 * @property integer $loaiNdktId
 * @property integer $kiemTraTheoQuyetToanChiDao
 * @property string $ngayKyBbkt
 * @property integer $soQdXuLyId
 * @property string $truyThuThueGtgt
 * @property string $truyThuThueTndn
 * @property string $truyThuTtdb
 * @property string $monBai
 * @property string $truyThuThueTncn
 * @property string $truyThuThueKhac
 * @property string $truyHoanThueGtgt
 * @property string $truyHoanThueTncn
 * @property string $truyHoanThueKhac
 * @property string $phatTronThue
 * @property string $tienHoaDon
 * @property string $phatHanhChinhKhac1020
 * @property string $phat005
 * @property string $phatChamNop
 * @property string $phatKhac
 * @property string $noDongNamTruocChuyenSang
 * @property string $noDongPhatSinhTrongNam
 * @property string $thueMienGiamTheoKeKhai
 * @property string $thueMienGiamTheoKiemTra
 * @property string $mienGiamChenhLech
 * @property string $giamKhauTru
 * @property string $thueKhongDuocHoan
 * @property string $anDinh
 * @property string $giamLo
 * @property string $ghiChu
 * @property string $hanhViViPham
 * @property string $moTaCachThucPhatHien
 * @property string $trangThaiHoSo
 * @property string $chiCucThue
 *
 * @property Loaikhuvucdoanhnghiep $loaiKhuVuc
 * @property Loaiquymodoanhnghiep $loaiQuyMo
 * @property Loainoidungkiemtra $loaiNdkt
 * @property Nguoinopthue $mst0
 * @property Quyetdinhkiemtra $soQdkt
 * @property Quyetdinhxuly $soQdXuLy
 * @property Lichsunopsaukiemtra[] $lichsunopsaukiemtras
 */
class Baocaokiemtra extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'baocaokiemtra';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['mst', 'soQdktId', 'soQdTruyThuId', 'qdHtThuocKhRuiRoTrongNam', 'loaiKhuVucId', 'loaiQuyMoId', 'loaiNdktId', 'kiemTraTheoQuyetToanChiDao', 'soQdXuLyId'], 'integer'],
            [['ngayKyBbkt'], 'safe'],
            [['truyThuThueGtgt', 'truyThuThueTndn', 'truyThuTtdb', 'monBai', 'truyThuThueTncn', 'truyThuThueKhac', 'truyHoanThueGtgt', 'truyHoanThueTncn', 'truyHoanThueKhac', 'phatTronThue', 'tienHoaDon', 'phatHanhChinhKhac1020', 'phat005', 'phatChamNop', 'phatKhac', 'noDongNamTruocChuyenSang', 'noDongPhatSinhTrongNam', 'thueMienGiamTheoKeKhai', 'thueMienGiamTheoKiemTra', 'mienGiamChenhLech', 'giamKhauTru', 'thueKhongDuocHoan', 'giamLo'], 'number'],
            [['anDinh', 'ghiChu', 'hanhViViPham', 'moTaCachThucPhatHien', 'chiCucThue'], 'string'],
            [['doiKiemTra', 'nganhNgheKinhDoanh', 'trangThaiHoSo'], 'string', 'max' => 255],
            [['loaiKhuVucId'], 'exist', 'skipOnError' => true, 'targetClass' => Loaikhuvucdoanhnghiep::className(), 'targetAttribute' => ['loaiKhuVucId' => 'id']],
            [['loaiQuyMoId'], 'exist', 'skipOnError' => true, 'targetClass' => Loaiquymodoanhnghiep::className(), 'targetAttribute' => ['loaiQuyMoId' => 'id']],
            [['loaiNdktId'], 'exist', 'skipOnError' => true, 'targetClass' => Loainoidungkiemtra::className(), 'targetAttribute' => ['loaiNdktId' => 'id']],
            [['mst'], 'exist', 'skipOnError' => true, 'targetClass' => Nguoinopthue::className(), 'targetAttribute' => ['mst' => 'id']],
            [['soQdktId'], 'exist', 'skipOnError' => true, 'targetClass' => Quyetdinhkiemtra::className(), 'targetAttribute' => ['soQdktId' => 'id']],
            [['soQdXuLyId'], 'exist', 'skipOnError' => true, 'targetClass' => Quyetdinhxuly::className(), 'targetAttribute' => ['soQdXuLyId' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'doiKiemTra' => Yii::t('app', 'Doi Kiem Tra'),
            'mst' => Yii::t('app', 'Mst'),
            'nganhNgheKinhDoanh' => Yii::t('app', 'Nganh Nghe Kinh Doanh'),
            'soQdktId' => Yii::t('app', 'So Qdkt ID'),
            'soQdTruyThuId' => Yii::t('app', 'So Qd Truy Thu ID'),
            'qdHtThuocKhRuiRoTrongNam' => Yii::t('app', 'Qd Ht Thuoc Kh Rui Ro Trong Nam'),
            'loaiKhuVucId' => Yii::t('app', 'Loai Khu Vuc ID'),
            'loaiQuyMoId' => Yii::t('app', 'Loai Quy Mo ID'),
            'loaiNdktId' => Yii::t('app', 'Loai Ndkt ID'),
            'kiemTraTheoQuyetToanChiDao' => Yii::t('app', 'Kiem Tra Theo Quyet Toan Chi Dao'),
            'ngayKyBbkt' => Yii::t('app', 'Ngay Ky Bbkt'),
            'soQdXuLyId' => Yii::t('app', 'So Qd Xu Ly ID'),
            'truyThuThueGtgt' => Yii::t('app', 'Truy Thu Thue Gtgt'),
            'truyThuThueTndn' => Yii::t('app', 'Truy Thu Thue Tndn'),
            'truyThuTtdb' => Yii::t('app', 'Truy Thu Ttdb'),
            'monBai' => Yii::t('app', 'Mon Bai'),
            'truyThuThueTncn' => Yii::t('app', 'Truy Thu Thue Tncn'),
            'truyThuThueKhac' => Yii::t('app', 'Truy Thu Thue Khac'),
            'truyHoanThueGtgt' => Yii::t('app', 'Truy Hoan Thue Gtgt'),
            'truyHoanThueTncn' => Yii::t('app', 'Truy Hoan Thue Tncn'),
            'truyHoanThueKhac' => Yii::t('app', 'Truy Hoan Thue Khac'),
            'phatTronThue' => Yii::t('app', 'Phat Tron Thue'),
            'tienHoaDon' => Yii::t('app', 'Tien Hoa Don'),
            'phatHanhChinhKhac1020' => Yii::t('app', 'Phat Hanh Chinh Khac1020'),
            'phat005' => Yii::t('app', 'Phat005'),
            'phatChamNop' => Yii::t('app', 'Phat Cham Nop'),
            'phatKhac' => Yii::t('app', 'Phat Khac'),
            'noDongNamTruocChuyenSang' => Yii::t('app', 'No Dong Nam Truoc Chuyen Sang'),
            'noDongPhatSinhTrongNam' => Yii::t('app', 'No Dong Phat Sinh Trong Nam'),
            'thueMienGiamTheoKeKhai' => Yii::t('app', 'Thue Mien Giam Theo Ke Khai'),
            'thueMienGiamTheoKiemTra' => Yii::t('app', 'Thue Mien Giam Theo Kiem Tra'),
            'mienGiamChenhLech' => Yii::t('app', 'Mien Giam Chenh Lech'),
            'giamKhauTru' => Yii::t('app', 'Giam Khau Tru'),
            'thueKhongDuocHoan' => Yii::t('app', 'Thue Khong Duoc Hoan'),
            'anDinh' => Yii::t('app', 'An Dinh'),
            'giamLo' => Yii::t('app', 'Giam Lo'),
            'ghiChu' => Yii::t('app', 'Ghi Chu'),
            'hanhViViPham' => Yii::t('app', 'Hanh Vi Vi Pham'),
            'moTaCachThucPhatHien' => Yii::t('app', 'Mo Ta Cach Thuc Phat Hien'),
            'trangThaiHoSo' => Yii::t('app', 'Trang Thai Ho So'),
            'chiCucThue' => Yii::t('app', 'Chi Cuc Thue'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLoaiKhuVuc()
    {
        return $this->hasOne(Loaikhuvucdoanhnghiep::className(), ['id' => 'loaiKhuVucId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLoaiQuyMo()
    {
        return $this->hasOne(Loaiquymodoanhnghiep::className(), ['id' => 'loaiQuyMoId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLoaiNdkt()
    {
        return $this->hasOne(Loainoidungkiemtra::className(), ['id' => 'loaiNdktId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMst0()
    {
        return $this->hasOne(Nguoinopthue::className(), ['id' => 'mst']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSoQdkt()
    {
        return $this->hasOne(Quyetdinhkiemtra::className(), ['id' => 'soQdktId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSoQdXuLy()
    {
        return $this->hasOne(Quyetdinhxuly::className(), ['id' => 'soQdXuLyId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLichsunopsaukiemtras()
    {
        return $this->hasMany(Lichsunopsaukiemtra::className(), ['soQdktId' => 'id']);
    }
}
