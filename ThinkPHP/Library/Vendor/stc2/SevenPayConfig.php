<?php
/**
 * Created by PhpStorm.
 * User: zhangbiao
 * Date: 2017/8/21
 * Time: 下午7:19
 */
/**
 * 手机H5聚合支付网页订单提交地址
 * 正式环境：https://combinedpay.qifenqian.com/gateway.do
 * 测试环境：http://zt.qifenmall.com/gateway.do
 */
define("AGGREGATEPAY_SUBMIT_H5", "http://combinedpay.qifenqian.com/gateway.do");
/**
 * PC 网页订单提交地址
 * 正式环境：https://combinedpay.qifenqian.com/gateway.do
 * 测试环境：http://zt.qifenmall.com/gateway.do
 */
define("SEVENPAY_SUBMIT_PC", "http://combinedpay.qifenqian.com/gateway.do");
/**
 * 签名方式
 */

define("SIGN_TYPE", "RSA");
/**
 * 编码格式
 */
define("INPUT_TYPE", "UTF-8");
/**
 * 一码收银
 */
define("ONECODE_COLL_PAY", "onecode.coll.pay");
/**
 * PC端收银台
 */
define("PC_GATEWAY_PAY", "pc.gateway.pay");
/**
 * 手机网页端公众号支付
 */
define("H5_GATEWAY_PAY", "h5.gateway.pay");

/**
 * 原生H5支付
 */
define("H5T_GATEWAY_PAY", "h5_t.gateway.pay");

/**
 * 手机支付插件收银台
 */
define("MOBILE_PLUGIN_PAY", "mobile.plugin.pay");
/**
 * 交易结果查询
 */
define("QUERY_ORDER_STATUS", "mch.query.orderstatus");
/**
 * 商户退款
 */
define("MCH_REFUND", "mch.refund");
/**
 * 商户转账
 */
define("MCH_TRANSFER", "mch.transfer");
