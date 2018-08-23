<?php

namespace app\controllers;


use app\helpers\DateTimeHelpers;
use app\helpers\ExportExcelBaoCaoNoKiemTraHelper;
use app\helpers\ExportExcelBaoCaoNoThanhTraHelper;
use app\models\ExportExcel;
use app\models\DateValidation;
use app\models\Lichsunopsaukiemtra;
use app\models\Lichsunopthanhtra;
use app\models\Nguoinopthue;
use app\models\Quyetdinhthanhtra;
use app\models\Quyetdinhtruythu;
use DateTime;
use yii\db\Query;
use Yii;
use app\models\Baocaothanhtra;
use app\models\BaocaothanhtraSearch;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Response;

/**
 * BaoCaoThanhTraController implements the CRUD actions for Baocaothanhtra model.
 */
class BaoCaoThanhTraController extends Controller
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
     * Lists all Baocaothanhtra models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new BaocaothanhtraSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->pagination->pageSize = 20;
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Baocaothanhtra model.
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
     * Creates a new Baocaothanhtra model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Baocaothanhtra();

        $quyetdinhtruythu = new Quyetdinhtruythu();
        $nguoinopthue = new Nguoinopthue();
        $quyetdinhttra = new Quyetdinhthanhtra();
        $lichsunopthanhtra = new Lichsunopthanhtra();
        $datevalidation = new DateValidation();

        if ($model->load(Yii::$app->request->post())) {
            $nguoinopthue->load(Yii::$app->request->post());
            $quyetdinhtruythu->load(Yii::$app->request->post());
            $quyetdinhttra->load(Yii::$app->request->post());
            $lichsunopthanhtra->load(Yii::$app->request->post());
            $datevalidation->load(Yii::$app->request->post());

            $quyetdinhttra->ngayQdThanhTra = $this->convertDatetime($datevalidation->ngayQdThanhTra);
            $quyetdinhttra->save();

            if ($quyetdinhtruythu->soQdTruyThu) {
                $quyetdinhtruythu->ngayQdTruyThu = $this->convertDatetime($datevalidation->ngayQdTruyThu);
                $quyetdinhtruythu->save();

                $model->soQdTruyThuId = $quyetdinhtruythu->id;
            }


            $model->soQdThanhTraId = $quyetdinhttra->id;
            $model->mst = $nguoinopthue->maSoThue;
            $model->ngayTao = date("Y-m-d H:i:s", time() + 3600 * 7);
            $model->save();

            $lichsunopthanhtra_save = new Lichsunopthanhtra();

            $lichsunopthanhtra_save->soQdThanhTra = $model->id;
            $lichsunopthanhtra_save->daNopThue = $lichsunopthanhtra->daNopThue;
            $lichsunopthanhtra_save->ngayNop = date("Y-m-d H:i:s", time() + 3600 * 7);
            $lichsunopthanhtra_save->save();

            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'quyetdinhtruythu' => $quyetdinhtruythu,
                'nguoinopthue' => $nguoinopthue,
                'quyetdinhttra' => $quyetdinhttra,
                'lichsunopthanhtra' => $lichsunopthanhtra,
                'datevalidation' => $datevalidation,
            ]);
        }
    }

    /**
     * Updates an existing Baocaothanhtra model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        $nguoinopthue = Nguoinopthue::findOne($model->mst);
        $quyetdinhttra = Quyetdinhthanhtra::findOne($model->soQdThanhTraId);

        $datevalidation = new DateValidation();
        $datevalidation->ngayQdThanhTra = $this->convertDate($quyetdinhttra->ngayQdThanhTra);

        $quyetdinhtruythu = new Quyetdinhtruythu();
        if ($model->soQdTruyThuId) {
            $quyetdinhtruythu = Quyetdinhtruythu::findOne($model->soQdTruyThuId);
            $datevalidation->ngayQdTruyThu = $this->convertDate($quyetdinhtruythu->ngayQdTruyThu);
        }

        $lichsunopthanhtra = Lichsunopthanhtra::find()
            ->andFilterWhere(['=', 'soQdThanhTra', $model->id])
            ->orderBy('ngayNop DESC')
            ->one();


        if ($model->load(Yii::$app->request->post())) {

            $nguoinopthue->load(Yii::$app->request->post());
            $quyetdinhtruythu->load(Yii::$app->request->post());
            $quyetdinhttra->load(Yii::$app->request->post());
            $lichsunopthanhtra->load(Yii::$app->request->post());
            $datevalidation->load(Yii::$app->request->post());

            $quyetdinhttra->ngayQdThanhTra = $this->convertDatetime($datevalidation->ngayQdThanhTra);
            $quyetdinhttra->save();

            $quyetdinhtruythu->ngayQdTruyThu = $this->convertDatetime($datevalidation->ngayQdTruyThu);
            $quyetdinhtruythu->save();

            $model->soQdThanhTraId = $quyetdinhttra->id;
            $model->soQdTruyThuId = $quyetdinhtruythu->id;
            $model->mst = $nguoinopthue->id;
            if (!$model->ngayTao){
                $model->ngayTao = date("Y-m-d H:i:s", time() + 3600 * 7);
            }
            $model->save();

            $lichsunopthanhtra_save = new Lichsunopthanhtra();

            $lichsunopthanhtra_save->soQdThanhTra = $model->id;
            $lichsunopthanhtra_save->daNopThue = $lichsunopthanhtra->daNopThue;
            $lichsunopthanhtra_save->ngayNop = date("Y-m-d H:i:s", time() + 3600 * 7);
            $lichsunopthanhtra_save->save();

            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'quyetdinhtruythu' => $quyetdinhtruythu,
                'nguoinopthue' => $nguoinopthue,
                'quyetdinhttra' => $quyetdinhttra,
                'lichsunopthanhtra' => $lichsunopthanhtra,
                'datevalidation' => $datevalidation,
            ]);
        }
    }

    /**
     * Deletes an existing Baocaothanhtra model.
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
     * Finds the Baocaothanhtra model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Baocaothanhtra the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Baocaothanhtra::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
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

    function actionGetQuyetDinhThanhTra($q = null, $id = null)
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $data = [];
        $bcthanhtra = Baocaothanhtra::find()->innerJoinWith('soQdThanhTra')->where(['=', 'mst', $q])->asArray()->all();
        foreach ($bcthanhtra as $value => $item) {
            $data [] = [
                'id' => $item['soQdThanhTra']['id'],
                'text' => $item['soQdThanhTra']['soQdThanhTra'],
            ];
        }
        return $data;
    }

    function actionGetQuyetDinhTruyThu($q = null, $id = null)
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $data = [];
        $bcthanhtra = Baocaothanhtra::find()->innerJoinWith('soQdTruyThu')->where(['=', 'mst', $q])->asArray()->all();
        foreach ($bcthanhtra as $value => $item) {
            $data [] = [
                'id' => $item['soQdTruyThu']['id'],
                'text' => $item['soQdTruyThu']['soQdTruyThu'],
            ];
        }
        return $data;
    }

    function actionSearchQuyetDinhThanhTra($so_qdthanhtra = null)
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $so_qdthanhtra = Quyetdinhthanhtra::find()->where(['=', 'soQdThanhTra', $so_qdthanhtra])->asArray()->all();
        return $so_qdthanhtra;
    }

    function actionSearchQuyetDinhTruyThu($so_qdtruythu = null)
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $so_qdtruythu = Quyetdinhtruythu::find()->where(['=', 'soQdTruyThu', $so_qdtruythu])->asArray()->all();
        return $so_qdtruythu;
    }

    function actionGetBaoCaoThanhTra($mst = null, $id_qdtt = null)
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $bcthanhtra = Baocaothanhtra::find()->andFilterWhere(['=', 'soQdThanhTraId', $id_qdtt])->andFilterWhere(['=', 'mst', $mst])->asArray()->all();
        return $bcthanhtra;
    }

    public function actionExportExcelBaoCaoNoThanhTra()
    {
        $model = new ExportExcel();

        if ($model->load(Yii::$app->request->post())) {
            $date = DateTime::createFromFormat("d/m/Y", $model->start);
            $date->modify('-89 day');
            $date = $date->format('Y-m-d 00:00:00');

            $dataProvider = Baocaothanhtra::find()
                ->innerJoinWith('mst0')
                ->innerJoinWith('soQdThanhTra')
                ->innerJoinWith('lichsunopthanhtras')
                ->innerJoinWith('soQdTruyThu')
                ->asArray()->all();

            for ($i = 0; $i < count($dataProvider); $i++) {
                $dataProvider[$i]['lichsunopthanhtra'] = Lichsunopthanhtra::find()
                    ->orderBy(['ngayNop' => SORT_DESC])
                    ->andFilterWhere(['<=', 'ngayNop', $date])
                    ->andFilterWhere(['=', 'id', $dataProvider[$i]['soQdThanhTraId']])
                    ->asArray()
                    ->one();
            }
            ExportExcelBaoCaoNoThanhTraHelper::exportExcel($dataProvider, $date);
        }
    }
}
