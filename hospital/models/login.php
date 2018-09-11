<?php
namespace app\models;

use Yii;
use app\components\Rules;
use yii\db\ActiveRecord;
use app\models\Users;


class Login extends ActiveRecord
{
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

    public function getUser($passUser){
        $users = array();
        $user = Users::find()->select('username')->where(['username' => $passUser])->all();
        foreach($user as $val){
            array_push($users, $val);
        }
        return $users;
    }



}