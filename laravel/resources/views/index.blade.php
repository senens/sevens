<!DOCTYPE html>
<html id="div1">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    
    <title>邻京有屋 轻时尚单身公寓</title>
    <meta name="keywords" content="单身公寓,邻京有屋" />
    <meta name="description" content="邻京有屋提供成都合租房,单身公寓出租,专为城市白领打造轻时尚房屋出租,免中介费,免费Wifi,拎包入住.价格500-1500元/月,我们做有温度有爱的房子！" />
    
    <script language="javascript">
        msg = "_邻京有屋 轻时尚单身公寓";

        msg = "" + msg;pos = 0;
        function scrollMSG() {
        document.title = msg.substring(pos, msg.length) + msg.substring(0, pos);
        pos++;
        if (pos >  msg.length) pos = 0
        window.setTimeout("scrollMSG()",200);
        }
        scrollMSG();
    </script> 
    
    <script src="http://www.linjing.com/public/templets/htm/style/js/jquery-1.9.1.js"></script>
    <script src="http://www.linjing.com/public/templets/htm/style/js/base.min.js"></script>
    <script src="http://www.linjing.com/public/templets/htm/style/js/common.js"></script>
    <script src="http://www.linjing.com/public/templets/htm/style/js/g.js"></script>

    <link href="http://www.linjing.com/public/templets/htm/style/css/common.min.css" rel="stylesheet"/>  
    <link href="http://www.linjing.com/public/templets/htm/style/css/datouwang.min.css" rel="stylesheet" /> 

    <script type="text/javascript">
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
    <input id="controller" type="hidden" value="Home" />
    <input id="action" type="hidden" value="Index" />
    <!-- 引入公共头 -->
         @include('header')
    <div class="clearfix"></div>

<div class="jum-banner">

    <div class="shuff">
        <ul class="rslides f426x240">  
            @foreach($img as $k=>$i)             
            <li style="background-color:{{$ad->act_bgcolor}}">
                <a href="#" target="_blank"><img data-src="http://localhost/linjing/uploads/{{$i}}" src="http://localhost/linjing/uploads/{{$i}}" alt="{{$ad->act_name}}" /></a>
            </li>
            @endforeach    
        </ul>
    </div>

</div>


<div class="i-search">
    <div class="search-main">
        <form  name="formsearch" action="{{URL('search')}}" method="get">
        <div class="i-search-box">
        <input name="searchs" type="text" class="form-control" id="sou" placeholder="目前开通北京，可搜索区域,商圈,小区">
        <i class="i-spring-ice"></i>
        </div>
        
        <div class="btn-jixue"></div>
        <button class="btn  search-btn" name="submit"  id="btnSearch" type="submit"></button>
        <!--<a class="home-map-serach" href="/search_map/" title="地图找房" target="_blank"></a>-->
        </form>
        <div class="clearfix"></div>
        <!-- <div class="search-keywords">
            全局变量
            <span><strong>热门区域：</strong></span>
            <a href="">高新区</a>&nbsp;<a href="">川师</a>&nbsp;<a href="">软件园</a>&nbsp;<a href="">大源</a>&nbsp;<a href="">建设路</a>
        </div> -->
    </div>
</div>

<div class="i-list container-min">
    <div class="list-name">精选房源</div>
    @foreach($data as $v) 
<div class="thumb-box">
    <a href="{{URL('index/details')}}?id={{$v->h_id}}" target="_blank">
        <img src="http://www.linjing.com/public/templets/htm/style/images/loading.gif" data-original="http://www.linjing.com/public/images/@if(strstr($v->h_photo, '|', TRUE)){{strstr($v->h_photo, '|', TRUE)}}@else{{$v->h_photo}}@endif" width=" 318" height="212" alt="{{$v->h_title}}" />
    </a>
    <h4 class="title">
        <a href="{{URL('index/details')}}?id={{$v->h_id}}" target="_blank">
            <strong>{{$v->h_title}}</strong>
        </a>
    </h4>
    <div class="price">
        <span>¥</span>
            {{$v->h_price}}
        <span class="price-months">元/月</span>
    </div>
    <p class="des">{{$v->h_description}}</p>
    <div class="clearfix"></div>
        </div>
       @endforeach
</div>

<div class="jum-choose">
    <!--全局变量-->
    <img class="center-block" src="http://www.linjing.com/public/templets/htm/style/images/i-choose_title.png" alt="选择优客的5项理由" />
    <div class="i-choose-list">
        <div class="box">
            <img class="center-block" width="90" height="90" src="http://www.linjing.com/public/templets/htm/style/images/_blank.gif" data-original="http://www.linjing.com/public/templets/htm/style/images/i-choose_01.png" alt="无中介费 网上看房 拎包入住" />
            <h4 class="title">无中介费</h4>
            <p>网上看房 拎包入住</p>
        </div>
        <div class="box">
            <img class="center-block" width="90" height="90" src="http://www.linjing.com/public/templets/htm/style/images/_blank.gif" data-original="http://www.linjing.com/public//templets/htm/style/images/i-choose_02.png" alt="年轻人 生活品质" />
            <h4 class="title">年轻人</h4>
            <p>我们追求 生活品质</p>
        </div>
        <div class="box">
            <img class="center-block" width="90" height="90" src="http://www.linjing.com/public/templets/htm/style/images/_blank.gif" data-original="http://www.linjing.com/public/templets/htm/style/images/i-choose_03.png" alt="真实房源 凭证齐全 一房一价" />
            <h4 class="title">真实房源</h4>
            <p>凭证齐全 一房一价</p>
        </div>
        <div class="box">
            <img class="center-block" width="90" height="90" src="http://www.linjing.com/public/templets/htm/style/images/_blank.gif" data-original="http://www.linjing.com/public/templets/htm/style/images/i-choose_05.png" alt="光纤网络 免费wifi" />
            <h4 class="title">免费wifi</h4>
            <p>光纤网络 基情LOL</p>
        </div>
        <div class="box">
            <img class="center-block" width="90" height="90" src="http://www.linjing.com/public/templets/htm/style/images/_blank.gif" data-original="http://www.linjing.com/public/templets/htm/style/images/i-choose_04.png" alt="提供维修保洁等各类管理服务" />
            <h4 class="title">维修保洁</h4>
            <p>提供各类管理服务</p>
        </div>
        <div class="clearfix"></div>
    </div>
</div>
<div class="i-record">
    <div class="container">        
        <img src="http://www.linjing.com/public/templets/htm/style/images/i-show-cd.png" width="1070" alt="邻京有屋品质服务" />
    </div>
</div>
<div class="clearfix"></div>

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
    <script src="http://www.linjing.com/public/templets/htm/style/js/jquery.lazyload.min.js"></script>
    <script src="http://www.linjing.com/public/templets/htm/style/js/datouwang.js"></script>
    <script src="http://www.linjing.com/public/templets/htm/style/js/home.min.js"></script>



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

        // function xiangQing(id){
        //     // var data = {'id':id};
        //     // var url = "{{URL::asset('index/details')}}";
        //     // $.get(url,data,function(msg){
        //     //     // if(msg){
        //             location.href="{{URL::asset('index/details')}}";
        //         // }
                
        //     })
        // }
    </script>

</body>

</html>
<script src="./jquery.js"></script>

