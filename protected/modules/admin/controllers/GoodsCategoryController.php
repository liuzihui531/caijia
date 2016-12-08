<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of GoodsCategory_CategoryController
 *
 * @author Dell
 */
class GoodsCategoryController extends AdminBaseController {

    public $page_name = "商品分类";

    //put your code here
    public function actionIndex() {
        $this->breadcrumbs = array($this->page_name . '管理');
        $criteria = new CDbCriteria();
        $model = GoodsCategory::model()->findAll($criteria);
        $list = Utils::getUnLimitClass(Utils::object2array($model), 0, '---');
        $this->render('index', array('model' => $list));
    }

    public function actionCreate() {
        $pid = Yii::app()->request->getParam("pid", 0);
        if ($pid == 0) {
            $pname = "无上级";
            $level = 0;
        } else {
            $pmodel = GoodsCategory::model()->findByPk($pid);
            $pname = $pmodel->fullname;
            $level = $pmodel->level;
        }
        $this->breadcrumbs = array('添加' . $this->page_name);

        $model = new GoodsCategory();
        $this->render('_form', array('model' => $model, 'pname' => $pname, 'level' => $level));
    }

    public function actionUpdate() {
        $this->breadcrumbs = array('修改' . $this->page_name);
        $pid = Yii::app()->request->getParam("pid", 0);
        if ($pid == 0) {
            $pname = "无上级";
            $level = 0;
        } else {
            $pmodel = GoodsCategory::model()->findByPk($pid);
            $pname = $pmodel->fullname;
            $level = $pmodel->level;
        }
        $id = Yii::app()->request->getParam('id', 0);
        $model = GoodsCategory::model()->findByPk($id);
        $this->checkEmpty($model);
        $this->render('_form', array('model' => $model, 'pname' => $pname, 'level' => $level));
    }

    public function actionSave() {
        $pid = Yii::app()->request->getParam("pid", 0);
        $id = Yii::app()->request->getParam('id', 0);
        $post = Yii::app()->request->getPost('GoodsCategory');
        $level = Yii::app()->request->getParam("level", 0);
        $fullname = $this->getFullName($pid);
        if ($id) {
            $model = GoodsCategory::model()->findByPk($id);
            $model->fullname =  $fullname? $fullname . ',' . $post['name'] : $post['name'];
            if (!$pid) {//修改一级分类数据
                $this->updateFullnameAndUnit($id, $post);
            }
        } else {
            $model = new GoodsCategory();
            $model->created = time();
            $model->pid = $pid;
            $model->fullname = $fullname ? $fullname . ',' . $post['name'] : $post['name'];
            $model->level = $level + 1;
            if ($pid) {//二级分类单位与一级相同
                $pmodel = GoodsCategory::model()->findByPk($pid);
                $model->unit = $pmodel->unit;
            }
        }

        try {
            $model->attributes = $post;
            $model->save();
            if ($model->hasErrors()) {
                throw new Exception(Utils::getFirstError($model->errors));
            }
            GoodsCategory::setGoodsCategory();
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
        $res = GoodsCategory::model()->deleteAll($criteria);
        if ($res) {
            GoodsCategory::setGoodsCategory();
            $this->handleResult(1, '操作成功');
        } else {
            $this->handleResult(0, '操作失败');
        }
    }

    protected function getFullName($id) {
        if (!$id)
            return "";
        $model = GoodsCategory::model()->findByPk($id);
        return $model->name;
    }

    protected function updateFullnameAndUnit($id, $post) {
        $model = GoodsCategory::model()->findAllByAttributes(array('pid' => $id));
        foreach ($model as $v) {
            $fullname = array();
            $fullname = explode(',', $v->fullname);
            $fullname[0] = $post['name'];
            $v->fullname = implode(',', $fullname);
            $v->unit = $post['unit'];
            $v->save();
        }
    }

}
