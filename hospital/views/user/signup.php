<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\jui\DatePicker;
use yii\captcha\Captcha;

$this->title = 'SignUp';
$this->params['breadcrumbs'][] = $this->title;

//var_dump($pass);

    $form = ActiveForm::begin([
        'enableAjaxValidation' => true
    ]);


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
        } elseif($vals->type == 'captcha'){
            echo $form->field($modelcaptcha, $vals->fieldname)->widget(Captcha::className(), [
                'template' => '<div class="row"><div class="col-lg-3">{image}</div><div class="col-lg-6">{input}</div></div>',
                'imageOptions' => ['id' => 'signup-captcha'],
            ])
            ->label($vals->label);
?>
            <?= Html::img('/images/refresh1.png', ['id' => 'refresh-captcha', 'alt' => 'refresh-captcha']) ?>           
<?php
        }
    }
?>
<br>
<?= Html::submitButton('Signup', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
<?= Html::resetButton('Reset', ['class' => 'btn btn-primary', 'name' => 'reset-button']) ?>

<?php
    ActiveForm::end();
?>




