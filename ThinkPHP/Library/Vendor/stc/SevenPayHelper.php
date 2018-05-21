<?php
/**
 * Created by PhpStorm.
 * User: zhangbiao
 * Date: 2017/8/21
 * Time: 下午5:28
 */

final class SevenPayHelper
{

    /*
     *把数组所有元素，按照“参数=参数值”的模式用“&”字符拼接成字符串
     * para 数组
     */
    public static function createLinkstring($para)
    {
        $para = self::paraFilter($para);
        $para = self::argSort($para);
        $arg  = "";
        foreach ($para as $key => $value) {
            $arg .= $key . "=" . $value . "&";
        }
        //去掉最后一个&字符
        $arg = substr($arg, 0, count($arg) - 2);

        //如果存在转义字符，那么去掉转义
        if (get_magic_quotes_gpc()) {$arg = stripslashes($arg);}
        return $arg; //拼接完成以后的字符串
    }
    /**
     * 除去数组中的空值和签名参数
     * $para 签名参数组
     * $par 去掉空值与签名参数后的新签名参数组
     */
    public static function paraFilter($para)
    {

        $par = array();
        foreach ($para as $key => $value) {
            if ($key == "signMsg" || $key == "signType") {
                continue;
            }
            $par[$key] = $value;
        }
        return $par;
    }

    /**
     * 数组排序
     */
    public static function argSort($para)
    {
        ksort($para);
        reset($para);
        return $para;
    }

    /**
     * 生成随机字符串
     */
    public static function getRandChar($length)
    {
        $str    = null;
        $strPol = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789abcdefghijklmnopqrstuvwxyz";
        $max    = strlen($strPol) - 1;

        for ($i = 0; $i < $length; $i++) {
            $str .= $strPol[rand(0, $max)]; //rand($min,$max)生成介于min和max两个数之间的一个随机整数
        }

        return $str;
    }
}
