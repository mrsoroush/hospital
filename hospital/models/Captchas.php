<?php
namespace app\models;

use Yii;
use yii\base\Model;

class Captchas extends Model{

    public $verifyCode;
    
    public function rules(){
        return [
            ['verifyCode' , 'captcha'], 
        ];
    }
}