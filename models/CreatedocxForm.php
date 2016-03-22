<?php

namespace app\models;

use yii\base\Model;

class CreatedocxForm extends Model
{
    public $name;
    public $email;
    public $FullName;
    public $MainLic;
    public $ArticleItem;
    public $Address;
    public $PassportData;
    public $Phone;
    public $arr_vars;


    public function rules()
    {
        return [
            [['FullName', 'email','MainLic','ArticleItem','Address','PassportData','Phone'], 'required'],
            ['email', 'email'],
            ];
        }

   
}