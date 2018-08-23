<?php

namespace app\controllers;

use Akeneo\Component\SpreadsheetParser\SpreadsheetParser;
use app\helpers\DateTimeHelpers;
use app\helpers\ExportExcelHelper;
use app\models\ExcelUploadForm;
use app\models\ExportExcel;
use app\models\DateValidation;
use app\models\Nguoinopthue;
use Yii;
use app\models\Danhsachhoadonvipham;
use app\models\DanhsachhoadonviphamSearch;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Response;
use yii\db\Query;
use app\helpers\ExportExcelBaoCaoHoaDonViPhamHelper;
use DateTime;
use yii\web\UploadedFile;

/**
 * DanhsachhoadonviphamController implements the CRUD actions for Danhsachhoadonvipham model.
 */
class DanhSachHoaDonViPhamController extends BaseController
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
     * Lists all Danhsachhoadonvipham models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new DanhsachhoadonviphamSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Danhsachhoadonvipham model.
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
     * Creates a new Danhsachhoadonvipham model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Danhsachhoadonvipham();
        $nguoimua = new Nguoinopthue();
        $datevalidation = new DateValidation();

        if ($model->load(Yii::$app->request->post())) {
            $nguoimua->load(Yii::$app->request->post());
            $datevalidation->load(Yii::$app->request->post());

            $model->mstDnMua = $nguoimua->maSoThue;

            $model->ngayPhatHanhHoaDon = DateTimeHelpers::convertDatetime($datevalidation->ngayPhatHanhHoaDon);
            $model->ngayBoTron = DateTimeHelpers::convertDatetime($datevalidation->ngayBoTron);
            $model->ngayThayDoiChuSoHuuGanNhat = DateTimeHelpers::convertDatetime($datevalidation->ngayThayDoiChuSoHuuGanNhat);
            $model->ngayThayDoiDiaDiemGanNhat = DateTimeHelpers::convertDatetime($datevalidation->ngayThayDoiDiaDiemGanNhat);

            $model->ngayBaoCao = date("Y-m-d 00:00:00", time() + 3600 * 7);

            $model->save();

            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'nguoimua' => $nguoimua,
                'datevalidation' => $datevalidation
            ]);
        }
    }

    /**
     * Updates an existing Danhsachhoadonvipham model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $nguoimua = Nguoinopthue::find()->where(['=', 'id', $model->mstDnMua])->one();
        $datevalidation = new DateValidation();

        $datevalidation->ngayPhatHanhHoaDon = DateTimeHelpers::convertDate($model->ngayPhatHanhHoaDon);
        $datevalidation->ngayThayDoiDiaDiemGanNhat = DateTimeHelpers::convertDate($model->ngayThayDoiDiaDiemGanNhat);
        $datevalidation->ngayThayDoiChuSoHuuGanNhat = DateTimeHelpers::convertDate($model->ngayThayDoiChuSoHuuGanNhat);
        $datevalidation->ngayBoTron = DateTimeHelpers::convertDate($model->ngayBoTron);

        if ($model->load(Yii::$app->request->post())) {
            $nguoimua->load(Yii::$app->request->post());
            $datevalidation->load(Yii::$app->request->post());

            $model->mstDnMua = $nguoimua->id;

            $model->ngayPhatHanhHoaDon = DateTimeHelpers::convertDatetime($datevalidation->ngayPhatHanhHoaDon);
            $model->ngayBoTron = DateTimeHelpers::convertDatetime($datevalidation->ngayBoTron);
            $model->ngayThayDoiChuSoHuuGanNhat = DateTimeHelpers::convertDatetime($datevalidation->ngayThayDoiChuSoHuuGanNhat);
            $model->ngayThayDoiDiaDiemGanNhat = DateTimeHelpers::convertDatetime($datevalidation->ngayThayDoiDiaDiemGanNhat);

            $model->save();

            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'nguoimua' => $nguoimua,
                'datevalidation' => $datevalidation
            ]);
        }
    }

    /**
     * Deletes an existing Danhsachhoadonvipham model.
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
     * Finds the Danhsachhoadonvipham model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Danhsachhoadonvipham the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Danhsachhoadonvipham::findOne($id)) !== null) {
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

    function actionExportExcelBaoCaoHoaDonViPham()
    {
        $model = new ExportExcel();

        if ($model->load(Yii::$app->request->post())) {

            $start = DateTime::createFromFormat("d/m/Y", $model->start);
            $end = DateTime::createFromFormat("d/m/Y", $model->end);

            $start = $start->format('Y-m-d 00:00:00');
            $end = $end->format('Y-m-d 00:00:00');

            $dataProvider = Danhsachhoadonvipham::find()
                ->joinWith('mstDnMua0')
                ->where(['and', ['>=', 'ngayBaoCao', $start], ['<=', 'ngayBaoCao', $end]])
                ->asArray()
                ->all();

            foreach ($dataProvider as $key => $value) {

                $dataProvider[$key]['ngayBaoCao'] = DateTimeHelpers::convertDate($value['ngayBaoCao']);
                $dataProvider[$key]['ngayPhatHanhHoaDon'] = DateTimeHelpers::convertDate($value['ngayPhatHanhHoaDon']);
                $dataProvider[$key]['ngayThayDoiChuSoHuuGanNhat'] = DateTimeHelpers::convertDate($value['ngayThayDoiChuSoHuuGanNhat']);
                $dataProvider[$key]['ngayThayDoiDiaDiemGanNhat'] = DateTimeHelpers::convertDate($value['ngayThayDoiDiaDiemGanNhat']);
                $dataProvider[$key]['ngayBoTron'] = DateTimeHelpers::convertDate($value['ngayBoTron']);
            }

            ExportExcelBaoCaoHoaDonViPhamHelper::exportExcel($dataProvider, $end);
        }
    }

    public function actionImportExcel()
    {
        $bhxh = new ExcelUploadForm();

        $error = null;
        $success = null;
        $count = 0;

        $attrBaocaoHdvp = [
            'coQuanQuanLyThueDnMua' => '1',
            'kyHieuHoaDon' => '4',
            'tenHangHoa' => '7',
            'dauHieuViPham' => '10',
            'tenChuDn' => '11',
            'thongBaoBoTron' => '15',
            'coQuanThueQuanLyDnBan' => '17',
            'tenDnBan'=>'18',
            'mstDnBan' => '19',
            'coQuanThueRaQdxl' => '20',
            'ghiChu' => '21',
        ];

        if (Yii::$app->request->isPost) {
            $bhxh->excelFile = UploadedFile::getInstance($bhxh, 'excelFile');
            if ($bhxh->upload()) {

                $filePath = './' . $bhxh->path;
                if (!file_exists($filePath)) {
                    throw new BadRequestHttpException('File doesn\'t exists.');
                }

                $workbook = SpreadsheetParser::open($filePath);
                $myWorksheetIndex = $workbook->getWorksheetIndex('0');

                foreach ($workbook->createRowIterator($myWorksheetIndex) as $rowIndex => $values) {
                    if (count($values) == 2 && $values[0] == false && $values[1] == 'Kết thúc') {
                        break;
                    }

                    if ($rowIndex >= 9) {

                        if (array_key_exists(3, $values)) {

                            $nguoinopthue = Nguoinopthue::find()->where(['=', 'maSoThue', $values[3]])->one();

                            if (!$nguoinopthue) {
                                $error = 'Không tồn tại mã số thuế:' . $values[2] . '<br>';
                            }

                            if (!$error) {
                                $danhsachhoadonvipham = new Danhsachhoadonvipham();

                                $danhsachhoadonvipham->mstDnMua = $nguoinopthue->id;

                                $danhsachhoadonvipham['soHoaDon'] = $values[5] . '';
                                $danhsachhoadonvipham['cmt'] = $values[12] . '';

                                $danhsachhoadonvipham['giaTriHangChuaThue'] = (int)$values[8];
                                $danhsachhoadonvipham['thueVat'] = (int)$values[9];

                                if ($values[6]) {
                                    if ($values[6] instanceof DateTime) {
                                        $danhsachhoadonvipham['ngayPhatHanhHoaDon'] = $values[6]->format('Y-m-d 00:00:00');
                                    } else {

                                        preg_match('/(^(0?[1-9]|1[0-9]|2[0-9]|3[0-1])\/(0?[1-9]|1[0-2])\/([0-9]{2}|[0-9]{4})$)|^$/', $values[6], $matches);

                                        if (count($matches)) {
                                            $danhsachhoadonvipham['ngayPhatHanhHoaDon'] = DateTimeHelpers::convertDatetime($values[6]);
                                        }
                                        else{
                                            $error.='Ngày phát hành hóa đơn không đúng định dạng';
                                        }

                                    }
                                }
                                if ($values[13]) {

                                    if ($values[13] instanceof DateTime) {
                                        $danhsachhoadonvipham['ngayThayDoiChuSoHuuGanNhat'] = $values[13]->format('Y-m-d 00:00:00');
                                    } else {

                                        preg_match('/(^(0?[1-9]|1[0-9]|2[0-9]|3[0-1])\/(0?[1-9]|1[0-2])\/([0-9]{2}|[0-9]{4})$)|^$/', $values[16], $matches);

                                        if (count($matches)) {
                                            $danhsachhoadonvipham['ngayThayDoiChuSoHuuGanNhat'] = DateTimeHelpers::convertDatetime($values[16]);
                                        }
                                        else{
                                            $error.='Ngày thay đổi chủ sở hữu không đúng định dạng';
                                        }
                                    }
                                }

                                if ($values[14]) {
                                    if ($values[14] instanceof DateTime) {
                                        $danhsachhoadonvipham['ngayThayDoiDiaDiemGanNhat'] = $values[14]->format('Y-m-d 00:00:00');
                                    } else {

                                        preg_match('/(^(0?[1-9]|1[0-9]|2[0-9]|3[0-1])\/(0?[1-9]|1[0-2])\/([0-9]{2}|[0-9]{4})$)|^$/', $values[14], $matches);

                                        if (count($matches)) {
                                            $danhsachhoadonvipham['ngayThayDoiDiaDiemGanNhat'] = DateTimeHelpers::convertDatetime($values[14]);
                                        }
                                        else{
                                            $error.='Ngày thay đổi địa điểm gần nhất không đúng định dạng';
                                        }
                                    }
                                }

                                if ($values[16]) {
                                    if ($values[16] instanceof DateTime) {
                                        $danhsachhoadonvipham['ngayBoTron'] = $values[16]->format('Y-m-d 00:00:00');
                                    } else {

                                        preg_match('/(^(0?[1-9]|1[0-9]|2[0-9]|3[0-1])\/(0?[1-9]|1[0-2])\/([0-9]{2}|[0-9]{4})$)|^$/', $values[16], $matches);

                                        if (count($matches)) {
                                            $danhsachhoadonvipham['ngayBoTron'] = DateTimeHelpers::convertDatetime($values[16]);
                                        }
                                        else{
                                            $error.='Ngày bỏ trốn không đúng định dạng';
                                        }
                                    }
                                }

                                foreach ($attrBaocaoHdvp as $colNum => $colText) {
                                    if(isset($values[$colText])){
                                        $danhsachhoadonvipham[$colNum] = $values[$colText].'';
                                    } else {
                                        $danhsachhoadonvipham[$colNum] = '';
                                    }
                                }

                                $danhsachhoadonvipham['ngayBaoCao'] = date('Y-m-d 00:00:00', time() + 3600 * 7);

                                $danhsachhoadonvipham->save();
                                $count++;

                            }
                        }
                    }
                    $success = 'Thêm thành công ' . $count . ' bản ghi';
                }
            }
        }

        if (!$error && $success) {
            Yii::$app->getSession()->setFlash('success', $success);
            return $this->redirect(array('index'));
        }

        Yii::$app->getSession()->setFlash('error', $error);
        return $this->redirect(array('index'));
    }

    public function actionDownload()
    {
        ExportExcelHelper::download('excel/MAU BAO CAO.xlsx');
    }

}
