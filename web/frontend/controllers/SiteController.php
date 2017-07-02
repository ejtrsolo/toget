<?php
namespace frontend\controllers;

use common\models\AuthSocial;
use common\models\Profile;
use common\models\User;
use common\models\Utils;
use Yii;
use yii\authclient\ClientInterface;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;
use yii\web\Response;
use yii\web\UploadedFile;

/**
 * Site controller
 */
class SiteController extends Controller
{
    private $attributes = [];
    private $username;
    private $source;
    private $socialUser;
    /**
     * @inheritdoc
     */
    public function behaviors()
    {

        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['login', 'error', 'request-password-reset', 'request-password'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['logout', 'index'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
            'auth' => [
                'class' => 'yii\authclient\AuthAction',
                'successCallback' => [$this, 'onAuthSuccess'],
            ],
        ];
    }

    /**
     * This function will be triggered when user is successfuly authenticated using some oAuth client.
     *
     * @param ClientInterface $client
     * @return boolean|Response
     */

    public function onAuthSuccess($client)
    {
        $this->attributes = $client->getUserAttributes();
        $this->source = $client->getId();
        $this->formatProviderResponse($this->source);
        /////debug stuff
        //$attributes['email'] = null;
        //var_dump($attributes);
        //die();

        // if provider didn't supply email
        if (!isset($this->attributes['email'])){
            return Yii::$app->getSession()->setFlash('error', [
                Yii::t('app', "Unable to finish, {client} did not provide us with an email.
                        Please check your settings on {client}.", ['client' => $client->getTitle()]),
            ]);
        }

        $auth = $this->findExistingAuth();

        if (Yii::$app->user->isGuest) {
            if ($auth) { // login
                $this->socialUser = $auth->user;
                $user = $auth->user;
                $viaSocial = true;
                //Yii::$app->user->login($user);
                $this->actionLogin($viaSocial);
            } else { // signup
                $viaSocial = true;
                $this->actionSignup($viaSocial);
            }
        } else { // user already logged in
            if (!$auth && $this->attributes['email'] == Yii::$app->user->identity->email) { // add auth provider
                $auth = $this->createAuth(Yii::$app->user);
                $auth->save();
                Yii::$app->getSession()->setFlash('success', [
                    Yii::t('app', "Your {client} account is successfully synced.",
                        ['client' => $client->getTitle()]),
                ]);
            } else { //emails don't match
                if($this->attributes['email'] != Yii::$app->user->identity->email){
                    Yii::$app->getSession()->setFlash('error', [
                        Yii::t('app', "Your {client} account could not be synced.", ['client' => $client->getTitle()]),
                    ]);
                } else {  // account was already synced
                    Yii::$app->getSession()->setFlash('success', [
                        Yii::t('app', "Your {client} account is already synced.", ['client' => $client->getTitle()]),
                    ]);
                }
            }
        }
    }

    private function createUser()
    {
        $password = Yii::$app->security->generateRandomString(6);
        $user = new User([
            'username' => $this->attributes[$this->username],
            'email' => $this->attributes['email'],
            'password' => $password,
        ]);
        $user->generateAuthKey();
        return $user;
    }

    private function createAuth($user)
    {
        $auth = new AuthSocial([
            'user_id' => $user->id,
            'source' => $this->source,
            'source_id' => (string)$this->attributes['id'],
        ]);
        return $auth;
    }

    private function findExistingAuth()
    {
        $auth = AuthSocial::find()->where([
            'source' => $this->source,
            'source_id' => $this->attributes['id'],
        ])->one();
        return $auth;
    }

    private function formatProviderResponse($source){
        //set $username to correct $attribute from each provider
        switch ($source){
            case 'facebook':
                $this->username = 'name';
                break;
            case 'google':
                $this->username = 'displayName';
                $emails = $this->attributes['emails'];
                foreach ($emails as $email){
                    foreach ($email as $k => $v) {
                        if ($k == 'value'){
                            $this->attributes['email'] = $v;
                        }
                    }
                }
                break;
            default:
                $this->username = 'name';
        }
    }

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * Logs in a user.
     *
     * @param bool $viaSocial
     * @return mixed
     */
    public function actionLogin($viaSocial = false)
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        if($viaSocial){
            Yii::$app->user->login($this->socialUser);
        } else {
            $model = new LoginForm();
            if ($model->load(Yii::$app->request->post()) && $model->login()) {

                return $this->goBack();
            } else {
                return $this->render('login', [
                    'model' => $model,
                ]);
            }
        }
    }

    /**
     * Logs out the current user.
     *
     * @return mixed
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return mixed
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail(Yii::$app->params['adminEmail'])) {
                Yii::$app->session->setFlash('success', 'Thank you for contacting us. We will respond to you as soon as possible.');
            } else {
                Yii::$app->session->setFlash('error', 'There was an error sending email.');
            }

            return $this->refresh();
        } else {
            return $this->render('contact', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Displays about page.
     *
     * @return mixed
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    /**
     * Signs user up.
     *
     * @param bool $viaSocial
     * @return mixed
     */
    public function actionSignup($viaSocial = false)
    {
        if ($viaSocial){
            if (isset($this->attributes['email']) && User::find()->where(['email' => $this->attributes['email']])->exists()) {
                return Yii::$app->getSession()->setFlash('error', [
                    Yii::t('app', "User with the same email as in {client} account already exists but isn't synced.
                        Login with username and password and click the {client} sync link to sync accounts.",
                        ['client' =>  $this->source]),
                ]);
            } else {
                $user = $this->createUser();
                $transaction = $user->getDb()->beginTransaction();
                if ($user->save()) {
                    $names = explode(' ',$this->attributes[$this->username]);
                    $profile = new Profile();
                    $profile->a01_id = $user->id;
                    $profile->a02_name = $names[0];
                    $profile->a02_flastname = ' ';
                    $profile->a02_slastname = ' ';
                    $profile->a02_photo = 'default.png';
                    $profile->a02_active = 1;
                    $profile->save(false);

                    $auth = $this->createAuth($user);

                    if ($auth->save()) {
                        $transaction->commit();
                        Yii::$app->user->login($user);
                        //MailCall::onMailableAction('signup', 'site');
                    } else {
                        return Yii::$app->getSession()->setFlash('error', [
                            Yii::t('app', "We were unable to complete the process and sync {client}.",
                                ['client' => $this->source]),
                        ]);
                    }
                } else {
                    return Yii::$app->getSession()->setFlash('error', [
                        Yii::t('app', "We were unable to complete the process and sync {client}.",
                            ['client' =>  $this->source]),
                    ]);
                }
            }
        }else {
            $model = new SignupForm();
            $modelprofile = new Profile();
            if ($model->load(Yii::$app->request->post())) {
                if ($modelprofile->load(Yii::$app->request->post())) {
                    $imageName = md5($model->username);
                    //return;
                    $modelprofile->file = UploadedFile::getInstance($modelprofile, 'file');
                    $imageName = Utils::validateChain($imageName);
                    $imageName = preg_replace('/\s+/', '', $imageName);
                    $fileName = Yii::$app->params['path_user_photo_save'] . $imageName . '.' . $modelprofile->file->extension;
                    $fileName = preg_replace('/\s+/', '', $fileName);
                    $modelprofile->a02_photo = $imageName . '.' . $modelprofile->file->extension;
                    if ($user = $model->signup()) {
                        $modelprofile->a01_id = $user->id;
                        if (!$modelprofile->save()) {
                            return $this->render('signup', [
                                'model' => $model,
                                'modelprofile' => $modelprofile
                            ]);
                        }
                        $modelprofile->file->saveAs($fileName);

                        ///CAMBIAR PARA QUE CONFIRME EL CORREO
                        if (Yii::$app->getUser()->login($user)) {
                            return $this->goHome();
                        }
                    } else {
                        Yii::$app->session->setFlash('error-signup', 'Faltan campos por llenar');
                    }
                }
            }

            return $this->render('signup', [
                'model' => $model,
                'modelprofile' => $modelprofile
            ]);
        }
    }

    /**
     * Requests password reset.
     *
     * @return mixed
     */
    public function actionRequestPasswordReset()
    {
        $this->layout = 'main-login';
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Revise su correo electrónico para obtener más instrucciones.');

                return $this->goHome();
            } else {
                Yii::$app->session->setFlash('error', 'Lo sentimos, no somos capaces de restablecer la contraseña de correo proporcionado.');
            }
        }

        return $this->render('requestPasswordResetToken', [
            'model' => $model,
        ]);
    }

    /**
     * Resets password.
     *
     * @param string $token
     * @return mixed
     * @throws BadRequestHttpException
     */
    public function actionResetPassword($token)
    {
        $this->layout = 'main-login';
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidParamException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->session->setFlash('success', 'Su nueva contraseña a sido guardada.');

            return $this->goHome();
        }

        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }
}
