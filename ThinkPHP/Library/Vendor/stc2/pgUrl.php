<?php
/**
 * Created by PhpStorm.
 * User: zhangbiao
 * Date: 2017/8/22
 * Time: 上午9:45
 */
include_once "SevenPayHelper.php";
include_once "RSATool.php";
$signData = $_GET["signMsg"];
$signType = $_GET["signType"];
if (strcasecmp($signType,"rsa") == 0){
    if(RSATool::rsaVerify($signData,$_GET)){
        // 此处应是商户自行设计的交易返回页面，以下输出结果仅供参考
        echo "签名验证通过" . PHP_EOL;
    }else{
        // 此处应是商户自行设计的交易返回页面，以下输出结果仅供参考
        echo "签名验证不通过" . PHP_EOL;
    }
}else{
    echo "签名方式错误，当前版本只支持RSA签名";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>七分钱页面跳转同步通知页面</title>
</head>
<body>

</body>