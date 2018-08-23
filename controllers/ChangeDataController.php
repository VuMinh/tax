<?php
/**
 * Created by PhpStorm.
 * User: HungNV
 * Date: 17-May-17
 * Time: 2:44 PM
 */

namespace app\controllers;

use app\models\Baocaobaohiemxahoi;
use app\models\Baocaobaohiemxahoitheonam;
use app\models\Baocaokiemtra;
use app\models\Nguoinopthue;
use app\models\Quyetdinhkiemtra;
use app\models\Quyetdinhxuly;
use app\models\Truongdoankiemtra;
use yii\web\Controller;

class ChangeDataController extends Controller
{
    public function actionIndex()
    {
        $ngayQDKT = Quyetdinhkiemtra::find()->all();
        $ngayQDXL = Quyetdinhxuly::find()->all();
        $bhxh = Baocaobaohiemxahoi::find()->all();

        foreach ($ngayQDXL as $key => $value) {
            $value->ngayTao = $value->ngayQdXuLy;
            $value->save();
        }
        foreach ($ngayQDKT as $key => $value) {
            $value->ngayTao = $value->ngayQdKiemTra;
            $value->save();
        }
    }

    public function actionBhxh()
    {
        $baocacokiemtra = Baocaokiemtra::find()->all();
        foreach ($baocacokiemtra as $item => $value) {
            if ($value->soQdXuLyId) {

                $qdkt = Quyetdinhkiemtra::find()->where(['=', 'id', $value->soQdktId])->one();
                preg_match('/^[0-9]{4}-[0-9]{4}$/', $qdkt->nienDoKiemTra, $matches);

                if (count($matches)) {
                    $baocaobaohiemxahoi = new Baocaobaohiemxahoi();

                    $baocaobaohiemxahoi->soQdxlId = $value->soQdXuLyId;
                    $baocaobaohiemxahoi->mst = $value->mst;
                    $baocaobaohiemxahoi->ngayTao = date("Y-m-d H:i:s");

                    $soQdktId = $value->soQdktId;
                    $truongDoanID = Quyetdinhkiemtra::find()->where(['=', 'id', $soQdktId])->one()['truongDoanId'];
                    $truongDoan = Truongdoankiemtra::find()->where(['=', 'id', $truongDoanID])->asArray()->one()['truongDoan'];

                    $baocaobaohiemxahoi->truongDoan = $truongDoan;
                    $baocaobaohiemxahoi->save();

                    $year = explode('-', $qdkt->nienDoKiemTra);

                    for ($i = $year[0]; $i <= $year[1]; $i++) {
                        $baocaobaohiemxahoitheonam = new Baocaobaohiemxahoitheonam();

                        $baocaobaohiemxahoitheonam->bhxhId = $baocaobaohiemxahoi->id;
                        $baocaobaohiemxahoitheonam->namKtbhxh = $i;
                        $baocaobaohiemxahoitheonam->ngayTao = date("Y-m-d H:i:s");

                        $baocaobaohiemxahoitheonam->save();

                    }
                }
            }
        }
    }

    public function actionDay25(){
        $qdkt = Quyetdinhkiemtra::find()->all();
        $qdxl = Quyetdinhxuly::find()->all();

        foreach ($qdkt as $item => $value){
            if ($value->ngayTao == '2017-05-26 00:00:00'){
                $value->ngayTao = '2017-05-25 00:00:00';
                $value->save();
            }
        }

        foreach ($qdxl as $item => $value){
            if ($value->ngayTao == '2017-05-26 00:00:00'){
                $value->ngayTao = '2017-05-25 00:00:00';
                $value->save();
            }
        }
    }
}