<?php

namespace app\models\base;

use Yii;

/**
 * This is the model class for table "danhsachhoadonvipham".
 *
 * @property integer $id
 * @property string $ngayBaoCao
 * @property string $coQuanQuanLyThueDnMua
 * @property integer $mstDnMua
 * @property string $kyHieuHoaDon
 * @property string $soHoaDon
 * @property string $ngayPhatHanhHoaDon
 * @property string $tenHangHoa
 * @property string $giaTriHangChuaThue
 * @property string $thueVat
 * @property string $dauHieuViPham
 * @property string $tenChuDn
 * @property string $cmt
 * @property string $ngayThayDoiChuSoHuuGanNhat
 * @property string $ngayThayDoiDiaDiemGanNhat
 * @property string $thongBaoBoTron
 * @property string $ngayBoTron
 * @property string $coQuanThueQuanLyDnBan
 * @property string $mstDnBan
 * @property string $coQuanThueRaQdxl
 * @property string $ghiChu
 * @property string $ghiChu1
 * @property string $ghiChu2
 * @property string $tenDnBan
 *
 * @property Nguoinopthue $mstDnMua0
 */
class Danhsachhoadonvipham extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'danhsachhoadonvipham';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ngayBaoCao', 'ngayPhatHanhHoaDon', 'ngayThayDoiChuSoHuuGanNhat', 'ngayThayDoiDiaDiemGanNhat', 'ngayBoTron'], 'safe'],
            [['mstDnMua'], 'integer'],
            [['giaTriHangChuaThue', 'thueVat'], 'number'],
            [['dauHieuViPham'], 'string'],
            [['coQuanQuanLyThueDnMua', 'kyHieuHoaDon', 'soHoaDon', 'tenHangHoa', 'tenChuDn', 'cmt', 'thongBaoBoTron', 'coQuanThueQuanLyDnBan', 'mstDnBan', 'coQuanThueRaQdxl', 'ghiChu', 'ghiChu1', 'ghiChu2', 'tenDnBan'], 'string', 'max' => 255],
            [['mstDnMua'], 'exist', 'skipOnError' => true, 'targetClass' => Nguoinopthue::className(), 'targetAttribute' => ['mstDnMua' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'ngayBaoCao' => 'Ngay Bao Cao',
            'coQuanQuanLyThueDnMua' => 'Co Quan Quan Ly Thue Dn Mua',
            'mstDnMua' => 'Mst Dn Mua',
            'kyHieuHoaDon' => 'Ky Hieu Hoa Don',
            'soHoaDon' => 'So Hoa Don',
            'ngayPhatHanhHoaDon' => 'Ngay Phat Hanh Hoa Don',
            'tenHangHoa' => 'Ten Hang Hoa',
            'giaTriHangChuaThue' => 'Gia Tri Hang Chua Thue',
            'thueVat' => 'Thue Vat',
            'dauHieuViPham' => 'Dau Hieu Vi Pham',
            'tenChuDn' => 'Ten Chu Dn',
            'cmt' => 'Cmt',
            'ngayThayDoiChuSoHuuGanNhat' => 'Ngay Thay Doi Chu So Huu Gan Nhat',
            'ngayThayDoiDiaDiemGanNhat' => 'Ngay Thay Doi Dia Diem Gan Nhat',
            'thongBaoBoTron' => 'Thong Bao Bo Tron',
            'ngayBoTron' => 'Ngay Bo Tron',
            'coQuanThueQuanLyDnBan' => 'Co Quan Thue Quan Ly Dn Ban',
            'mstDnBan' => 'Mst Dn Ban',
            'coQuanThueRaQdxl' => 'Co Quan Thue Ra Qdxl',
            'ghiChu' => 'Ghi Chu',
            'ghiChu1' => 'Ghi Chu1',
            'ghiChu2' => 'Ghi Chu2',
            'tenDnBan' => 'Ten Dn Ban',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMstDnMua0()
    {
        return $this->hasOne(Nguoinopthue::className(), ['id' => 'mstDnMua']);
    }
}
