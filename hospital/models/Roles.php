<?php
namespace app\models;

use Yii;
use yii\db\ActiveRecord;

class Roles extends ActiveRecord
{
    public static function tableName(){
        return '{{%Roles}}';
    }
    
    public function getUsers(){
        return $this->hasMany(Users::className(), ['id' => 'users_id'])->
            viaTable('users_roles', ['roles_id' => 'id']);
    }
}