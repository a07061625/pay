<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2018/9/11 0011
 * Time: 9:00
 */
namespace Wx;

use SyConstant\Project;
use DesignPatterns\Factories\CacheSimpleFactory;
use Tool\Tool;
use SyTrait\SimpleTrait;
use Wx\Alone\AccessToken;
use Wx\Alone\JsTicket;

abstract class WxUtilBaseAlone extends WxUtilBase
{
    use SimpleTrait;

    /**
     * 获取access token
     * @param string $appId
     * @return string
     */
    public static function getAccessToken(string $appId) : string
    {
        $nowTime = Tool::getNowTime();
        $redisKey = Project::REDIS_PREFIX_WX_ACCOUNT . $appId;
        $redisData = CacheSimpleFactory::getRedisInstance()->hGetAll($redisKey);
        if (isset($redisData['at_key']) && ($redisData['at_key'] == $redisKey) && ($redisData['at_expire'] >= $nowTime)) {
            return $redisData['at_content'];
        }

        $accessTokenObj = new AccessToken($appId);
        $accessTokenDetail = $accessTokenObj->getDetail();

        $expireTime = (int)($nowTime + $accessTokenDetail['expires_in'] - 10);
        CacheSimpleFactory::getRedisInstance()->hMset($redisKey, [
            'at_content' => $accessTokenDetail['access_token'],
            'at_expire' => $expireTime,
            'at_key' => $redisKey,
        ]);
        CacheSimpleFactory::getRedisInstance()->expire($redisKey, 8000);

        return $accessTokenDetail['access_token'];
    }

    /**
     * 获取js ticket
     * @param string $appId
     * @return string
     */
    public static function getJsTicket(string $appId) : string
    {
        $nowTime = Tool::getNowTime();
        $redisKey = Project::REDIS_PREFIX_WX_ACCOUNT . $appId;
        $redisData = CacheSimpleFactory::getRedisInstance()->hGetAll($redisKey);
        if (isset($redisData['jt_key']) && ($redisData['jt_key'] == $redisKey) && ($redisData['jt_expire'] >= $nowTime)) {
            return $redisData['jt_content'];
        }

        $accessToken = self::getAccessToken($appId);
        $jsTicketObj = new JsTicket();
        $jsTicketObj->setAccessToken($accessToken);
        $jsTicketDetail = $jsTicketObj->getDetail();

        $expireTime = (int)($nowTime + $jsTicketDetail['expires_in'] - 10);
        CacheSimpleFactory::getRedisInstance()->hMset($redisKey, [
            'jt_content' => $jsTicketDetail['ticket'],
            'jt_expire' => $expireTime,
            'jt_key' => $redisKey,
        ]);
        CacheSimpleFactory::getRedisInstance()->expire($redisKey, 8000);

        return $jsTicketDetail['ticket'];
    }

    /**
     * 获取卡券ticket
     * @param string $appId
     * @return string
     */
    public static function getCardTicket(string $appId) : string
    {
        $nowTime = Tool::getNowTime();
        $redisKey = Project::REDIS_PREFIX_WX_ACCOUNT . $appId;
        $redisData = CacheSimpleFactory::getRedisInstance()->hGetAll($redisKey);
        if (isset($redisData['ct_key']) && ($redisData['ct_key'] == $redisKey) && ($redisData['ct_expire'] >= $nowTime)) {
            return $redisData['ct_content'];
        }

        $accessToken = self::getAccessToken($appId);
        $jsTicketObj = new JsTicket();
        $jsTicketObj->setAccessToken($accessToken);
        $jsTicketObj->setType('wx_card');
        $jsTicketDetail = $jsTicketObj->getDetail();

        $expireTime = (int)($nowTime + $jsTicketDetail['expires_in'] - 10);
        CacheSimpleFactory::getRedisInstance()->hMset($redisKey, [
            'ct_content' => $jsTicketDetail['ticket'],
            'ct_expire' => $expireTime,
            'ct_key' => $redisKey,
        ]);
        CacheSimpleFactory::getRedisInstance()->expire($redisKey, 8000);

        return $jsTicketDetail['ticket'];
    }
}
