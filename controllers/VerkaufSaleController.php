<?php

namespace app\controllers;

use app\models\FzgBestand;
use Yii;
use app\models\VerkaufSale;
use app\models\VerkaufSaleSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * VerkaufSaleController implements the CRUD actions for VerkaufSale model.
 */
class VerkaufSaleController extends Controller
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
     * Lists all VerkaufSale models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new VerkaufSaleSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->pagination = ['pageSize' => 50];

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single VerkaufSale model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $path=Yii::getAlias('@app').'/web/images/verkaufSale/'.$id;
        $files=[];
        if(is_dir($path))
        {
         $files=scandir($path);
        }
        return $this->render('view', [
            'model' => $this->findModel($id),
            'path'=>$path,
            'files'=>$files
        ]);
    }

    /**
     * Creates a new VerkaufSale model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new VerkaufSale();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->verkaufsnummer_sale_id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing VerkaufSale model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            foreach ($_FILES["pictures"]["error"] as $key => $error) {
                if ($error == UPLOAD_ERR_OK) {
                    $tmp_name = $_FILES["pictures"]["tmp_name"][$key];
                    // basename() может спасти от атак на файловую систему;
                    // может понадобиться дополнительная проверка/очистка имени файла
                    $name = basename($_FILES["pictures"]["name"][$key]);
                    $path=Yii::getAlias('@app').'/web/images/verkaufSale/'.$id;
                    if(!file_exists($path)){
                        mkdir($path,0777,true);
                    }
                    $type=explode('.',$name);
                    move_uploaded_file($tmp_name, $path."/".rand().'.'.$type[1]);
                }
            }
            return $this->redirect(['view', 'id' => $model->verkaufsnummer_sale_id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing VerkaufSale model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();
        $model=FzgBestand::findOne($id);
        $model->vk_status=0;
        $model ->save();
        return $this->redirect(['index']);
    }

    public function actionDeleteFile($id,$name)
    {
        $path=Yii::getAlias('@app').'/web/images/verkaufSale/'.$id."/".$name;
        unlink($path);

        return $this->redirect(['view','id'=>$id]);
    }

    /**
     * Finds the VerkaufSale model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return VerkaufSale the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = VerkaufSale::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
