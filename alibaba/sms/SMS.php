<?php
namespace utils\alibaba\sms;

use AlibabaCloud\SDK\Dysmsapi\V20170525\Dysmsapi;
use AlibabaCloud\SDK\Dysmsapi\V20170525\Models\SendSmsRequest;
use AlibabaCloud\Tea\Exception\TeaError;
use AlibabaCloud\Tea\Utils\Utils;
use AlibabaCloud\Tea\Utils\Utils\RuntimeOptions;
use Darabonba\OpenApi\Models\Config;
use Exception;

class SMS
{
	public static function getInstance(){
		return new SMS();
	}

	public $client = null;
	public $PhoneNumbers = null;
	public $SignName = null;
	public $TemplateCode = null;
	public $TemplateParam = null;
	public $SmsUpExtendCode = null;
	public $OutId = null;

	/**
	 * @return null
	 */
	public function getPhoneNumbers()
	{
		return $this->PhoneNumbers;

	}

	/**
	 * @param null $PhoneNumbers
	 */
	public function setPhoneNumbers( $PhoneNumbers )
	{
		$this->PhoneNumbers = $PhoneNumbers;
		return $this;
	}

	/**
	 * @return null
	 */
	public function getSignName()
	{
		return $this->SignName;
	}

	/**
	 * @param null $SignName
	 */
	public function setSignName( $SignName )
	{
		$this->SignName = $SignName;
		return $this;
	}

	/**
	 * @return null
	 */
	public function getTemplateCode()
	{
		return $this->TemplateCode;
	}

	/**
	 * @param null $TemplateCode
	 */
	public function setTemplateCode( $TemplateCode )
	{
		$this->TemplateCode = $TemplateCode;
		return $this;
	}

	/**
	 * @return null
	 */
	public function getTemplateParam()
	{
		return $this->TemplateParam;
	}

	/**
	 * @param null $TemplateParam
	 */
	public function setTemplateParam( $TemplateParam )
	{
		$this->TemplateParam = $TemplateParam;
		return $this;
	}

	/**
	 * @return null
	 */
	public function getSmsUpExtendCode()
	{
		return $this->SmsUpExtendCode;
	}

	/**
	 * @param null $SmsUpExtendCode
	 */
	public function setSmsUpExtendCode( $SmsUpExtendCode )
	{
		$this->SmsUpExtendCode = $SmsUpExtendCode;
		return $this;
	}

	/**
	 * @return null
	 */
	public function getOutId()
	{
		return $this->OutId;
	}

	/**
	 * @param null $OutId
	 */
	public function setOutId( $OutId )
	{
		$this->OutId = $OutId;
		return $this;
	}

	/**
	 *
	 * @param $accessKeyId
	 * @param $accessKeySecret
	 * zhangyi [2022-12-23]
	 * @return SMS
	 */
	public function config($accessKeyId, $accessKeySecret){
		$conf = new Config([
			'accessKeyId'=>$accessKeyId,
			'accessKeySecret'=>$accessKeySecret
		]);
		$conf->endpoint = "dysmsapi.aliyuncs.com";
		$this->client = new Dysmsapi($conf);
		return $this;
	}

	/**
	 *
	 * zhangyi [2022-12-23]
	 * @return array
	 */
	function exec(){
		$sendSmsRequest = new SendSmsRequest([]);
		$runtime = new RuntimeOptions([]);
		try {
			// 复制代码运行请自行打印 API 的返回值
			$result = $this->client->sendSmsWithOptions($sendSmsRequest, $runtime);
			$res = json_decode($result,true);
			if ($res['Code'] === 'OK'){
				return [0,$result];
			}else{
				return [$res['Code'],$result];
			}
		}
		catch (Exception $error) {
			if (!($error instanceof TeaError)) {
				$error = new TeaError([], $error->getMessage(), $error->getCode(), $error);
			}
			// 如有需要，请打印 error
			Utils::assertAsString($error->message);
			return [999999,json_encode($error,JSON_UNESCAPED_UNICODE)];
		}
	}

	function asd(){
	    echo "asd";
    }

}