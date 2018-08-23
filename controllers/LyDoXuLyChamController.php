<?php

namespace app\controllers;

use app\models\Baocaokiemtra;
use app\models\Nguoinopthue;
use app\models\Quyetdinhxuly;
use Yii;
use app\models\Lydoxulycham;
use app\models\LydoxulychamSearch;
use yii\filters\AccessControl;
use yii\helpers\Url;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * LyDoXuLyChamController implements the CRUD actions for Lydoxulycham model.
 */
class LyDoXuLyChamController extends Controller
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
                'only'=> ['create','update','delete','index','view'],
                'rules'=>[
                    [
                        'actions'=>['create','update','delete','index','view'],
                        'allow' => true,
                        'roles'=> ['@'],
                    ]
                ],
            ],
        ];
    }

    /**
     * Lists all Lydoxulycham models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new LydoxulychamSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Lydoxulycham model.
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
     * Creates a new Lydoxulycham model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $soQdktId = Yii::$app->getRequest()->getQueryParam('soQdktId');
        $lydoXLCham = Lydoxulycham::find()->where(['=','soQdktId',$soQdktId])->asArray()->one()['id'];
        $bckt = Baocaokiemtra::find()->with('mst0')->with('soQdkt')->where(['=','id',$soQdktId])->asArray()->one();

        $model = new Lydoxulycham();

        if ($model->load(Yii::$app->request->post())) {

            $model->mst = Nguoinopthue::find()->where(['=','maSoThue',$model->mst])->asArray()->one()['id'];
            $model->soQdktId = $soQdktId;

            $model->save();
            return $this->redirect(Url::to(['bao-cao-kiem-tra/danh-sach-quyet-dinh-tren-30-ngay']));
        } else {
            if (!empty($lydoXLCham)){

                $model = $this->findModel($lydoXLCham);
                return $this->render('update', [
                    'model' => $model,
                    'bckt' => $bckt
                ]);
            }
            else {
                return $this->render('create', [
                    'model' => $model,
                    'bckt' => $bckt
                ]);
            }
        }
    }

    /**
     * Updates an existing Lydoxulycham model.
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
     * Deletes an existing Lydoxulycham model.
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
     * Finds the Lydoxulycham model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Lydoxulycham the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Lydoxulycham::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
