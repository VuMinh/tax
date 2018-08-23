<?php

namespace app\models\base;

use Yii;

/**
 * This is the model class for table "lydoxulycham".
 *
 * @property integer $id
 * @property integer $mst
 * @property integer $soQdktId
 * @property string $ngayBc
 * @property integer $vuongMacChinhSach
 * @property integer $chuaThongNhatSoLieuGiaiTrinhCham
 * @property integer $dvCoCongVanXinTamLui
 * @property integer $doiChieuSoLieuVoiCucThue
 * @property integer $chuyenHsSangCqCongAnThanhTra
 * @property integer $motSoNnKhac
 * @property integer $toTrinhBcLanhDao
 * @property string $trichYeuNoiDungTonDong
 *
 * @property Nguoinopthue $mst0
 * @property Quyetdinhkiemtra $soQdkt
 */
class Lydoxulycham extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'lydoxulycham';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['mst', 'soQdktId', 'vuongMacChinhSach', 'chuaThongNhatSoLieuGiaiTrinhCham', 'dvCoCongVanXinTamLui', 'doiChieuSoLieuVoiCucThue', 'chuyenHsSangCqCongAnThanhTra', 'motSoNnKhac', 'toTrinhBcLanhDao'], 'integer'],
            [['trichYeuNoiDungTonDong'], 'string'],
            [['ngayBc'], 'string', 'max' => 255],
//            [['mst'], 'exist', 'skipOnError' => true, 'targetClass' => Nguoinopthue::className(), 'targetAttribute' => ['mst' => 'id']],
//            [['soQdktId'], 'exist', 'skipOnError' => true, 'targetClass' => Quyetdinhkiemtra::className(), 'targetAttribute' => ['soQdktId' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'mst' => 'Mst',
            'soQdktId' => 'So Qdkt ID',
            'ngayBc' => 'Ngay Bc',
            'vuongMacChinhSach' => 'Vuong Mac Chinh Sach',
            'chuaThongNhatSoLieuGiaiTrinhCham' => 'Chua Thong Nhat So Lieu Giai Trinh Cham',
            'dvCoCongVanXinTamLui' => 'Dv Co Cong Van Xin Tam Lui',
            'doiChieuSoLieuVoiCucThue' => 'Doi Chieu So Lieu Voi Cuc Thue',
            'chuyenHsSangCqCongAnThanhTra' => 'Chuyen Hs Sang Cq Cong An Thanh Tra',
            'motSoNnKhac' => 'Mot So Nn Khac',
            'toTrinhBcLanhDao' => 'To Trinh Bc Lanh Dao',
            'trichYeuNoiDungTonDong' => 'Trich Yeu Noi Dung Ton Dong',
        ];
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
}
