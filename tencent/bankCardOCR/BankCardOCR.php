<?php
namespace utils\tencent\bankCardOCR;
use Exception;
use TencentCloud\Common\Credential;
use TencentCloud\Common\Profile\ClientProfile;
use TencentCloud\Common\Profile\HttpProfile;
use TencentCloud\Ocr\V20181119\Models\BankCardOCRRequest;
use TencentCloud\Ocr\V20181119\OcrClient;

/**
 * 示例
 * zhangyi [2022-12-26]
 * @return void
 */
function example(){
	//$errCode > 0 时表示有错误,$res 是错误消息
	//$errCode == 0 表示执行成功,$res 是返回的数据
	list($errCode,$res) = \utils\tencent\bankCardOCR\BankCardOCR::getInstance()
		->config('$secretId','$secretKey')
		->setImageUrl('图片地址')
		->setImageBase64('base64图片')
		->exec();

}
/**
 * 腾讯银行卡识别
 * 腾讯接口文档地址
 * @link https://cloud.tencent.com/document/product/866/36216
 */
class BankCardOCR{
	public $secretId = null;
	public $secretKey = null;
	public $Action = 'BankCardOCR';
	public $Version = '2018-11-19';
	public $Region = 'ap-beijing';
	public $ImageBase64 = null;
	public $ImageUrl = null;
	public $RetBorderCutImage = false;
	public $RetCardNoImage = false;
	public $EnableCopyCheck = false;
	public $EnableReshootCheck = false;
	public $EnableBorderCheck = false;
	public $EnableQualityValue = false;

	/**
	 * @return string
	 */
	public function getAction()
	{
		return $this->Action;
	}

	/**
	 * @param string $Action
	 */
	public function setAction( $Action )
	{
		$this->Action = $Action;
		return $this;
	}

	/**
	 * @return string
	 */
	public function getVersion()
	{
		return $this->Version;
	}

	/**
	 * @param string $Version
	 */
	public function setVersion( $Version )
	{
		$this->Version = $Version;
		return $this;
	}

	/**
	 * @return string
	 */
	public function getRegion()
	{
		return $this->Region;
	}

	/**
	 * @param string $Region
	 */
	public function setRegion( $Region )
	{
		$this->Region = $Region;
		return $this;
	}

	/**
	 * @return null
	 */
	public function getImageBase64()
	{
		return $this->ImageBase64;
	}

	/**
	 * @param null $ImageBase64
	 */
	public function setImageBase64( $ImageBase64 )
	{
		$this->ImageBase64 = $ImageBase64;
		return $this;
	}

	/**
	 * @return null
	 */
	public function getImageUrl()
	{
		return $this->ImageUrl;
	}

	/**
	 * @param null $ImageUrl
	 */
	public function setImageUrl( $ImageUrl )
	{
		$this->ImageUrl = $ImageUrl;
		return $this;
	}

	/**
	 * @return bool
	 */
	public function isRetBorderCutImage()
	{
		return $this->RetBorderCutImage;
	}

	/**
	 * @param bool $RetBorderCutImage
	 */
	public function setRetBorderCutImage( $RetBorderCutImage )
	{
		$this->RetBorderCutImage = $RetBorderCutImage;
		return $this;
	}

	/**
	 * @return bool
	 */
	public function isRetCardNoImage()
	{
		return $this->RetCardNoImage;
	}

	/**
	 * @param bool $RetCardNoImage
	 */
	public function setRetCardNoImage( $RetCardNoImage )
	{
		$this->RetCardNoImage = $RetCardNoImage;
		return $this;
	}

	/**
	 * @return bool
	 */
	public function isEnableCopyCheck()
	{
		return $this->EnableCopyCheck;
	}

	/**
	 * @param bool $EnableCopyCheck
	 */
	public function setEnableCopyCheck( $EnableCopyCheck )
	{
		$this->EnableCopyCheck = $EnableCopyCheck;
		return $this;
	}

	/**
	 * @return bool
	 */
	public function isEnableReshootCheck()
	{
		return $this->EnableReshootCheck;
	}

	/**
	 * @param bool $EnableReshootCheck
	 */
	public function setEnableReshootCheck( $EnableReshootCheck )
	{
		$this->EnableReshootCheck = $EnableReshootCheck;
		return $this;
	}

	/**
	 * @return bool
	 */
	public function isEnableBorderCheck()
	{
		return $this->EnableBorderCheck;
	}

	/**
	 * @param bool $EnableBorderCheck
	 */
	public function setEnableBorderCheck( $EnableBorderCheck )
	{
		$this->EnableBorderCheck = $EnableBorderCheck;
		return $this;
	}

	/**
	 * @return bool
	 */
	public function isEnableQualityValue()
	{
		return $this->EnableQualityValue;
	}

	/**
	 * @param bool $EnableQualityValue
	 */
	public function setEnableQualityValue( $EnableQualityValue )
	{
		$this->EnableQualityValue = $EnableQualityValue;
		return $this;
	}


	/**
	 * 获取实例
	 * zhangyi [2022-12-26]
	 * @return BankCardOCR
	 */
	public static function getInstance(){
		return new BankCardOCR();
	}

	/**
	 * 配置秘钥
	 * @param $secretId
	 * @param $secretKey
	 * zhangyi [2022-12-26]
	 * @return $this
	 */
	public function config($secretId,$secretKey){
		$this->secretId = $secretId;
		$this->secretKey = $secretKey;
		return $this;
	}

	/**
	 * 执行
	 * zhangyi [2022-12-26]
	 * @return array
	 */
	public function exec(){
		try{

			// 实例化一个认证对象，入参需要传入腾讯云账户secretId，secretKey,此处还需注意密钥对的保密
			// 密钥可前往https://console.cloud.tencent.com/cam/capi网站进行获取
			$cred = new Credential($this->secretId, $this->secretKey);
			// 实例化一个http选项，可选的，没有特殊需求可以跳过
			$httpProfile = new HttpProfile();
			$httpProfile->setEndpoint("ocr.tencentcloudapi.com");

			// 实例化一个client选项，可选的，没有特殊需求可以跳过
			$clientProfile = new ClientProfile();
			$clientProfile->setHttpProfile($httpProfile);
			// 实例化要请求产品的client对象,clientProfile是可选的
			$client = new OcrClient($cred, $this->getRegion(), $clientProfile);

			// 实例化一个请求对象,每个接口都会对应一个request对象
			$req = new BankCardOCRRequest();

			$params = array(
				"ImageUrl"=>$this->getImageUrl(),
				"ImageBase64"=>$this->getImageBase64(),
			);
			$req->fromJsonString(json_encode($params));

			// 返回的resp是一个BankCardOCRResponse的实例，与请求对象对应
			$resp = $client->BankCardOCR($req);

			// 输出json格式的字符串回包
			return [0,json_decode($resp->toJsonString(),true)];

		}catch ( Exception $e){
			return [999999,$e->getMessage()];
		}
	}



}