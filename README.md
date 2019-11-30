# 介绍
微信服务端接口集成,支持公众号,小程序,企业微信,第三方开放平台

# 使用
## 配置
- 根据需要修改autoload.php并保证该文件被初始化,或者将该文件的内容放到框架的初始化里面去
- 日志用的是seaslog,如果要替换,请参考现有Log\Log.php文件自行替换,最好不要改函数名和参数,改内部实现即可
- 修改DesignPatterns\Singletons\RedisSingleton.php的init方法,自己设置redis相关配置
- 第三方开放平台配置修改DesignPatterns\Singletons\WxConfigSingleton.php的getOpenCommonConfig方法,自己设置相关配置
- 企业微信服务商配置修改DesignPatterns\Singletons\WxConfigSingleton.php的getCorpProviderConfig方法,自己设置相关配置
- 公众号,小程序配置修改SyTrait\WxConfigTrait.php的refreshAccountConfig方法,参考现有的代码替换掉,证书相关设置要去掉证书文件中----包含的部分
- 企业微信配置修改SyTrait\WxConfigTrait.php的refreshCorpConfig方法,参考现有的代码替换掉,证书相关设置要去掉证书文件中----包含的部分
- 已经集成的微信接口,请看Wx\README.md文件
- 如有疑问,请联系QQ: 837483732

## 调用
    $orderRefund = new \Wx\Shop\Pay\OrderRefund('1111');
    $orderRefund->setOutTradeNo('xxx');
    //其他相关设置请参考类的实现
    $res = $orderRefund->getDetail();
    var_dump($res);