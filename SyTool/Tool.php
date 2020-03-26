<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2017/3/2 0002
 * Time: 11:18
 */
namespace SyTool;

use SyConstant\ErrorCode;
use SyConstant\SyInner;
use SyException\Common\CheckException;
use SyTrait\SimpleTrait;

class Tool
{
    use SimpleTrait;

    const CURL_RSP_HEAD_TYPE_EMPTY = 0; //curl响应头类型-空
    const CURL_RSP_HEAD_TYPE_HTTP = 1; //curl响应头类型-HTTP
    private static $totalCurlRspHeadType = [
        self::CURL_RSP_HEAD_TYPE_EMPTY => 1,
        self::CURL_RSP_HEAD_TYPE_HTTP => 1,
    ];
    private static $totalChars = [
        '2', '3', '4', '5', '6', '7', '8', '9',
        'a', 'b', 'c', 'd', 'e', 'f', 'g', 'h',
        'i', 'j', 'k', 'm', 'n', 'p', 'q', 'r',
        's', 't', 'u', 'v', 'w', 'x', 'y', 'z',
        'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H',
        'I', 'J', 'K', 'L', 'M', 'N', 'P', 'Q',
        'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y',
        'Z',
    ];
    private static $lowerChars = [
        'a', 'b', 'c', 'd', 'e', 'f', 'g', 'h',
        'i', 'j', 'k', 'm', 'n', 'p', 'q', 'r',
        's', 't', 'u', 'v', 'w', 'x', 'y', 'z',
    ];
    private static $numLowerChars = [
        '2', '3', '4', '5', '6', '7', '8', '9',
        'a', 'b', 'c', 'd', 'e', 'f', 'g', 'h',
        'i', 'j', 'k', 'm', 'n', 'p', 'q', 'r',
        's', 't', 'u', 'v', 'w', 'x', 'y', 'z',
    ];

    /**
     * 获取数组值
     * @param array $array 数组
     * @param string|int $key 键值
     * @param object $default 默认值
     * @param bool $isRecursion 是否递归查找,false:不递归 true:递归
     * @return mixed
     */
    public static function getArrayVal(array $array, $key, $default = null, bool $isRecursion = false)
    {
        if (!$isRecursion) {
            return $array[$key] ?? $default;
        }

        $keyArr = explode('.', (string)$key);
        $tempData = $array;
        unset($array);
        foreach ($keyArr as $eKey) {
            if (is_array($tempData) && isset($tempData[$eKey])) {
                $tempData = $tempData[$eKey];
            } else {
                return $default;
            }
        }

        return $tempData;
    }

    /**
     * 获取配置信息
     * @param string $tag 配置标识
     * @param string $field 字段名称
     * @param mixed $default 默认值
     * @return mixed
     */
    public static function getConfig(string $tag, string $field = '', $default = null)
    {
        $configs = \Yaconf::get($tag);
        if (is_null($configs)) {
            return $default;
        } elseif (is_array($configs) && (strlen($field) > 0)) {
            return self::getArrayVal($configs, $field, $default);
        } else {
            return $configs;
        }
    }

    /**
     * array转xml
     * @param array $dataArr
     * @param int $transferType 转换类型
     * @return string
     * @throws \SyException\Common\CheckException
     */
    public static function arrayToXml(array $dataArr, int $transferType = 1) : string
    {
        if (count($dataArr) == 0) {
            throw new CheckException('数组为空', ErrorCode::COMMON_PARAM_ERROR);
        }

        $xml = '';
        if ($transferType == 1) {
            $xml .= '<xml>';
            foreach ($dataArr as $key => $value) {
                if (is_numeric($value)) {
                    $xml .= '<' . $key . '>' . $value . '</' . $key . '>';
                } else {
                    $xml .= '<' . $key . '><![CDATA[' . $value . ']]></' . $key . '>';
                }
            }
            $xml .= '</xml>';
        } elseif ($transferType == 2) {
            foreach ($dataArr as $key => $value) {
                $xml .= '<' . $key . '>' . $value . '</' . $key . '>';
            }
        } else {
            foreach ($dataArr as $key => $value) {
                $xml .= '<' . $key . '><![CDATA[' . $value . ']]></' . $key . '>';
            }
        }

        return $xml;
    }

    /**
     * xml转为array
     * @param string $xml
     * @return array
     * @throws \SyException\Common\CheckException
     */
    public static function xmlToArray(string $xml)
    {
        if (strlen($xml) == 0) {
            throw new CheckException('xml数据异常', ErrorCode::COMMON_PARAM_ERROR);
        }

        $element = simplexml_load_string($xml, 'SimpleXMLElement', LIBXML_NOCDATA);
        $jsonStr = self::jsonEncode($element);

        return self::jsonDecode($jsonStr);
    }

    /**
     * RSA签名
     * @param string $data 待签名数据
     * @param string $priKeyContent 私钥文件内容
     * @return string 签名结果
     */
    public static function rsaSign(string $data, string $priKeyContent) : string
    {
        $priKey = openssl_get_privatekey($priKeyContent);
        openssl_sign($data, $sign, $priKey);
        openssl_free_key($priKey);

        return base64_encode($sign);
    }

    /**
     * RSA验签
     * @param string $data 待签名数据
     * @param string $pubKeyContent 公钥文件内容
     * @param string $sign 要校对的的签名结果
     * @return boolean 验证结果
     */
    public static function rsaVerify(string $data, string $pubKeyContent, string $sign) : bool
    {
        $pubKey = openssl_get_publickey($pubKeyContent);
        $result = (boolean)openssl_verify($data, base64_decode($sign, true), $pubKey);
        openssl_free_key($pubKey);

        return $result;
    }

    /**
     * RSA加密
     * @param string $data 待加密数据
     * @param string $keyContent 密钥文件内容,根据模式不同设置公钥或私钥
     * @param int $mode 模式 0:公钥加密 1:私钥加密
     * @return string
     */
    public static function rsaEncrypt(string $data, string $keyContent, int $mode = 0)
    {
        $dataArr = str_split($data, 117);
        $encryptArr = [];
        if ($mode == 0) { //公钥加密
            $key = openssl_get_publickey($keyContent);
            foreach ($dataArr as $eData) {
                $eEncrypt = '';
                openssl_public_encrypt($eData, $eEncrypt, $key);
                $encryptArr[] = $eEncrypt;
            }
        } else { //私钥加密
            $key = openssl_get_privatekey($keyContent);
            foreach ($dataArr as $eData) {
                $eEncrypt = '';
                openssl_private_encrypt($eData, $eEncrypt, $key);
                $encryptArr[] = $eEncrypt;
            }
        }
        openssl_free_key($key);

        return base64_encode(implode('', $encryptArr));
    }

    /**
     * RSA解密
     * @param string $data 待解密数据
     * @param string $keyContent 密钥文件内容,根据模式不同设置公钥或私钥
     * @param int $mode 模式 0:私钥解密 1:公钥解密
     * @return string
     */
    public static function rsaDecrypt(string $data, string $keyContent, int $mode = 0)
    {
        $decryptStr = '';
        $encryptData = base64_decode($data, true);
        $length = strlen($encryptData) / 128;
        if ($mode == 0) { //私钥解密
            $key = openssl_get_privatekey($keyContent);
            for ($i = 0; $i < $length; $i ++) {
                $eDecrypt = '';
                $eEncrypt = substr($encryptData, $i * 128, 128);
                openssl_private_decrypt($eEncrypt, $eDecrypt, $key);
                $decryptStr .= $eDecrypt;
            }
        } else { //公钥解密
            $key = openssl_get_publickey($keyContent);
            for ($i = 0; $i < $length; $i ++) {
                $eDecrypt = '';
                $eEncrypt = substr($encryptData, $i * 128, 128);
                openssl_public_decrypt($eEncrypt, $eDecrypt, $key);
                $decryptStr .= $eDecrypt;
            }
        }
        openssl_free_key($key);

        return $decryptStr;
    }

    /**
     * 把数组转移成json字符串
     * @param array|object $arr
     * @param int|string $options
     * @return bool|string
     */
    public static function jsonEncode($arr, $options = JSON_OBJECT_AS_ARRAY)
    {
        if (is_array($arr) || is_object($arr)) {
            return json_encode($arr, $options);
        }

        return false;
    }

    /**
     * 解析json
     * @param string $json
     * @param int|string $assoc
     * @return bool|mixed
     */
    public static function jsonDecode($json, $assoc = JSON_OBJECT_AS_ARRAY)
    {
        if (is_string($json)) {
            return json_decode($json, $assoc);
        }

        return false;
    }

    /**
     * 生成随机字符串
     * @param int $length 需要获取的随机字符串长度
     * @param string $dataType 数据类型
     *   total: 数字,大小写字母
     *   lower: 小写字母
     *   numlower: 数字,小写字母
     * @return string
     */
    public static function createNonceStr(int $length, string $dataType = 'total') : string
    {
        $resStr = '';
        switch ($dataType) {
            case 'lower':
                for ($i = 0; $i < $length; $i ++) {
                    $resStr .= self::$lowerChars[random_int(0, 23)];
                }
                break;
            case 'numlower':
                for ($i = 0; $i < $length; $i ++) {
                    $resStr .= self::$numLowerChars[random_int(0, 31)];
                }
                break;
            default:
                for ($i = 0; $i < $length; $i ++) {
                    $resStr .= self::$totalChars[random_int(0, 56)];
                }
        }

        return $resStr;
    }

    /**
     * 发送curl请求
     * @param array $configs 配置数组
     * @param int $rspHeaderType 响应头类型
     * @return array
     * @throws \SyException\Common\CheckException
     */
    public static function sendCurlReq(array $configs, int $rspHeaderType = self::CURL_RSP_HEAD_TYPE_EMPTY)
    {
        if (!isset(self::$totalCurlRspHeadType[$rspHeaderType])) {
            throw new CheckException('响应头类型不支持', ErrorCode::COMMON_PARAM_ERROR);
        }

        $url = $configs[CURLOPT_URL] ?? '';
        if ((!is_string($url)) || (strlen($url) == 0)) {
            throw new CheckException('请求地址不能为空', ErrorCode::COMMON_PARAM_ERROR);
        }

        $ch = curl_init();
        foreach ($configs as $configKey => $configVal) {
            curl_setopt($ch, $configKey, $configVal);
        }

        $resArr = [
            'res_no' => 0,
            'res_msg' => '',
            'res_content' => '',
        ];

        if ($rspHeaderType == self::CURL_RSP_HEAD_TYPE_EMPTY) {
            curl_setopt($ch, CURLOPT_HEADER, false);
            $resArr['res_content'] = curl_exec($ch);
            $resArr['res_no'] = curl_errno($ch);
            $resArr['res_msg'] = curl_error($ch);
        } elseif ($rspHeaderType == self::CURL_RSP_HEAD_TYPE_HTTP) {
            curl_setopt($ch, CURLOPT_HEADER, true);
            $rspContent = curl_exec($ch);
            $resArr['res_no'] = curl_errno($ch);
            $resArr['res_msg'] = curl_error($ch);
            if ($resArr['res_no'] == 0) {
                $headSize = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
                $resArr['res_code'] = curl_getinfo($ch, CURLINFO_HTTP_CODE);
                $resArr['res_content'] = substr($rspContent, $headSize);
                $resArr['res_header'] = [];

                $headerStr = substr($rspContent, 0, $headSize);
                $headerArr = explode("\r\n", $headerStr);
                unset($headerArr[0]);
                foreach ($headerArr as $eHeader) {
                    $pos = strpos($eHeader, ':');
                    if ($pos > 0) {
                        $headerKey = trim(substr($eHeader, 0, $pos));
                        if (!isset($resArr['res_header'][$headerKey])) {
                            $resArr['res_header'][$headerKey] = [];
                        }
                        $resArr['res_header'][$headerKey][] = trim(substr($eHeader, ($pos + 1)));
                    }
                }
                unset($headerArr);
            }
        }
        curl_close($ch);

        return $resArr;
    }

    /**
     * 获取当前时间戳
     * @return int
     */
    public static function getNowTime()
    {
        return $_SERVER[SyInner::SERVER_DATA_KEY_TIMESTAMP] ?? time();
    }

    /**
     * 填充补位需要加密的明文
     * @param string $text 需要加密的明文
     * @return string
     */
    public static function pkcs7Encode(string $text) : string
    {
        $blockSize = 32;
        $textLength = strlen($text);
        //计算需要填充的位数
        $addLength = $blockSize - ($textLength % $blockSize);
        if ($addLength == 0) {
            $addLength = $blockSize;
        }

        //获得补位所用的字符
        $needChr = chr($addLength);
        $tmp = '';
        for ($i = 0; $i < $addLength; $i ++) {
            $tmp .= $needChr;
        }

        return $text . $tmp;
    }

    /**
     * 补位删除解密后的明文
     * @param string $text 解密后的明文
     * @return string
     */
    public static function pkcs7Decode(string $text) : string
    {
        $pad = ord(substr($text, - 1));
        if (($pad < 1) || ($pad > 32)) {
            $pad = 0;
        }

        return substr($text, 0, (strlen($text) - $pad));
    }
}
