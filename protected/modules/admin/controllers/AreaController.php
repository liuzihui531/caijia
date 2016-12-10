<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Area_CategoryController
 *
 * @author Dell
 */
class AreaController extends AdminBaseController {

    public $page_name = "地区";

    //put your code here
    public function actionIndex() {
        $this->breadcrumbs = array($this->page_name . '管理');
        $criteria = new CDbCriteria();
        $model = Area::model()->findAll($criteria);
        $list = Utils::getUnLimitClass(Utils::object2array($model),0,'---');
        $this->render('index', array('model' => $list));
    }

    public function actionCreate() {
        $pid = Yii::app()->request->getParam("pid", 0);
        if ($pid == 0) {
            $pname = "无上级";
            $this->page_name = "城市";
            $level = 0;
            $fullname = "";
        } else {
            $pmodel = Area::model()->findByPk($pid);
            $pname = $pmodel->fullname;
            $fullname = $pmodel->fullname;
            $level = $pmodel->level;
            $this->page_name = Area::getLevelKv($pmodel->level);
        }

        $this->breadcrumbs = array('添加' . $this->page_name);

        $model = new Area();
        $this->render('_form', array('model' => $model, 'pname' => $pname, 'level' => $level, 'fullname' => $fullname));
    }

    public function actionUpdate() {
        $pid = Yii::app()->request->getParam("pid", 0);
        if ($pid == 0) {
            $pname = "无上级";
            $this->page_name = "城市";
            $level = 0;
        } else {
            $pmodel = Area::model()->findByPk($pid);
            $pname = $pmodel->fullname;
            $level = $pmodel->level;
            $this->page_name = Area::getLevelKv($pmodel->level);
        }
        $this->breadcrumbs = array('修改' . $this->page_name);
        $id = Yii::app()->request->getParam('id', 0);
        $model = Area::model()->findByPk($id);
        $this->checkEmpty($model);
        $this->render('_form', array('model' => $model, 'pname' => $pname, 'level' => $level));
    }

    public function actionSave() {
        $pid = Yii::app()->request->getParam("pid", 0);
        $level = Yii::app()->request->getParam("level", 0);
        $id = Yii::app()->request->getParam('id', 0);
        $post = Yii::app()->request->getPost('Area');
        $fullname = Yii::app()->request->getPost('fullname', "");
        if ($id) {
            $model = Area::model()->findByPk($id);
            list($null, $model->fullname) = $this->getAreacodeAndFullname($level, $post['areaname'], $model->pid, $id);
        } else {
            $model = new Area();
            $model->created = time();
            list($model->areacode, $model->fullname) = $this->getAreacodeAndFullname($level, $post['areaname'], $pid, 0);
            $model->level = $level + 1;
            $model->pid = $pid;
        }
        try {
            $model->attributes = $post;
            $model->save();
            if ($model->hasErrors()) {
                throw new Exception(Utils::getFirstError($model->errors));
            }
            Area::setArea();
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
        $res = Area::model()->deleteAll($criteria);
        if ($res) {
            Area::setArea();
            $this->handleResult(1, '操作成功');
        } else {
            $this->handleResult(0, '操作失败');
        }
    }

    /**
     * 根据level获取一条最大的areacode、fullname数据
     * @param type $level
     * @return type
     */
    private function getAreacodeAndFullname($level, $areaname, $pid, $id) {
        $pmodel = Area::model()->findByPk($pid);
        $pfullname = $pmodel ? $pmodel->fullname : "";
        if ($id > 0) {
            $this->updateChildFullname($id, $level, $areaname);
            $fullname = $pfullname ? $pfullname . "," . $areaname : $areaname;
            return array(0, $fullname);
        }
        $smodel = Area::getLastModelByPid($pid);
        $pareacode = $pmodel ? $pmodel->areacode : "";
        $areacode = $smodel ? $smodel->areacode + 1 : $pareacode . "101";
        $fullname = $pfullname ? $pfullname . "," . $areaname : $areaname;
        return array($areacode, $fullname);
    }

//    //修改本类以及子类fullname
    private function updateChildFullname($id, $level, $areaname) {
        $model = Area::model()->findByPk($id); //获取修改之前的areaname
        $areacode_model = Area::getModelByAreacode($model->areacode); //获取该类以及子类的数据
        if ($areacode_model) {
            foreach ($areacode_model as $k => $v) {
                $fullname = array();
                $fullname = explode(',', $v->fullname);
                $fullname[$level] = $areaname;
                $modelArr = Area::model()->findByPk($v->id);
                $modelArr->fullname = implode(',', $fullname);
                $modelArr->save();
            }
        }
    }

}
