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
    <title>七分人民币网关支付接口</title>
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
        <span class="title">七分钱人民币网关交易测试demo</span>
    </div>
    <div class="cashier-nav">
        <ol>
            <li class="current">1、模拟用户下单，生成订单信息 →</li>
            <li>2、确认订单（选择七分钱付款） →</li>
            <li class="last">3、跳转七分钱支付</li>
        </ol>
    </div>
    <form name="sevenpayment" id="sevenpayment" action="sevenpayapplyh5.jsp" method="post" target="_self">
        <div id="body" style="clear:left">
            <dl class="content">
                <dt>七分钱商户号：</dt>
                <dd>
                    <span class="null-star">*</span>
                    <input size="30" name="mchId"  value="C2018041900172"/>
                    <span>必填</span>
                </dd>
                <dt>商户订单号：</dt>
                <dd>
                    <span class="null-star">*</span>
                    <input size="30" name="mchOrderId"  value="order_sn201804264321"/>
                    <span>必填，商户网站订单系统中唯一订单号</span>
                </dd>
                <dt>订单名称：</dt>
                <dd>
                    <span class="null-star">*</span>
                    <input size="30" name="prodName"  value="测试"/>
                    <span>必填</span>
                </dd>
                <dt>付款金额：</dt>
                <dd>
                    <span class="null-star">*</span>
                    <input size="30" name="orderAmount"  value="0.01"/>
                    <span>必填</span>
                </dd>
                <dt>订单描述：</dt>
                <dd>
                    <span class="null-star">*</span>
                    <input size="30" name="prodDesc"  value="万达影城电影票"/>
                    <span>选填，订单信息的简短描述</span>
                </dd>
                <dd>
                    <br/>
                    <button type="button" onclick="goPcPay();" style="text-align:center; font-size: 20px;">[调用PC端网页收银台]</button>
                </dd>

                <br>
                <dd>
                    <span>以下功能测试时请在手机浏览器中打开，否则会出现兼容性问题</span>
                </dd>
                <dd>
                    <button type="button" onclick="goAggregateOfficialPay('');" style="text-align:center; font-size: 20px;">[调用公众号支付收银台]</button>
                </dd>
                <dd>
                    <button type="button" onclick="goAggregateOfficialPay('wx');" style="text-align:center; font-size: 20px;">[调用微信公众号支付]</button>
                    <span>只能在微信浏览器中使用</span>
                </dd>
                <dd>
                    <button type="button" onclick="goAggregateOfficialPay('alipay');" style="text-align:center; font-size: 20px;">[调用支付宝公众号支付]</button>
                </dd>

                <br>
                <dd>
                    <button type="button" onclick="goAggregateH5Pay('');" style="text-align:center; font-size: 20px;">[调用H5支付收银台]</button>
                </dd>
                <dd>
                    <button type="button" onclick="goAggregateH5Pay('wx');" style="text-align:center; font-size: 20px;">[调用微信H5支付]</button>
                    <span>只能在非微信浏览器中使用</span>
                </dd>
                <dd>
                    <button type="button" onclick="goAggregateH5Pay('alipay');" style="text-align:center; font-size: 20px;">[调用支付宝H5支付]</button>
                </dd>
            </dl>
        </div>
        <input type="hidden" id="channel" name="channel" value="">
    </form>
    <div id="foot">
        <br/><br/><br/><br/><br/>
        <ul class="foot-ul">
            <li>
                七分钱（国银证保旗下支付平台）版权所有 2015-2016
            </li>
        </ul>
    </div>
</div>
<script type="text/javascript">
    function goPcPay(){
        document.forms['sevenpayment'].action="sevenPayApplypc.php";
        document.forms['sevenpayment'].submit();
    }

    function goAggregateH5Pay(channel){
        document.getElementById('channel').value = channel;
        document.forms['sevenpayment'].action="payApplyh5.php?channel=" + channel;
        document.forms['sevenpayment'].submit();
    }

    function goAggregateOfficialPay(channel){
        document.getElementById('channel').value = channel;
        document.forms['sevenpayment'].action="payApplyOfficial.php?channel=" + channel;
        document.forms['sevenpayment'].submit();
    }
</script>
</body>
</html>