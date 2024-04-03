<?php

namespace app\controllers;

use app\components\BaseController;
use app\components\ExcelWriter;
use Yii;
use app\models\Insurance;
use app\models\search\SearchInsurance;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * InsuranceController implements the CRUD actions for Insurance model.
 */
class InsuranceController extends BaseController
{
    const PERMISSION_UPDATE_ALL = 'BasicInsuranceUpdateAll';
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
     * Lists all Insurance models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new SearchInsurance();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Insurance model.
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
     * Creates a new Insurance model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Insurance();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Insurance model.
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
     * Deletes an existing Insurance model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    public function actionExcel()
    {
      $excel = new ExcelWriter(Yii::$app->security->generateRandomString(8) . '.xls');
      $excel->writeLine(["User","Name","Body","Date start","Date end"]);
      $models = (new SearchInsurance())->search([])->getModels();
      foreach($models as $model){
        $excel->writeLine([
          $model->userName,
          $model->name,
          $model->description,
          $model->create_at,
          $model->max_at,
        ]);
      }
      $excel->close();
	  
    }

    /**
     * Finds the Insurance model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Insurance the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if(Yii::$app->user->can(self::PERMISSION_UPDATE_ALL)){
            $model = Insurance::findOne($id);
        } else {
            $model = Insurance::findOne(['id' => $id, 'user_id' => Yii::$app->user->id]);
        }
        if ($model !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
