<?php

namespace app\models\base;

use Yii;

/**
 * This is the model class for table "baocaochuyencongan".
 *
 * @property integer $id
 * @property string $phongChiCuc
 * @property integer $mst
 * @property string $soKetLuanThanhKiemTraDaBanHanh
 * @property string $doanhSo
 * @property string $thueGtgt
 * @property integer $tongSoHoaDon
 * @property string $ngayBaoCao
 * @property string $ngayCapNhat
 * @property string $ngayKetLuan
 * @property string $ghiChu
 * @property string $ghiChu1
 * @property string $ghiChu2
 *
 * @property Nguoinopthue $mst0
 */
class Baocaochuyencongan extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'baocaochuyencongan';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['mst', 'tongSoHoaDon'], 'integer'],
            [['doanhSo', 'thueGtgt'], 'number'],
            [['ngayBaoCao', 'ngayCapNhat', 'ngayKetLuan'], 'safe'],
            [['phongChiCuc', 'soKetLuanThanhKiemTraDaBanHanh', 'ghiChu', 'ghiChu1', 'ghiChu2'], 'string', 'max' => 255],
            [['mst'], 'exist', 'skipOnError' => true, 'targetClass' => Nguoinopthue::className(), 'targetAttribute' => ['mst' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'phongChiCuc' => Yii::t('app', 'Phong Chi Cuc'),
            'mst' => Yii::t('app', 'Mst'),
            'soKetLuanThanhKiemTraDaBanHanh' => Yii::t('app', 'So Ket Luan Thanh Kiem Tra Da Ban Hanh'),
            'doanhSo' => Yii::t('app', 'Doanh So'),
            'thueGtgt' => Yii::t('app', 'Thue Gtgt'),
            'tongSoHoaDon' => Yii::t('app', 'Tong So Hoa Don'),
            'ngayBaoCao' => Yii::t('app', 'Ngay Bao Cao'),
            'ngayCapNhat' => Yii::t('app', 'Ngay Cap Nhat'),
            'ngayKetLuan' => Yii::t('app', 'Ngay Ket Luan'),
            'ghiChu' => Yii::t('app', 'Ghi Chu'),
            'ghiChu1' => Yii::t('app', 'Ghi Chu1'),
            'ghiChu2' => Yii::t('app', 'Ghi Chu2'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMst0()
    {
        return $this->hasOne(Nguoinopthue::className(), ['id' => 'mst']);
    }
}
