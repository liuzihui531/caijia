<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Charge_CategoryController
 *
 * @author Dell
 */
class ChargeController extends AdminBaseController {

    public $page_name = "成员";
    
    //put your code here
    public function actionIndex() {
        $this->breadcrumbs = array($this->page_name.'管理');
        $name = Yii::app()->request->getParam('name','');
        $depart_id = Yii::app()->request->getParam('depart_id',0);
        $criteria = new CDbCriteria();
        $criteria->with = "depart";
        if($name){
            $criteria->addSearchCondition('t.name',$name);
        }
        if($depart_id){
            $criteria->compare('t.depart_id',$depart_id);
        }
        $model = Charge::model()->findAll($criteria);
        $this->render('index', array('model'=>$model));
    }

    public function actionCreate() {
        $this->breadcrumbs = array('添加'.$this->page_name);
        $model = new Charge();
        $this->render('_form', array('model' => $model));
    }

    public function actionUpdate() {
        $this->breadcrumbs = array('修改'.$this->page_name);
        $id = Yii::app()->request->getParam('id', 0);
        $model = Charge::model()->findByPk($id);
        $this->checkEmpty($model);
        $model->password = "";
        $this->render('_form', array('model' => $model));
    }

    public function actionSave() {
        $id = Yii::app()->request->getParam('id', 0);
        $post = Yii::app()->request->getPost('Charge');
        if ($id) {
            $model = Charge::model()->findByPk($id);
            if ($post['password']) {
                $post['password'] = Utils::password($post['password']);
            } else {
                unset($post['password']);
            }
        } else {
            $model = new Charge();
            $model->created = time();
            $post['password'] = $post['password'] ? Utils::password($post['password']) : $post['password'] = Utils::password('88888');
        }
        try {
            $model->attributes = $post;
            $model->save();
            if ($model->hasErrors()) {
                throw new Exception(Utils::getFirstError($model->errors));
            }
            $this->handleResult(1, '操作成功',  $this->createUrl('index'));
        } catch (Exception $ex) {
            $this->handleResult(0, '操作失败,原因:' . $ex->getMessage());
        }
    }
    
    public function actionDelete(){
        $id = Yii::app()->request->getParam('id','');
        $id = (array)$id;
        $criteria = new CDbCriteria();
        $criteria->addInCondition('id', $id);
        $res = Charge::model()->deleteAll($criteria);
        if($res){
            $this->handleResult(1, '操作成功');
        }else{
            $this->handleResult(0, '操作失败');
        }
    }

}
