# 介绍
- 微信服务端接口集成,支持公众号,小程序,企业微信,第三方开放平台
- 支付宝接口集成,支持商户号
- 银联支付接口集成,目前支持全渠道

# 环境
## 必要
- PHP: 7.0.0+
- redis扩展: 5.0.0+
- yaconf扩展: 1.0.0+

## 可选
- seaslog扩展: 1.9.0+

# 配置
## 环境
本项目使用了yaconf作为配置管理,redis作为缓存,seaslog作为日志工具,因此php环境需要按照这三个扩展,如需替换成其他工具,请自行参考对应工具的使用方式对照替换

### php7
1. 复制configs/php.ini的内容到服务器php环境配置文件中
2. 修改yaconf.directory配置为服务器配置文件全路径地址
3. 修改seaslog.default_basepath配置为服务器日志文件全路径地址

### redis
    cp configs/caches.ini /path/to/yaconf //yaconf地址为php环境配置中yaconf.directory配置项的值
    修改caches.ini文件相关配置

### 微信
    cp configs/wx.ini /path/to/yaconf //yaconf地址为php环境配置中yaconf.directory配置项的值
    修改wx.ini文件相关配置

## 项目
### 微信
#### 第三方开放平台
修改DesignPatterns\Singletons\WxConfigSingleton.php的getOpenCommonConfig方法,自己设置相关配置
#### 企业微信服务商
修改DesignPatterns\Singletons\WxConfigSingleton.php的getCorpProviderConfig方法,自己设置相关配置
#### 公众号,小程序
修改SyTrait\WxConfigTrait.php的refreshAccountConfig方法,参考现有的代码替换掉
#### 企业微信
修改SyTrait\WxConfigTrait.php的refreshCorpConfig方法,参考现有的代码替换掉

### 支付宝
#### 商户号
修改SyTrait\AliPayConfigTrait.php的refreshPayConfig方法,参考现有的代码替换掉

### 银联支付
#### 全渠道
修改SyTrait\PayConfigTrait.php的refreshUnionChannelsConfig方法,参考现有的代码替换掉

# 使用
## ***要求(必须完成)***
- 根据需要修改autoload.php并保证该文件被初始化,建议该步骤放到框架的初始化流程(bootstrap)里面
- 日志组件如需替换成其他方式,请参考现有SyLog\Log.php文件自行替换,最好不要改函数名和参数,改内部实现即可
- 如需修改redis缓存,请参考DesignPatterns\Singletons\RedisSingleton.php的init方法实现自行修改

## 支付方式
### 微信
#### 说明
- 已完成的接口,请看Wx\README.md文件
#### 使用样例
    $orderRefund = new \Wx\Payment\Way\OrderRefund('111111');
    $orderRefund->setOutTradeNo('xxx');
    //其他相关设置请参考类的实现
    $res = $orderRefund->getDetail();
    var_dump($res);

### 支付宝
#### 说明
- 已完成的接口,请看AliPay\README.md文件
#### 使用样例
    $pay = new \AliPay\Pay\PayWap('111111');
    $pay->setSubject('红富士苹果');
    //其他相关设置请参考类的实现
    $res = \AliPay\AliPayUtilBase::sendServiceRequest($pay);
    var_dump($res);

### 银联支付
#### 说明
- 已完成的接口,请看SyPay\Union\README.md文件
#### 使用样例
    $obj = new \SyPay\Union\Channels\Wap\Consume('111111', \SyPay\BaseUnion::ENV_TYPE_PRODUCT);
    $obj->setOrderId('123456');;
    //其他相关设置请参考类的实现
    $res = \SyPay\UtilUnionChannels::sendServerRequest($obj);
    var_dump($res);

# 备注
- 如有疑问,请联系QQ: 837483732
- 由于时间比较久,部分接口没有写上注释,可以通过在IDE中搜索相关的请求地址来查找对应的接口是否已经集成
