<?php

namespace app\controllers;

use Yii;
use app\models\MitarbeiterEmployee;
use app\models\MitarbeiterEmployeeSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * MitarbeiterEmployeeController implements the CRUD actions for MitarbeiterEmployee model.
 */
class MitarbeiterEmployeeController extends Controller
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
     * Lists all MitarbeiterEmployee models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new MitarbeiterEmployeeSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->pagination = ['pageSize' => 50];

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single MitarbeiterEmployee model.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $path=Yii::getAlias("@app")."/web/images/mitarbeiterEmployee/".$id;
        $files=[];
        if(is_dir($path)){
            $files=scandir($path);
        }
        return $this->render('view', [
            'model' => $this->findModel($id),
            'path' =>$path,
            'files'=>$files
        ]);
    }

    /**
     * Creates a new MitarbeiterEmployee model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new MitarbeiterEmployee();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->initialen_initials]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing MitarbeiterEmployee model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            //var_dump($_FILES["pictures"]["error"]);
            foreach ($_FILES["pictures"]["error"] as $key => $error) {
                if ($error == UPLOAD_ERR_OK) {
                    $tmp_name = $_FILES["pictures"]["tmp_name"][$key];
                    // basename() может спасти от атак на файловую систему;
                    // может понадобиться дополнительная проверка/очистка имени файла
                    $name = basename($_FILES["pictures"]["name"][$key]);
                    $path=Yii::getAlias("@app")."/web/images/mitarbeiterEmployee/".$id;
                    //$path=Yii::getAlias("@app")."/web/images/".(new MitarbeiterEmployee())::tableName()."/".$id;
                    //var_dump($path);Exit;
                    if(!file_exists($path))
                    {
                        mkdir($path,0777,true);
                    }
                    $type=explode('.',$name);
                    move_uploaded_file($tmp_name, $path."/".rand().'.'.$type[1]);
                }
            }
            return $this->redirect(['view', 'id' => $model->initialen_initials]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing MitarbeiterEmployee model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
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
        $path=Yii::getAlias("@app")."/web/images/mitarbeiterEmployee/".$id."/".$name;
        unlink($path);

        return $this->redirect(['view', 'id'=>$id ]);
    }
    /**
     * Finds the MitarbeiterEmployee model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return MitarbeiterEmployee the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = MitarbeiterEmployee::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
