<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    
    <title>{{$arr->h_title}}</title>
    <meta name="keywords" content="" />
    <meta name="description" content="" />
    
    <script language="javascript">
        msg = "邻京有屋";

        msg = "" + msg;pos = 0;
        function scrollMSG() {
        document.title = msg.substring(pos, msg.length) + msg.substring(0, pos);
        pos++;
        if (pos >  msg.length) pos = 0
        window.setTimeout("scrollMSG()",200);
        }
        scrollMSG();
    </script> 
    
    <script src="{{URL::asset('../public')}}/templets/htm/style/js/jquery-1.9.1.js"></script>
    <script src="{{URL::asset('../public')}}/templets/htm/style/js/base.min.js"></script>
    <script src="{{URL::asset('../public')}}/templets/htm/style/js/common.js"></script>
    <script src="{{URL::asset('../public')}}/templets/htm/style/js/g.js"></script>
    <script type="text/javascript" src="http://api.map.baidu.com/api?v=2.0&ak=3GABwNY8GhSDqGz7R1lx33dW4oAQ7krF"></script>
    <link href="{{URL::asset('../public')}}/templets/htm/style/css/common.min.css" rel="stylesheet"/>
    <link href="{{URL::asset('../public')}}/templets/discuss/style/talk.css" rel="stylesheet"/>


    
    <style>
        html, body {
            background: #fff;
        }

        .room_slide {
            width: auto;
        }
      ul li ,ol li{
        list-style-type: none;
      }
      .containers{
         width:90%;
      }
      .containers ul li{

            float: left;
            width: 20px;
      }

    </style>
    <link href="{{URL::asset('../public')}}/templets/htm/style/css/Imagefocus.min.css" rel="stylesheet" />

    <script type="text/javascript">


        var zd = '0';
        if (zd == 0 && getCookie("zd") == null) {
            document.write('<script src="{{URL::asset("../public")}}/templets/htm/style/js/p.mini.js"><\/script>');
        } else {
            if (zd == 1 && getCookie("zd") == null)
                addCookie(1);
        }

        function addCookie(objHours) {
            var str = "zd=1";
            var date = new Date();
            var ms = 1000 * 60 * 10;
            date.setTime(date.getTime() + ms);
            str += "; expires=" + date.toGMTString();
            document.cookie = str;
        }
        function getCookie(name) {
            var arr = document.cookie.match(new RegExp("(^| )" + name + "=([^;]*)(;|$)"));
            if (arr != null) return unescape(arr[2]); return null;
        }
        function delCookie(name) {
            var exp = new Date();
            exp.setTime(exp.getTime() - 1);
            var cval = getCookie(name);
            if (cval != null) document.cookie = name + "=" + cval + ";expires=" + exp.toGMTString();
        }
        var mlik = document.getElementsByTagName("mLink");
        mlik.onclick = function () {
            delCookie("zd");
        }

    </script>

</head>
<body data-spy="scroll">

    <input id="controller" type="hidden" value="Rent" />
    <input id="action" type="hidden" value="Index" />
    
    <!-- 引入公共头 -->
         @include('header')

    <div class="clearfix"></div>

<div class="container">
    <!-- <div class="bk20"></div>
    <div class="alert alert-warning alert-dismissible text-center" role="alert" style="color: #bb6d05; background: #fff6d1; border-color: #fff6d1; ">
        <strong>邻京有屋在线支付全面上线</strong> ，关注官方微信（微信号：LinJing）选择自助服务或注册成为邻京会员，即可使用线上支付！
    </div> -->
    <ol class="breadcrumb">   
        <li><a href="/"><i class="fa fa-home"></i>首页</a></li>
        <li><a href="/plus/list.php?tid=1">我要租房</a></li>
        <li class="active">
        <a href="{{URL('index/details')}}?id={{$arr->h_id}}">{{$arr->h_title}}</a>
            
        </li>
        
    </ol>
    <input type="hidden" id="roomCode" />
    <div class="room-slide-image pull-left">
        <div class="r-slider">
            <div class="slide-image-big">
                <ul class="list-unstyled">
                    <li class="diagram-img-big">
                        <a title="{{$arr->h_title}}" href="http://www.linjing.com/public/images/@if(strstr($arr->h_photo, '|', TRUE)){{strstr($arr->h_photo, '|', TRUE)}}@else{{$arr->h_photo}}@endif" data-src="http://www.linjing.com/public/images/@if(strstr($arr->h_photo, '|', TRUE)){{strstr($arr->h_photo, '|', TRUE)}}@else{{$arr->h_photo}}@endif">
                        <img class="mfp-zoom" alt="" title="" src="http://www.linjing.com/public/images/@if(strstr($arr->h_photo, '|', TRUE)){{strstr($arr->h_photo, '|', TRUE)}}@else{{$arr->h_photo}}@endif" data-src="http://www.linjing.com/public/images/@if(strstr($arr->h_photo, '|', TRUE)){{strstr($arr->h_photo, '|', TRUE)}}@else{{$arr->h_photo}}@endif" />
                        </a>
                    </li>
                                       
                </ul>

            </div>
          <div class="slide-image-small">
                <div class="image-prev img-navigation">上一张</div>
                <div class="image-list">
                    <ul class="image-list-content list-unstyled">
                       
                        <li><img class="current" width="66" height="44" title="" alt="" src="http://www.linjing.com/public/images/@if(strstr($arr->h_photo, '|', TRUE)){{strstr($arr->h_photo, '|', TRUE)}}@else{{$arr->h_photo}}@endif" data-src="http://www.linjing.com/public/images/@if(strstr($arr->h_photo, '|', TRUE)){{strstr($arr->h_photo, '|', TRUE)}}@else{{$arr->h_photo}}@endif" /></li>
                    </ul>
                </div>
                <div class="image-next img-navigation">下一张</div>
            </div>
        </div>
        <div class="room_slide_share pull-right">
            <div class="slide_share_box">
                <div class="share_ws share_info pull-left">分享到：</div>
                <div class="bdsharebuttonbox">
                    <a title="分享到新浪微博"  class="bds_tsina" data-cmd="tsina"></a>
                    <a title="分享到QQ好友"  class="bds_sqq" data-cmd="sqq"></a>
                    <a title="分享到豆瓣网"  class="bds_douban" data-cmd="douban"></a>
                    <a title="分享到人人网"  class="bds_renren" data-cmd="renren"></a>
                    <a title="分享到QQ空间"  class="bds_qzone" data-cmd="qzone"></a>
                    <a  class="bds_more" data-cmd="more"></a>
                </div>

            </div>
            <button class="btn btn-default pro_share_button" type="button"><i class="fa fa-caret-right"></i></button>
            

        </div>
        <div class="clearfix"></div>
    </div>

    <div class="product_intro pull-left">
  
        <h1 class="intro_title">{{$arr->h_title}}</h1>
  
        <h5 class="intro_title_sale text-orange"></h5>
        <div class="bk10"></div>
        <div class="intro_table">
            <!-- <div class="table_lh bar">
                <div class="pro_name"><span class="pa">编</span>号：</div>
                <div class="pro_content">
                
                    <span class="pro_number">
                    
                    
                    
                    <span>
                    
                     
                        <div class="move_house">
                            <div class="move_box">
                                <div class="move_info">
                                 
                                    <p>首次当天看房缴定金（一个月房租）,邻京立即赠送您搬家抵金券。</p>
                                    <a href="/plus/list.php?tid=45" target="_blank">怎么用？</a>
                                    
                                    
                                    <div class="sprite sprite_move_info"></div>
                                </div>
                            </div>
                        </div>                        
                </div>
            </div> -->
            
            <div class="table_lh bar">
                <div class="pro_name text-orange"><span class="pa">租</span>金：</div>
                <div class="pro_contet">
                    <div class="pro_price">￥<span id="rental">{{$arr->h_price}}</span> 元/月</div>
                    <a class="yayi_info"  data-toggle="modal">
                        <span class="sprite sprite_pro_info_1">房租月付</span>
                    </a>
                </div>
            </div>
            <div class="table_lh bar">
                <div class="pro_name"><span class="pa">小</span>区：</div>
                <div class="pro_content">
                    <span class="pro_number">{{$arr->h_plot_name}}</span>
                </div>
            </div>
            <div class="table_lh bar">
                <div class="pro_name"><span class="pa">类</span>型：</div>
                <div class="pro_content">
                        @if($arr->h_rent_type == 0)
                            整套出租
                        @elseif($arr->h_rent_type == 1)
                            单间出租
                        @else($arr->h_rent_type== 2)
                            床位出租
                            @endif
                </div>
            </div>
            <!-- <div class="table_lh bar">
                <div class="pro_name"><span class="pa">房</span>间：</div>
                <div class="pro_content pro_select pro_room_num" style="width:580px;float:left; line-height:26px;">
            
                <button class="btn_room btn btn-default disabled" d="A" price="650.00" s="0" sales="0" type="button" y=" 0">A房间 已租出</button><button class="btn_room btn btn-default disabled" d="B" price="750.00" s="0" sales="0" type="button" y=" 0">B房间 已租出</button><button bprice="0" class="btn_room btn btn-default current" d="C" price="750" r="CDZ01423C" s="0" sales="0" t="0" type="button" y=" 0">C房间 带飘窗 750元</button><button class="btn_room btn btn-default disabled" d="D" price="850.00" s="0" sales="0" type="button" y=" 0">D房间 已租出</button>
            
                </div>
                <div class="clearfix"></div>
            </div> -->
            <div class="table_lh ">
                <div class="pro_name">电话咨询：</div>
                <div class="pro_content pro_tel">
                    {{$arr->h_contact_phonenumber}}
                    
                </div>
            </div>
            <div class="table_lh ">
                <div class="pro-submit">
                
                
                        <button type="button" class="btn btn-orange btn-pro-order btn-pro-valid click_order_kanfang" id="click_order_kanfang" data-toggle="modal" data-target="#Room_box">我要看房</button>
                       
                       <a id="QQMessageOnlick" class="btn btn-yellow btn-pro-con" href="http://wpa.qq.com/msgrd?v=3&uin=578258572&site=qq&menu=yes" rel="nofollow" target="_blank">QQ咨询</a>
                    
                </div>
            </div>
        </div>
    </div>
    <div class="clearfix"></div>
</div>
<div class="nav-site">
    <nav id="product_nav" class="navbar navbar-room" role="navigation">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="glyphicon glyphicon-align-justify"></span>

                </button>
                <input type="hidden" id="sourceNum" value="182401558" />
            </div>

            <div class="collapse navbar-collapse   bs-js-navbar-scrollspy  ">
                <ul class="nav navbar-nav">
                     <li class="active">
                        <a href="#pro_nav_0" >
                            地理位置<div class="arrow-down"></div>
                        </a>
                        
                  </li>
                  <li >
                        <a href="#pro_nav_1" >
                            选择邻京<div class="arrow-down"></div>
                        </a>
                        
                  </li>
                    <li >
                        <a href="#pro_nav_2" >
                            评论<div class="arrow-down"></div>
                        </a>
                        
                  </li>
<!--                    <li>
                        <a class="ImageMapNav">地理位置</a>
                    </li>
                    <li>
                        <a class="house_type" href="/Image?imgid=110258&amp;width=800&amp;height=447&amp;w=1&amp;sy=1">户型图</a>
                    </li>-->
                </ul>
                <ul class="nav navbar-nav navbar-right pro_right_info hidden">
                    <li>
                        看房咨询：
                        <span class="pro_tel">{{$arr->h_contact_phonenumber}}</span>
                    </li>
                </ul>
                <input id="hidcity" type="hidden" class="hiddencityId" value="10000" />
            </div>
        </div>
    </nav>
</div>





<div class="modal fade room_select in" data-mark="ab" id="Room_box" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false" novalidate="novalidate">
   
   
   <form action="{{URL('index')}}" enctype="multipart/form-data"   onsubmit="return froms()">
<!-- <input type="hidden" name="action" value="post" /> -->
<!-- <input type="hidden" name="diyid" value="1" /> -->
<!-- <input type="hidden" name="do" value="2" /> -->
<!-- <input type="hidden" name="_token" value="{{csrf_token()}}" /> -->

   
    <div class="modal-dialog">
        <div class="modal-content">
            
            <div class="modal-header">

                <h4 class="modal-title">
                    <b>
                        我要预约看房<br>
                        <small>APPOINTMENT FORM</small>
                    </b>
                </h4>
            </div>
            <div class="modal-body">
                

                <div class="form-horizontal" role="form">
                    <p class="help-block">请如实填写信息，我们将尽快与您联系：</p><div class="bk6"></div>
                    <div class="form-group">
                        <label for="" class="col-sm-3 control-label">您的名字：</label>
                        <div class="col-sm-8">
                            <input name="q1" type="text" onblur="q1s()" class="form-control pro_message_name" id="q1" placeholder="" check-type="required"><br>  <span id="sp1"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for=""  class="col-sm-3 control-label">您的手机：</label>
                        <div class="col-sm-8">
                            <input name="q2" onblur="phones()" type="text" class="form-control pro_message_tel" id="q2" placeholder="" check-type="phone"><br><span id="sp2"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="" class="col-sm-3 control-label">性别：</label>
                        <div class="col-sm-8">
                            <div class="radio-inline">
                                <label>
                                    <input type="radio" name="q3" value="男" checked="">
                                    男
                                </label>
                            </div>
                            <div class="radio-inline">
                                <label>
                                    <input type="radio" name="q3" value="女">
                                    女
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="" class="col-sm-3 control-label">入住人数：</label>
                        <div class="col-sm-8">
                            <div class="radio-inline">
                                <label>
                                    <input type="radio" name="people" value="1人" checked="">
                                    1人
                                </label>
                            </div>
                            <div class="radio-inline">
                                <label>
                                    <input type="radio" name="people" value="2人">
                                    2人
                                </label>
                            </div>
                            <div class="radio-inline">
                                <label>
                                    <input type="radio" name="people" value="3人">
                                    3人
                                </label>
                            </div>
                            <div class="radio-inline">
                                <label>
                                    <input type="radio" name="people" value="3人以上">
                                    3人以上
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="" class="col-sm-3 control-label">个人需求：</label>
                        <div class="col-sm-8">
                            <textarea name="q4" rows="3" class="form-control pro_message_remarks" id="q4"></textarea>
                        </div>
                    </div>
                    
                    
                    <div class="form-group">
                        
                    </div>
                    
                </div>


            </div>
            <div class="modal-footer">
            
            <input type="hidden" name="dede_fields" value="q1,text;q2,text;q3,text;people,text;q4,multitext;q5,text" />
<input type="hidden" name="dede_fieldshash" value="6ba1a19f02341f782d91ad8276f4182c" />

                <button type="submit"  name="submit" class="btn btn-orange  btn-valid padding30">提 交</button>
                <button type="button" class="btn btn-default padding30" data-dismiss="modal">取 消</button>
                
            </div>
        </div>
    </div>
    </form>
    
    <script type="text/javascript" language="javascript">
//验证码 
// function changeAuthCode() { 
//     var num =     new Date().getTime();
//     var rand = Math.round(Math.random() * 10000);
//     num = num + rand;
//     $('#ver_code').css('visibility','visible');
//     if ($("#vdimgck")[0]) {
//         $("#vdimgck")[0].src = "/include/vdimgck.php?tag=" + num;
//     }
//     return false;    
// }
 function q1s(){
        var name = $('#q1').val();
        var r_name = /^[\u4e00-\u9fa5]{2,5}$/;
        if(name == ""){
            $('#sp1').attr('style' , 'color:red').html("请输入您的名字");
            return false;
        }
        if(!r_name.test(name)){
            $('#sp1').attr('style' , 'color:red').html("您的名字必须是2-5个汉字");
            return false;
        }else{
             $('#sp1').attr('style' , 'color:green').html("(*＾-＾*)");
             return true;
        }
    }
    //验证手机
    function phones(){
        var phone = $('#q2').val();
        var r_phone = /^\d{11}$/;
        if(phone == ""){
            $('#sp2').attr('style' , 'color:red').html("请输入您的手机号");
            return false;
        }
        if(!r_phone.test(phone)){
            $('#sp2').attr('style' , 'color:red').html("您的手机号码必须位11位数字");
            return false;
        }else{
            $('#sp2').attr('style' , 'color:green').html("(*＾-＾*)");
            return true;
        }
    }
    function froms(){
        if(q1s()&phones()){
            alert('提交成功,请耐心等待联系');
            return true;
        }else{
            return false;
        }
    }
</script>

</div>





<div class="container">
    <div class="room-detail">
        <!-- data-target="#navbar-example2" data-offset="0"-->
        <div class="order-ico-group ">
            <div class="sprite sprite_probox_ico porbox-ico ">查</div>
            <div class="sprite sprite_probox_ico porbox-ico ">评</div>
            <div class="sprite sprite_probox_ico porbox-ico ico-s ">WHY</div>
            <div class="sprite sprite_probox_ico porbox-ico ico-s ">HOW</div>
            <div class="sprite sprite_probox_ico porbox-ico ico-s ">图</div>

            <div class="sprite sprite_probox_ico porbox-ico ">荐</div>
        </div>


        <!--pro_nav_1-->
        <div class="d_shuoshuo">
            <div class="row">
            </div>
        </div>





             <div class="probox" id="pro_nav_0" >                    
                <div class="probox-heading">
                <div class="sprite sprite_probox_ico porbox-ico ico-s">图</div>
                <div class="probox-title">查看地图</div>
            </div>
            <div class="probox-body-l">
                <!--百度地图容器-->
        <div style="width:700px;height:550px;border:#ccc solid 1px;font-size:12px" id="map"></div>
        <script type="text/javascript">
            // 百度地图API功能

            var map = new BMap.Map("map");    // 创建Map实例
            var point = new BMap.Point("{{ $position->h_lng }} ","{{  $position->h_lat }} ");
            map.centerAndZoom(point, 18);// 初始化地图,设置中心点坐标和地图级别
            map.addControl(new BMap.MapTypeControl());   //添加地图类型控件
            map.setCurrentCity("北京");          // 设置地图显示的城市 此项是必须设置的
            map.enableScrollWheelZoom(true);     //开启鼠标滚轮缩放
            var marker = new BMap.Marker(point);  // 创建标注
            map.addOverlay(marker);               // 将标注添加到地图中
            marker.setAnimation(BMAP_ANIMATION_BOUNCE); //跳动的动画
            //marker.disableDragging();           // 不可拖拽

        </script>


            </div>
                </div>
        <!--无数据时不显示-->
                <div class="probox" id="pro_nav_1">                    
                <div class="probox-heading">
                <div class="sprite sprite_probox_ico porbox-ico ico-s">WHY</div>
                <div class="probox-title">为什么选择邻京？</div>
            </div>
            <div class="probox-body-l">
                <img data-original="{{URL::asset('../public')}}/templets/htm/style/images/probox-why.jpg" src="{{URL::asset('../public')}}/templets/htm/style/images/loading.gif" class="img-responsive " width="805" height="649" />
            </div>
                </div>


        <!--无数据时不显示-->
        <div class="probox" >
        
        
                <div class="probox-heading">
                <div class="sprite sprite_probox_ico porbox-ico ico-s">HOW</div>
                <div class="probox-title">怎么租房呐？</div>
            </div>
            <div class="probox-body-l">
                <img data-original="{{URL::asset('../public')}}/templets/htm/style/images/probox-setup.jpg" src="{{URL::asset('../public')}}/templets/htm/style/images/loading.gif" class="img-responsive " width="804" height="124" style="display: block;">
            </div>
            
            
            
        </div>
                <div id="pro_nav_2" class="probox">
            <div class="probox-heading">
                <div class="sprite sprite_probox_ico porbox-ico ">看</div>
                <div class="probox-title">评论记录</div>
            </div>
            <div class="probox-body-l" style="font-size:14px; line-height:26px; ">
            <div class="panel-heading" style="box-sizing: border-box; border-bottom-style: none; border-top-left-radius: 0px; border-top-right-radius: 0px; border-bottom-right-radius: 0px; border-bottom-left-radius: 0px; color: rgb(255, 255, 255); padding: 0px 15px; font-family: 微软雅黑, Arial, sans-serif; font-size: 14px; line-height: 20px; background: rgb(63, 203, 192);">
    <h3 class="panel-title" style="box-sizing: border-box; font-family: inherit; font-weight: 500; line-height: 37px; color: inherit; margin-top: 0px; margin-bottom: 0px; font-size: 16px;">
        <strong style="box-sizing: border-box;">用户评论</strong></h3>
</div>
<div class="table-responsive relative" style="box-sizing: border-box; border-top-style: none; color: rgb(51, 51, 51); font-family: 微软雅黑, Arial, sans-serif; font-size: 14px; line-height: 20px;">
    <table class="table table_config" id="ping" style="box-sizing: border-box; border-collapse: collapse; border-spacing: 0px; width: 807px; max-width: 100%; margin-bottom: 20px; background-color: transparent;">
        <!-- <tbody class="config_content" style="box-sizing: border-box; border: none;"> -->
                @foreach($comment as $v)    
            <tr style="box-sizing: border-box; border-style: none none dashed; border-bottom-width: 1px; border-bottom-color: rgb(221, 221, 221);">
               <td class='p_index' style='box-sizing: border-box; padding: 2px 8px 2px 12px; line-height: 30px; vertical-align: top; border-style: none none dashed; border-bottom-color: rgb(221, 221, 221);'>
                    <div style='width:45%;margin-top:20px'>{{$v->c_desc}} <br>
                    <?php 
                       echo  Date('Y-m-d',$v->c_time);
                     ?>
                     </div></td>
               
                <td style="box-sizing: border-box; padding: 8px; line-height: 30px; vertical-align: top; border-style: none none dashed; border-bottom-color: rgb(221, 221, 221);">
                    <div style='width:60%;margin-top:20px'>
                   小区:{{$arr->h_plot_name}} <br>
            
                   </div></td>
                <td style="box-sizing: border-box; padding: 8px; line-height: 30px; vertical-align: top; border-style: none none dashed; border-bottom-color: rgb(221, 221, 221);">
                    &nbsp;</td>
                <td style="box-sizing: border-box; padding: 8px; line-height: 30px; vertical-align: top; border-style: none none dashed; border-bottom-color: rgb(221, 221, 221);">
                    &nbsp;</td>
                <td style="box-sizing: border-box; padding: 8px; line-height: 30px; vertical-align: top; border-style: none none dashed; border-bottom-color: rgb(221, 221, 221);">
                    &nbsp;</td>
                <td style="box-sizing: border-box; padding: 8px; line-height: 30px; vertical-align: top; border-style: none none dashed; border-bottom-color: rgb(221, 221, 221);">
                    &nbsp;</td>
                <td style="box-sizing: border-box; padding: 8px; line-height: 30px; vertical-align: top; border-style: none none dashed; border-bottom-color: rgb(221, 221, 221);">
                    &nbsp;</td>
                <td style="box-sizing: border-box; padding: 8px; line-height: 30px; vertical-align: top; border-style: none none dashed; border-bottom-color: rgb(221, 221, 221);">
                    &nbsp;</td>
                <td style="box-sizing: border-box; padding: 8px; line-height: 30px; vertical-align: top; border-style: none none dashed; border-bottom-color: rgb(221, 221, 221);">
                    <div style='width:80%;margin-top:30px'>                            
                                {{$v->u_name}}                            
                     </div></td>
                <td style="box-sizing: border-box; padding: 8px; line-height: 30px; vertical-align: top; border-style: none none dashed; border-bottom-color: rgb(221, 221, 221);">
                    &nbsp;</td>
            </tr>
                @endforeach
        <!-- </tbody> -->
    </table>
     
</div>
<div class="containers" style="margin-left:45%" >
 
                    {!!$comment->appends(['id'=>$id])->render()!!}


</div>
<br />
</div>
        </div>


        <!--无数据时不显示-->
                <div class="probox"  >
                    
                                <div class="probox-heading">
                <div class="sprite sprite_probox_ico porbox-ico ">评</div>
                <div class="probox-title">房屋评论</div>
            </div>
            <div class="probox-body-l" >

       
                <div class="panel panel-default d_support">
               
                    <div class="panel-heading">
                    <center>
                        <h3 class="panel-title"><strong>我要评论</strong></h3>
                     </center>    
                    </div>
        
                    
                </div>
             <div class="quiz">
                <div class="quiz_content">
                    <!-- <form action="" id="" method="post"> -->
                        <div class="goods-comm">
                            <div class="goods-comm-stars">
                                <span class="star_l">满意度：</span>
                                <div id="rate-comm-1" class="rate-comm"></div>
                                <!-- 满意度 -->
                                <div id="div1" style="display:none"></div>
                                     <!-- 房源id -->
                                <div id="div7" style="display:none">{{$arr->h_id}}</div>
                                <!-- session id -->
                                <div id="div5" style="display:none">
                           
                                
                                   <?php 
                                        $Uid = Session::get('id');
                                        echo $Uid;
                                    ?>

                                </div>
                                <!-- 判断用户名是否存在 用于重新登录-->
                                <div id="div2" style="display:none">
                                    <?php
                                        $name = Session::get('name');
                                        if(isset($name)){
                                            echo '1';
                                        }else{
                                            echo "0";
                                        }
                                    ?>
                                </div>
                                <div id="div3" style="display:none">
                                    <?php 
                                        // $url = $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
                                        $url = $_SERVER['REQUEST_URI'];
                                        echo $url;
                                     ?>
                                </div>
                                <div id="div4" style="display:none">{{$arr->h_id}}</div>

                                <div id="aa"></div>
                            </div>
                        </div>

                        <div class="l_text">
                            <label class="m_flo">内  容：</label>
                            <textarea name="textd" id="test" class="text"></textarea>
                            <span class="tr">字数限制为5-200个</span>
                        </div>
                        <button class="btm" id="commits" type="button"></button>
                    <!-- </form> -->
             </div><!--quiz_content end-->  
             <!-- 用户评论 -->
             <script>
                $('#commits').click(function(){
                    SessionName = $('#div2').html();
                    UrlVal = $('#div3').html();
                    UrlVals = UrlVal.trim(UrlVal);
                    // UrlValss = UrlVals.substring(1);
                    if(SessionName == 0){
                        alert("您还没有登录，请先登录！！");
                        // alert(UrlVals);
                        location.href="{{URL('login')}}";
                        var data = {'UrlVals':UrlVals};
                        var url = "{{URL('login')}}";
                        $.get(url,data,function(msg){
                            // alert(msg)
                        })
                    }else{
                        XingVal = $('#div1').html();
                        TextVal = $('#test').val();
                        Id = $('#div4').html();
                        Hid = $('#div7').html();
                        SessionId = $('#div5').html();
                        var data = {'XingVal':XingVal,'TextVal':TextVal,'Id':Id,'SessionId':SessionId,'Hid':Hid};
                        var url ="{{URL('index/comments')}}";
                        $.get(url,data,function(msg){
                            if(msg == 2){
                                alert('亲！！！只能评论一次哦');
                            }else if(msg == 0){
                                alert('亲！！！您的评论已生效');
                            }else{
                                $('#ping').html(msg);
                            }
                            
                        })

                    }
                })
             </script> 
        </div> 
                    
                    

            </div>
            
                </div>
        <!--没有数据时不显示-->
            <div class="probox">
                <div class="probox-heading">
                    <div class="sprite sprite_probox_ico porbox-ico">荐</div>
                    <div class="probox-title">猜你喜欢</div>
                </div>
                <div class="probox-body-d p_recommend">
                    <div class=" rec-list row-5">  
                    @foreach($Recommend as $value)                
                        <div class="col-sm-3 thumbnail thumbnail-c">
                            <a class="rec-p"  href="{{URL('index/details')}}?id={{$value->h_id}}">
                            <img alt="金沙海棠 地铁2号线羊犀立交站 西单附近 非中介精装单" data-original="http://www.linjing.com/public/images/@if(strstr($value->h_photo, '|', TRUE)){{strstr($value->h_photo, '|', TRUE)}}@else{{$value->h_photo}}@endif" alt="{{$value->h_title}}" width="158" height="105" />
                            </a>
                            <p class="rec-info"> <a href="{{URL('index/details')}}?id={{$value->h_id}}">{{$value->h_title}}</a></p>
                            <div class="rec-price">
                                ¥ <span class="text-orange">
                                    <strong>
                                            {{$value->h_price}}
                                    </strong>
                                </span>
                            </div>
                        </div>  
                        @endforeach                                        
                    </div>
                </div>
            </div>



        

    </div>
    <div class=" room_slide" style="width:270px;float:left">
        
        <div class="room_nearby">
            <h5><strong>最新房源</strong></h5>
              
              
                    @foreach($new as $val)
                 <div class="nearby_box">
                    <a class="rec-p" href="{{URL('index/details')}}?id={{$val->h_id}}" >
                            <img src="http://www.linjing.com/public/images/@if(strstr($val->h_photo, '|', TRUE)){{strstr($val->h_photo, '|', TRUE)}}@else{{$val->h_photo}}@endif" alt="{{$val->h_title}}"  />
                    </a>
                    <p class="rec-info">
                        <a class="text-song" href="{{URL('index/details')}}?id={{$val->h_id}}" >{{$val->h_title}}</a>
                    </p>
                    <div class="rec-price">
                        <span class="text-orange">
                            ￥{{$val->h_price}}
                        </span>
                    </div>
                </div>
                @endforeach
        </div>
    </div>
    <div class="clearfix"></div>
</div>

<!-- 预约看房反馈 -->

   <!-- 引入公共脚 -->
   @include('footer')
    
    <!-- 引入客服聊天扫码等插件 -->
    @include('chat')

    <div class="modal fade full-modal" id="weixin_home" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content weixin_home ">

            </div>
        </div>
    </div>


    
    <script src="{{URL::asset('../public')}}/templets/htm/style/js/jquery.lazyload.min.js"></script>
    <script src="{{URL::asset('../public')}}/templets/htm/style/js/datouwang.js"></script>
    <script src="{{URL::asset('../public')}}/templets/htm/style/js/home.min.js"></script>



    <script type="text/javascript">

        $(document).ready(function () {
            Custom.init();
            SetNavClass('member-nav', 'active');
            SetNavClass('uoko-nav', 'active');
        });
        window._bd_share_config = {
            common: {
                "bdSnsKey": {},
                "bdText": "",
                "bdMini": "2",
                "bdMiniList": !1,
                "bdPic": "",
                "bdStyle": "0",
                "bdSize": "16",
                bdMini: 2,
                bdPopupOffsetLeft: -207
            },
            share: [{
                "bdSize": 16
            }]
        }
        with (document) 0[(getElementsByTagName('head')[0] || body).appendChild(createElement('script')).src = 'http://bdimg.share.baidu.com/static/api/js/share.js?cdnversion=' + ~(-new Date() / 36e5)];


        function SetNavClass(ulId, className) {
            var controller = $('#controller').val();
            var action = $('#action').val();
            eval('controller_' + controller + ' = true');
            eval('action_' + action + ' = true');
            var list = $('#' + ulId + ' *');

            for (var k = 0; k < list.length; k++) {
                var item = list[k];
                var str = GetClassName(item);
                var navClass;
                navClass = $(item).attr('data-menu-active-class');
                if (navClass == null || navClass == '') {
                    navClass = className;
                }
                try {
                    if (eval(str)) $(item).addClass(navClass);
                } catch (e) { }
            }
        }
        function GetClassName(item) {
            var classStr = $(item).attr('data-menu-active');
            if (classStr == null) return "";
            var classes = classStr.split(' ');
            for (var k = 0; k < classes.length; k++) {
                if (classes[k].indexOf('controller') > -1 || classes[k].indexOf('action') > -1) return classes[k];
            }
        }


        $(".aboutList").hover(function () {
            $(".aboutList").css({
                "background": "#2CBCB8"
            })
            $(".aboutUoko").stop(true, true).fadeIn(300);

        }, function () {
            $(".aboutList").css({
                "background": "#3FCBC0"
            })
            $(".aboutUoko").stop(true, true).fadeOut(300);
        });

    </script>
  
    <script src="{{URL::asset('../public')}}/templets/htm/style/js/image-margnific.min.js"></script>
    <script src="{{URL::asset('../public')}}/templets/htm/style/js/jquery.lazyload.min.js"></script>
    <script src="{{URL::asset('../public')}}/templets/htm/style/js/_product.js"></script>

</body>

</html>
<script>
    // star choose
jQuery.fn.rater = function(options) {
        
    // 默认参数
    var settings = {
        enabled : true,
        url     : '',
        method  : 'post',
        min     : 1,
        max     : 5,
        step    : 1,
        value   : null,
        after_click : null,
        before_ajax : null,
        after_ajax  : null,
        title_format    : null,
        info_format : null,
        image   : 'http://www.linjing.com/public/templets/discuss/images/comment/stars.jpg',
        imageAll :'http://www.linjing.com/public/templets/discuss/images/comment/stars-all.gif',
        defaultTips :true,
        clickTips :true,
        width   : 24,
        height  : 24
    }; 
    
    // 自定义参数
    if(options) {  
        jQuery.extend(settings, options); 
    }
    
    //外容器
    var container   = jQuery(this);
    
    // 主容器
    var content = jQuery('<ul class="rater-star"></ul>');
    content.css('background-image' , 'url(' + settings.image + ')');
    content.css('height' , settings.height);
    content.css('width' , (settings.width*settings.step) * (settings.max-settings.min+settings.step)/settings.step);
    //显示结果区域
    var result= jQuery('<div class="rater-star-result"></div>');
    container.after(result); 
    //显示点击提示
    var clickTips= jQuery('<div class="rater-click-tips"><span>点击星星就可以评分了</span></div>');
        if(!settings.clickTips){
            clickTips.hide();   
        }
    container.after(clickTips); 
    //默认手形提示
    var tipsItem= jQuery('<li class="rater-star-item-tips"></li>');
    tipsItem.css('width' , (settings.width*settings.step) * (settings.max-settings.min+settings.step)/settings.step);
    tipsItem.css('z-index' , settings.max / settings.step + 2);
        if(!settings.defaultTips){  //隐藏默认的提示
            tipsItem.hide();
        }
    content.append(tipsItem);
    // 当前选中的
    var item    = jQuery('<li class="rater-star-item-current"></li>');
    item.css('background-image' , 'url(' + settings.image + ')');
    item.css('height' , settings.height);
    item.css('width' , 0);
    item.css('z-index' , settings.max / settings.step + 1);
    if (settings.value) {
        item.css('width' , ((settings.value-settings.min)/settings.step+1)*settings.step*settings.width);
    };
    content.append(item);

    
    // 星星
    for (var value=settings.min ; value<=settings.max ; value+=settings.step) {
        item    = jQuery('<li class="rater-star-item"><div class="popinfo"></div></li>');
        if (typeof settings.info_format == 'function') {
            //item.attr('title' , settings.title_format(value));
            item.find(".popinfo").html(settings.info_format(value));
            item.find(".popinfo").css("left",(value-1)*settings.width)
        }
        else {
            item.attr('title' , value);
        }
        item.css('height' , settings.height);
        item.css('width' , (value-settings.min+settings.step)*settings.width);
        item.css('z-index' , (settings.max - value) / settings.step + 1);
        item.css('background-image' , 'url(' + settings.image + ')');
        
        if (!settings.enabled) {    // 若是不能更改，则隐藏
            item.hide();
        }
        
        content.append(item);
    }
    
    content.mouseover(function(){
        if (settings.enabled) {
            jQuery(this).find('.rater-star-item-current').hide();
        }
    }).mouseout(function(){
            jQuery(this).find('.rater-star-item-current').show();
    })
    // 添加鼠标悬停/点击事件
    var shappyWidth=(settings.max-2)*settings.width;
    var happyWidth=(settings.max-1)*settings.width;
    var fullWidth=settings.max*settings.width;
    content.find('.rater-star-item').mouseover(function() {
        jQuery(this).prevAll('.rater-star-item-tips').hide();
        jQuery(this).attr('class' , 'rater-star-item-hover');
        jQuery(this).find(".popinfo").show();
        
        //当3分时用笑脸表示
        if(parseInt(jQuery(this).css("width"))==shappyWidth){
            jQuery(this).addClass('rater-star-happy');
        }
        //当4分时用笑脸表示
        if(parseInt(jQuery(this).css("width"))==happyWidth){
            jQuery(this).addClass('rater-star-happy');
        }
        //当5分时用笑脸表示
        if(parseInt(jQuery(this).css("width"))==fullWidth){
            jQuery(this).removeClass('rater-star-item-hover');
            jQuery(this).css('background-image' , 'url(' + settings.imageAll + ')');
            jQuery(this).css({cursor:'pointer',position:'absolute',left:'0',top:'0'});
        }
    }).mouseout(function() {
        var outObj=jQuery(this);
        outObj.css('background-image' , 'url(' + settings.image + ')');
        outObj.attr('class' , 'rater-star-item');
        outObj.find(".popinfo").hide();
        outObj.removeClass('rater-star-happy');
        jQuery(this).prevAll('.rater-star-item-tips').show();
        //var startTip=function () {
        //outObj.prevAll('.rater-star-item-tips').show();
        //};
        //startTip();
    }).click(function() {
        //jQuery(this).prevAll('.rater-star-item-tips').css('display','none');
        jQuery(this).parents(".rater-star").find(".rater-star-item-tips").remove();
        jQuery(this).parents(".goods-comm-stars").find(".rater-click-tips").remove();
        jQuery(this).prevAll('.rater-star-item-current').css('width' , jQuery(this).width());
           if(parseInt(jQuery(this).prevAll('.rater-star-item-current').css("width"))==happyWidth||parseInt(jQuery(this).prevAll('.rater-star-item-current').css("width"))==shappyWidth){   
            jQuery(this).prevAll('.rater-star-item-current').addClass('rater-star-happy');
            }
        else{
            jQuery(this).prevAll('.rater-star-item-current').removeClass('rater-star-happy');
            }
            if(parseInt(jQuery(this).prevAll('.rater-star-item-current').css("width"))==fullWidth){ 
            jQuery(this).prevAll('.rater-star-item-current').addClass('rater-star-full');
            }
        else{
            jQuery(this).prevAll('.rater-star-item-current').removeClass('rater-star-full');
            }
        var star_count      = (settings.max - settings.min) + settings.step;
        var current_number  = jQuery(this).prevAll('.rater-star-item').size()+1;
        var current_value   = settings.min + (current_number - 1) * settings.step;
        
        //显示当前分值
        if (typeof settings.title_format == 'function') {
            jQuery(this).parents().nextAll('.rater-star-result').html(current_value+'分&nbsp;'+settings.title_format(current_value));
            jQuery(this).parents().nextAll('#div1').html(current_value);
        }
        //jQuery(this).parents().next('.rater-star-result').html(current_value);
        //jQuery(this).unbind('mouseout',startTip)
    })
    
    jQuery(this).html(content);
    
}

// 星星打分
$(function(){
    var options = {
    max : 5,
    title_format    : function(value) {
        var title = '';
        switch (value) {
            case 1 : 
                title   = '很不满意';
                break;
            case 2 : 
                title   = '不满意';
                break;
            case 3 : 
                title   = '一般';
                break;
            case 4 : 
                title   = '满意';
                break;
            case 5 : 
                title   = '非常满意';
                break;
            default :
                title = value;
                break;
        }
        return title;
    },
    info_format : function(value) {
        var info = '';
        switch (value) {
            case 1 : 
                info    = '<div class="info-box">1分&nbsp;很不满意<div>商品样式和质量都非常差，太令人失望了！</div></div>';
                break;
            case 2 : 
                info    = '<div class="info-box">2分&nbsp;不满意<div>商品样式和质量不好，不能满足要求。</div></div>';
                break;
            case 3 : 
                info    = '<div class="info-box">3分&nbsp;一般<div>商品样式和质量感觉一般。</div></div>';
                break;
            case 4 : 
                info    = '<div class="info-box">4分&nbsp;满意<div>商品样式和质量都比较满意，符合我的期望。</div></div>';
                break;
            case 5 : 
                info    = '<div class="info-box">5分&nbsp;非常满意<div>我很喜欢！商品样式和质量都很满意，太棒了！</div></div>';
                break;
            default :
                info = value;
                break;
        }
            return info;
        }
    }
    $('#rate-comm-1').rater(options);

});
</script>