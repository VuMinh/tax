<?php

namespace app\models\base;

use Yii;

/**
 * This is the model class for table "baocaobaohiemxahoitheonam".
 *
 * @property integer $id
 * @property integer $mst
 * @property integer $soQdxlId
 * @property integer $namKtbhxh
 * @property string $soBhxhPhaiNop
 * @property string $soBhxhDaNop
 * @property string $soKpcdPhaiNop
 * @property string $soKpcdDaNop
 * @property integer $laoDongTrichBhxh
 * @property integer $laoDongChuaTrichBhxh
 * @property integer $laoDongTrichKpcd
 * @property integer $laoDongChuaTrichKpcd
 * @property string $ghiChu
 * @property string $ngayTao
 * @property string $ngayCapNhat
 * @property string $ghiChu1
 * @property string $ghiChu2
 * @property string $ghiChu3
 * @property string $ghiChu4
 * @property integer $bhxhId
 *
 * @property Nguoinopthue $mst0
 * @property Quyetdinhxuly $soQdxl
 * @property Baocaobaohiemxahoi $bhxh
 */
class Baocaobaohiemxahoitheonam extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'baocaobaohiemxahoitheonam';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['mst', 'soQdxlId', 'namKtbhxh', 'laoDongTrichBhxh', 'laoDongChuaTrichBhxh', 'laoDongTrichKpcd', 'laoDongChuaTrichKpcd', 'bhxhId'], 'integer'],
            [['soBhxhPhaiNop', 'soBhxhDaNop', 'soKpcdPhaiNop', 'soKpcdDaNop'], 'number'],
            [['ghiChu', 'ghiChu1', 'ghiChu2', 'ghiChu3', 'ghiChu4'], 'string'],
            [['ngayTao', 'ngayCapNhat'], 'safe'],
            [['mst'], 'exist', 'skipOnError' => true, 'targetClass' => Nguoinopthue::className(), 'targetAttribute' => ['mst' => 'id']],
            [['soQdxlId'], 'exist', 'skipOnError' => true, 'targetClass' => Quyetdinhxuly::className(), 'targetAttribute' => ['soQdxlId' => 'id']],
            [['bhxhId'], 'exist', 'skipOnError' => true, 'targetClass' => Baocaobaohiemxahoi::className(), 'targetAttribute' => ['bhxhId' => 'id']],
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
            'soQdxlId' => 'So Qdxl ID',
            'namKtbhxh' => 'Nam Ktbhxh',
            'soBhxhPhaiNop' => 'So Bhxh Phai Nop',
            'soBhxhDaNop' => 'So Bhxh Da Nop',
            'soKpcdPhaiNop' => 'So Kpcd Phai Nop',
            'soKpcdDaNop' => 'So Kpcd Da Nop',
            'laoDongTrichBhxh' => 'Lao Dong Trich Bhxh',
            'laoDongChuaTrichBhxh' => 'Lao Dong Chua Trich Bhxh',
            'laoDongTrichKpcd' => 'Lao Dong Trich Kpcd',
            'laoDongChuaTrichKpcd' => 'Lao Dong Chua Trich Kpcd',
            'ghiChu' => 'Ghi Chu',
            'ngayTao' => 'Ngay Tao',
            'ngayCapNhat' => 'Ngay Cap Nhat',
            'ghiChu1' => 'Ghi Chu1',
            'ghiChu2' => 'Ghi Chu2',
            'ghiChu3' => 'Ghi Chu3',
            'ghiChu4' => 'Ghi Chu4',
            'bhxhId' => 'Bhxh ID',
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
    public function getSoQdxl()
    {
        return $this->hasOne(Quyetdinhxuly::className(), ['id' => 'soQdxlId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBhxh()
    {
        return $this->hasOne(Baocaobaohiemxahoi::className(), ['id' => 'bhxhId']);
    }
}
