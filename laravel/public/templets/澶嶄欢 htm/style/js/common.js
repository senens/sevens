/*!----------------------------------------
 *
 *
 * Author:       wenshu
 * Message:      wenshu@uoko.com
 * QQ:           860902982
 *
 * Date Created:2014-10-13
 * Last Updated:2015-01-12
 *
 * Copyright:uoko.com 
 *
 * 
----------------------------------------*/

/*----------------------------------------
  cookie
----------------------------------------*/
(function (factory) {
    if (typeof define === 'function' && define.amd) {
        // AMD. Register as anonymous module.
        define(['jquery'], factory);
    }
    else {
        // Browser globals.
        factory(jQuery);
    }
}(function ($) {
    var pluses = /\+/g;
    function encode(s) {
        return config.raw ? s : encodeURIComponent(s);
    }
    function decode(s) {
        return config.raw ? s : decodeURIComponent(s);
    }
    function stringifyCookieValue(value) {
        return encode(config.json ? JSON.stringify(value) : String(value));
    }
    function parseCookieValue(s) {
        if (s.indexOf('"') === 0) {
            s = s.slice(1, -1).replace(/\\"/g, '"').replace(/\\\\/g, '\\');
        }
        try {
            s = decodeURIComponent(s.replace(pluses, ' '));
        }
        catch (e) {
            return;
        }
        try {
            return config.json ? JSON.parse(s) : s;
        }
        catch (e) { }

    }
    function read(s, converter) {
        var value = config.raw ? s : parseCookieValue(s);
        return $.isFunction(converter) ? converter(value) : value;
    }
    var config = $.cookie = function (key, value, options) {

        if (value !== undefined && !$.isFunction(value)) {
            options = $.extend({}, config.defaults, options);
            if (typeof options.expires === 'number') {
                var days = options.expires,
				t = options.expires = new Date();
                t.setDate(t.getDate() + days);
            }
            return (document.cookie = [
encode(key), '=', stringifyCookieValue(value),
options.expires ? '; expires=' + options.expires.toUTCString() : '', // use expires attribute, max-age is not supported by IE
options.path ? '; path=' + options.path : '',
options.domain ? '; domain=' + options.domain : '',
options.secure ? '; secure' : ''
            ].join(''));
        }

        var result = key ? undefined : {};
        var cookies = document.cookie ? document.cookie.split('; ') : [];
        for (var i = 0, l = cookies.length; i < l; i++) {
            var parts = cookies[i].split('=');
            var name = decode(parts.shift());
            var cookie = parts.join('=');
            if (key && key === name) {
                result = read(cookie, value);
                break;
            }
            if (!key && (cookie = read(cookie)) !== undefined) {
                result[name] = cookie;
            }
        }
        return result;
    };
    config.defaults = {};
    $.removeCookie = function (key, options) {
        if ($.cookie(key) !== undefined) {
            $.cookie(key, '', $.extend({}, options, {
                expires: -1

            }));
            return true;
        }
        return false;
    };
}));

//$(function () {
//   // 押一付三
//    var YayiCookie = $.cookie('yayifu');
//    var btn = $("#Room_box");
//    var yayi = $(".modal_yayi_sl");
//    if (YayiCookie) {
//        if (YayiCookie == 'ab') {
//        }
//        else {
//            btn.attr("data-mark", 'ac');
//            yayi.addClass("hidden").siblings().removeClass("hidden");
//        }
//    }
//    btn.on('hidden.bs.modal', function (e) {
//        if ($(this).attr("data-mark") == 'ab') {
//            $(this).attr("data-mark", "ac");
//            $.cookie('yayifu', "ac", {
//                expires: 3,
//                path: "/"

//            });
//            yayi.addClass("hidden").siblings().removeClass("hidden");
//        }
//    });
//});

var Custom = function () {

    var handleProductHover = function () {
        var thumb = $(".thumb-box");
        var c = "current";
        thumb.mouseover(function () {
            $(this).addClass(c).siblings().removeClass(c);
        }).mouseout(function () {
            $(this).removeClass(c);
        });
    }

    // tooltip && popover 信息激活
    var handlePopverPayment = function () {
        var info = $(".popover-payment-box").find(".payment-content");
        var payment = $('.popover-payment');
        payment.popover({
            content: info,
            html: true,
        });

    }


    // email 邮件地址替换处理
    var handelEmailRep = function () {
        $(".email a").each(function () {
            var mailReal = $(this).text().replace("[-at-]", "@");
            $(this).text(mailReal);
            $(this).attr("href", "mailto:" + mailReal);
        });
        $(window).on('load',function () {
            $(".email-static").each(function () {
                var mailReal = $(this).text().replace("[-at-]", "@");
                $(this).text(mailReal);
            });
        });
    }

    //信息激活
    var handelTipPopover = function () {
        $('.tips').tooltip();
        $(".popovers").mouseover(function () {
            $(this).popover("show");
        }).mouseout(function () {
            $(this).popover("hide");
        });
        //你搬家我买单
        var info = $(".payment-box").find(".payment-content");
        $('.btn-popover-pay').popover({
            content: info,
            html: true,

        });
        
    }

    /* float  bar right */

    $(function () {

        $(".float-right-bar li").hover(function () {

            var weixin = $(this).find(".js-share-weixin");
            var bdshare = $(this).find(".js-bdshare");
            if (weixin.length > 0) {
                weixin.show().animate({ "left": "-160px" }, 300);

            } else if (bdshare.length > 0) {

                bdshare.show().animate({ "left": "-160px" }, 300);
            } else {
                $(this).find(".tooltip").show().animate({ "left": "-76px" }, 300);
            }


        }, function () {

            var weixin = $(this).find(".js-share-weixin");
            var bdshare = $(this).find(".js-bdshare");

            if (weixin.length > 0) {
                weixin.hide().animate({ "left": "-200px" }, 300);

            } else if(bdshare.length > 0) {
                bdshare.hide().animate({ "left": "-200px" }, 300);
            } else {
                $(this).find(".tooltip").hide().animate({ "left": "-100px" }, 300);
            }
        })

        $(".bar-backtop").on("click", function () {
            $('body,html').animate({ scrollTop: 0 }, 300); return false;
        })

    })

    /* 图片检索 */
    $(function ($) {
        var p_list = $(".p_list .p_box");
        p_list.mouseover(function () {
            $(this).addClass("current").siblings().removeClass("current");
        }).mouseout(function () {
            $(this).removeClass("current");
        });

    });
    /* nosearch 无图效果 */
    $(function ($) {
        var img_big = $(".noseach ").find(".big");
        var img_small = $(".noseach ").find(".noserch_show");
        img_big.delay(800).hide(500);
        img_small.delay(1000).show(1000);
    });

    //友情链接轮播
    $(function () {
        var index = 0;
        var len = $(".js-f-link div").length;
        $(".js-f-link div").hide();

        setInterval(function () {
            if (len > 0) {
                $(".js-f-link div").hide();
                $(".js-f-link div").eq(index).show();
                index++;
                if (index == len) {
                    index = 0;
                }
            }

           
        }, 5000);
        $(".js-f-link div").eq(index).show();

    });


    return {
        init: function () {
            handlePopverPayment();
            handelEmailRep();
            handleProductHover();
            handelTipPopover();

        },

    };
}();