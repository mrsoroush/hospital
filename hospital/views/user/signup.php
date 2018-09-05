<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\jui\DatePicker;

$this->title = 'SignUp';
$this->params['breadcrumbs'][] = $this->title;

//var_dump($pass);

    $form = ActiveForm::begin();


   foreach($fields as $vals){
        if($vals->type == 'textbox'){
            if($vals->fieldname == 'password'){
                echo $form->field($modelpass, $vals->fieldname)
                ->passwordInput()
                ->hint($vals->hint)
                ->label($vals->label);
            } else {
                echo $form->field($model, $vals->fieldname)
                ->textInput()
                ->hint($vals->hint)
                ->label($vals->label);
            }  
        } elseif($vals->type == 'radio'){ 
             echo $form->field($model, $vals->fieldname)
             ->radioList(ArrayHelper::map($attrs, 'value', 'label'))
             ->label($vals->label);
            
        } elseif($vals->type == 'date'){
            echo $form->field($model, $vals->fieldname)->widget(\yii\jui\DatePicker::class, [
                'dateFormat' => 'yyyy-MM-dd',
            ]);
        }
    }
?>


<?= Html::submitButton('Signup', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>

<?php
    ActiveForm::end();    

?>




