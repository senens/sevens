<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

    <title>联系我们_邻京有屋轻时尚单身公寓</title>
    <meta name="keywords" content="" />
    <meta name="description" content="" />
    
    <script language="javascript">
    msg = "联系我们_邻京有屋轻时尚单身公寓";
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
    <link href="{{URL::asset('../public')}}/templets/htm/style/css/common.min.css" rel="stylesheet"/>   
    <link href="{{URL::asset('../public')}}/templets/htm/style/css/emailSubscribe.css" rel="stylesheet" />
    <link href="{{URL::asset('../public')}}/templets/htm/style/css/datepicker.min.css" rel="stylesheet" />
    <link href="{{URL::asset('../public')}}/templets/htm/style/css/rangeSlider.css" rel="stylesheet" />
    <style>
        .MainBg{
            padding-bottom:107px;
        }

    </style>

    
    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon" />
    <!--[if lt IE 8]>
        <script type="text/javascript">
            document.write('<script type="text/javascript">window.top.location = "/noie/";<\/script>');
        </script>
    <![endif]-->
    <!--[if lt IE 9]>
        <script type="text/javascript"src='templets/htm/style/js/html5shiv.js'>
        <script src='templets/htm/style/js/respond.min.js'></script>

        </script>
    <![endif]-->

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
         <!-- 引入公共头 -->
         @include('header')
    <div class="clearfix"></div>
   
<div class="MainBg">
    <div class="container ">
        <ol class="breadcrumb">       
            <li><a href="/"><i class="fa fa-home"></i>首页</a></li>  
            <li><a href="http://www.linjing.com/server.php/index/talk">关于我们</a></li>  
        </ol>
        <ul id="nav-contact" class="nav-0 nav-tabs ">
            <li class="active"><a href="#contact_about" data-toggle="tab">关于我们</a></li>
            <li><a href="#contact_info" data-toggle="tab">联系我们</a></li>
            <!-- <li><a href="#contact_mess" data-toggle="tab">我有话要说</a></li> -->
            
        </ul>
        <div class="clearfix"></div>

        <div class="tab-content WhiteBg cantact" style="background:#F4F4F4">
            <div class="tab-pane connect in active" id="contact_about" >
                <div class="can-title">
                    <h3>关于我们</h3>
                    <h6>ABOUT US</h6>
                </div>
            
                    <h4>初心：</h4>
                    不论在哪座城市生活<br />
                    都需要一个安心舒适的小窝<br />
                    否则就失去了打拼的意义<br />
                    但目前而言，租房是一件痛苦的事<br />
                    所以我们创办了邻京有屋，我们希望它的存在<br />
                    能让漂泊在城市里追逐梦想的年轻人住得安心、舒适、有尊严<br />
                    能让住在这里的人认识更多志趣相投的朋友，感受家的温暖。<br />
                    让每个人的租房时代留下美好的回忆
                    <div class="content-1">
                        <h4 style="margin-top: 30px;">
                            品牌介绍：</h4>
                        <p>
                            邻京有屋，隶属于北京用友信息技术有限公司。是为城市租房人群提供高品质长租公寓和服务的O2O互联网运营商。</p>
                        <p>
                            <b>邻京有屋，为两类客户提供服务：对闲置房产小业主</b>，是提供一站式房屋租赁增值管理解决方案。<b>对城市租房客</b>，是提供高品质的长租公寓产品，租后服务，以及围绕房屋、居住社交而延生的增值服务。企业愿景是成为<b>&ldquo;美好生活运营商&rdquo;</b>。</p>
                        <p>邻京有屋，目前在北京运营，未来将扩展到更多全国一线和二线城市。</p>
                    </div>   
            </div>
            
            <div class="tab-pane connect in" id="contact_info">
                <div class="can-title">
                    <div class="sprite sprite_contact_title"></div>
                    <div class="name">
                        <h3>联系我们</h3>       
                        <h6>CONTACT US</h6>
                    </div>
                </div>
                <div class="bk30"></div>
                
            <div  style="font-size:14px; line-height:26px; "><div class="row" style="box-sizing: border-box; margin-left: -15px; margin-right: -15px; color: rgb(51, 51, 51); font-family: 微软雅黑, Arial, sans-serif; font-size: 14px; line-height: 20px;">
	        <div class="col-sm-10" style="box-sizing: border-box; position: relative; min-height: 1px; padding-left: 15px; padding-right: 15px; float: left; width: 875px;">
		    <div class="addr addr_chengdu" style="box-sizing: border-box; margin-bottom: 30px;">
			<div class="title" style="box-sizing: border-box;">
				<h4 class="name text-orange" style="box-sizing: border-box; font-family: inherit; font-weight: 500; line-height: 1.1; color: rgb(255, 83, 0); margin-top: 10px; margin-bottom: 10px; font-size: 18px;">
				<strong style="box-sizing: border-box;">◆ 邻京有屋</strong>&nbsp;<small style="box-sizing: border-box; font-size: 14px; line-height: 1;">北京公司</small>
                </h4>
			</div>
			<div class="row info" style="box-sizing: border-box; margin-left: -15px; margin-right: -15px; margin-top: 20px;">
				<div class="info-box  col-sm-4 col-md-3" style="box-sizing: border-box; position: relative; min-height: 1px; padding-left: 15px; padding-right: 15px; float: left; width: 218.75px; margin-bottom: 20px;">
					<span class="info-n" style="box-sizing: border-box; margin-right: 10px;">客服热线</span>&nbsp;<span class="info-i" style="box-sizing: border-box; font-weight: 700;">400-000-XXXX</span></div>
				<div class="info-box  col-sm-4 col-md-3" style="box-sizing: border-box; position: relative; min-height: 1px; padding-left: 15px; padding-right: 15px; float: left; width: 218.75px; margin-bottom: 20px;">
					<span class="info-n" style="box-sizing: border-box; margin-right: 10px;">集团总部</span>&nbsp;<span class="info-i" style="box-sizing: border-box; font-weight: 700;">028-1234567</span></div>
				
				<div class="info-box col-sm-4 col-md-3" style="box-sizing: border-box; position: relative; min-height: 1px; padding-left: 15px; padding-right: 15px; float: left; width: 218.75px; margin-bottom: 20px;">
					<span class="info-n" style="box-sizing: border-box; margin-right: 10px;">官方微博</span>&nbsp;<span class="info-i" style="box-sizing: border-box; font-weight: 700;"><a href="http://weibo.com/2789347361/profile?topnav=1&wvr=6&is_all=1" rel="nofollow" style="box-sizing: border-box; color: rgb(51, 51, 51); text-decoration: none; background: transparent;" target="_blank">@邻京有屋</a></span></div>
				<div class="info-box  col-sm-12" style="box-sizing: border-box; position: relative; min-height: 1px; padding-left: 15px; padding-right: 15px; float: left; width: 875px; margin-bottom: 20px;">
					<span class="info-n" style="box-sizing: border-box; margin-right: 10px;">公司地址</span>&nbsp;<span class="info-i" style="box-sizing: border-box; font-weight: 700;">北京市海淀区中关村软件园八维学院</span></div>
			</div>
		</div>
	</div>
	<div class="col-sm-2" style="box-sizing: border-box; position: relative; min-height: 1px; padding-left: 15px; padding-right: 15px; float: left; width: 175px;">
		<img alt="微信租房,微信看房,微信合租" height="131" src="{{URL::asset('../public')}}/templets/htm/style/images/weixin.png" style="box-sizing: border-box; border: 0px; vertical-align: middle;" width="131" /></div>
</div>

<br />
</div> <div class="bk10"></div>
</div>
           
    <!-- <div class="tab-pane connect in" id="contact_mess">
        <div class="can-title">
            <h3>我有话要说</h3>
            <h6>MESSAGES</h6>
        </div>
        <form action="" enctype="multipart/form-data" method="post">
        <div class="contact_message">
            <h6 class="mini text-brown"></h6>
            <h4 class="title text-brown"></h4>
            <div class="bk10"></div>
            <input type="hidden" id="op" />
            <div class="btn-group" data-toggle="buttons">
                <label class="btn   btn-message">
                    <input type="radio" name="options" id="option1" value="1" />
                    我有建议
                    <span class="caret"></span>
                </label>
                <label class="btn   btn-message">
                    <input type="radio" name="options" id="option2" value="2" />
                    我要投诉
                    <span class="caret"></span>
                </label>
               <label class="btn   btn-message">
                   <input type="radio" name="options" id="option3" value="我要投诉" />
                   我要投诉
                   <span class="caret"></span>
               </label>
            </div>
            <div class="bk30"></div>
            <div class="form" role="form">
                <div class="row">
                    <div class="col-md-8">
                        <div class="form-group">
                            <label for="UOKOTALK" class="AreaText">我想说的是：</label>
                            <textarea id="UOKOTALK" name="content" class="form-control message_content" rows="8" placeholder="您想对我说？"></textarea>
                        </div>
                    </div>
                    <div class="col-md-4 hidden-xs hidden-sm">
                        <div class="form-group AreaInfo">
                            <p class="form-control-static AreaText">
                                有关业务联络合作事项，<br />
                                可以给我们发邮件或者打电话<br />
                                或者您在这里提交您的信息<br />
                                无需重复提交，我们会在三天内答复您。
                            </p>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="UOKOUSER" class="AreaText">姓名：</label>
                            <input id="UOKOUSER" type="text" name="username" class="form-control message_content" check-type="required" />
    
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="UOKOUSERPHONE" class="AreaText">联系方式：</label>
                            <input id="UOKOUSERPHONE" type="text" name="phone" class="form-control message_content" check-type="required tel" />
                        </div>
                    </div>                    
                </div>
                <div class="bk10"></div>
                <button type="submit" name="submit" class="btn btn-lg btn-yellow btn-contact btn-valid">提交留言</button>
                <div class="bk30"></div>
            </div>
    
        </div>
        </form>            
    </div> -->
            









        </div>

    </div>

</div>



<div id="valid-alert" class="modal fade  confirm_modal" aria-labelledby="mySmallModalLabel" role="dialog" tabindex="-1">
    <div class="modal-dialog">
        <div class="alert alert-warning fade in">
            <button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>
            <h3 class="text-center"><i class="fa fa-exclamation-triangle"></i>请确认您提交的信息完整！</h3>
        </div>

    </div>
</div>

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


    
    <script src="{{URL::asset('../public')}}/templets/htm/style/js/validation.min.js"></script>
    <script type="text/javascript">
    $(function () {
        var valid = $(".container").validation();
        $(".btn-valid").on('click', function (event) {

            if (valid.valid() == false) {
               // $("#valid-alert").modal('show');
                return false;
            }
            return true;
           
        });

       
        $(window).on('load', function () {
            var LoactionUrl = location.href.split("#")[1];
            if (LoactionUrl == 'contact_mess') {
                $("#nav-contact").find("li").eq(1).addClass("active").siblings("li").removeClass("active");
                $("#contact_mess").addClass("active").siblings().removeClass("active");
            }

            var op = $("#op").val();
            if (op != 1 && op != 2 && op != 3) {
                op = 1;
            }
            var opLabel = $("div.btn-group").children("label.btn-message").eq(op - 1);
            opLabel.addClass("active").children("input").attr("checked", true);
        });

        var msg = '';
        if (msg) {
            alert(msg);
        }
    })
</script>

    

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

</body>

</html>
