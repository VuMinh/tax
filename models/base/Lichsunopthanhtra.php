<?php

namespace app\models\base;

use Yii;

/**
 * This is the model class for table "lichsunopthanhtra".
 *
 * @property integer $id
 * @property integer $soQdThanhTra
 * @property string $ngayNop
 * @property string $daNopThue
 *
 * @property Baocaothanhtra $soQdThanhTra0
 */
class Lichsunopthanhtra extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'lichsunopthanhtra';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['soQdThanhTra'], 'integer'],
            [['ngayNop'], 'safe'],
            [['daNopThue'], 'number'],
            [['soQdThanhTra'], 'exist', 'skipOnError' => true, 'targetClass' => Baocaothanhtra::className(), 'targetAttribute' => ['soQdThanhTra' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'soQdThanhTra' => 'So Qd Thanh Tra',
            'ngayNop' => 'Ngay Nop',
            'daNopThue' => 'Da Nop Thue',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSoQdThanhTra0()
    {
        return $this->hasOne(Baocaothanhtra::className(), ['id' => 'soQdThanhTra']);
    }
}
