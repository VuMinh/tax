<?php

namespace app\models\base;

use Yii;

/**
 * This is the model class for table "lichsunopquyhoanthue".
 *
 * @property integer $id
 * @property string $thoiDiemNop
 * @property string $daNopThueThuHoi
 * @property string $daNopTienPhatViPham
 * @property string $daNopTienChamNop
 * @property integer $soTheoDoiId
 *
 * @property Sotheodoisauhoanthue $soTheoDoi
 */
class Lichsunopquyhoanthue extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'lichsunopquyhoanthue';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['thoiDiemNop'], 'safe'],
            [['daNopThueThuHoi', 'daNopTienPhatViPham', 'daNopTienChamNop'], 'number'],
            [['soTheoDoiId'], 'integer'],
            [['soTheoDoiId'], 'exist', 'skipOnError' => true, 'targetClass' => Sotheodoisauhoanthue::className(), 'targetAttribute' => ['soTheoDoiId' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'thoiDiemNop' => 'Thoi Diem Nop',
            'daNopThueThuHoi' => 'Da Nop Thue Thu Hoi',
            'daNopTienPhatViPham' => 'Da Nop Tien Phat Vi Pham',
            'daNopTienChamNop' => 'Da Nop Tien Cham Nop',
            'soTheoDoiId' => 'So Theo Doi ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSoTheoDoi()
    {
        return $this->hasOne(Sotheodoisauhoanthue::className(), ['id' => 'soTheoDoiId']);
    }
}
