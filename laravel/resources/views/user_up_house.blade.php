<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
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

    <style type="text/css">
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
        #allmap{
            height:400px;
            width:100%;
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
        {{$value = Session::get('name')}}
        <li class="active"><a href="/plus/list.php?tid=4">用户中心</a></li>
            
    </ol>
    <div class="row">
        <div class="col-md-3">
            
<div class="sidebar sidebar-about">
    <ul class="nav sidenav">
        <li>
            <a href="{{URL('user/tenantmessage')}}">
                个人信息<br />
                <small>Personal Information</small>
            </a>
        </li>
        <!--<li>
            <a href="{{URL('user/intive_friend')}}">
                邀请好友<br />
                <small>Invite Friends</small>
            </a>
        </li>-->
        <li>
            <a href="{{URL('user/uhouse')}}">
                上传房源<br />
                <small>Upload Listings</small>
            </a>
        </li>
        <li >
            <a href="{{URL('user/sellh')}}">
                已租房源<br />
                <small>Rental Housing</small>
            </a>
        </li>

        <li>
            <a href="{{URL('user/sellingh')}}">
                在租房源<br />
                <small>Renting  Housing</small>
            </a>
        </li>
    </ul>
</div>
        </div>
        <div class="col-md-9">
            <div class="article">
                <div class="content" style="clear: both">
                    <div class="content-1" style="line-height:26px;"><div class="content-1">
                    <h4>上传房源</h4>
                        <form action="{{URL('login/up_house')}}"method="post" class="form-horizontal" role="form" enctype="multipart/form-data">
                            <input type="hidden" name="_token"  value="{{csrf_token()}}"/>
                            <div class="form-group">
                                <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> 出租方式： </label>
                                <div class="col-sm-9">
                                    <input type="radio" id="form-field-1" name="h_rent_type" value="0" />整套出租　
                                    <input type="radio" id="form-field-1" name="h_rent_type" value="1" />单间出租　
                                    <input type="radio" id="form-field-1" name="h_rent_type" value="2" />床位出租
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> 小区名称： </label>

                                <div class="col-sm-9">
                                    <input type="text" id="form-field-1" name="h_plot_name" placeholder="plot_name"  class="col-xs-10 col-sm-5" />
                                </div>
                            </div>

                            <center>
                            <div style="display:none" id='allmap' ></div>
                            </center>
                            <div class="form-group">
                                <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> 详细地址： </label>
                                <div class="col-sm-9">
                                    <input type="text" id="cityName" name="h_loc_detail" placeholder="loc_detail"  class="col-xs-10 col-sm-5" />
                                    <input type="hidden" id="lng" name="lng" value="经度"/>
                                    <input type="hidden" id="lat" name="lat" value="纬度"/>
                                    <input type="button" value="点击展示地图" onclick="theLocation()" />
                                </div>
                            </div>
                                                       
                            
                           <!--  <center>
                           <div style="display: none" id='allmap' ></div>
                           </center> -->
                          
                            <div class="form-group">
                                <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> 性别要求： </label>

                                <div class="col-sm-9">
                                    <input type="radio" id="form-field-1" name="h_gender_demand" value="0" />男
                                    <input type="radio" id="form-field-1" name="h_gender_demand" value="1" />女
                                </div>
                            </div>


                            <div class="space-4"></div>

                            <div class="form-group">
                                <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> 房屋户型： </label>

                                <div class="col-sm-9">
                                    <input type="text" id="form-field-1" name="h_room_num" placeholder="doors_type" />室
                                    <input type="text" id="form-field-1" name="h_hall_num" placeholder="doors_type" />厅
                                    <input type="text" id="form-field-1" name="h_toilet_num" placeholder="doors_type" />卫
                                </div>
                            </div>


                            <div class="form-group">
                                <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> 楼层： </label>

                                <div class="col-sm-9">
                                    第<input type="text" id="form-field-1" name="h_floor_st" height="20px" weith="20px" />层</br>
                                    共<input type="text" id="form-field-1" name="h_floor_all" height="20px" weith="20px" />层
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> 面积： </label>

                                <div class="col-sm-9">
                                    <input type="text" id="form-field-1" name="h_area" placeholder="h_area"  class="col-xs-10 col-sm-5" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> 类型： </label>

                                <div class="col-sm-9">
                                    <select name="h_orientation" id="">
                                        <option value="0">选择朝向</option>
                                        <option value="1">向北</option>
                                        <option value="2">向南</option>
                                        <option value="3">其他</option>
                                    </select>　
                                    <select name="h_decorate" id="">
                                        <option value="0">装修情况</option>
                                        <option value="1">精装修</option>
                                        <option value="2">毛胚房</option>
                                        <option value="3">简装修</option>
                                        <option value="4">其他</option>
                                    </select>　
                                    <select name="h_type" id="">
                                        <option value="0">房屋类型</option>
                                        <option value="1">普通用户</option>
                                        <option value="2">商住两用</option>
                                        <option value="3">别墅</option>
                                        <option value="4">其他</option>
                                    </select>
                                </div>
                            </div>


                            <div class="form-group">
                                <label class="col-sm-3 control-label no-padding-right" for="form-field-1" > 房屋配置： </label>

                                <div class="col-sm-9">
                                    <input type="checkbox" id="form-field-1" value="0"  name="h_facility[]">床
                                    <input type="checkbox" id="form-field-1" value="1" name="h_facility[]">衣柜
                                    <input type="checkbox" id="form-field-1" value="2" name="h_facility[]">沙发
                                    <input type="checkbox" id="form-field-1" value="3" name="h_facility[]">电视
                                    <input type="checkbox" id="form-field-1" value="4" name="h_facility[]">冰箱
                                    <input type="checkbox" id="form-field-1" value="5" name="h_facility[]">洗衣机
                                    <input type="checkbox" id="form-field-1" value="6" name="h_facility[]">空调
                                    <input type="checkbox" id="form-field-1" value="7" name="h_facility[]">热水器
                                    <input type="checkbox" id="form-field-1" value="8" name="h_facility[]">宽带
                                    <input type="checkbox" id="form-field-1" value="9" name="h_facility[]">暖气
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> 租金： </label>

                                <div class="col-sm-9">
                                    <input type="text" id="form-field-1" name="h_price" placeholder="面议"  class="col-xs-10 col-sm-5" />
                                    <input type="text" id="form-field-1" name="h_price_type" placeholder="押一付三"  class="col-xs-10 col-sm-5" />
                                </div>
                            </div>


                            <div class="form-group">
                                <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> 标题： </label>

                                <div class="col-sm-9">
                                    <input type="text" id="form-field-1" name="h_title" placeholder="location"  class="col-xs-10 col-sm-5" />
                                </div>
                            </div>


                            <div class="form-group">
                                <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> 房源描述： </label>

                                <div class="col-sm-9">
                                    <textarea  id="" cols="100" rows="3" class="col-sm-3 control-label no-padding-right" name="h_description"></textarea>
                                </div>
                            </div>


                            <div class="form-group">
                                <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> 上传图片： </label>

                                <div class="col-sm-9">
                                    <input type="file" id="form-field-1" name="myfile[]" class="col-xs-10 col-sm-5" multiple="multiple"/>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> 房屋联系人： </label>

                                <div class="col-sm-9">
                                    <input type="text" id="form-field-1" name="h_contact_name" placeholder="h_contact_name"  class="col-xs-10 col-sm-5" />
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> 联系电话： </label>

                                <div class="col-sm-9">
                                    <input type="text" id="form-field-1" name="h_contact_phonenumber" placeholder="introduce"  class="col-xs-10 col-sm-5" />
                                </div>
                            </div>

                            <!-- <div class="form-group">
                                <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> 发布时间： </label>
                            
                                <div class="col-sm-9">
                                    <input type="text" id="form-field-1" name="h_pub_date" placeholder="introduce"  class="col-xs-10 col-sm-5" />
                                </div>
                            </div> -->


                            <!-- <div class="form-group">
                                <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> 审核状态： </label>
                            
                            
                                <div class="col-sm-9">
                                    <input type="radio" id="form-field-1" name="h_ischeck" value="0" />通过
                                    <input type="radio" id="form-field-1" name="h_ischeck" value="1" />未通过
                                </div>
                            </div> -->
                            <div class="form-group">
                                <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> 出租状态： </label>


                                <div class="col-sm-9">
                                    <input type="radio" id="form-field-1" name="h_issell" value="0" />在租
                                    <input type="radio" id="form-field-1" name="h_issell" value="1" />租完
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> 最短租期： </label>

                                <div class="col-sm-9">
                                    <select name="h_timelimit" id="">
                                        <option value="">请选择</option>
                                        <option value="0">一个月起</option>
                                        <option value="1">三个月起</option>
                                        <option value="2">半年起租</option>
                                        <option value="3">一年以上</option>
                                    </select>

                                </div>
                            </div>


                            <div class="clearfix form-actions">
                                <div class="col-md-offset-3 col-md-9">

                                    <i class="icon-ok bigger-110"></i>
                                    <input type="submit" class="btn btn-info" >


                                    &nbsp; &nbsp; &nbsp;

                                    <i class="icon-undo bigger-110"></i>
                                    <input type="reset" class="btn" >

                                </div>
                            </div>
                        </form>
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
    <script  src="http://api.map.baidu.com/api?v=2.0&ak=m2gVumQhSYxRROEin0b0wFcFYHGz68mt"></script>

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


        var map = new BMap.Map("allmap");
//获得地图
function theLocation(){
    $('#allmap').show();
    var city = document.getElementById("cityName").value;
  //  alert(city);
    if(city != ""){
        map.centerAndZoom(city,11);      // 用城市名设置地图中心点
    }
     alert('点击地图获取准确地址');
}
map.enableScrollWheelZoom();    //启用滚轮放大缩小，默认禁用
map.enableContinuousZoom();    //启用地图惯性拖拽，默认禁用

//点击获取坐标
    map.addEventListener("click",function(e) {
        //存储经纬度
        lng = e.point.lng;
        lat = e.point.lat;
        var marker = new BMap.Marker(new BMap.Point(lng,lat));  // 创建标注
        map.addOverlay(marker);
        marker.enableDragging();    //可拖拽
        $('#lng').val(lng);
        $('#lat').val(lat);
    });

    </script>

</body>

</html>
