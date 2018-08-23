<?php

namespace app\models\base;

use Yii;

/**
 * This is the model class for table "quyetdinhkiemtra".
 *
 * @property integer $id
 * @property string $soQdKiemTra
 * @property string $ngayQdKiemTra
 * @property integer $noDongKyTruocChuyenSang
 * @property integer $phatSinhTrongKy
 * @property string $nienDoKiemTra
 * @property integer $truongDoanId
 * @property string $ngayCongBoQdkt
 * @property string $ngayTrinhVbTamDungKt
 * @property string $ghiChu1
 * @property string $ghiChu2
 * @property string $ghiChu3
 * @property string $ghiChu4
 * @property string $ngayTao
 *
 * @property Baocaokiemtra[] $baocaokiemtras
 * @property Lydoxulycham[] $lydoxulychams
 * @property Truongdoankiemtra $truongDoan
 * @property Sotheodoisauhoanthue[] $sotheodoisauhoanthues
 */
class Quyetdinhkiemtra extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'quyetdinhkiemtra';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ngayQdKiemTra', 'ngayCongBoQdkt', 'ngayTrinhVbTamDungKt', 'ngayTao'], 'safe'],
            [['noDongKyTruocChuyenSang', 'phatSinhTrongKy', 'truongDoanId'], 'integer'],
            [['ghiChu1', 'ghiChu2', 'ghiChu3', 'ghiChu4'], 'string'],
            [['soQdKiemTra', 'nienDoKiemTra'], 'string', 'max' => 255],
            [['truongDoanId'], 'exist', 'skipOnError' => true, 'targetClass' => Truongdoankiemtra::className(), 'targetAttribute' => ['truongDoanId' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'soQdKiemTra' => Yii::t('app', 'So Qd Kiem Tra'),
            'ngayQdKiemTra' => Yii::t('app', 'Ngay Qd Kiem Tra'),
            'noDongKyTruocChuyenSang' => Yii::t('app', 'No Dong Ky Truoc Chuyen Sang'),
            'phatSinhTrongKy' => Yii::t('app', 'Phat Sinh Trong Ky'),
            'nienDoKiemTra' => Yii::t('app', 'Nien Do Kiem Tra'),
            'truongDoanId' => Yii::t('app', 'Truong Doan ID'),
            'ngayCongBoQdkt' => Yii::t('app', 'Ngay Cong Bo Qdkt'),
            'ngayTrinhVbTamDungKt' => Yii::t('app', 'Ngay Trinh Vb Tam Dung Kt'),
            'ghiChu1' => Yii::t('app', 'Ghi Chu1'),
            'ghiChu2' => Yii::t('app', 'Ghi Chu2'),
            'ghiChu3' => Yii::t('app', 'Ghi Chu3'),
            'ghiChu4' => Yii::t('app', 'Ghi Chu4'),
            'ngayTao' => Yii::t('app', 'Ngay Tao'),

        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBaocaokiemtras()
    {
        return $this->hasMany(Baocaokiemtra::className(), ['soQdktId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLydoxulychams()
    {
        return $this->hasMany(Lydoxulycham::className(), ['soQdktId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTruongDoan()
    {
        return $this->hasOne(Truongdoankiemtra::className(), ['id' => 'truongDoanId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSotheodoisauhoanthues()
    {
        return $this->hasMany(Sotheodoisauhoanthue::className(), ['soQdKtId' => 'id']);
    }
}
