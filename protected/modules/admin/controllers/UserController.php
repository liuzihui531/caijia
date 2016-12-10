<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of User_CategoryController
 *
 * @author Dell
 */
class UserController extends AdminBaseController {

    public $page_name = "采价员";

    //put your code here
    public function actionIndex() {
        $this->breadcrumbs = array($this->page_name . '管理');
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
        $model = User::model()->findAll($criteria);
        $this->render('index', array('model' => $model));
    }

    public function actionCreate() {
        $this->breadcrumbs = array('添加' . $this->page_name);
        $model = new User();
        $this->render('_form', array('model' => $model));
    }

    public function actionUpdate() {
        $this->breadcrumbs = array('修改' . $this->page_name);
        $id = Yii::app()->request->getParam('id', 0);
        $model = User::model()->findByPk($id);
        $model->password = "";
        $this->checkEmpty($model);
        $this->render('_form', array('model' => $model));
    }

    public function actionSave() {
        $id = Yii::app()->request->getParam('id', 0);
        $post = Yii::app()->request->getPost('User');
        if ($id) {
            $model = User::model()->findByPk($id);
            if ($post['password']) {
                $post['password'] = Utils::password($post['password']);
            } else {
                unset($post['password']);
            }
        } else {
            $model = new User();
            $model->created = time();
            $post['password'] = $post['password'] ? Utils::password($post['password']) : $post['password'] = Utils::password(substr($post['idcard'], -6));
        }
        try {
            $model->attributes = $post;
            $model->save();
            if ($model->hasErrors()) {
                throw new Exception(Utils::getFirstError($model->errors));
            }
            $this->handleResult(1, '操作成功', $this->createUrl('index'));
        } catch (Exception $ex) {
            $this->handleResult(0, '操作失败,原因:' . $ex->getMessage());
        }
    }

    public function actionDelete() {
        $id = Yii::app()->request->getParam('id', '');
        $id = (array) $id;
        $criteria = new CDbCriteria();
        $criteria->addInCondition('id', $id);
        $res = User::model()->deleteAll($criteria);
        if ($res) {
            $this->handleResult(1, '操作成功');
        } else {
            $this->handleResult(0, '操作失败');
        }
    }
    
    public function actionPlaceManage(){
        $id = Yii::app()->request->getParam("id",0);
        $model = User::model()->findByPk($id);
        if(Yii::app()->request->isPostRequest){
            $place_ids = Yii::app()->request->getParam("place_ids",array());
            $model->place_ids = $place_ids ? implode(",", $place_ids) : "";
            $transaction = Yii::app()->db->beginTransaction();
            $r = UserPlaceRelation::batchInsert($id,$place_ids);
            $model->save();
            if(!$r || $model->hasErrors()){
                $transaction->rollback();
                $this->handleResult(0, '操作失败', $this->createUrl('PlaceManage',array('id' => $id)));
            }else{
                $transaction->commit();
                $this->handleResult(1, '操作成功', $this->createUrl('PlaceManage',array('id' => $id)));
            }
        }
        $area = Area::getArea();
        $unlimit = $area['unlimit'];
        //Utils::printr($subUnlimit);
        $this->breadcrumbs = array('采价点管理');
        $placeModel = Place::model()->findAll();
        $placeData = array();
        if($placeModel){
            foreach ($placeModel as $key => $val) {
                $placeData[$val->areacode][$val->id] = $val->attributes;
            }
        }
        $modelPlaces = $model && $model->place_ids ? explode(",", $model->place_ids) : array();
        $this->render('placemanage',array('unlimit' => $unlimit,'placeData' => $placeData,'modelPlaces'=>$modelPlaces));
    }

}
