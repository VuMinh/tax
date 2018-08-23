<?php

namespace app\models\base;

use Yii;

/**
 * This is the model class for table "sotheodoisauhoanthue".
 *
 * @property integer $id
 * @property integer $mst
 * @property string $maChuong
 * @property integer $laToChuc
 * @property integer $loaiHoanThueId
 * @property string $soThueDeNghiHoan
 * @property string $soThueKhongDuocHoan
 * @property integer $soQdThanhTraId
 * @property integer $soQdKtId
 * @property string $thoiKyThanhTra
 * @property integer $soVbHoanThueId
 * @property string $ghiChu
 * @property integer $soQdThuHoiHoanId
 * @property integer $soQdXuPhatId
 * @property string $chiTietHanhViViPham
 * @property string $soTienThuHoi
 * @property string $ngayCapNhat
 * @property string $ghiChu1
 * @property string $ghiChu2
 * @property string $ghiChu3
 * @property string $ghiChu4
 * @property integer $truocHoanSauHoan
 * @property string $ngayTao
 *
 * @property Lichsunopquyhoanthue[] $lichsunopquyhoanthues
 * @property Quyetdinhxuphat $soQdXuPhat
 * @property Quyetdinhxuphat $soQdXuPhat0

 * @property Nguoinopthue $mst0
 * @property Quyetdinhkiemtra $soQdKt
 * @property Quyetdinhthanhtra $soQdThanhTra
 * @property Quyetdinhthuhoihoanthue $soQdThuHoiHoan
 * @property Vanban $soVbHoanThue
 * @property Lydohoanthue $loaiHoanThue
 */
class Sotheodoisauhoanthue extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'sotheodoisauhoanthue';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['mst', 'laToChuc', 'loaiHoanThueId', 'soQdThanhTraId', 'soQdKtId', 'soVbHoanThueId', 'soQdThuHoiHoanId', 'soQdXuPhatId', 'truocHoanSauHoan'], 'integer'],
            [['soThueDeNghiHoan', 'soThueKhongDuocHoan', 'soTienThuHoi'], 'number'],
            [['ghiChu', 'chiTietHanhViViPham', 'ghiChu1', 'ghiChu2', 'ghiChu3', 'ghiChu4'], 'string'],
            [['ngayCapNhat', 'ngayTao'], 'safe'],
            [['maChuong', 'thoiKyThanhTra'], 'string', 'max' => 255],
            [['soQdXuPhatId'], 'exist', 'skipOnError' => true, 'targetClass' => Quyetdinhxuphat::className(), 'targetAttribute' => ['soQdXuPhatId' => 'id']],
            [['soQdXuPhatId'], 'exist', 'skipOnError' => true, 'targetClass' => Quyetdinhxuphat::className(), 'targetAttribute' => ['soQdXuPhatId' => 'id']],
            [['mst'], 'exist', 'skipOnError' => true, 'targetClass' => Nguoinopthue::className(), 'targetAttribute' => ['mst' => 'id']],
            [['soQdKtId'], 'exist', 'skipOnError' => true, 'targetClass' => Quyetdinhkiemtra::className(), 'targetAttribute' => ['soQdKtId' => 'id']],
            [['soQdThanhTraId'], 'exist', 'skipOnError' => true, 'targetClass' => Quyetdinhthanhtra::className(), 'targetAttribute' => ['soQdThanhTraId' => 'id']],
            [['soQdThuHoiHoanId'], 'exist', 'skipOnError' => true, 'targetClass' => Quyetdinhthuhoihoanthue::className(), 'targetAttribute' => ['soQdThuHoiHoanId' => 'id']],
            [['soVbHoanThueId'], 'exist', 'skipOnError' => true, 'targetClass' => Vanban::className(), 'targetAttribute' => ['soVbHoanThueId' => 'id']],
            [['loaiHoanThueId'], 'exist', 'skipOnError' => true, 'targetClass' => Lydohoanthue::className(), 'targetAttribute' => ['loaiHoanThueId' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'mst' => Yii::t('app', 'Mst'),
            'maChuong' => Yii::t('app', 'Ma Chuong'),
            'laToChuc' => Yii::t('app', 'La To Chuc'),
            'loaiHoanThueId' => Yii::t('app', 'Loai Hoan Thue ID'),
            'soThueDeNghiHoan' => Yii::t('app', 'So Thue De Nghi Hoan'),
            'soThueKhongDuocHoan' => Yii::t('app', 'So Thue Khong Duoc Hoan'),
            'soQdThanhTraId' => Yii::t('app', 'So Qd Thanh Tra ID'),
            'soQdKtId' => Yii::t('app', 'So Qd Kt ID'),
            'thoiKyThanhTra' => Yii::t('app', 'Thoi Ky Thanh Tra'),
            'soVbHoanThueId' => Yii::t('app', 'So Vb Hoan Thue ID'),
            'ghiChu' => Yii::t('app', 'Ghi Chu'),
            'soQdThuHoiHoanId' => Yii::t('app', 'So Qd Thu Hoi Hoan ID'),
            'soQdXuPhatId' => Yii::t('app', 'So Qd Xu Phat ID'),
            'chiTietHanhViViPham' => Yii::t('app', 'Chi Tiet Hanh Vi Vi Pham'),
            'soTienThuHoi' => Yii::t('app', 'So Tien Thu Hoi'),
            'ngayTao' => Yii::t('app', 'Ngay Tao'),
            'ngayCapNhat' => Yii::t('app', 'Ngay Cap Nhat'),
            'ghiChu1' => Yii::t('app', 'Ghi Chu1'),
            'ghiChu2' => Yii::t('app', 'Ghi Chu2'),
            'ghiChu3' => Yii::t('app', 'Ghi Chu3'),
            'ghiChu4' => Yii::t('app', 'Ghi Chu4'),
            'truocHoanSauHoan' => Yii::t('app', 'Truoc Hoan Sau Hoan'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLichsunopquyhoanthues()
    {
        return $this->hasMany(Lichsunopquyhoanthue::className(), ['soTheoDoiId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */

    public function getSoQdXuPhat()
    {
        return $this->hasOne(Quyetdinhxuphat::className(), ['id' => 'soQdXuPhatId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSoQdXuPhat0()
    {
        return $this->hasOne(Quyetdinhxuphat::className(), ['id' => 'soQdXuPhatId']);
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
    public function getSoQdKt()
    {
        return $this->hasOne(Quyetdinhkiemtra::className(), ['id' => 'soQdKtId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSoQdThanhTra()
    {
        return $this->hasOne(Quyetdinhthanhtra::className(), ['id' => 'soQdThanhTraId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSoQdThuHoiHoan()
    {
        return $this->hasOne(Quyetdinhthuhoihoanthue::className(), ['id' => 'soQdThuHoiHoanId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSoVbHoanThue()
    {
        return $this->hasOne(Vanban::className(), ['id' => 'soVbHoanThueId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLoaiHoanThue()
    {
        return $this->hasOne(Lydohoanthue::className(), ['id' => 'loaiHoanThueId']);
    }
}
