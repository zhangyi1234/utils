<?php

use zhangyi\utils\alibaba\sms\SMS;

SMS::getInstance()
	->config('1111','2222')
	->setPhoneNumbers('18920167531')
	->setTemplateCode()
	->setSignName()
	->exec();