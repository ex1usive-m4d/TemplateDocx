
<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoadtemplateForm */
/* @var $vars app\controllers\SiteController*/

use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>


<div class="col-lg-5">
    <ul>
        <tr>
            <td>
                <?php $form = ActiveForm::begin();

                foreach ($model->attributesVars() as $key => $value)
                {
                    echo '<b>'.$key.'</b>';
                    echo $form->field($model, 'vars[' . $key . ']')->textInput()->label(false);
                } 
                echo $form->field($model,'pathTemplate')->hiddenInput()->label(false);
               
                ?>

                <br>
            </td>
        </tr>
            <div class="form-group">
                <?= Html::submitButton('Отправить', ['class' => 'btn btn-primary','model'=>'$model']) ?>
            </div>
        <?php ActiveForm::end(); ?>
    </ul>
</div> 
