<?php

class ChargeModule extends CWebModule {

    public function init() {
        // this method is called when the module is being created
        // you may place code here to customize the module or the application
        // import the module-level models and components
        $this->defaultController = 'index';
        $this->setImport(array(
            'charge.models.*',
            'charge.components.*',
        ));
        Yii::app()->setComponents(array(
            'user' => array(
                // enable cookie-based authentication
                'allowAutoLogin' => true,
                'stateKeyPrefix' => 'charge',
                'loginUrl' => array('/charge/login'),
            )
        ));
    }

    public function beforeControllerAction($controller, $action) {
        $controller->layout = 'application.modules.charge.views.layouts.main';
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
