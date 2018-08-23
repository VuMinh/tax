<?php

namespace app\models\base;

use Yii;

/**
 * This is the model class for table "{{%nganhnghe}}".
 *
 * @property integer $id
 * @property string $maNganhNgheKdChinh
 * @property string $tenNganhNgheKdChinh
 * @property string $ghiChu
 *
 * @property Nguoinopthue[] $nguoinopthues
 */
class Nganhnghe extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%nganhnghe}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ghiChu'], 'string'],
            [['maNganhNgheKdChinh', 'tenNganhNgheKdChinh'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'maNganhNgheKdChinh' => Yii::t('app', 'Ma Nganh Nghe Kd Chinh'),
            'tenNganhNgheKdChinh' => Yii::t('app', 'Ten Nganh Nghe Kd Chinh'),
            'ghiChu' => Yii::t('app', 'Ghi Chu'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNguoinopthues()
    {
        return $this->hasMany(Nguoinopthue::className(), ['nganhNgheId' => 'id']);
    }
}
