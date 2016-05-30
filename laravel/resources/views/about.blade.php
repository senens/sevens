<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    
    <title>关于我们_邻京有屋 轻时尚单身公寓</title>
    <meta name="keywords" content="" />
    <meta name="description" content="" />
    
    <script language="javascript">
msg = "关于我们_邻京有屋 轻时尚单身公寓";

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
            
            <li class="active"><a href="/plus/list.php?tid=4">关于我们</a></li>
            
    </ol>
    <div class="row">
        <div class="col-md-3">
            
<div class="sidebar sidebar-about">
    <ul class="nav sidenav">
       
       <li class="active">
            <a href="/plus/list.php?tid=4">
                关于我们<br />
                <small>About_us</small>
            </a>
        </li>
        
       <li>
            <a href="/plus/list.php?tid=42">
                选择我们<br />
                <small>Choose</small>
            </a>
        </li>
        
       
        
       <li >
            <a href="/plus/list.php?tid=41">
                企业成长<br />
                <small>Blog</small>
            </a>
        </li>
        
       <li>
            <a href="/plus/list.php?tid=40">
                联系我们<br />
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
	<h4>
		初心：</h4>
	不论在哪座城市生活<br />
	都需要一个安心舒适的小窝<br />
	否则就失去了打拼的意义<br />
	但目前而言，租房是一件痛苦的事<br />
	所以我们创办了邻京有屋，我们希望它的存在<br />
	能让漂泊在城市里追逐梦想的年轻人住得安心、舒适、有尊严<br />
	能让住在这里的人认识更多志趣相投的朋友，感受家的温暖。<br />
	让每个人的租房时代留下美好的回忆</div>
<div class="content-1">
	<h4 style="margin-top: 30px;">
		品牌介绍：</h4>
	<p>
		邻京有屋，隶属于北京用友信息技术有限公司。是为城市租房人群提供高品质长租公寓和服务的O2O互联网运营商。</p>
	
	<p>
		<b>邻京有屋，为两类客户提供服务：对闲置房产小业主</b>，是提供一站式房屋租赁增值管理解决方案。<b>对城市租房客</b>，是提供高品质的长租公寓产品，租后服务，以及围绕房屋、居住社交而延生的增值服务。企业愿景是成为<b>&ldquo;美好生活运营商&rdquo;</b>。</p>
	<p>
		邻京有屋，目前在北京三地运营，未来将扩展到更多全国一线和二线城市。</p>
</div>
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
