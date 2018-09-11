<?php
namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use app\components\Crud;

class Passwods extends ActiveRecord
{
    //public $password;

    public static function tableName(){
        return '{{%Passwods}}';
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
        //$ids = array();
        $userId = Users::find()->select('id')->where(['username' => $getPass])->all();
        foreach($userId as $val){
                $ids = $val;
        }
        $hashes = Passwods::find()->select('password')->where(['id' => $ids])->all();
        foreach($hashes as $val){
            array_push($re, $val);
        }
        return $re[0];
    }

    public function beforeSave($insert){
        if (parent::beforeSave($insert)) {
            if ($this->isNewRecord) {
                $crud = new Crud();
                $this->create_on = $crud->getDate();
            }
            return true;
        }
        return false;
    }
}