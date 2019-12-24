<?php

namespace app\controllers;

use Yii;
use app\models\FzgBestand;
use app\models\FzgBestandSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * FzgBestandController implements the CRUD actions for FzgBestand model.
 */
class FzgBestandController extends Controller
{
    /**
     * {@inheritdoc}
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
     * Lists all FzgBestand models.
     * @return mixed
     */
    public function actionIndex()
    {

        $searchModel = new FzgBestandSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->pagination = ['pageSize' => 50];

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single FzgBestand model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $path=Yii::getAlias('@app').'/web/images/fzgBestand/'.$id;
        $files=[];
        if(is_dir($path))
        {
            $files=scandir($path);
        }
        return $this->render('view', [
            'model' => $this->findModel($id),
            'files'=>$files
        ]);
    }

    /**
     * Creates a new FzgBestand model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new FzgBestand();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing FzgBestand model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        //var_dump(Yii::getAlias('@app').'/web/images'); exit;
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            foreach ($_FILES["pictures"]["error"] as $key => $error) {
                if ($error == UPLOAD_ERR_OK) {
                    $tmp_name = $_FILES["pictures"]["tmp_name"][$key];
                    // basename() может спасти от атак на файловую систему;
                    // может понадобиться дополнительная проверка/очистка имени файла
                    $name = basename($_FILES["pictures"]["name"][$key]);
                    $path=Yii::getAlias('@app').'/web/images/fzgBestand/'.$id;
                    if(!file_exists($path)){
                        mkdir($path,0777,true);
                    }
                    $type=explode('.',$name);
                    move_uploaded_file($tmp_name, $path."/".rand().'.'.$type[1]);
                }
            }
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing FzgBestand model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }
    public function actionDeleteFile($id,$name)
    {
        $path=Yii::getAlias('@app').'/web/images/fzgBestand/'.$id."/".$name;
        unlink($path);
        return $this->redirect(['view', 'id' => $id]);
    }
    public function actionSumGewinn($gewinn)
    {
        $sum=array_sum([$gewinn]);

        return $sum;
    }
    /*public function actionTest()
    {
        $model=new FzgBestand();
        $model->nr='1111';
        $model->ek_datum='2015-01-01';
        $model->modell='ZAZ969';
        $model->verkaeufer='Barski & Barski';
        $model->fin='a0001';
        $model->ek_netto_preis=10000;
        $model->ek_mwst=100;
        $model->ek_brutto_preis=11000;
        $model->vk_datum='2011-12-12';
        $model->kaeufer='Michael Schuemacher';
        $model->vk_netto_preis=12000;
        $model->vk_mwst=2000;
        $model->vk_brutto_preis=14000;
        $model->gewinn=13000;
        $model->sonstiges='There is not an Information in this column';
        //var_dump($model->save());
        //var_dump($model->getErrors());Exit();
        $model->save();
    }*/

    /**
     * Finds the FzgBestand model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return FzgBestand the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = FzgBestand::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
