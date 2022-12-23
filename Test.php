<?php

use utils\alibaba\sms\SMS;

SMS::getInstance()->init()->setPhoneNumbers('18920167531')->setTemplateCode()->setSignName()->exec();