<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    
    <title>我要租房_邻家有屋 轻时尚单身公寓</title>
    <meta name="keywords" content="" />
    <meta name="description" content="" />
    
    <script language="javascript">
msg = "我要租房_邻家有屋 轻时尚单身公寓";

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

    <link href="{{URL::asset('../public')}}/templets/htm/style/css/dede_pages.css" rel="stylesheet"/>
    
    <link href="{{URL::asset('../public')}}/templets/htm/style/css/common.min.css" rel="stylesheet"/>



    
        <style>
            body{background:#f4f4f4;}
        </style>


    <script type="text/javascript">


        var zd = '0';
        if (zd == 0 && getCookie("zd") == null) {
            document.write('<script src="{{URL::asset('../public')}}/templets/htm/style/js/p.mini.js"><\/script>');
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


    


<div class="search-box">

    <div class="container-min">
        <ol class="breadcrumb">
        
          <li><a href="/">首页</a></li>
            
            <li class="active"><a href="/plus/list.php?tid=1">我要租房</a></li>
            
      </ol>
       
        <div class="nav-search-tabs search_title">
            <ul class="nav nav-tabs nav-search ">
                <li class="active">

                    <a href="/plus/list.php?tid=1" class="title_name title_1"><span class="sprite sprite_select_1"></span> 条件找房</a>
                    
                </li>

                <!--<li class="nav-new">
                    <a href="/search_map/" class=" title_name title_1"><span class="glyphicon glyphicon-map-marker text-yellow"></span> 地图找房 <span class=" sprite_search_new"></span></a>
                </li>-->

            </ul>
        </div>
        <div class="tab-content tab-seach">
            <div class="tab-pane fade in active">
                <div class="selection">
                    
                    <div class="s-box">
                       
                              <form  name="formsearch" action="\plus/search.php">
 <input type="hidden" name="domains" value="www.dedecms.com">
   <input type="hidden" name="kwtype" value="0" />
                        <div class="s-input input-group">
                            <input name="q" type="text" class="form-control search-input-1 top-search-keydown" id="KKW2" value="" placeholder="输入商圈、地标、景点等" />
                            <span class="input-group-btn">
                            <button class="btn btn-orange search-input-1 top-search-button" type="submit"  name="submit"  id="btnSearch">搜 索</button>
                            </span>
                        </div>
                        </form>
                        
                        
                        
                        <!---这里是全局变量---->
                        <div class="s-key">
            <a href="/plus/search.php?domains=www.dedecms.com&kwtype=0&q=高新区">高新区</a>&nbsp;<a href="/plus/search.php?domains=www.dedecms.com&kwtype=0&q=川师">川师</a>&nbsp;<a href="/plus/search.php?domains=www.dedecms.com&kwtype=0&q=软件园">软件园</a>&nbsp;<a href="/plus/search.php?domains=www.dedecms.com&kwtype=0&q=大源">大源</a>&nbsp;<a href="/plus/search.php?domains=www.dedecms.com&kwtype=0&q=建设路">建设路</a>
                            
                        </div>
                        <div class="bk20"></div>
                    </div>
                    
                    <div class="s-box">
                        <div class="s-title">区域：</div>
                        <div class="s-l">
                        
                                <a class="s-all  active" href="/plus/list.php?tid=1">全部</a>
                                
                                <a class="s-area " href="/plus/list.php?tid=11">青羊区</a>
                                
                                <a class="s-area " href="/plus/list.php?tid=12">武侯区</a>
                                
                                <a class="s-area " href="/plus/list.php?tid=13">成华区</a>
                                
                                <a class="s-area " href="/plus/list.php?tid=14">金牛区</a>
                                
                                <a class="s-area " href="/plus/list.php?tid=15">锦江区</a>
                                
                                <a class="s-area " href="/plus/list.php?tid=16">高新区</a>
                                
                                <a class="s-area " href="/plus/list.php?tid=17">高新西区</a>
                                
                        </div>
                        
                       
                    </div>
                    <div class="s-box">
                        <div class="s-title">租金：</div>
                        <div class="s-l">
                        
                                <a class="s-all  active" href="/plus/list.php?tid=1">全部</a>
                                
                                <a class="s-area " href="/plus/list.php?tid=18">500-700</a>
                                
                                <a class="s-area " href="/plus/list.php?tid=19">700-1000</a>
                                
                                <a class="s-area " href="/plus/list.php?tid=20">1000-1500</a>
                                
                                <a class="s-area " href="/plus/list.php?tid=21">1500-2000</a>
                                
                                <a class="s-area " href="/plus/list.php?tid=22">2000以上</a>
              
                        </div>
                    </div>
                    <div class="s-box">
                        <div class="s-title">户型：</div>
                        <div class="s-l">
                        
                                <a class="s-all  active" href="/plus/list.php?tid=1">全部</a>
                                
                                <a class="s-area " href="/plus/list.php?tid=23">普通单间</a>
                                
                                <a class="s-area " href="/plus/list.php?tid=24">主卧带独卫</a>
                                
                                <a class="s-area " href="/plus/list.php?tid=25">标间小套一</a>
                                
                                <a class="s-area " href="/plus/list.php?tid=26">整租</a>

                        </div>
                    </div>
                    <div class="s-box">
                        <div class="s-title">入住：</div>
                        <div class="s-l">
                        
                                <a class="s-all  active" href="/plus/list.php?tid=1">全部</a>
                                
                                <a class="s-area " href="/plus/list.php?tid=28">可立即入住</a>
                                
                                <a class="s-area " href="/plus/list.php?tid=29">一周内入住</a>
                                
                                <a class="s-area " href="/plus/list.php?tid=30">两周内入住</a>

                                
                        </div>
                    </div>
                    <div class="s-box">
                        <div class="s-title">室友：</div>
                        <div class="s-l">
                        
                                <a class="s-all  active" href="/plus/list.php?tid=1">无所谓</a>
                                
                                <a class="s-area " href="/plus/list.php?tid=31">全是妹子</a>
                                
                                <a class="s-area " href="/plus/list.php?tid=32">全是汉子</a>
                                
                                <a class="s-area " href="/plus/list.php?tid=33">爱情公寓</a>
                        </div>
                    </div>
                    <div class="s-box">
                        <div class="s-title">配置：</div>
                        <div class="s-l s-checkbox">
                        
                                <a href="/plus/list.php?tid=34"><i class="fa fa-square-o"></i> 独立卫生间</a>
                                
                                <a href="/plus/list.php?tid=35"><i class="fa fa-square-o"></i> 带飘窗</a>
                                
                                <a href="/plus/list.php?tid=36"><i class="fa fa-square-o"></i> 带阳台</a>
                                
                                <a href="/plus/list.php?tid=37"><i class="fa fa-square-o"></i> 双床</a>
                                
                                <a href="/plus/list.php?tid=38"><i class="fa fa-square-o"></i> 可住俩人</a>
                                
                        </div>
                    </div>
                </div>
            </div>
        </div>

<a href="/plus/list.php?tid=49" title="有新房通知我" target="_blank" class="new_email email-c"></a>
        
    </div>
</div>
<div class="bk20"></div>

<div class="i-list container-min" style="overflow: visible;">


         
         <div class="thumb-box ">
            <a href="/rent/area/cdqyq/2015/0802/9.html" target="_blank">
                <img src="{{URL::asset('../public')}}/templets/htm/style/images/loading.gif" alt="<b>蓝光coco蜜城 【青羊区-光华】蓝光coco蜜城 青羊贝森 优品道旁 精装套三合租 出</b>" width="318" height="212" border="0" data-original="http://www.uoko.com/Image?imgid=98345&width=800&height=447&w=1" />
            </a>

        <h4 class="title"><a href="/rent/area/cdqyq/2015/0802/9.html"><strong><b>蓝光coco蜜城 【青羊区-光华】蓝光coco蜜城 青羊贝森 优品道旁 精装套三合租 出</b></strong></a></h4>
            <div class="price">
                <span>¥</span>
                    650-850
                元/月
            </div>
            <p class="des">青羊区 - 光华 - 蓝光coco蜜城</p>
            <div class="clearfix"></div>
        </div><div class="thumb-box ">
            <a href="/rent/area/cdqyq/2015/0802/8.html" target="_blank">
                <img src="{{URL::asset('../public')}}/templets/htm/style/images/loading.gif" alt="<b>蓝光coco蜜城 【无中介费】出门58路等公交直达市中心</b>" width="318" height="212" border="0" data-original="http://www.uoko.com/Image?imgid=116419&width=800&height=447&w=1" />
            </a>

        <h4 class="title"><a href="/rent/area/cdqyq/2015/0802/8.html"><strong><b>蓝光coco蜜城 【无中介费】出门58路等公交直达市中心</b></strong></a></h4>
            <div class="price">
                <span>¥</span>
                    750-950
                元/月
            </div>
            <p class="des">青羊区 - 光华 - 蓝光coco蜜城</p>
            <div class="clearfix"></div>
        </div><div class="thumb-box ">
            <a href="/rent/area/cdqyq/2015/0802/6.html" target="_blank">
                <img src="templets/htm/style/images/loading.gif" alt="<b>铸信境界 西三环苏坡立交 清水河附近 非中介精装单间</b>" width="318" height="212" border="0" data-original="http://www.uoko.com/Image?imgid=6607&width=800&height=447&w=1" />
            </a>

        <h4 class="title"><a href="/rent/area/cdqyq/2015/0802/6.html"><strong><b>铸信境界 西三环苏坡立交 清水河附近 非中介精装单间</b></strong></a></h4>
            <div class="price">
                <span>¥</span>
                    600-1050
                元/月
            </div>
            <p class="des">青羊区 - 光华 - 铸信境界</p>
            <div class="clearfix"></div>
        </div><div class="thumb-box ">
            <a href="/rent/area/cdqyq/2015/0802/5.html" target="_blank">
                <img src="templets/htm/style/images/loading.gif" alt="<b>金沙海棠 地铁2号线羊犀立交站 西单附近 非中介精装单间</b>" width="318" height="212" border="0" data-original="http://www.uoko.com/Image?imgid=7991&width=800&height=447&w=1" />
            </a>

        <h4 class="title"><a href="/rent/area/cdqyq/2015/0802/5.html"><strong><b>金沙海棠 地铁2号线羊犀立交站 西单附近 非中介精装单间</b></strong></a></h4>
            <div class="price">
                <span>¥</span>
                    550-800
                元/月
            </div>
            <p class="des">青羊区 - 光华 - 金沙海棠</p>
            <div class="clearfix"></div>
        </div><div class="thumb-box ">
            <a href="/rent/area/cdqyq/2015/0802/4.html" target="_blank">
                <img src="templets/htm/style/images/loading.gif" alt="<b>金沙柏林郡 地铁2号线羊犀立交站 一品天下附近 非中介精装套四</b>" width="318" height="212" border="0" data-original="http://www.uoko.com/Image?imgid=6143&width=800&height=447&w=1" />
            </a>

        <h4 class="title"><a href="/rent/area/cdqyq/2015/0802/4.html"><strong><b>金沙柏林郡 地铁2号线羊犀立交站 一品天下附近 非中介精装套四</b></strong></a></h4>
            <div class="price">
                <span>¥</span>
                    580-700
                元/月
            </div>
            <p class="des">青羊区 - 光华 - 金沙柏林郡</p>
            <div class="clearfix"></div>
        </div><div class="thumb-box ">
            <a href="/rent/area/cdqyq/2015/0802/3.html" target="_blank">
                <img src="templets/htm/style/images/loading.gif" alt="<b>蓝光coco蜜城 青羊贝森 优品道附近 精装套一 三出门58路等公交直达市中心</b>" width="318" height="212" border="0" data-original="http://www.uoko.com/Image?imgid=121503&width=450&height=300" />
            </a>

        <h4 class="title"><a href="/rent/area/cdqyq/2015/0802/3.html"><strong><b>蓝光coco蜜城 青羊贝森 优品道附近 精装套一 三出门58路等公交直达市中心</b></strong></a></h4>
            <div class="price">
                <span>¥</span>
                    1950
                元/月
            </div>
            <p class="des">青羊区 - 光华 - 蓝光coco蜜城</p>
            <div class="clearfix"></div>
        </div>
        
        
        
        
    <div class="bk20"></div>
    
<div class="dede_pages">  
   <ul class="pagelist" style="font-size:13px; margin:0px 10px 0px 0px;">
    <li><span class="pageinfo">共 1 页/6 条记录</span></li>

   </ul>
  </div> 



   <div class="bk20"></div>
   
    <div class="portlet">
        <div class="portlet-title">
            <h4 class="caption">管家推荐</h4>
        </div>
        <div class="portlet-body rec-list">
        
                   <div class="thumbnail">
                        <a class="rec-p" href="/rent/area/cdqyq/2015/0802/9.html" title="蓝光coco蜜城 【青羊区-光华】蓝光coco蜜城 青羊贝" target="_blank">
                            <img src="templets/htm/style/images/loading.gif" data-original="http://www.uoko.com/Image?imgid=98345&width=800&height=447&w=1" width="158" height="105" alt="蓝光coco蜜城 【青羊区-光华】蓝光coco蜜城 青羊贝">
                        </a>
                        <p class="rec-info">
                            <a href="/rent/area/cdqyq/2015/0802/9.html" title="蓝光coco蜜城 【青羊区-光华】蓝光coco蜜城 青羊贝" target="_blank">蓝光coco蜜城 【青羊区-光华】蓝光coco蜜城 青羊贝</a>
                        </p>
                        <div class="rec-price">
                            ￥<span class="text-orange">
                                    650-850
                            </span>
                        </div>
                        <div class="clearfix"></div>
                    </div>
<div class="thumbnail">
                        <a class="rec-p" href="/rent/area/cdqyq/2015/0802/8.html" title="蓝光coco蜜城 【无中介费】出门58路等公交直达市" target="_blank">
                            <img src="templets/htm/style/images/loading.gif" data-original="http://www.uoko.com/Image?imgid=116419&width=800&height=447&w=1" width="158" height="105" alt="蓝光coco蜜城 【无中介费】出门58路等公交直达市">
                        </a>
                        <p class="rec-info">
                            <a href="/rent/area/cdqyq/2015/0802/8.html" title="蓝光coco蜜城 【无中介费】出门58路等公交直达市" target="_blank">蓝光coco蜜城 【无中介费】出门58路等公交直达市</a>
                        </p>
                        <div class="rec-price">
                            ￥<span class="text-orange">
                                    750-950
                            </span>
                        </div>
                        <div class="clearfix"></div>
                    </div>
<div class="thumbnail">
                        <a class="rec-p" href="/rent/area/cdqyq/2015/0802/6.html" title="铸信境界 西三环苏坡立交 清水河附近 非中介精" target="_blank">
                            <img src="templets/htm/style/images/loading.gif" data-original="http://www.uoko.com/Image?imgid=6607&width=800&height=447&w=1" width="158" height="105" alt="铸信境界 西三环苏坡立交 清水河附近 非中介精">
                        </a>
                        <p class="rec-info">
                            <a href="/rent/area/cdqyq/2015/0802/6.html" title="铸信境界 西三环苏坡立交 清水河附近 非中介精" target="_blank">铸信境界 西三环苏坡立交 清水河附近 非中介精</a>
                        </p>
                        <div class="rec-price">
                            ￥<span class="text-orange">
                                    600-1050
                            </span>
                        </div>
                        <div class="clearfix"></div>
                    </div>
<div class="thumbnail">
                        <a class="rec-p" href="/rent/area/cdqyq/2015/0802/5.html" title="金沙海棠 地铁2号线羊犀立交站 西单附近 非中介" target="_blank">
                            <img src="templets/htm/style/images/loading.gif" data-original="http://www.uoko.com/Image?imgid=7991&width=800&height=447&w=1" width="158" height="105" alt="金沙海棠 地铁2号线羊犀立交站 西单附近 非中介">
                        </a>
                        <p class="rec-info">
                            <a href="/rent/area/cdqyq/2015/0802/5.html" title="金沙海棠 地铁2号线羊犀立交站 西单附近 非中介" target="_blank">金沙海棠 地铁2号线羊犀立交站 西单附近 非中介</a>
                        </p>
                        <div class="rec-price">
                            ￥<span class="text-orange">
                                    550-800
                            </span>
                        </div>
                        <div class="clearfix"></div>
                    </div>
<div class="thumbnail">
                        <a class="rec-p" href="/rent/area/cdqyq/2015/0802/4.html" title="金沙柏林郡 地铁2号线羊犀立交站 一品天下附近" target="_blank">
                            <img src="templets/htm/style/images/loading.gif" data-original="http://www.uoko.com/Image?imgid=6143&width=800&height=447&w=1" width="158" height="105" alt="金沙柏林郡 地铁2号线羊犀立交站 一品天下附近">
                        </a>
                        <p class="rec-info">
                            <a href="/rent/area/cdqyq/2015/0802/4.html" title="金沙柏林郡 地铁2号线羊犀立交站 一品天下附近" target="_blank">金沙柏林郡 地铁2号线羊犀立交站 一品天下附近</a>
                        </p>
                        <div class="rec-price">
                            ￥<span class="text-orange">
                                    580-700
                            </span>
                        </div>
                        <div class="clearfix"></div>
                    </div>
<div class="thumbnail">
                        <a class="rec-p" href="/rent/area/cdqyq/2015/0802/3.html" title="蓝光coco蜜城 青羊贝森 优品道附近 精装套一 三出" target="_blank">
                            <img src="templets/htm/style/images/loading.gif" data-original="http://www.uoko.com/Image?imgid=121503&width=450&height=300" width="158" height="105" alt="蓝光coco蜜城 青羊贝森 优品道附近 精装套一 三出">
                        </a>
                        <p class="rec-info">
                            <a href="/rent/area/cdqyq/2015/0802/3.html" title="蓝光coco蜜城 青羊贝森 优品道附近 精装套一 三出" target="_blank">蓝光coco蜜城 青羊贝森 优品道附近 精装套一 三出</a>
                        </p>
                        <div class="rec-price">
                            ￥<span class="text-orange">
                                    1950
                            </span>
                        </div>
                        <div class="clearfix"></div>
                    </div>


                    
                    
        </div>
    </div>
    
</div>


<!--  -->
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
