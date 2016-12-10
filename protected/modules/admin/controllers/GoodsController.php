<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of GoodsController
 *
 * @author Dell
 */
class GoodsController extends AdminBaseController {

    public $page_name = "商品";
    
    //put your code here
    public function actionIndex() {
        $this->breadcrumbs = array($this->page_name.'管理');
        $name = Yii::app()->request->getParam('name','');
        $cat_id = Yii::app()->request->getParam('cat_id',0);
        $criteria = new CDbCriteria();
        $criteria->with = "goodsCategory";
        if($name){
            $criteria->addSearchCondition('t.name', $name);
        }
        if($cat_id){
            $criteria->compare('cat_id', $cat_id);
        }
        $model = Goods::model()->findAll($criteria);
        $data = GoodsCategory::getGoodsCategory();
        $list = array();
        foreach ($data['unlimit'] as $k => $v){
            $list[$v['id']] = $v['html'].$v['name'];
        }
        $this->render('index', array('model'=>$model,'list'=>$list));
    }

    public function actionCreate() {
        $this->breadcrumbs = array('添加'.$this->page_name);
        $model = new Goods();
        $data = GoodsCategory::getGoodsCategory();
        $list = array();
        foreach ($data['unlimit'] as $k => $v){
            $list[$v['id']] = $v['html'].$v['name'];
        }
        $this->render('_form', array('model' => $model,'list'=>$list));
    }

    public function actionUpdate() {
        $this->breadcrumbs = array('修改'.$this->page_name);
        $id = Yii::app()->request->getParam('id', 0);
        $model = Goods::model()->findByPk($id);
        $this->checkEmpty($model);
        $data = GoodsCategory::getGoodsCategory();
        $list = array();
        foreach ($data['unlimit'] as $k => $v){
            $list[$v['id']] = $v['html'].$v['name'];
        }
        $this->render('_form', array('model' => $model,'list'=>$list));
    }

    public function actionSave() {
        $id = Yii::app()->request->getParam('id', 0);
        if ($id) {
            $model = Goods::model()->findByPk($id);
        } else {
            $model = new Goods();
            $model->created = time();
        }
        try {
            $model->attributes = Yii::app()->request->getPost('Goods');
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
        $res = Goods::model()->deleteAll($criteria);
        if($res){
            $this->handleResult(1, '操作成功');
        }else{
            $this->handleResult(0, '操作失败');
        }
    }

}
