<?php

namespace app\controllers;

use app\models\Baocaobaohiemxahoi;
use app\models\Baocaobaohiemxahoitheonam;
use app\models\Baocaokiemtra;
use app\models\ExcelUploadForm;
use app\models\Quyetdinhkiemtra;
use app\models\Quyetdinhxuly;
use Yii;
use app\models\Nguoinopthue;
use app\models\NguoinopthueSearch;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use Akeneo\Component\SpreadsheetParser\SpreadsheetParser;
use yii\web\UploadedFile;
use fproject\components\DbHelper;

/**
 * NguoiNopThueController implements the CRUD actions for Nguoinopthue model.
 */
class NguoiNopThueController extends Controller
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
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    /**
     * Lists all Nguoinopthue models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new NguoinopthueSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Nguoinopthue model.
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
     * Creates a new Nguoinopthue model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Nguoinopthue();
        if ($model->load(Yii::$app->request->post())) {

            $modelExist = Nguoinopthue::find()->where(['=', 'maSoThue', $model->maSoThue])->one();

            if ($modelExist) {
                \Yii::$app->getSession()->setFlash('create', 'Mã số thuế đã tồn tại');
                return $this->render('create', [
                    'model' => $model,
                ]);
            }
            $model->save();
            \Yii::$app->getSession()->setFlash('create', 'Tạo mới thành công đơn vị ' . $model->tenNguoiNop);
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Nguoinopthue model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Nguoinopthue model.
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
     * Finds the Nguoinopthue model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Nguoinopthue the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Nguoinopthue::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionImportExcel()
    {
        $model = new ExcelUploadForm();
        $chunkSize = 2000;
        if (Yii::$app->request->isPost) {
            $model->excelFile = UploadedFile::getInstance($model, 'excelFile');
            if ($model->upload()) {
                ini_set('memory_limit', '-1');
                set_time_limit(1200);
                $filePath = './' . $model->path;
                if (!file_exists($filePath)) {
                    throw new BadRequestHttpException('File doesn\'t exists.');
                }
                $nguoiNop = ArrayHelper::index(Nguoinopthue::find()->asArray()->all(), 'maSoThue');
                $workbook = SpreadsheetParser::open($filePath);
                $myWorksheetIndex = $workbook->getWorksheetIndex('0');
                $nguoiNopData = [];
                $nguoiNopDataExist = [];
                $insert = 0;
                $update = 0;
                $dupp = 0;
                foreach ($workbook->createRowIterator($myWorksheetIndex) as $rowIndex => $values) {
                    if ($rowIndex == 0 || $rowIndex == 1 || $rowIndex == 2) {
                        foreach ($values as $key => $data) {
                            if ($data != null) {
                                \Yii::$app->getSession()->setFlash('error1', 'Yêu cầu nhập đúng định dạng !');
                                return $this->redirect(array('index'));
                            }
                        }
                    }
                    if ($rowIndex == 3) {
                        if ($values[0] != "Mã số thuế") {
                            \Yii::$app->getSession()->setFlash('error1', 'Yêu cầu nhập đúng định dạng !');
                            return $this->redirect(array('index'));
                        }
                    }
                    if ($values[0] == "Mã số thuế") {
                        if ($values[1] != "Tên người nộp thuế") {
                            \Yii::$app->getSession()->setFlash('error1', 'Yêu cầu nhập đúng định dạng !');
                            return $this->redirect(array('index'));
                        }
                        if ($values[2] != "CB") {
                            \Yii::$app->getSession()->setFlash('error1', 'Yêu cầu nhập đúng định dạng !');
                            return $this->redirect(array('index'));
                        }
                        if ($values[3] != "Mã ngành nghề KD chính") {
                            \Yii::$app->getSession()->setFlash('error1', 'Yêu cầu nhập đúng định dạng !');
                            return $this->redirect(array('index'));
                        }
                        if ($values[4] != "Tên ngành nghề KD chính") {
                            \Yii::$app->getSession()->setFlash('error1', 'Yêu cầu nhập đúng định dạng !');
                            return $this->redirect(array('index'));
                        }
                        if ($values[5] != "Số nhà/Đường phố") {
                            \Yii::$app->getSession()->setFlash('error1', 'Yêu cầu nhập đúng định dạng !');
                            return $this->redirect(array('index'));
                        }
                        if ($values[6] != "Email TB thuế") {
                            \Yii::$app->getSession()->setFlash('error1', 'Yêu cầu nhập đúng định dạng !');
                            return $this->redirect(array('index'));
                        } else {
                            continue;
                        }
                    }
                    if (empty($values[6])) {
                        $values[6] = null;
                    }
                    if (empty($values[5])) {
                        $values[5] = null;
                    }
                    if (empty($values[4])) {
                        $values[4] = null;
                    }
                    if (empty($values[3])) {
                        $values[3] = null;
                    }
                    if (empty($values[2])) {
                        $values[2] = null;
                    }
                    if (!empty($nguoiNop[$values[0]])) {
                        if (
                            $nguoiNop[$values[0]]['tenNguoiNop'] == $values[1]
                            && $nguoiNop[$values[0]]['ghiChu'] == $values[2]
                            && $nguoiNop[$values[0]]['nganhNgheKdChinh'] == $values[3]
                            && $nguoiNop[$values[0]]['tenNganhNgheKdChinh'] == $values[4]
                            && $nguoiNop[$values[0]]['diaChi'] == $values[5]
                            && $nguoiNop[$values[0]]['emailTbThue'] == $values[6]
                        ) {
                            $dupp++;
                            continue;
                        } else {
                            $update++;
                            $nguoiNopDataExist [] = [
                                'id' => $nguoiNop[$values[0]]['id'],
                                'maSoThue' => $values[0],
                                'tenNguoiNop' => $values[1],
                                'ghiChu' => $values[2],
                                'nganhNgheKdChinh' => $values[3],
                                'tenNganhNgheKdChinh' => $values[4],
                                'diaChi' => $values[5],
                                'emailTbThue' => $values[6]
                            ];
                            if ($update > $chunkSize && 0 == $update % $chunkSize) {
                                DbHelper::updateMultiple('nguoinopthue', $nguoiNopDataExist, 'id');
                                $nguoiNopDataExist = [];
                            }
                        }
                    } else {
                        $insert++;
                        $nguoiNopData [] = [
                            'maSoThue' => $values[0],
                            'tenNguoiNop' => $values[1],
                            'ghiChu' => $values[2],
                            'nganhNgheKdChinh' => $values[3],
                            'tenNganhNgheKdChinh' => $values[4],
                            'diaChi' => $values[5],
                            'emailTbThue' => $values[6]
                        ];
                        if ($insert > $chunkSize && 0 == $insert % $chunkSize) {
                            DbHelper::insertMultiple('nguoinopthue', $nguoiNopData);
                            $nguoiNopData = [];
                        }
                    }
                }
                if (0 < count($nguoiNopData)) {
                    DbHelper::insertMultiple('nguoinopthue', $nguoiNopData);
                }
                if (0 < count($nguoiNopDataExist)) {
                    DbHelper::updateMultiple('nguoinopthue', $nguoiNopDataExist, 'id');
                }

                if (!empty($insert)) {
                    \Yii::$app->getSession()->setFlash('insert', 'Thêm thành công ' . $insert . ' mục !');
                }
                if (!empty($update)) {
                    \Yii::$app->getSession()->setFlash('update', 'Cập nhật thành công ' . $update . ' mục !');
                }
                if (!empty($dupp)) {
                    \Yii::$app->getSession()->setFlash('dupp', 'Phát hiện ' . $dupp . ' mục trùng lặp !');
                }
                return $this->redirect(array('index'));
            }
        }
        \Yii::$app->getSession()->setFlash('error', 'Nhập dữ liệu không thành công !');
        return $this->redirect(array('index'));
    }

    public function actionChangeData()
    {
        set_time_limit(2000);
        ini_set('memory_limit', '-1');
        $nguoiNopDataExist = [];
        $chunkSize = 1000;
        $nguoinop = Nguoinopthue::find()->asArray()->all();
        foreach ($nguoinop as $key => $value) {

            $nguoiNopDataExist [] = [
                'id' => $value['id'],
                'maSoThue' => time() + $key,
                'tenNguoiNop' => "Đơn vị số " . $key,
            ];
            if ($key > $chunkSize && 0 == $key % $chunkSize) {
                DbHelper::updateMultiple('nguoinopthue', $nguoiNopDataExist, 'id');
                $nguoiNopDataExist = [];
            }
        }
    }

    public function actionChangeBckt()
    {
        ini_set('memory_limit', '-1');
        set_time_limit(2000);

        $truongDoan = [
            '1' => 'Trương Thị Ngọc',
            '2' => 'Vũ Thị Hợi',
            '3' => 'Trần Hiểu Minh',
            '4' => 'Nguyễn Văn A',
            '5' => 'Lê Thị C',
        ];

        $date = [
            '1' => '2017-02-28 00:00:00',
            '2' => '2017-1-2 00:00:00',
            '3' => '2017-3-18 00:00:00',
            '4' => '2017-4-3 00:00:00',
            '5' => '2017-5-5 00:00:00',
            '6' => '2017-6-6 00:00:00',
        ];

        $nienDo = [
            '1' => '2016-2020',
            '2' => '2010-2019',
            '3' => '2016-2019',
            '4' => '2017-2018',
        ];
        for ($i = 0; $i < 1000; $i++) {

            $quyetdinhkiemtra = new Quyetdinhkiemtra();
            $quyetdinhxuly = new Quyetdinhxuly();
            $baocaokiemtra = new Baocaokiemtra();

            $quyetdinhxuly->soQdXuLy = $i + 1;
            $quyetdinhxuly->ngayQdXuLy = $date[array_rand($date, 1)];
            $quyetdinhxuly->ngayTao = $date[array_rand($date, 1)];
            $quyetdinhxuly->save(false);

            $quyetdinhkiemtra->soQdKiemTra = $i + 1;
            $quyetdinhkiemtra->ngayQdKiemTra = $date[array_rand($date, 1)];
            $quyetdinhkiemtra->ngayCongBoQdkt = $date[array_rand($date, 1)];
            $quyetdinhkiemtra->ngayTrinhVbTamDungKt = $date[array_rand($date, 1)];
            $quyetdinhkiemtra->ghiChu4 = $quyetdinhkiemtra->nienDoKiemTra;
            $quyetdinhkiemtra->ngayTao = $date[array_rand($date, 1)];
            $quyetdinhkiemtra->save(false);

            $baocaokiemtra->mst = $i + 1;
            $baocaokiemtra->soQdXuLyId = $quyetdinhxuly->id;
            $baocaokiemtra->ngayKyBbkt = $date[array_rand($date, 1)];
            $baocaokiemtra->soQdktId = $quyetdinhkiemtra->id;
            $baocaokiemtra->save(false);

            if ($baocaokiemtra->soQdXuLyId) {
                preg_match('/^[0-9]{4}-[0-9]{4}$/', $quyetdinhkiemtra->nienDoKiemTra, $matches);

                if (count($matches)) {

                    $baocaobaohiemxahoi = new Baocaobaohiemxahoi();

                    $baocaobaohiemxahoi->soQdxlId = $quyetdinhxuly->id;
                    $baocaobaohiemxahoi->mst = $baocaokiemtra->mst;
                    $baocaobaohiemxahoi->save();

                    $year = explode('-', $quyetdinhkiemtra->nienDoKiemTra);

                    for ($i = $year[0]; $i <= $year[1]; $i++) {
                        $baocaobaohiemxahoitheonam = new Baocaobaohiemxahoitheonam();

                        $baocaobaohiemxahoitheonam->mst = $baocaokiemtra->mst;
                        $baocaobaohiemxahoitheonam->soQdxlId = $quyetdinhxuly->id;

                        $baocaobaohiemxahoitheonam->bhxhId = $baocaobaohiemxahoi->id;
                        $baocaobaohiemxahoitheonam->namKtbhxh = $i;

                        $baocaobaohiemxahoitheonam->ghiChu3 = Nguoinopthue::findOne($baocaokiemtra->mst)->maSoThue;
                        $baocaobaohiemxahoitheonam->ghiChu4 = $quyetdinhxuly->soQdXuLy;

                        $baocaobaohiemxahoitheonam->save();

                    }
                }

            }

        }
    }
}

