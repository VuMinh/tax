<?php

namespace app\models\base;

use Yii;

/**
 * This is the model class for table "quyetdinhxuphat".
 *
 * @property integer $id
 * @property string $soQdXuPhat
 * @property string $ngayQdXuPhat
 * @property string $soTienPhatViPham
 * @property string $tienChamNop
 * @property string $phatChamNopThueVat
 * @property string $phatChamNopThueTncn
 * @property string $phatChamNopThueTtdb
 * @property string $phatChamNopThueKhac
 * @property string $tienPhat1
 * @property string $tienPhat2
 * @property string $tienPhat3
 * @property string $tienPhat4
 * @property string $tienPhat5
 * @property string $tienPhat6
 * @property string $tienPhat7
 * @property string $ngayTao
 * @property string $ngayCapNhat
 */
class Quyetdinhxuphat extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'quyetdinhxuphat';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ngayQdXuPhat', 'ngayTao', 'ngayCapNhat'], 'safe'],
            [['soTienPhatViPham', 'tienChamNop', 'phatChamNopThueVat', 'phatChamNopThueTncn', 'phatChamNopThueTtdb', 'phatChamNopThueKhac', 'tienPhat1', 'tienPhat2', 'tienPhat3', 'tienPhat4', 'tienPhat5', 'tienPhat6', 'tienPhat7'], 'number'],
            [['soQdXuPhat'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'soQdXuPhat' => Yii::t('app', 'So Qd Xu Phat'),
            'ngayQdXuPhat' => Yii::t('app', 'Ngay Qd Xu Phat'),
            'soTienPhatViPham' => Yii::t('app', 'So Tien Phat Vi Pham'),
            'tienChamNop' => Yii::t('app', 'Tien Cham Nop'),
            'phatChamNopThueVat' => Yii::t('app', 'Phat Cham Nop Thue Vat'),
            'phatChamNopThueTncn' => Yii::t('app', 'Phat Cham Nop Thue Tncn'),
            'phatChamNopThueTtdb' => Yii::t('app', 'Phat Cham Nop Thue Ttdb'),
            'phatChamNopThueKhac' => Yii::t('app', 'Phat Cham Nop Thue Khac'),
            'tienPhat1' => Yii::t('app', 'Tien Phat1'),
            'tienPhat2' => Yii::t('app', 'Tien Phat2'),
            'tienPhat3' => Yii::t('app', 'Tien Phat3'),
            'tienPhat4' => Yii::t('app', 'Tien Phat4'),
            'tienPhat5' => Yii::t('app', 'Tien Phat5'),
            'tienPhat6' => Yii::t('app', 'Tien Phat6'),
            'tienPhat7' => Yii::t('app', 'Tien Phat7'),
            'ngayTao' => Yii::t('app', 'Ngay Tao'),
            'ngayCapNhat' => Yii::t('app', 'Ngay Cap Nhat'),
        ];
    }
}
