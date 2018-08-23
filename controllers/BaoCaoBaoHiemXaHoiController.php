<?php

namespace app\controllers;

use Akeneo\Component\SpreadsheetParser\SpreadsheetParser;
use app\helpers\DateTimeHelpers;
use app\helpers\ExportExcelBaoCaoBaoHiemXaHoiTheoNamHelper;
use app\helpers\ExportExcelBaoCaoBaoHiemXaHoiTheoNamMoiHelper;
use app\helpers\ExportExcelHelper;
use app\models\Baocaobaohiemxahoitheonam;
use app\models\DateValidation;
use app\models\ExcelUploadForm;
use app\models\ExportExcel;
use app\models\Nguoinopthue;
use app\models\Quyetdinhxuly;
use Yii;
use app\models\Baocaobaohiemxahoi;
use app\models\BaocaobaohiemxahoiSearch;
use yii\db\Query;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Response;
use app\models\Baocaokiemtra;
use yii\web\UploadedFile;

/**
 * BaoCaoBaoHiemXaHoiController implements the CRUD actions for Baocaobaohiemxahoi model.
 */
class BaoCaoBaoHiemXaHoiController extends BaseController
{

    /**
     * Lists all Baocaobaohiemxahoi models.
     * @return mixed
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

    public function actionIndex()
    {
        $searchModel = new BaocaobaohiemxahoiSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Baocaobaohiemxahoi model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        $baohiemxahoitheonam = Baocaobaohiemxahoitheonam::find()
            ->where(['=', 'bhxhId', $model->id])
            ->all();

        return $this->render('view', [
            'model' => $model,
            'baohiemxahoitheonam' => $baohiemxahoitheonam
        ]);
    }

    /**
     * Creates a new Baocaobaohiemxahoi model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Baocaobaohiemxahoi();
        $nguoinopthue = new Nguoinopthue();
        $quyetdinhxuly = new Quyetdinhxuly();
        $baocaobaohiemxahoitheonam = new Baocaobaohiemxahoitheonam();
        $datevalidation = new DateValidation();

        if ($model->load(Yii::$app->request->post())) {
            $nguoinopthue->load(Yii::$app->request->post());
            $quyetdinhxuly->load(Yii::$app->request->post());
            $datevalidation->load(Yii::$app->request->post());

            $quyetdinhxuly->ngayQdXuLy = DateTimeHelpers::convertDatetime($datevalidation->ngayQdXuLy);

            $quyetdinhxuly->save();

            $model->mst = $nguoinopthue->maSoThue;
            $model->soQdxlId = $quyetdinhxuly->id;

            $model->save();

            $baocaobaohiemxahoitheonam_save = Baocaobaohiemxahoitheonam::find()
                ->where(['and', ['=', 'ghiChu3', Nguoinopthue::findOne($nguoinopthue->maSoThue)->maSoThue], ['=', 'ghiChu4', $quyetdinhxuly->soQdXuLy]])
                ->all();

            foreach ($baocaobaohiemxahoitheonam_save as $key => $value) {
                $value['soQdxlId'] = $quyetdinhxuly->id;
                $value['mst'] = Nguoinopthue::findOne($nguoinopthue->maSoThue)->id;
                $value->save();
            }

            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'nguoinopthue' => $nguoinopthue,
                'quyetdinhxuly' => $quyetdinhxuly,
                'baocaobaohiemxahoitheonam' => $baocaobaohiemxahoitheonam,
                'datevalidation' => $datevalidation
            ]);
        }
    }

    /**
     * Updates an existing Baocaobaohiemxahoi model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $nguoinopthue = Nguoinopthue::findOne($model->mst);
        $quyetdinhxuly = Quyetdinhxuly::findOne($model->soQdxlId);
        $baocaobaohiemxahoitheonamID = ArrayHelper::getColumn(Baocaobaohiemxahoitheonam::find()->select('id')->where(['=', 'bhxhId', $model->id])->asArray()->all(), 'id');
        $baocaobaohiemxahoitheonamModel = [];
        foreach ($baocaobaohiemxahoitheonamID as $key => $value) {
            $baocaobaohiemxahoitheonamModel [] = Baocaobaohiemxahoitheonam::find()->where(['=', 'id', $value])->one();
        }

        $datevalidation = new DateValidation();

        $mst_old = $nguoinopthue->maSoThue;

        $datevalidation->ngayQdXuLy = DateTimeHelpers::convertDate($quyetdinhxuly->ngayQdXuLy);

        if ($model->load(Yii::$app->request->post())) {
            $nguoinopthue->load(Yii::$app->request->post());
            $quyetdinhxuly->load(Yii::$app->request->post());
            $datevalidation->load(Yii::$app->request->post());
            $post = Yii::$app->request->post();
            for ($i = 0; $i < count($baocaobaohiemxahoitheonamModel); $i++) {
                $baocaobaohiemxahoitheonamModel[$i]->namKtbhxh = $post['Baocaobaohiemxahoitheonam' . $i]['namKtbhxh'];
                $baocaobaohiemxahoitheonamModel[$i]->laoDongTrichBhxh = $post['Baocaobaohiemxahoitheonam' . $i]['laoDongTrichBhxh'];
                $baocaobaohiemxahoitheonamModel[$i]->laoDongChuaTrichBhxh = $post['Baocaobaohiemxahoitheonam' . $i]['laoDongChuaTrichBhxh'];
                $baocaobaohiemxahoitheonamModel[$i]->laoDongTrichKpcd = $post['Baocaobaohiemxahoitheonam' . $i]['laoDongTrichKpcd'];
                $baocaobaohiemxahoitheonamModel[$i]->laoDongChuaTrichKpcd = $post['Baocaobaohiemxahoitheonam' . $i]['laoDongChuaTrichKpcd'];
                $baocaobaohiemxahoitheonamModel[$i]->soBhxhPhaiNop = $post['Baocaobaohiemxahoitheonam' . $i]['soBhxhPhaiNop'];
                $baocaobaohiemxahoitheonamModel[$i]->soBhxhDaNop = $post['Baocaobaohiemxahoitheonam' . $i]['soBhxhDaNop'];
                $baocaobaohiemxahoitheonamModel[$i]->soKpcdPhaiNop = $post['Baocaobaohiemxahoitheonam' . $i]['soKpcdPhaiNop'];
                $baocaobaohiemxahoitheonamModel[$i]->soKpcdDaNop = $post['Baocaobaohiemxahoitheonam' . $i]['soKpcdDaNop'];
                $baocaobaohiemxahoitheonamModel[$i]->save();
            }

            $quyetdinhxuly->ngayQdXuLy = DateTimeHelpers::convertDatetime($datevalidation->ngayQdXuLy);

            $quyetdinhxuly->save();

            if ($mst_old != $nguoinopthue->maSoThue) {
                $model->mst = $nguoinopthue->maSoThue;
            }

            $model->soQdxlId = $quyetdinhxuly->id;

            $model->save();

            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'nguoinopthue' => $nguoinopthue,
                'quyetdinhxuly' => $quyetdinhxuly,
                'baocaobaohiemxahoitheonamModel' => $baocaobaohiemxahoitheonamModel,
                'datevalidation' => $datevalidation
            ]);
        }
    }

    /**
     * Deletes an existing Baocaobaohiemxahoi model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $baohiemxahoitheonam = Baocaobaohiemxahoitheonam::find()
            ->where(['=', 'bhxhId', $id])
            ->all();

        if ($baohiemxahoitheonam) {
            foreach ($baohiemxahoitheonam as $key => $v) {
                $v->delete();
            }
        }

        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Baocaobaohiemxahoi model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Baocaobaohiemxahoi the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Baocaobaohiemxahoi::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    function actionSelectsqdxl($mst = null)
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $data = [];
        $bckt = Baocaokiemtra::find()->innerJoinWith('soQdXuLy')->where(['=', 'mst', $mst])->asArray()->all();
        foreach ($bckt as $value => $item) {
            $data [] = [
                'id' => $item['soQdXuLy']['id'],
                'text' => $item['soQdXuLy']['soQdXuLy'],
            ];
        }
        return $data;
    }

    function actionSelectid($mst = null)
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $data = [];
        $idmst = Baocaobaohiemxahoi::find()->where(['=', 'mst', $mst])->asArray()->all();
        foreach ($idmst as $value => $item) {
            $data [] = [
                'id' => $item['id'],
                'mst' => $item['mst']
            ];
        }
        return $data;
    }

    function actionCheckQdxl($qdxl = null)
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $data = Quyetdinhxuly::find()->where(['=', 'soQdXuLy', $qdxl])->asArray()->all();
        if (!$data) {
            return 0;
        } else {
            return 1;
        }
    }

    function actionCheck($idmst = null, $sqdxlid = null)
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $data = Baocaobaohiemxahoi::find()->andFilterWhere(['=', 'mst', $idmst])->andFilterWhere(['=', 'soQdxlId', $sqdxlid])->asArray()->all();
        return $data;
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

    public function actionExportExcelBaoCaoBaoHiemXaHoi()
    {
        $model = new ExportExcel();
        if ($model->load(Yii::$app->request->post())) {

            $start = \DateTime::createFromFormat('d/m/Y', $model->start);
            $end = \DateTime::createFromFormat('d/m/Y', $model->end);
            $start = $start->format('Y-m-d 00:00:00');
            $end = $end->format('Y-m-d 00:00:00');

            $queryData = Baocaobaohiemxahoi::find()
                ->joinWith('mst0')
                ->joinWith('soQdxl')
                ->joinWith('baocaobaohiemxahoitheonams')->groupBy(['baocaobaohiemxahoitheonam.bhxhId', 'baocaobaohiemxahoitheonam.namKtbhxh'])
                ->andFilterWhere(['>=', 'baocaobaohiemxahoi.ngayTao', $start])
                ->andFilterWhere(['<=', 'baocaobaohiemxahoi.ngayTao', $end]);


            if (!empty($model->truongDoan2)) {
                $queryData->andWhere(['like', 'baocaobaohiemxahoi.truongDoan', trim($model->truongDoan2)]);
            }

            $dataProvider = $queryData->asArray()->all();
//            $data = $queryData->asArray()->all();
//            $dataProvider=[];
//            foreach ($data as $key => $value){
//                $value['baocaobaohiemxahoitheonams']= Baocaobaohiemxahoitheonam::find()->groupBy(['bhxhId', 'namKtbhxh'])->asArray()->all();
//                $dataProvider[] = $value;
//            }
//            var_dump($dataProvider);
//            die;
            ExportExcelBaoCaoBaoHiemXaHoiTheoNamHelper::exportExcel($dataProvider, $end);
        }
    }

    public function actionImportExcel()
    {
        $bhxh = new ExcelUploadForm();

        $error = null;
        $success = null;
        $baocaobaohiemxahoi = null;

        if (Yii::$app->request->isPost) {
            $bhxh->excelFile = UploadedFile::getInstance($bhxh, 'excelFile');
            if ($bhxh->upload()) {

                $filePath = './' . $bhxh->path;
                if (!file_exists($filePath)) {
                    throw new BadRequestHttpException('File doesn\'t exists.');
                }

                $workbook = SpreadsheetParser::open($filePath);
                $myWorksheetIndex = $workbook->getWorksheetIndex('0');

                $nguoinopthue = null;
                $quyetdinhxuly = null;
                $truongdoan = null;
                $baocaobaohiemxahoi = null;

                $list = null;
                foreach ($workbook->createRowIterator($myWorksheetIndex) as $rowIndex => $values) {
                    if (count($values) == 2 && $values[0] == false && $values[1] == 'Ghi chú:') {
                        break;
                    }

                    if ($rowIndex == 10) {

                        if (array_key_exists(2, $values) && array_key_exists(25, $values) && array_key_exists(24, $values)) {
                            $nguoinopthue = Nguoinopthue::find()->where(['=', 'maSoThue', $values[2]])->one();
                            $quyetdinhxuly = Quyetdinhxuly::find()->where(['=', 'soQdXuLy', $values[25]])->one();
                            $truongdoan = $values[24];

                            if (!$nguoinopthue) {
                                $error = 'Không tồn tại mã số thuế:' . $values[2] . '<br>';

                            }

                            if (!$quyetdinhxuly) {
                                $error .= 'Số quyết định xử lý:' . $values[25] . 'chưa tồn tại. Vui lòng tạo báo cáo kiểm tra:' . '<br>';
                            }

                            if (!$truongdoan) {
                                $error .= 'Chưa có tên trưởng đoàn' . '<br>';
                            }

                            if (!$error) {
                                $baocaobaohiemxahoi = Baocaobaohiemxahoi::find()->where(['and', ['=', 'mst', $nguoinopthue->id], ['=', 'soQdxlId', $quyetdinhxuly->id]])->one();

                                if ($baocaobaohiemxahoi) {
                                    $success = 'Cập nhật thành công BHXH của ' . $nguoinopthue->tenNguoiNop . ' với số QĐXL là ' . $quyetdinhxuly->soQdXuLy;
                                } else {
                                    $baocaobaohiemxahoi = new Baocaobaohiemxahoi();
                                    $success = 'Tạo mới thành công BHXH của ' . $nguoinopthue->tenNguoiNop . ' với số QĐXL là ' . $quyetdinhxuly->soQdXuLy;

                                    $baocaobaohiemxahoi->mst = $nguoinopthue->id;
                                    $baocaobaohiemxahoi->soQdxlId = $quyetdinhxuly->id;

                                }

                                $baocaobaohiemxahoi->phongChiCucThue = $values[4];

                                $baocaobaohiemxahoi->soDvThanhTraKiemTraHoanThanh = $values[23];

                                if ($values[18]) {
                                    $baocaobaohiemxahoi->viPhamBhxh = 1;
                                }

                                if ($values[19]) {
                                    $baocaobaohiemxahoi->viPhamKpcd = 1;
                                }

                                if ($values[22]) {
                                    $baocaobaohiemxahoi->coKtndKpcd = 1;
                                }

                                if ($values[21]) {
                                    $baocaobaohiemxahoi->coKtndBhxh = 1;
                                }

                                $baocaobaohiemxahoi->ghiChu = $values[20] . '';

                                if (!$baocaobaohiemxahoi->ngayTao) {
                                    $baocaobaohiemxahoi->ngayTao = date('Y-m-d 00:00:00', time() + 3600 * 7);
                                }

                                $baocaobaohiemxahoi->ngayCapNhat = date('Y-m-d 00:00:00', time() + 3600 * 7);

                                $baocaobaohiemxahoi->truongDoan = $truongdoan;

                                $baocaobaohiemxahoi->save();

                                $list = Baocaobaohiemxahoitheonam::find()->where(['=', 'bhxhId', $baocaobaohiemxahoi->id])->all();

                                if ($list) {
                                    foreach ($list as $key => $v) {
                                        $v->delete();
                                    }
                                }
                            }
                        }

                    }

                    if ($rowIndex > 10 && !$error && $success) {
                        /*if ($values['2'] || $values['3'] ||$values['4'] ||$values['5'] ||$values['6']){
                            $error = 'File đầu vào không đúng định dạng, vui lòng tải lại file mẫu';
                        }*/

                        $baocaobaohiemxahoitheonam = new Baocaobaohiemxahoitheonam();
                        $baocaobaohiemxahoitheonam->bhxhId = $baocaobaohiemxahoi->id;

                        $dataRow = [
                            'namKtbhxh' => '6',
                            'laoDongTrichBhxh' => '8',
                            'laoDongChuaTrichBhxh' => '9',
                            'laoDongTrichKpcd' => '10',
                            'laoDongChuaTrichKpcd' => '11',
                            'soBhxhPhaiNop' => '12',
                            'soBhxhDaNop' => '13',
                            'soKpcdPhaiNop' => '15',
                            'soKpcdDaNop' => '16',
                        ];

                        foreach ($dataRow as $k => $v) {
                            if (array_key_exists($v, $values)) {
                                $baocaobaohiemxahoitheonam->$k = $values[$v];
                            }
                        }

                        $baocaobaohiemxahoitheonam->save();
                    }
                }
            }
        }

        if (!$error && $success) {
            \Yii::$app->getSession()->setFlash('success', $success);
            return $this->redirect(array('view', 'id' => $baocaobaohiemxahoi->id));
        }

        \Yii::$app->getSession()->setFlash('error', $error);
        return $this->redirect(array('index'));
    }

    public function actionDownload()
    {
        ExportExcelHelper::download('excel/Mau 1-a-BAO CAO BHXH - 23 hang thang_mau.xlsx');
    }

    public function actionExportExcelBaoCaoBaoHiemXaHoiMoi()
    {
        $model = new ExportExcel();
        if ($model->load(Yii::$app->request->post())) {
            $start = \DateTime::createFromFormat('d/m/Y', $model->start);
            $end = \DateTime::createFromFormat('d/m/Y', $model->end);
            $start = $start->format('Y-m-d 00:00:00');
            $end = $end->format('Y-m-d 00:00:00');

            $queryData = Baocaobaohiemxahoi::find()
                ->joinWith('mst0')
                ->joinWith('soQdxl')
                ->joinWith('baocaobaohiemxahoitheonams')->groupBy(['baocaobaohiemxahoitheonam.bhxhId', 'baocaobaohiemxahoitheonam.namKtbhxh'])
//                ->orderBy(['baocaobaohiemxahoitheonam.namKtbhxh' => SORT_DESC])
                ->andFilterWhere(['>=', 'baocaobaohiemxahoi.ngayTao', $start])
                ->andFilterWhere(['<=', 'baocaobaohiemxahoi.ngayTao', $end]);


            if (!empty($model->truongDoan6)) {
                $queryData->andWhere(['like', 'baocaobaohiemxahoi.truongDoan', trim($model->truongDoan6)]);
            }

            $dataProvider = $queryData->asArray()->all();
//            var_dump($dataProvider);
//            die();

            ExportExcelBaoCaoBaoHiemXaHoiTheoNamMoiHelper::exportExcel($dataProvider, $start, $end);
        }
    }
}


