<?php
/**
 * 缓存简单工厂类
 * User: jw
 * Date: 17-5-29
 * Time: 上午1:11
 */
namespace DesignPatterns\Factories;

use DesignPatterns\Singletons\RedisSingleton;
use SyTrait\SimpleTrait;

class CacheSimpleFactory
{
    use SimpleTrait;

    /**
     * 获取redis实例
     * @return \Redis
     */
    public static function getRedisInstance()
    {
        return RedisSingleton::getInstance()->getConn();
    }
}
