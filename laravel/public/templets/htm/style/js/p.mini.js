

if (/AppleWebKit.*mobile/i.test(navigator.userAgent) || (/MIDP|SymbianOS|NOKIA|SAMSUNG|LG|NEC|TCL|Alcatel|BIRD|DBTEL|Dopod|PHILIPS|HAIER|LENOVO|MOT-|Nokia|SonyEricsson|SIE-|Amoi|ZTE/.test(navigator.userAgent))) {
    if (window.location.href.indexOf("?mobile") < 0) {
        try {
            if (/Android|webOS|iPhone|iPod|winphone|BlackBerry/i.test(navigator.userAgent)) {
                var url = window.location.href;
                SkipPage(url);

            } else if (/iPad/i.test(navigator.userAgent)) { } else {
                var url = window.location.href;
                SkipPage(url);
            }
        } catch (e) { }
    }
}

//页面跳转
function SkipPage(url) {

    var laststr = url.substr(-1);

    if (url.indexOf("/rent/") > 0) {
        var newurl = "http://m.uoko.com/search.aspx?&city=10000";
        if (url.indexOf("wuhan") > 0) {
            newurl = "http://m.uoko.com/search.aspx?&city=10001";
        }
        else if (url.indexOf("beijing") > 0) {
            newurl = "http://m.uoko.com/search.aspx?&city=10020";
        }
        location.href = newurl;
    } else if (url.indexOf("/questions/") > 0) {
        var newurl = "http://m.uoko.com/questions.aspx?city=10000";
        if (url.indexOf("wuhan") > 0) {
            newurl = "http://m.uoko.com/questions.aspx?&city=10001";
        } else if (url.indexOf("beijing") > 0) {
            newurl = "http://m.uoko.com/questions.aspx?&city=10020";
        }
        location.href = newurl;
    }
    else if (url.indexOf("/product/") > 0) {
        var surl = url.split('/');
        var para = url.substring(url.indexOf("/product/"));
        var resultstr = para.replace("product/", "").replace("/", "");
        var newstr = resultstr.replace(new RegExp("/", "gm"), "&");
        location.href = "http://m.uoko.com/products.aspx?Id=" + newstr + "#mp.weixin.qq.com";
    }
    else if (url.substring(url.lastIndexOf(".com/")) == ".com/") {
        location.href = 'http://m.uoko.com';
    }
}