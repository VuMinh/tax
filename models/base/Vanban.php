<?php

namespace app\models\base;

use Yii;

/**
 * This is the model class for table "vanban".
 *
 * @property integer $id
 * @property string $soVb
 * @property string $ghiChu
 * @property string $ngayVb
 * @property string $soTienThue
 * @property string $soTienLai
 * @property string $ghiChu1
 * @property string $ghiChu2
 * @property string $ghiChu3
 * @property string $ghiChu4
 *
 * @property Sotheodoisauhoanthue[] $sotheodoisauhoanthues
 */
class Vanban extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'vanban';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ghiChu', 'ghiChu1', 'ghiChu2', 'ghiChu3', 'ghiChu4'], 'string'],
            [['soTienThue', 'soTienLai'], 'number'],
            [['soVb', 'ngayVb'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'soVb' => Yii::t('app', 'So Vb'),
            'ghiChu' => Yii::t('app', 'Ghi Chu'),
            'ngayVb' => Yii::t('app', 'Ngay Vb'),
            'soTienThue' => Yii::t('app', 'So Tien Thue'),
            'soTienLai' => Yii::t('app', 'So Tien Lai'),
            'ghiChu1' => Yii::t('app', 'Ghi Chu1'),
            'ghiChu2' => Yii::t('app', 'Ghi Chu2'),
            'ghiChu3' => Yii::t('app', 'Ghi Chu3'),
            'ghiChu4' => Yii::t('app', 'Ghi Chu4'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSotheodoisauhoanthues()
    {
        return $this->hasMany(Sotheodoisauhoanthue::className(), ['soVbHoanThueId' => 'id']);
    }
}
