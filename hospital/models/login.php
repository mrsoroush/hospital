<?php
namespace app\models;

use Yii;
use app\components\Rules;
use yii\db\ActiveRecord;
use app\models\Users;


class Login extends ActiveRecord
{
    public $rememberMe = true;
    private $_user = false;

    public static function tableName(){
        return '{{%Users}}';
    }

    public function rules(){
        $thisRule = new Rules();
        $cols = $thisRule->getCols(2);
        $rule = $thisRule->getRules(2);
        $result = array();
        for($i=0; $i<count($cols); $i++){
            array_push($result, [$cols[$i],$rule[$i]]);
        }
        return $result;
    }

    public function getUsers($passUser){
        $users = array();
        $user = Users::find()->select('username')->where(['username' => $passUser])->all();
        foreach($user as $val){
            array_push($users, $val);
        }
        return $users;
    }

    public function getUser(){
        if ($this->_user === false) {
            $this->_user = Users::findByUsername($this->username);
        }
        return $this->_user;
    }

    public function login(){
       //if ($this->validate()) {
            return Yii::$app->user->login($this->getUser(), $this->rememberMe ? 3600*24*30 : 0);
    //}
        return false;
    }

    public function updateLastlogin($date, $username){
        Yii::$app->db->createCommand()
            ->update('{{users}}', ['[[last_login]]' => $date],
            ['[[username]]' => $username])
            ->execute();
        return true;
    }




}