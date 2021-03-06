<?php
namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\db\ActiveRecord;
use yii\filters\AccessControl;
use app\models\Forms;
use app\models\Formfields;
use app\models\Formattrs;
use app\components\Crud;
use \app\models\Users;
use \app\models\passwods;
use \app\models\Login;
use \app\models\Captchas;
use yii\web\Response;
use yii\widgets\ActiveForm;


class UserController extends Controller
{
    public function behaviors(){
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['login', 'logout', 'signup'],
                'rules' => [
                    [
                    'actions' => ['signup', 'login'],
                    'allow' => true,
                    'roles' => ['?']
                ],
                [
                    'actions' => ['logout'],
                    'allow' => true,
                    'roles' => ['@']
                ]
                ]
            ]
        ];
    }

    


    public function actionSignup(){
        $model = new Users;
        $modelpass = new Passwods;
        $modelcaptcha = new Captchas;
        /*$forms = Forms::find()->with(['formfields' => function($query){
            $query->select('id, forms_id, fieldname, type, label, rules, hint');
        }])->all();*/
        $forms = Forms::find()->with('formfields')->all();
        $fields = $forms[0]->formfields;

        foreach($fields as $val){
            if($val->type == 'radio'){
                $attrs = Formattrs::find()->where(['formfields_id' => $val->id])->all();
            }
        }

        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())){
            Yii::$app->response->format = Response::FORMAT_JSON;
            return $isVali = ActiveForm::validate($model);
            $model->save(false);
            $modelpass->save(false);
        }

        $model->scenario = Users::SCENARIO_INSERT;
        $modelpass->scenario = Passwods::SCENARIO_INSERT;
        if($modelpass->load(Yii::$app->request->post()) && $model->load(Yii::$app->request->post())){
            $crud = new Crud();
            $hash = $crud->hashingPass($modelpass->password);
            $modelpass->password = $hash;
            $isValid = $model->validate();
            $isValid = $modelpass->validate() && $isValid;
            if($isValid){
                $crud->Insertdata($model);
                $crud->Insertdata($modelpass);
                Yii::$app->session->setFlash ( 'success', 'Model has been saved' );
                $this->redirect(['success']);
            } else {
                echo "Something wrong ...";
            } 
        }
        
        
        return $this->render('signup', [
            'fields' => $fields,
            'model' => $model,
            'modelpass' => $modelpass,
            'attrs' => $attrs,
            'modelcaptcha' => $modelcaptcha,
            ]);
    }

    public function actionSuccess(){
        return $this->render('success');
    }

    public function actionWelcome(){
        return $this->render('welcome');
    }

    public function actionLogin(){
        $message = '';
        if(!\Yii::$app->user->isGuest){
            return $this->goHome();
        }
        $logModel = new Login;
        $logPassModel = new Passwods;
        $forms = Forms::find()->with('formfields')->all();
        $fields = $forms[1]->formfields;
        if($logModel->load(Yii::$app->request->post()) && $logPassModel->load(Yii::$app->request->post())){
            $hash = $logPassModel->getHash($logModel->username);
            $formPass = $_POST['Passwods']['password'];
            if($hash){
                foreach($hash as $val){
                    if($val != NULL){
                        $pass = $logPassModel->validatePass($formPass, $val);
                            if ($pass){
                                $logModel->login();
                                $logDate = new Crud;
                                $logModel->last_login = $logDate->getDate();
                                $logModel->updateLastlogin($logModel->last_login, $logModel->username);
                                $this->redirect(['welcome']);
                        } else {
                            $message = 'Username or password is wrong';
                        }
                    }
                }
            } else {
                $message = 'Username or password is wrong';
            }
        }

            return $this->render('login',[
                'fields' => $fields,
                'logModel' => $logModel,
                'pass' => $logPassModel,
                'message' => $message,
            ]);
    }
}