<?php

namespace app\models\base;

use Yii;

/**
 * This is the model class for table "lichsunopsaukiemtra".
 *
 * @property integer $id
 * @property integer $soQdktId
 * @property string $thoiDiemNop
 * @property string $daNopDongNamTruoc
 * @property string $daNopPhatSinhTruyThu
 * @property string $daNopPhatSinhTruyHoan
 * @property string $daNopTienPhat
 *
 * @property Baocaokiemtra $soQdkt
 */
class Lichsunopsaukiemtra extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'lichsunopsaukiemtra';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['soQdktId'], 'integer'],
            [['daNopDongNamTruoc', 'daNopPhatSinhTruyThu', 'daNopPhatSinhTruyHoan', 'daNopTienPhat'], 'number'],
            [['thoiDiemNop'], 'string', 'max' => 255],
            [['soQdktId'], 'exist', 'skipOnError' => true, 'targetClass' => Baocaokiemtra::className(), 'targetAttribute' => ['soQdktId' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'soQdktId' => Yii::t('app', 'So Qdkt ID'),
            'thoiDiemNop' => Yii::t('app', 'Thoi Diem Nop'),
            'daNopDongNamTruoc' => Yii::t('app', 'Da Nop Dong Nam Truoc'),
            'daNopPhatSinhTruyThu' => Yii::t('app', 'Da Nop Phat Sinh Truy Thu'),
            'daNopPhatSinhTruyHoan' => Yii::t('app', 'Da Nop Phat Sinh Truy Hoan'),
            'daNopTienPhat' => Yii::t('app', 'Da Nop Tien Phat'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSoQdkt()
    {
        return $this->hasOne(Baocaokiemtra::className(), ['id' => 'soQdktId']);
    }
}
