<?php
/**
 * Created by PhpStorm.
 * User: thanh
 * Date: 22/3/2017
 * Time: 12:02 AM
 */

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
 * Class Baocaokiemtra
 * @package app\models
 * @inheritdoc
 * @property Nganhnghe $nganhNghe
 */
class Baocaokiemtra extends base\Baocaokiemtra
{

    public function fields()
    {
        $dateFormat = function ($model, $attr) {
            return $model->$attr ? Yii::$app->formatter->asDate($model->$attr, 'dd/MM/yyyy') : '';
        };

        $intFormat = function ($model, $attr) {
            return $model->$attr ? explode('.',$model->$attr)[0] : '';
        };

        return array_merge(parent::fields(), [
            'ngayKyBbkt' => $dateFormat,
            'truyThuThueTndn' => $intFormat,
            'phatHanhChinhKhac1020' => $intFormat,
            'truyThuThueGtgt' => $intFormat,
            'truyThuThueTncn' => $intFormat,
            'truyThuThueKhac' => $intFormat,
            'truyHoanThueGtgt' => $intFormat,
            'truyHoanThueTncn' => $intFormat,
            'truyHoanThueKhac' => $intFormat,
            'phatTronThue' => $intFormat,
            'tienHoaDon' => $intFormat,
            'phat005' => $intFormat,
            'phatChamNop' => $intFormat,
            'phatKhac' => $intFormat,
            'noDongNamTruocChuyenSang'=> $intFormat,
            'noDongPhatSinhTrongNam' => $intFormat,
            'thueMienGiamTheoKeKhai' => $intFormat,
            'thueMienGiamTheoKiemTra' => $intFormat,
            'mienGiamChenhLech' => $intFormat,
            'giamKhauTru' => $intFormat,
            'thueKhongDuocHoan'=> $intFormat,
            'anDinh' => $intFormat,
            'giamLo' => $intFormat,
        ]);
    }
    public function rules()
    {
        return array_merge(parent::rules(), [
            [['doiKiemTra'],'required']
        ]);

    }

    public function getSotheodoisauhoanthues()
    {
        return $this->hasOne(Sotheodoisauhoanthue::className(), ['mst' => 'mst']);
    }

    public function getLichsunopsaukiemtras()
    {
        return $this->hasOne(Lichsunopsaukiemtra::className(), ['soQdktId' => 'soQdktId']);
    }

    /*
     * @var Ly do xu ly cham
     * */
    public function getLydoxulychams()
    {
        return $this->hasOne(Lydoxulycham::className(), ['soQdktId' => 'soQdktId']);
    }

    public function getTruongDoan()
    {
        return $this->hasOne(Truongdoankiemtra::className(), ['id' => 'soQdktId'])
            ->viaTable('lichsunopsaukiemtra', ['soQdktId' => 'id']);
    }

    public function getNganhNghe()
    {
        return $this->hasOne(Nganhnghe::className(), ['id' => 'nganhNgheKinhDoanh']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLichsunopsaukiemtraOrder()
    {
        $x = $this->hasMany(Lichsunopsaukiemtra::className(), ['soQdktId' => 'id'])->orderBy('thoiDiemNop DESC')->one();


        return number_format($x->daNopDongNamTruoc+$x->daNopPhatSinhTruyThu+$x->daNopPhatSinhTruyHoan+$x->daNopTienPhat,0,',', ',');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTongno($model)
    {
        $x = $this->hasMany(Lichsunopsaukiemtra::className(), ['soQdktId' => 'id'])->orderBy('thoiDiemNop DESC')->one();

        return number_format($model->truyThuThueGtgt + $model->truyThuThueTndn + $model->truyThuThueTncn + $model->truyThuThueKhac + $model->truyHoanThueGtgt + $model->truyHoanThueTncn + $model->truyHoanThueKhac + $model->phatTronThue + $model->phatHanhChinhKhac1020 + $model->phatChamNop + $model->phatKhac
            +$model->noDongNamTruocChuyenSang+$model->noDongPhatSinhTrongNam
            -$x->daNopDongNamTruoc-$x->daNopPhatSinhTruyThu-$x->daNopPhatSinhTruyHoan-$x->daNopTienPhat,0,',', ',');
    }



    public function getSoQdTruyThu() {
        return $this->hasMany(Quyetdinhtruythu::className(), ['id' => 'soQdTruyThuId']);
    }
}