
<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoadtemplateForm */

use yii\helpers\Html;
use yii\widgets\ActiveForm;

foreach($model->arrayPathTemplatesFiles as $key=>$var){$arrayPath[]=$var;};
?>
<div id="body"><center>
<div id="left_col">
<div class="col-lg-5" >

    <?php $form = ActiveForm::begin(['options'=>['enctype'=>'multipart/form-data']]); ?>

  <left> <?= $form->field($model, 'docx')->fileInput()->label('Загрузите свой шаблон') ?></left>
    <div class="form-group">

     <?= Html::submitButton('Отправить', ['class' => 'btn btn-primary']) ?>
    <?php ActiveForm::end(); ?>
</div></div>
</div>

<div id="content">  <div class="col-lg-5">
        <?php $form = ActiveForm::begin();?>
        <?= $form->field($model,'keyTemplate')->dropDownList($arrayPath,['keyTemplate'=>$arrayPath])->label('Или Выберите из имеющихся');?>
        <div class="form-group">
            <?= Html::submitButton('Отправить', ['class' => 'btn btn-primary']) ?>
            <?php ActiveForm::end(); ?>
        </div>
  </div>
</div></center>
</div>




