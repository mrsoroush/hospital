<?php
namespace app\models;

use Yii;
use yii\db\ActiveRecord;

class Passwods extends ActiveRecord
{
    //public $password;

    public static function tableName(){
        return '{{%passwods}}';
    }

    public function getUsers(){
        return $this->hasOne(Users::className(), ['id' => 'users_id']);
    }

    public function rules(){
        return [
            ['password', 'required']
        ];
    }

    CONST SCENARIO_INSERT = 'insert';
    public function scenarios(){
        $scenarios[self::SCENARIO_INSERT] = ['password'];
        return $scenarios;
    }

    public function getHash($getPass){
        $re = array();
        $hash = Yii::$app->getSecurity()->generatePasswordHash($getPass);
        $hashes = Passwods::find()->select('password')->where(['password' => $getPass])->all();
        foreach($hashes as $val){
            array_push($re, $val);
        }
        return $re;
    }
}