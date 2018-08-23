<?php

namespace app\controllers;

use app\helpers\ExportExcelBaoCaoMau7bHelper;
use app\helpers\ExportExcelBaoCaoMau8AHelper;
use app\helpers\ExportExcellBaoCaoMau7aHelper;
use app\helpers\ExportExcelBaoCaoMau8bHelper;
use app\models\ExportExcel;
use app\helpers\DateTimeHelpers;
use app\models\Quyetdinhthuhoihoanthue;
use app\models\DateValidation;
use app\models\Lichsunopquyhoanthue;
use app\models\Lydohoanthue;
use app\models\Nguoinopthue;
use app\models\Quyetdinhkiemtra;
use app\models\Quyetdinhthanhtra;
use app\models\Quyetdinhxuphat;
use app\models\Sotheodoisauhoanthue;
use app\models\SotheodoisauhoanthueSearch;
use app\models\Vanban;
use DateTime;
use Yii;
use yii\db\Query;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\Response;

/**
 * * SotheodoisauhoanthueController implements the CRUD actions for Sotheodoisauhoanthue model..
 */
class SoTheoDoiSauHoanThueController extends BaseController
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
            /*'access' => [
                'class' => AccessControl::className(),
                'only' => ['create', 'update', 'delete', 'index', 'view'],
                'rules' => [
                    [
                        'actions' => ['create', 'update', 'delete', 'index', 'view'],
                        'allow' => true,
                        'roles' => ['@'],
                    ]
                ],
            ],*/
        ];
    }

    /**
     * * Lists all Sotheodoisauhoanthue models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new SotheodoisauhoanthueSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Sotheodoisauhoanthue model.
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
     * Creates a new Sotheodoisauhoanthue model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Sotheodoisauhoanthue();
        $nguoinopthue = new Nguoinopthue();
        $quyetdinhttra = new Quyetdinhthanhtra();
        $vanban = new Vanban();
        $lichsunophoanthue = new Lichsunopquyhoanthue();
        $quyetdinhxp = new Quyetdinhxuphat();
        $quyetdinhth = new Quyetdinhthuhoihoanthue();
        $quyetdinhkt = new Quyetdinhkiemtra();
        $datevalidation = new DateValidation();

        if ($model->load(Yii::$app->request->post())) {
            $nguoinopthue->load(Yii::$app->request->post());
            $quyetdinhttra->load(Yii::$app->request->post());
            $vanban->load(Yii::$app->request->post());
            $quyetdinhxp->load(Yii::$app->request->post());
            $quyetdinhth->load(Yii::$app->request->post());
            $quyetdinhkt->load(Yii::$app->request->post());
            $lichsunophoanthue->load(Yii::$app->request->post());
            $datevalidation->load(Yii::$app->request->post());

            if ($datevalidation->loaiQd == 1) {
                $quyetdinhkt->soQdKiemTra = $datevalidation->soQd;
                $quyetdinhkt->ngayQdKiemTra = $this->convertDatetime($datevalidation->ngayQdKiemTra);

                $quyetdinhkt_exist = Quyetdinhkiemtra::find()->where(['=', 'soQdKiemTra', $datevalidation->soQd])->one();

                if ($quyetdinhkt_exist) {
                    $quyetdinhkt_exist->ngayQdKiemTra = $this->convertDatetime($datevalidation->ngayQdKiemTra);
                    $quyetdinhkt_exist->soQdKiemTra = $datevalidation->soQd;
                    $quyetdinhkt_exist->save();
                    $model->soQdKtId = $quyetdinhkt_exist->id;
                } else {
                    $quyetdinhkt->save();
                    $model->soQdKtId = $quyetdinhkt->id;
                }

            } else {
                $quyetdinhttra->ngayQdThanhTra = $this->convertDatetime($datevalidation->ngayQdKiemTra);
                $quyetdinhttra->soQdThanhTra = $datevalidation->soQd;
                $quyetdinhttra_exist = Quyetdinhthanhtra::find()->where(['=', 'soQdThanhTra', $datevalidation->soQd])->one();

                if ($quyetdinhttra_exist) {
                    $quyetdinhttra_exist->ngayQdThanhTra = $this->convertDatetime($datevalidation->ngayQdKiemTra);
                    $quyetdinhttra_exist->soQdThanhTra = $datevalidation->soQd;
                    $quyetdinhttra_exist->save();
                    $model->soQdThanhTraId = $quyetdinhttra_exist->id;
                } else {
                    $quyetdinhttra->save();
                    $model->soQdThanhTraId = $quyetdinhttra->id;
                }
            }

            if ($vanban->soVb) {
                $vanban->ngayVb = $this->convertDatetime($datevalidation->ngayVb);
                $vanban->save();

                $model->soVbHoanThueId = $vanban->id;
            }

            if ($quyetdinhth->soQdThuHoiHoan) {
                $quyetdinhth->ngayQdThuHoiHoan = $this->convertDatetime($datevalidation->ngayQdThuHoiHoan);
                $quyetdinhth->save();

                $model->soQdThuHoiHoanId = $quyetdinhth->id;

                $lichsunophoanthue_save = new Lichsunopquyhoanthue();

                $lichsunophoanthue_save->soTheoDoiId = $model->id;
                $lichsunophoanthue_save->daNopThueThuHoi = $lichsunophoanthue->daNopThueThuHoi;
                $lichsunophoanthue_save->daNopTienChamNop = $lichsunophoanthue->daNopTienChamNop;
                $lichsunophoanthue_save->daNopTienPhatViPham = $lichsunophoanthue->daNopTienPhatViPham;
                $lichsunophoanthue_save->thoiDiemNop = date("Y-m-d H:i:s", time() + 3600 * 7);
                $lichsunophoanthue_save->save();
            }

            if ($quyetdinhxp->soQdXuPhat) {
                $quyetdinhxp->ngayQdXuPhat = $this->convertDatetime($datevalidation->ngayQdXuPhat);
                $quyetdinhxp->save();

                $model->soQdXuPhatId = $quyetdinhxp->id;
            }

            $model->mst = $nguoinopthue->maSoThue;
            if ($model->loaiHoanThueId == 0) {
                $model->loaiHoanThueId = null;
            }

            $model->ngayCapNhat = date('Y-m-d H:m:s', time() + 3600 * 7);

            $model->ngayTao = date('Y-m-d 00:00:00', time() + 3600 * 7);

            $model->save();

            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'nguoinopthue' => $nguoinopthue,
                'quyetdinhttra' => $quyetdinhttra,
                'vanban' => $vanban,
                'quyetdinhxp' => $quyetdinhxp,
                'quyetdinhth' => $quyetdinhth,
                'quyetdinhkt' => $quyetdinhkt,
                'lichsunophoanthue' => $lichsunophoanthue,
                'datevalidation' => $datevalidation,
            ]);
        }
    }

    /**
     * Updates an existing Sotheodoisauhoanthue model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $datevalidation = new DateValidation();

        $model = $this->findModel($id);

        $nguoinopthue = Nguoinopthue::findOne($model->mst);

        $quyetdinhttra = new Quyetdinhthanhtra();
        $quyetdinhkt = new Quyetdinhkiemtra();
        if ($model->soQdKtId) {
            $quyetdinhkt = Quyetdinhkiemtra::findOne($model->soQdKtId);
            $datevalidation->ngayQdKiemTra = $this->convertDate($quyetdinhkt->ngayQdKiemTra);
            $datevalidation->soQd = $quyetdinhkt->soQdKiemTra;
            $datevalidation->loaiQd = 1;
        } else {
            $quyetdinhttra = Quyetdinhthanhtra::findOne($model->soQdThanhTraId);
            $datevalidation->ngayQdKiemTra = $this->convertDate($quyetdinhttra->ngayQdThanhTra);
            $datevalidation->soQd = $quyetdinhttra->soQdThanhTra;
            $datevalidation->loaiQd = 2;
        }

        $vanban = new Vanban();
        if ($model->soVbHoanThueId) {
            $vanban = Vanban::findOne($model->soVbHoanThueId);
            $datevalidation->ngayVb = $this->convertDate($vanban->ngayVb);
        }

        if ($model->loaiHoanThueId == 0) {
            $model->loaiHoanThueId = null;
        }
        $quyetdinhxp = new Quyetdinhxuphat();
        if ($model->soQdXuPhatId) {
            $quyetdinhxp = Quyetdinhxuphat::findOne($model->soQdXuPhatId);
            $datevalidation->ngayQdXuPhat = $this->convertDate($quyetdinhxp->ngayQdXuPhat);
        }
        $quyetdinhth = new Quyetdinhthuhoihoanthue();

        if ($model->soQdThuHoiHoanId) {
            $quyetdinhth = Quyetdinhthuhoihoanthue::findOne($model->soQdThuHoiHoanId);
            $datevalidation->ngayQdThuHoiHoan = $this->convertDate($quyetdinhth->ngayQdThuHoiHoan);
        }

        $lichsunophoanthue = Lichsunopquyhoanthue::find()
            ->andFilterWhere(['=', 'soTheoDoiId', $model->id])
            ->orderBy('thoiDiemNop DESC')
            ->one();
        if (!$lichsunophoanthue) {
            $lichsunophoanthue = new Lichsunopquyhoanthue();
        }
        if ($model->load(Yii::$app->request->post())) {
            $nguoinopthue->load(Yii::$app->request->post());
            $quyetdinhttra->load(Yii::$app->request->post());
            $vanban->load(Yii::$app->request->post());
            $quyetdinhxp->load(Yii::$app->request->post());
            $quyetdinhth->load(Yii::$app->request->post());
            $quyetdinhkt->load(Yii::$app->request->post());
            $lichsunophoanthue->load(Yii::$app->request->post());
            $datevalidation->load(Yii::$app->request->post());

            if ($datevalidation->loaiQd == 1) {
                $quyetdinhkt->ngayQdKiemTra = $this->convertDatetime($datevalidation->ngayQdKiemTra);
                $quyetdinhkt->soQdKiemTra = $datevalidation->soQd;

                $quyetdinhktExist = Quyetdinhkiemtra::find()->where(['=', 'soQdKiemTra', $quyetdinhkt->soQdKiemTra])->one();
                if ($quyetdinhktExist) {
                    $quyetdinhktExist->ngayQdKiemTra = $quyetdinhkt->ngayQdKiemTra;
                    $quyetdinhktExist->save();
                    $model->soQdKtId = $quyetdinhktExist->id;
                } else {
                    $quyetdinhkt->save();
                    $model->soQdKtId = $quyetdinhkt->id;
                }

                $model->soQdThanhTraId = null;
//                Quyetdinhthanhtra::find()->where(['=','id', $model->soQdThanhTraId])->one()->delete();

            } else {
                $quyetdinhttra->ngayQdThanhTra = $this->convertDatetime($datevalidation->ngayQdThanhTra);
                $quyetdinhttra->soQdThanhTra = $datevalidation->soQd;

                $quyetdinhttraExist = Quyetdinhthanhtra::find()->where(['=', 'soQdThanhTra', $quyetdinhttra->soQdThanhTra])->one();

                if ($quyetdinhttraExist) {
                    $quyetdinhttraExist->ngayQdThanhTra = $quyetdinhttra->ngayQdThanhTra;
                    $quyetdinhttraExist->save();
                    $model->soQdKtId = $quyetdinhttraExist->id;
                } else {
                    $quyetdinhttra->save();
                    $model->soQdThanhTraId = $quyetdinhttra->id;
                }

                $model->soQdKtId = null;
//                Quyetdinhkiemtra::find()->where(['=','id', $model->soQdKtId])->one()->delete();
            }

            if ($vanban->soVb) {
                $vanban->ngayVb = $this->convertDatetime($datevalidation->ngayVb);
                $vanban->save();

                $model->soVbHoanThueId = $vanban->id;
            }

            if ($quyetdinhth->soQdThuHoiHoan) {
                $quyetdinhth->ngayQdThuHoiHoan = $this->convertDatetime($datevalidation->ngayQdThuHoiHoan);
                $quyetdinhth->save();

                $model->soQdThuHoiHoanId = $quyetdinhth->id;

            }

            if ($quyetdinhxp->soQdXuPhat) {
                $quyetdinhxp->ngayQdXuPhat = $this->convertDatetime($datevalidation->ngayQdXuPhat);
                $quyetdinhxp->save();

                $model->soQdXuPhatId = $quyetdinhxp->id;
            }

            $model->mst = $nguoinopthue->id;
            $model->ngayCapNhat = date('Y-m-d 00:00:00', time() + 3600 * 7);
            $model->save();

            $lichsunophoanthue_save = new Lichsunopquyhoanthue();
            $lichsunophoanthue_save->soTheoDoiId = $model->id;
            $lichsunophoanthue_save->daNopThueThuHoi = $lichsunophoanthue->daNopThueThuHoi;
            $lichsunophoanthue_save->daNopTienChamNop = $lichsunophoanthue->daNopTienChamNop;
            $lichsunophoanthue_save->daNopTienPhatViPham = $lichsunophoanthue->daNopTienPhatViPham;
            $lichsunophoanthue_save->thoiDiemNop = date("Y-m-d H:i:s", time() + 3600 * 7);
            $lichsunophoanthue_save->save();

            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'nguoinopthue' => $nguoinopthue,
                'quyetdinhttra' => $quyetdinhttra,
                'vanban' => $vanban,
                'quyetdinhxp' => $quyetdinhxp,
                'quyetdinhth' => $quyetdinhth,
                'quyetdinhkt' => $quyetdinhkt,
                'lichsunophoanthue' => $lichsunophoanthue,
                'datevalidation' => $datevalidation,
            ]);
        }
    }

    protected function convertDatetime($string)
    {
        if ($string) {
            $date = DateTime::createFromFormat("d/m/Y", $string);
            return $date->format('Y-m-d 00:00:00');
        }

        return '';

    }

    protected function convertDate($string)
    {
        if ($string) {
            $date = DateTime::createFromFormat('Y-m-d H:i:s', $string);
            return $date->format('d/m/Y');
        }
        return '';
    }

    /**
     * Deletes an existing Sotheodoisauhoanthue model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    /*
     * Chú ý: Nếu lichsunopquyhoanthue có soTheoDoiId trùng nhau của 1 sổ theo dõi sau hoàn thuế sẽ không xóa được
     * */
    public function actionDelete($id)
    {
        $lichsunopquyhoanthue = Lichsunopquyhoanthue::find()->where(['=', 'soTheoDoiId', $id])->one();
        if ($lichsunopquyhoanthue->delete()) {
            \Yii::$app->getSession()->setFlash('deleted', 'Xóa thành công');
        }
        $this->findModel($id)->delete();
        return $this->redirect(['index']);
    }

    /**
     * Finds the Sotheodoisauhoanthue model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return SoTheoDoiSauHoanThue the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Sotheodoisauhoanthue::findOne($id)) !== null) {
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

    function actionGetQuyetDinhKiemTra($q = null, $id = null)
    {

        Yii::$app->response->format = Response::FORMAT_JSON;

        $data = [];
        $sotdsht = Sotheodoisauhoanthue::find()->innerJoinWith('soQdKt')->where(['=', 'mst', $q])->asArray()->all();
        foreach ($sotdsht as $value => $items) {
            $data [] = [
                'id' => $items['soQdKt']['id'],
                'text' => $items['soQdKt']['soQdKiemTra'],
                'ngayQdKiemTra' => $items['soQdKt']['ngayQdKiemTra'],
                /*  'noDongKyTruocChuyenSang' => $items['soQdKt']['noDongKyTruocChuyenSang'],
                  'phatSinhTrongKy' => $items['soQdKt']['phatSinhTrongKy'],
                  'nienDoKiemTra' => $items['soQdKt']['nienDoKiemTra'],
                  'truongDoanId' => $items['soQdKt']['truongDoanId'],
                  'ngayCongBoQdkt' => $items['soQdKt']['ngayCongBoQdkt'],
                  'ngayTrinhVbTamDungKt' => $items['soQdKt']['ngayTrinhVbTamDungKt'],*/
            ];
        }
        return $data;
    }

    /*function actionGetQuyetDinhThanhTra($q = null, $id = null)
    {

        Yii::$app->response->format = Response::FORMAT_JSON;

        $data = [];
        if ($q == 0) {
            $bckt = Quyetdinhthanhtra::find()->asArray()->all();
            foreach ($bckt as $value => $items) {
                $data [] = [
                    'id' => $items['id'],
                    'text' => $items['soQdKiemTra'],
                ];
            }
        } else {
            $bckt = Sotheodoisauhoanthue::find()->innerJoinWith('soQdXuLy')->where(['=', 'mst', $q])->asArray()->all();
            foreach ($bckt as $value => $item) {
                $data [] = [
                    'id' => $item['soQdXuLy']['id'],
                    'text' => $item['soQdXuLy']['soQdThanhTra'],
                    'ngayQdThanhTra' => $item['soQdXuLy']['ngayQdThanhTra'],
                ];
            }
        }

        $out = ['results' => ['id' => '', 'soQdThanhTra' => '']];
        if (!is_null($q)) {
            $out['results'] = array_values($data);
        } elseif ($id > 0) {
            $out['results'] = ['id' => $id, 'text' => Quyetdinhkiemtra::find()->asArray()->one()];
        }
        return $out;
    }*/


    function actionGetQuyetDinhThanhTra($q = null, $id = null)
    {

        Yii::$app->response->format = Response::FORMAT_JSON;

        $data = [];
        $sotdsht = Sotheodoisauhoanthue::find()->innerJoinWith('soQdThanhTra')->where(['=', 'mst', $q])->asArray()->all();
        foreach ($sotdsht as $value => $items) {
            $data [] = [
                'id' => $items['soQdThanhTra']['id'],
                'text' => $items['soQdThanhTra']['soQdThanhTra'],
                'ngayQdThanhTra' => $items['soQdThanhTra']['ngayQdThanhTra'],
            ];
        }
        return $data;
    }

    /* function actionGetQuyetDinhThuHoiHoanThue($q = null, $id = null)
     {

         Yii::$app->response->format = Response::FORMAT_JSON;

         $data = [];
         $sotdsht = Sotheodoisauhoanthue::find()->innerJoinWith('soQdThuHoiHoan')->where(['=', 'mst', $q])->asArray()->all();
         foreach ($sotdsht as $value => $items) {
             $data [] = [
                 'id' => $items['soQdThuHoiHoan']['id'],
                 'text' => $items['soQdThuHoiHoan']['soQdThuHoiHoan'],
                 'ngayQdThuHoiHoan' => $items['soQdThuHoiHoan']['ngayQdThuHoiHoan'],
                 'soTienThueThuHoi' => $items['soQdThuHoiHoan']['soTienThueThuHoi']
             ];
         }
         return $data;
     }*/

    /*   function actionGetQuyetDinhXuPhat($q = null, $id = null)
       {

           Yii::$app->response->format = Response::FORMAT_JSON;

           $data = [];
           $sotdsht = Sotheodoisauhoanthue::find()->innerJoinWith('soQdXuPhat')->where(['=', 'mst', $q])->asArray()->all();
           foreach ($sotdsht as $value => $items) {
               $data [] = [
                   'id' => $items['soQdXuPhat']['id'],
                   'text' => $items['soQdXuPhat']['soQdXuPhat'],
                   'ngayQdXuPhat' => $items['soQdXuPhat']['ngayQdXuPhat'],
                   'soTienPhatViPham' => $items['soQdXuPhat']['soTienPhatViPham'],
                   'tienChamNop' => $items['soQdXuPhat']['tienChamNop'],
               ];
           }
           return $data;
       }*/

    /*function actionGetVanBanHoanThue($q = null, $id = null)
    {
        Yii::$app->response->format = Response::FORMAT_JSON;

        $data = [];
        $sotdsht = Sotheodoisauhoanthue::find()->innerJoinWith('soVbHoanThue')->where(['=', 'mst', $q])->asArray()->all();
        foreach ($sotdsht as $value => $items) {
            $data [] = [
                'id' => $items['soVbHoanThue']['id'],
                'text' => $items['soVbHoanThue']['soVb'],
                'ghiChu' => $items['soVbHoanThue']['ghiChu'],
                'ngayVb' => $items['soVbHoanThue']['ngayVb'],
                'soTienThue' => $items['soVbHoanThue']['soTienThue'],
                'soTienLai'=>$items['soVbHoanThue']['soTienLai']
            ];
        }
        return $data;
    }*/

    function actionSearchQuyetDinhThanhTra($so_qdthanhtra = null)
    {

        Yii::$app->response->format = Response::FORMAT_JSON;

        $so_qdthanhtra = Quyetdinhthanhtra::find()->where(['=', 'soQdThanhTra', $so_qdthanhtra])->asArray()->all();

        return $so_qdthanhtra;
    }

    function actionSearchQuyetDinhKiemTra($so_qdkt = null)
    {

        Yii::$app->response->format = Response::FORMAT_JSON;

        $so_qdkt = Quyetdinhkiemtra::find()->where(['=', 'soQdKiemTra', $so_qdkt])->asArray()->all();

        return $so_qdkt;
    }

    function actionGetSoTheoDoiSauHoanThueByQdkt($mst = null, $id_qdkt = null)
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $sotdsht = Sotheodoisauhoanthue::find()->andFilterWhere(['=', 'soQdKtId', $id_qdkt])->andFilterWhere(['=', 'mst', $mst])->asArray()->all();
        return $sotdsht;
    }

    function actionGetSoTheoDoiSauHoanThueByQdtt($mst = null, $id_qdtt = null)
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $sotdsht = Sotheodoisauhoanthue::find()->andFilterWhere(['=', 'soQdThanhTraId', $id_qdtt])->andFilterWhere(['=', 'mst', $mst])->asArray()->all();
        return $sotdsht;
    }

    function actionBaoCaoMau7a()
    {
        $model = new ExportExcel();
        if ($model->load(Yii::$app->request->post())) {
            $start = DateTime::createFromFormat("d/m/Y", $model->start);
            $end = DateTime::createFromFormat("d/m/Y", $model->end);

            $start = $start->format('Y-m-d 00:00:00');
            $end = $end->format('Y-m-d 00:00:00');

            $queryData = Sotheodoisauhoanthue::find()
                ->joinWith('mst0')
                ->joinWith('soQdKt')
                ->joinWith('soQdThanhTra')
//                ->joinWith('soQdThuHoiHoan')
                ->joinWith('soQdXuPhat')
                ->joinWith('soVbHoanThue')
                ->joinWith('loaiHoanThue')
                ->where(['and', ['>=', 'ngayQdKiemTra', $start],
                    ['<=', 'ngayQdKiemTra', $end]
                ]);

//            if(!empty($model->truongDoan)) {
//                $queryData->andWhere(['like','truongdoankiemtra.truongDoan',trim($model->truongDoan)]);
//            }
            /** @var Baocaokiemtra[] $data */
            $data = $queryData->asArray()->all();

            /** @var Baocaokiemtra[] $dataProvider
             *
             */

//            var_dump($data);die;
            $dataProvider = [];

            for ($i = 0; $i < count($data); $i++) {
                $dataProvider[] = $data[$i];
            }

            ExportExcellBaoCaoMau7aHelper::exportExcel($dataProvider, $end);

        }
    }

    function actionBaoCaoMau8a()
    {
        $model = new ExportExcel();
        if ($model->load(Yii::$app->request->post())) {
            $start = DateTime::createFromFormat("d/m/Y", $model->start);
            $end = DateTime::createFromFormat("d/m/Y", $model->end);

            $start = $start->format('Y-m-d 00:00:00');
            $end = $end->format('Y-m-d 00:00:00');

            $queryData = Sotheodoisauhoanthue::find()
                ->joinWith('mst0')
                ->joinWith('soQdKt')
                ->joinWith('soQdThanhTra')
//                ->joinWith('soQdThuHoiHoan')
                ->joinWith('soQdXuPhat')
                ->joinWith('soVbHoanThue')
                ->joinWith('loaiHoanThue');
//                ->where(['and', ['>=', 'ngayQdKiemTra', $start],
//                    ['<=', 'ngayQdKiemTra', $end]
//                ]);


//            if(!empty($model->truongDoan)) {
//                $queryData->andWhere(['like','truongdoankiemtra.truongDoan',trim($model->truongDoan)]);
//            }
            /** @var Baocaokiemtra[] $data */
            $data = $queryData->asArray()->all();
//            var_dump($data);die;

            /** @var Baocaokiemtra[] $dataProvider
             *
             */

            $dataProvider = [];

            for ($i = 0; $i < count($data); $i++) {
                $dataProvider[] = $data[$i];
            }

            ExportExcelBaoCaoMau8AHelper::exportExcel($dataProvider, $start, $end);

        }
    }

    public function actionExportExcelBaoCaoKiemTraSauHoanMau8b()
    {
        $model = new ExportExcel();

        if ($model->load(Yii::$app->request->post())) {
            $start = DateTime::createFromFormat("d/m/Y", $model->start);
            $end = DateTime::createFromFormat("d/m/Y", $model->end);

            $start = $start->format('Y-m-d 00:00:00');
            $end = $end->format('Y-m-d 00:00:00');

            $data = Sotheodoisauhoanthue::find()
                ->joinWith('mst0')
                ->joinWith('soQdKt')
                ->joinWith('soQdThanhTra')
                ->joinWith('soQdKt.baocaokiemtras.soQdXuLy')
                ->joinWith('soQdThuHoiHoan')
                ->joinWith('lichsunopquyhoanthues')
                ->joinWith('soQdXuPhat')
                ->joinWith('loaiHoanThue')
//                ->where(['>', 'soQdXuPhatId', '0'])
//                ->where(['and', ['>=', 'sotheodoisauhoanthue.ngayTao', $start],
//                        ['<=', 'sotheodoisauhoanthue.ngayTao', $end]]
//                )
                ->asArray()->all();
//                var_dump($data);
//                die;

            $dataProvider = [];
            foreach ($data as $key => $value) {
                $value['lichSuNopKiTruocChuyenSang'] = Lichsunopquyhoanthue::find()->where(['<', 'thoiDiemNop', $start])->orderBy('thoiDiemNop DESC')->asArray()->one();
                $value['lichSuNopChuyenKiSau'] = Lichsunopquyhoanthue::find()->where(['>=', 'thoiDiemNop', $end])->orderBy('thoiDiemNop DESC')->asArray()->one();
                $value['lichSuNopQuyHoanThue'] = Lichsunopquyhoanthue::find()->asArray()->one();
                $dataProvider[] = $value;
            }
//            var_dump($dataProvider);die;
            $dataProvider = [];
//            for ($i = 0; $i < count($data); $i++) {
//                $dataProvider[] = $data[$i];
//            }
            ExportExcelBaoCaoMau8bHelper::exportExcel($dataProvider, $start, $end);
        }

    }

    public function actionBaoCaoMau7b()
    {
        $model = new ExportExcel();
        if ($model->load(Yii::$app->request->post())) {
            $start = DateTime::createFromFormat("d/m/Y", $model->start);
            $end = DateTime::createFromFormat("d/m/Y", $model->end);
            $start = $start->format('Y-m-d 00:00:00');
            $end = $end->format('Y-m-d 00:00:00');

            $queryData = Sotheodoisauhoanthue::find()
                ->joinWith('mst0')
                ->joinWith('soQdKt')
                ->joinWith('soQdThanhTra')
                ->joinWith('soQdThuHoiHoan')
                ->joinWith('soQdXuPhat')
                ->joinWith('soVbHoanThue')
                ->joinWith('loaiHoanThue')
                ->joinWith('lichsunopquyhoanthues')
                ->where(['and', ['>=', 'ngayQdKiemTra', $start],
                    ['<=', 'ngayQdKiemTra', $end]
                ]);

            /** @var Baocaokiemtra[] $data */
            $data = $queryData->asArray()->all();

            /** @var Baocaokiemtra[] $dataProvider
             *
             */
            $dataProvider = [];
            /* for ($i = 0; $i < count($data); $i++) {
                 $dataProvider[] = $data[$i];
             }*/
            foreach ($data as $key => $value) {
                $value['lichSuNopKiTruocChuyenSang'] = Lichsunopquyhoanthue::find()->where(['<', 'thoiDiemNop', $start])->orderBy('thoiDiemNop DESC')->asArray()->one();
                $value['lichSuNopChuyenKiSau'] = Lichsunopquyhoanthue::find()->where(['>=', 'thoiDiemNop', $end])->orderBy('thoiDiemNop DESC')->asArray()->one();
                $value['lichSuNopQuyHoanThue'] = Lichsunopquyhoanthue::find()->asArray()->one();
                $dataProvider[] = $value;
            }
            ExportExcelBaoCaoMau7bHelper::exportExcel($dataProvider, $start, $end);
        }
    }
}
