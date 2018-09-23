<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Administration Login';
$this->params['breadcrumbs'][] = $this->title;

$form = ActiveForm::begin();

foreach($fields as $val){
    if($val->fieldname == 'password'){
        echo $form->field($passLogModel, $val->fieldname)
            ->passwordInput()
            ->label($val->label);
    } else {
        echo $form->field($userLogModel , $val->fieldname)
            ->textInput()
            ->label($val->label);
    }
}
?>

<?= Html::submitButton('Login', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>

<?php

ActiveForm::end();
 if($message != NULL){ ?>
    <div class='alertMessage'>
        <?php echo $message; ?>
    </div>
<?php } ?>

