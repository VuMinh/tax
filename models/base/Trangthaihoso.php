<?php

namespace app\models\base;

use Yii;

/**
 * This is the model class for table "trangthaihoso".
 *
 * @property integer $id
 * @property string $trangThaiHs
 * @property string $ghiChu
 *
 * @property Ketquakiemtrataicoquanthue[] $ketquakiemtrataicoquanthues
 */
class Trangthaihoso extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'trangthaihoso';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['trangThaiHs', 'ghiChu'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'trangThaiHs' => Yii::t('app', 'Trang Thai Hs'),
            'ghiChu' => Yii::t('app', 'Ghi Chu'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKetquakiemtrataicoquanthues()
    {
        return $this->hasMany(Ketquakiemtrataicoquanthue::className(), ['trangThaiHoSoId' => 'id']);
    }
}
