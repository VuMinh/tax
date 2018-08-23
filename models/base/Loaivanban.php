<?php

namespace app\models\base;

use Yii;

/**
 * This is the model class for table "{{%loaivanban}}".
 *
 * @property integer $id
 * @property string $maLoaiVb
 * @property string $tenLoaiVb
 *
 * @property Vanban[] $vanbans
 */
class Loaivanban extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%loaivanban}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['maLoaiVb', 'tenLoaiVb'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'maLoaiVb' => Yii::t('app', 'Ma Loai Vb'),
            'tenLoaiVb' => Yii::t('app', 'Ten Loai Vb'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVanbans()
    {
        return $this->hasMany(Vanban::className(), ['loaiVanBanId' => 'id']);
    }
}
