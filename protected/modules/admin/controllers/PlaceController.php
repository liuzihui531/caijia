<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Place_CategoryController
 *
 * @author Dell
 */
class PlaceController extends AdminBaseController {

    public $page_name = "采价点";
    
    //put your code here
    public function actionIndex() {
        $this->breadcrumbs = array($this->page_name.'管理');
        $name = Yii::app()->request->getParam('name','');
        $criteria = new CDbCriteria();
        if($name){
            $criteria->addSearchCondition('name',$name);
        }
        $criteria->with = array("area");
        $model = Place::model()->findAll($criteria);
        $this->render('index', array('model'=>$model));
    }

    public function actionCreate() {
        $this->breadcrumbs = array('添加'.$this->page_name);
        $model = new Place();
        $areacode = $this->getAreaCodeData();
        $this->render('_form', array('model' => $model,'areacode'=>$areacode));
    }

    public function actionUpdate() {
        $this->breadcrumbs = array('修改'.$this->page_name);
        $id = Yii::app()->request->getParam('id', 0);
        $model = Place::model()->findByPk($id);
        $this->checkEmpty($model);
         $areacode = $this->getAreaCodeData();
        $this->render('_form', array('model' => $model,'areacode'=>$areacode));
    }

    private function getAreaCodeData(){
        $model = Area::model()->findAll();
        $list = Utils::getUnLimitClass(Utils::object2array($model),0,'---');
        $areacodeList = array();
        if($list){
            foreach ($list as $key => $val) {
                $areacodeList[$val['areacode']] = $val['html'].$val['areaname'];
            }
        }
        return $areacodeList;
    }

    public function actionSave() {
        $id = Yii::app()->request->getParam('id', 0);
        if ($id) {
            $model = Place::model()->findByPk($id);
        } else {
            $model = new Place();
            $model->created = time();
        }
        try {
            $model->attributes = Yii::app()->request->getPost('Place');
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
        $res = Place::model()->deleteAll($criteria);
        if($res){
            $this->handleResult(1, '操作成功');
        }else{
            $this->handleResult(0, '操作失败');
        }
    }

}
