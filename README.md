# 介绍
- 微信服务端接口集成,支持公众号,小程序,企业微信,第三方开放平台
- 支付宝接口集成,支持商户号

# 环境
## 必要
- PHP: 7.0.0+
- redis扩展: 5.0.0+
- yaconf扩展: 1.0.0+

## 可选
- seaslog扩展: 1.9.0+

# 使用
## 配置修改
1. 将configs/php.ini的配置复制到php环境的ini配置中,如果安装seaslog则复制seaslog块的配置,否则无需seaslog块配置
2. 将configs/caches.ini,configs/wx.ini配置文件复制到php.ini配置的yaconf配置目录下并根据自己情况修改相应的配置

## 代码修改
- 根据需要修改autoload.php并保证该文件被初始化,或者将该文件的内容放到框架的初始化里面去
- 日志用的是seaslog,如果要替换,请参考现有SyLog\Log.php文件自行替换,最好不要改函数名和参数,改内部实现即可
- 修改DesignPatterns\Singletons\RedisSingleton.php的init方法,自己设置redis相关配置
- 微信第三方开放平台配置修改DesignPatterns\Singletons\WxConfigSingleton.php的getOpenCommonConfig方法,自己设置相关配置
- 企业微信服务商配置修改DesignPatterns\Singletons\WxConfigSingleton.php的getCorpProviderConfig方法,自己设置相关配置
- 微信公众号,小程序配置修改SyTrait\WxConfigTrait.php的refreshAccountConfig方法,参考现有的代码替换掉
- 企业微信配置修改SyTrait\WxConfigTrait.php的refreshCorpConfig方法,参考现有的代码替换掉
- 已经集成的微信接口,请看Wx\README.md文件
- 支付宝商户配置修改SyTrait\AliPayConfigTrait.php的refreshPayConfig方法,参考现有的代码替换掉
- 已经集成的支付宝接口,请看AliPay\README.md文件
- 如有疑问,请联系QQ: 837483732
- 由于时间比较久,部分接口没有写上注释,可以通过在IDE中搜索相关的请求地址来查找对应的接口是否已经集成

## 调用
### 微信
    $orderRefund = new \Wx\Payment\Way\OrderRefund('111111');
    $orderRefund->setOutTradeNo('xxx');
    //其他相关设置请参考类的实现
    $res = $orderRefund->getDetail();
    var_dump($res);
### 支付宝
    $pay = new \AliPay\Pay\PayWap('111111');
    $pay->setSubject('红富士苹果');
    //其他相关设置请参考类的实现
    $res = \AliPay\AliPayUtilBase::sendServiceRequest($pay);
    var_dump($res);
