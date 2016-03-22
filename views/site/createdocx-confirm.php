<?php
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\CreatedocxForm */

?>
<p>Вы ввели следующую информацию:</p>

<ul>
   <li><label>Name</label>: <?= Html::encode($model->FullName) ?></li>
    <li><label>Email</label>: <?= Html::encode($model->email) ?></li>
    <li><label>Link to Docx</label>: <a href="/files/<?= Html::encode($model->name) ?><?=Html::encode($model->email)?>.docx" >Link</a></li> 

</ul>
