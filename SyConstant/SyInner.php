<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2017/3/12 0012
 * Time: 9:30
 */
namespace SyConstant;

use SyTrait\SimpleTrait;

final class SyInner
{
    use SimpleTrait;

    const SERVER_DATA_KEY_TIMESTAMP = 'SYREQ_TIME'; //服务端内部数据键名-请求时间戳
}
