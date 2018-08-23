<?php

namespace app\models\base;

use Yii;

/**
 * This is the model class for table "{{%loaikhuvucdoanhnghiep}}".
 *
 * @property integer $id
 * @property string $loaiKhuVuc
 * @property string $ghiChu
 *
 * @property Baocaokiemtra[] $baocaokiemtras
 */
class Loaikhuvucdoanhnghiep extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%loaikhuvucdoanhnghiep}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ghiChu'], 'string'],
            [['loaiKhuVuc'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'loaiKhuVuc' => Yii::t('app', 'Loai Khu Vuc'),
            'ghiChu' => Yii::t('app', 'Ghi Chu'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBaocaokiemtras()
    {
        return $this->hasMany(Baocaokiemtra::className(), ['loaiKhuVucId' => 'id']);
    }
}
