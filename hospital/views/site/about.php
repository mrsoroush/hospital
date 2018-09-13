<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use app\components\Rules;
use yii\helpers\ArrayHelper;


$this->title = 'About';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-about">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        This is the About page. You may modify the following file to customize its content:
    </p>

    <code><?= __FILE__ ?></code>
</div>

<?php

echo  $a . '<hr>';

$v = new Rules();
$t = $v->getRules(1);
$s = $v->getCols(1);

foreach($t as $ff) echo $ff . '<br>';
echo '<hr>';
foreach($s as $gg) echo $gg . '<br>';
echo '<hr>';
var_dump($t);
echo '<hr>';
var_dump($s);
echo '<hr>';

foreach($s as $val){
    foreach($t as $vals){
        echo '['. $val. ','. $vals . ']';
    }
}
echo '<hr>';
for($i=0;$i<=count($s)-1;$i++){
    echo '['. $s[$i]. ','. $t[$i] . ']';
}
?>
