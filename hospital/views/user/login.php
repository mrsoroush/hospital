<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'About';
$this->params['breadcrumbs'][] = $this->title;

$form = ActiveForm::begin();

foreach($fields as $val){
    if($val->fieldname == 'username'){
        echo $form->field($logModel, $val->fieldname)
        ->textInput()
        ->label($val->label);
    } elseif($val->fieldname == 'password'){
        echo $form->field($logPassModel, $val->fieldname)
        ->passwordInput()
        ->label($val->label);
    }
}

?>

<?= Html::submitButton('Signup', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>

<? ActiveForm::end(); ?>