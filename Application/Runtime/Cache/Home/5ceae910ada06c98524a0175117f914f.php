<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <title>公众号服务平台</title>
    <link href="/Public/css/bootstrap.min.css" rel="stylesheet"/>
    <link href="/Public/css/index.css" rel="stylesheet"/>
</head>
<body>
<div class="header">
    <div class="wrap">
        <a href="<?php echo U('/');?>">
            <div class="logo">
                <img src="/Public/img/logo.png" alt="公众服务平台"/>
            </div>
        </a>
    </div>
</div>
<div class="main">
    <div class="reg-form">
        <div class="reg-header">
            <ul class="processor_bar grid_line">
                <li class="step grid_item size1of4 prev"> <h4>1 选择类型</h4> </li>
                <li class="step grid_item size1of4 current"> <h4>2 公众号信息</h4> </li>
                <li class="step grid_item size1of4 next"> <h4>3 注册信息</h4> </li>
                <li class="no_extra step grid_item size1of4 nnext"> <h4>4 登录公众号</h4> </li>
            </ul>
        </div>
        <div class="reg-form-box">
            <form action="<?php echo U('home/index/step2_do');?>" method="post">
            <div class="reg-form-tab on">
                <div class="tab-content w40">
                    <div class="wx-bg">
                        <div class="wx-bg-header">
                            <img src="/Public/img/wx_header.png" alt="wx"/>
                            <div class="wx-name" id="wxNameModel"><?php echo ((isset($v['wfproductb']) && ($v['wfproductb'] !== ""))?($v['wfproductb']):''); ?></div>
                        </div>
                        <div class="wx-content" id="wxDescModel">
								<?php echo ((isset($v['wfguest']) && ($v['wfguest'] !== ""))?($v['wfguest']):''); ?>
                        </div>
                        <div class="wx-bg-content">
                            <img src="/Public/img/wx_body.png" alt="wx"/>
                        </div>
                    </div>
                </div>
                <div class="tab-content">
                        <div class="form-group">
                            <label for="wxName" class="col-sm-3 control-label">帐号名称</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="wxName" name="wfproductb" value="<?php echo ((isset($v['wfproductb']) && ($v['wfproductb'] !== ""))?($v['wfproductb']):''); ?>" placeholder="请输入帐号名称"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="wxDesc" class="col-sm-3 control-label">功能介绍</label>
                            <div class="col-sm-9">
                                <textarea class="form-control wx-desc-txt" id="wxDesc" name="wfguest" placeholder="介绍此公众帐号功能与特色。"><?php echo ((isset($v['wfguest']) && ($v['wfguest'] !== ""))?($v['wfguest']):''); ?></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">功能描述</label>
                            <div class="col-sm-9">
                                文章推送（文字、语音、视频、图文）、粉丝管理、群发功能、微信自动回复、客服功能、自定义导航菜单、微网站、微表单、微投票、抽奖、刮刮卡、会员卡、优惠券等营销功能。
                            </div>
                        </div>
                    <div class="tab-footer">
                        <a href="<?php echo U('/');?>" id="prevStep3" class="btn btn-default">上一步</a>
                        <button type="submit" id="nextStep3" class="btn btn-success">下一步</button>
                    </div>
                </div>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="footer">
     <div><font face="Arial">&copy;</font> 2000 - 2019 公众号服务 —— All Right Reserved.</div>
</div>
</body>
</html>
<script src="/Public/js/jquery.min.js"></script>
<script>
    $('#wxName, #wxDesc').keyup(function () {
      var sId = this.id,
        sTxt = this.value;
      $('#' + sId + 'Model').text(sTxt);
    });
</script>