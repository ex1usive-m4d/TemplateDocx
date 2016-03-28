
<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoadtemplateForm */
/* @var $vars app\controllers\SiteController*/

use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>

<p>Вы ввели следующую информацию</p>
<div class="col-lg-5">
    <ul>
        <tr>
            <td><?php $array=$model['vars']; foreach ($array as $key=>$var)
                {echo '<b>'.$key.'</b> '.$var.'<br>';}
                ?>
                <br>
                <?= Html::a('Скачать', ['site/download','path'=>$model['pathAnketaFile']], ['class' => 'btn btn-success'])?>
            </td>
        </tr>

    </ul>
</div> 
