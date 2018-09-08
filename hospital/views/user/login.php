<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;

$forms = ActiveForm::begin();

foreach($fields as $val){
    if($val->fieldname == 'username'){
        echo $forms->field($logModel, $val->fieldname)
        ->textInput()
        ->label($val->label);
    } elseif($val->fieldname == 'password'){
        echo $forms->field($logPassModel, $val->fieldname)
        ->passwordInput()
        ->label($val->label);
    }
}

?>

<?= Html::submitButton('Login', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>

<?php ActiveForm::end(); ?>