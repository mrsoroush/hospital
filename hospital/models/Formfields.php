<?php
namespace app\models;

use Yii;
use yii\db\ActiveRecord;

class Formfields extends ActiveRecord
{
    
    public static function tableName(){
        return '{{%Formfields}}';
    }

    public function getForms(){
        return $this->hasOne(Forms::className(), ['id' => 'forms_id']);
    }

    public function getFormattrs(){
        return $this->hasMany(Formattrs::className(), ['formfields_id' => 'id']);
    }


}