<?php
namespace app\models;

use Yii;
use yii\db\ActiveRecord;

class Formattrs extends ActiveRecord
{
    
    public static function tableName(){
        return '{{%Formattrs}}';
    }

    public function getFormfields(){
        return $this->hasOne(Formfields::className(), ['id' => 'formfields_id']);
    }


}