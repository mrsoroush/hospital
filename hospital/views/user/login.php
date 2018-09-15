<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;

 $form = ActiveForm::begin([
    'id' => 'login-form',
    'layout' => 'horizontal',
    'fieldConfig' => [
        'template' => "{label}\n<div class=\"col-lg-3\">{input}</div>\n<div class=\"col-lg-8\">{error}</div>",
        'labelOptions' => ['class' => 'col-lg-1 control-label'],
    ],
]);

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

<?= $form->field($logModel, 'rememberMe')->checkbox([
            'template' => "<div class=\"col-lg-offset-1 col-lg-3\">{input} {label}</div>\n<div class=\"col-lg-8\">{error}</div>",
]) ?>

<?= Html::submitButton('Login', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>

<?php ActiveForm::end(); ?>

<?php if($message != NULL){ ?>
    <div class='alertMessage'>
        <?php echo $message; ?>
    </div>
<?php } ?>

