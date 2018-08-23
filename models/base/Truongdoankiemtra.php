<?php

namespace app\models\base;

use Yii;

/**
 * This is the model class for table "truongdoankiemtra".
 *
 * @property integer $id
 * @property string $truongDoan
 * @property string $ghiChu
 *
 * @property Quyetdinhkiemtra[] $quyetdinhkiemtras
 */
class Truongdoankiemtra extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'truongdoankiemtra';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ghiChu'], 'string'],
            [['truongDoan'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'truongDoan' => Yii::t('app', 'Truong Doan'),
            'ghiChu' => Yii::t('app', 'Ghi Chu'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getQuyetdinhkiemtras()
    {
        return $this->hasMany(Quyetdinhkiemtra::className(), ['truongDoanId' => 'id']);
    }
}
