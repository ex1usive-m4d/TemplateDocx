<?php

namespace app\controllers;


use Yii;
use yii\base\DynamicModel;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\CreatedocxForm;
use app\models\LoadtemplateForm;
use yii\web\UploadedFile;


class SiteController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionLogin()
    {
        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    public function actionAbout()
    {
        return $this->render('about');
    }

     public function actionSay($message = 'Привет')
    {
        return $this->render('say', ['message' => $message]);
    }



    public function actionCreatedocx()
    {
        $model = new CreatedocxForm();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            // данные в $model удачно проверены

            // делаем что-то полезн$name = $model->name;

            $email        = $model -> email;
            $Phone        = $model -> Phone;
            $MainLic      = $model -> MainLic;
            $Address      = $model -> Address;
            $FullName     = $model -> FullName;
            $ArticleItem  = $model -> ArticleItem;
            $PassportData = $model -> PassportData;
            //$arr_vars     = $model -> arr_vars;
    //foreach($model->arr_vars as $key=>$var)



            require_once 'PhpWord/Autoloader.php';
            \PhpOffice\PhpWord\Autoloader::register();
            $phpWord = new \PhpOffice\PhpWord\PhpWord();
            //$template = $phpWord->loadTemplate(realpath('files/License_1_author_Template.docx'));
            $template = $phpWord->loadTemplate(realpath('files/License_1_author_Template.docx'));
            $anketaFileName = str_replace(" ", "", $email) . '.docx';
            $anketaFile = 'files/' . $anketaFileName;
            $template->setValue('date', date('d.m.Y(№H-i-s)'));
            $template->setValue('email', $email);
            $template->setValue('Phone', $Phone);
            $template->setValue('Address', $Address);
            $template->setValue('MainLic', $MainLic);
            $template->setValue('FullName', $FullName);
            $template->setValue('ArticleItem', $ArticleItem);
            $template->setValue('PassportData', $PassportData);
           // foreach($model as $key=>$value)
           // {$template->setValue($key, $value);}
            $template->saveAs($anketaFile);


            //Yii::$app->response->sendFile($anketaFile);
            return $this->render('createdocx-confirm', ['model' => $model]);

        } else {
            
            // либо страница отображается первый раз, либо есть ошибка в данных
            return $this->render('createdocx', ['model' => $model]);
        }
    }



    public function actionLoadtemplate()
    {   
        $model = new LoadtemplateForm();
        $model->arrayPathTemplatesFiles=scandir(realpath('files/templates/'));
        require_once 'PhpWord/Autoloader.php';
        \PhpOffice\PhpWord\Autoloader::register();
        $phpWord = new \PhpOffice\PhpWord\PhpWord();
        if (Yii::$app->request->post())
        {
            $model->docx = UploadedFile::getInstance($model, 'docx');
            $key=Yii::$app->request->post('LoadtemplateForm');

         if (!empty($key['keyTemplate']))
            { $id=$key['keyTemplate'];
                $pathTemplate = 'files/templates/' . $model->arrayPathTemplatesFiles[$id];
                $template = $phpWord->loadTemplate($pathTemplate);
                $vars = $template->getVariables();
                $model->pathTemplate=$pathTemplate;
                foreach ($vars as $value) {$model->vars[$value]="";}
                return $this->render('loadtemplateInputData', ['model' => $model]);
            }

            if ($model->uploadDocx())
            {//file upload succefully
                $pathTemplate = 'files/templates/' . $model->docx->getBaseName().'.docx';
                $template = $phpWord->loadTemplate($pathTemplate);
                $vars = $template->getVariables();
                $model->pathTemplate=$pathTemplate;
                foreach ($vars as $value) {$model->vars[$value]="";}
                return $this->render('loadtemplateInputData', ['model' => $model]);
               
            }
              $model = Yii::$app->request->post('LoadtemplateForm');
              $id=Yii::$app->request->post('_csrf');
                $pathTemplate=$model['pathTemplate'];
            $template = $phpWord->loadTemplate(realpath($pathTemplate));
            $anketaFileName = str_replace(" ", "", $id) . '.docx';
            $anketaFile = 'files/' . $anketaFileName;
            foreach($model['vars'] as $key=>$value) 
                $template->setValue($key, $value);
            $template->saveAs($anketaFile);
            $model['pathAnketaFile']=$anketaFile;
            return $this->render('loadtemplate-confirm',['model'=>$model]);

        }
        else {return $this->render('loadtemplate',['model'=>$model]);}
    }
    public function actionDownload()
    { $path=Yii::$app->request->get('path');
        if(file_exists($path)){
            Yii::$app->response->sendFile($path);
            return unlink($path);
        }
    }
}
