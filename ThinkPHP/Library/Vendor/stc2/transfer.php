<?php
/**
 * Created by PhpStorm.
 * User: zhangbiao
 * Date: 2017/8/23
 * Time: 上午10:35
 * 转帐
 */

include_once "SevenPayConfig.php";
include_once "SevenPayHelper.php";
include_once "RSATool.php";
include_once "SevenPayApply.php";

$params = array();
$params["mchId"] = "M9144030035873982X0";
//$params["orderId"] = $_POST["outOrderId"];
//这里为了测试方便，随机生成，其实应该用$_POST["outOrderId"]
$params["orderId"] = SevenPayHelper::getRandChar(10);
$params["inputCharset"] = INPUT_TYPE;
$params["tradeAmt"] = $_POST["orderAmount"];
if(date_default_timezone_get() != "Asia/Shanghai") {
    date_default_timezone_set("Asia/Shanghai");
}
$params["orderTime"] = date("YmdHis");
$params["txDesc"] = $_POST["prodDesc"];
$params["orderTimeOut"] = "3600";
$params["version"] = "v1.0";
$params["payeeBussId"] = $_POST["custId"];
$params["service"] = MCH_TRANSFER;
$params["signMsg"] = RSATool::dataRsaSign(SevenPayHelper::createLinkstring($params));
$params["signType"] = "RSA";
SevenPayApply::buildRequest($params,"post",AGGREGATEPAY_SUBMIT_H5);