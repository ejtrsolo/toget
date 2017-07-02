<?php

namespace frontend\controllers;

use Yii;
use frontend\models\Profile;
use frontend\models\search\ProfileSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\UploadedFile;
use yii\filters\VerbFilter;

/**
 * PerfilesController implements the CRUD actions for Profile model.
 */
class PerfilesController extends Controller
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
     * Lists all Profile models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ProfileSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Profile model.
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
     * Creates a new Profile model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Profile();

        if ($model->load(Yii::$app->request->post())) {
            //Obtener Imagen
            
            $image = UploadedFile::getInstance($model, 'file');
                /* echo "<pre>";
                 var_dump($image);
                 exit();*/
            if($image){

                // store the source file name
                $partes = explode("." , $image->name);
                $ext = end($partes); //extension

                //$model->file = $image;

                // generate a unique file name
                $model->a02_photo = Yii::$app->security->generateRandomString().strtotime('now').".{$ext}";

                // the path to save file, you can set an uploadPath
                // in Yii::$app->params (as used in example below)
                $path = Yii::$app->params['path_user_photo_save'] . $model->a02_photo;
            }else{
                $model->a02_photo = 'default.png';
            }
            

            if($model->save()){
                if($image){
                    $image->saveAs($path);
                }
                return $this->redirect(['view', 'id' => $model->a02_id]);
            } else {
                // error in saving model
                Yii::$app->session->setFlash('error', 'Error al guardar la imagen. Intenta otra vez.');
                Yii::$app->session['jahgdjagshk'] = $model->getFirstErrors();

            }
        }
        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Profile model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
             $image = UploadedFile::getInstance($model, 'file');
                /* echo "<pre>";
                 var_dump($image);
                 exit();*/
            if($image){

                // store the source file name
                $partes = explode("." , $image->name);
                $ext = end($partes); //extension

                //$model->file = $image;

                // generate a unique file name
                $model->a02_photo = Yii::$app->security->generateRandomString().strtotime('now').".{$ext}";

                // the path to save file, you can set an uploadPath
                // in Yii::$app->params (as used in example below)
                $path = Yii::$app->params['path_user_photo_save'] . $model->a02_photo;
            }else{
                $model->a02_photo = 'default.png';
            }
            

            if($model->save()){
                if($image){
                    $image->saveAs($path);
                }
                return $this->redirect(['view', 'id' => $model->a02_id]);
            } else {
                // error in saving model
                Yii::$app->session->setFlash('error', 'Error al guardar la imagen. Intenta otra vez.');
                Yii::$app->session['jahgdjagshk'] = $model->getFirstErrors();

            }
            if($model->save()){
                return $this->redirect(['view', 'id' => $model->a02_id]);
            }
        }
        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Profile model.
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
     * Finds the Profile model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Profile the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Profile::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionGuardarAjax(){
        $model = new Profile();
        $respuesta = [
            'error'=>true,
            'mensaje'=>'Necesitas pasar los datos por post'
        ];
        if ($model->load(Yii::$app->request->post())) {
            $model->a02_photo = 'default.png';
            if($model->save()){
                $respuesta = [
                    'error'=>false,
                    'mensaje'=>'Registro guardado exitosamente'
                ];
            } else {
                // error in saving model
                $respuesta = [
                    'error'=>true,
                    'mensaje'=>'Error al guardar registro, intente otra vez'
                ];
                Yii::$app->session['jahgdjagshk'] = $model->getFirstErrors();

            }
        }

        echo json_encode($respuesta);
    }
}
