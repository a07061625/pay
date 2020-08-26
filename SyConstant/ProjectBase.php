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
    const REDIS_PREFIX_WX_ACCOUNT = 'sy' . SY_PROJECT . '10000_'; //前缀-微信公众号
    const REDIS_PREFIX_WX_COMPONENT_ACCOUNT = 'sy' . SY_PROJECT . '10001_'; //前缀-微信开放平台账号
    const REDIS_PREFIX_WX_COMPONENT_AUTHORIZER = 'sy' . SY_PROJECT . '10002_'; //前缀-微信开放平台授权公众号
    const REDIS_PREFIX_WX_COMPONENT_AUTHORIZER_CODE_SECRET = 'sy' . SY_PROJECT . '10003_'; //前缀-微信开放平台授权小程序代码保护密钥
    const REDIS_PREFIX_WX_CORP = 'sy' . SY_PROJECT . '10100_'; //前缀-企业微信
    const REDIS_PREFIX_WX_PROVIDER_CORP_ACCOUNT = 'sy' . SY_PROJECT . '10101_'; //前缀-企业微信服务商账号
    const REDIS_PREFIX_WX_PROVIDER_CORP_ACCOUNT_SUITE = 'sy' . SY_PROJECT . '10102_'; //前缀-企业微信服务商套件
    const REDIS_PREFIX_WX_PROVIDER_CORP_AUTHORIZER = 'sy' . SY_PROJECT . '10103_'; //前缀-服务商授权企业微信

    //微信开放平台常量
    const WX_COMPONENT_AUTHORIZER_STATUS_CANCEL = 0; //授权公众号状态-取消授权
    const WX_COMPONENT_AUTHORIZER_STATUS_ALLOW = 1; //授权公众号状态-允许授权
    const WX_COMPONENT_AUTHORIZER_OPTION_TYPE_AUTHORIZED = 1; //授权公众号操作类型-允许授权
    const WX_COMPONENT_AUTHORIZER_OPTION_TYPE_UNAUTHORIZED = 2; //授权公众号操作类型-取消授权
    const WX_COMPONENT_AUTHORIZER_OPTION_TYPE_AUTHORIZED_UPDATE = 3; //授权公众号操作类型-更新授权

    //企业微信服务商常量
    const WX_PROVIDER_CORP_AUTHORIZER_STATUS_CANCEL = 0; //企业微信状态-取消授权
    const WX_PROVIDER_CORP_AUTHORIZER_STATUS_ALLOW = 1; //企业微信状态-允许授权
    const WX_PROVIDER_CORP_AUTHORIZER_OPTION_TYPE_AUTH_CREATE = 1; //企业微信操作类型-成功授权
    const WX_PROVIDER_CORP_AUTHORIZER_OPTION_TYPE_AUTH_CANCEL = 2; //企业微信操作类型-取消授权
    const WX_PROVIDER_CORP_AUTHORIZER_OPTION_TYPE_AUTH_CHANGE = 3; //企业微信操作类型-变更授权

    //微信配置常量
    const WX_CONFIG_STATUS_DISABLE = 0; //状态-无效
    const WX_CONFIG_STATUS_ENABLE = 1; //状态-有效
    const WX_CONFIG_AUTHORIZE_STATUS_EMPTY = -1; //第三方授权状态-不存在
    const WX_CONFIG_AUTHORIZE_STATUS_NO = 0; //第三方授权状态-未授权
    const WX_CONFIG_AUTHORIZE_STATUS_YES = 1; //第三方授权状态-已授权
    const WX_CONFIG_CORP_STATUS_DISABLE = 0; //企业微信状态-无效
    const WX_CONFIG_CORP_STATUS_ENABLE = 1; //企业微信状态-有效
    const WX_CONFIG_DEFAULT_CLIENT_IP = '127.0.0.1'; //默认客户端IP

    //支付宝支付常量
    const ALI_PAY_STATUS_DISABLE = 0; //状态-无效
    const ALI_PAY_STATUS_ENABLE = 1; //状态-有效

    //时间常量
    const TIME_EXPIRE_LOCAL_WXACCOUNT_REFRESH = 600; //超时时间-本地微信账号更新,单位为秒
    const TIME_EXPIRE_LOCAL_WXACCOUNT_CLEAR = 3600; //超时时间-本地微信账号清理,单位为秒
    const TIME_EXPIRE_LOCAL_WXCORP_REFRESH = 600; //超时时间-本地企业微信更新,单位为秒
    const TIME_EXPIRE_LOCAL_WXCORP_CLEAR = 3600; //超时时间-本地企业微信清理,单位为秒
    const TIME_EXPIRE_LOCAL_WXCACHE_CLEAR = 300; //超时时间-本地微信缓存清理,单位为秒
    const TIME_EXPIRE_LOCAL_ALIPAY_REFRESH = 600; //超时时间-本地支付宝支付更新,单位为秒
    const TIME_EXPIRE_LOCAL_ALIPAY_CLEAR = 3600; //超时时间-本地支付宝支付清理,单位为秒
    const TIME_EXPIRE_LOCAL_PAY_PAYPAL_CONFIG_REFRESH = 600; //超时时间-本地贝宝支付配置更新,单位为秒
    const TIME_EXPIRE_LOCAL_PAY_PAYPAL_CONFIG_CLEAR = 3600; //超时时间-本地贝宝支付配置清理,单位为秒
    const TIME_EXPIRE_LOCAL_PAY_PAYPAL_CLIENT_REFRESH = 600; //超时时间-本地贝宝支付客户端更新,单位为秒
    const TIME_EXPIRE_LOCAL_PAY_PAYPAL_CLIENT_CLEAR = 3600; //超时时间-本地贝宝支付客户端清理,单位为秒
    const TIME_EXPIRE_LOCAL_PAY_UNION_CHANNELS_REFRESH = 600; //超时时间-本地银联支付全渠道配置更新,单位为秒
    const TIME_EXPIRE_LOCAL_PAY_UNION_CHANNELS_CLEAR = 3600; //超时时间-本地银联支付全渠道配置清理,单位为秒
    const TIME_EXPIRE_LOCAL_PAY_UNION_QUICK_PASS_REFRESH = 600; //超时时间-本地银联支付云闪付配置更新,单位为秒
    const TIME_EXPIRE_LOCAL_PAY_UNION_QUICK_PASS_CLEAR = 3600; //超时时间-本地银联支付云闪付配置清理,单位为秒
}
