<?php
namespace app\models;

use Yii;
use yii\base\Model;
use app\components\Rules;
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
}