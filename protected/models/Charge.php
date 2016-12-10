<?php

/**
 * This is the model class for table "charge".
 *
 * The followings are the available columns in table 'charge':
 * @property integer $id
 * @property string $name
 * @property integer $depart_id
 * @property string $mobile
 * @property string $password
 * @property integer $created
 */
class Charge extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'charge';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name,depart_id,mobile, created', 'required'),
			array('mobile', 'match', 'pattern' => '/^1[34578]\d{9}$/', 'message' => '手机号码格式不正确'),
			array('depart_id, created', 'numerical', 'integerOnly'=>true),
			array('name, password', 'length', 'max'=>32),
			array('mobile', 'length', 'max'=>16),
                        array("mobile","unique"),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, name, depart_id, mobile, password, created', 'safe', 'on'=>'search'),
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
                    'depart'=>array(self::BELONGS_TO,'Depart','depart_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'name' => '姓名',
			'depart_id' => '主管部门',
			'mobile' => '联系方式',
			'password' => '密码',
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
		$criteria->compare('name',$this->name,true);
		$criteria->compare('depart_id',$this->depart_id);
		$criteria->compare('mobile',$this->mobile,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('created',$this->created);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Charge the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
