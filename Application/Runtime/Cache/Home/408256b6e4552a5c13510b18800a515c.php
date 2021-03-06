<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <title>支付中心</title>
<link href="/Public/css/pay.css" rel="stylesheet" type="text/css">
<style>
img{border-style:none; }
.popup-layer {
    display: none;
    position: fixed;
    margin-top: -60px;
    top: 50%;
    left: 50%;
    margin-left: -200px;
    width: 400px;
    height: 200px;
    z-index: 1000;
}
.popup-layer .popup-layer-box {
    width: 400px;
    height: 200px;
    background-image: url(ys/images/img/popup-layer-pay.png);
    box-shadow: 1px 2px 8px rgba(0, 0, 0, .4)
}
.popup-layer .popup-close {
    position: absolute;
    width: 25px;
    height: 25px;
    right: 2px;
    top: 2px;
    cursor: pointer;
}
.popup-layer .popup-btn-a, .popup-layer .popup-btn-b {
    position: absolute;
    width: 102px;
    height: 32px;
    bottom: 22px;
    cursor: pointer;
}
.popup-layer .popup-btn-a {
    left: 74px;
}
.popup-layer .popup-btn-b {
    left: 229px;
}
.popup-layer .popup-tips {
    position: absolute;
    top: 113px;
    padding: 0 10px;
    color: red;
    font-size: 13px;
}
.popup-layer .popup-phone {
    position: absolute;
    bottom: 0;
    left: 5px;
    font-size: 12px;
    color: #999;
}
.pay-submit button{    
    display: inline-block;
    width: 156px;
    color: #fff;
    border:none;
    cursor:pointer;
    height: 41px;
    line-height: 41px;
    text-align: center;
    text-decoration: none;
    font-size: 22px;
    background: #229d09;
}
</style>
</head>
<body>
<div class="header">
    <div class="wrap">
        <div class="progress">
            <img src="/Public/img/bz.png" alt="">
        </div>
        <a href="<?php echo U('/');?>" class="logo">
            <img src="/Public/img/play_logo.gif" alt="支付中心">
        </a>
    </div>
</div>
<div class="main wrap">
    <form  method="post"  id="wfform" name="wfform" action="<?php echo U('Pay/createPay');?>"  target="_blank">
    <div class="module">
        <div class="row type-wrap">
            <div class="row-title">请选择类型</div>
            <div class="row-content">
                <div class="type-list on" data-type="1" data-price="300.00">
                    <span class="type-list-title">订阅号+营销功能模块</span>
                    <img src="/Public/img/hot.gif" alt="hot">
                </div>
                <div class="type-list" data-type="2" data-price="300.00">
                    <span class="type-list-title">服务号+营销功能模块</span>
                    <img src="/Public/img/hot.gif" alt="hot">
                </div>
                <div class="type-list" data-type="3" data-price="400.00">
                    <span class="type-list-title">双号+营销功能模块</span>
                    <img src="/Public/img/hot.gif" alt="hot">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="row-title">区别和介绍</div>
        </div>
        <div class="row">
            <div class="row-desc">
                1、订阅号：个人、企业、单位都可以建设；服务号：需要企业营业执照。<br>
                2、订阅号侧重宣传推广，服务号侧重在线交易支付, 订阅号每天都可以群发1条信息; 服务号一个月只能群发4条信息。<br>
                3、双号：就是 订阅号+服务号, 为您同时分别开通订阅号和服务号，双号运营，更适合公众号营销。<br>
                4、营销功能包含：群发功能、粉丝管理、公众号自动回复（文字、语音、图文）、自定义导航菜单、微社区、微相册、微投票、留言板、带参数二维码等功能。<br>
                5、所有类型公众号都是一次付费永久使用，费用包含：开通公众号、提供公众号操作使用教程、公众号营销教程、公众号推广教程、公众号编辑器和在线客服使用指导服务。
            </div>
        </div>
        <div class="price">
            ￥ <span id="price">300.00</span>
        </div>
    </div>
    <div class="module">
        <div class="row">
            <div class="row-title">公众号信息</div>
            <div class="row-content">
                <div class="btn-qq-wrap">
                    联系客服：
                    <span class="btn-qq" id="btnQQ"  >
                       <a href='http://wpa.qq.com/msgrd?v=3&amp;uin=2851670321&amp;site=qq&amp;menu=yes' target="_blank"> 
                       <img src="/Public/img/qq.gif" alt="qq">
                       </a>
                    </span>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="row-info">
                <div class="info-list">
                    注册类型：
                    <span id="typeName">订阅号+营销功能模块</span>
                </div>
                <div class="info-list">
                    公众账号名称：
                    <span id="register"><?php echo ($v["wfproductb"]); ?></span>
                </div>
                <div class="info-list">
                    姓名：
                    <span id="wxname"><?php echo ($v["wfname"]); ?></span>
                </div>
                <div class="info-list">
                    手机号码：
                    <span id="phone"><?php echo ($v["wfmob"]); ?></span>
                </div>
                <div class="info-list">
                    联系QQ：
                    <span id="wfqq"><?php echo ($v["wfqq"]); ?></span>
                </div>
            </div>
        </div>
    </div>
    <div class="module">
        <div class="info-tips">亲：只差一步啦！支付完成后，工作人员将帮您建设公众号，并享受专业客服一对一指导和对接营销功能服务</div>
        <div class="info-tips red">付款后工作人员会在一个小时内联系您的QQ/邮箱或者手机，确认资料并建设公众号，以及提供后期服务</div>
    </div>
   
   
  
    <input type="hidden" name="order_sn" value="<?php echo ($v["order_sn"]); ?>">
    <input type="hidden" name="id" value="<?php echo ($v["id"]); ?>">
  
             
    <input type="hidden" id="wfpay" name="wfpay" value="wxnative">
    <input type="hidden" id="wfproduct" name="wfproduct" value="订阅号+营销功能模块">  
    <input name='wfprice' type='hidden' value="300"/>
    <div class="module">
    <div class="pay-wrapper" id="payWrapper">
    <ul class="sku_ul_pay">
        <li>
            <a href="javascript:void(0);" class="skupay_cur" data-pay="wxnative">
                <img src="/Public/img/fkd.gif"  >
            </a>
        </li>
 		<!-- <li>
	 		<a href="javascript:void(0);"  class="" data-pay="alipc">
	 			<img src="/Public/img/fkb.gif" disabled>
	 		</a>
 		</li> -->
    </ul>
    </div>
    <div class="pay-submit">
        <a href="javascript:void(0);" class="pay-submit-btn">
          <button type="submit">前往支付 </button>
        </a>
        <a href="<?php echo U('step3');?>" class="pay-submit-back">返回修改资料</a>
    </div>
    </div>
</form>
    <div class="footer">
        <img src="/Public/img/play_footer.jpg" alt="">
    </div>
</div>
<div id="popup-layer" class="popup-layer">
    <div class="popup-layer-box">
        <div class="popup-close"></div>
        <a id="qq_opend" class="popup-btn-a" data-wmdot="tap" data-wmdot-id="consult"></a>
        <a id="qq_opend2" class="popup-btn-b" data-wmdot="tap" data-wmdot-id="consult"></a>
    </div>
    <div class="popup-phone"><span class="phone-num"></span></div>
</div>
</body>
</html>
<script src="/Public/js/jquery.min.js"></script>
<script type="text/javascript">
    $(".type-list").click(function(){
        $(this).addClass("on").siblings().removeClass("on");
        $("#price").html($(this).attr("data-price"));
        $("input[name=wfprice]").val($(this).attr("data-price"));
        $("input[name=wfproduct]").val($(this).children("span").html());
        $("#typeName").html($(this).children("span").html());
    });
    $(".sku_ul_pay>li>a").click(function(){
        $(this).addClass("skupay_cur").parent().siblings().children("a").removeClass("skupay_cur");
        $("input[name=wfpay]").val($(this).attr("data-pay"));
    });
</script>