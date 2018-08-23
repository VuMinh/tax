<?php

namespace app\models\base;

use Yii;

/**
 * This is the model class for table "{{%lydohoanthue}}".
 *
 * @property integer $id
 * @property string $maLyDoHoanThue
 * @property string $ghiChu
 * @property string $lyDoHoanThue
 * @property string $group
 *
 * @property Sotheodoisauhoanthue[] $sotheodoisauhoanthues
 */
class Lydohoanthue extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%lydohoanthue}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ghiChu', 'lyDoHoanThue', 'group'], 'string'],
            [['maLyDoHoanThue'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'maLyDoHoanThue' => Yii::t('app', 'Ma Ly Do Hoan Thue'),
            'ghiChu' => Yii::t('app', 'Ghi Chu'),
            'lyDoHoanThue' => Yii::t('app', 'Ly Do Hoan Thue'),
            'group' => Yii::t('app', 'Group'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSotheodoisauhoanthues()
    {
        return $this->hasMany(Sotheodoisauhoanthue::className(), ['loaiHoanThueId' => 'id']);
    }
}
