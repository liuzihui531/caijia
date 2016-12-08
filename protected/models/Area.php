<?php

/**
 * This is the model class for table "area".
 *
 * The followings are the available columns in table 'area':
 * @property integer $id
 * @property string $areaname
 * @property string $areacode
 * @property integer $level
 * @property integer $pid
 * @property integer $created
 */
class Area extends CActiveRecord
{
	public static $cacheKey = 'area';
    public static function getLevelKv($key = ""){
        $return  = array(
            1 => '市',
            2 => '县',
            3 => '镇',
            4 => '村',
        );
        if($key !== ""){
            return array_key_exists($key, $return) ? $return[$key] : "";
        }
        return $return;
    }
    
    public static function getAreacodeAndAreaname($key =""){
       $model = Yii::app()->db->createCommand("select areacode,areaname from area")->queryAll();
       $return = CHtml::listData($model, 'areacode', 'areaname');
        if($key !==""){
            return array_key_exists($key,$return)?$return[$key]:"";
        }
        return $return;
    }

    /**
     * 通过areaname查询所有数据
     * @param type $areaname
     * @return type
     */
    public static function getModelByAreacode($areacode){
        $criteria = new CDbCriteria();
        $criteria->addCondition("areacode like '{$areacode}%'");
        return Area::model()->findAll($criteria);
    }

    /**
     * 获取一条areacode最大的数据
     * @param type $level
     * @return type
     */
    public static function getLevelLastModel($level,$pid=0){
        $criteria = new CDbCriteria();
        $criteria->compare("level", $level);
        if($pid){
            $criteria->compare("pid", $pid);
        }
        $criteria->order = "areacode desc";
        return Area::model()->find($criteria);
    }
    
    public static function getLastModelByPid($pid){
        $criteria = new CDbCriteria();
        $criteria->compare("pid", $pid);
        $criteria->order = "areacode desc";
        return Area::model()->find($criteria);
    }

    public static function getArea(){
    	$area = RedisD::get(self::$cacheKey);
    	if(!$area){
    		$area = self::setArea();
    	}
    	return $area;
    }

    public static function setArea(){
    	$model = Area::model()->findAll();
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
	public function tableName()
	{
		return 'area';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
                        array("areaname","required"),
                        array("areaname","unique"),
			array('level, pid, created', 'numerical', 'integerOnly'=>true),
			array('areaname', 'length', 'max'=>32),
			array('areacode', 'length', 'max'=>16),
                        array('fullname', 'length', 'max'=>128),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('fullname,id, areaname, areacode, level, pid, created', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'areaname' => '城市名称',
			'areacode' => '城市码',
			'level' => '等级',
			'pid' => '上级ID',
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
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('areaname',$this->areaname,true);
		$criteria->compare('areacode',$this->areacode,true);
		$criteria->compare('level',$this->level);
		$criteria->compare('pid',$this->pid);
		$criteria->compare('created',$this->created);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Area the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
