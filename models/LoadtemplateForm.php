<?php
/**
 * Created by PhpStorm.
 * User: ivan.bolshakov
 * Date: 02.03.16
 * Time: 11:41
 */

namespace app\models;


use yii\base\Model;
use yii\web\UploadedFile;

class LoadtemplateForm extends Model
{
    /**
     * @var UploadedFile
     */
    public $docx;
    public $vars = [];
    public $paramsV;
    public $pathTemplate;
    public $pathAnketaFile;
    public $arrayPathTemplatesFiles;
    public $keyTemplate;
    public function rules()
    {
        return [
            [['docx'], 'file', 'skipOnEmpty' => false, 'extensions' => 'docx'],
            ['vars', 'validateParams'],

        ];
    }

    public function uploadDocx()
    {
        if ($this->validate()) {
            $pathTemplate='files/templates/' . $this->docx->baseName . '.' . $this->docx->extension;
            $this->docx->saveAs($pathTemplate);
            return true;
        } else false;
    }

    public function setVars(array $var)
    {
        $vars=$var;
    }
    public function attributesVars()
    {
        return $this->vars;
    }
   /** 
    * @return string 
    **/
    public function getPathTemplate()
    {
        return $this->pathTemplate;
    }
    
    public function validateParams()
    {
        foreach ($this->vars as $key => $value)
            if (empty($value)){
                //Устанавливаем ошибку на тот инпут, который не прошел валидацию
                $this->addError('vars[' . $key . ']', 'Необходимо заполнить поле');
                return false;}
            else return true;
    }

    
    public function downloadDocx()
    {
        return $pathAnketaFile;
    }
  

}