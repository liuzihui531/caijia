<?php
/**
 * @author Administrator
 */
class LoginController extends FrontBaseController{
    public function actionIndex(){
        $this->renderPartial("index");
    }
    public function actionLogin(){
        $username = Yii::app()->request->getParam("username",'');
        $password = Yii::app()->request->getParam("password",'');
        $model = new LoginForm('login');
        $model->username = $username;
        $model->password = $password;
        $validate = $model->validate();
        $login = $model->login();
        if ($validate && $login) {
            $userData = array(
                'username' => $username,
                'password' => $password,
            );      
            $this->setLoginCookie($userData);
            $this->handleResult(1,'登录成功',$this->createUrl('/front'));
        }else{
            $this->handleResult(0,  Utils::getFirstError($model->errors));
        }
    }
    
    /**
     * 注销
     */
    public function actionLogout() {
        Yii::app()->user->logout();
        $this->redirect($this->createUrl('/admin/login'));
    }
}
