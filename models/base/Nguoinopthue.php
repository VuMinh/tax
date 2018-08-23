<?php

namespace app\models\base;

use Yii;

/**
 * This is the model class for table "nguoinopthue".
 *
 * @property integer $id
 * @property string $maSoThue
 * @property string $tenNguoiNop
 * @property string $ghiChu
 * @property string $nganhNgheKdChinh
 * @property string $diaChi
 * @property string $emailTbThue
 * @property string $tenNganhNgheKdChinh
 * @property string $nganhNgheId
 *
 * @property Baocaobaohiemxahoi[] $baocaobaohiemxahois
 * @property Baocaobaohiemxahoitheonam[] $baocaobaohiemxahoitheonams
 * @property Baocaokiemtra[] $baocaokiemtras
 * @property Baocaothanhtra[] $baocaothanhtras
 * @property Lydoxulycham[] $lydoxulychams
 * @property Sotheodoisauhoanthue[] $sotheodoisauhoanthues
 */
class Nguoinopthue extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'nguoinopthue';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ghiChu'], 'string'],
            [['maSoThue', 'tenNguoiNop', 'nganhNgheKdChinh', 'emailTbThue', 'tenNganhNgheKdChinh', 'nganhNgheId'], 'string', 'max' => 255],
            [['diaChi'], 'string', 'max' => 500],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'maSoThue' => Yii::t('app', 'Ma So Thue'),
            'tenNguoiNop' => Yii::t('app', 'Ten Nguoi Nop'),
            'ghiChu' => Yii::t('app', 'Ghi Chu'),
            'nganhNgheKdChinh' => Yii::t('app', 'Nganh Nghe Kd Chinh'),
            'diaChi' => Yii::t('app', 'Dia Chi'),
            'emailTbThue' => Yii::t('app', 'Email Tb Thue'),
            'tenNganhNgheKdChinh' => Yii::t('app', 'Ten Nganh Nghe Kd Chinh'),
            'nganhNgheId' => Yii::t('app', 'Nganh Nghe ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBaocaobaohiemxahois()
    {
        return $this->hasMany(Baocaobaohiemxahoi::className(), ['mst' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBaocaobaohiemxahoitheonams()
    {
        return $this->hasMany(Baocaobaohiemxahoitheonam::className(), ['mst' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBaocaokiemtras()
    {
        return $this->hasMany(Baocaokiemtra::className(), ['mst' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBaocaothanhtras()
    {
        return $this->hasMany(Baocaothanhtra::className(), ['mst' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLydoxulychams()
    {
        return $this->hasMany(Lydoxulycham::className(), ['mst' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSotheodoisauhoanthues()
    {
        return $this->hasMany(Sotheodoisauhoanthue::className(), ['mst' => 'id']);
    }
}
