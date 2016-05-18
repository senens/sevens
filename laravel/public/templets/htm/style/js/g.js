var _hmt = _hmt || [];
(function () {
    var hm = document.createElement("script");
    hm.src = "//hm.baidu.com/hm.js?43f73d73e0de165dc19e11405bb50510";
    var s = document.getElementsByTagName("script")[0];
    s.parentNode.insertBefore(hm, s);
})();
(function () {
    var hm = document.createElement("script");
    hm.src = "//hm.baidu.com/hm.js?9efdb82a30972ce34071a031946aa933";
    var s = document.getElementsByTagName("script")[0];
    s.parentNode.insertBefore(hm, s);
})();
(function () {
    var hm = document.createElement("script");
    hm.src = "//hm.baidu.com/hm.js?446885dbdcc717aebe49f46f61c5cdf9";
    var s = document.getElementsByTagName("script")[0];
    s.parentNode.insertBefore(hm, s);
})();

//<!--cnzzl Analytics -->
var cnzz_protocol = (("https:" == document.location.protocol) ? " https://" : " http://");
document.write(unescape("%3Cspan id='cnzz_stat_icon_1254043655'%3E%3C/span%3E%3Cscript src='" + cnzz_protocol + "w.cnzz.com/q_stat.php%3Fid%3D1254043655' type='text/javascript'%3E%3C/script%3E"));

//<!--google Analytics -->
(function (i, s, o, g, r, a, m) {
    i['GoogleAnalyticsObject'] = r; i[r] = i[r] || function () {
        (i[r].q = i[r].q || []).push(arguments)
    }, i[r].l = 1 * new Date(); a = s.createElement(o),
    m = s.getElementsByTagName(o)[0]; a.async = 1; a.src = g; m.parentNode.insertBefore(a, m)
})(window, document, 'script', '//www.google-analytics.com/analytics.js', 'ga');

ga('create', 'UA-45455223-1', 'auto');
ga('send', 'pageview');

//<!--google ga -->
$(function () {
    var url = location.href.split("//")[1].split(".")[0];
    var QQMessageOnlick = $("#QQMessageOnlick");
    var click_order_kanfang = $("#click_order_kanfang");

    $("#event-cs-wh").on('click', function () {
        ga('send', 'event', 'button', 'click', 'cs-wh');
    }); 
    $("#event-cs-cd").on('click', function () {
        ga('send', 'event', 'button', 'click', 'cs-cd');
    });
    $("#event-cs-bj").on('click', function () {
        ga('send', 'event', 'button', 'click', 'cs-bj');
    });
    if (url == 'wuhan') {
        QQMessageOnlick.on('click', function () {
            ga('send', 'event', 'button', 'click', 'wh_qq');
        });
        click_order_kanfang.on('click', function () {
            ga('send', 'event', 'button', 'click', 'wh_kf');
        });
    } else {
        
        QQMessageOnlick.on('click', function () {
            ga('send', 'event', 'button', 'click', 'cd_qq');
        });
        click_order_kanfang.on('click', function () {
            ga('send', 'event', 'button', 'click', 'cd_kf');
        });
    }
});



