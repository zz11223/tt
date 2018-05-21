<?php
/**
 * Created by PhpStorm.
 * User: zhangbiao
 * Date: 2017/8/22
 * Time: 上午9:45
 */
include_once "RSATool.php";
include_once  "tradeStatus.php";
$signData = $_POST["signMsg"];
$signType = $_POST["signType"];
if (strcasecmp($signType,"rsa") == 0){
    if(RSATool::rsaVerify($signData,$_POST)){
        echo "签名验证通过" . PHP_EOL;
        dealOrderRst();
    }else{
        echo "签名验证不通过" . PHP_EOL;
    }
}else{
    echo "签名方式错误，当前版本只支持RSA签名";
}
/*
 * 处理订单结果
 */
 function dealOrderRst(){

     $orderId = $_POST["mchOrderId"];
     $tradeStatus = $_POST["tradeStatus"];
     $gmtPayment = $_POST["gmtPayment"];
     $orderAmount = $_POST["orderAmount"];
     $inOrderId = $_POST["inOrderId"];
     if (strcasecmp($tradeStatus,status[3])){

         echo "商户处理订单支付结果...".PHP_EOL;
         echo "商户订单号:".$orderId.PHP_EOL;
         echo "订单交易状态:".$tradeStatus.PHP_EOL;
         echo "订单支付时间:".$gmtPayment.PHP_EOL;
         echo "订单金额:".$orderAmount.PHP_EOL;
         echo "七分钱内部订单号:".$inOrderId.PHP_EOL;
     }
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