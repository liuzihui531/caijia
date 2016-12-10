<?php
/**
 * Description of FrontBaseController
 *
 * @author Administrator
 */
class FrontBaseController extends Controller{
    protected $loginCookieKey = 'userLogin';
    protected $authcodeKey = '79cd99a5aa97d17d4c29191815b5a89811';
    public function init() {
        parent::init();
        $userData = $this->getLoginCookie();
        if($userData){
            $this->setLoginCookie($userData);
        }
        if(!Yii::app()->user->id && $userData){            
            $model = new LoginForm('login');
            $model->username = $userData['username'];
            $model->password = $userData['password'];
            $validate = $model->validate();
            $login = $model->login();
        }
    }
    
    protected function setLoginCookie($userData){
        $userJson = json_encode($userData);
        $userStr = Utils::authcode($userJson, 'ENCODE', $this->authcodeKey);
        $cookie = new CHttpCookie($this->loginCookieKey,$userStr);
        $cookie->expire = time()+3600*24*30;  //有限期30天
        Yii::app()->request->cookies[$this->loginCookieKey]=$cookie;
    }
    protected function getLoginCookie(){
        $cookie = Yii::app()->request->getCookies();
        $userStr = $cookie[$this->loginCookieKey]->value;
        $userJson = Utils::authcode($userStr,'DECODE',$this->authcodeKey);
        return json_decode($userJson,true);
    }
    
}
