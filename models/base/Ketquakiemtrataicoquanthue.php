<?php

namespace app\models\base;

use Yii;

/**
 * This is the model class for table "ketquakiemtrataicoquanthue".
 *
 * @property integer $id
 * @property string $phongBan
 * @property string $ngayTao
 * @property integer $trangThaiHoSoId
 * @property string $ngayCapNhat
 * @property string $tongThueDieuChinhTang
 * @property string $tongThueDieuChinhGiam
 * @property string $anDinh
 * @property string $giamKhauTru
 * @property string $giamLo
 * @property string $tienDuocMineTang
 * @property string $tienDuocMienGiam
 * @property integer $nguoiNopThueId
 * @property string $ghiChu1
 * @property string $ghiChu2
 * @property string $ghiChu3
 *
 * @property Nguoinopthue $nguoiNopThue
 * @property Trangthaihoso $trangThaiHoSo
 */
class Ketquakiemtrataicoquanthue extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ketquakiemtrataicoquanthue';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ngayTao', 'ngayCapNhat'], 'safe'],
            [['trangThaiHoSoId', 'nguoiNopThueId'], 'integer'],
            [['tongThueDieuChinhTang', 'tongThueDieuChinhGiam', 'anDinh', 'giamKhauTru', 'giamLo', 'tienDuocMineTang', 'tienDuocMienGiam'], 'number'],
            [['phongBan', 'ghiChu1', 'ghiChu2', 'ghiChu3'], 'string', 'max' => 255],
            [['nguoiNopThueId'], 'exist', 'skipOnError' => true, 'targetClass' => Nguoinopthue::className(), 'targetAttribute' => ['nguoiNopThueId' => 'id']],
            [['trangThaiHoSoId'], 'exist', 'skipOnError' => true, 'targetClass' => Trangthaihoso::className(), 'targetAttribute' => ['trangThaiHoSoId' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'phongBan' => Yii::t('app', 'Phong Ban'),
            'ngayTao' => Yii::t('app', 'Ngay Tao'),
            'trangThaiHoSoId' => Yii::t('app', 'Trang Thai Ho So ID'),
            'ngayCapNhat' => Yii::t('app', 'Ngay Cap Nhat'),
            'tongThueDieuChinhTang' => Yii::t('app', 'Tong Thue Dieu Chinh Tang'),
            'tongThueDieuChinhGiam' => Yii::t('app', 'Tong Thue Dieu Chinh Giam'),
            'anDinh' => Yii::t('app', 'An Dinh'),
            'giamKhauTru' => Yii::t('app', 'Giam Khau Tru'),
            'giamLo' => Yii::t('app', 'Giam Lo'),
            'tienDuocMineTang' => Yii::t('app', 'Tien Duoc Mine Tang'),
            'tienDuocMienGiam' => Yii::t('app', 'Tien Duoc Mien Giam'),
            'nguoiNopThueId' => Yii::t('app', 'Nguoi Nop Thue ID'),
            'ghiChu1' => Yii::t('app', 'Ghi Chu1'),
            'ghiChu2' => Yii::t('app', 'Ghi Chu2'),
            'ghiChu3' => Yii::t('app', 'Ghi Chu3'),
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
    public function getTrangThaiHoSo()
    {
        return $this->hasOne(Trangthaihoso::className(), ['id' => 'trangThaiHoSoId']);
    }
}
