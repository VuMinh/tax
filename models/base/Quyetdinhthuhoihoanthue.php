<?php

namespace app\models\base;

use Yii;

/**
 * This is the model class for table "quyetdinhthuhoihoanthue".
 *
 * @property integer $id
 * @property string $soQdThuHoiHoan
 * @property string $ngayQdThuHoiHoan
 * @property string $soTienThueThuHoi
 *
 * @property Lichsunopquyhoanthue[] $lichsunopquyhoanthues
 * @property Sotheodoisauhoanthue[] $sotheodoisauhoanthues
 */
class Quyetdinhthuhoihoanthue extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'quyetdinhthuhoihoanthue';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ngayQdThuHoiHoan'], 'safe'],
            [['soTienThueThuHoi'], 'number'],
            [['soQdThuHoiHoan'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'soQdThuHoiHoan' => Yii::t('app', 'So Qd Thu Hoi Hoan'),
            'ngayQdThuHoiHoan' => Yii::t('app', 'Ngay Qd Thu Hoi Hoan'),
            'soTienThueThuHoi' => Yii::t('app', 'So Tien Thue Thu Hoi'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLichsunopquyhoanthues()
    {
        return $this->hasMany(Lichsunopquyhoanthue::className(), ['soQdThuHoiId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSotheodoisauhoanthues()
    {
        return $this->hasMany(Sotheodoisauhoanthue::className(), ['soQdThuHoiHoanId' => 'id']);
    }
}
