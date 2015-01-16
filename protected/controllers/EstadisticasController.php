<?php

class EstadisticasController extends Controller
{
    protected function beforeAction($action)
    {
        Yii::app()
            ->clientScript
            ->registerPackage("d3");
        return parent::beforeAction($action);
    }
	public function actionGastosactividades()
	{
		$this->render('gastosactividades');
	}

	public function actionInfraestructura()
	{
		$this->render('infraestructura');
	}

	public function actionProblematicas()
	{
		$this->render('problematicas');
	}

	public function actionProductostecnologicos()
	{
		$this->render('productostecnologicos');
	}

	public function actionProyectosinvestigacion()
	{
		$this->render('proyectosinvestigacion');
	}

	public function actionRecursoshumanos()
	{
		$this->render('recursoshumanos');
	}

	// Uncomment the following methods and override them if needed
	/*
	public function filters()
	{
		// return the filter configuration for this controller, e.g.:
		return array(
			'inlineFilterName',
			array(
				'class'=>'path.to.FilterClass',
				'propertyName'=>'propertyValue',
			),
		);
	}

	public function actions()
	{
		// return external action classes, e.g.:
		return array(
			'action1'=>'path.to.ActionClass',
			'action2'=>array(
				'class'=>'path.to.AnotherActionClass',
				'propertyName'=>'propertyValue',
			),
		);
	}
	*/
}
