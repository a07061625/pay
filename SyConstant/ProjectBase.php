<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2018/9/1 0001
 * Time: 15:02
 */
namespace SyConstant;

use SyTrait\SimpleTrait;

class ProjectBase
{
    use SimpleTrait;

    //REDIS常量 后五位全数字的前缀为框架内部前缀,微信:10000-14999 支付宝:15000-19999
    /**
     * redis-前缀-公共部分
     */
    const REDIS_PREFIX_COMMON = 'sy' . SY_PROJECT;
    /**
     * redis-前缀-微信公众号
     */
    const REDIS_PREFIX_WX_ACCOUNT = self::REDIS_PREFIX_COMMON . '10000_';
    /**
     * redis-前缀-微信开放平台账号
     */
    const REDIS_PREFIX_WX_COMPONENT_ACCOUNT = self::REDIS_PREFIX_COMMON . '10001_';
    /**
     * redis-前缀-微信开放平台授权公众号
     */
    const REDIS_PREFIX_WX_COMPONENT_AUTHORIZER = self::REDIS_PREFIX_COMMON . '10002_';
    /**
     * redis-前缀-微信开放平台授权小程序代码保护密钥
     */
    const REDIS_PREFIX_WX_COMPONENT_AUTHORIZER_CODE_SECRET = self::REDIS_PREFIX_COMMON . '10003_';
    /**
     * redis-前缀-企业微信
     */
    const REDIS_PREFIX_WX_CORP = self::REDIS_PREFIX_COMMON . '10100_';
    /**
     * redis-前缀-企业微信服务商账号
     */
    const REDIS_PREFIX_WX_PROVIDER_CORP_ACCOUNT = self::REDIS_PREFIX_COMMON . '10101_';
    /**
     * redis-前缀-企业微信服务商套件
     */
    const REDIS_PREFIX_WX_PROVIDER_CORP_ACCOUNT_SUITE = self::REDIS_PREFIX_COMMON . '10102_';
    /**
     * redis-前缀-服务商授权企业微信
     */
    const REDIS_PREFIX_WX_PROVIDER_CORP_AUTHORIZER = self::REDIS_PREFIX_COMMON . '10103_';

    /**
     * 微信开放平台-授权公众号状态-取消授权
     */
    const WX_COMPONENT_AUTHORIZER_STATUS_CANCEL = 0;
    /**
     * 微信开放平台-授权公众号状态-允许授权
     */
    const WX_COMPONENT_AUTHORIZER_STATUS_ALLOW = 1;
    /**
     * 微信开放平台-授权公众号操作类型-允许授权
     */
    const WX_COMPONENT_AUTHORIZER_OPTION_TYPE_AUTHORIZED = 1;
    /**
     * 微信开放平台-授权公众号操作类型-取消授权
     */
    const WX_COMPONENT_AUTHORIZER_OPTION_TYPE_UNAUTHORIZED = 2;
    /**
     * 微信开放平台-授权公众号操作类型-更新授权
     */
    const WX_COMPONENT_AUTHORIZER_OPTION_TYPE_AUTHORIZED_UPDATE = 3;

    /**
     * 企业微信服务商-企业微信状态-取消授权
     */
    const WX_PROVIDER_CORP_AUTHORIZER_STATUS_CANCEL = 0;
    /**
     * 企业微信服务商-企业微信状态-允许授权
     */
    const WX_PROVIDER_CORP_AUTHORIZER_STATUS_ALLOW = 1;
    /**
     * 企业微信服务商-企业微信操作类型-成功授权
     */
    const WX_PROVIDER_CORP_AUTHORIZER_OPTION_TYPE_AUTH_CREATE = 1;
    /**
     * 企业微信服务商-企业微信操作类型-取消授权
     */
    const WX_PROVIDER_CORP_AUTHORIZER_OPTION_TYPE_AUTH_CANCEL = 2;
    /**
     * 企业微信服务商-企业微信操作类型-变更授权
     */
    const WX_PROVIDER_CORP_AUTHORIZER_OPTION_TYPE_AUTH_CHANGE = 3;

    /**
     * 微信配置-状态-无效
     */
    const WX_CONFIG_STATUS_DISABLE = 0;
    /**
     * 微信配置-状态-有效
     */
    const WX_CONFIG_STATUS_ENABLE = 1;
    /**
     * 微信配置-第三方授权状态-不存在
     */
    const WX_CONFIG_AUTHORIZE_STATUS_EMPTY = -1;
    /**
     * 微信配置-第三方授权状态-未授权
     */
    const WX_CONFIG_AUTHORIZE_STATUS_NO = 0;
    /**
     * 微信配置-第三方授权状态-已授权
     */
    const WX_CONFIG_AUTHORIZE_STATUS_YES = 1;
    /**
     * 微信配置-企业微信状态-无效
     */
    const WX_CONFIG_CORP_STATUS_DISABLE = 0;
    /**
     * 微信配置-企业微信状态-有效
     */
    const WX_CONFIG_CORP_STATUS_ENABLE = 1;
    /**
     * 微信配置-默认客户端IP
     */
    const WX_CONFIG_DEFAULT_CLIENT_IP = '127.0.0.1';

    /**
     * 支付宝支付-状态-无效
     */
    const ALI_PAY_STATUS_DISABLE = 0;
    /**
     * 支付宝支付-状态-有效
     */
    const ALI_PAY_STATUS_ENABLE = 1;

    /**
     * 时间-超时时间-本地微信账号更新,单位为秒
     */
    const TIME_EXPIRE_LOCAL_WXACCOUNT_REFRESH = 600;
    /**
     * 时间-超时时间-本地微信账号清理,单位为秒
     */
    const TIME_EXPIRE_LOCAL_WXACCOUNT_CLEAR = 3600;
    /**
     * 时间-超时时间-本地企业微信更新,单位为秒
     */
    const TIME_EXPIRE_LOCAL_WXCORP_REFRESH = 600;
    /**
     * 时间-超时时间-本地企业微信清理,单位为秒
     */
    const TIME_EXPIRE_LOCAL_WXCORP_CLEAR = 3600;
    /**
     * 时间-超时时间-本地微信缓存清理,单位为秒
     */
    const TIME_EXPIRE_LOCAL_WXCACHE_CLEAR = 300;
    /**
     * 时间-超时时间-本地支付宝支付更新,单位为秒
     */
    const TIME_EXPIRE_LOCAL_ALIPAY_REFRESH = 600;
    /**
     * 时间-超时时间-本地支付宝支付清理,单位为秒
     */
    const TIME_EXPIRE_LOCAL_ALIPAY_CLEAR = 3600;
    /**
     * 时间-超时时间-本地贝宝支付配置更新,单位为秒
     */
    const TIME_EXPIRE_LOCAL_PAY_PAYPAL_CONFIG_REFRESH = 600;
    /**
     * 时间-超时时间-本地贝宝支付配置清理,单位为秒
     */
    const TIME_EXPIRE_LOCAL_PAY_PAYPAL_CONFIG_CLEAR = 3600;
    /**
     * 时间-超时时间-本地贝宝支付客户端更新,单位为秒
     */
    const TIME_EXPIRE_LOCAL_PAY_PAYPAL_CLIENT_REFRESH = 600;
    /**
     * 时间-超时时间-本地贝宝支付客户端清理,单位为秒
     */
    const TIME_EXPIRE_LOCAL_PAY_PAYPAL_CLIENT_CLEAR = 3600;
    /**
     * 时间-超时时间-本地银联支付全渠道配置更新,单位为秒
     */
    const TIME_EXPIRE_LOCAL_PAY_UNION_CHANNELS_REFRESH = 600;
    /**
     * 时间-超时时间-本地银联支付全渠道配置清理,单位为秒
     */
    const TIME_EXPIRE_LOCAL_PAY_UNION_CHANNELS_CLEAR = 3600;
    /**
     * 时间-超时时间-本地银联支付云闪付配置更新,单位为秒
     */
    const TIME_EXPIRE_LOCAL_PAY_UNION_QUICK_PASS_REFRESH = 600;
    /**
     * 时间-超时时间-本地银联支付云闪付配置清理,单位为秒
     */
    const TIME_EXPIRE_LOCAL_PAY_UNION_QUICK_PASS_CLEAR = 3600;

    /**
     * 正则表达式-ip地址
     */
    const REGEX_IP = '/^(\.(\d|[1-9]\d|1\d{2}|2[0-4]\d|25[0-5])){4}$/';
    /**
     * 正则表达式-邮箱
     */
    const REGEX_EMAIL = '/^\w+([-+.]\w+)*\@\w+([-.]\w+)*\.\w+([-.]\w+)*$/';
    /**
     * 正则表达式-联系方式
     */
    const REGEX_TEL = '/^((\d{3,4}\-?)?\d{7,8}|1\d{10}|\d{5})$/';
    /**
     * 正则表达式-链接地址
     */
    const REGEX_URL = '/^(http|https|ftp)\:\/\/\S+$/';
    /**
     * 正则表达式-链接地址-http
     */
    const REGEX_URL_HTTP = '/^(http|https)\:\/\/\S+$/';
    /**
     * 正则表达式-支付宝-门店电话号码
     */
    const REGEX_ALIPAY_SHOP_CONTACT = '/^[0-9\+\-]{5,15}$/';
    /**
     * 正则表达式-地区-经度
     */
    const REGEX_LOCATION_LNG = '/^[-]?(\d(\.\d+)?|[1-9]\d(\.\d+)?|1[0-7]\d(\.\d+)?|180)$/';
    /**
     * 正则表达式-地区-纬度
     */
    const REGEX_LOCATION_LAT = '/^[\-]?(\d(\.\d+)?|[1-8]\d(\.\d+)?|90)$/';
    /**
     * 正则表达式-淘宝客-pid
     */
    const REGEX_PROMOTION_TBK_PID = '/^mm(_\d{1,12}){3}$/';
    /**
     * 正则表达式-URI-yaf
     */
    const REGEX_URI_YAF = '/^\/[0-9a-zA-Z\/]*$/';
    /**
     * 正则表达式-微信-原始ID
     */
    const REGEX_WX_ORIGIN_ID = '/^[0-9a-z_]{15}$/';
    /**
     * 正则表达式-微信-openid
     */
    const REGEX_WX_OPEN_ID = '/^[0-9a-zA-Z\-\_]{28}$/';
}
