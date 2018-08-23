<?php

namespace app\models\base;

use Yii;

/**
 * This is the model class for table "{{%loaiquyetdinh}}".
 *
 * @property integer $id
 * @property string $loaiQdKt
 * @property string $ghiChu
 *
 * @property Quyetdinh[] $quyetdinhs
 */
class Loaiquyetdinh extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%loaiquyetdinh}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ghiChu'], 'string'],
            [['loaiQdKt'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'loaiQdKt' => Yii::t('app', 'Loai Qd Kt'),
            'ghiChu' => Yii::t('app', 'Ghi Chu'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getQuyetdinhs()
    {
        return $this->hasMany(Quyetdinh::className(), ['loaiQdId' => 'id']);
    }
}
