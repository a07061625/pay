<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2017/3/2 0002
 * Time: 11:22
 */
namespace SyConstant;

use SyTrait\SimpleTrait;

class ErrorCode
{
    use SimpleTrait;

    //公共错误,取值范围:10000-99999
    const COMMON_SUCCESS = 0;
    const COMMON_MIN_NUM = 10000;
    const COMMON_PARAM_ERROR = 10000;
    const COMMON_SERVER_ERROR = 10500;
    const COMMON_SERVER_EXCEPTION = 10501;
    const COMMON_SERVER_FATAL = 10502;
    const COMMON_SERVER_RESOURCE_NOT_EXIST = 10503;
    const COMMON_SERVER_BUSY = 10504;
    const COMMON_SERVER_TOKEN_EXPIRE = 10505;
    const COMMON_ROUTE_MODULE_NOT_ACCEPT = 11000;
    const COMMON_ROUTE_URI_FORMAT_ERROR = 11001;
    const COMMON_ROUTE_CONTROLLER_NOT_EXIST = 11002;
    const COMMON_ROUTE_ACTION_NOT_EXIST = 11003;

    //REDIS错误,取值范围:100600-100799
    const REDIS_CONNECTION_ERROR = 100600;
    const REDIS_AUTH_ERROR = 100601;

    //微信错误,取值范围:101400-101599
    const WX_PARAM_ERROR = 101400;
    const WX_POST_ERROR = 101401;
    const WX_GET_ERROR = 101402;

    //微信开放平台错误,取值范围:101600-101799
    const WXOPEN_PARAM_ERROR = 101600;
    const WXOPEN_POST_ERROR = 101601;
    const WXOPEN_GET_ERROR = 101602;

    //微信服务商错误,取值范围:104700-104899
    const WXPROVIDER_CORP_PARAM_ERROR = 104700;
    const WXPROVIDER_CORP_POST_ERROR = 104701;
    const WXPROVIDER_CORP_GET_ERROR = 104702;

    protected static $msgArr = [
        self::COMMON_SUCCESS => '成功',
        self::COMMON_PARAM_ERROR => '参数错误',
        self::COMMON_SERVER_ERROR => '服务出错',
        self::COMMON_SERVER_EXCEPTION => '服务出错',
        self::COMMON_SERVER_FATAL => '服务出错',
        self::COMMON_SERVER_RESOURCE_NOT_EXIST => '资源不存在',
        self::COMMON_SERVER_BUSY => '服务繁忙',
        self::COMMON_SERVER_TOKEN_EXPIRE => '令牌已过期',
        self::COMMON_ROUTE_MODULE_NOT_ACCEPT => '模块不支持',
        self::COMMON_ROUTE_URI_FORMAT_ERROR => '路由格式错误',
        self::COMMON_ROUTE_CONTROLLER_NOT_EXIST => '控制器不存在',
        self::COMMON_ROUTE_ACTION_NOT_EXIST => '方法不存在',
        self::REDIS_CONNECTION_ERROR => 'REDIS连接出错',
        self::REDIS_AUTH_ERROR => 'REDIS鉴权失败',
        self::WX_PARAM_ERROR => '微信参数错误',
        self::WX_POST_ERROR => '微信发送POST请求出错',
        self::WX_GET_ERROR => '微信发送GET请求出错',
        self::WXOPEN_PARAM_ERROR => '微信开放平台参数错误',
        self::WXOPEN_POST_ERROR => '微信开放平台发送POST请求出错',
        self::WXOPEN_GET_ERROR => '微信开放平台发送GET请求出错',
        self::WXPROVIDER_CORP_PARAM_ERROR => '企业微信服务商参数错误',
        self::WXPROVIDER_CORP_POST_ERROR => '企业微信服务商发送POST请求出错',
        self::WXPROVIDER_CORP_GET_ERROR => '企业微信服务商发送GET请求出错',
    ];

    /**
     * 获取错误信息
     * @param int $errorCode 错误码
     * @return mixed|string
     */
    public static function getMsg(int $errorCode)
    {
        return self::$msgArr[$errorCode] ?? '';
    }
}
