<?php
namespace utils;
class Utils{
	protected $version;

	/**
	 * @param $version
	 */
	public function __construct( )
	{
		$this->version = '1.0.0';
	}


	/**
	 * @return mixed
	 */
	public function getVersion()
	{
		return $this->version;
	}

	/**
	 * 生成随机纯数字
	 * @param $length
	 * zhangyi [2022-12-26]
	 * @return int
	 */
	public static function makeRandNumber($length){
		$min = pow(10,$length-1);
		$max = pow(10,$length) -1 ;
//		var_dump($min);
//		var_dump($max);
		return rand($min,$max);
	}

	/**
	 * 对象转数组
	 * @param $obj
	 * zhangyi [2022-12-26]
	 * @return mixed
	 */
	public static function toArray($obj){
		return json_decode(json_encode($obj),true);
	}
}
