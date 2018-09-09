<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;

$form = ActiveForm::begin();

foreach($fields as $val){
    if($val->fieldname == 'password'){
        echo $form->field($pass, $val->fieldname)
                ->passwordInput()
                ->label($val->label);
    } else {
        echo $form->field($logModel, $val->fieldname)
        ->textInput()
        ->label($val->label);
    } 
    
}

?>

<?= Html::submitButton('Login', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>

<?php ActiveForm::end(); ?>