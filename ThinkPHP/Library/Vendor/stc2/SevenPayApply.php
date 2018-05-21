<?php
/**
 * Created by PhpStorm.
 * User: zhangbiao
 * Date: 2017/8/23
 * Time: 上午10:08
 */

final class SevenPayApply
{

    /**
     * 提交请求
     * $params 请求参数数组
     * * $method 请求方式
     * $sevenPaySubmitUrl 请求url
     */
    public static function buildRequest($params, $method, $sevenPaySubmitUrl)
    {
        echo "<form id=\"sevenpaysubmit\" name=\"sevenpaysubmit\" action=\"" . $sevenPaySubmitUrl
            . "\" method=\"" . $method . "\">";
        foreach ($params as $x => $x_value) {
            echo "<input type=\"hidden\" name=\"", $x, "\" value=\"", $x_value, "\"/>";
        }
        echo "<input type=\"submit\" value=\"提交\" style=\"display:none;\"></form>";
        echo "<script>document.forms['sevenpaysubmit'].submit();</script>";
    }
}
