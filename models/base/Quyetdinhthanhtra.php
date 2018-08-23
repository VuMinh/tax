<?php

namespace app\models\base;

use Yii;

/**
 * This is the model class for table "quyetdinhthanhtra".
 *
 * @property integer $id
 * @property string $soQdThanhTra
 * @property string $ngayQdThanhTra
 *
 * @property Baocaothanhtra[] $baocaothanhtras
 * @property Sotheodoisauhoanthue[] $sotheodoisauhoanthues
 */
class Quyetdinhthanhtra extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'quyetdinhthanhtra';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ngayQdThanhTra'], 'safe'],
            [['soQdThanhTra'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'soQdThanhTra' => Yii::t('app', 'So Qd Thanh Tra'),
            'ngayQdThanhTra' => Yii::t('app', 'Ngay Qd Thanh Tra'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBaocaothanhtras()
    {
        return $this->hasMany(Baocaothanhtra::className(), ['soQdThanhTraId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSotheodoisauhoanthues()
    {
        return $this->hasMany(Sotheodoisauhoanthue::className(), ['soQdThanhTraId' => 'id']);
    }
}
