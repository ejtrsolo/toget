<?php

namespace backend\controllers;

use common\models\FromFileUpload;
use frontend\models\FormChangePassword;
use frontend\models\FormStateCountry;
use common\models\User;
use Yii;
use common\models\Profile;
use common\models\search\ProfileSearch;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * ProfileController implements the CRUD actions for Profile model.
 */
class ProfileController extends Controller
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
    public function actionView($id=null)
    {
        if(!$id){
            /** @var Profile $model */
            $model=Profile::findOne(['a01_id'=>Yii::$app->user->id]);
            $modelsc = new FormStateCountry();
            $modelcp = new FormChangePassword();
            $form_file_upload = new FromFileUpload();
            $form_file_upload->id=$model->a02_id;

            $country = $model->country;
            $modelsc->country = $country ? $country->c02_name : 'Desconocido';
            $state = $model->state;
            $modelsc->state = $state ? $state->c03_name : 'Desconocido';
            $modeluser = $model->user;
            $modelcp->id = $modeluser->id;

            return $this->render('myprofile', [
                'model' => $model,
                'modelsc' => $modelsc,
                'modeluser' => $modeluser,
                'modelcp' => $modelcp,
                'form_file_upload'=>$form_file_upload
            ]);
        }
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
            if($model->save()){
                return $this->redirect(['view', 'id' => $model->a02_id]);
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

    public function actionSaveProfile($id){
        $model = $this->findModel($id);
        $modeluser = $model->user;
        $modelsc = new FormStateCountry();
        $error = false;
        $message = ' ';
        if($model->load(Yii::$app->request->post()) && $modeluser->load(Yii::$app->request->post()) && $modelsc->load(Yii::$app->request->post())){

        }
        $respuesta = [
            'error'=>$error,
            'message'=>$message,
            'profile'=>$model->attributes,
            'state_country'=>$modelsc->attributes,
            'user'=>$modeluser->attributes,
        ];
        echo json_encode($respuesta);
    }
    public function actionSavePassword(){
        $model = new FormChangePassword();
        $respuesta = ['error'=>true, 'message'=>'Usuario no encontrado'];
        if($model->load(Yii::$app->request->post())){
            $error = false;
            $message = ' ';
            if(!$model->validatePassword()){
                $message = 'La contraseña actual es incorrecta';
                $error = true;
            }else{
                /** @var User $modeluser */
                $modeluser = User::findIdentity($model->id);
                $modeluser->setPassword($model->new_password);
                if(!$modeluser->save()){
                    $message = 'Error al guardar contraseña. Intente otra vez.';
                    $error = true;
                }
            }
            $respuesta = [
                'error'=>$error,
                'message'=>$message,
            ];
        }
        echo json_encode($respuesta);
    }
    public function actionChangeImage($id){
        $model = new FromFileUpload();
        if ($model->load(Yii::$app->request->post())) {
            /** @var Profile $profile */
            $profile = Profile::findOne($id);
            // get the uploaded file instance. for multiple file uploads
            // the following data will return an array
            $image = UploadedFile::getInstance($model, 'file');
            /* echo "<pre>";
             var_dump($image);
             exit();*/

            // store the source file name
            $partes = explode("." , $image->name);
            $ext = end($partes);
            $profile->file = $ext;

            // generate a unique file name
            $profile->a02_photo = Yii::$app->security->generateRandomString().".{$ext}";

            // the path to save file, you can set an uploadPath
            // in Yii::$app->params (as used in example below)
            $path = Yii::$app->params['path_user_photo_save'] . $profile->a02_photo;

            if($profile->save()){
                $image->saveAs($path);
                return $this->redirect(['view']);
            } else {
                // error in saving model
                Yii::$app->session->setFlash('error', 'Error al guardar la imagen. Intenta otra vez.');
                return $this->redirect(['view']);
            }
        }

    }
}
