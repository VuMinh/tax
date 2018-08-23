<?php

namespace app\models\base;

use Yii;

/**
 * This is the model class for table "baocaobaohiemxahoi".
 *
 * @property integer $id
 * @property integer $mst
 * @property integer $soQdxlId
 * @property integer $viPhamBhxh
 * @property integer $viPhamKpcd
 * @property string $ghiChu
 * @property integer $coKtndKpcd
 * @property integer $coKtndBhxh
 * @property integer $soDvThanhTraKiemTraHoanThanh
 * @property string $phongChiCucThue
 * @property string $ngayTao
 * @property string $ngayCapNhat
 * @property string $ghiChu1
 * @property string $ghiChu2
 * @property string $ghiChu3
 * @property string $ghiChu4
 * @property string $truongDoan
 *
 * @property Nguoinopthue $mst0
 * @property Quyetdinhxuly $soQdxl
 * @property Baocaobaohiemxahoitheonam[] $baocaobaohiemxahoitheonams
 */
class Baocaobaohiemxahoi extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'baocaobaohiemxahoi';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['mst', 'soQdxlId', 'viPhamBhxh', 'viPhamKpcd', 'coKtndKpcd', 'coKtndBhxh', 'soDvThanhTraKiemTraHoanThanh'], 'integer'],
            [['ghiChu', 'ghiChu1', 'ghiChu2', 'ghiChu3', 'ghiChu4'], 'string'],
            [['ngayTao', 'ngayCapNhat'], 'safe'],
            [['phongChiCucThue', 'truongDoan'], 'string', 'max' => 255],
            [['mst'], 'exist', 'skipOnError' => true, 'targetClass' => Nguoinopthue::className(), 'targetAttribute' => ['mst' => 'id']],
            [['soQdxlId'], 'exist', 'skipOnError' => true, 'targetClass' => Quyetdinhxuly::className(), 'targetAttribute' => ['soQdxlId' => 'id']],
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
            'viPhamBhxh' => 'Vi Pham Bhxh',
            'viPhamKpcd' => 'Vi Pham Kpcd',
            'ghiChu' => 'Ghi Chu',
            'coKtndKpcd' => 'Co Ktnd Kpcd',
            'coKtndBhxh' => 'Co Ktnd Bhxh',
            'soDvThanhTraKiemTraHoanThanh' => 'So Dv Thanh Tra Kiem Tra Hoan Thanh',
            'phongChiCucThue' => 'Phong Chi Cuc Thue',
            'ngayTao' => 'Ngay Tao',
            'ngayCapNhat' => 'Ngay Cap Nhat',
            'ghiChu1' => 'Ghi Chu1',
            'ghiChu2' => 'Ghi Chu2',
            'ghiChu3' => 'Ghi Chu3',
            'ghiChu4' => 'Ghi Chu4',
            'truongDoan' => 'Truong Doan',
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
    public function getBaocaobaohiemxahoitheonams()
    {
        return $this->hasMany(Baocaobaohiemxahoitheonam::className(), ['bhxhId' => 'id']);
    }
}
