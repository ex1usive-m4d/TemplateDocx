
<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoadtemplateForm */

use yii\helpers\Html;
use yii\widgets\ActiveForm;


?>

<div class="col-lg-5" >

    <?php $form = ActiveForm::begin(['options'=>['enctype'=>'multipart/form-data']]); ?>

   <left>Загрузите свой шаблон <?= $form->field($model, 'docx')->fileInput() ?></left>
    Или Выбирете из имеющихся
    <right><?=$form->field($model,'docx')->dropDownList(['docx'=>['model','template']]);?></right>
   
    <div class="form-group">
        <?= Html::submitButton('Отправить', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

