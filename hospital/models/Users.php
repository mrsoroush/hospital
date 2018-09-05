<?php
namespace app\models;

use Yii;
use yii\base\Model;
use app\components\Rules;
use yii\db\TableSchema;
use yii\db\ActiveRecord;


class Users extends ActiveRecord
{
    //@fields

    /**
     * [[
     * label: Username
     * type: string
     * length: 150
     * validate
     * required: true
     * min: 6
     * max: 150
     * ]]
    */
    //public $username;

    /**
     * [[
     * label: Email
     * type: string
     * length: 250
     * validate
     * required: true
     * email: true
     * ]]
    */
    //public $email;

    /**
     * [[
     * label: Mobile Phone
     * type: string
     * length: 20
     * validate
     * required: true
     * Regex: /^(\+\d{1,3}[- ]?)?\d{10}$/
     * ]]
    */
    //public $mobile;

    /**
     * [[
     * label: First Name
     * type: string
     * length: 75
     * validate
     * required: false
     * string
     * ]]
    */
    //public $firstname;

     /**
     * [[
     * label: Last Name
     * type: string
     * length: 150
     * validate
     * required: false
     * string
     * ]]
    */
    //public $lastname;

     /**
     * [[
     * label: Your Sexuality
     * type: integer
     * length: 1
     * validate
     * required: false
     * ]]
    */
    //public $sexuality;

     /**
     * [[
     * label: Birthday Date
     * type: datetime
     * validate
     * required: false
     * ]]
    */
    //public $birthday_date;

    //@end fields


    public static function tableName(){
        return '{{%Users}}';
    }

    //@relations

    public function getRoles(){
        return $this->hasMany(Roles::className(), ['id' => 'roles_id'])->
        viaTable('users_roles', ['users_id' => 'id']);
    }

    public function getContents(){
        return $this->hasMany(Contents::className(), ['auther' => 'id']);
    }

    public function getPasswods(){
        return $this->hasOne(Passwods::className(), ['users_id' => 'id']);
    }

    //@end relations

    public function rules(){
        $thisRule = new Rules();
        $cols = $thisRule->getCols(1);
        $rule = $thisRule->getRules(1);

        $result = array();

        for($i=0; $i<count($cols); $i++){
            array_push($result, [$cols[$i],$rule[$i]]);
        }

        return $result;
    }

    CONST SCENARIO_INSERT = 'insert';
    public function scenarios(){
        ///$scenarios = parrent::scenarios;
        $insRule = new Rules();
        $cols = $insRule->getAllcols(1);
        $scenarios[self::SCENARIO_INSERT] = $cols;
        return $scenarios;
    }


}