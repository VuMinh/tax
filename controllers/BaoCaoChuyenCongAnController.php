<?php

namespace app\controllers;

use app\helpers\DateTimeHelpers;
use app\models\ExportExcel;
use app\models\Nguoinopthue;
use app\models\DateValidation;
use Yii;
use app\models\Baocaochuyencongan;
use app\models\BaocaochuyenconganSearch;
use yii\db\Query;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Response;
use app\helpers\ExportExcelBaoCaoChuyenCongAnHelper;

/**
 * BaocaochuyenconganController implements the CRUD actions for Baocaochuyencongan model.
 */
class BaoCaoChuyenCongAnController extends BaseController
{
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
     * Lists all Baocaochuyencongan models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new BaocaochuyenconganSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Baocaochuyencongan model.
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
     * Creates a new Baocaochuyencongan model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Baocaochuyencongan();
        $nguoinopthue = new Nguoinopthue();
        $datevalidation = new DateValidation();
        if ($model->load(Yii::$app->request->post())) {
            $nguoinopthue->load(Yii::$app->request->post());
            $datevalidation->load(Yii::$app->request->post());

            if ($datevalidation->ngayBaoCao) {
                $model->ngayBaoCao = DateTimeHelpers::convertDatetime($datevalidation->ngayBaoCao);
            } else {
                $model->ngayBaoCao = date('Y-m-d H:m:s', time() + 3600 * 7);
            }

            $model->ngayKetLuan = DateTimeHelpers::convertDatetime($datevalidation->ngayKetLuan);

            $model->mst = $nguoinopthue->maSoThue;
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

    /**
     * Updates an existing Baocaochuyencongan model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $nguoinopthue = Nguoinopthue::findOne($model->mst);
        $datevalidation = new DateValidation();
        $datevalidation->ngayBaoCao = DateTimeHelpers::convertDate($model->ngayBaoCao);
        $datevalidation->ngayKetLuan = DateTimeHelpers::convertDate($model->ngayKetLuan);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $nguoinopthue->load(Yii::$app->request->post());
            $datevalidation->load(Yii::$app->request->post());

            if ($datevalidation->ngayBaoCao) {
                $model->ngayBaoCao = DateTimeHelpers::convertDatetime($datevalidation->ngayBaoCao);
            } else {
                $model->ngayBaoCao = date('Y-m-d H:m:s', time() + 3600 * 7);
            }

            $model->ngayCapNhat = date('Y-m-d H:m:s', time() + 3600 * 7);

            $model->ngayKetLuan = DateTimeHelpers::convertDatetime($datevalidation->ngayKetLuan);

            $model->mst = $nguoinopthue->id;
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
     * Deletes an existing Baocaochuyencongan model.
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
     * Finds the Baocaochuyencongan model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Baocaochuyencongan the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Baocaochuyencongan::findOne($id)) !== null) {
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

    public function actionExportExcelBaoCaoChuyenCongAn()
    {

        $model = new ExportExcel();

        if ($model->load(Yii::$app->request->post())) {

            $start = \DateTime::createFromFormat("d/m/Y", $model->start);
            $end = \DateTime::createFromFormat("d/m/Y", $model->end);

            $start = $start->format('Y-m-d 00:00:00');
            $end = $end->format('Y-m-d 00:00:00');

            $dataProvider = Baocaochuyencongan::find()
                ->joinWith('mst0')
                ->where(['and', ['>=', 'ngayKetLuan', $start],
                    ['<=', 'ngayKetLuan', $end]])
                ->asArray()->all();

            ExportExcelBaoCaoChuyenCongAnHelper::exportExcel($dataProvider, $model->end);
        }
    }
}
