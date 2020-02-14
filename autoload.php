<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2019/11/30 0030
 * Time: 19:26
 */

define('SY_ENV', 'dev'); //环境类型,支持dev:开发环境 product:正式环境
define('SY_PROJECT', 'a01'); //项目标识,3位长度,数字和小写字母组成
define('SY_ROOT', __DIR__);
define('SY_FRAME_LIBS_ROOT', SY_ROOT . '/'); // 加载器起始加载的根目录,以/结尾

final class SyFrameLoader
{
    /**
     * @var \SyFrameLoader
     */
    private static $instance = null;
    /**
     * @var array
     */
    private $preHandleMap = [];

    private function __construct()
    {
        $this->preHandleMap = [
        ];
    }

    private function __clone()
    {
    }

    /**
     * @return \SyFrameLoader
     */
    public static function getInstance()
    {
        if (is_null(self::$instance)) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    /**
     * 加载文件
     * @param string $className 类名
     * @return bool
     */
    public function loadFile(string $className) : bool
    {
        $nameArr = explode('/', $className);
        $funcName = $this->preHandleMap[$nameArr[0]] ?? null;
        if (is_null($funcName)) {
            $nameArr = explode('_', $className);
            $funcName = $this->preHandleMap[$nameArr[0]] ?? null;
        }

        $file = is_null($funcName) ? SY_FRAME_LIBS_ROOT . $className . '.php' : $this->$funcName($className);
        if (is_file($file) && is_readable($file)) {
            require_once $file;
            return true;
        }

        return false;
    }
}

/**
 * 基础公共类自动加载
 * @param string $className 类全名
 * @return bool
 */
function syFrameAutoload(string $className)
{
    $trueName = str_replace([
        '\\',
        "\0",
    ], [
        '/',
        '',
    ], $className);
    return SyFrameLoader::getInstance()->loadFile($trueName);
}

spl_autoload_register('syFrameAutoload');