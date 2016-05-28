<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    
    <title>用户中心</title>
    <meta name="keywords" content="" />
    <meta name="description" content="" />
    
    <script language="javascript">
msg = "用户中心";

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



    
    <style>
        footer {
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
        }

        .content-1 {
            line-height: 34px;
            clear: both;
        }

            .content-1 h4 {
                font-weight: 700;
            }
    </style>



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

    <input id="controller" type="hidden" value="guanyuwomen" />
    <input id="action" type="hidden" value="Index" />
    
     <!-- 引入公共头 -->
     @include('header')

    <div class="clearfix"></div>


    <div class="container">
    <ol class="breadcrumb">
    
          <li><a href="/">首页</a></li>
        <?php
        $value = Session::get('name');
        ?>

            <li class="active"><a href="/plus/list.php?tid=4">用户中心</a></li>
            
    </ol>
    <div class="row">
        <div class="col-md-3">
            
<div class="sidebar sidebar-about">
    <ul class="nav sidenav">
        <li class="active">
        <li class="active">
            <a href="{{URL('user/uhouse')}}">
                上传房源<br />
                <small>About_us</small>
            </a>
        </li>
        <li>
            <a href="{{URL('user/tenantmessage')}}">
                房东信息<br />
                <small>Choose</small>
            </a>
        </li>

        <li >
            <a href="{{URL('user/sellh')}}">
                已租房源<br />
                <small>Blog</small>
            </a>
        </li>

        <li>
            <a href="{{URL('user/sellingh')}}">
                在租房源<br />
                <small>Contacts</small>
            </a>
        </li>

    </ul>
</div>
        </div>
        <div class="col-md-9">
            <div class="article">
                <div class="content" style="clear: both">
                    <div class="content-1" style="line-height:26px;"><div class="content-1">
	<h2>个人信息</h2>
                   @foreach($valls as $vv)

                   <h4>头像</h4>
                   <h4><img src="{{URL::asset('../public/uploads')}}/{{$vv->u_header_url}}" width="200px" height="200px"/></h4>
                   <h4><font color="#00ced1">用户名：</font>{{$vv->u_name}} <br /> </h4>
                   <h4><font color="#00ced1">昵称：</font>{{$vv->u_nickname}} <br /></h4>
                   <h4><font color="#00ced1">性别：</font>{{$vv->u_sex}} <br /></h4>
                   <h4><font color="#00ced1">电话：</font> {{$vv->u_phone}} <br /></h4>
                   <h4><font color="#00ced1">email：</font> {{$vv->u_email}} <br /></h4>
                    @endforeach
                            <br />

                        </div>
                    </div>
                <div class="bk30"></div><div class="bk30"></div> <div class="bk30"></div><div class="bk30"></div><div class="bk30"></div>
            </div><div class="bk30"></div><div class="bk30"></div>
        </div>
    </div>
    <div class="bk20"></div>    <div class="bk20"></div>    <div class="bk20"></div>    
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

</body>

</html>
