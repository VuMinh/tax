<?php

namespace app\models\base;

use Yii;

/**
 * This is the model class for table "chitieukiemtra".
 *
 * @property integer $id
 * @property string $chiTieuKiemTra
 * @property string $maChiTieu
 * @property string $ghiChu
 *
 * @property Ketquakttaitrusonnt[] $ketquakttaitrusonnts
 */
class Chitieukiemtra extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'chitieukiemtra';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['chiTieuKiemTra', 'maChiTieu', 'ghiChu'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'chiTieuKiemTra' => Yii::t('app', 'Chi Tieu Kiem Tra'),
            'maChiTieu' => Yii::t('app', 'Ma Chi Tieu'),
            'ghiChu' => Yii::t('app', 'Ghi Chu'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKetquakttaitrusonnts()
    {
        return $this->hasMany(Ketquakttaitrusonnt::className(), ['chiTieuKiemTraId' => 'id']);
    }
}
