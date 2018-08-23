<?php

namespace app\controllers;

use Akeneo\Component\SpreadsheetParser\SpreadsheetParser;
use app\helpers\DateTimeHelpers;
use app\helpers\ExportExcelBaoCaoHoanThue;
use app\helpers\ExportExcelBaoCaoKiemTraChiTietMauMoiHelper;
use app\helpers\ExportExcelDanhSachQuyetDinhTren30Ngay;
use app\helpers\ExportExcelBaoCaoNoKiemTraHelper;
use app\models\Baocaobaohiemxahoi;
use app\models\Baocaobaohiemxahoitheonam;
use app\models\Lichsunopquyhoanthue;
use app\models\DateExcelExport;
use app\models\DateValidation;
use app\models\Lydohoanthue;
use app\models\Quyetdinhxuphat;
use app\models\Sotheodoisauhoanthue;
use Codeception\Module\SOAP;
use DateTime;
use Yii;
use app\models\Baocaokiemtra;
use app\models\Nguoinopthue;
use app\models\Quyetdinhxuly;
use app\models\Quyetdinhkiemtra;
use app\models\ExportExcel;
use app\models\Truongdoankiemtra;
use app\models\Lichsunopsaukiemtra;
use app\models\BaocaokiemtraSearch;
use yii\db\Query;
use yii\filters\AccessControl;
use yii\web\Response;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use app\helpers\ExportExcelBaoCaoKiemTraHelper;
use app\helpers\ExportExcelBaoCaoHanhViViPhamHelper;
use app\helpers\ExportExcelBaoCaoSoTonHelper;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\helpers\ExportExcelBaoCaoGiaoBanThangHelper;
use app\helpers\ExportExcelBaoCaoTinhHinhKiemTraHelper;
use app\helpers\ExportExcelBaoCaoHanhViViPhamMauMoiHelper;
use app\helpers\ExportExcelBaoCaoSoTonTren30NgayMauMoiHelper;

/**
 * BaocaokiemtraController implements the CRUD actions for Baocaokiemtra model.
 */
class BaoCaoKiemTraController extends BaseController
{
    /**
     * Lists all Baocaokiemtra models.
     * @return mixed
     */
    public function behaviors()
    {
        parent::behaviors();
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    public function actionIndex()
    {
        $searchModel = new BaocaokiemtraSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->pagination->pageSize = 20;

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Baocaokiemtra model.
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
     * Creates a new Baocaokiemtra model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {

        $model = new Baocaokiemtra();
        $nguoinopthue = new Nguoinopthue();
        $quyetdinhkiemtra = new Quyetdinhkiemtra();
        $truongdoankiemtra = new Truongdoankiemtra();
        $lichsunopsaukiemtra = new Lichsunopsaukiemtra();
        $quyetdinhxuly = new Quyetdinhxuly();
        $datevalidation = new DateValidation();
        $lichsunopquyhoanthue = new Lichsunopquyhoanthue();

        if ($model->load(Yii::$app->request->post())) {
            $nguoinopthue->load(Yii::$app->request->post());
            $quyetdinhkiemtra->load(Yii::$app->request->post());
            $quyetdinhxuly->load(Yii::$app->request->post());
            $truongdoankiemtra->load(Yii::$app->request->post());
            $lichsunopsaukiemtra->load(Yii::$app->request->post());
            $lichsunopquyhoanthue->load(Yii::$app->request->post());
            $datevalidation->load(Yii::$app->request->post());

            if ($truongdoankiemtra->truongDoan) {
                $temp = Truongdoankiemtra::find()->where(['=', 'truongDoan', $truongdoankiemtra->truongDoan])->one();
                if (!$temp) {
                    $truongdoankiemtra->save();
                    $quyetdinhkiemtra->truongDoanId = $truongdoankiemtra->id;
                } else {
                    $quyetdinhkiemtra->truongDoanId = $temp->id;
                }
            }

            $quyetdinhkiemtra->ngayQdKiemTra = $this->convertDatetime($datevalidation->ngayQdKiemTra);
            $quyetdinhkiemtra->ngayCongBoQdkt = $this->convertDatetime($datevalidation->ngayCongBoQdkt);
            $quyetdinhkiemtra->ngayTrinhVbTamDungKt = $this->convertDatetime($datevalidation->ngayTrinhVbTamDungKt);
            $quyetdinhkiemtra->ghiChu4 = $quyetdinhkiemtra->nienDoKiemTra;
            $quyetdinhkiemtra->ngayTao = date('Y-m-d 00:00:00', time() + 3600 * 7);
            $quyetdinhkiemtra->save();

            if ($datevalidation->soQdxl) {
                $quyetdinhxuly->soQdXuLy = $datevalidation->soQdxl;
                $quyetdinhxuly->ngayQdXuLy = $this->convertDatetime($datevalidation->ngayQdXuLy);
                $quyetdinhxuly->ngayTao = date('Y-m-d 00:00:00', time() + 3600 * 7);
                $quyetdinhxuly->save();
            }

            $model->soQdktId = $quyetdinhkiemtra->id;
            $model->soQdXuLyId = $quyetdinhxuly->id;

            $model->mst = $nguoinopthue->maSoThue;
            $model->ngayKyBbkt = $this->convertDatetime($datevalidation->ngayKyBbkt);

            if ($model->loaiKhuVucId == 0) {
                $model->loaiKhuVucId = null;
            }
            if ($model->loaiNdktId == 0) {
                $model->loaiNdktId = null;
            }
            if ($model->loaiQuyMoId == 0) {
                $model->loaiQuyMoId = null;
            }

            $model->save();

            $lichsunopsaukiemtra->soQdktId = $model->id;
            $lichsunopsaukiemtra->save();

            if ($model->soQdXuLyId) {
                preg_match('/^[0-9]{4}-[0-9]{4}$/', $quyetdinhkiemtra->nienDoKiemTra, $matches);

                if (count($matches)) {

                    $baocaobaohiemxahoi = new Baocaobaohiemxahoi();

                    $baocaobaohiemxahoi->soQdxlId = $quyetdinhxuly->id;
                    $baocaobaohiemxahoi->mst = $nguoinopthue->maSoThue;
                    $baocaobaohiemxahoi->truongDoan = $truongdoankiemtra->truongDoan;
                    $baocaobaohiemxahoi->save();

                    $year = explode('-', $quyetdinhkiemtra->nienDoKiemTra);

                    for ($i = $year[0]; $i <= $year[1]; $i++) {
                        $baocaobaohiemxahoitheonam = new Baocaobaohiemxahoitheonam();

                        $baocaobaohiemxahoitheonam->mst = $nguoinopthue->maSoThue;
                        $baocaobaohiemxahoitheonam->soQdxlId = $quyetdinhxuly->id;

                        $baocaobaohiemxahoitheonam->bhxhId = $baocaobaohiemxahoi->id;
                        $baocaobaohiemxahoitheonam->namKtbhxh = $i;

                        $baocaobaohiemxahoitheonam->ghiChu3 = Nguoinopthue::findOne($nguoinopthue->maSoThue)->maSoThue;
                        $baocaobaohiemxahoitheonam->ghiChu4 = $quyetdinhxuly->soQdXuLy;

                        $baocaobaohiemxahoitheonam->save();

                    }
                }

            }

            if ($model->loaiNdktId == 14 || $model->loaiNdktId == 15) {

                $sotheodoisauhoanthue = new Sotheodoisauhoanthue();

                $sotheodoisauhoanthue->truocHoanSauHoan = $model->loaiNdktId == 14 ? 0 : 1;

                $sotheodoisauhoanthue->mst = $model->mst;
                $sotheodoisauhoanthue->soQdKtId = $model->soQdktId;

                $quyetdinhxuphat = new Quyetdinhxuphat();
                if ($model->soQdXuLyId) {
                    $quyetdinhxuphat->soQdXuPhat = $quyetdinhxuly->soQdXuLy;
                    $quyetdinhxuphat->ngayQdXuPhat = $quyetdinhxuly->ngayQdXuLy;

                    $sotheodoisauhoanthue->soQdXuPhatId = $quyetdinhxuphat->id;
                }

                $sotheodoisauhoanthue->chiTietHanhViViPham = $model->hanhViViPham;

                $sotheodoisauhoanthue->save();

                $lichsunopquyhoanthue = new Lichsunopquyhoanthue();
                $lichsunopquyhoanthue->soTheoDoiId = $sotheodoisauhoanthue->id;
                $lichsunopquyhoanthue->daNopThueThuHoi = $lichsunopsaukiemtra->daNopPhatSinhTruyHoan;
                $lichsunopquyhoanthue->daNopTienPhatViPham = $lichsunopsaukiemtra->daNopTienPhat;
                $lichsunopquyhoanthue->thoiDiemNop = date("Y-m-d H:i:s", time() + 3600 * 7);

                $lichsunopquyhoanthue->save();
            }

            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'nguoinopthue' => $nguoinopthue,
                'quyetdinhkiemtra' => $quyetdinhkiemtra,
                'truongdoankiemtra' => $truongdoankiemtra,
                'quyetdinhxuly' => $quyetdinhxuly,
                'lichsunopsaukiemtra' => $lichsunopsaukiemtra,
                'datevalidation' => $datevalidation
            ]);
        }

    }

    /**
     * Updates an existing Baocaokiemtra model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        $datevalidation = new DateValidation();
        $datevalidation->ngayKyBbkt = $this->convertDate($model->ngayKyBbkt);

        $nguoinopthue = Nguoinopthue::findOne($model->mst);
        $quyetdinhkiemtra = Quyetdinhkiemtra::findOne($model->soQdktId);

        $datevalidation->ngayQdKiemTra = $this->convertDate($quyetdinhkiemtra->ngayQdKiemTra);
        $datevalidation->ngayCongBoQdkt = $this->convertDate($quyetdinhkiemtra->ngayCongBoQdkt);
        $datevalidation->ngayTrinhVbTamDungKt = $this->convertDate($quyetdinhkiemtra->ngayTrinhVbTamDungKt);

        $truongdoankiemtra = new Truongdoankiemtra();
        if ($quyetdinhkiemtra->truongDoanId) {
            $truongdoankiemtra = Truongdoankiemtra::findOne($quyetdinhkiemtra->truongDoanId);
        }

        $lichsunopsaukiemtra = Lichsunopsaukiemtra::find()
            ->andFilterWhere(['=', 'soQdktId', $model->id])
            ->orderBy('thoiDiemNop DESC')
            ->one();

        $quyetdinhxuly = new Quyetdinhxuly();

        if ($model->soQdXuLyId) {
            $quyetdinhxuly = Quyetdinhxuly::findOne($model->soQdXuLyId);
            $datevalidation->ngayQdXuLy = $this->convertDate($quyetdinhxuly->ngayQdXuLy);
            $datevalidation->soQdxl = $quyetdinhxuly->soQdXuLy;
        }

        if ($model->load(Yii::$app->request->post())) {
            $nguoinopthue->load(Yii::$app->request->post());
            $quyetdinhkiemtra->load(Yii::$app->request->post());
            $quyetdinhxuly->load(Yii::$app->request->post());
            $truongdoankiemtra->load(Yii::$app->request->post());
            $lichsunopsaukiemtra->load(Yii::$app->request->post());
            $datevalidation->load(Yii::$app->request->post());

            if ($truongdoankiemtra->truongDoan) {

                $temp = Truongdoankiemtra::find()->where(['=', 'truongDoan', $truongdoankiemtra->truongDoan])->one();

                if (!$temp) {
                    $truongdoankiemtra->save();
                    $quyetdinhkiemtra->truongDoanId = $truongdoankiemtra->id;
                } else {
                    $quyetdinhkiemtra->truongDoanId = $temp->id;
                }

            }

            $quyetdinhkiemtra->ngayQdKiemTra = $this->convertDatetime($datevalidation->ngayQdKiemTra);
            $quyetdinhkiemtra->ngayCongBoQdkt = $this->convertDatetime($datevalidation->ngayCongBoQdkt);
            $quyetdinhkiemtra->ngayTrinhVbTamDungKt = $this->convertDatetime($datevalidation->ngayTrinhVbTamDungKt);
            $quyetdinhkiemtra->save();


            if ($datevalidation->soQdxl) {
                $quyetdinhxuly->soQdXuLy = $datevalidation->soQdxl;
                $quyetdinhxuly->ngayQdXuLy = $this->convertDatetime($datevalidation->ngayQdXuLy);
                $quyetdinhxuly->ngayTao = $quyetdinhxuly->ngayTao ? $quyetdinhxuly->ngayTao : date('Y-m-d 00:00:00', time() + 3600 * 7);
                $quyetdinhxuly->save();
                $model->soQdXuLyId = $quyetdinhxuly->id;
            } else {
                $model->soQdXuLyId = null;
            }

            /**/

            $model->soQdktId = $quyetdinhkiemtra->id;

            $model->mst = $nguoinopthue->id;
            $model->ngayKyBbkt = $this->convertDatetime($datevalidation->ngayKyBbkt);

            if ($model->loaiKhuVucId == 0) {
                $model->loaiKhuVucId = null;
            }
            if ($model->loaiNdktId == 0) {
                $model->loaiNdktId = null;
            }
            if ($model->loaiQuyMoId == 0) {
                $model->loaiQuyMoId = null;
            }


            $model->save();

            /*if(!$model->soQdktId){
                $quyetdinhxuly->delete();
            }*/

            $lichsunopsaukiemtra_save = new Lichsunopsaukiemtra();

            $lichsunopsaukiemtra_save->daNopDongNamTruoc = $lichsunopsaukiemtra->daNopDongNamTruoc;
            $lichsunopsaukiemtra_save->daNopPhatSinhTruyHoan = $lichsunopsaukiemtra->daNopPhatSinhTruyHoan;
            $lichsunopsaukiemtra_save->daNopPhatSinhTruyThu = $lichsunopsaukiemtra->daNopPhatSinhTruyThu;
            $lichsunopsaukiemtra_save->daNopTienPhat = $lichsunopsaukiemtra->daNopTienPhat;

            $lichsunopsaukiemtra_save->soQdktId = $model->id;

            $lichsunopsaukiemtra_save->thoiDiemNop = date("Y-m-d H:i:s", time() + 3600 * 7);
            $lichsunopsaukiemtra_save->save();

            if ($model->soQdXuLyId) {
                if ($quyetdinhkiemtra->nienDoKiemTra != $quyetdinhkiemtra->ghiChu4) {

                    $listCurBaocaobhxh = Baocaobaohiemxahoitheonam::find()
                        ->where((['and', ['=', 'mst', $model->mst], ['=', 'soQdxlId', $model->soQdXuLyId]]))
                        ->all();

                    preg_match('/^[0-9]{4}-[0-9]{4}$/', $quyetdinhkiemtra->nienDoKiemTra, $matches);

                    if (count($listCurBaocaobhxh) && count($matches)) {
                        foreach ($listCurBaocaobhxh as $key => $value) {
                            $value->delete();
                        }
                    }

                    if (count($matches)) {

                        $baocaobaohiemxahoi = Baocaobaohiemxahoi::find()
                            ->where((['and', ['=', 'mst', $model->mst], ['=', 'soQdxlId', $model->soQdXuLyId]]))
                            ->one();

                        if (!$baocaobaohiemxahoi) {
                            $baocaobaohiemxahoi = new Baocaobaohiemxahoi();

                            $baocaobaohiemxahoi->soQdxlId = $quyetdinhxuly->id;
                            $baocaobaohiemxahoi->mst = $nguoinopthue->maSoThue;

                            $baocaobaohiemxahoi->save();
                        }

                        $year = explode('-', $quyetdinhkiemtra->nienDoKiemTra);

                        for ($i = $year[0]; $i <= $year[1]; $i++) {

                            $baocaobaohiemxahoitheonam = new Baocaobaohiemxahoitheonam();

                            $baocaobaohiemxahoitheonam->mst = $nguoinopthue->id;
                            $baocaobaohiemxahoitheonam->soQdxlId = $quyetdinhxuly->id;
                            $baocaobaohiemxahoitheonam->namKtbhxh = $i;

                            $baocaobaohiemxahoitheonam->bhxhId = $baocaobaohiemxahoi->id;

                            $baocaobaohiemxahoitheonam->ghiChu3 = $nguoinopthue->maSoThue;
                            $baocaobaohiemxahoitheonam->ghiChu4 = $quyetdinhxuly->soQdXuLy;

                            $baocaobaohiemxahoitheonam->save();

                        }

                    }
                }
            }

            if ($model->loaiNdktId == 14 || $model->loaiNdktId == 15) {

                $sotheodoisauhoanthue = Sotheodoisauhoanthue::find()->where(['=', 'soQdKtId', $model->soQdktId])->one();
                if ($sotheodoisauhoanthue) {
                    $sotheodoisauhoanthue->truocHoanSauHoan = $model->loaiNdktId == 15 ? 0 : 1;

                    $sotheodoisauhoanthue->mst = $model->mst;
                    $sotheodoisauhoanthue->soQdKtId = $model->soQdktId;

                    $quyetdinhxuphat = new Quyetdinhxuphat();
                    if ($model->soQdXuLyId) {
                        $quyetdinhxuphat->soQdXuPhat = $quyetdinhxuly->soQdXuLy;
                        $quyetdinhxuphat->ngayQdXuPhat = $quyetdinhxuly->ngayQdXuLy;

                        $sotheodoisauhoanthue->soQdXuPhatId = $quyetdinhxuphat->id;
                    }

                    $sotheodoisauhoanthue->chiTietHanhViViPham = $model->hanhViViPham;

                    $sotheodoisauhoanthue->save();

                    $lichsunopquyhoanthue = new Lichsunopquyhoanthue();
                    $lichsunopquyhoanthue->soTheoDoiId = $sotheodoisauhoanthue->id;
                    $lichsunopquyhoanthue->daNopThueThuHoi = $lichsunopsaukiemtra->daNopPhatSinhTruyHoan;
                    $lichsunopquyhoanthue->daNopTienPhatViPham = $lichsunopsaukiemtra->daNopTienPhat;
                    $lichsunopquyhoanthue->thoiDiemNop = date("Y-m-d H:i:s", time() + 3600 * 7);

                    $lichsunopquyhoanthue->save();

                } else {

                    $sotheodoisauhoanthue = new Sotheodoisauhoanthue();

                    $sotheodoisauhoanthue->truocHoanSauHoan = $model->loaiNdktId == 15 ? 0 : 1;

                    $sotheodoisauhoanthue->mst = $model->mst;
                    $sotheodoisauhoanthue->soQdKtId = $model->soQdktId;

                    $quyetdinhxuphat = new Quyetdinhxuphat();
                    if ($model->soQdXuLyId) {
                        $quyetdinhxuphat->soQdXuPhat = $quyetdinhxuly->soQdXuLy;
                        $quyetdinhxuphat->ngayQdXuPhat = $quyetdinhxuly->ngayQdXuLy;

                        $sotheodoisauhoanthue->soQdXuPhatId = $quyetdinhxuphat->id;
                    }

                    $sotheodoisauhoanthue->chiTietHanhViViPham = $model->hanhViViPham;
                    $sotheodoisauhoanthue->save();

                    $lichsunopquyhoanthue = new Lichsunopquyhoanthue();
                    $lichsunopquyhoanthue->soTheoDoiId = $sotheodoisauhoanthue->id;
                    $lichsunopquyhoanthue->daNopThueThuHoi = $lichsunopsaukiemtra->daNopPhatSinhTruyHoan;
                    $lichsunopquyhoanthue->daNopTienPhatViPham = $lichsunopsaukiemtra->daNopTienPhat;
                    $lichsunopquyhoanthue->thoiDiemNop = date("Y-m-d H:i:s", time() + 3600 * 7);

                    $lichsunopquyhoanthue->save();
                }
            }

            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'nguoinopthue' => $nguoinopthue,
                'quyetdinhkiemtra' => $quyetdinhkiemtra,
                'truongdoankiemtra' => $truongdoankiemtra,
                'quyetdinhxuly' => $quyetdinhxuly,
                'lichsunopsaukiemtra' => $lichsunopsaukiemtra,
                'datevalidation' => $datevalidation
            ]);
        }
    }

    /**
     * Deletes an existing Baocaokiemtra model.
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
     * Finds the Baocaokiemtra model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Baocaokiemtra the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Baocaokiemtra::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionExportExcelBaoCaoKiemTra()
    {
        $model = new ExportExcel();

        if ($model->load(Yii::$app->request->post())) {

            $start = DateTime::createFromFormat("d/m/Y", $model->start);
            $end = DateTime::createFromFormat("d/m/Y", $model->end);

            $start = $start->format('Y-m-d 00:00:00');
            $end = $end->format('Y-m-d 00:00:00');

            $dataClear = [
                'soQdXuLy',
                'ngayQdXuLy',
                'truyThuThueGtgt',
                'truyThuThueTndn',
                'truyThuThueTncn',
                'truyThuThueKhac',
                'truyHoanThueGtgt',
                'truyHoanThueTncn',
                'truyHoanThueKhac',
                'phatTronThue',
                'phatHanhChinhKhac1020',
                'phatKhac',
                'noDongNamTruocChuyenSang',
                'noDongPhatSinhTrongNam',
                'ngayQdXuLy',
                'thueMienGiamTheoKeKhai',
                'thueMienGiamTheoKiemTra',
                'mienGiamChenhLech',
                'giamKhauTru',
                'thueKhongDuocHoan',
                'giamLo',
                'phatChamNop',
                'dangKiemTra',
                'hoanThanhChoPhatSinhTrongKi',
                'hoanThanhChoNoDongKiTruoc',
                'tongCong'
            ];

            $queryData = Baocaokiemtra::find()
                ->joinWith('mst0')
                ->joinWith('soQdkt')
                ->joinWith('soQdXuLy')
                ->joinWith('soQdkt.truongDoan')
                ->joinWith('nganhNghe');
            /*->where(
                ['and',
                    ['>=', 'quyetdinhkiemtra.ngayTao', $start],
                    ['<=', 'quyetdinhkiemtra.ngayTao', $end]
                ]
            );*/

            if (!empty($model->truongDoan)) {
                $queryData->andWhere(['like', 'truongdoankiemtra.truongDoan', trim($model->truongDoan)]);
            }
            if (!empty($model->doiKiemTra2)) {
                $queryData->andWhere(['like', 'doiKiemTra', trim($model->doiKiemTra2)]);
            }

            /** @var Baocaokiemtra[] $data */
            $data = $queryData->asArray()->all();

//            var_dump($data);die;

            /** @var Baocaokiemtra[] $dataProvider
             *
             */

            $yNhap = explode('/', DateTimeHelpers::convertDate($start));

            if ($yNhap[1] + 1 == 12) {
                $startYearT1 = $yNhap[2] + 1 . '-' . '01-01 00:00:00';
            } else {
                $startYearT1 = $yNhap[2] . '-' . '01-01 00:00:00';
            }

            for ($i = 0; $i < count($data); $i++) {

                $namQdXuLy = $data[$i]['soQdXuLy']['ngayQdXuLy'];
                $datetime = new DateTime($namQdXuLy);
                $namQdXuLy = $datetime->format('Y');
                $phatSinhTrongKy = '';
                if ($namQdXuLy == date("Y")) {
                    $phatSinhTrongKy = 1;
                }

                $data[$i]['dangKiemTra'] = empty($data[$i]['soQdXuLyId']) || (isset($data[$i]['soQdXuLyId']) && $data[$i]['soQdXuLy']['ngayTao'] >= $startYearT1 && $data[$i]['soQdkt']['ngayTao'] < $startYearT1) ? 1 : '';

                $data[$i]['ngayKyBbkt'] = $this->convertDate($data[$i]['ngayKyBbkt']);
//                $data[$i]['soQdkt']['ngayTao'] = $this->convertDate($data[$i]['soQdkt']['ngayTao']);
                $data[$i]['soQdkt']['ngayTaoQDKT'] = $data[$i]['soQdkt']['ngayTao'];
                $data[$i]['soQdkt']['ngayQdKiemTra'] = $this->convertDate($data[$i]['soQdkt']['ngayQdKiemTra']);
                $data[$i]['soQdkt']['ngayCongBoQdkt'] = $this->convertDate($data[$i]['soQdkt']['ngayCongBoQdkt']);

                $data[$i]['soQdkt']['noDongKyTruocChuyenSang'] = $data[$i]['soQdkt']['noDongKyTruocChuyenSang'] ? 1 : '';
                $data[$i]['soQdkt']['phatSinhTrongKy'] = $phatSinhTrongKy;

                $data[$i]['soQdXuLy']['ngayQdXuLy'] = $this->convertDate($data[$i]['soQdXuLy']['ngayQdXuLy']);

                $data[$i]['hoanThanhChoNoDongKiTruoc'] = '';
                $data[$i]['hoanThanhChoPhatSinhTrongKi'] = '';

                $endX = new DateTime($end);

                $endX = $endX->modify('+1 day');

                $data[$i]['lichsunopsaukiemtra'] = Lichsunopsaukiemtra::find()
                    ->andFilterWhere(['>=', 'thoiDiemNop', $start])
                    ->andFilterWhere(['<=', 'thoiDiemNop', $endX->format('Y:m:d 00:00:00')])
                    ->andFilterWhere(['=', 'soQdktId', $data[$i]['id']])
                    ->orderBy('thoiDiemNop DESC')
                    ->asArray()
                    ->one();

                if (array_key_exists('ngayTao', $data[$i]['soQdXuLy']) && $data[$i]['soQdXuLy']['ngayTao'] >= $start) {
                    if ($data[$i]['soQdkt']['ngayTao'] < $start) {
                        $data[$i]['hoanThanhChoNoDongKiTruoc'] = 1;
                    } else {
                        $data[$i]['hoanThanhChoPhatSinhTrongKi'] = 1;
                    }

                } else if (array_key_exists('ngayTao', $data[$i]['soQdXuLy']) && $data[$i]['soQdXuLy']['ngayTao'] > $end) {
                    foreach ($dataClear as $key => $value) {
                        $data[$i][$value] = '';
                    }
                }

                $dataProvider[] = $data[$i];
            }

            ExportExcelBaoCaoKiemTraHelper::exportExcel($dataProvider, $start, $end);
        }
    }

    protected
    function convertDate($string)
    {
        if ($string) {
            $date = DateTime::createFromFormat('Y-m-d H:i:s', $string);
            return $date->format('d/m/Y');
        }

        return '';

    }

    protected function convertDateMonth($string)
    {
        if ($string) {
            $date = DateTime::createFromFormat('Y-m-d H:i:s', $string);
            return $date->format('m/d/Y');
        }
        return '';
    }

    protected
    function convertDatetime($string)
    {
        if ($string) {
            $date = DateTime::createFromFormat("d/m/Y", $string);
            return $date->format('Y-m-d 00:00:00');
        }

        return '';

    }

    public
    function actionExportExcelHanhViViPham()
    {
        $model = new ExportExcel();

        if ($model->load(Yii::$app->request->post())) {
            $start = DateTime::createFromFormat("d/m/Y", $model->start);
            $end = DateTime::createFromFormat("d/m/Y", $model->end);

            $start = $start->format('Y-m-d 00:00:00');
            $end = $end->format('Y-m-d 00:00:00');

            $queryData = Baocaokiemtra::find()
                ->joinWith('mst0')
                ->joinWith('soQdkt')
                ->joinWith('soQdXuLy')
                ->joinWith('soQdkt.truongDoan')
                ->joinWith('nganhNghe')
                ->where(['or',
                    ['and',
                        ['>=', 'quyetdinhxuly.ngayTao', $start],
                        ['<', 'quyetdinhkiemtra.ngayTao', $end]],
                    ['and',
                        ['soQdXuLyId' => null],
                        ['<', 'quyetdinhkiemtra.ngayTao', $end],
                    ]

                ]);

            if (!empty($model->truongDoan1)) {
                $queryData->andFilterWhere(['like', 'truongdoankiemtra.truongDoan', trim($model->truongDoan1)]);
            }

            if (!empty($model->doiKiemTra1)) {
                $queryData->andFilterWhere(['like', 'doiKiemTra', trim($model->doiKiemTra1)]);
            }
            /** @var Baocaokiemtra[] $data */
            $data = $queryData->asArray()->all();

            /** @var Baocaokiemtra[] $dataProvider
             *
             */

            $dataProvider = [];

            for ($i = 0; $i < count($data); $i++) {

                $data[$i]['ngayKyBbkt'] = $this->convertDate($data[$i]['ngayKyBbkt']);
                $data[$i]['soQdkt']['ngayQdKiemTra'] = $this->convertDate($data[$i]['soQdkt']['ngayQdKiemTra']);
                $data[$i]['soQdkt']['ngayCongBoQdkt'] = $this->convertDate($data[$i]['soQdkt']['ngayCongBoQdkt']);

                $data[$i]['soQdkt']['noDongKyTruocChuyenSang'] = $data[$i]['soQdkt']['noDongKyTruocChuyenSang'] ? 1 : '';
                $data[$i]['soQdkt']['phatSinhTrongKy'] = $data[$i]['soQdkt']['phatSinhTrongKy'] ? 1 : '';

                $dataProvider[] = $data[$i];
            }

            ExportExcelBaoCaoHanhViViPhamHelper::exportExcel($dataProvider, $model->start, $model->end);

        }
    }

    public
    function actionExportExcelBaoCaoSoTon()
    {
        $model = new ExportExcel();

        if ($model->load(Yii::$app->request->post())) {

            /** @var Baocaokiemtra[] $data */
            $queryData = Baocaokiemtra::find()->innerJoinWith('mst0')->innerJoinWith('soQdkt')->where(['like', 'ngayQdKiemTra', $model->year]);

            if (!empty($model->doiKiemTra)) {
                $queryData->andFilterWhere(['like', 'doiKiemTra', trim($model->doiKiemTra)]);
            }

            $data = $queryData->asArray()->all();
            $dataProvider = [];

            for ($i = 0; $i < count($data); $i++) {

                $temp = explode(' ', $data[$i]['soQdkt']['ngayQdKiemTra']);
                $temp = explode('-', $temp[0]);

                $data[$i]['lichsunopsaukiemtra'] = Lichsunopsaukiemtra::find()
                    ->andFilterWhere(['=', 'soQdktId', $data[$i]['id']])
                    ->orderBy('thoiDiemNop DESC')
                    ->asArray()
                    ->one();

                $dataProvider[$data[$i]['mst0']['maSoThue']][$temp[1]][] = $data[$i];

            }

            ExportExcelBaoCaoSoTonHelper::exportExcel($dataProvider, $model->year);
        }
    }

    public
    function actionExportExcelBaoCaoKetQuaKiemTraHoanThue()
    {
        $model = new ExportExcel();

        if ($model->load(Yii::$app->request->post())) {
            $year = $model->year;
            $startYear = DateTimeHelpers::convertDatetime('1/1/' . $year);

            $loaiHoanThue = ArrayHelper::index(Lydohoanthue::find()->asArray()->all(), 'id');
//            var_dump($loaiHoanThue);
            $data = Baocaokiemtra::find()
//                ->select([
//                    'mst', 'soQdktId', 'soQdXuLyId',
//                    'phatTronThue', 'phatChamNop', 'phatKhac',
//                    'hanhViViPham', 'truyHoanThueGtgt', 'truyHoanThueTncn',
//                    'truyHoanThueKhac', 'ghiChu',
//                    'loaiNdktId', 'qdHtThuocKhRuiRoTrongNam'
//                ])
                ->joinWith('mst0')
                ->joinWith('sotheodoisauhoanthues')
                ->joinWith('lichsunopsaukiemtras')
                /*->where(['and',
                        ['>=', 'ngayKyBbkt', $startYear],
                        ['<=', 'MONTH(ngayKyBbkt)', $model->month],
                        ['=', 'YEAR(ngayKyBbkt)', $model->year]
                    ]
                )*/
                ->asArray()
                ->all();
            $dataProvider = [];
            foreach ($data as $index => $values) {
                if (!empty($loaiHoanThue[$values['sotheodoisauhoanthues']['loaiHoanThueId']]['lyDoHoanThue'])) {
                    $thHoanThue = $loaiHoanThue[$values['sotheodoisauhoanthues']['loaiHoanThueId']]['group'];
                } else {
                    $thHoanThue = null;
                }
                if (!empty($loaiHoanThue[$values['sotheodoisauhoanthues']['loaiHoanThueId']]['lyDoHoanThue'])) {
                    $soThueDeNghiHoan = $values['sotheodoisauhoanthues']['soThueDeNghiHoan'];
                } else {
                    $soThueDeNghiHoan = null;
                }
                if (!empty($loaiHoanThue[$values['sotheodoisauhoanthues']['loaiHoanThueId']]['lyDoHoanThue'])) {
                    $soThueKhongDuocHoan = $values['sotheodoisauhoanthues']['soThueKhongDuocHoan'];
                } else {
                    $soThueKhongDuocHoan = null;
                }

                $dataProvider[] = [
                    'truocHoan' => $values['loaiNdktId'] == 14 ? 1 : 0,
                    'sauHoan' => $values['loaiNdktId'] == 15 ? 1 : 0,
                    'kiemTra' => 1 ? 0 : $values['qdHtThuocKhRuiRoTrongNam'] == 1,
                    'mst' => $values['mst0']['maSoThue'],
                    'tenNguoiNop' => $values['mst0']['tenNguoiNop'],
                    'thHoanThue' => $thHoanThue,
                    'soThueDeNghiHoan' => $soThueDeNghiHoan / 1000,
                    'soThueKhongDuocHoan' => $soThueKhongDuocHoan / 1000,
                    'soThueTruyHoan' => ($values['truyHoanThueGtgt'] + $values['truyHoanThueTncn'] + $values['truyHoanThueKhac']) / 1000,
                    'phat' => ($values['phatTronThue'] + $values['phatChamNop'] + $values['phatKhac']) / 1000,
                    'daNop' => ($values['lichsunopsaukiemtras']['daNopDongNamTruoc'] + $values['lichsunopsaukiemtras']['daNopPhatSinhTruyThu']
                            + $values['lichsunopsaukiemtras']['daNopPhatSinhTruyHoan'] + $values['lichsunopsaukiemtras']['daNopTienPhat']) / 1000,
                    'hanhViViPham' => $values['hanhViViPham'],
                    'ghiChu' => $values['ghiChu'],
                    'ngayKyBbkt' => $values['ngayKyBbkt']
                ];
            }
            ExportExcelBaoCaoHoanThue::exportExcel($dataProvider, $model->month, $model->year);
        }
    }

    public
    function actionDanhSachQuyetDinhTren30Ngay()
    {
        $model = new DateExcelExport();
        $searchModel = new BaocaokiemtraSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        if ($model->load(Yii::$app->request->post())) {
            $dataProvider = $searchModel->searchMauSoMot(Yii::$app->request->queryParams, $model->day);
        } else {
            $dataProvider = $searchModel->searchMauSoMot(Yii::$app->request->queryParams);
        }
        return $this->render('mau-so-mot', [
            'model' => $model,
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public
    function actionExportExcelDanhSachQuyetDinhTren30Ngay()
    {
        $model = new ExportExcel();
        if ($model->load(Yii::$app->request->post())) {

            $start = $model->start;

            $now = str_replace('/', '-', $start);

            $now = date('Y-m-d', strtotime($now));

            $date = strtotime(date("d-m-Y", strtotime($now)) . " -30 day");

            $date = strftime("%Y-%m-%d", $date);

            $queryData = Baocaokiemtra::find()
                ->with('mst0')
                ->with('lydoxulychams')
                ->joinWith('soQdkt')
                ->joinWith('soQdXuLy')
                ->where(['<', 'quyetdinhkiemtra.ngayTao', $date])
                ->andFilterWhere([
                    'or',
                    ['=', 'quyetdinhxuly.ngayTao', 'null'],
                    ['>', 'quyetdinhxuly.ngayTao', $now],
                ]);

            if (!empty($model->truongDoan4)) {
                $queryData->andFilterWhere(['like', 'truongdoankiemtra.truongDoan', trim($model->truongDoan4)]);
            }

            if (!empty($model->doiKiemTra6)) {
                $queryData->andFilterWhere(['like', 'doiKiemTra', trim($model->doiKiemTra6)]);
            }

            $dataProvider = $queryData->asArray()
                ->orderBy(['(quyetdinhxuly.ngayTao)' => SORT_DESC])
                ->all();

            ExportExcelDanhSachQuyetDinhTren30Ngay::exportExcel($dataProvider, $model->start);
        }
    }

    public
    function actionExportExcelBaoCaoNoKiemTra()
    {

        $model = new DateExcelExport();

        if ($model->load(Yii::$app->request->post())) {

            $day = DateTime::createFromFormat("d/m/Y", $model->day);
            $day = $day->format('Y-m-d 23:59:59');

            $data = Lichsunopsaukiemtra::find()
                ->joinWith('soQdkt')
                ->joinWith('soQdkt.soQdkt')
                ->joinWith('soQdkt.soQdXuLy')
                ->joinWith('soQdkt.soQdkt.truongDoan')
                ->joinWith('soQdkt.mst0')
                ->where(['<', 'thoiDiemNop', $day]);

            if (!empty($model->doiKiemTra)) {
                $data->andFilterWhere(['like', 'baocaokiemtra.doiKiemTra', trim($model->doiKiemTra)]);
            }

            $dataProvider = $data->asArray()->all();

            ExportExcelBaoCaoNoKiemTraHelper::exportExcel($dataProvider, $day);
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

    public
    function actionExportExcelBaoCaoGiaoBanThang()
    {
        $model = new ExportExcel();

        if ($model->load(Yii::$app->request->post())) {

            $start = DateTime::createFromFormat("d/m/Y", $model->start);
            $end = DateTime::createFromFormat("d/m/Y", $model->end);

            $year = $end->format('Y');

            $startYear = DateTimeHelpers::convertDatetime('1/12/' . $year - 1);

            $start = $start->format('Y-m-d 00:00:00');
            $end = $end->format('Y-m-d 00:00:00');

            $queryData = Baocaokiemtra::find()
                ->joinWith('soQdkt')
                ->joinWith('soQdXuLy')
                ->joinWith('soQdkt.truongDoan')
                ->where(
                    ['or',
                        ['and',
                            ['>=', 'quyetdinhxuly.ngayTao', $startYear],
                            ['<', 'quyetdinhkiemtra.ngayTao', $end]],
                        ['and',
                            ['soQdXuLyId' => null],
                            ['<', 'quyetdinhkiemtra.ngayTao', $end]]
                    ]);
            if (!empty($model->doiKiemTra3)) {
                $queryData->andFilterWhere(['like', 'doiKiemTra', trim($model->doiKiemTra3)]);
            }

            $data = $queryData->asArray()->all();

            $dataProvider = [];

            for ($i = 0; $i < count($data); $i++) {

                $data[$i]['tonDauThang'] = 0;
                if ($data[$i]['soQdkt']['ngayTao'] >= $startYear && $data[$i]['soQdkt']['ngayTao'] < $start && (!$data[$i]['soQdXuLy']['ngayTao'] || $data[$i]['soQdXuLy']['ngayTao'] >= $start)) {

                    $data[$i]['tonDauThang'] = 1;
                }

                $data[$i]['banHanhTrongThang'] = 0;
                if ($data[$i]['soQdkt']['ngayTao'] >= $start && $data[$i]['soQdkt']['ngayTao'] <= $end) {
                    $data[$i]['banHanhTrongThang'] = 1;
                }

                $data[$i]['hoanThanhTrongThang'] = 0;
                if (($data[$i]['soQdXuLy']['ngayTao'] >= $start && $data[$i]['soQdXuLy']['ngayTao'] < $end) && ($data[$i]['soQdkt']['ngayTao'] >= $start && $data[$i]['soQdkt']['ngayTao'] <= $end)) {
                    $data[$i]['hoanThanhTrongThang'] = 1;
                }

                $data[$i]['hoanThanhTruocThang'] = 0;
                if ($data[$i]['soQdkt']['ngayTao'] < $start && $data[$i]['soQdXuLy']['ngayTao'] && $data[$i]['soQdXuLy']['ngayTao'] >= $startYear && $data[$i]['soQdXuLy']['ngayTao'] < $start) {
                    $data[$i]['hoanThanhTruocThang'] = 1;
                }
                $data[$i]['luyKeHTdenThangBc'] = 0;
                if ($data[$i]['soQdXuLy']['ngayTao'] >= $startYear && $data[$i]['soQdXuLy']['ngayTao'] < $end) {
                    $data[$i]['luyKeHTdenThangBc'] = 1;
                }

                $dataProvider[] = $data[$i];
            }

            ExportExcelBaoCaoGiaoBanThangHelper::exportExcel($dataProvider, $end);
        }
    }

    public
    function actionExportExcelBaoCaoTinhHinhKiemTra()
    {
        $model = new ExportExcel();

        if ($model->load(Yii::$app->request->post())) {

            $day_report = $model->start;

            $d_m_y = explode('/', $day_report);

            $time = gregoriantojd($d_m_y[1], $d_m_y[0], $d_m_y[2]);
            $day_of_week = jddayofweek($time, 1);

            $end = DateTime::createFromFormat("d/m/Y", $day_report);

            $end = $end->format('Y-m-d 00:00:00');

            $temp = new DateTime($end);

            $temp->modify('-7 day');

            $start = $temp->format('Y-m-d 00:00:00');

            $startYear = DateTimeHelpers::convertDatetime('1/12/' . $d_m_y[2] - 1);
//            $startYear = DateTimeHelpers::convertDatetime('1/01/' . $d_m_y[2]);

            $queryData = Baocaokiemtra::find()
                ->joinWith('soQdkt')
                ->joinWith('soQdXuLy')
                ->joinWith('soQdkt.truongDoan')
                ->where(
                    ['or',
                        ['and',
                            ['>=', 'quyetdinhkiemtra.ngayTao', $startYear],
                            ['<=', 'quyetdinhkiemtra.ngayTao', $end]],
                        ['and',
                            ['soQdXuLyId' => null],
                            ['<=', 'quyetdinhkiemtra.ngayTao', $end]]
                    ]);
            if (!empty($model->doiKiemTra4)) {
                $queryData->andFilterWhere(['like', 'doiKiemTra', trim($model->doiKiemTra4)]);
            }

            $data = $queryData->asArray()->all();
            $dataProvider = $data;
//            var_dump($data);die;

            ExportExcelBaoCaoTinhHinhKiemTraHelper::exportExcel($dataProvider, $start, $end);
        }
    }

    public
    function actionNgayTao()
    {
        $listDataBCKT = Baocaokiemtra::find()->all();
        foreach ($listDataBCKT as $key => $value) {
            $quyetdinhkt = Quyetdinhkiemtra::find()->where(['=', 'id', $value->soQdktId])->one();

            $quyetdinhkt->ngayTao = $quyetdinhkt->ngayQdKiemTra;
            $quyetdinhkt->save();

            if ($value->soQdXuLyId) {
                $quyetdinhxl = Quyetdinhxuly::find()->where(['=', 'id', $value->soQdXuLyId])->one();

                $quyetdinhxl->ngayTao = $quyetdinhxl->ngayQdXuLy;
                $quyetdinhxl->save();
            }
        }
    }

    public function actionExportExcelBaoCaoHanhViViPhamMauMoi()
    {
        $model = new ExportExcel();
        if ($model->load(Yii::$app->request->post())) {
            $start = DateTime::createFromFormat("d/m/Y", $model->start);
            $end = DateTime::createFromFormat("d/m/Y", $model->end);

            $start = $start->format('Y-m-d 00:00:00');
            $end = $end->format('Y-m-d 00:00:00');

            $queryData = Baocaokiemtra::find()
                ->joinWith('mst0')
                ->joinWith('soQdkt')
                ->joinWith('soQdXuLy')
                ->joinWith('soQdkt.truongDoan')
                ->joinWith('nganhNghe')
                ->where(['or',
                    ['and',
                        ['>=', 'quyetdinhxuly.ngayTao', $start],
                        ['<', 'quyetdinhkiemtra.ngayTao', $end]],
                    ['and',
                        ['soQdXuLyId' => null],
                        ['<', 'quyetdinhkiemtra.ngayTao', $end],
                    ]

                ]);

            if (!empty($model->truongDoan2)) {
                $queryData->andFilterWhere(['like', 'truongdoankiemtra.truongDoan', trim($model->truongDoan2)]);
            }

            if (!empty($model->doiKiemTra5)) {
                $queryData->andFilterWhere(['like', 'doiKiemTra', trim($model->doiKiemTra5)]);
            }
            /** Baocaokiemtra[] $data*/

            $data = $queryData->asArray()->all();

            /** Baocaokiemtra[] $dataProvider*/

            $dataProvider = [];
            $yNhap = explode('/', DateTimeHelpers::convertDate($start));

            if ($yNhap[1] >= 2 && $yNhap[1] <= 12) {
                $startYearT1 = $yNhap[2] + 1 . '-' . '01-01 00:00:00';
            } else {
                $startYearT1 = $yNhap[2] . '-' . '01-01 00:00:00';
            }

            for ($i = 0; $i < count($data); $i++) {
                $namQdXuLy = $data[$i]['soQdXuLy']['ngayQdXuLy'];
                $datetime = new DateTime($namQdXuLy);
                $namQdXuLy = $datetime->format('Y');
                $phatSinhTrongKy = '';
                if ($namQdXuLy == date("Y")) {
                    $phatSinhTrongKy = 1;
                }

                $data[$i]['dangKiemTra'] = empty($data[$i]['soQdXuLyId']) || (isset($data[$i]['soQdXuLyId']) && $data[$i]['soQdXuLy']['ngayTao'] >= $startYearT1 && $data[$i]['soQdkt']['ngayTao'] < $startYearT1) ? 1 : '';

                $data[$i]['ngayKyBbkt'] = $this->convertDate($data[$i]['ngayKyBbkt']);
                $data[$i]['soQdkt']['ngayTaoQDKT'] = $data[$i]['soQdkt']['ngayTao'];
                $data[$i]['soQdkt']['ngayQdKiemTra'] = $this->convertDate($data[$i]['soQdkt']['ngayQdKiemTra']);
                $data[$i]['soQdkt']['ngayCongBoQdkt'] = $this->convertDate($data[$i]['soQdkt']['ngayCongBoQdkt']);
                $data[$i]['soQdkt']['ngayTrinhVbTamDungKt'] = $this->convertDate($data[$i]['soQdkt']['ngayTrinhVbTamDungKt']);

                $data[$i]['soQdkt']['noDongKyTruocChuyenSang'] = $data[$i]['soQdkt']['noDongKyTruocChuyenSang'] ? 1 : '';
                $data[$i]['soQdkt']['phatSinhTrongKy'] = $phatSinhTrongKy;

                $data[$i]['soQdXuLy']['ngayQdXuLy'] = $this->convertDate($data[$i]['soQdXuLy']['ngayQdXuLy']);

                $data[$i]['hoanThanhChoNoDongKiTruoc'] = '';
                $data[$i]['hoanThanhChoPhatSinhTrongKi'] = '';

                $data[$i]['hanhViViPhamDh'] = $data[$i]['hanhViViPham'];
                $data[$i]['moTaCachThucPhatHienVp'] = $data[$i]['moTaCachThucPhatHien'];

                $endX = new DateTime($end);

                $endX = $endX->modify('+1 day');

                $data[$i]['lichsunopsaukiemtra'] = Lichsunopsaukiemtra::find()
                    ->andFilterWhere(['>=', 'thoiDiemNop', $start])
                    ->andFilterWhere(['<=', 'thoiDiemNop', $endX->format('Y:m:d 00:00:00')])
                    ->andFilterWhere(['=', 'soQdktId', $data[$i]['id']])
                    ->orderBy('thoiDiemNop DESC')
                    ->asArray()
                    ->one();

                if (array_key_exists('ngayTao', $data[$i]['soQdXuLy']) && $data[$i]['soQdXuLy']['ngayTao'] >= $start) {
                    if ($data[$i]['soQdkt']['ngayTao'] < $start) {
                        $data[$i]['hoanThanhChoNoDongKiTruoc'] = 1;
                    } else {
                        $data[$i]['hoanThanhChoPhatSinhTrongKi'] = 1;
                    }

                }

                $dataProvider[] = $data[$i];
            }

            ExportExcelBaoCaoHanhViViPhamMauMoiHelper::exportExcel($dataProvider, $model->start, $model->end);
        }
    }

    public function actionExportExcelBaoCaoTonTren30NgayMauMoi()
    {
        $model = new ExportExcel();
        if ($model->load(Yii::$app->request->post())) {
            $start = $model->start;

            $now = str_replace('/', '-', $start);

            $now = date('Y-m-d', strtotime($now));

            $date = strtotime(date("d-m-Y", strtotime($now)) . " -30 day");

            $date = strftime("%Y-%m-%d", $date);

            $queryData = Baocaokiemtra::find()
                ->with('mst0')
                ->with('lydoxulychams')
                ->joinWith('soQdkt')
                ->joinWith('soQdXuLy')
                ->where(['<', 'quyetdinhkiemtra.ngayTao', $date])
                ->andFilterWhere([
                    'or',
                    ['=', 'quyetdinhxuly.ngayTao', 'null'],
                    ['>', 'quyetdinhxuly.ngayTao', $now],
                ]);

            if (!empty($model->truongDoan5)) {
                $queryData->andFilterWhere(['like', 'truongdoankiemtra.truongDoan', trim($model->truongDoan5)]);
            }

            if (!empty($model->doiKiemTra7)) {
                $queryData->andFilterWhere(['like', 'doiKiemTra', trim($model->doiKiemTra7)]);
            }

            $dataProvider = $queryData->asArray()
                ->orderBy(['(quyetdinhxuly.ngayTao)' => SORT_DESC])
                ->all();

            ExportExcelBaoCaoSoTonTren30NgayMauMoiHelper::exportExcel($dataProvider, $model->start);
        }
    }

    public function actionExportExcelBaoCaoKiemTraChiTietMauMoi()
    {
        $model = new ExportExcel();
        if ($model->load(Yii::$app->request->post())) {
            $start = DateTime::createFromFormat("d/m/Y", $model->start);
            $end = DateTime::createFromFormat("d/m/Y", $model->end);

            $start = $start->format("Y-m-d 00:00:00");
            $end = $end->format("Y-m-d 00:00:00");

            $dataClear = [
                'soQdXuLy',
                'ngayQdXuLy',
                'truyThuThueGtgt',
                'truyThuThueTndn',
                'truyThuThueTncn',
                'truyThuThueKhac',
                'truyHoanThueGtgt',
                'truyHoanThueTncn',
                'truyHoanThueKhac',
                'phatTronThue',
                'phatHanhChinhKhac1020',
                'phatChamNop',
                'phatKhac',
                'noDongNamTruocChuyenSang',
                'noDongPhatSinhTrongNam',
                'thueMienGiamTheoKeKhai',
                'thueMienGiamTheoKiemTra',
                'mienGiamChenhLech',
                'giamKhauTru',
                'thueKhongDuocHoan',
                'giamLo',
                'dangKiemTra',
                'hoanThanhChoPhatSinhTrongKi',
                'hoanThanhChoNoDongKiTruoc',
            ];

            $queryData = Baocaokiemtra::find()
                ->joinWith('mst0')
                ->joinWith('soQdkt')
                ->joinWith('soQdXuLy')
                ->joinWith('soQdkt.truongDoan')
                ->joinWith('nganhNghe')
                ->joinWith('lydoxulychams');

            if (!empty($model->truongDoan6)) {
                $queryData->andFilterWhere(['like', 'truongdoankiemtra.truongDoan', trim($model->truongDoan6)]);
            }
            if (!empty($model->doiKiemTra8)) {
                $queryData->andFilterWhere(['like', 'doiKiemTra', trim($model->doiKiemTra8)]);
            }

            /** @var  Baocaokiemtra[] $data */

            $data = $queryData->asArray()->all();

//            var_dump($data);
//            die;

            /** @var Baocaokiemtra[] $dataProvider */

            $yNhap = explode('/', DateTimeHelpers::convertDate($start));

            if ($yNhap[1] + 1 == 12) {
                $startYearT1 = $yNhap[2] + 1 . '-' . '01-01 00:00:00';
            } else {
                $startYearT1 = $yNhap[2] . '-' . '01-01 00:00:00';
            }

            for ($i = 0; $i < count($data); $i++) {

                $namQdXuLy = $data[$i]['soQdXuLy']['ngayQdXuLy'];
                $datetime = new DateTime($namQdXuLy);
                $namQdXuLy = $datetime->format('Y');
                $phatSinhTrongKy = '';
                if ($namQdXuLy == date("Y")) {
                    $phatSinhTrongKy = 1;
                }

//                $data[$i]['dangKiemTra'] = empty($data[$i]['soQdXuLyId']) || (isset($data[$i]['soQdXuLyId']) && $data[$i]['soQdXuLy']['ngayTao'] >= $startYearT1 && $data[$i]['soQdkt']['ngayTao'] < $startYearT1) ? 1 : '';
                $data[$i]['dangKiemTra'] = empty($data[$i]['soQdXuLyId']) || (isset($data[$i]['soQdXuLyId']) && $data[$i]['soQdXuLy']['ngayTao'] >= $startYearT1 && $data[$i]['soQdkt']['ngayTao'] < $startYearT1) ? 1 : '';

//                $noChuyenKiSau = $data[$i]['noDongNamTruocChuyenSang'];

//                $data[$i]['hoanThanhNhungConNo'] = (isset($data[$i]['soQdXuLyId']) && ) ? 1 : '';

                $data[$i]['ngayKyBbkt'] = $this->convertDate($data[$i]['ngayKyBbkt']);
                $data[$i]['soQdkt']['ngayTaoQDKT'] = $data[$i]['soQdkt']['ngayTao'];
                $data[$i]['soQdkt']['ngayQdKiemTra'] = $this->convertDateMonth($data[$i]['soQdkt']['ngayQdKiemTra']);
                $data[$i]['soQdkt']['ngayCongBoQdkt'] = $this->convertDate($data[$i]['soQdkt']['ngayCongBoQdkt']);

                $data[$i]['soQdkt']['noDongKyTruocChuyenSang'] = $data[$i]['soQdkt']['noDongKyTruocChuyenSang'] ? 1 : '';
                $data[$i]['soQdkt']['phatSinhTrongKy'] = $phatSinhTrongKy;

                $data[$i]['soQdXuLy']['ngayQdXuLy'] = $this->convertDate($data[$i]['soQdXuLy']['ngayQdXuLy']);

                $data[$i]['hoanThanhChoNoDongKiTruoc'] = '';
                $data[$i]['hoanThanhChoPhatSinhTrongKi'] = '';

                $data[$i]['hanhViViPhamDh'] = $data[$i]['hanhViViPham'];
                $data[$i]['moTaCachThucPhatHienVp'] = $data[$i]['moTaCachThucPhatHien'];

                $endX = new DateTime($end);

                $endX = $endX->modify('+1 day');

                $data[$i]['lichsunopsaukiemtra'] = Lichsunopsaukiemtra::find()
                    ->andFilterWhere(['>=', 'thoiDiemNop', $start])
                    ->andFilterWhere(['<=', 'thoiDiemNop', $endX->format('Y:m:d 00:00:00')])
                    ->andFilterWhere(['=', 'soQdktId', $data[$i]['id']])
                    ->orderBy('thoiDiemNop DESC')
                    ->asArray()
                    ->one();

                if (array_key_exists('ngayTao', $data[$i]['soQdXuLy']) && $data[$i]['soQdXuLy']['ngayTao'] >= $start) {
                    if ($data[$i]['soQdkt']['ngayTao'] < $start) {
                        $data[$i]['hoanThanhChoNoDongKiTruoc'] = 1;
                    } else {
                        $data[$i]['hoanThanhChoPhatSinhTrongKi'] = 1;
                    }

                } else if (array_key_exists('ngayTao', $data[$i]['soQdXuLy']) && $data[$i]['soQdXuLy']['ngayTao'] > $end) {
                    foreach ($dataClear as $key => $value) {
                        $data[$i][$value] = '';
                    }
                }

                $dataProvider[] = $data[$i];
            }
            ExportExcelBaoCaoKiemTraChiTietMauMoiHelper::exportExcel($dataProvider, $start, $end);
        }
    }
}
