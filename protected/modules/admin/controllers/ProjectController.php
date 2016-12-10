<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Project_CategoryController
 *
 * @author Dell
 */
class ProjectController extends AdminBaseController {

    public $page_name = "项目";

    //put your code here
    public function actionIndex() {
        $this->breadcrumbs = array($this->page_name . '管理');
        $criteria = new CDbCriteria();
        $model = Project::model()->findAll($criteria);
        $this->render('index', array('model' => $model));
    }

    public function actionCreate() {
        $this->breadcrumbs = array('添加' . $this->page_name);
        $model = new Project();
        $this->is_ueditor = true; //用到ueditor编辑器
        $goods_category = GoodsCategory::getGoodsCategory();
        $goods_category = $goods_category['unlimit'];
        $goodsModel = Goods::model()->findAll();
        $goodsData = array();
        if ($goodsModel) {
            foreach ($goodsModel as $key => $val) {
                $goodsData[$val->cat_id][$val->id] = $val->attributes;
            }
        }
        $modelGoodsIds = $model && $model->goods_ids ? explode(",", $model->goods_ids) : array();
        $this->render('_form', array('model' => $model, 'goods_category' => $goods_category, 'goodsData' => $goodsData, 'modelGoodsIds' => $modelGoodsIds));
    }

    public function actionUpdate() {
        $this->breadcrumbs = array('修改' . $this->page_name);
        $id = Yii::app()->request->getParam('id', 0);
        $model = Project::model()->findByPk($id);
        $this->checkEmpty($model);
        $this->is_ueditor = true; //用到ueditor编辑器
        $this->render('_form', array('model' => $model));
    }

    public function actionSave() {
        $id = Yii::app()->request->getParam('id', 0);
        $post = Yii::app()->request->getPost('Project');
        $goods_ids = Yii::app()->request->getParam('goods_ids', array());
        $first = Yii::app()->request->getPost('First', array());
        $second = Yii::app()->request->getPost('Second', array());
        if ($id) {
            $model = Project::model()->findByPk($id);
        } else {
            $model = new Project();
            $model->created = time();
        }
        $transaction = Yii::app()->db->beginTransaction();
        try {
            $model->attributes = $post;
            $model->first = $this->getFirst($first);
            $model->second = $this->getSecond($second);
            $model->depart_ids = $post['depart_ids'] ? implode(',', $post['depart_ids']) : "";
            $model->goods_ids = $goods_ids ? implode(',', $goods_ids) : "";
            $model->begin_date = strtotime($post['begin_date']);
            $model->end_date = strtotime($post['end_date']);
            if ($model->end_date < $model->begin_date) {
                throw new Exception('开始时间不能大于结束时间');
            }
            $model->desc = Utils::enSlashes($post['desc']);
            $model->save();
            $r1 = ProjectDepartRelation::batchInsert($model->id, $post['depart_ids']);
            $r2 = ProjectGoodsRelation::batchInsert($model->id, $goods_ids);
            if (!$r1 || !$r2 || $model->hasErrors()) {
                throw new Exception(Utils::getFirstError($model->errors));
            }
            $transaction->commit();
            $this->handleResult(1, '操作成功', $this->createUrl('index'));
        } catch (Exception $ex) {
            $transaction->rollback();
            $this->handleResult(0, '操作失败,原因:' . $ex->getMessage());
        }
    }

    public function actionDelete() {
        $id = Yii::app()->request->getParam('id', '');
        $id = (array) $id;
        $criteria = new CDbCriteria();
        $criteria->addInCondition('id', $id);
        $res = Project::model()->deleteAll($criteria);
        if ($res) {
            $this->handleResult(1, '操作成功');
        } else {
            $this->handleResult(0, '操作失败');
        }
    }

    private function getFirst($first) {
        $count = Utils::count_array($first);
        if ($count == 0) {
            return "7:00-17:30";
        } elseif ($count == 4) {
            return $first[0] . ':' . $first[1] . '-' . $first[2] . ':' . $first[3];
        } else {
            return false;
        }
    }

    private function getSecond($second) {
        $count = Utils::count_array($second);
        if ($count == 4) {
            return $second[0] . ':' . $second[1] . '-' . $second[2] . ':' . $second[3];
        } else {
            return false;
        }
    }

}
