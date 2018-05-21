<?php
/**
 * Created by PhpStorm.
 * User: zhangbiao
 * Date: 2017/8/23
 * Time: 上午10:03
 * 退款
 */
include_once "SevenPayConfig.php";
include_once "SevenPayHelper.php";
include_once "RSATool.php";
include_once "SevenPayApply.php";

$params = array();
$params["mchId"] = $_POST["mchId"];
$params["mchOrderId"] = $_POST["mchOrderId"];
$params["mchRefundId"] = $_POST["mchRefundId"];
$params["refundAmt"] = $_POST["refundAmt"];
$params["refundDesc"] = $_POST["refundDesc"];
$params["service"] = MCH_REFUND;

$params["signMsg"] = RSATool::dataRsaSign(SevenPayHelper::createLinkstring($params));
$params["signType"] = "RSA";
SevenPayApply::buildRequest($params,"post",AGGREGATEPAY_SUBMIT_H5);