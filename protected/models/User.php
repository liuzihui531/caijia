<?php

/**
 * This is the model class for table "user".
 *
 * The followings are the available columns in table 'user':
 * @property integer $id
 * @property string $name
 * @property integer $sex
 * @property string $mobile
 * @property string $idcard
 * @property string $password
 * @property string $place_ids
 * @property integer $depart_id
 * @property string $bank
 * @property string $bank_card
 * @property string $address
 * @property string $education
 * @property integer $created
 */
class User extends CActiveRecord {

    //获取性别
    public static function getSexKv($key = "") {
        $return = array(1 => '男', 2 => '女');
        if ($key !== "") {
            return array_key_exists($key, $return) ? $return[$key] : "";
        }
        return $return;
    }

    //获取最高学历
    public static function getEducation($key = "") {
        $return = array(1 => '博士', 2 => '硕士', 3 => '研究生', 4 => '本科', 5 => '大专', 6 => '高中', 7 => '中专', 8 => '初中', 9 => '其他');
        if ($key !== "") {
            return array_key_exists($key, $return) ? $return[$key] : "";
        }
        return $return;
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'user';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('name,mobile,idcard,bank,bank_card,depart_id,address,education,created', 'required'),
            array('mobile', 'match', 'pattern' => '/^1[34578]\d{9}$/', 'message' => '手机号码格式不正确'),
            array('idcard', 'idcardVerify'),
            array('bank_card', 'match','pattern'=>'/^[0-9]{19}$/','message'=>'银行卡账号格式不正确'),
            array('sex, depart_id, created', 'numerical', 'integerOnly' => true),
            array('name, mobile, education', 'length', 'max' => 16),
            array('idcard, password, bank_card', 'length', 'max' => 32),
            array('place_ids', 'length', 'max' => 128),
            array('bank', 'length', 'max' => 64),
            array('address', 'length', 'max' => 256),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, name, sex, mobile, idcard, password, place_ids, depart_id, bank, bank_card, address, education, created', 'safe', 'on' => 'search'),
        );
    }

    public function idcardVerify($attribute, $params) {
        if (!preg_match('/^[1-9]\d{7}((0\d)|(1[0-2]))(([0|1|2]\d)|3[0-1])\d{3}$/',$this->$attribute) && !preg_match('/^[1-9]\d{5}[1-9]\d{3}((0\d)|(1[0-2]))(([0|1|2]\d)|3[0-1])\d{3}([0-9]|X)$/',$this->$attribute)) {
            $this->addError($attribute, '身份证号码格式不正确');
        }
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'depart'=>array(self::BELONGS_TO,'Depart','depart_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'name' => '姓名',
            'sex' => '性别',
            'mobile' => '电话号码',
            'idcard' => '身份证号码',
            'password' => '密码',
            'place_ids' => '管辖采价点',
            'depart_id' => '主管部门',
            'bank' => '开户银行',
            'bank_card' => '银行卡账号',
            'address' => '家庭住址',
            'education' => '最高学历',
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
        $criteria->compare('sex', $this->sex);
        $criteria->compare('mobile', $this->mobile, true);
        $criteria->compare('idcard', $this->idcard, true);
        $criteria->compare('password', $this->password, true);
        $criteria->compare('place_ids', $this->place_ids, true);
        $criteria->compare('depart_id', $this->depart_id);
        $criteria->compare('bank', $this->bank, true);
        $criteria->compare('bank_card', $this->bank_card, true);
        $criteria->compare('address', $this->address, true);
        $criteria->compare('education', $this->education, true);
        $criteria->compare('created', $this->created);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return User the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

}
