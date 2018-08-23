<?php

namespace app\models\base;

use Yii;

/**
 * This is the model class for table "loainoidungkiemtra".
 *
 * @property integer $id
 * @property string $loaiNd
 * @property string $ghiChu
 *
 * @property Baocaokiemtra[] $baocaokiemtras
 */
class Loainoidungkiemtra extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'loainoidungkiemtra';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ghiChu'], 'string'],
            [['loaiNd'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'loaiNd' => Yii::t('app', 'Loai Nd'),
            'ghiChu' => Yii::t('app', 'Ghi Chu'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBaocaokiemtras()
    {
        return $this->hasMany(Baocaokiemtra::className(), ['loaiNdktId' => 'id']);
    }
}
