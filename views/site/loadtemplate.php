
<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoadtemplateForm */

use yii\helpers\Html;
use yii\widgets\ActiveForm;

foreach($model->arrayPathTemplatesFiles as $key=>$var){$arrayPath[]=$var;};
?>

<div class="col-lg-5" >

    <?php $form = ActiveForm::begin(['options'=>['enctype'=>'multipart/form-data']]); ?>

  <left>Загрузите свой шаблон <?= $form->field($model, 'docx')->fileInput() ?></left>
    <div class="form-group">

     <?= Html::submitButton('Отправить', ['class' => 'btn btn-primary']) ?>
    <?php ActiveForm::end(); ?>
</div>
    Или Выбирете из имеющихся
    <?php $form = ActiveForm::begin();?>
    <right><?= $form->field($model,'keyTemplate')->dropDownList($arrayPath,['keyTemplate'=>$arrayPath]);?></right>
    <div class="form-group">

        <?= Html::submitButton('Отправить', ['class' => 'btn btn-primary']) ?>
        <?php ActiveForm::end(); ?>
    </div>




</div>

