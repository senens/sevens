/*----------------------------------------
  详情页 Product
----------------------------------------*/
/* 相册 */
$(function(){
    //公用
    var p = $(".room-slide-image");
    var $big = $(".slide-image-big li");
    var $small = $(".slide-image-small li");
    //图片显示和路径替换
    function imgreplace(i) {
        var z = $big.eq(i).fadeTo(500, 1).removeClass("hidden").find("img");
        var data = z.attr('data-src');
        z.attr('src', data);
    }
    //默认加载第一个；
    imgreplace(0);

    $small.on('click', function () {
       
        var z = $(this).index();
        $(this).find("img").addClass("current").parent().siblings().find("img").removeClass("current");
        imgreplace(z);
        $big.eq(z).siblings().fadeTo(10, 0).addClass("hidden");
    });
    /* 小图滚动 */
    function SmalImg() {
        var big_w = $big.find("img").eq(0).width() - 26;
        var image_list = $(".image-list");

        var p_width = $(".slide-image-small").width() - 26;
        var img_n = $small.length;
        var img_w = $small.width() + 2;
        var i = Math.floor(big_w / img_w);
        var yu = Math.floor(big_w % img_w / 2);
        image_list.css({
            'width': img_w * i,
            "marginLeft": yu,
            "marginRight": yu - 1

        });
        var content_h = img_w * i;

        var prev = p.find(".image-prev");
        var next = p.find(".image-next");
        var content = p.find(".image-list-content");
        var t = 1;
        prev.hide();
        next.hide();
        if (img_n > i) {
            prev.show().css("display", "block");
            next.show().css("display", "block");
            //下一个
            next.click(function () {
                
                if (!content.is(":animated")) {
                    var z = image_list.find(".current").parent().index();
                    $small.eq(z + 1).trigger("click");
                    if ((z + 1) >= i) {
                        if ((z + 1) == img_n) {
                            content.stop().animate({
                                marginLeft: '0px'
                            }
							, 300);
                            $small.eq(0).trigger("click");
                        }
                        else {
                            content.stop().animate({
                                marginLeft: '-=' + img_w
                            }
							, 300);
                        }
                    }
                }
            });
            //上一个
            prev.click(function () {
                if (!content.is(":animated")) {
                    var z = image_list.find(".current").parent().index();
                    $small.eq(z - 1).trigger("click");
                    if (z < i) {
                        if (z == 0) {
                            content.stop().animate({
                                marginLeft: '-=' + img_w * (img_n - i)

                            }
							, "slow");
                        }
                    }
                    else {
                        content.stop().animate({
                            marginLeft: '+=' + img_w

                        }
, "slow");
                    }
                    // console.log(z, i);
                }
            });
        }
        else {
            image_list.css("marginLeft", "0");
        }
    }
    SmalImg();


    $(window).resize(function () {
        SmalImg();
    });

    /* Introl 描述 */
    //搬家劵
    var house = $(".move_house");
    var box = house.find(".move_box");
    house.mouseover(function () {
        box.stop().show();
    }).mouseout(function () {
        box.stop().hide();
    });


    //select 选择房间
    var room_price = 0;//单价
    var room_number = '';//字母编号
    var ischeck = 0;//是否选中
    var room_select = 0;//房间
    var IsSh = 0;
    var element = ".btn_room";
    var parent = $(".pro_select");
    var current = "current";
    var table_config = $(".table_config .btn");
    var pro_price = $("#rental");
    var pro_bprice = $("#brental");

    // 表格预约看房
    //table_config.click(function () {
    //    var table_val = $(this).attr("d");
    //    $(".room_select .btn_room").eq(table_val).addClass(current).siblings().removeClass(current);
    //});

    $(element).on('click', function () {
        var z = $(this).index();
        var room_price = $(this).attr("price");
        var room_bprice = $(this).attr("bprice");
        var room_number = $(this).attr("d");
        var room_type_t = $(this).attr("t");
        var IsSh = $(this).attr("s");

        if ($(this).hasClass(current)) {
            //预约显示
            parent.each(function () {
                $(this).find(element).eq(z).not(".disabled").removeClass(current);
            });
            var df = $(this).attr("r") + ",";
            room_select = room_select.replace(df, '');
        }
        else {
            room_select += $(this).attr("r") + ",";
            $(this).not(".disabled").addClass("current").siblings(element).removeClass("current");
            //console.log(room_type_t, room_bprice);
            if (room_type_t == 1 && room_bprice > 0) {
                pro_bprice.parents(".bar").removeClass("hidden");
                pro_bprice.text(room_price);
                pro_price.text(room_bprice).parent().addClass("pro-sales");

            } else {
                pro_bprice.parents(".bar").addClass("hidden");
                pro_price.text(room_price).parent().removeClass("pro-sales");
            }

            //预约显示
            parent.each(function () {
                $(this).find(element).eq(z).not(".disabled").addClass("current");
            });
        }
        ischeck = 1;


    });
    // 微信
    var table_weixin = $(".table_weixin");//详情页表格弹出
    var f_bottom = $(".f_bottom ");//通用调用微信
    var weixin_home = $("#weixin_home");
    table_weixin.on('click', function () {
        $(this).removeClass("weixin_down").addClass("weixin_up");
        weixin_home.removeClass("modal_con_weixin").addClass("modal_pro_weixin");
    });
    $(document).on('hide.bs.modal', ".modal_pro_weixin", function (e) {
        table_weixin.removeClass("weixin_up").addClass("weixin_down");
    });

    // 地图
    var dvPolicy = $("#dvPolicy .btn");
    var map_nav = $(".map-detail a");
    map_nav.click(function () {
        $(this).addClass("on").siblings().removeClass("on");
    });
    dvPolicy.on('click', function () {
        $(this).addClass("btn-primary selected").siblings().removeClass("btn-primary selected").addClass("btn-default");
    });

});


//地图找房链接过来的文字
$(function () {
   var posCurrent = $("#roomCode").val();
    var len = $(".btn_room").length;
    for (var i = 0; i < len; i++) {
        if ($($(".btn_room")[i]).attr("d") === posCurrent) {
            $("#rental").text($($(".btn_room")[i]).attr("price"));
            $($(".btn_room")[i]).addClass("current");
         };
    }

})


$(function (a) {
    a(".diagram-img-big").magnificPopup({
        "delegate": "a",
        "type": "image",
        "tLoading": "骚等，图片加载中...",
        "mainClass": "mfp-img-mobile",
        "gallery": {
            "enabled": !0,
            "navigateByImgClick": !0,
            "preload": [0, 1]
        },
        "image": {
            "tError": "该图未能正常读取...",
            "titleSrc": function (b) {
                return b.el.attr('title') + '<small>商业盗图要遭剁</small>';
            }
        }
    }), a(".house_type").magnificPopup({
        "type": "image",
        "closeOnContentClick": !0,
        "tLoading": "户型图加载中...",
        "mainClass": "mfp-img-mobile",
        "image": {
            "verticalFit": !0,
            "tError": "暂时没找到该户型图！",
            "titleSrc": function (b) {
                return "<small>商业盗图要遭剁</small>";
            }
        }
    });
}), $(function (a) {
    var c = a("#product_nav"), b = c.offset().top, d = a(".pro_right_info");
    a(window).scroll(function () {
        var f = a(window).scrollTop(), e = "navbar-fixed-top top-box-shadow";
        f > b ? (c.css("margin-top", "0px").addClass(e), d.removeClass("hidden")) : f < b && (c.css("margin-top", "50px").removeClass(e), d.addClass("hidden"));
    });
}),$(function (a) {
    var f = $(".pro_share_button"), e = $(".slide_share_box"), g = $(".room_slide_share");
    f.on("click", function () {
        $(this).hasClass("switch_1") ? (e.animate({
            "width": "+150px"
        }, "100"), $(this).removeClass("switch_1")) : (e.animate({
            "width": "+250px"
        }, "100"), $(this).addClass("switch_1"));
    });

    //weixin share
    var b = $(".show_content"), c = $(".hide_content ");
    $(document).on("mouseover", ".bs_weixin,.bs_weixin_box", function () {
        b.addClass("hidden"); c.removeClass("hidden").addClass("bs_weixin_in");
    }).mouseout(function () {
        c.addClass("hidden"); b.removeClass("hidden");
    });
});
$(function () {
    $(".btn-pro-con").on("click", function (e) {
        $("#Room_box .modal-content").eq(0).addClass("hidden").siblings().removeClass("hidden");
    });
    $.cachedScript = function (url, options) {
        return options = $.extend(options || {}, {
            "dataType": "script",
            "cache": !0,
            "url": url
        }), $.ajax(options);
    };
    var t_1 = !0, t_2 = !0;
    $(".ImageMapNav").click(function () {
        $(".ImageMapDiv").trigger('click');
    });
    $(".ImageMapDiv").click(function () {
        t_1 == 1 && $.getScript("http://api.map.baidu.com/getscript?v=1.3&ak=&services=&t=20140102035033", function () {
            $.cachedScript("/statics/js/jquery.detailmap.js");
        }), t_1 = !1;
    }), $(".btn-pro-valid").click(function () {
        t_2 == 1 && $.getScript("/statics/plugins/Validform/validation.min.js", function () {
            var select = $(".room_select");
            select.validation();
            var sub = $(".btn-valid");
            sub.on("click", function () {
                if (select.valid() == 0) return !1;
                var name = $(".pro_message_name").val(), tel = $(".pro_message_tel").val(), sex = $("input[name='sex']:checked").val(), people = $("input[name='people']:checked").val(), remarks = $(".pro_message_remarks").val(), userorigin = $(".ddl_UserOrigin option:selected").val(), proData = "name=" + name;
                proData += "&tel=" + tel, proData += "&sex=" + sex, proData += "&people=" + people, proData += "&remarks=" + remarks, proData += "&userorigin=" + userorigin, proData += "&cityId=" + $(".hiddencityId").val();
                var xz = $(".room_select").find(".pro_select").find(".current"), rooms = ""; roomdesc = ""; sourcenums = $("#sourceNum").val();
                $.each(xz, function (index, file) {
                    rooms += $(file).attr("r") + ",";
                    roomdesc += $(file).text() + ",";
                }), proData += "&Rooms=" + rooms, proData += "&roomdesc=" + roomdesc, proData += "&sourcenums=" + sourcenums, $.ajax({
               
                    "type": "POST",
                    "url": "/reserve",
                    "data": proData,
                    "dataType": "JSON",
                    "success": function (data) {
                        var call_name = $(".select_call_name").text(name);
                        $("#Room_box_callback").modal("show");
                        $("#Room_box").modal("hide");
                    }
                });
                

               
            });
        }),  t_2 = !1;
    }), 


    $(function () {
        var add = "navbar-fixed-top top-box-shadow";
        var c = $("#product_nav"), b = c.offset().top, d = $(".pro_right_info");
       var p_e = $(".order-ico-group");
       var e = p_e.find(".sprite");
        var n = e.length;
        var p = $(".probox");
        var m = 1;
        e.hide();
        $(".probox").each(function () {
            var t = $(this);
            $(window).on("scroll",function () {
                var scrollTop = $(window).scrollTop();
                var z = t.index() - 2;
                var h = t.offset().top - (z * 35) - 60;
                var s = t.find(".probox-heading .sprite");
                //console.log($(".probox").eq(6));
                var l = $(".probox").eq(6).offset().top- (6 * 35) - 60;

                if (scrollTop >= h) {
                   e.eq(z).css("display", "block").removeClass("sprite_probox_hover").prev().addClass("sprite_probox_hover");
                    s.css("visibility", "hidden");
                    if (scrollTop > l) {
                        e.slice(0, 4).hide();
                    }
                } else {
                    e.eq(z).hide();
                    s.css("visibility", "visible");
                }
               if (scrollTop > b) {
                   c.css("margin-top", "0px").addClass(add);
                    d.removeClass("hidden");
                } else {
                   c.removeClass(add);
                   e.hide();
                   d.addClass("hidden");
               }

            });
        });
        e.on("click", function () {
            var z = $(this).index();
            var h = p.eq(z).offset().top - (z * 35) - 60;
            $("html, body").animate({ scrollTop: h });
        });



    });
});