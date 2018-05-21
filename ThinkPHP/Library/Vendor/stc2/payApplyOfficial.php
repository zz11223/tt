<?php
/**
 * Created by PhpStorm.
 * User: zhangbiao
 * Date: 2017/8/18
 * Time: 下午6:21
 */
include_once "RSATool.php";
include_once "SevenPayConfig.php";
include_once "SevenPayHelper.php";
include_once "SevenPayApply.php";

SevenPayApply::buildRequest(SevenPayApplyh5::buildParams(), "post", AGGREGATEPAY_SUBMIT_H5);

final class SevenPayApplyh5
{
    public static function buildParams()
    {
        $params = array();
        //$params["mchOrderId"] = $_POST["mchOrderId"];
        //这里为了测试方便，随机生成，其实应该用$_POST["mchOrderId"]
        $params["mchOrderId"]   = SevenPayHelper::getRandChar(10);
        $params["mchId"]        = $_POST["mchId"];
        $params["orderAmt"]     = $_POST["orderAmount"];
        $params["prodName"]     = $_POST["prodName"];
        $params["prodDesc"]     = $_POST["prodDesc"];
        $params["version"]      = "v1.0";
        $params["pageLanguage"] = "1";
        $params["inputCharset"] = INPUT_TYPE;
        $params["pgUrl"]        = "http://www.wowlothar.cn/STC_PRO/pgUrl.php"; // 订单完成后返回的商户页面地址
        $params["bgUrl"]        = "http://www.wowlothar.cn/STC_PRO/bgUrl.php"; // 订单完成后回调商户后台通知地址
        $params["payType"]      = "1";
        $params["orderTimeOut"] = "3600";
        $params["service"]      = H5_GATEWAY_PAY;
        $params["channel"]      = $_POST["channel"];
        if (date_default_timezone_get() != "Asia/Shanghai") {
            date_default_timezone_set("Asia/Shanghai");
        }
        $params["orderTimestamp"] = date("YmdHis");

        $params["signMsg"] = RSATool::dataRsaSign(SevenPayHelper::createLinkstring($params));

        $params["signType"] = SIGN_TYPE;
        return $params;
    }
}
