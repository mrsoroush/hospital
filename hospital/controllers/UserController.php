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

        $model->scenario = Users::SCENARIO_INSERT;
        $modelpass->scenario = Passwods::SCENARIO_INSERT;
        if($model->load(Yii::$app->request->post()) && $modelpass->load(Yii::$app->request->post())){
            $crud = new Crud();
            $hash = $crud->hashingPass($modelpass->password);
            $modelpass->password = $hash;
            $isValid = $model->validate();
            $isValid = $modelpass->validate() && $isValid;
            if($isValid){
                $crud->Insertdata($model);
                $crud->Insertdata($modelpass);
            }
            Yii::$app->session->setFlash ( 'success', 'Model has been saved' );
            $this->redirect(['success']);
            //echo $hash;
        }
        
        
        return $this->render('signup', [
            'fields' => $fields,
            'model' => $model,
            'modelpass' => $modelpass,
            'attrs' => $attrs,
            ]);
    }

    public function actionSuccess(){
        return $this->render('success');
    }

    public function actionWelcome(){
        return $this->render('welcome');
    }

    public function actionLogin(){
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
                            echo "Password is wrong.";
                        }
                    }
                }
            } else {
                echo "Username or password is wrong";
            }
        }
        return $this->render('login',[
            'fields' => $fields,
            'logModel' => $logModel,
            'pass' => $logPassModel,
        ]);
    }
}