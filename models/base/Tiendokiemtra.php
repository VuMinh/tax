<?php

namespace app\models\base;

use Yii;

/**
 * This is the model class for table "{{%tiendokiemtra}}".
 *
 * @property integer $id
 * @property string $trangThaiKt
 * @property string $ghiChu
 *
 * @property Baocaokiemtra[] $baocaokiemtras
 */
class Tiendokiemtra extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%tiendokiemtra}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ghiChu'], 'string'],
            [['trangThaiKt'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'trangThaiKt' => Yii::t('app', 'Trang Thai Kt'),
            'ghiChu' => Yii::t('app', 'Ghi Chu'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBaocaokiemtras()
    {
        return $this->hasMany(Baocaokiemtra::className(), ['tienDoId' => 'id']);
    }
}
