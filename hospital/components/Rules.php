<?php
namespace app\components;

use yii\db\ActiveRecord;
use \app\models\Formfields;

class Rules extends ActiveRecord
{
    public function getRules($forms_id){
        $part = array();
        $rules = Formfields::find()->select('rules')->where(['forms_id' => $forms_id])->all();
        foreach($rules as $gh){
            foreach($gh as $r){
                if($r !== NULL){
                    array_push($part, $r);
                }
            }
        }
        return $part;
    }

    public function getCols($forms_id){
        $parts = array();
        $colName = Formfields::find()->select('fieldname')->Where(['not', ['rules' => NULL]])
        ->andWhere(['forms_id' => $forms_id])->all();

        foreach($colName as $fh){
            foreach($fh as $n){
                if($n !== NULL){
                array_push($parts, $n);
                }
            }
        }
        return $parts;
    }

    public function getAllcols($forms_id){
        $col = array();
        $colNames = Formfields::find()->select('fieldname')->where(['forms_id' => $forms_id])->all();
        foreach($colNames as $fh){
            foreach($fh as $n){
                if(($n !== 'password') && ($n !== NULL)){             
                array_push($col, $n);
                }
            }
        }
        return $col;
    }
}
