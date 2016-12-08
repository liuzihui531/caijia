<?php

/**
 * This is the model class for table "goods_category".
 *
 * The followings are the available columns in table 'goods_category':
 * @property integer $id
 * @property string $name
 * @property integer $pid
 * @property string $fullname
 * @property string $unit
 * @property integer $level
 * @property integer $created
 */
class GoodsCategory extends CActiveRecord {
    
    public static $cacheKey = 'goodscategory';
    public function getCateKv($cate_id = 0) {
        $model = Yii::app()->db->createCommand("select id,name from goods_category")->queryAll();
        $cate_data = CHtml::listData($model, 'id', 'name');
        return $cate_data;
    }
    
     public static function getGoodsCategory(){
    	$area = RedisD::get(self::$cacheKey);
    	if(!$area){
    		$area = self::setGoodsCategory();
    	}
    	return $area;
    }

    public static function setGoodsCategory(){
    	$model = GoodsCategory::model()->findAll();
    	$data = array();
    	$unlimit = array();
    	$subUnlimit = array();
    	foreach ($model as $key => $val) {
    		$data[$val->areacode] = $val->areaname;
    	}
    	$unlimit = Utils::getUnLimitClass(Utils::object2array($model));
    	$subUnlimit = Utils::getSubUnlimit($model);
    	$return = array('data' => $data, 'unlimit' => $unlimit , 'subUnlimit' => $subUnlimit);
    	RedisD::set(self::$cacheKey,$return);
    	return $return;
    }
    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'goods_category';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('pid, created', 'required'),
            array('pid, level, created', 'numerical', 'integerOnly' => true),
            array('name', 'length', 'max' => 32),
            array('fullname', 'length', 'max' => 64),
            array('unit', 'length', 'max' => 16),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, name, pid, fullname, unit, level, created', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'name' => '分类名称',
            'pid' => '上级分类ID',
            'fullname' => '完整分类名称',
            'unit' => '单位',
            'level' => '分类等级',
            'created' => '创建时间',
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     *
     * Typical usecase:
     * - Initialize the model fields with values from filter form.
     * - Execute this method to get CActiveDataProvider instance which will filter
     * models according to data in model fields.
     * - Pass data provider to CGridView, CListView or any similar widget.
     *
     * @return CActiveDataProvider the data provider that can return the models
     * based on the search/filter conditions.
     */
    public function search() {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id);
        $criteria->compare('name', $this->name, true);
        $criteria->compare('pid', $this->pid);
        $criteria->compare('fullname', $this->fullname, true);
        $criteria->compare('unit', $this->unit, true);
        $criteria->compare('level', $this->level);
        $criteria->compare('created', $this->created);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return GoodsCategory the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

}
