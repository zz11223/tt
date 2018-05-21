var DONT_ENUM =  "propertyIsEnumerable,isPrototypeOf,hasOwnProperty,toLocaleString,toString,valueOf,constructor".split(","),
    hasOwn = ({}).hasOwnProperty;
    for (var i in {
        toString: 1
    }){
        DONT_ENUM = false;
    }


    Object.keys = Object.keys || function(obj){//ecma262v5 15.2.3.14
            var result = [];
            for(var key in obj ) if(hasOwn.call(obj,key)){
                result.push(key) ;
            }
            if(DONT_ENUM && obj){
                for(var i = 0 ;key = DONT_ENUM[i++]; ){
                    if(hasOwn.call(obj,key)){
                        result.push(key);
                    }
                }
            }
            return result;
        };
        
function set_cookie(name,value){
//	var exp = new Date();
//	exp.setTime(exp.getTime() + 60*60*1000);
//	document.cookie = name + "="+ escape (value) + ";expires=" + exp.toGMTString();
	document.cookie = name + "="+ escape (value);
}
function get_cookie(name){
	var arr,reg=new RegExp("(^| )"+name+"=([^;]*)(;|$)");
	if(arr=document.cookie.match(reg)){
		return unescape(arr[2]);
	}else{
		return null;
	} 
}
//$(function(){
    //设置子的高度等于显示div的高度；
    var height=$("#super_citys>div").height();
    //设置动态生成的li高度等于显示框高度函数；下方动态生成li时调用；
    function auto_height(){$("#super_citys>div>ul>li").height(height).css("line-height",height+"px");}
    $("#super_citys>div>div").height(height).css("line-height",height+"px");
    $("#super_citys>div>ul").css("top",height+"px");
    var html1
    var obj_index=Object.keys(city1);
    for(var i=0,obj_len=obj_index.length;i<obj_len;i++){
        html1='<li><input type="hidden" value="'+obj_index[i]+'"><span>'+city1[obj_index[i]]+'</span></li>';
        $("#super_citys>.provinces>ul").append(html1);
    }
    auto_height();
    //省
    var sheng,diqu;
    function for_in_shi(htmls,exps){
        var obj_index=Object.keys(city2[exps]);
        for(var i=0,len=obj_index.length;i<len;i++){
            htmls+='<li><input type="hidden" value="'+obj_index[i]+'"><span>'+city2[exps][obj_index[i]]+'</span></li>';
        }
            $("#super_citys>.city>ul").html(htmls);
    }
    $("#super_citys>.provinces>ul>li").click(function(){
        var cookies_s=$(this).children("input").val();
        var name_s=$(this).children("span").html();
        //保存浏览器cookie
        set_cookie("ldzd_provinces",cookies_s);
        set_cookie("ldzd_provinces_name",name_s);
        //======
        $("#super_citys>.provinces>.input1").val(cookies_s);
        $("#super_citys>.provinces>.input2").val(name_s);
        $("#super_citys>.provinces>div").html($(this).children("span").html());
        var html2='<li><input type="hidden" value="0"><span>请选择城市</span></li>';
        var index_s=$(this).children("input").val();
        if(sheng!==index_s){
            $("#super_citys>.city>div").html("请选择城市");
            $("#super_citys>.city>.input1").val(0);
            $("#super_citys>.city>.input2").val(0);
            $("#super_citys>.area>div").html("请选择地区");
            $("#super_citys>.area>.input1").val(0);
            $("#super_citys>.area>.input2").val(0);
            $("#super_citys>.area>ul").html('<li><input type="hidden" value="0"><span>请选择地区</span></li>');
            set_cookie("ldzd_city",0);
            set_cookie("ldzd_city_name",0);
            set_cookie("ldzd_area",0);
            set_cookie("ldzd_area_name",0);
        }
        sheng=index_s;
        if(index_s==0){
            $("#super_citys>.provinces>.input2").val(0);
            $("#super_citys>.city>ul").html('<li><input type="hidden" value="0"><span>请选择城市</span></li>');
            $("#super_citys>.city>.input1").val(0);
            $("#super_citys>.city>.input2").val(0);
            $("#super_citys>.area>ul").html('<li><input type="hidden" value="0"><span>请选择地区</span></li>');
            $("#super_citys>.area>.input1").val(0);
            $("#super_citys>.area>.input2").val(0);
            
        }else{
            for_in_shi(html2,index_s);
        }
        auto_height();
    });
    //市
    function for_in_qu(htmls,exps){
        var obj_index=Object.keys(city3[exps]);
        for(var i=0,len=obj_index.length;i<len;i++){
            htmls+='<li><input type="hidden" value="'+obj_index[i]+'"><span>'+city3[exps][obj_index[i]]+'</span></li>'; 
        }
        $("#super_citys>.area>ul").html(htmls);
    }
    $("#super_citys>.city>ul").on("click","li",function(){
        var cookies_s=$(this).children("input").val();
        var name_ss=$(this).children("span").html();
        set_cookie("ldzd_city",cookies_s);
        set_cookie("ldzd_city_name",name_ss);
        $("#super_citys>.city>.input1").val(cookies_s);
        $("#super_citys>.city>.input2").val(name_ss);
        $("#super_citys>.city>div").html($(this).children("span").html());
        var html3='<li><input type="hidden" value="0"><span>请选择地区</span></li>';
        var index_r=$(this).children("input").val();
        if(diqu!==index_r){
            $("#super_citys>.area>div").html("请选择地区");
            $("#super_citys>.area>.input1").val(0);
            $("#super_citys>.area>.input2").val(0);
            set_cookie("ldzd_area",0);
            set_cookie("ldzd_area_name",0);
        }
        diqu=index_r;
        if(index_r==0){
            $("#super_citys>.area>ul").html('<li><input type="hidden" value="0"><span>请选择地区</span></li>');
            $("#super_citys>.city>.input2").val(0);
            $("#super_citys>.area>.input2").val(0);
        }else{
            for_in_qu(html3,index_r);
        }
        auto_height()
    });
    //区
    $("#super_citys>.area>ul").on("click","li",function(){
        var x_index=$(this).children("input").val();
        var nname_s=$(this).children("span").html();
        set_cookie("ldzd_area",x_index);
        set_cookie("ldzd_area_name",nname_s)
        if(x_index==0){
            $("#super_citys>.area>.input2").val(0);
        }else{
            $("#super_citys>.area>.input2").val($(this).children("span").html());
        }
        $("#super_citys>.area>.input1").val($(this).children("input").val());
        $("#super_citys>.area>div").html($(this).children("span").html());
    });
    //点击显示框效果
    var height_shjiu,height_zong,height_li20;
    function guyuan(element){
         auto_height();
        //设置下拉框最多显示10个数据，
        height_zong=(element.children("ul").children("li").length)*height;
        height_li20=10*height;
        if(height_zong>height_li20){
            height_shjiu=height_li20;
        }else{
            height_shjiu=height_zong;
        }
        element.children("ul").css({
            "display":"block",
            "height":height_shjiu+"px"
        });
        element.siblings().children("ul").css({
            "display":"none",
            "height":"0px"
        });
    }
    //点击其他元素事件处理
    $(document).click(function(){
        $("#super_citys>div>ul").css("display","none");
        $("#super_citys>div").removeClass("shadow");
        sheng_is=true;
        shi_is=true;
        qu_is=true;
    });
    //子点击事件
    $("#super_citys>div>ul").on("click","li",function(e){
        e.stopPropagation();
        $(this).parent().parent().addClass("shadow").siblings().removeClass("shadow");
        $("#super_citys>div>ul").css("display","none");
        sheng_is=true;
        shi_is=true;
        qu_is=true;
    });
    //sheng
    var sheng_is=true;
    $("#super_citys>.provinces").click(function(e){
        if(sheng_is){
            e.stopPropagation();
        }
        $(this).addClass("shadow").siblings().removeClass("shadow");
        sheng_is=!sheng_is;
        guyuan($(this));
        shi_is=true;
        qu_is=true;
    });
    //shi
    var shi_is=true;
    $("#super_citys>.city").click(function(e){
        if(shi_is){
            e.stopPropagation();
        }
        $(this).addClass("shadow").siblings().removeClass("shadow")
        shi_is=!shi_is;
        guyuan($(this));
        sheng_is=true;
        qu_is=true;
    });
    //qu
    var qu_is=true;
    $("#super_citys>.area").click(function(e){
        if(qu_is){
            e.stopPropagation();
        }
        $(this).addClass("shadow").siblings().removeClass("shadow")
        qu_is=!qu_is;
        guyuan($(this));
        sheng_is=true;
        shi_is=true;
    });
//});