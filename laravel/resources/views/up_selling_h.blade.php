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
                    <li>
                        <a href="{{URL('user/tenantmessage')}}">
                            个人信息<br />
                            <small>Personal Information</small>
                        </a>
                    </li>
                    <!-- <li>
                        <a href="{{URL('user/intive_friend')}}">
                            邀请好友<br />
                            <small>Choose</small>
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
                            <h4>在租修改房源</h4>
                                  @foreach($valls as $vv)
                            <form action="{{URL('user/update_housesing')}}"method="post" class="form-horizontal" role="form" enctype="multipart/form-data">
                                <input type="hidden" name="_token"    value="<?php echo csrf_token() ?>"/>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> 出租方式： </label>
                                    <div class="col-sm-9">
                                        @if('{{$vv->house_rent_type}}'==0)
                                        <input type="radio" id="form-field-1" name="h_rent_type" checked value="0" />整套出租　
                                        <input type="radio" id="form-field-1" name="h_rent_type" value="1" />单间出租　
                                        <input type="radio" id="form-field-1" name="h_rent_type" value="2" />床位出租
                                        @elseif('{{$vv->house_rent_type}}'==1)
                                        <input type="radio" id="form-field-1" name="h_rent_type" value="0" />整套出租　
                                        <input type="radio" id="form-field-1" name="h_rent_type" checked  value="1" />单间出租　
                                        <input type="radio" id="form-field-1" name="h_rent_type" value="2" />床位出租
                                        @elseif('{{$vv->house_rent_type}}'==2)
                                        <input type="radio" id="form-field-1" name="h_rent_type" value="0" />整套出租　
                                        <input type="radio" id="form-field-1" name="h_rent_type" value="1" />单间出租　
                                        <input type="radio" id="form-field-1" name="h_rent_type" checked  value="2" />床位出租
                                       @endif
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> 小区名称： </label>

                                    <div class="col-sm-9">
                                        <input type="text" id="form-field-1" name="h_plot_name" value="{{$vv->h_plot_name}}"   class="col-xs-10 col-sm-5" />
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> 详细地址： </label>

                                    <div class="col-sm-9">
                                        <input type="text" id="form-field-1" name="h_loc_detail" value="{{$vv->h_loc_detail}}" placeholder="loc_detail"  class="col-xs-10 col-sm-5" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> 性别： </label>
                                    <div class="col-sm-9">
                                        @if('{{$vv->house_gender_demand}}'==0)
                                            <input type="radio" id="form-field-1" checked name="h_gender_demand" value="0" />男
                                            <input type="radio" id="form-field-1" name="h_gender_demand" value="1" />女
                                        @elseif('{{$vv->house_gender_demand}}'==1)
                                            <input type="radio" id="form-field-1" name="h_gender_demand" value="0" />男
                                            <input type="radio" id="form-field-1" checked name="h_gender_demand" value="1" />女
                                   @endif
                                    </div>
                                </div>
                                <div class="space-4"></div>

                                <div class="form-group">
                                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> 房屋户型： </label>

                                    <div class="col-sm-9">
                                        <input type="text" id="form-field-1" value="{{$vv->h_room_num}}" name="h_room_num" placeholder="doors_type" />室
                                        <input type="text" id="form-field-1" value="{{$vv->h_hall_num}}" name="h_hall_num" placeholder="doors_type" />厅
                                        <input type="text" id="form-field-1" value="{{$vv->h_toilet_num}}" name="h_toilet_num" placeholder="doors_type" />卫
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> 租金： </label>

                                    <div class="col-sm-9">
                                        <input type="text" id="form-field-1" name="h_price" value="{{$vv->h_price}}" placeholder="面议"  class="col-xs-10 col-sm-5" />
                                        <input type="text" id="form-field-1" name="h_price_type" value="{{$vv->h_price_type}}" placeholder="押一付三"  class="col-xs-10 col-sm-5" />
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> 标题： </label>

                                    <div class="col-sm-9">
                                        <input type="text" id="form-field-1" name="h_title" value="{{$vv->h_title}}" placeholder="location"  class="col-xs-10 col-sm-5" />
                                    </div>
                                </div>


                                <div class="form-group">
                                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> 房源描述： </label>

                                    <div class="col-sm-9">
                                        <textarea name="h_description"  id="" cols="100" rows="3" class="col-sm-3 control-label no-padding-right" name="h_description">{{$vv->h_description}}</textarea>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> 房屋联系人： </label>

                                    <div class="col-sm-9">
                                        <input type="text" id="form-field-1" value="{{$vv->h_contact_name}}" name="h_contact_name" placeholder="h_contact_name"  class="col-xs-10 col-sm-5" />
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> 联系电话： </label>

                                    <div class="col-sm-9">
                                        <input type="text" id="form-field-1" value="{{$vv->h_contact_phonenumber}}" name="h_contact_phonenumber" placeholder="introduce"  class="col-xs-10 col-sm-5" />
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> 最短租期： </label>

                                    <div class="col-sm-9">
                                        <input type="text" id="form-field-1" name="h_timelimit" value="{{$vv->h_timelimit}}" placeholder="status"  class="col-xs-10 col-sm-5" />
                                    </div>
                                </div>
                                <div class="clearfix form-actions">
                                    <div class="col-md-offset-3 col-md-9">

                                        <i class="icon-ok bigger-110"></i>
                                        <input type="submit" class="btn btn-info" value="完成修改" >


                                        &nbsp; &nbsp; &nbsp;

                                        <i class="icon-undo bigger-110"></i>
                                        <input type="reset" class="btn" >

                                    </div>
                                </div>
                                @endforeach
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
