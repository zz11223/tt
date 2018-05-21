<?php
/**
 * Created by PhpStorm.
 * User: zhangbiao
 * Date: 2017/8/21
 * Time: 下午5:28
 */
/*
支付网关接口，在商户提交订单到七分钱时和七分钱返回结果给商户时都含有签名字符串 signMsg，但两个签名字符串并无直接联系。RSA 方式是非对称的加密方式，商户提交用商户私钥证书加密，七分钱通过商户的公钥证书来签名；七分钱返回时是通过七分钱私钥证书加密，商户用七分钱公钥证书解密来验签。密钥生成参考《OPENSSL密钥工具操作手册》。
 */
final class RSATool
{
    //商户私钥
    private static $privateKeyStr = 'MIICWwIBAAKBgQCgNc8katSAoWenxJwmVJ/jQOTS9e7PAC+Rtwrevb7evSKAVLsjshlmMQ4o3+Ujq8EvLwdBxPhsPmHoLudRJu5wS542KmCdRysosP682hiveqMDDHAMeHAxKd9rsokNs0HsB0hthdjyx4ZiY5RKyBuWKsoVOoMuC85ONfF/aPFMzQIDAQABAoGAZ8eTgD6nmw9zCu1ETVwiGl7OG43t/S9coSKWKwV03+pasBCzDQNwio8aYgXu87VttbfcFpGWbt/WIkZH13zFlPge7qp2yCd1IUihqM0d3Ehqyv8KLDwaMai/hFlheh4bgyE8fWoAj2zhue1oAL6zu/I/hwtPGh3e7HePNRxKRsECQQDP/CebRi6DRZUA0HxwRsvevNacGX6OIUYE5CBZR5j19waZWPQeN0VxxnWi8jMgvfh5sLEZ93Gu0Yxy6fZ0950RAkEAxTIuDWWjOHDSX6EvQLVBW9oXtUAMSdkgRuHgX6Fynopw5bpFm8TP/m54VSnUzHqJ95VT+STGDELFf2WNxKXj/QJAYB04+GqwZ/2p5Bx0xTYSVLaTvsORVoFN6Ei8IkYSC+jCZe9TsPr93pxGFK00r3ba8vGShltxb8Zqz1gLivY64QJAYtQESoiOpcG9XVn9wZNVn0ANM7RWtEgSKhQYDDVwqU4+yJNzQV8A0sXwntXpJVWggamgPTQV4Z0xN+jghRaSzQJAbHf89sme5AzucO+ZqqvN+w4By/zRs/rx5VYacSGGIGPGXSBOppnaAYvDlJZI/b1RQBgJTGygXNQU+z6jfAaxwQ==';

    // 商户公钥
    public static $publicKeyStr = "MIGfMA0GCSqGSIb3DQEBAQUAA4GNADCBiQKBgQDztbTJs/Bl072nByJ9kUMIbQx2NQlydlSY6cFhfdsQvk4kbFJA+2oCwx4acNp/iCOAuplwm2tBxjFJC8LTwOoJSsdOIqwBtLbc4eW09h9tBXoqG2hX18D8x5tgYoj3mCTXZJFMqrxJsmWPzVEDqR7H5bqTkuJWO5tQDMNeeAsKhQIDAQAB";

    //七分钱公钥
    private static $sevenPayPublicKeyStr = "MIGfMA0GCSqGSIb3DQEBAQUAA4GNADCBiQKBgQC4G+OSs43I0Ctw7nxxuJPauTFsPyjMKkfsvYEcw4wqbn82KQWbFiSTy7P5hul4wdoZaFW5lSnHug+lyjn64t0dtCsaViOWefWrpL1gWZNpOc9gk6qNhQ0120ikHLE1SLH//gVStf+TDeVtaW+4Uzs5J7+/shdvfgU5T4+gxBk9jQIDAQAB";

    /**
     * rsa签名
     * originalStr 原始数据
     */
    public static function dataRsaSign($originalStr)
    {

        $str    = chunk_split(self::$privateKeyStr, 64, "\n");
        $pStr   = "-----BEGIN RSA PRIVATE KEY-----\n$str-----END RSA PRIVATE KEY-----\n";
        $pi_key = openssl_pkey_get_private($pStr); //这个函数可用来判断私钥是否是可用的，可用返回资源id Resource id
        openssl_sign($originalStr, $sign, $pi_key, OPENSSL_ALGO_SHA1);
        $sign = bin2hex($sign); //最终的签名
        return $sign;
    }

    /**
     * rsa验签
     * $signStr 签名数据
     */
    public static function rsaVerify($signStr, $data)
    {

        $sig = hex2bin($signStr);

        $str  = chunk_split(self::$sevenPayPublicKeyStr, 64, "\n");
        $pStr = "-----BEGIN PUBLIC KEY-----\n$str-----END PUBLIC KEY-----\n";

        $res = openssl_pkey_get_public($pStr);

        $result = openssl_verify(SevenPayHelper::createLinkstring($data), $sig, $res, OPENSSL_ALGO_SHA1);
        echo $result;
        if ($result == 1) //通过验签
        {
            return true;
        } else {
            return false;
        }

    }

}
