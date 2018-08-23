<?php

namespace app\models\base;

use Yii;

/**
 * This is the model class for table "baocaothanhtra".
 *
 * @property integer $id
 * @property integer $soQdThanhTraId
 * @property integer $mst
 * @property string $truongDoan
 * @property string $vatTruyThu
 * @property string $tndn
 * @property string $ttdb
 * @property string $tncn
 * @property string $monBai
 * @property string $tienPhat1020
 * @property string $tienPhat005
 * @property integer $soQdTruyThuId
 *
 * @property Quyetdinhtruythu $soQdTruyThu
 * @property Nguoinopthue $mst0
 * @property Quyetdinhthanhtra $soQdThanhTra
 * @property Lichsunopthanhtra[] $lichsunopthanhtras
 */
class Baocaothanhtra extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'baocaothanhtra';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['soQdThanhTraId', 'mst', 'soQdTruyThuId'], 'integer'],
            [['vatTruyThu', 'tndn', 'ttdb', 'tncn', 'monBai', 'tienPhat1020', 'tienPhat005'], 'number'],
            [['truongDoan', 'doiKiemTra'], 'string', 'max' => 255],
            [['mst'], 'exist', 'skipOnError' => true, 'targetClass' => Nguoinopthue::className(), 'targetAttribute' => ['mst' => 'id']],
            [['soQdThanhTraId'], 'exist', 'skipOnError' => true, 'targetClass' => Quyetdinhthanhtra::className(), 'targetAttribute' => ['soQdThanhTraId' => 'id']],
            [['soQdTruyThuId'], 'exist', 'skipOnError' => true, 'targetClass' => Quyetdinhtruythu::className(), 'targetAttribute' => ['soQdTruyThuId' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'soQdThanhTraId' => Yii::t('app', 'So Qd Thanh Tra'),
            'mst' => Yii::t('app', 'Mst'),
            'truongDoan' => Yii::t('app', 'Truong Doan'),
            'vatTruyThu' => Yii::t('app', 'Vat Truy Thu'),
            'tndn' => Yii::t('app', 'Tndn'),
            'ttdb' => Yii::t('app', 'Ttdb'),
            'tncn' => Yii::t('app', 'Tncn'),
            'monBai' => Yii::t('app', 'Mon Bai'),
            'tienPhat1020' => Yii::t('app', 'Tien Phat1020'),
            'tienPhat005' => Yii::t('app', 'Tien Phat005'),
            'soQdTruyThuId' => Yii::t('app', 'So Qd Truy Thu'),
            'doiKiemTra' => Yii::t('app', 'Doi Kiem Tra'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSoQdTruyThu()
    {
        return $this->hasOne(Quyetdinhtruythu::className(), ['id' => 'soQdTruyThuId']);
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
    public function getSoQdThanhTra()
    {
        return $this->hasOne(Quyetdinhthanhtra::className(), ['id' => 'soQdThanhTraId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLichsunopthanhtras()
    {
        return $this->hasMany(Lichsunopthanhtra::className(), ['soQdThanhTra' => 'id'])->orderBy(['ngayNop' => SORT_DESC]);
    }
}
