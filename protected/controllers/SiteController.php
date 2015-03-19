<?php

class SiteController extends Controller
{
    public function filters()
    {
        return array(
            'accessControl',
        );
    }

    public function accessRules()
    {
        return array(
            array('allow', 'actions'=>array('index'), 'users'=>array('*')),
            array('allow', 'actions'=>array('admin'), 'users'=>array('@')),
            array('deny', 'users'=>array('*')),
        );
    }

    public function actionIndex()
    {
        $this->redirect(Yii::app()->createUrl('estadisticas/index'));
    }

    public function actionAdmin()
    {
        Yii::app()->getModule('usr');
        $model = new ProfileForm;
        $model->userIdentityClass = 'UserIdentity';
        $model->setAttributes($model->getIdentity()->getAttributes());
        $encuestas = Encuesta::getEncuestasActivas();

        // renders the view file 'protected/views/site/index.php'
        // using the default layout 'protected/views/layouts/main.php'
        $this->render('admin', array(
            'model'=>$model,
            'encuestas' => $encuestas,
        ));
    }
}
