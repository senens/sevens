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
                房东房源<br />
                <small>About_us</small>
            </a>
        </li>

        <li>
            <a href="{{URL('user/tenantmessage')}}">
                用户信息<br />
                <small>Choose</small>
            </a>
        </li>

        <li >
            <a href="{{URL('user/sellh')}}">
                已售房源<br />
                <small>Blog</small>
            </a>
        </li>

        <li>
            <a href="{{URL('user/sellingh')}}">
                在售房源<br />
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
            <h4>上传房源</h4>

                            <form action="{{URL('login/up_house')}} "method="post" class="form-horizontal" role="form">
                                <input type="hidden" name="_token"    value="<?php echo csrf_token() ?>"/>
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


                                <div class="form-group">
                                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> 详细地址： </label>

                                    <div class="col-sm-9">
                                        <input type="text" id="form-field-1" name="h_loc_detail" placeholder="loc_detail"  class="col-xs-10 col-sm-5" />
                                    </div>
                                </div>



                                <div class="form-group">
                                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> 性别： </label>

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
                                            <option value="0">向北</option>
                                            <option value="0">向北</option>
                                            <option value="0">向北</option>
                                        </select>　
                                        <select name="h_decorate" id="">
                                            <option value="0">装修情况</option>
                                            <option value="0">向北</option>
                                            <option value="0">向北</option>
                                            <option value="0">向北</option>
                                        </select>　
                                        <select name="h_type" id="">
                                            <option value="0">普通住户</option>
                                            <option value="0">向北</option>
                                            <option value="0">向北</option>
                                            <option value="0">向北</option>
                                        </select>
                                    </div>
                                </div>


                                <div class="form-group">
                                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1" > 房屋配置： </label>

                                    <div class="col-sm-9">
                                        <input type="checkbox" id="form-field-1" name="h_facility">床
                                        <input type="checkbox" id="form-field-1" name="h_facility">衣柜
                                        <input type="checkbox" id="form-field-1" name="h_facility">沙发
                                        <input type="checkbox" id="form-field-1" name="h_facility">电视
                                        <input type="checkbox" id="form-field-1" name="h_facility">冰箱
                                        <input type="checkbox" id="form-field-1" name="h_facility">洗衣机
                                        <input type="checkbox" id="form-field-1" name="h_facility">空调
                                        <input type="checkbox" id="form-field-1" name="h_facility">热水器
                                        <input type="checkbox" id="form-field-1" name="h_facility">宽带
                                        <input type="checkbox" id="form-field-1" name="h_facility">暖气
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
                                        <textarea name="" id="" cols="100" rows="3" class="col-sm-3 control-label no-padding-right" name="h_description"></textarea>
                                    </div>
                                </div>


                                <div class="form-group">
                                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> 上传图片： </label>

                                    <div class="col-sm-9">
                                        <input type="file" id="form-field-1" name="h_photo" class="col-xs-10 col-sm-5" />
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


                                <div class="form-group">
                                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> 发布时间： </label>

                                    <div class="col-sm-9">
                                        <input type="text" id="form-field-1" name="h_pub_date" placeholder="introduce"  class="col-xs-10 col-sm-5" />
                                    </div>
                                </div>


                                <div class="form-group">
                                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> 审核状态： </label>


                                    <div class="col-sm-9">
                                        <input type="radio" id="form-field-1" name="h_ischeck" value="0" />通过
                                        <input type="radio" id="form-field-1" name="h_ischeck" value="1" />未通过
                                    </div>
                                </div>



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
                                        <input type="text" id="form-field-1" name="h_timelimit" placeholder="status"  class="col-xs-10 col-sm-5" />
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
