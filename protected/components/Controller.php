<?php
/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class Controller extends CController
{
    /**
     * @var string the default layout for the controller view. Defaults to '//layouts/column1',
     * meaning using a single column layout. See 'protected/views/layouts/column1.php'.
     */
    public $layout = '//layouts/main';
    /**
     * @var array context menu items. This property will be assigned to {@link CMenu::items}.
     */
    public $menu = array();
    /**
     * @var array the breadcrumbs of the current page. The value of this property will
     * be assigned to {@link CBreadcrumbs::links}. Please refer to {@link CBreadcrumbs::links}
     * for more details on how to specify this property.
     */
    public $breadcrumbs=array();

    protected function beforeAction($event) {
        if(!Yii::app()->user->isGuest) {
            $userId = Yii::app()->user->id;
            $userAdmin = User::model()->findByAttributes(array('username'=>Yii::app()->params['adminUser']));
            $auth = Yii::app()->authManager;

            if($userId == $userAdmin->id){
                $rol = $auth->getAuthItems(1, $userId);

                if(empty($rol)) {
                    $auth->assign('usr.manage', $userId);
                    $auth->save();
                }
            }
        }

        return true;
    }
}