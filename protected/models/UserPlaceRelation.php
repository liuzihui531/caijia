<?php

/**
 * This is the model class for table "user_place_relation".
 *
 * The followings are the available columns in table 'user_place_relation':
 * @property integer $user_id
 * @property integer $place_id
 */
class UserPlaceRelation extends CActiveRecord
{
	public static function batchInsert($user_id,$place_ids){
            $r = UserPlaceRelation::model()->deleteAllByAttributes(array('user_id' => $user_id));            
            if(!$place_ids){
                return true;
            }
            $sql = "insert into user_place_relation (user_id,place_id) values ";
            foreach ($place_ids as $k => $v){
                $sql .= "('{$user_id}','{$v}'),";
            }
            $sql = rtrim($sql,',');
            return Yii::app()->db->createCommand($sql)->execute();
	}
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'user_place_relation';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('user_id, place_id', 'required'),
			array('user_id, place_id', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('user_id, place_id', 'safe', 'on'=>'search'),
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
			'user_id' => '用户ID',
			'place_id' => '采价点ID',
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

		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('place_id',$this->place_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return UserPlaceRelation the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
