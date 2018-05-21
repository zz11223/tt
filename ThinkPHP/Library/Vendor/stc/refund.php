<?php
/**
 * Created by PhpStorm.
 * User: zhangbiao
 * Date: 2017/8/23
 * Time: 上午10:00
 *退款
*/
?>
    <!DOCTYPE html>
    <html>

    <head>
        <title>七分人民币网关退款接口</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <style>
            * { margin: 0; padding: 0; }
            ul, ol { list-style: none; }
            .title { color: #ADADAD; font-size: 14px; font-weight: bold; padding: 8px 16px 5px 10px; }
            .hidden { display: none; }
            .new-btn-login-sp { border: 1px solid #D74C00; padding: 1px; display: inline-block; }
            .new-btn-login { background-color: transparent; background-image: url("images/new-btn-fixed.png"); border: medium none; }
            .new-btn-login { background-position: 0 -198px; width: 82px; color: #FFFFFF; font-weight: bold; height: 28px; line-height: 28px; padding: 0 10px 3px; }
            .new-btn-login:hover { background-position: 0 -167px; width: 82px; color: #FFFFFF; font-weight: bold; height: 28px; line-height: 28px; padding: 0 10px 3px; }
            .bank-list { overflow: hidden; margin-top: 5px; }
            .bank-list li { float: left; width: 153px; margin-bottom: 5px; }
            #main { width: 750px; margin: 0 auto; font-size: 14px; font-family: '宋体'; }
            .red-star { color: #f00; width: 10px; display: inline-block; }
            .null-star { color: #fff; }
            .content { margin-top: 5px; }
            .content dt { width: 160px; display: inline-block; text-align: right; float: left; }
            .content dd { margin-left: 100px; margin-bottom: 5px; }
            #foot { margin-top: 10px; }
            .foot-ul li { text-align: center; }
            .note-help { color: #999999; font-size: 12px; line-height: 130%; padding-left: 3px; }
            .cashier-nav { font-size: 14px; margin: 15px 0 10px; text-align: left; height: 30px; border-bottom: solid 2px #CFD2D7; }
            .cashier-nav ol li { float: left; }
            .cashier-nav li.current { color: #AB4400; font-weight: bold; }
            .cashier-nav li.last { clear: right; }
            .sevenpay_link { text-align: right; }
            .sevenpay_link a:link { text-decoration: none; color: #8D8D8D; }
            .sevenpay_link a:visited { text-decoration: none; color: #8D8D8D; }
        </style>
    </head>

    <body text="#000000">
        <div id="main">
            <div id="head">
                <dl class="sevenpay_link">
                    <a target="_blank" href="https://www.qifenqian.com/"><span>七分钱首页</span></a>|
                    <a target="_blank" href="https://www.qifenqian.com/enterprise/login.do"><span>商家登录</span></a>|
                </dl>
                <span class="title">七分钱人民币网关退款测试demo</span>
            </div>
            <div class="cashier-nav">
                <ol>
                    <li class="current">填写退款信息 →</li>
                </ol>
            </div>
            <form name="sevenpayment" id="sevenpayment" action="sevenpayapplyh5.jsp" method="post" target="_self">
                <div id="body" style="clear:left">
                    <dl class="content">
                        <dt>七分钱商户号：</dt>
                        <dd>
                            <span class="null-star">*</span>
                            <input size="30" name="mchId" value="M9144030035873982X0" />
                            <span>必填</span>
                        </dd>
                        <dt>商户订单号：</dt>
                        <dd>
                            <span class="null-star">*</span>
                            <input size="30" name="mchOrderId" value="sgrsgrsgrgrs" />
                            <span>必填，商户网站订单系统中唯一订单号</span>
                        </dd>
                        <dt>商户退款流水号：</dt>
                        <dd>
                            <span class="null-star">*</span>
                            <input size="30" name="mchRefundId" value="afeagegaeg" />
                            <span>必填</span>
                        </dd>
                        <dt>退款金额：</dt>
                        <dd>
                            <span class="null-star">*</span>
                            <input size="30" name="refundAmt" value="0.01" />
                            <span>必填</span>
                        </dd>
                        <dt>退款描述：</dt>
                        <dd>
                            <span class="null-star">*</span>
                            <input size="30" name="refundDesc" value="买错了" />
                            <span>选填，退款简短描述</span>
                        </dd>
                        <dd>
                            <dd>
                                <dd>
                                    <dd>
                                        <button type="button" onclick="goRefund();" style="text-align:center; font-size: 20px;">确认退款</button>
                                    </dd>
                    </dl>
                </div>
            </form>
            <div id="foot">
                <br/>
                <br/>
                <br/>
                <br/>
                <br/>
                <ul class="foot-ul">
                    <li>
                        七分钱（国银证保旗下支付平台）版权所有 2015-2016
                    </li>
                </ul>
            </div>
        </div>
        <script type="text/javascript">
        function goRefund() {
            document.forms['sevenpayment'].action = "aggregaterefund.php";
            document.forms['sevenpayment'].submit();
        }
        </script>
    </body>

    </html>