<?php

/**
 * This is the model class for table "place".
 *
 * The followings are the available columns in table 'place':
 * @property integer $id
 * @property string $areacode
 * @property string $name
 * @property double $weight
 * @property integer $created
 */
class Place extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'place';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('weight', 'required'),
            array('created', 'numerical', 'integerOnly' => true),
            array('weight', 'numerical'),
            array('weight', 'weightVerify'),
            array('areacode', 'length', 'max' => 16),
            array('name', 'length', 'max' => 32),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, areacode, name, weight, created', 'safe', 'on' => 'search'),
        );
    }

    /**
     * 验证权重的数值
     * @param type $attribute
     * @param type $params 
     */
    public function weightVerify($attribute, $params) {
        if ($this->$attribute > 1 || $this->$attribute <= 0) {
            $this->addError($attribute, '请输入0到1之间的小数');
        }
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'area' => array(self::BELONGS_TO, 'Area', '', 'on' => 't.areacode=area.areacode')
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'areacode' => '采价点编码',
            'name' => '采价点名称',
            'weight' => '权重',
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
        $criteria->compare('areacode', $this->areacode, true);
        $criteria->compare('name', $this->name, true);
        $criteria->compare('weight', $this->weight);
        $criteria->compare('created', $this->created);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Place the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

}
