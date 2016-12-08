<?php 

	class RedisD{
		public static function set($key,$value){
                    //return Yii::app()->cache001->set($key, $value);
                    return Yii::app()->cache->set($key,$value);
		}

		public static function get($key){
                    //$ret = Yii::app()->cache001->get($key);
                    $ret =  Yii::app()->cache->get($key);
                    return $ret;
		}
	}