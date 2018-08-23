<?php

namespace app\models\base;

use Yii;

/**
 * This is the model class for table "quyetdinhxuly".
 *
 * @property integer $id
 * @property string $soQdXuLy
 * @property string $ngayQdXuLy
 * @property string $ngayTao
 *
 * @property Baocaobaohiemxahoi[] $baocaobaohiemxahois
 * @property Baocaobaohiemxahoitheonam[] $baocaobaohiemxahoitheonams
 * @property Baocaokiemtra[] $baocaokiemtras
 */
class Quyetdinhxuly extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'quyetdinhxuly';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ngayQdXuLy', 'ngayTao'], 'safe'],
            [['soQdXuLy'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'soQdXuLy' => 'So Qd Xu Ly',
            'ngayQdXuLy' => 'Ngay Qd Xu Ly',
            'ngayTao' => 'Ngay Tao',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBaocaobaohiemxahois()
    {
        return $this->hasMany(Baocaobaohiemxahoi::className(), ['soQdxlId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBaocaobaohiemxahoitheonams()
    {
        return $this->hasMany(Baocaobaohiemxahoitheonam::className(), ['soQdxlId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBaocaokiemtras()
    {
        return $this->hasMany(Baocaokiemtra::className(), ['soQdXuLyId' => 'id']);
    }
}
