<?php

class FrontModule extends CWebModule {

    public function init() {
        $this->defaultController = 'index';
        $this->setImport(array(
            'front.models.*',
            'front.components.*',
        ));
        Yii::app()->setComponents(array(
            'user' => array(
                // enable cookie-based authentication
                'allowAutoLogin' => true,
                'stateKeyPrefix' => 'front',
                'loginUrl' => array('/front/login'),
            )
        ));
    }

    public function beforeControllerAction($controller, $action) {
        $controller->layout = 'application.modules.front.views.layouts.main';
        $extraActions = array('login');
        if (!in_array(strtolower($controller->id), $extraActions) && Yii::app()->user->isGuest) {
            Yii::app()->user->loginRequired();
        }
        if (parent::beforeControllerAction($controller, $action)) {
            // this method is called before any module controller action is performed
            // you may place customized code here
            return true;
        } else
            return false;
    }

}
