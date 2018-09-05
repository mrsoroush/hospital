<?php
namespace app\models;

use Yii;
use yii\db\ActiveRecord;

class Forms extends ActiveRecord
{
    
    public static function tableName(){
        return '{{%Forms}}';
    }

    public function getFormfields(){
        return $this->hasMany(Formfields::className(), ['forms_id' => 'id']);
    }

    
}