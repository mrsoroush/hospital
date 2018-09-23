<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\Login;
use app\models\Passwods;
use app\models\Forms;
use app\models\Users;
use app\components\Crud;

class AdministratorController extends Controller
{
    public $defaultAction = 'login';

    public function actionLogin(){
        $message = '';
        $role = array();
        $userLogModel = new Login;
        $passLogModel = new Passwods;
        $forms = Forms::find()->with('formfields')->all();
        $fields = $forms[1]->formfields;

        if($userLogModel->load(Yii::$app->request->post()) && $passLogModel->load(Yii::$app->request->post())){
    
                $hash = $passLogModel->getHash($userLogModel->username);
                $formPass = $_POST['Passwods']['password'];
                if($hash){
                    foreach($hash as $val){
                        if($val != NULL){
                            $pass = $passLogModel->validatePass($formPass, $val);
                                if ($pass){
                                    $userLogModel->login();
                                    $logDate = new Crud;
                                    $userLogModel->last_login = $logDate->getDate();
                                    $userLogModel->updateLastlogin($userLogModel->last_login, $userLogModel->username);
                                    $this->redirect(['home']);
                            } else {
                                $message = 'Username or password is wrong';
                            }
                        }
                    }
                } else {
                    $message = 'Username or password is wrong';
                }

            
        }

        return $this->render('login', [
            'fields' => $fields,
            'userLogModel' => $userLogModel,
            'passLogModel' => $passLogModel,
            'message' => $message,
        ]);
    }

    public function actionHome(){
        return $this->render('home');
    }
}