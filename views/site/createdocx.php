
<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\CreatedocxForm */

use yii\helpers\Html;
use yii\widgets\ActiveForm;


?>

    <div class="col-lg-5">

        <?php $form = ActiveForm::begin(); ?>
        <?= $form->field($model, 'email') ?>
        <?= $form->field($model, 'FullName') ?>
        <?= $form->field($model, 'Phone') ?>
        <?= $form->field($model, 'MainLic') ?>
        <?= $form->field($model, 'ArticleItem') ?>
        <?= $form->field($model, 'Address') ?>
        <?= $form->field($model, 'PassportData') ?>



        <div class="form-group">
            <?= Html::submitButton('Отправить', ['class' => 'btn btn-primary']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>
       

   