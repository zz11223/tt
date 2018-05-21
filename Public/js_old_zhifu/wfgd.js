/**
  ************************************************************************
  WFPHP订单系统版权归WENFEI所有，凡是破解此系统者都会死全家，非常灵验。
  ************************************************************************
  WFPHP订单系统官方网站：http://www.wforder.com/   （盗版盗卖者死全家）
  WFPHP订单系统官方店铺：http://889889.taobao.com/ （破解系统者死全家）
  ************************************************************************
  郑重警告：凡是破解此系统者出门就被车撞死，盗卖此系统者三日内必死全家。
  ************************************************************************ 
 */ 

//手机图片内容滚动
$(function(){	
	var msgs = [42,246,42,75,42,250,42,248,45,260,42,230,42,270,42,263,42,238];
	var $img = $(".banner .showpic img");
	var index = 2;
	var count = -25;
	var _si = setInterval(function(){
		count -= msgs[index];
		$img.animate({"margin-top":count},200);
		index++;
		if( index >= msgs.length){
			index = 0;
			count = 263;
		}
	},2000);
})

//侧栏滚动效果
$(function() {
  var scrtime;
  $(".wffahuo").hover(function() {
    clearInterval(scrtime);
  }, function() {
    scrtime = setInterval(function() {
      var $ul = $(".wffahuo ul");
      var liHeight = $ul.find("li:last").height();
      $ul.animate({
        marginTop: liHeight + 10 + "px"
      }, 300, function() {
        $ul.find("li:last").prependTo($ul)
        $ul.find("li:first").hide();
        $ul.css({
          marginTop: 0
        });
        $ul.find("li:first").fadeIn(600);
      });
    }, 3000);
  }).trigger("mouseleave");
});

//////////////////////////// WFORDERJSEND ////////////////////////////