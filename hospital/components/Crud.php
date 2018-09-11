<?php

namespace app\components;

use Yii;
use yii\db\ActiveRecord;
use app\models\Roles;

class Crud extends ActiveRecord
{
    /*public function __construct($mod){
        $this->mod = $mod;
    }*/

    public function Insertdata($mod){
        $mod->save();
    }

    public function getDate(){
        return date("Y-m-d H:i:s");
    }

    public function isDefault(){
        $ref = array();
        $role = Roles::find()->select('id')->where(['is_default' => 1])->one();
        foreach($role as $val)
            array_push($ref, $val);
        return $ref;
    }

    public function hashingPass($entryPass){
        $hash = Yii::$app->getSecurity()->generatePasswordHash($entryPass);
        return $hash;
    }

}