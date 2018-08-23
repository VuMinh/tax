<?php

namespace app\controllers;

use app\helpers\ExportExcelBaoCaoTaiCoQuanThueHelper;
use app\models\DateValidation;
use app\models\ExportExcel;
use app\models\Ketquakttaitrusonnt;
use app\models\Nguoinopthue;
use Yii;
use app\models\Ketquakiemtrataicoquanthue;
use app\models\KetquakiemtrataicoquanthueSearch;
use yii\db\Query;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Response;
use DateTime;

/**
 * KetQuaKiemTraTaiCoQuanThueController implements the CRUD actions for Ketquakiemtrataicoquanthue model.
 */
class KetQuaKiemTraTaiCoQuanThueController extends BaseController
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
     * Lists all Ketquakiemtrataicoquanthue models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new KetquakiemtrataicoquanthueSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Ketquakiemtrataicoquanthue model.
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
     * Creates a new Ketquakiemtrataicoquanthue model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Ketquakiemtrataicoquanthue();
        $nguoinopthue = new Nguoinopthue();
        $datevalidation = new DateValidation();

        if ($model->load(Yii::$app->request->post())) {
            $nguoinopthue->load(Yii::$app->request->post());
            $datevalidation->load(Yii::$app->request->post());

            $model->nguoiNopThueId = $nguoinopthue->maSoThue;

            $model->ngayTao = date('Y-m-d H:m:s',time()+3600*7);
            $model->ngayCapNhat = date('Y-m-d H:m:s',time()+3600*7);
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
     * Updates an existing Ketquakiemtrataicoquanthue model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        $nguoinopthue = Nguoinopthue::findOne($model->nguoiNopThueId);
        $datevalidation = new DateValidation();

        if ($model->load(Yii::$app->request->post())) {
            $nguoinopthue->load(Yii::$app->request->post());
            $datevalidation->load(Yii::$app->request->post());

            $model->nguoiNopThueId = $nguoinopthue->id;

            $model->ngayCapNhat = date('Y-m-d H:m:s',time()+3600*7);
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

    public function actionExportExcelBaoCaoTaiCoQuanThue(){

        $model = new ExportExcel();

        if ($model->load(Yii::$app->request->post())) {

            $start = DateTime::createFromFormat("d/m/Y", $model->start);
            $end = DateTime::createFromFormat("d/m/Y", $model->end);

            $start = $start->format('Y-m-d 00:00:00');
            $end = $end->format('Y-m-d 00:00:00');

            $dataProvider = Ketquakiemtrataicoquanthue::find()
                ->joinWith('nguoiNopThue')
                ->where(['and',['>=','ngayTao',$start],
                    ['<=','ngayTao',$end]])
                ->asArray()->all();

            ExportExcelBaoCaoTaiCoQuanThueHelper::exportExcel($dataProvider, $model->end);
        }
    }

    /**
     * Deletes an existing Ketquakiemtrataicoquanthue model.
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
     * Finds the Ketquakiemtrataicoquanthue model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Ketquakiemtrataicoquanthue the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Ketquakiemtrataicoquanthue::findOne($id)) !== null) {
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
}
