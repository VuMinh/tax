<?php

namespace app\models\base;

use Yii;

/**
 * This is the model class for table "{{%loaiquymodoanhnghiep}}".
 *
 * @property integer $id
 * @property string $loaiQuyMo
 * @property string $ghiChu
 *
 * @property Baocaokiemtra[] $baocaokiemtras
 */
class Loaiquymodoanhnghiep extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%loaiquymodoanhnghiep}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ghiChu'], 'string'],
            [['loaiQuyMo'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'loaiQuyMo' => Yii::t('app', 'Loai Quy Mo'),
            'ghiChu' => Yii::t('app', 'Ghi Chu'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBaocaokiemtras()
    {
        return $this->hasMany(Baocaokiemtra::className(), ['loaiQuyMoId' => 'id']);
    }
}
