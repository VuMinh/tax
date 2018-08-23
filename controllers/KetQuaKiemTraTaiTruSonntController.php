<?php

namespace app\controllers;

use app\models\DateValidation;
use app\models\ExportExcel;
use app\models\Nguoinopthue;
use Yii;
use app\models\Ketquakttaitrusonnt;
use app\models\KetquakttaitrusonntSearch;
use yii\db\Query;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Response;
use DateTime;
use app\helpers\ExportExcelBaoCaoTaiNguoiNopThueHelper;

/**
 * KetQuaKiemTraTaiTruSonntController implements the CRUD actions for Ketquakttaitrusonnt model.
 */
class KetQuaKiemTraTaiTruSonntController extends BaseController
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Ketquakttaitrusonnt models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new KetquakttaitrusonntSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Ketquakttaitrusonnt model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Ketquakttaitrusonnt model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Ketquakttaitrusonnt();
        $nguoinopthue = new Nguoinopthue();
        $datevalidation = new DateValidation();

        if ($model->load(Yii::$app->request->post())) {
            $nguoinopthue->load(Yii::$app->request->post());
            $datevalidation->load(Yii::$app->request->post());

            $model->nguoiNopThueId = $nguoinopthue->maSoThue;
            $model->ngayQdkt = $this->convertDatetime($datevalidation->ngayQdkt);
            $model->ngayQdxl = $this->convertDatetime($datevalidation->ngayQdxl);
            $model->ngayKetLuan = $this->convertDatetime($datevalidation->ngayKetLuan);

            $model->ngayTao = date('Y-m-d H:m:s',time()+3600*7);
            $model->ngayCapNhat = date('Y-m-d H:m:s',time()+3600*7);

            if($model->loaiKhuVucDoanhNghiepId == 0) {
                $model->loaiKhuVucDoanhNghiepId = null;
            }
            if($model->loaiNoiDungChuyenDeId == 0) {
                $model->loaiNoiDungChuyenDeId = null;
            }
            if($model->loaiQuyMoDoanhNghiepId == 0) {
                $model->loaiQuyMoDoanhNghiepId = null;
            }

            $model->save();

            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'nguoinopthue' => $nguoinopthue,
                'datevalidation' => $datevalidation
            ]);
        }
    }

    protected function convertDate($string)
    {
        if ($string) {
            $date = \DateTime::createFromFormat('Y-m-d H:i:s', $string);
            return $date->format('d/m/Y');
        }

        return '';

    }

    protected function convertDatetime($string)
    {
        if ($string) {
            $date = \DateTime::createFromFormat("d/m/Y", $string);
            return $date->format('Y-m-d 00:00:00');
        }

        return '';

    }

    /**
     * Updates an existing Ketquakttaitrusonnt model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        $nguoinopthue = Nguoinopthue::findOne($model->nguoiNopThueId);
        $datevalidation = new DateValidation();

        $datevalidation->ngayQdkt = $this->convertDate($model->ngayQdkt);
        $datevalidation->ngayQdxl = $this->convertDate($model->ngayQdxl);
        $datevalidation->ngayKetLuan = $this->convertDate($model->ngayKetLuan);

        if ($model->load(Yii::$app->request->post())) {
            $nguoinopthue->load(Yii::$app->request->post());
            $datevalidation->load(Yii::$app->request->post());

            $model->nguoiNopThueId = $nguoinopthue->id;
            $model->ngayQdkt = $this->convertDatetime($datevalidation->ngayQdkt);
            $model->ngayQdxl = $this->convertDatetime($datevalidation->ngayQdxl);
            $model->ngayKetLuan = $this->convertDatetime($datevalidation->ngayKetLuan);

            $model->ngayCapNhat = date('Y-m-d H:m:s',time()+3600*7);

            if($model->loaiKhuVucDoanhNghiepId == 0) {
                $model->loaiKhuVucDoanhNghiepId = null;
            }
            if($model->loaiNoiDungChuyenDeId == 0) {
                $model->loaiNoiDungChuyenDeId = null;
            }
            if($model->loaiQuyMoDoanhNghiepId == 0) {
                $model->loaiQuyMoDoanhNghiepId = null;
            }

            $model->save();

            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'nguoinopthue' => $nguoinopthue,
                'datevalidation' => $datevalidation
            ]);
        }
    }

    /**
     * Deletes an existing Ketquakttaitrusonnt model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Ketquakttaitrusonnt model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Ketquakttaitrusonnt the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Ketquakttaitrusonnt::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    function actionSelect($q = null, $id = null)
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $out = ['results' => ['id' => '', 'text' => '']];
        if (!is_null($q)) {
            $query = new Query();
            $query->select('id,maSoThue AS text')
                ->from('nguoinopthue')
                ->where(['like', 'maSoThue', $q])
                ->limit(20);
            $command = $query->createCommand();
            $data = $command->queryAll();
            $out['results'] = array_values($data);
        } elseif ($id > 0) {
            $out['results'] = ['id' => $id, 'text' => Nguoinopthue::find()->name];
        }
        return $out;
    }

    public function actionExportExcelBaoCaoTaiNguoiNopThue(){
        $model = new ExportExcel();

        if ($model->load(Yii::$app->request->post())) {

            $start = DateTime::createFromFormat("d/m/Y", $model->start);
            $end = DateTime::createFromFormat("d/m/Y", $model->end);

            $start = $start->format('Y-m-d 00:00:00');
            $end = $end->format('Y-m-d 00:00:00');

            $dataClear = [
                'soQdXuLy',
                'ngayQdxl',
                'soThueTruyThuVat',
                'soThueTruyThuTndn',
                'soThueTruyThuTncn',
                'soThueTruyThuTtdb',
                'soThueTruyThuKhac',
                'soThueKhongDuocHoan',
                'soThueTruyHoan',
                'anDinh',
                'tienPhat',
                'tienKkSai',
                'tienPhatNopCham',
                'tienPhatViPhamHanhChinhKhac',
                'noDongNamTruoc',
                'noPhatSinhTrongNam',
                'daNopChoNoDongNamTruoc',
                'daNopPhatSinhTrongNam',
                'conPhaiNopDongNamTruoc',
                'conPhaiNopPhatSinhTrongNam',
                'soThueDuocGiamTheoKeKhai',
                'soThueDuocGiamTheoTtkt',
                'chenhLech',
                'giamLo',
                'giamKhauTru',
            ];

            $queryData = Ketquakttaitrusonnt::find()
                ->joinWith('nguoiNopThue')
                ->joinWith('loaiNoiDungChuyenDe')
                ->where(['or',['and',['>=','ngayQdxl',$start],
                    ['<=','ngayQdkt',$end]],
                    ['soQdXuLy' => null]
                ]);

//            if(!empty($model->truongDoan)) {
//                $queryData->andWhere(['like','truongdoankiemtra.truongDoan',trim($model->truongDoan)]);
//            }

            /** @var Ketquakttaitrusonnt[] $data */
            $data = $queryData->asArray()->all();

            $dataProvider = [];

            for ($i = 0; $i < count($data); $i++) {
                $data[$i]['ngayQdkt'] = $this->convertDate($data[$i]['ngayQdkt']);
                $data[$i]['ngayQdxl']= $this->convertDate($data[$i]['ngayQdxl']);
                $data[$i]['ngayKetLuan']= $this->convertDate($data[$i]['ngayKetLuan']);

                if ($data[$i]['ngayQdxl'] >= $start && $data[$i]['ngayQdxl']) {

                } else if ($data[$i]['ngayQdxl'] > $end) {
                    foreach ($dataClear as $key => $value) {
                        $data[$i][$value] = '';
                    }
                }

                $dataProvider[] = $data[$i];
            }


            ExportExcelBaoCaoTaiNguoiNopThueHelper::exportExcel($dataProvider, $model->end);
        }
    }
}
