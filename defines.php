<?php
//贝宝支付环境类型 product:正式环境 sandbox:沙箱环境
if (!defined('SY_PAY_PAYPAL_ENV')) {
    define('SY_PAY_PAYPAL_ENV', 'product');
}

//配置文件前缀
if (!defined('SY_CONFIG_PREFIX')) {
    define('SY_CONFIG_PREFIX', '');
}

//redis服务版本号
if (!defined('SY_VERSION_REDIS')) {
    define('SY_VERSION_REDIS', '6.2.0');
}
