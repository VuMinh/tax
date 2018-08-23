<?php

namespace app\models\base;

use Yii;

/**
 * This is the model class for table "{{%baocaono}}".
 *
 * @property integer $id
 * @property integer $qdId
 * @property integer $nguoiNopThueId
 * @property string $truongDoan
 * @property string $tongThuNs
 * @property string $vatTruyThu
 * @property string $tndn
 * @property string $ttdb
 * @property string $tncn
 * @property string $monBai
 * @property string $tienPhat1020
 * @property string $tienPhat005
 * @property string $tronThue
 * @property string $hoaDon
 * @property string $khac
 * @property string $tienPhat
 * @property integer $qdTruyThuId
 * @property string $soTienDndaNop
 * @property string $soTienDnChuaNop
 *
 * @property Nguoinopthue $nguoiNopThue
 * @property Quyetdinh $qd
 * @property Quyetdinh $qdTruyThu
 */
class Baocaono extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%baocaono}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['qdId', 'nguoiNopThueId', 'qdTruyThuId'], 'integer'],
            [['tongThuNs', 'vatTruyThu', 'tndn', 'ttdb', 'tncn', 'monBai', 'tienPhat1020', 'tienPhat005', 'tronThue', 'hoaDon', 'khac', 'tienPhat', 'soTienDndaNop', 'soTienDnChuaNop'], 'number'],
            [['truongDoan'], 'string', 'max' => 255],
            [['nguoiNopThueId'], 'exist', 'skipOnError' => true, 'targetClass' => Nguoinopthue::className(), 'targetAttribute' => ['nguoiNopThueId' => 'id']],
            [['qdId'], 'exist', 'skipOnError' => true, 'targetClass' => Quyetdinh::className(), 'targetAttribute' => ['qdId' => 'id']],
            [['qdTruyThuId'], 'exist', 'skipOnError' => true, 'targetClass' => Quyetdinh::className(), 'targetAttribute' => ['qdTruyThuId' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'qdId' => Yii::t('app', 'Qd ID'),
            'nguoiNopThueId' => Yii::t('app', 'Nguoi Nop Thue ID'),
            'truongDoan' => Yii::t('app', 'Truong Doan'),
            'tongThuNs' => Yii::t('app', 'Tong Thu Ns'),
            'vatTruyThu' => Yii::t('app', 'Vat Truy Thu'),
            'tndn' => Yii::t('app', 'Tndn'),
            'ttdb' => Yii::t('app', 'Ttdb'),
            'tncn' => Yii::t('app', 'Tncn'),
            'monBai' => Yii::t('app', 'Mon Bai'),
            'tienPhat1020' => Yii::t('app', 'Tien Phat1020'),
            'tienPhat005' => Yii::t('app', 'Tien Phat005'),
            'tronThue' => Yii::t('app', 'Tron Thue'),
            'hoaDon' => Yii::t('app', 'Hoa Don'),
            'khac' => Yii::t('app', 'Khac'),
            'tienPhat' => Yii::t('app', 'Tien Phat'),
            'qdTruyThuId' => Yii::t('app', 'Qd Truy Thu ID'),
            'soTienDndaNop' => Yii::t('app', 'So Tien Dnda Nop'),
            'soTienDnChuaNop' => Yii::t('app', 'So Tien Dn Chua Nop'),
        ];
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
    public function getQd()
    {
        return $this->hasOne(Quyetdinh::className(), ['id' => 'qdId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getQdTruyThu()
    {
        return $this->hasOne(Quyetdinh::className(), ['id' => 'qdTruyThuId']);
    }
}
