<?php
/**
 * Created by PhpStorm.
 * User: ivan.bolshakov
 * Date: 01.03.16
 * Time: 18:03
 */

namespace app\models;

use yii\base\Model;

class CreatetemplatedocxForm extends Model
{

$arr_vars = array();


    public function rules()
    {
        return [
            [['arr_vars'], 'required'],
            ['email', 'email'],
        ];
    }


}