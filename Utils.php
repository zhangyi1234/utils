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
}
