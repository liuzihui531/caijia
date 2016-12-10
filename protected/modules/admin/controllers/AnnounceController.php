<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Announce_CategoryController
 *
 * @author Dell
 */
class AnnounceController extends AdminBaseController {

    public $page_name = "公告";
    
    //put your code here
    public function actionIndex() {
        $this->breadcrumbs = array($this->page_name.'管理');
        $title = Yii::app()->request->getParam('title','');
        $criteria = new CDbCriteria();
        if($title){
            $criteria->addSearchCondition('title', $title);
        }
        $model = Announce::model()->findAll($criteria);
        $this->render('index', array('model'=>$model));
    }

    public function actionCreate() {
        $this->breadcrumbs = array('添加'.$this->page_name);
        $model = new Announce();
        $this->is_ueditor = true;//用到ueditor编辑器
        $this->render('_form', array('model' => $model));
    }

    public function actionUpdate() {
        $this->breadcrumbs = array('修改'.$this->page_name);
        $id = Yii::app()->request->getParam('id', 0);
        $model = Announce::model()->findByPk($id);
        $this->checkEmpty($model);
        $this->is_ueditor = true;//用到ueditor编辑器
        $model->content = Utils::deSlashes($model->content);
        $this->render('_form', array('model' => $model));
    }

    public function actionSave() {
        $id = Yii::app()->request->getParam('id', 0);
        if ($id) {
            $model = Announce::model()->findByPk($id);
        } else {
            $model = new Announce();
            $model->created = time();
        }
        try {
            $model->attributes = Yii::app()->request->getPost('Announce');
            $model->content = Utils::enSlashes($model->content);
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
        $res = Announce::model()->deleteAll($criteria);
        if($res){
            $this->handleResult(1, '操作成功');
        }else{
            $this->handleResult(0, '操作失败');
        }
    }

}
