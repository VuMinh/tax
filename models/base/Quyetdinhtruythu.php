<?php

namespace app\models\base;

use Yii;

/**
 * This is the model class for table "quyetdinhtruythu".
 *
 * @property integer $id
 * @property string $soQdTruyThu
 * @property string $ngayQdTruyThu
 *
 * @property Baocaothanhtra[] $baocaothanhtras
 */
class Quyetdinhtruythu extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'quyetdinhtruythu';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ngayQdTruyThu'], 'safe'],
            [['soQdTruyThu'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'soQdTruyThu' => Yii::t('app', 'So Qd Truy Thu'),
            'ngayQdTruyThu' => Yii::t('app', 'Ngay Qd Truy Thu'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBaocaothanhtras()
    {
        return $this->hasMany(Baocaothanhtra::className(), ['soQdTruyThuId' => 'id']);
    }
}
