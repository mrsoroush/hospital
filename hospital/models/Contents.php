<?php
namespace app\models;

use Yii;
use yii\db\ActiveRecord;


class Contents extends ActiveRecord
{
    public static function tableName(){
        return '{{%contents}}';
        /*
        Access to real table name:
        $a = $connection->tablePrefix.str_replace(array('{{%','}}'),'',$model->tableName());
        */
    }

    public function getUnits(){
        return $this->hasOne(Units::className(), ['id' => 'unit_id']);
    }

    public function getUsers(){
        return $this->hasOne(Users::className(), ['id' => 'auther']);
    }
}