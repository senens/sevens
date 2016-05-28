<!DOCTYPE HTML>
<html>
<head>
    <meta http-equiv="Cache-Control" content="no-transform" />
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="mobile-agent" content="format=html5; url=http://m.tujia.com/beijing_gongyu/se0/" />    
    <meta name="robots" content="noindex" />
    
    <title></title>
    <meta name="description" content="邻京有屋网，提供北京酒店式公寓住宿预订及价格查询服务，7x24小时专业客服，全程保障安心住宿，现有15326套北京周租房/月租房供选择，酒店式便捷入住，100%真实入住点评。选择邻京有屋网，找您旅途中的家！" />
    <meta name="keywords" content="北京住宿,北京家庭旅馆,北京酒店式公寓,北京服务式公寓,北京公寓" />
    <!--meta http-equiv="X-UA-Compatible" content="IE=8,IE=9" /-->
    <meta property="qc:admins" content="27330065376452116375" />
    <meta property="wb:webmaster" content="791d1c6849c2b026" />
    
     
    <link href="http://www.linjing.com/public/css/common.min.css" rel="stylesheet"/> 
    <link rel="stylesheet" type="text/css" href="http://www.linjing.com/public/css/body.css" />
    <link rel="stylesheet" type="text/css" href="http://www.linjing.com/public/css/com.min.css" />
    
    <script type="text/javascript" src="http://www.linjing.com/public/css/min.js"></script>
    
    <script type="text/javascript">
        //window["WEB_XHR_POLLING"] = true;
        var MESSAGE_RADIO = "http://staticfile.tujia.com/PortalSite2/radio/message.wav", ORDERNOTICE_RADIO = "http://staticfile.tujia.com/PortalSite2/radio/ordernotice.wav";
    </script>

    <script type="text/javascript">
        var staticFileRoot = "http://staticfile.tujia.com",
             minDate = "{{date('Y-m-d H:i:s',$time)}}",
             mindate =  new Date(2016,4,20),
             maxDate = "2016-11-16",
             maxdate= new Date(2016,10,16),
             houseId,
             ServerDomain = "tujia.com",
             TUJIA_CLIENTID = 'b20ec1a2-beab-45aa-82e6-bd804a76aa3d';

        var portalUrl = "http://www.tujia.com";
        var favoriteUrl = "http://vip.tujia.com";
        var customerUrl =  "http://vip.tujia.com";
        var imUrl = "http://im.tujia.com";


        var traceData = window.traceData || {};
        traceData.logService = 'http://api.tujia.com';
        traceData.prevId = '';
        traceData.pageId = '3526ae71-7a09-4a81-855e-e74f5692995f';
        traceData.url = 'http://www.tujia.com/beijing_gongyu/se0/';
        traceData.params = '';
    </script>
    <script type='text/javascript' src='http://webchat.7moor.com/javascripts/7moorInit.js?accessId=797098a0-b29d-11e5-b3b1-49764155fe50&autoShow=false' async='async'>
    </script>
    
</head>
<body  id='tujia'>

<!--[if lt IE 8]>
<div class="ie-tips">
<span> 您使用的IE浏览器版本较低！</span>本站已不再支持较低版本的IE浏览器，已为您启用了精简版。为了更好的体验本站内容，建议您升级<a target="_blank" href="http://www.microsoft.com/zh-cn/download/ie.aspx?q=internet+explorer">Internet Explorer浏览器</a>或安装非IE内核浏览器。请下载 <a href="http://down.360safe.com/se/360se7.1.1.556.exe" class="link-btn" target="_blank">360浏览器</a>或<a href="http://dldir1.qq.com/invc/tt/QQBrowser_Setup_Wireless.exe" class="link-btn" target="_blank">QQ浏览器</a>。
</div>
<![endif]-->
    <!--VISITOR-81-39-->
  
    <input id="hdIsFromPartner" name="hdIsFromPartner" type="hidden" value="0" />
     @include('header')
        <input type="hidden" id="pri" value="{{$price or null}}">
        <input type="hidden" id="hdStartDate" value="{{date('Y-m-d H:i:s',$time)}}" />
        <input type="hidden" id="htype" value="{{$h_type or null}}">
        <input type="hidden" id="types" value="{{$types or null}}">

    <!--- 面包屑 开始  -->
    
    <div class="wrap-large">
        <div id="dir">
           <a href="index" title="邻京有屋网">首页</a>
            <em>&gt;</em>
            <h1>搜索结果</h1>

        </div>
    </div>
    <!--- 面包屑  结束  -->

    <!-- <div class="wrap-large">
        <div class="unit-list-search " id="search">
            <div class="m-search-box form-horizontal">
                <div class="tab-content">
    
                <form id="mainSearchForm" action="" class="mainSearchForm mainSearchForm_unitlist" method="post">
                    <span class="controls-span" style="font-size:16px">城市：北京</span>
                    <div class="control-group date-group">
                        <span class="controls-span">入住时间</span>
                        <div class="controls">
                            <label for="startDate">
                                <input class="ipt-text startDate" id="startDate" name="startDate" type="text" value="{{date('Y-m-d',$time)}}" />
                                <i class="icon-calendar"></i>
                            </label>
                        </div>
                    </div>
    
                    <div class="control-group date-group">
                        <span class="controls-span">退房时间</span>
                        <div class="controls">
                            <label for="endDate">
                                <input class="ipt-text endDate" id="endDate" name="endDate" type="text" value="{{date('Y-m-d',$time)}}" />
                                <i class="icon-calendar"></i>
                            </label>
                        </div>
                    </div>
                        <div class="control-group key-group">
                            <span class="controls-span">关键词</span>
                            <div class="controls">
                                <label for="adress">
                                    <input type="text" id="adress" class="ipt-text" onfocus="_gaq.push(['_trackEvent', 'pcList', '关键词输入框']);" />
                                    <span class="address-mark" style="">小区名</span>
                                    <i class="icon-key"></i>
                                </label>
                            </div>
                        </div>
                    <div class="control-group search-btn-group" id="submitBox">
                        <input type="button" value="搜索" class="search-btn" id="searchHouse" onclick="_gaq.push(['_trackEvent', 'pcList', '列表搜索按钮']);">
                    </div>
                        <div class="control-group search-btn-group" style="margin-left:10px; width:auto">
                            <a href="/Unitmap/" target="_blank" onclick="_gaq.push(['_trackEvent', 'pcList', '列表地图搜索']);" class="search-btn-map">地图搜索</a>
                        </div>
                </form>
                </div>
            </div>
        </div>
    </div> -->

    <!---  页面内容 开始 -->
    
<div class="wrap-large" style="overflow: hidden;">
    <div class="unit-list-content">
    <div class="column-box">
    <div id="filterWrapper" class="m-filter-wrap">

    <div id="filter-list-type-ln" style="" class="filter-list  filter-tabs-cont">
        <div class="filter-item">位置</div>
            <div class="filter-grouping j-filter-locationTabContainer">
                <div class="m-filter-tabs j-filter-locationTab">
                    <ul>
                        <li class="first-item ">
                            <a href="javascript:void(0)" class="" rel="nofollow">
                                行政区<i class="icon-caret"></i>
                            </a>
                        </li>
                        <li class=" ">
                            <a href="javascript:void(0)" class="" rel="nofollow">
                                商圈<i class="icon-caret"></i>
                            </a>
                        </li>
                    </ul>
                </div>

    <div id="filter-list-type-s" class="filter-content filter-content-show j-filter-locationItemDetail filter-list-ck " style="display: none;">
        <div class="filter-list-grouping">
            <ul class="filter-list-ul j-filter-list-ul ">
            @foreach($zoneall as $z)
            <li>
                <a type="kw" data-type="s" data-val="182" data-identityid="0" title="" href="/beijing_gongyu/chaoyangqu_s182/" class=" ">{{$z->z_name}}</a>
            </li>
            @endforeach              
            </ul>
        </div>
    </div>

    <div id="filter-list-type-c" class="filter-content filter-content-show j-filter-locationItemDetail  " style="display: none;">
            
        <div class="filter-list-grouping">
            <ul class="filter-list-ul j-filter-list-ul filter-list-area">
            @foreach($areaall as $a)
                <li>
                    <a type="kw" data-type="c" data-val="674" data-identityid="0" title="" href="/beijing_gongyu/c674/" class="  ">{{$a->area_name}}</a>
                </li>
            @endforeach
            </ul>
        </div>
    </div>
            </div>
    </div>

    <div id="filter-list-type-p" style="" class="filter-list filter-list-ck j-filterGroup-multiSelect ">
        <div class="filter-item">房价</div>
        <div class="filter-content ">
            <div class="not">
                <a rel="nofollow" href="javascript:void(0)" class="selected unlimited" id="price">不限</a>
            </div>
            <ul class="filter-list-ul j-filter-list-ul filter-list-ul-type" id="price">
                <li>
                    <a type="kw" data-type="p" data-val="1" data-identityid="0"
                       title=""
                       href="javascript:void(0);" class="price">500以下</a>
                </li>
                <li>
                    <a type="kw" data-type="p" data-val="2" data-identityid="0"
                       title=""
                       href="javascript:void(0);" class="price">500-1000</a>
                </li>
                <li>
                    <a type="kw" data-type="p" data-val="3" data-identityid="0"
                       title=""
                       href="javascript:void(0);" class="price">1000-2000</a>
                </li>
                <li>
                    <a type="kw" data-type="p" data-val="4" data-identityid="0"
                       title=""
                       href="javascript:void(0);" class="price">2000-3000</a>
                </li>
                <li>
                    <a type="kw" data-type="p" data-val="5" data-identityid="0"
                       title=""
                       href="javascript:void(0);" class="price">3000-4000</a>
                </li>
                <li>
                    <a type="kw" data-type="p" data-val="6" data-identityid="0"
                       title=""
                       href="javascript:void(0);" class="price">4000以上</a>
                </li>
                <!-- <li id="pricerange" class="price-range">
                    <label for="" class="lab-text">自定义</label>
                    <input type="text" name="MinPriceValue" id="MinPriceValue" value="" class="ipt-txt" onkeyup="this.value = this.value.replace(/^[0|\D]+|\D/g, '') " onafterpaste="this.value=this.value.replace(/^[0|\D]+|\D/g,'')" />
                    <span>~</span>
                    <input type="text" name="MaxPriceValue" id="MaxPriceValue" class="ipt-txt" value="" onkeyup="this.value = this.value.replace(/^[0|\D]+|\D/g, '') " onafterpaste="this.value=this.value.replace(/^[0|\D]+|\D/g,'')" />
                    <input type="button" data-type="ps" value="确定" class="btn-range dn" onclick="_gaq.push(['_trackEvent', 'pcList', '自定义价格区间']);" />
                </li>
                <li>
                    <a type="kw" id="KeyAccount" data-type="jx" data-val="8192" data-identityid="0" href="javascript:void(0);" class="" style="display:none">大客户专享</a>
                </li> -->
            </ul>
        </div>
    </div>

    <div id="filter-list-type-hb" style="" class="filter-list filter-list-ck j-filterGroup-multiSelect ">
        <div class="filter-item">户型</div>
        <div class="filter-content ">
            <div class="not">
                <a rel="nofollow" href="javascript:void(0)" class="selected unlimited" id="h_type">不限</a>
            </div>
            <ul class="filter-list-ul j-filter-list-ul filter-list-ul-type">
                <li>
                    <a type="kw" data-type="h" data-val="1" data-identityid="0"
                       title=""
                       href="javascript:void(0);" class="h_type">一居</a>
                </li>
                <li>
                    <a type="kw" data-type="h" data-val="2" data-identityid="0"
                       title=""
                       href="javascript:void(0);" class="h_type">二居</a>
                </li>
                <li>
                    <a type="kw" data-type="h" data-val="3" data-identityid="0"
                       title=""
                       href="javascript:void(0);" class="h_type">三居</a>
                </li>
                <li>
                    <a type="kw" data-type="h" data-val="4" data-identityid="0"
                       title=""
                       href="javascript:void(0);" class="h_type">四居及以上</a>
                </li>
            </ul>
        </div>
    </div>

    <div id="filter-list-type-hp" style="" class="filter-list filter-list-ck j-filterGroup-multiSelect ">
        <div class="filter-item">房型</div>
        <div class="filter-content ">
            <div class="not">
                <a rel="nofollow" href="javascript:void(0)" class="selected unlimited" id="typese">不限</a>
            </div>
            <ul class="filter-list-ul j-filter-list-ul filter-list-ul-type">
                <li>
                    <a type="kw" data-type="hp" data-val="1" data-identityid="0"
                       title=""
                       href="javascript:void(0);" class="types">普通住房</a>
                </li>
                <li>
                    <a type="kw" data-type="hp" data-val="2" data-identityid="0"
                       title=""
                       href="javascript:void(0);" class="types">公寓</a>
                </li>
                <li>
                    <a type="kw" data-type="hp" data-val="3" data-identityid="0"
                       title=""
                       href="javascript:void(0);" class="types">平房</a>
                </li>
                <li>
                    <a type="kw" data-type="h" data-val="4" data-identityid="0"
                       title=""
                       href="javascript:void(0);" class="types">别墅</a>
                </li>
                <li>
                    <a type="kw" data-type="h" data-val="5" data-identityid="0"
                       title=""
                       href="javascript:void(0);" class="types">农家乐</a>
                </li>              
            </ul>
        </div>
    </div>

    <div id="filter-list-type-pt" style="" class="filter-list filter-list-ck j-filterGroup-multiSelect ">
        <div class="filter-item">配套</div>
        <div class="filter-content ">
            <div class="not">
                <a rel="nofollow" href="javascript:void(0)" class="selected unlimited">不限</a>
            </div>
            <ul class="filter-list-ul j-filter-list-ul filter-list-ul-type">
                <li>
                    <a type="kw" data-type="ho" data-val="256" data-identityid="0"
                       title=""
                       href="javascript:void(0);" class="">无线网络</a>
                </li>
                <li>
                    <a type="kw" data-type="su" data-val="4" data-identityid="0"
                       title=""
                       href="javascript:void(0);" class="">做饭</a>
                </li>
                <li>
                    <a type="kw" data-type="su" data-val="2" data-identityid="0"
                       title=""
                       href="javascript:void(0);" class="">带宠物</a>
                </li>
                <li>
                    <a type="kw" data-type="go" data-val="4" data-identityid="0"
                       title=""
                       href="javascript:void(0);" class="">洗衣机</a>
                </li>
                <li>
                    <a type="kw" data-type="go" data-val="8" data-identityid="0"
                       title=""
                       href="javascript:void(0);" class="">空调</a>
                </li>
                <li>
                    <a type="kw" data-type="go" data-val="2" data-identityid="0"
                       title=""
                       href="javascript:void(0);" class="">冰箱</a>
                </li>               
            </ul>
        </div>
    </div>
        </div>


        <!-- column-box -->
        <div class="filters-panel" id="filtersPanel" style="display: none;">
            <div class="filters-key">您已选择：</div>
            <div class="filters-values j-filter-selectedItemsContainer" id=""></div>
        </div>
        <div class="expand-box clearfix">
            <div id="sortWrapper" class="sort-cont">
                <div id="sortArea" class="m-sort-area" data-sortval="">
                    <a href="javascript:void(0)" data-cat="1" onclick="_gaq.push(['_trackEvent', 'pcList', '推荐排序']);" data-type="o" data-val="1" name="TujiaRecommendedSort" class="" style="text-decoration:;cursor:">推荐排序</a>

                    <a href="javascript:void(0)" data-cat="2" onclick="_gaq.push(['_trackEvent', 'pcList', '房价排序']);" data-type="o" data-val="2"
                       class="link-btn " style="" name="PriceSort" title="点击按价格从低到高排序"><i class="icon-down"></i>房价</a>

                    <!-- <a href="javascript:void(0)" data-cat="3" onclick="_gaq.push(['_trackEvent', 'pcList', '点评分排序']);" data-type="o" data-val="18"
                       name="commentscoresort" class="" title="点击按点评分从高到低排序">点评分</a> -->


                    <!-- <a href="javascript:void(0)" data-cat="5" onclick="_gaq.push(['_trackEvent', 'pcList', '销量排序']);" data-type="o" data-val="21"
                       name="CommentCountSort" class="" title="点击按销量从多到少排序">销量</a> -->
          

                    <a href="javascript:void(0)" data-cat="3" onclick="_gaq.push(['_trackEvent', 'pcList', '面积排序']);" data-type="o" data-val="3"
                       class="link-btn   " name="GrossAreaSort" title="点击按面积从大到小排序"><i class="icon-up"></i>面积</a>

                    <a href="javascript:void(0)" data-type="o" style="display:none;" data-val="15"
                       name="distancesort" title="按距离从近到远排序" class="">距离</a>
                </div>
            </div>
            <div class="total-house-amount">
            <span>          
            {{$housecount}}            
            </span>套房屋符合条件</div>

            <div class="f-clear"></div>
        </div>

        <div id="listWrapper">
            
<div class="m-hot-room" style="display:none;" id="recom-list">
    <h2>城市热门推荐</h2>
    <div class="room-list">
        <a href="javascript:;" class="prev-btn" id="recom_carousel_prev"></a>
        <a href="javascript:;" class="next-btn" id="recom_carousel_next"></a>
        <a href="javascript:;" class="close-btn" id="recom_close" title="关闭"></a>
        <div class="carousel">
            <div class="house-group carousel_inner clearfix" id="recom-list-carousel">
                    <div class="carousel_box house-group">
                        <div class="room-cont">
                            <a href="http://go.tujia.com/1007/?code=CZLB-ZSK-bj&amp;id=49976" target="_blank" title="北京百住公寓蓝堡国际店两室套房" class="pic-box" rel="nofollow">
                                <img src="http://pic.tujia.com/upload/landlordunit/day_160513/thumb/201605131805004189_120_90.jpg" alt="北京百住公寓蓝堡国际店两室套房" />
                            </a>
                            <div class="info-box">
                                <a href="http://go.tujia.com/1007/?code=CZLB-ZSK-bj&amp;id=49976" target="_blank" class="room-tit" title="北京百住公寓蓝堡国际店两室套房">北京百住公寓蓝堡国际店两室套房</a>
                                <p class="picer-info"><span class="price-box"><dfn>¥</dfn><b class="number-box">989</b></span>/晚起 </p><p class="hint-text"></p>
                            </div>
                        </div>
                    </div>
                    <div class="carousel_box house-group">
                        <div class="room-cont">
                            <a href="http://go.tujia.com/1007/?code=CZLB-ZSK-bj&amp;id=7155" target="_blank" title="北京广渠门家庭公寓大床房" class="pic-box" rel="nofollow">
                                <img src="http://pic.tujia.com/upload/landlordunit/day_141119/thumb/201411190840106963_120_90.jpg" alt="北京广渠门家庭公寓大床房" />
                            </a>
                            <div class="info-box">
                                <a href="http://go.tujia.com/1007/?code=CZLB-ZSK-bj&amp;id=7155" target="_blank" class="room-tit" title="北京广渠门家庭公寓大床房">北京广渠门家庭公寓大床房</a>
                                <p class="picer-info"><span class="price-box"><dfn>¥</dfn><b class="number-box">288</b></span>/晚起 </p><p class="hint-text"></p>
                            </div>
                        </div>
                    </div>
                    <div class="carousel_box house-group">
                        <div class="room-cont">
                            <a href="http://go.tujia.com/1007/?code=CZLB-ZSK-bj&amp;id=78183" target="_blank" title="朝阳区6号线草房地铁附近温馨公寓" class="pic-box" rel="nofollow">
                                <img src="http://pic.tujia.com/upload/landlordunit/day_151210/thumb/20151210145331343_120_90.jpg" alt="朝阳区6号线草房地铁附近温馨公寓" />
                            </a>
                            <div class="info-box">
                                <a href="http://go.tujia.com/1007/?code=CZLB-ZSK-bj&amp;id=78183" target="_blank" class="room-tit" title="朝阳区6号线草房地铁附近温馨公寓">朝阳区6号线草房地铁附近温馨公寓</a>
                                <p class="picer-info"><span class="price-box"><dfn>¥</dfn><b class="number-box">98</b></span>/晚起 </p><p class="hint-text"></p>
                            </div>
                        </div>
                    </div>
                    <div class="carousel_box house-group">
                        <div class="room-cont">
                            <a href="http://go.tujia.com/1007/?code=CZLB-ZSK-bj&amp;id=71610" target="_blank" title="崇文门国瑞城高级空中花园公寓 " class="pic-box" rel="nofollow">
                                <img src="http://pic.tujia.com/upload/landlordunit/day_151119/thumb/201511191500209023_120_90.jpg" alt="崇文门国瑞城高级空中花园公寓 " />
                            </a>
                            <div class="info-box">
                                <a href="http://go.tujia.com/1007/?code=CZLB-ZSK-bj&amp;id=71610" target="_blank" class="room-tit" title="崇文门国瑞城高级空中花园公寓 ">崇文门国瑞城高级空中花园公寓 </a>
                                <p class="picer-info"><span class="price-box"><dfn>¥</dfn><b class="number-box">550</b></span>/晚起 </p><p class="hint-text"></p>
                            </div>
                        </div>
                    </div>
                    <div class="carousel_box house-group">
                        <div class="room-cont">
                            <a href="http://go.tujia.com/1007/?code=CZLB-ZSK-bj&amp;id=62790" target="_blank" title="北京麒麟外交公寓豪华两居" class="pic-box" rel="nofollow">
                                <img src="http://pic.tujia.com/upload/landlordunit/day_160411/thumb/201604111405017984_120_90.jpg" alt="北京麒麟外交公寓豪华两居" />
                            </a>
                            <div class="info-box">
                                <a href="http://go.tujia.com/1007/?code=CZLB-ZSK-bj&amp;id=62790" target="_blank" class="room-tit" title="北京麒麟外交公寓豪华两居">北京麒麟外交公寓豪华两居</a>
                                <p class="picer-info"><span class="price-box"><dfn>¥</dfn><b class="number-box">1288</b></span>/晚起 </p><p class="hint-text"></p>
                            </div>
                        </div>
                    </div>
                    <div class="carousel_box house-group">
                        <div class="room-cont">
                            <a href="http://go.tujia.com/1007/?code=CZLB-ZSK-bj&amp;id=29022" target="_blank" title="地铁直达鸟巢水立方一室一厅套间" class="pic-box" rel="nofollow">
                                <img src="http://pic.tujia.com/upload/landlordunit/day_160429/thumb/201604291001176856_120_90.jpg" alt="地铁直达鸟巢水立方一室一厅套间" />
                            </a>
                            <div class="info-box">
                                <a href="http://go.tujia.com/1007/?code=CZLB-ZSK-bj&amp;id=29022" target="_blank" class="room-tit" title="地铁直达鸟巢水立方一室一厅套间">地铁直达鸟巢水立方一室一厅套间</a>
                                <p class="picer-info"><span class="price-box"><dfn>¥</dfn><b class="number-box">168</b></span>/晚起 </p><p class="hint-text"></p>
                            </div>
                        </div>
                    </div>
            </div>
        </div>
    </div>
</div>
    <div id="unitSearchResult">

    <input type="hidden" id="unitInstanceCount" value="15000+" />
    <input type="hidden" id="pageId" value="3526ae71-7a09-4a81-855e-e74f5692995f" />
    <input type="hidden" id="isShowDistance" value="" />

    <div class="house-list">
    <div class="searchresult-list t-searchresult-list  clearfix" data-unitid="22719">
        @if($house)
        @foreach($house as $k => $v)
        <div class="house-img">
            <a href="{{URL('index/details')}}?id={{$v->h_id}}" target="_blank" rel="nofollow" class="link-btn-pic" onclick="_gaq.push(['_trackEvent', 'pcList', '房屋点击']);">
                <img data-origin="http://www.linjing.com/public/images/{{$v->h_photo}}" alt="{{$v->h_title}}" width="50px" />
            </a>
                <i class="icon-proprietary" title="邻京有屋自营公寓，高品质保障"></i>
            <div class="functions-menu">
                <a href="{{URL('index/details')}}?id={{$v->h_id}}" class="view-pic">更多图片</a>
                {{$v->h_description}}      
            </div>
        </div>

        <div class="house-info clearfix">
            <div class="house-main-box clearfix">
                <div class="house-content">
                    <div id="divcvinfo_22719" class="house-name">
                        <h2>
                            <a href="{{URL('index/details')}}?id={{$v->h_id}}" target="_blank" onclick="_gaq.push(['_trackEvent', 'pcList', '房屋点击']);" title="">{{$v->h_title}}</a>
                            <a href="http://bp.tujia.com/2016/SelectMerchants" target="_blank" class="icon-quality-hotel" rel="PreferredUnitTips"></a>
                        </h2>
                    </div>

                    <div class="house-htladdress">
                        <a href="{{URL('index/details')}}?id={{$v->h_id}}" title="" target="_self" style="margin-left:0">
                        @if($zone)
                        {{$zone}}
                        @endif
                        </a>
                        <span class="business-area-name">{{$v->area_name}}</span>
                        <span class="span-text">
                            <a href="/beijing_gongyu/d-5hxyhg/"
                                style="margin:0" title=""></a>
                        </span>
                        <a href="javascript:void(0)" ref="http://api.map.baidu.com/staticimage?zoom=15&amp;markers=116.419955,39.954906&amp;width=400&amp;height=400&amp;markerStyles=m, ,&amp;pic=mappic.png" onclick="_gaq.push(['_trackEvent', 'pcList', '房屋地图']);openUrl('/beijing_gongyu/dongchengqu_22719.htm?tabto=map#index=1')" class="map-btn">地图</a>
                    </div>

                    <div class="house-datelist">
                        <span title="">
                            @if($v->h_type==0)
                            普通住宅
                            @elseif($v->h_type==1)
                            公寓
                            @elseif($v->h_type==2)
                            平房
                            @elseif($v->h_type==3)
                            别墅
                            @elseif($v->h_type==3)
                            农家乐
                            @else
                            其它
                            @endif
                        </span>|
                        <span title="1室1卫">
                            @if($v->h_room_num==1)
                            一居
                            @elseif($v->h_room_num==2)
                            两居
                            @elseif($v->h_room_num==3)
                            三居
                            @elseif($v->h_room_num==4)
                            四居
                            @elseif($v->h_room_num==5)
                            五居
                            @else
                            好多房间
                            @endif
                        </span>|
                        <span title="建筑面积15平米">{{$v->h_area}}平米</span>|
                        <span title="限定男女">
                        @if($v->h_gender_demand==0)
                            男女不限
                            @elseif($v->h_gender_demand==1)
                            只限男
                            @elseif($v->h_gender_demand==2)
                            只限女
                            @endif
                        </span>
                    </div>
                </div>
                <div class="house-highlight">
                    <div class="house-judgement"><a href="{{URL('index/details')}}?id={{$v->h_id}}" target="_blank" rel="nofollow" onclick="_gaq.push(['_trackEvent', 'pcList', '房屋点评']);"><span class="comments-count">{{$comcount[$k]}}</span>条点评</a></div>
                </div>

                <div class="house-sid">
                    <div class="price-cont">
                        <p>
                            <a href="{{URL('index/details')}}?id={{$v->h_id}}" target="_blank" rel="nofollow" class="h-price" onclick="_gaq.push(['_trackEvent', 'pcList', '房屋点击']);">
                                <dfn class=" f-vt">¥</dfn><span class="price-value">
                                    <strong>{{$v->h_price}}</strong>
                                </span>
                            </a>
                        </p>
                        <i class="icon-payment" rel="FaceToFacePaytip"></i>
                        <i class="icon-card j-icon-card" rel="PrepaidCardTooltip"></i>
                    </div>                   
                </div>
            </div>
        </div>
        @endforeach
        @endif
    </div>
    
    <div id="PrepaidCardTooltip" class="m-tips-wrap" style="display: none">
        <div class="tips-content" style="width:220px">
            <div class="tips-info">所有产品均可直接全额预付房费，支持使用“途游卡、礼品卡、惠住卡、积分和账户余额”</div>
        </div>
    </div>

    <div id="FaceToFacePaytip" class="m-tips-wrap" style="display: none">
        <div class="tips-content" style="width:220px">
            <div class="tips-info">到店当面付：到达门店入住时，使用邻京有屋手机APP或手机H5网站，找到需到店支付的订单进行当面支付操作，可使用途游卡、积分、余额支付，更方便、更省钱！</div>
        </div>
    </div>

<div class="m-tips-wrap" id="freeservice-tip" style="display: none">
    <div class="tips-content text-description">
        <h2></h2>
        <div class="tips-info"></div>
    </div>
</div>

<div class="m-tips-wrap" id="multilimit-tip" style="display: none">
    <div class="tips-content text-description">
        <b>预订限制</b>
        <div class="tips-info">
        </div>
    </div>
</div>

<div id="PreferredUnitTips" class="m-tips-wrap" style="display: none">
    <div class="tips-content" style="width:220px">
        <div class="tips-info">邻京有屋团队实地验真，设施可靠，服务优质。邻京有屋团队贴心保障，您的出行入住首选。</div>
    </div>
</div>

<div class="m-tips-wrap" id="app-download-tip" style="display: none">
    <div class="tips-content code-description">
        <h2>扫描下载邻京有屋APP</h2>
        <img src="http://staticfile.tujia.com/portalsite2/images/Common/mobile.png" width="80" height="80" />
        <p><a href="http://www.tujia.com/Promotion/mobile.htm" target="_blank">邻京有屋APP下载页</a></p>
    </div>
</div>

<!--立减Tips-->
<div id="reduce_money_description" class="m-tips-wrap" style="display: none">
    <div class="tips-content reduce-text">
        <div class="tips-info">
            原价<span class="defaultPrice"></span>，<span class="defaultReduceTips">促销立减<span class="highlight-text  defaultReduceAmount"></span>元。</span><span class="additionReduceTips">您是<span class="highlight-text additionReduceReason" style="font-family:微软雅黑"></span>，享额外立减<span class="additionReduceAmount"></span>元。</span><span class="totalReduceTips">合计立减<span class="highlight-text totalReduceAmount"></span>元。</span>
        </div>
    </div>
</div>


<!--返现Tips-->
<div id="return_money_description" class="m-tips-wrap" style="display: none">
    <div class="tips-content cash-back">
        <h2>返现说明</h2>
        <div class="tips-info">
            1）<span class="defaultReduceTips">每间房每晚促销返现<span class="defaultReduceAmount"></span>元。</span><span class="additionReduceTips">您是<span class="additionReduceReason" style="font-family:微软雅黑"></span>，享额外返现<span class="additionReduceAmount"></span>元。</span><span class="totalReduceTips">合计返现<span class="totalReduceAmount"></span>元。</span>
            <br />
            2）返现会在入住完成并核实后的2-7个工作日内，充值到您的邻京有屋账户，可提现也可用于预订。
        </div>
        <div class="line-box"></div>
        <h2>提现说明</h2>
        <div class="tips-info">在“我的邻京有屋”的“账户余额”中可以查看到返现金额并进行提现，支持支付宝和银行卡2种方式，您设置好正确的账号信息后，就可以做提现申请。邻京有屋在收到提现申请后进行审核，审核通过后3-7个工作日将现金打入到您的提现账号里。</div>
    </div>
</div>
    <div>
        @if($house)
        <?php echo $house->render()?>
        @endif
    </div>
 
                </div>
                <div style="display:none;">UnitSearchResult cost: 46.8009ms</div>

            </div>
        </div>
    </div>
</div>

    


    <!--长租跳转提示浮层-->
    <div id="pop_window_changzu" class="loading-content" style="display: none;">
        <div class="hd-cont">
            <h2>正在前往【<span id="pop_cityName"></span>】列表页，为您推荐合适的公寓。</h2>
        </div>
    </div>

    <!--页面内容 结束-->

    
    <script type="text/javascript">
        var getPriceUrl = '/compareunit/GetPrices/';
        var selectedConditionInfos = '北京||';
        var viewData = {"DestinationPinyin":"beijing","SelectedConditionItems":[],"IsShowDistance":false,"IsShowKA":false};
    </script>
    
    <div class="thumb-wrap" id="album-view" style="display: none;">
        <div class="hd-cont"><a href="javascript:;" class="close-btn"></a></div>
        <div class="m-thumb" id="slides-box">
            <div class="pic-cont" id="slide-detail">
                <div class="loading-box" id="slide_loading_wrap">
                    <img src="http://staticfile.tujia.com/PortalSite2/Images/Avatar/default-photo-560x350.png" alt="" width="670" height="390">
                </div>
                <div class="btn-box">
                    <a href="javascript:;" class="btn-prev"></a>
                    <a href="javascript:;" class="btn-next"></a>
                </div>
                <div class="pic-info">
                    <div class="pic-name">小区外景</div>
                </div>
            </div>

            <div class="pic-select" id="slide-thumb">
                <div class="pic-list">
                    <a href="javascript:;" class="btn-prev"></a>
                    <a href="javascript:;" class="btn-next"></a>
                    <div class="pic-scroll">
                    <ul style="width: 960px;">
                    </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

     
<!-- footer Start -->

<!-- <div class="m-dld-wrap">
    <div class="dld-bd">
            <div class="game-info" style="width: 480px;">
                <span style="display: block; width: 452px;height: 172px;margin: -22px 0 0 0;background: url(http://staticfile.tujia.com/PortalSite2/Images/girl.png) no-repeat top;"></span>
            </div>

        <div class="dld-ct">
            <div class="dld-ct-item">
                <h2>扫描二维码下载</h2>
                <i class="i-code-app"></i>
            </div>
            <div class="dld-ct-item">
                <h2>直接下载</h2>
                <a onclick="window.open('http://m.tujia.com/click?id=1184');return false;" href="javascript:void(0);" class="link-btn" target="_blank">iPhone</a>
                <a onclick="window.open('http://download.tujia.com/android/tujia4541-tujiaportal.apk'); return false;" href="javascript:void(0);" class="link-btn" target="_blank">Android</a>
            </div>
        </div>

        <div class="weixin-ct">
            <h2> 实时热门推荐，请关注邻京有屋微信</h2>
            <i class="i-code-weixin"></i>
        </div>

        <a href="javascript:void(0)" class="close-btn" title="关闭">关闭</a>
    </div>
</div> -->  
    <div class="m-footer-link-list">
        <a href="http://content.tujia.com/tujiajianjie.htm" target="_blank" class="forst" rel="nofollow">关于我们</a>|
        <a href="http://content.tujia.com/youkebangzhu.htm" target="_blank" rel="nofollow">我是房客</a>|
        <a href="http://content.tujia.com/qiyewenhua.htm" target="_blank" rel="nofollow">加入邻京有屋</a>|
        <a href="/SiteMap/UnitDestination/" target="_blank">网站地图</a>|
        <a href="/sitemap.htm" target="_blank">城市地图</a>
  
        <p>&copy; Copyright 2016 linjing.com 邻京有屋版权所有<span><a href="http://www.miitbeian.gov.cn/" target="_blank" style="padding:0">京ICP证120277号</a></span> <span style="display:inline-block; margin-left:10px">京公网安备11010502027120</span></p>
        <p class="safe-cont">
             <a href="http://www.12377.cn/" target="_blank" rel="nofollow"><img src="http://staticfile.tujia.com/PortalSite2/Images/safeImages/safe-img1.jpg" alt="互联网违法和不良信息举报中心" width="138" height="40" /></a>
            <a href="http://bj.cyberpolice.cn/" target="_blank" rel="nofollow"><img src="http://staticfile.tujia.com/PortalSite2/Images/safeImages/safe-img3.jpg" alt="北京市公安局网络违法犯罪举报"  width="98" height="40" /></a>
        </p>    
    </div>
    

<!-- footer  End -->
<div class="edm-pop " id="dialog" style="display: none">
    <div class="edm-hd"><h2>订阅邮件</h2><a class="close-btn" title="关闭"></a></div>
    <div class="edm-bd">
        <div class="msg-box">
            <img src="http://staticfile.tujia.com/portalsite2/images/loading.gif"/>正在提交订阅
        </div>
    </div>
</div>

    <script type="text/javascript" src="http://www.linjing.com/public/css/youwu.js"></script>
     
    <script type="text/javascript">
        //页面加载事件
        //默认选中
        $(function(){
            var price = $("#pri").val();
            var htype = $("#htype").val();
            var types = $("#types").val();
            if(price){
                $('#price').attr('class','price');
                $(".price").each(function(){
                    if($(this).html() ==price){
                        $(this).attr('class', 'selected unlimited');
                    }
                })                
            }
            if(htype){
                $('#h_type').attr('class','h_type');
                $(".h_type").each(function(){
                    if($(this).html() ==htype){
                        $(this).attr('class', 'selected unlimited');
                    }
                })                
            }
            if(types){
                $('#typese').attr('class','types');
                $(".types").each(function(){
                    if($(this).html() ==types){
                        $(this).attr('class', 'selected unlimited');
                    }
                })                
            }
        })
        //租金价格查询
        $('.price').click(function(){
            var price = $(this).html();
            var h_type = $("#htype").val();
            var types = $("#types").val();
            //var h_type = 
            $('#price').attr('class','price');
            $(this).attr("class","selected unlimited");
            location.href="{{URL('search/all')}}?price="+price+"&h_type="+h_type+"&types="+types;
        })

        //居室查询
        $(".h_type").click(function(){
            var h_type = $(this).html();
            var price = $("#pri").val();
            var types = $("#types").val();
            $('#h_type').attr('class','h_type');
            $(this).attr("class","selected unlimited");
            location.href="{{URL('search/all')}}?price="+price+"&h_type="+h_type+"&types="+types;
        })

        //房屋类型查询
        $(".types").click(function(){
            var types = $(this).html();
            var price = $("#pri").val();
            var h_type = $("#htype").val();
            $('#types').attr('class','types');
            $(this).attr("class","selected unlimited");
            location.href="{{URL('search/all')}}?price="+price+"&h_type="+h_type+"&types="+types;
        })
    </script>
    <div style="height: 1px;" id="loginBtn"></div>
</body>
</html>
