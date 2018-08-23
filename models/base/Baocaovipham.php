<?php

namespace app\models\base;

use Yii;

/**
 * This is the model class for table "{{%baocaovipham}}".
 *
 * @property integer $id
 * @property integer $nguoiNopThueId
 * @property integer $qdId
 * @property string $hanhViViPhamDienHinh
 * @property string $moTaCachPhatHien
 * @property integer $nienDoKiemTra
 * @property string $truongDoanKiemTra
 *
 * @property Nguoinopthue $nguoiNopThue
 * @property Quyetdinh $qd
 */
class Baocaovipham extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%baocaovipham}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nguoiNopThueId', 'qdId', 'nienDoKiemTra'], 'integer'],
            [['hanhViViPhamDienHinh', 'moTaCachPhatHien', 'truongDoanKiemTra'], 'string', 'max' => 255],
            [['nguoiNopThueId'], 'exist', 'skipOnError' => true, 'targetClass' => Nguoinopthue::className(), 'targetAttribute' => ['nguoiNopThueId' => 'id']],
            [['qdId'], 'exist', 'skipOnError' => true, 'targetClass' => Quyetdinh::className(), 'targetAttribute' => ['qdId' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'nguoiNopThueId' => Yii::t('app', 'Nguoi Nop Thue ID'),
            'qdId' => Yii::t('app', 'Qd ID'),
            'hanhViViPhamDienHinh' => Yii::t('app', 'Hanh Vi Vi Pham Dien Hinh'),
            'moTaCachPhatHien' => Yii::t('app', 'Mo Ta Cach Phat Hien'),
            'nienDoKiemTra' => Yii::t('app', 'Nien Do Kiem Tra'),
            'truongDoanKiemTra' => Yii::t('app', 'Truong Doan Kiem Tra'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNguoiNopThue()
    {
        return $this->hasOne(Nguoinopthue::className(), ['id' => 'nguoiNopThueId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getQd()
    {
        return $this->hasOne(Quyetdinh::className(), ['id' => 'qdId']);
    }
}
