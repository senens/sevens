/**
 * @license 
 * jQuery Tools @VERSION / Expose - Dim the lights
 * 
 * NO COPYRIGHTS OR LICENSES. DO WHAT YOU LIKE.
 * 
 * http://flowplayer.org/tools/toolbox/expose.html
 *
 * Since: Mar 2010
 * Date: @DATE 
 */
(function($) { 	

	// static constructs
	$.tools = $.tools || {version: '@VERSION'};
	
	var tool;
	
	tool = $.tools.expose = {
		
		conf: {	
			maskId: 'exposeMask',
			loadSpeed: 'slow',
			closeSpeed: 'fast',
			closeOnClick: true,
			closeOnEsc: true,
			
			// css settings
			zIndex: 9998,
			opacity: 0.8,
			startOpacity: 0,
			color: '#fff',
			
			// callbacks
			onLoad: null,
			onClose: null
		}
	};

	/* one of the greatest headaches in the tool. finally made it */
	function viewport() {
				
		// the horror case
		if ($.browser.msie) {
			
			// if there are no scrollbars then use window.height
			var d = $(document).height(), w = $(window).height();
			
			return [
				window.innerWidth || 							// ie7+
				document.documentElement.clientWidth || 	// ie6  
				document.body.clientWidth, 					// ie6 quirks mode
				d - w < 20 ? w : d
			];
		} 
		
		// other well behaving browsers
		return [$(document).width(), $(document).height()]; 
	} 
	
	function call(fn) {
		if (fn) { return fn.call($.mask); }
	}
	
	var mask, exposed, loaded, config, overlayIndex;		
	
	
	$.mask = {
		
		load: function(conf, els) {
			
			// already loaded ?
			if (loaded) { return this; }			
			
			// configuration
			if (typeof conf == 'string') {
				conf = {color: conf};	
			}
			
			// use latest config
			conf = conf || config;
			
			config = conf = $.extend($.extend({}, tool.conf), conf);

			// get the mask
			mask = $("#" + conf.maskId);
				
			// or create it
			if (!mask.length) {
				mask = $('<div/>').attr("id", conf.maskId);
				$("body").append(mask);
			}
			
			// set position and dimensions 			
			var size = viewport();
				
			mask.css({				
				position:'absolute', 
				top: 0, 
				left: 0,
				width: size[0],
				height: size[1],
				display: 'none',
				opacity: conf.startOpacity,					 		
				zIndex: conf.zIndex 
			});
			
			if (conf.color) {
				mask.css("backgroundColor", conf.color);	
			}			
			
			// onBeforeLoad
			if (call(conf.onBeforeLoad) === false) {
				return this;
			}
			
			// esc button
			if (conf.closeOnEsc) {						
				$(document).bind("keydown.mask", function(e) {							
					if (e.keyCode == 27) {
						$.mask.close(e);	
					}		
				});			
			}
			
			// mask click closes
			if (conf.closeOnClick) {
				mask.bind("click.mask", function(e)  {
					$.mask.close(e);		
				});					
			}			
			
			// resize mask when window is resized
			$(window).bind("resize.mask", function() {
				$.mask.fit();
			});
			
			// exposed elements
			if (els && els.length) {
				
				overlayIndex = els.eq(0).css("zIndex");

				// make sure element is positioned absolutely or relatively
				$.each(els, function() {
					var el = $(this);
					if (!/relative|absolute|fixed/i.test(el.css("position"))) {
						el.css("position", "relative");		
					}					
				});
			 
				// make elements sit on top of the mask
				exposed = els.css({ zIndex: Math.max(conf.zIndex + 1, overlayIndex == 'auto' ? 0 : overlayIndex)});			
			}	
			
			// reveal mask
			mask.css({display: 'block'}).fadeTo(conf.loadSpeed, conf.opacity, function() {
				$.mask.fit(); 
				call(conf.onLoad);
				loaded = "full";
			});
			
			loaded = true;			
			return this;				
		},
		
		close: function() {
			if (loaded) {
				
				// onBeforeClose
				if (call(config.onBeforeClose) === false) { return this; }
					
				mask.fadeOut(config.closeSpeed, function()  {					
					call(config.onClose);					
					if (exposed) {
						exposed.css({zIndex: overlayIndex});						
					}				
					loaded = false;
				});				
				
				// unbind various event listeners
				$(document).unbind("keydown.mask");
				mask.unbind("click.mask");
				$(window).unbind("resize.mask");  
			}
			
			return this; 
		},
		
		fit: function() {
			if (loaded) {
				var size = viewport();				
				mask.css({width: size[0], height: size[1]});
			}				
		},
		
		getMask: function() {
			return mask;	
		},
		
		isLoaded: function(fully) {
			return fully ? loaded == 'full' : loaded;	
		}, 
		
		getConf: function() {
			return config;	
		},
		
		getExposed: function() {
			return exposed;	
		}		
	};
	
	$.fn.mask = function(conf) {
		$.mask.load(conf,this);
		return this;		
	};			
	
	$.fn.expose = function(conf) {
		$.mask.load(conf, this);
		return this;			
	};


})(jQuery);

/**
 * @license 
 * jQuery Tools @VERSION Tabs- The basics of UI design.
 * 
 * NO COPYRIGHTS OR LICENSES. DO WHAT YOU LIKE.
 * 
 * http://flowplayer.org/tools/tabs/
 *
 * Since: November 2008
 * Date: @DATE 
 */  
(function ($) {

    // static constructs
    $.tools = $.tools || { version: '@VERSION' };

    $.tools.tabs = {

        conf: {
            tabs: 'a',
            current: 'current',
            onBeforeClick: null,
            onClick: null,
            effect: 'default',
            initialIndex: 0,
            event: 'click',
            rotate: false,

            // slide effect
            slideUpSpeed: 400,
            slideDownSpeed: 400,

            // 1.2
            history: false
        },

        addEffect: function (name, fn) {
            effects[name] = fn;
        }

    };

    var effects = {

        // simple "toggle" effect
        'default': function (i, done) {
            this.getPanes().hide().eq(i).show();
            done.call();
        },

        /*
        configuration:
        - fadeOutSpeed (positive value does "crossfading")
        - fadeInSpeed
        */
        fade: function (i, done) {

            var conf = this.getConf(),
				 speed = conf.fadeOutSpeed,
				 panes = this.getPanes();

            if (speed) {
                panes.fadeOut(speed);
            } else {
                panes.hide();
            }

            panes.eq(i).fadeIn(conf.fadeInSpeed, done);
        },

        // for basic accordions
        slide: function (i, done) {
            var conf = this.getConf();

            this.getPanes().slideUp(conf.slideUpSpeed);
            this.getPanes().eq(i).slideDown(conf.slideDownSpeed, done);
        },

        /**
        * AJAX effect
        */
        ajax: function (i, done) {
            var tab = this.getTabs().eq(i);
            var href = tab.attr("href");
            if (typeof (tab.attr("url")) != "undefined") {
                href = tab.attr("url");
            }
            if (href.indexOf("?") != -1) {
                href += "&tmptime" + (new Date()).getTime()
            } else {
                href += "?tmptime" + (new Date()).getTime()
            }
            //this.getPanes().eq(0).load(this.getTabs().eq(i).attr("href"), done);
            this.getPanes().eq(0).load(href, done);
        }
    };

    /**
    * Horizontal accordion
    * 
    * @deprecated will be replaced with a more robust implementation
    */

    var 
    /**
    *   @type {Boolean}
    *
    *   Mutex to control horizontal animation
    *   Disables clicking of tabs while animating
    *   They mess up otherwise as currentPane gets set *after* animation is done
    */
	  animating,
    /**
    *   @type {Number}
    *   
    *   Initial width of tab panes
    */
	  w;

    $.tools.tabs.addEffect("horizontal", function (i, done) {
        if (animating) return;    // don't allow other animations

        var nextPane = this.getPanes().eq(i),
	      currentPane = this.getCurrentPane();

        // store original width of a pane into memory
        w || (w = this.getPanes().eq(0).width());
        animating = true;

        nextPane.show(); // hidden by default

        // animate current pane's width to zero
        // animate next pane's width at the same time for smooth animation
        currentPane.animate({ width: 0 }, {
            step: function (now) {
                nextPane.css("width", w - now);
            },
            complete: function () {
                $(this).hide();
                done.call();
                animating = false;
            }
        });
        // Dirty hack...  onLoad, currentPant will be empty and nextPane will be the first pane
        // If this is the case, manually run callback since the animation never occured, and reset animating
        if (!currentPane.length) {
            done.call();
            animating = false;
        }
    });


    function Tabs(root, paneSelector, conf) {

        var self = this,
			 trigger = root.add(this),
			 tabs = root.find(conf.tabs),
			 panes = (paneSelector &&  paneSelector.jquery) ? paneSelector : root.children(paneSelector),
			 current;


        // make sure tabs and panes are found
        if (!tabs.length) { tabs = root.children(); }
        if (!panes.length) { panes = root.parent().find(paneSelector); }
        if (!panes.length) { panes = $(paneSelector); }


        // public methods
        $.extend(this, {
            click: function (i, e) {
                var tab = tabs.eq(i);

                if (typeof i == 'string' && i.replace("#", "")) {
                    tab = tabs.filter("[href*=" + i.replace("#", "") + "]");
                    i = Math.max(tabs.index(tab), 0);
                }

                if (conf.rotate) {
                    var last = tabs.length - 1;
                    if (i < 0) { return self.click(last, e); }
                    if (i > last) { return self.click(0, e); }
                }

                if (!tab.length) {
                    if (current >= 0) { return self; }
                    i = conf.initialIndex;
                    tab = tabs.eq(i);
                }

                // possibility to cancel click action
                e = e || $.Event();
                e.type = "onBeforeClick";
                trigger.trigger(e, [i]);
                if (e.isDefaultPrevented()) { return; }
                // current tab is being clicked
                if (i === current) { return self; }
                // call the effect
                effects[conf.effect].call(self, i, function () {
                    current = i;
                    // onClick callback
                    e.type = "onClick";
                    trigger.trigger(e, [i]);
                });

                // default behaviour
                tabs.removeClass(conf.current);
                tab.addClass(conf.current);

                return self;
            },

            getConf: function () {
                return conf;
            },

            getTabs: function () {
                return tabs;
            },

            getPanes: function () {
                return panes;
            },

            getCurrentPane: function () {
                return panes.eq(current);
            },

            getCurrentTab: function () {
                return tabs.eq(current);
            },

            getIndex: function () {
                return current;
            },

            next: function () {
                return self.click(current + 1);
            },

            prev: function () {
                return self.click(current - 1);
            },

            destroy: function () {
                tabs.unbind(conf.event).removeClass(conf.current);
                panes.find("a[href^=#]").unbind("click.T");
                return self;
            }

        });

        // callbacks
        $.each("onBeforeClick,onClick".split(","), function (i, name) {

            // configuration
            if ($.isFunction(conf[name])) {
                $(self).bind(name, conf[name]);
            }

            // API
            self[name] = function (fn) {
                if (fn) { $(self).bind(name, fn); }
                return self;
            };
        });


        if (conf.history && $.fn.history) {
            $.tools.history.init(tabs);
            conf.event = 'history';
        }

        // setup click actions for each tab
        tabs.each(function (i) {
            $(this).bind(conf.event, function (e) {
                self.click(i, e);
                e.stopPropagation();
                return e.preventDefault();
            });
        });

        // cross tab anchor link
        panes.find("a[href^=#]").bind("click.T", function (e) {
            self.click($(this).attr("href"), e);
        });

        // open initial tab
        /*if (location.hash && conf.tabs == "a" && root.find("[href=" + location.hash + "]").length) {
        self.click(location.hash);

        } else {*/
        if (conf.initialIndex === 0 || conf.initialIndex > 0) {
            self.click(conf.initialIndex);
        }
        /*}*/

    }


    // jQuery plugin implementation
    $.fn.tabs = function (paneSelector, conf) {

        // return existing instance
        var el = this.data("tabs");
        if (el) {
            el.destroy();
            this.removeData("tabs");
        }

        if ($.isFunction(conf)) {
            conf = { onBeforeClick: conf };
        }

        // setup conf
        conf = $.extend({}, $.tools.tabs.conf, conf);


        this.each(function () {
            el = new Tabs($(this), paneSelector, conf);
            $(this).data("tabs", el);
        });

        return conf.api ? el : this;
    };

})(jQuery); 
/*
* DateInput zhangjingwei V1.0
* Released under the MIT, BSD, and GPL Licenses.
*/
(function ($, undefined) {

    /* TODO: 
    *  剔除键盘功能、选择日期、弹出速度、字符国际化、休息日样式
    *  增加双日历
    */

    $.tools = $.tools || { version: '1.3' };

    var instances = [],
         tool,
         LABELS = {};

    tool = $.tools.dateinput = {

        conf: {
            format: 'yyyy-mm-dd',
            monthRange: [0, 12],
            lang: 'zh-cn',
            offset: [0, 0],
            firstDay: 0, // The first day of the week, Sun = 0, Mon = 1, ...
            min: 0,
            max: undefined,
            trigger: 0,
            toggle: 0,
            editable: 0,
            houseData: null,
            mindate: null,
            editable: true,
            checkin: true,  // The date is checkin or checkout

            css: {
                prefix: 'cal',
                input: 'date',

                // ids
                root: 0,
                head: 0,
                title: 0,
                prev: 0,
                next: 0,
                days: 0,

                body: 0,
                weeks: 0,
                today: 0,
                current: 0,

                // classnames
                week: 0,
                off: "disabled",
                sunday: 0,
                focus: "current",
                disabled: "disabled",
                deleted: "delete",
                trigger: 0
            }
        },

        localize: function (language, labels) {
            $.each(labels, function (key, val) {
                labels[key] = val.split(",");
            });
            LABELS[language] = labels;
        }

    };
    //@配置支持其他语言映射表
    // 多语言支持
    tool.localize("zh-cn", {
        months: '1月,2月,3月,4月,5月,6月,7月,8月,9月,10月,11月,12月',
        shortMonths: '1,2,3,4,5,6,7,8,9,10,11,12',
        days: '星期日,星期一,星期二,星期三,星期四,星期五,星期六',
        shortDays: '日,一,二,三,四,五,六'
    });


    //{{{ private functions


    // @return amount of days in certain month
    function dayAm(year, month) {
        return new Date(year, month + 1, 0).getDate();
    }

    function zeropad(val, len) {
        val = '' + val;
        len = len || 2;
        while (val.length < len) { val = "0" + val; }
        return val;
    }

    // thanks: http://stevenlevithan.com/assets/misc/date.format.js 
    var Re = /d{1,4}|m{1,4}|yy(?:yy)?|"[^"]*"|'[^']*'/g, tmpTag = $("<a/>");

    function format(date, fmt, lang) {
        var d = date.getDate(),
            D = date.getDay(),
            m = date.getMonth(),
            y = date.getFullYear(),

            flags = {
                d: d,
                dd: zeropad(d),
                ddd: LABELS[lang].shortDays[D],
                dddd: LABELS[lang].days[D],
                m: m + 1,
                mm: zeropad(m + 1),
                mmm: LABELS[lang].shortMonths[m],
                mmmm: LABELS[lang].months[m],
                yy: String(y).slice(2),
                yyyy: y
            };

        var ret = fmt.replace(Re, function ($0) {
            return $0 in flags ? flags[$0] : $0.slice(1, $0.length - 1);
        });

        // a small trick to handle special characters
        return tmpTag.html(ret).html();

    }

    function integer(val) {
        return parseInt(val, 10);
    }

    function isSameDay(d1, d2) {
        return d1.getFullYear() === d2.getFullYear() &&
            d1.getMonth() == d2.getMonth() &&
            d1.getDate() == d2.getDate();
    }

    function parseDate(val, date) {
        if (val === undefined) { return; }
        if (val.constructor == Date) { return val; }

        if (typeof val == 'string') {

            // rfc3339?
            var els = val.split("-");
            if (els.length == 3) {
                return new Date(integer(els[0]), integer(els[1]) - 1, integer(els[2]));
            }

            // invalid offset
            if (!(/^-?\d+$/).test(val)) { return; }

            // convert to integer
            val = integer(val);
        }

        date.setDate(date.getDate() + val);
        return date;
    }

    //}}}


    function Dateinput(input, conf) {
        // variables
        var self = this,
             now = parseDate(input.val()) || conf.value || new Date,
			 yearNow = now.getFullYear(),
             monthNow = now.getMonth(),
             css = conf.css,
             labels = LABELS[conf.lang],
             root = $("#" + css.root),
             title = root.find("#" + css.title),
             trigger,
             pm, nm,
             currYear, currMonth, currDay,
             value = input.attr("value") || conf.value || input.val(),
             min = input.attr("min") || conf.min,
             max = input.attr("max") || conf.max,
             opened,
             original,
             scrolltimer;
        // zero min is not undefined     
        if (min === 0) { min = "0"; }
        // use sane values for value, min & max
        value = parseDate(value) || now;
        //min，max使用来设置日历控件的现实范围
        min = parseDate(min || new Date(yearNow + Math.floor((monthNow + conf.monthRange[0]) / 12), monthNow + conf.monthRange[0] % 12, 1), value);
        max = parseDate(max || new Date(yearNow + Math.floor((monthNow + conf.monthRange[1]) / 12), monthNow + conf.monthRange[1] % 12, 0), value);

        // Replace built-in date input: NOTE: input.attr("type", "text") throws exception by the browser
        if (input.attr("type") == 'date') {// 如果是原生的date控件，则替换为text控件
            var original = input.clone(),
	          def = original.wrap("<div/>").parent().html(),
	          clone = $(def.replace(/type/i, "type=text data-orig-type"));

            if (conf.value) clone.val(conf.value);   // jquery 1.6.2 val(undefined) will clear val()

            input.replaceWith(clone);
            input = clone;
        }

        input.addClass(css.input);
        //console.log(self);
        var fire = input.add(self); //将构造函数new对象加入到jquery对象中.

        // construct layout
        /*
        * 将原来一次绘制日历的方式分为两个部分
        * 先绘制外围DOM节点
        * 日历部分构件完成后，插入到外围节点中
        */
        if (!root.length) { //如果是第一次使用控件，则先创建外部html结构

            // root
            root = $('<div><a/><a/><div/></div>')
                .hide().css({ position: 'absolute' }).attr("id", css.root).addClass("calendarBox");

            // elements
            root.children() //给初始化的html结构添加class和id属性
                .eq(0).attr("id", css.prev).addClass("calPrev").end()
                .eq(1).attr("id", css.next).addClass("calNext").end()
                    .eq(2).attr("id", "calcontent");

            $("body").append(root);
        }


        // layout elements
        var weeks = root.find("#" + css.weeks);  //没发现weeks元素???

        //{{{ pick

        function select(date, conf, e) {
            // current value
            value = date;
            currYear = date.getFullYear();
            currMonth = date.getMonth();
            currDay = date.getDate();

            // beforChange
            e = e || $.Event("api");
            e.type = "beforeChange";

            fire.trigger(e, [date]);
            if (e.isDefaultPrevented()) { return; }

            // formatting           
            input.val(format(date, conf.format, conf.lang));

            // change
            e.type = "change";
            fire.trigger(e, [date]);

            // store value into input
            input.data("date", date);

            self.hide(e);
        }


        function selectNoShow(date, conf, e)
        {
            value = date;
            currYear = date.getFullYear();
            currMonth = date.getMonth();
            currDay = date.getDate();
            
            input.data("date", date);
            input.val("");

            self.hide(e);
        }
        //}}}


        //{{{ onShow

        function onShow(ev) {

            ev.type = "onShow";
            fire.trigger(ev);

            // click outside dateinput
            $(document).bind("click.d", function (e) {
                var el = e.target;

                if (!$(el).parents("#" + css.root).length && $(el).attr("id") != css.root && el != input[0] && (!trigger || el != trigger[0])) {
                    self.hide(e);
                }

            });
        }
        //}}}

        // 获取所在月份的日历HTML
        //noOpen 设置为不打开界面
        function getCalHtml(year, month, day, noOpen,noInput) {
            var date = integer(month) >= -2 ? new Date(integer(year), integer(month), integer(day == undefined || isNaN(day) ? 1 : day)) : year || value;//,
            //noOpen = noOpen ? true : false;

            if (date < min) {
                date = min;
            } else if (date > max) {
                date = max;
            }

            if (typeof year == 'string') { date = parseDate(year); }

            year = date.getFullYear(),
            month = date.getMonth(),
            day = date.getDate();

            // roll year & month
            if (month == -1) {
                month = 11;
                year--;
            } else if (month == 12) {
                month = 0;
                year++;
            }
            if (noInput)
            {
                selectNoShow(date, conf);
                return self;
            }
            
            if (!opened || noOpen) {
                select(date, conf);
                return self;
            }/* else {
                // formatting           
                input.val(format(date, conf.format, conf.lang));
                input.data("date", date);
                value = date;
            }*/

            currMonth = month;
            currYear = year;
            currDay = day;

            var targetMonth = currMonth + 1,
            daysInTargetMonth = dayAm(currYear, targetMonth),
            targetDay = daysInTargetMonth,
			targetYear = currYear;

            // roll next year & next month
            if (targetMonth == -1) {
                targetMonth = 11;
                targetYear--;
            } else if (targetMonth == 12) {
                targetMonth = 0;
                targetYear++;
            }

            var dateNext = new Date(targetYear, targetMonth, targetDay);

            var $calendarRoot = $("<div class='calendar'><h2/><table><thead><tr/></thead><tbody></tbody></table></div>"),
                    days = $calendarRoot.children().eq(1).children().eq(0).children();

            // days of the week
            for (var d = 0; d < 7; d++) {
                days.append($("<th/>").text(labels.shortDays[(d + conf.firstDay) % 7]));
            }

            var $calendarNextRoot = $calendarRoot.clone();
            pm.add(nm).removeClass(css.disabled);  //删除向前向后按钮disable状态

            $.each([$calendarRoot, $calendarNextRoot], function (i, $n) {
                var d = i ? dateNext : date,
				   title = $n.children().eq(0),//tbody
				   weeks = $n.children().eq(1).children().eq(1),
				   dd,
                   caldata;

                var year = d.getFullYear(),
                month = d.getMonth(),
                day = d.getDate();

                if (conf.houseData) {
                    if ((year - min.getFullYear()) == 0) {
                        caldata = conf.houseData[month - conf.mindate.getMonth()];
                    } else {
                        caldata = conf.houseData[month + 12 - conf.mindate.getMonth()];
                    }
                }

                // variables
                var tmp = new Date(year, month, 1 - conf.firstDay), begin = tmp.getDay(),
                     days = dayAm(year, month);
                //prevDays = dayAm(year, month - 1);

                title.html(year + "年" + labels.shortMonths[month] + '月');

                // !begin === "sunday"
                //for (var j = !begin ? -7 : 0, a, num; j < (!begin ? 35 : 42); j++) {
                for (var j = 0, a, num; j < 42; j++) {
                    if (j % 7 == 0) {
                        var $curRow = $("<tr/>").appendTo(weeks);
                    }
                    $td = $("<td/>");

                    //  前后
                    //num = prevDays - begin + j + 1;
                    //date = new Date(year, month - 1, num);
                    //num = j - days - begin + 1;
                    //date = new Date(year, month + 1, num);
                    if (j < begin || j >= begin + days) {
                        $td.addClass(css.off);
                        num = "";
                        dd = null;
                    } else {
                        num = j - begin + 1;
                        dd = new Date(year, month, num);

                        // 对选中日期\今日进行样式处理
                        if (isSameDay(value, dd)) {
                            $td.attr("id", css.current).addClass(css.focus);
                        } else if (isSameDay(now, dd)) {
                            $td.attr("id", css.today);
                        }
                    }

                    // 日期正确则压入
                    $td.text(num).data("date", dd);

                    // 对不可选日期作出样式处理
                    if (min && dd < min && dd != null) {
                        $td.add(pm).addClass(css.disabled);
                    }
                    if (max && dd > max) {
                        $td.add(nm).addClass(css.disabled);
                    }

                    // 对房态进行处理
                    if (num && caldata) {
                        if (caldata[num - 1]) {
                            var type = caldata[num - 1][0];
                            if (type == 0) {
                                $td.addClass(css.deleted);
                            } else {
                                if (conf.checkin) {
                                    if (type == 2 || type == 3) {
                                        $td.addClass(css.deleted);
                                    }
                                } else {
                                    if (type == 3 || type == 2) {
                                        $td.addClass(css.deleted);
                                    }
                                }
                            }
                        }
                    }
                    $curRow.append($td);
                }
            });

            return $("<div/>").append($calendarRoot).append($calendarNextRoot);
        }

        //给构造函数new出的对象绑定一些方法
        $.extend(self, {


            /**
            *   @public
            *   展开日历
            */
            show: function (e) {
                if (input.attr("readonly") || input.attr("disabled") || opened) { return; }

                // onBeforeShow
                e = e || $.Event();
                e.type = "onBeforeShow";
                fire.trigger(e);
                if (e.isDefaultPrevented()) { return; }

                $.each(instances, function () {
                    this.hide();
                });

                opened = true;

                // prev / next month
                pm = root.find("#" + css.prev).unbind("click").click(function (e) {
                    if (!pm.hasClass(css.disabled)) {
                        self.addMonth(-2);
                    }
                    return false;
                });

                nm = root.find("#" + css.next).unbind("click").click(function (e) {
                    if (!nm.hasClass(css.disabled)) {
                        self.addMonth();
                    }
                    return false;
                });

                // set date
                self.setValue(value);

                // show calendar
                var pos = input.offset();

                // iPad position fix
                if (/iPad/i.test(navigator.userAgent)) {
                    pos.top -= $(window).scrollTop();
                }

                var bodyWidth = $(document.body).outerWidth(true);
                var posLeft = pos.left + conf.offset[1] + root.outerWidth(true);
                if ((posLeft - bodyWidth) > 0) {
                    posLeft = posLeft - (posLeft - bodyWidth)
                }

                root.css({
                    top: pos.top + input.outerHeight({ margins: true }) + conf.offset[0],
                    left: posLeft - root.outerWidth(true)
                });

                root.show();
                onShow(e);

                $(window).bind("resize.dateinput", function () {
                    var pos = input.offset(),
                     bodyWidth = $(document.body).outerWidth(true),
                     posLeft = pos.left + conf.offset[1] + root.outerWidth(true);

                    if ((posLeft - bodyWidth) > 0) {
                        posLeft = posLeft - (posLeft - bodyWidth)
                    }

                    root.css({
                        top: pos.top + input.outerHeight({ margins: true }) + conf.offset[0],
                        left: posLeft - root.outerWidth(true)
                    });
                }).bind("scroll.dateinput", function () {
                    clearTimeout(scrolltimer);
                    scrolltimer = setTimeout(function () {
                        var pos = input.offset(),
                             bodyWidth = $(document.body).outerWidth(true),
                             posLeft = pos.left + conf.offset[1] + root.outerWidth(true);

                        if ((posLeft - bodyWidth) > 0) {
                            posLeft = posLeft - (posLeft - bodyWidth)
                        }

                        root.css({
                            top: pos.top + input.outerHeight({ margins: true }) + conf.offset[0],
                            left: posLeft - root.outerWidth(true)
                        });
                    }, 10);
                });

                return self;
            },

            /**
            *   @public
            *
            *   设置日历输入框的值
            */
            setValue: function (year, month, day, noOpen,noInput) {
                var calHtml = getCalHtml(year, month, day, noOpen,noInput);
                // date picking
                $("#calcontent").html(calHtml).find("td").unbind("click").bind("click", function (e) {
                    var el = $(this);
                    if (!(el.hasClass(css.disabled) || el.hasClass(css.deleted))) {
                        $("#" + css.current).removeAttr("id");
                        el.attr("id", css.current);
                        select(el.data("date"), conf, e);
                        //console.log(el.data("date"));
                    }
                    return false;
                });

                return self;
            },
            // 设置日历的值，并且不打开日历
            setValueNoOpen: function (year, month, day) {
                var date = integer(month) >= -2 ? new Date(integer(year), integer(month), integer(day == undefined || isNaN(day) ? 1 : day)) : year || value;//,
                //noOpen = noOpen ? true : false;

                if (date < min) {
                    date = min;
                } else if (date > max) {
                    date = max;
                }

                input.val(format(date, conf.format, conf.lang));
                input.data("date", date);
                value = date;

                return self;
            },

            //}}}

            setMin: function (val, fit) {
                min = parseDate(val);
                if (fit && value < min) { self.setValue(min); }
                return self;
            },

            setMax: function (val, fit) {
                max = parseDate(val);
                if (fit && value > max) { self.setValue(max); }
                return self;
            },

            today: function () {
                return self.setValue(now);
            },

            addDay: function (amount) {
                return this.setValue(currYear, currMonth, currDay + (amount || 1));
            },

            addMonth: function (amount) {
                var targetMonth = currMonth + (amount || 2),
                daysInTargetMonth = dayAm(currYear, targetMonth),
                targetDay = currDay <= daysInTargetMonth ? currDay : daysInTargetMonth;

                return this.setValue(currYear, targetMonth, targetDay);
            },

            addYear: function (amount) {
                return this.setValue(currYear + (amount || 2), currMonth, currDay);
            },

            destroy: function () {
                input.add(document).unbind("click.d");
                root.add(trigger).remove();
                input.removeData("dateinput").removeClass(css.input);
                if (original) { input.replaceWith(original); }
            },

            hide: function (e) {

                if (opened) {

                    // onHide 
                    e = $.Event();
                    e.type = "onHide";
                    fire.trigger(e);

                    // cancelled ?
                    if (e.isDefaultPrevented()) { return; }

                    $(document).unbind("click.d").unbind("keydown.d");

                    // do the hide
                    root.hide();
                    opened = false;

                    $(window).unbind("resize.dateinput").unbind("scroll.dateinput");
                }

                return self;
            },

            getConf: function () {
                return conf;
            },

            getInput: function () {
                return input;
            },

            getCalendar: function () {
                return root;
            },

            getValue: function (dateFormat) {
                return dateFormat ? format(value, dateFormat, conf.lang) : value;
            },

            isOpen: function () {
                return opened;
            }

        });

        // callbacks    //这里用于给self绑定事件,在each方法中可以存储遍历的值
        $.each(['onBeforeShow', 'onShow', 'change', 'onHide', 'onEmpty'], function (i, name) {

            // configuration
            if ($.isFunction(conf[name])) {
                $(self).bind(name, conf[name]);
            }

            // API methods              
            self[name] = function (fn) {
                if (fn) { $(self).bind(name, fn); }
                return self;
            };
        });

        // show dateinput & assign keyboard shortcuts
        input.bind("focus.d click.d", self.show).keydown(function (e) {

            var key = e.keyCode;

            // open dateinput with navigation keyw
            if (!opened && $(KEYS).index(key) >= 0) {
                self.show(e);
                return e.preventDefault();
            }

            if (conf.editable) {
                if (opened && (key == 8 || key == 46)) {
                    input.val("");
                    e = e || $.Event();
                    e.type = "onEmpty";
                    fire.trigger(e);
                    if (e.isDefaultPrevented()) { return; }
                }
            }

            if (key == 9) {
                self.hide();
            }

            // allow tab
            return key == 9 ? true : e.preventDefault();

        });

        input.attr({
            "autocomplete": "off",
            "spellcheck": "false",
            "dir": "ltr"//,
            //"draggable": "false"
        })

        // initial value        
        if (parseDate(input.val())) {
            select(value, conf);
        }

    }
    //@自定义一个:date选择器，用于选择日历控件元素
    $.expr[':'].date = function (el) {
        var type = el.getAttribute("type");
        return type && type == 'date' || !!$(el).data("dateinput");
    };


    $.fn.dateinput = function (conf) {

        // already instantiated
        if (this.data("dateinput")) { return this; }

        // configuration
        conf = $.extend(true, {}, tool.conf, conf);

        // CSS prefix @修改日历控件中的类名
        $.each(conf.css, function (key, val) {
            if (!val && key != 'prefix') {
                conf.css[key] = (conf.css.prefix || '') + (val || key);
            }
        });

        var els;

        this.each(function () {
            var el = new Dateinput($(this), conf);
            instances.push(el);
            var input = el.getInput().data("dateinput", el);
            els = els ? els.add(input) : input;
        });

        return els ? els : this;
    };


})(jQuery);
/*
 * Select zhangjingwei V1.3
 * Released under the MIT, BSD, and GPL Licenses.
 */
(function ($) {

    $.tools = $.tools || {
        version: '1.3'
    };

    var instances = [],
        // down=40, left=37, up=38, right=39
        KEYS = [38, 39, 40, 37],
tool = $.tools.selectinput = {
    conf: {
        offset: [0, 0], // 弹出菜单偏移量
        trigger: false, // 默认触发
        pinyin: false,  // 是否需要拼音
        autowidth: false, // 是否需要自动定义宽度
        reload: false, //是否每次都重新加载
        doChange:true, //是否执行trigger的change事件,
		onChanging: function(merchantID) { return true;},
        css: {
            // ids
            root: 0,
            head: 0,

            // classnames
            rootclass: 0,
            headclass: 0,
            list: 0,
            off: 0,     // 鼠标移动上的样式
            focus: 0,   // 获取焦点样式
            disabled: 0, // 禁止选择样式
            trigger: 0, // 触发后的样式
            current: 0, // 节点被选中的样式
            mouseon: 0  // 鼠标移动触发样式
        }
    }
}

    function Selects(select, conf, i) {
        var self = this,
        css = conf.css,
        hid = css.head || "selhead_jQuery" + i,
        rid = css.root || "selroot_jQuery" + i,
        root = $("#" + rid),
        head = $("#" + hid),
		selLength = select.find("option").length - 1,
        currentClass = css.current,
        opened,
        selstyle = select.offset(),
        fire = select.add(self);

        var listArray, listArrayIndex, listArrayLength, $rootlis, rootTime;

        // 容灾处理
        if (!root.length && !head.length) {
            var body = $("body"),
				index = getSelectIndex(),
				title = getSelectText();

            root = $('<ul/>').css({ "position": "absolute", "z-index": 100000000, "height": "auto" }).addClass(css.rootclass).attr("id", rid).hide();

            select.find("option").each(function (i, n) {
                /*  var val = n.value, text = n.text, py = (n.getAttribute("name") || n.name) || "";*/
                var val = $(this).attr("value"), text = $(this).text(), py = $(this).attr("name") || "";
                root.append("<li data-value='" + val + "' data-index='" + i + "' data-name='" + py + "' data-text='" + text + "'><strong>" + text + "</strong><!--<span>" + py + "</span>--></li>");
            });

            root.find("li").eq(index).addClass(currentClass);

            head = $("<span/>").html(title).addClass(css.headclass).attr({
                "id": hid,
                "tabIndex": 0
            }).click(function (e) {
                if (!opened) {
                    self.show();
                } else {
                    self.hide();
                }
                return e.preventDefault();
            });
            select.after(head).css({
                "display": "none"
            });

            body.append(root);
        }

        if (conf.trigger) {
            self.show();
        }

        function onShow(ev) {
            $(document).bind("keydown.sel", function (e) {
                if (e.ctrlKey) { return true; }
                var key = e.keyCode;

                clearTimeout(rootTime);

                rootTime = setTimeout(function () {
                    self.reset();

                    // esc or tab key exits
                    if (key == 27 || key == 9) {
                        self.setValue($rootlis.filter("[data-index='" + listArray[listArrayIndex] + "']"), e);
                        return self.hide(e);
                    }

                    if ($(KEYS).index(key) >= 0) {
                        if (!opened) {
                            self.show(e);
                            return e.preventDefault();
                        }

                        if (key == 40 || key == 39) {
                            listArrayIndex = ++listArrayIndex < listArrayLength ? listArrayIndex : 0;
                        } else if (key == 38 || key == 37) {
                            listArrayIndex = --listArrayIndex >= 0 ? listArrayIndex : listArrayLength - 1;
                        }

                        self.setValue($rootlis.filter("[data-index='" + listArray[listArrayIndex] + "']"), e);
                        return e.preventDefault();
                    }

                    // enter
                    if (key == 13) {
                        self.setValue($rootlis.filter("[data-index='" + listArray[listArrayIndex] + "']"), e);
                        self.hide(e);
                        return false;
                    }
                }, 50);

                if ($(KEYS).index(key) >= 0) {
                    return e.preventDefault();
                }
            });

            // resize window
            $(window).bind("resize.sel", function () {

                var headCssNow = getPosition(head);
                if (conf.IsNotSelectState) {
                    root.css({
                        top: headCssNow.bottom,
                        left: headCssNow.left
                    });
                } else {
                    root.css({
                        top: headCssNow.bottom,
                        left: head.offset().left
                    });
                }
            });

            // click outside select
            $(document).bind("click.sel", function (e) {
                var el = e.target;

                if (el != head[0]) {
                    self.hide(e);
                }
            });

            ev.type = "onShow";
            fire.trigger(ev);
        }

        // 选择函数
        function selected(currentElem, e) {
            var currentText = currentElem.attr("data-text");

            root.find("li").removeClass(css.current);
            currentElem.addClass(css.current);
            head.html(currentText);
            setSelected(currentElem.attr("data-index"));

            // change
            e = e || $.Event("api");
            e.type = "change";

            if (conf != undefined && conf.doChange) {
                fire.trigger(e, currentElem)
            }

            // fix bug on validation, when choose a valuse, jqvalidate will validate after click event
            //fire.trigger("click");

            if (e.isDefaultPrevented()) {
                return;
            }
        }

        /*
        * 设置selectindex
        */
        function setSelected(index) {
            select[0].selectedIndex = index;
            $(select[0]).trigger('change');
        }

        /*
        * 获取选中项值
        */
        function getSelectVal() {
            return select.find("option:selected").val();
        }

        /*
        * 获取选中项文本
        */
        function getSelectText() {
            return select.find("option:selected").text();
        }

        /*
        * 获取selectindex
        */
        function getSelectIndex() {
            return select[0].selectedIndex;
        }

        /*
        * 获取节点位置
        */
        function getPosition(elem) {
            var bodyWidth = $(document.body).outerWidth(true);
            var offset = elem.offset(), elemW = elem.innerWidth(), elemH = elem.innerHeight();
            var posLeft = offset.left + conf.offset[1] + root.outerWidth(true);
            if ((posLeft - bodyWidth) > 0) {
                posLeft = posLeft - (posLeft - bodyWidth)
            }       
            return {
                left: posLeft - root.outerWidth(true),
                top: elem.offset().top,
                right: offset.left + elemW,
                bottom: offset.top + elemH + conf.offset[0]
            }
        }

        $.extend(self, {
            show: function (e) {
                if (select.attr("disabled") || opened) {
                    return;
                }
                // onBeforeShow
                e = e || $.Event();
                e.type = "onBeforeShow";
                fire.trigger(e);
                if (e.isDefaultPrevented()) {
                    return;
                }

                // 关闭所有已打开select
                $.each(instances, function () {
                    this.hide();
                });
                opened = true;

                root.undelegate("li", "click mouseenter mouseleave").delegate("li", "click", function (e) {
					var sIndex = parseInt($(this).attr("data-index"), 10);
					var r = conf.onChanging(parseInt(select.find("option").eq(sIndex).val(), 10));
					if(r) {
						self.setValue($(this), e);
					}
					self.hide(e);
                    return false;
                }).delegate("li", "mouseenter", function () {
                    $(this).addClass(css.mouseon);
                }).delegate("li", "mouseleave", function () {
                    $(this).removeClass(css.mouseon);
                });

                // show select
                var pos = select.offset();

                // iPad position fix
                if (/iPad/i.test(navigator.userAgent)) {
                    pos.top -= $(window).scrollTop();
                }

                if (conf.offset) {
                    root.css({
                        top: pos.top + conf.offset[0],
                        left: pos.left + conf.offset[1]
                    });
                }
                var headCssNow = getPosition(head);
                root.css({
                    top: headCssNow.bottom,
                    left: headCssNow.left,
                    width: conf.autowidth ? head.innerWidth() : false
                });

                root.show();
                onShow(e);

                return self;
            },
            hide: function (e) {
                if (opened) {
                    // onHide
                    e = $.Event();
                    e.type = "onHide";
                    fire.trigger(e);

                    $(document).unbind("click.sel").unbind("keydown.sel");
                    $(window).unbind("resize.sel");

                    // cancelled ?
                    if (e.isDefaultPrevented()) {
                        return;
                    }

                    // do the hide
                    root.hide();
                    root.find("li").unbind("click");
                    opened = false;
                }

                return self;
            },
            getData: function () {
                var $options = select.find("option"), data = {}, optionname;
                $options.each(function (i, n) {
                    optionname = $(this).attr("name");
                    /*optionname = n.getAttribute("name") || n.name;*/
                    if (optionname) {
                        data[$(this).attr("value")] = optionname + "|||" + $(this).text() + "|||" + i;
                      /*  data[n.value] = optionname + "|||" + (n.firstChild.nodeValue || n.innerText) + "|||" + i;*/
                    }
                });
                return data;
            },

            repaint: function () {
                $('li', root).each(function () {
                    $(this).remove();
                });
                var index = getSelectIndex();
                // alert(index);
                select.find("option").each(function (i, n) {
                   /* var val = n.value, text = n.firstChild.nodeValue || n.innerText, py = (n.getAttribute("name") || n.name) || "";*/
                    var val = $(this).attr("value"), text = $(this).text(), py = $(this).attr("name") || "";
                    root.append("<li data-value='" + val + "' data-index='" + i + "' data-name='" + py + "' data-text='" + text + "'><strong>" + text + "</strong><!--<span>" + py + "</span>--></li>");
                });
                root.find("li").eq(index).addClass(currentClass);

                $head = head;


                $head.text(select.find("option:selected").text());
                head.find("input").remove();
            },

            reset: function () {  // select 改变时重置菜单
                var index = getSelectIndex();   // 原生select中被选中项的索引;

                $rootlis = root.find("li");
                listArray = [];

                $rootlis.each(function () {
                    listArray.push($(this).attr("data-index"));    // 将当先的option对应的索引压入一个数组
                });

                listArrayLength = listArray.length;

                // 计算原生select的索引值在模拟select中索引数组的位置
                $.each(listArray, function (i, n) {
                    if (index == n) {
                        listArrayIndex = i;
                        return false;
                    }
                });

                return self;
            },
            setValue: function (elem, evt,strongFresh) { // lxq 添加参数，强制触发selected 
                evt = evt || $.Event("api");
				
				//判断当前要切换的index是不是没有变化，如果没有变化则不触发selected
				if(strongFresh == true || getSelectIndex().toString(10) != elem.attr("data-index")) {
					selected(elem, evt);
				}
				
                return self;
            },
            getValue: function () {
                return getSelectVal();
            },
            setIndex: function (index) {
                setSelected(index);
                return self;
            },
            setHeadText: function (text) {
                head.html(text);
                return self;
            },
            getConf: function () {
                return conf;
            },
            getRoot: function () {
                return root;
            },
            getHead: function () {
                return head;
            },
            getSelect: function () {
                return select;
            },
            getIndex: function () {
                return getSelectIndex();
            },
            isOpen: function () {
                return opened;
            }
        });

        // callbacks
        $.each(['onBeforeShow', 'onShow', 'change', 'onHide'], function (i, name) {

            // configuration
            if ($.isFunction(conf[name])) {
                $(self).bind(name, conf[name]);
            }

            // API methods
            self[name] = function (fn) {
                if (fn) {
                    $(self).bind(name, fn);
                }
                return self;
            };
        });
    }

    $.fn.selectinput = function (conf) {
        // 单例
        if (this.data("selectinput") && conf != undefined && !conf.reload) {
            return this;
        }
        if (conf != undefined && conf.reload) {
            $("#" + conf.css.root).remove();
            $("#" + conf.css.head).remove();
        }

        conf = $.extend(true, {}, tool.conf, conf);

        var els;
        this.each(function (key) {
            var el = new Selects($(this), conf, $.now() + Math.random());
            instances.push(el);
            var sel = el.getSelect().data("selectinput", el);
            els = els ? els.add(sel) : sel;
        });
        return els ? els : this;
    };
})(jQuery);
/*
 * Select Enter zhangjingwei
 * Released under the MIT, BSD, and GPL Licenses.
 * Version: 2.1
 */
(function ($) {
    var t = $.tools.selectinput,
	    checkTime,
        normalShowForce,
        inputNochange,
		checkVal;


    // 默认展示数据
    function areaNormalShow(api) {
        var data = api.getSelect().find("option"),
		root = api.getRoot();
        root.empty().removeClass("select-list");
        root.append('<div class="address_hotcity"><strong>请选择您要入住的城市</strong></div>');
        $.each(data, function (i, n) {
            /*  var val = n.value, text = n.firstChild.nodeValue || n.innerText, py = (n.getAttribute("name") || n.name) || "";*/
            var val = $(this).attr("value"), text = $(this).text(), py = $(this).attr("name") || "";
            root.append("<li data-value='" + val + "' data-index='" + i + "' data-name='" + py + "' data-text='" + text + "'><strong>" + text + "</strong><span>" + py + "</span></li>");
        });
        root.find("li").eq(0).addClass(api.getConf().css.current);
        api.setIndex(root.find("li").eq(0).attr("data-index"));
    }

    // 初始化原始内容
    function initCheckVal($ipt) {
        checkVal = $ipt.val();
        inputNochange = true;
    }

    // 比对输入内容是否改变
    function checkIpt($ipt) {
        var iptVal = $ipt.val(),
		    result = checkVal != iptVal;
        if (normalShowForce && inputNochange) {
            return -1;
        }
        if (result && iptVal == "") {
            checkVal = iptVal;
            result = -1; // 有变化，输入值为空值
        } else if (result) {
            checkVal = iptVal;
            result = 0; // 有变化，输入值不为空
        } else if (!result && checkVal == "") {
            result = 1; // 无变化，默认值为空
        } else {
            result = 2; // 无变化
        }

        return result;
    }

    // 开启文字输入检查
    function openCheckIpt(ipt, api, fn) {
        var $ipt = $(ipt), root = api.getRoot(), conf = api.getConf();
        checkTime = setTimeout(function () {
            var checkResult = checkIpt($ipt);   // 检查输入内容
            if (checkResult == 0) { // 如果检索到输入内容展示检索内容
                // added by liuyu 20131030
                api.getConf().IsNotSelectState = false;
                root.css('left', api.getSelect().parent().offset().left);
                fn.call(this);
            } else if (checkResult == -1) { // 如果没有检索到输入内容则展示默认数据
                // added by liuyu 20131030
                api.getConf().IsNotSelectState = false;
                root.css('left', api.getSelect().parent().offset().left);
                normalShow(api);
            }
            checkResult = undefined;
            openCheckIpt.call(this, ipt, api, fn);
        }, 80);
    }

    // 关闭文字输入检查
    function closeCheckIpt() {
        clearTimeout(checkTime)
    }


    // 获取进入输入框的文字
    function getIptVal($ipt) {
        return $ipt.val();
    }

    // 写入输入框的文字
    function setIptVal($elem, $ipt, innerText) {
        $elem.text(innerText);
        $ipt.remove();
    }

    // 检索输入属于是否在属于源内
    function checkValInData(data, val) {
        var searchResult = [];
        if (val) {
            // 为了允许屏东(垦丁)这类带括号地区能够正确匹配，需要替换掉值内的括号
            var reg = new RegExp("(?=.*" + val.toLowerCase().replace(/\(/g, "\\\(").replace(/\)/g, "\\\)") + ").+");
            $.each(data, function (i, n) {
                if (reg.test(n)) {
                    searchResult.push(i + "|||" + n);
                }
            });
        } else {
            searchResult = null;
        }

        return searchResult;
    }

    // 默认展示数据
    function normalShow(api) {
        var flag = inputNochange;
        inputNochange = false;
        var data = api.getSelect().find("option"),
		root = api.getRoot();
        root.empty().removeClass("select-list");
        root.append('<div class="address_hotcity"><strong>请选择您要入住的城市</strong></div>');
        $.each(data, function (i, n) {
            /* var val = n.value, text = n.firstChild.nodeValue || n.innerText, py = (n.getAttribute("name") || n.name) || "";*/
            var val = $(this).attr("value"), text = $(this).text(), py = $(this).attr("name") || "";
            root.append("<li data-value='" + val + "' data-index='" + i + "' data-name='" + py + "' data-text='" + text + "'><strong>" + text + "</strong><span>" + py + "</span></li>");
        });
        if (normalShowForce && flag) {
            var lis = root.find("li").filter(function () { return $(this).data("text") == checkVal })
            if (lis.length > 0) {
                lis.eq(0).addClass(api.getConf().css.current);
                api.setIndex(lis.eq(0).attr("data-index"));
                return;
            }
        }
        root.find("li").eq(0).addClass(api.getConf().css.current);
        api.setIndex(root.find("li").eq(0).attr("data-index"));
    }

    // 初始化展示数据
    function initShow(api) {
        var data = api.getSelect().find("option[data-show]"),
        index = api.getIndex(),
        root = api.getRoot(),
        info;

        try {
            info = cityInfo;
        } catch (e) {
            //   console.log("城市信息不存在，请检查");
            return false;
        }

        root.empty().append('<div><div class="address_tabs"></div><div class="address_content"></div></div>');
        // get cityinfo and group by tabs

        var rootDiv = root.find("div"), $tabElem = rootDiv.eq(1), $tabInfoElem = rootDiv.eq(2);

        if (api.getSelect().attr("fewItems") == "true") {//只有很少的城市的，则区域不用分组了。全部显示即可
            $tabElem.hide();
            data.each(function (i) {
                var $span = $("<span/>").text($(this).text()).attr("data-value", $(this).val());
                $span.unbind().bind("click", function () {
                    api.setHeadText($(this).text()).setIndex(i);
                });
                $tabInfoElem.append($span);
            });
        }
        else {

            // add tab of hot group
            $tabElem.append($("<span/>").text(info.hotgroup.name).attr("data-cityids", info.hotgroup.cityids).addClass("current"));

            // add tab of lettergroups
            $.each(info.lettergroups, function (i, n) {
                var $span = $("<span/>").text(n.name).attr("data-cityids", n.cityids);
                $tabElem.append($span);
            });

            var $tabElemSpan = $tabElem.find("span");
            $tabElemSpan.unbind().bind("click", function () {
                drawContent($(this).attr("data-cityids"), info.citys, $tabInfoElem, api);
                $tabElemSpan.removeClass("current");
                $(this).addClass("current");
                return false;
            })

            drawContent(info.hotgroup.cityids, info.citys, $tabInfoElem, api);
        }
        // added by liuyu 20131030
        api.getConf().IsNotSelectState = true;
    }

    //新页面地址输入，初始化显示
    function initShowHouse(api) {
        var data = api.getSelect().find("option"),
        index = api.getIndex(),
        root = api.getRoot(),
        info;

        try {
            info = cityInfo_tehui;
        } catch (e) {
            //   console.log("城市信息不存在，请检查");
            return false;
        }

        root.empty().append('<div><div class="address_tabs"></div><div class="address_content"></div></div>');
        // get cityinfo and group by tabs

        var rootDiv = root.find("div"), $tabElem = rootDiv.eq(1), $tabInfoElem = rootDiv.eq(2);

        if (api.getSelect().attr("fewItems") == "true") {//只有很少的城市的，则区域不用分组了。全部显示即可
            $tabElem.hide();
            data.each(function (i) {
                var $span = $("<span/>").text($(this).text()).attr("data-value", $(this).val()).attr("data-housenum", $(this).attr("data-housenum"));
                $span.unbind().bind("click", function () {
                    // api.setHeadText($(this).text() + "(" + $(this).attr("data-housenum") + ")").setIndex(i);
                    api.setHeadText($(this).text()).setIndex(i);
                });
                $tabInfoElem.append($span);
            });
        }
        else {

            // add tab of hot group
            $tabElem.append($("<span/>").text(info.hotgroup.name).attr("data-cityids", info.hotgroup.cityids).addClass("current"));

            // add tab of lettergroups
            $.each(info.lettergroups, function (i, n) {
                var $span = $("<span/>").text(n.name).attr("data-cityids", n.cityids);
                $tabElem.append($span);
            });

            var $tabElemSpan = $tabElem.find("span");
            $tabElemSpan.unbind().bind("click", function () {
                drawContentHouse($(this).attr("data-cityids"), info.citys, $tabInfoElem, api);
                $tabElemSpan.removeClass("current");
                $(this).addClass("current");
                return false;
            })

            drawContentHouse(info.hotgroup.cityids, info.citys, $tabInfoElem, api);
        }
        // added by liuyu 20131030
        api.getConf().IsNotSelectState = true;

    }

    // 获取关键词数据
    function getKeyData() {
        var data = {};
        if (typeof cityInfo != "undefined" && cityInfo.citys) {
            $.each(cityInfo.citys, function (i, n) {
                data[i] = n.pinyin + "|||" + n.name + "|||" + n.keyword.join("|||") + "|||" + i; // 注意这里有顺序：拼音，汉字，关键词
            });
        } else {
            data = undefined;
        }

        return data;
    }
    function getKeyDataC(obj) {
        var data = {}, citys = obj.citys;

        if (citys) {
            $.each(citys, function (i, n) {
                data[i] = n.pinyin + "|||" + n.name + "|||" + n.provinceid + "|||" + n.id + "|||" + n.keyword.join("|||") + "|||" + i; // 注意这里有顺序：拼音，汉字，关键词
            });
        } else {
            data = undefined;
        }

        return data;
    }

    function getWorldKeyData(cityInfo) {
        var data = {}, citys = cityInfo.citys;

        if (citys) {
            $.each(citys, function (i, n) {
                data[i] = n.pinyin + "|||" + n.name + "|||" + n.keyword.join("|||") + "|||" + i; // 注意这里有顺序：拼音，汉字，关键词
            });
        } else {
            data = undefined;
        }

        return data;
    }

    // draw tab content
    function drawContent(ids, citys, elem, api) {
        var cityids = typeof ids == "string" ? ids.split(",") : ids;

        elem.empty();
        $.map(cityids, function (i) {
            $.map(cityInfo.citys, function (n) {
                if (n.id == i) {
                    elem.append($("<span/>").text(n.name).attr("data-value", i));
                }
            })
        });

        // bind chose city event
        elem.find("span").unbind().bind("click", function () {
            var self = $(this), v = self.attr("data-value");
            $.each(cityInfo.citys, function (i, n) {
                if (n.id == v) {
                    api.setHeadText(self.text()).setIndex(i);
                }
            })
        });
    }

    //新页面地址输入需求
    function drawContentHouse(ids, citys, elem, api) {
        var cityids = typeof ids == "string" ? ids.split(",") : ids;

        elem.empty();
        $.map(cityids, function (i) {
            $.map(cityInfo_tehui.citys, function (n) {
                if (n.id == i) {
                    elem.append($("<span/>").text(n.name).attr({ "data-value": i, "data-url": n.url }));
                }
            })
        });

        // bind chose city event
        elem.find("span").unbind().bind("click", function () {
            var self = $(this), v = self.attr("data-value");
            $.each(cityInfo.citys, function (i, n) {
                if (n.id == v) {
                    api.setHeadText(self.text()).setIndex(i);
                }
            });
            window.location.href = self.attr("data-url");
        });
    }


    // jQuery plugin implementation
    $.fn.selEnter = function (conf) {
        var api = $(this).data("selectinput");  // 获取selectApi
        var $head = api.getHead(),  // 获取模拟select的 Head DOM  
        backHtml,
        $headIpt = $("<input/>").attr("type", "text");

        // configuration
        conf = api.getConf();

        api.onBeforeShow(function () {
            $head.html($headIpt.attr("value", $head.text()));
            $headIpt.css({
                width: $head.width()
            }).addClass("selectInput")[0].select();
            initShow(api);
            api.getRoot().addClass("select-list").show();
        });


        api.onShow(function () {
            initCheckVal($headIpt);
            openCheckIpt($headIpt[0], api, function () {
                var iptval = getIptVal($headIpt);
                var data = getKeyData(), data = !!data ? data : api.getData();
                if (api.getSelect().attr("fewItems") == "true") //只有很少的城市的，则直接在select的数据里面检索
                {
                    data = api.getData();
                }
                var searchResult = checkValInData(data, iptval);
                if (searchResult != null && searchResult.length > 0) {
                    var root = api.getRoot();
                    root.empty().removeClass("select-list");
                    root.append('<div class="address_hotcity"><strong>请选择您要入住的城市</strong></div>');
                    $.map(searchResult, function (n) {
                        n = n.split("|||");
                        //root.append("<li data-value='" + n[0] + "' data-index='" + n[4] + "' data-name='" + n[1] + "' data-text=" + n[2] + "><strong>" + n[2] + "</strong><span>" + n[1] + "</span></li>");
                        root.append("<li data-value='" + n[0] + "' data-index='" + n[n.length - 1] + "' data-name='" + n[1] + "' data-text=" + n[2] + "><strong>" + n[2] + "</strong><span>" + n[1] + "</span></li>");
                    });
                    root.find("li").eq(0).addClass(conf.css.current);
                    api.setIndex(root.find("li").eq(0).attr("data-index"));
                } else {
                    var root = api.getRoot();
                    root.empty().removeClass("select-list");
                    root.append('<div class="address_hotcity"><strong>对不起，没有找到 ' + iptval + '</strong></div>');
                }
            })
        });

        api.change(function (e, elem) {
            var innerText = $(elem).attr("data-text");
            setIptVal($head, $headIpt, innerText);
        });

        api.onHide(function () {
            var selectIpt = api.getHead().find("input"),
			    $head = api.getHead(),
				$current = api.getRoot().find("li." + conf.css.current);

            closeCheckIpt();

            if ($current.length) {
                api.setValue($current);
            } else {
                var checkResult = checkIpt(selectIpt);
                if (checkResult == 1) {
                    setIptVal($head, selectIpt, "中文/拼音");
                } else if (checkResult == 2) {
                    if (checkValInData(api.getData(), selectIpt.val()).length) {
                        setIptVal($head, selectIpt, selectIpt.val());
                    } else {
                        setIptVal($head, selectIpt, "中文/拼音");
                    }
                }
            }
        });

        return api;
    };

    // 新页面地址支持房屋数量需求情况插件
    $.fn.selHouseEnter = function (conf) {
        var api = $(this).data("selectinput");  // 获取selectApi
        var $head = api.getHead(),  // 获取模拟select的 Head DOM  
        backHtml,
      //  $headIpt = $("<input/>").attr("type", "text");
        // configuration
        conf = api.getConf();

        api.onBeforeShow(function () {
            //   $head.html($headIpt.attr("value", $head.text()));
            //$headIpt.css({
            //    width: $head.width()
            //}).addClass("selectInput")[0].select();
            initShowHouse(api);
            api.getRoot().addClass("select-list").show();
        });

        var $curSel = api.getSelect().find("[sel]");

        if ($curSel.length > 0) {
            // api.setHeadText($curSel.text() + "(" + $curSel.attr("data-housenum") + ")");
            api.setHeadText($curSel.text());
            $head.addClass("title-cur");
        } else {
            api.setHeadText("更多城市");
            $head.removeClass("title-cur");
        }

        api.onShow(function () {
            // initCheckVal($headIpt);
            /*    openCheckIpt($headIpt[0], api, function () {
                    var iptval = getIptVal($headIpt);
                    var data = getKeyData(), data = !!data ? data : api.getData();
                    if (api.getSelect().attr("fewItems") == "true") //只有很少的城市的，则直接在select的数据里面检索
                    {
                        data = api.getData();
                    }
                    var searchResult = checkValInData(data, iptval);
                    if (searchResult != null && searchResult.length > 0) {
                        var root = api.getRoot();
                        root.empty().removeClass("select-list");
                        root.append('<div class="address_hotcity"><strong>请选择您要入住的城市</strong></div>');
                        $.map(searchResult, function (n) {
                            n = n.split("|||");
                            //root.append("<li data-value='" + n[0] + "' data-index='" + n[4] + "' data-name='" + n[1] + "' data-text=" + n[2] + "><strong>" + n[2] + "</strong><span>" + n[1] + "</span></li>");
                            root.append("<li data-value='" + n[0] + "' data-index='" + n[n.length - 1] + "' data-name='" + n[1] + "' data-text=" + n[2] + "><strong>" + n[2] + "</strong><span>" + n[1] + "</span></li>");
                        });
                        root.find("li").eq(0).addClass(conf.css.current);
                        api.setIndex(root.find("li").eq(0).attr("data-index"));
                    } else {
                        var root = api.getRoot();
                        root.empty().removeClass("select-list");
                        root.append('<div class="address_hotcity"><strong>对不起，没有找到 ' + iptval + '</strong></div>');
                    }
                })*/
        });

        api.change(function (e, elem) {
            var innerText = $(elem).attr("data-text");
            //        setIptVal($head, $headIpt, innerText);
        });

        api.onHide(function () {
            var selectIpt = api.getHead().find("input"),
			    $head = api.getHead(),
				$current = api.getSelect().find("[selected]");

            closeCheckIpt();

            if ($current.length) {
                // api.setHeadText($current.text() + "(" + $current.attr("data-housenum") + ")");
                api.setHeadText($current.text());
                // api.setValue($current);
            } else {
                /* var checkResult = checkIpt(selectIpt);
                 if (checkResult == 1) {
                     setIptVal($head, selectIpt, "更多城市");
                 } else if (checkResult == 2) {
                     if (checkValInData(api.getData(), selectIpt.val()).length) {
                         setIptVal($head, selectIpt, selectIpt.val());
                     } else {
                         setIptVal($head, selectIpt, "更多城市");
                     }
                 }*/
            }
        });

        return api;
    };
    // 默认展示数据
    function LandlordEnternormalShow(api) {
        var data = api.getSelect().find("option"),
		root = api.getRoot();
        root.empty().removeClass("select-list");
        root.append('<div class="address_hotcity"><strong>请选择您要入住的城市</strong></div>');
        $.each(data, function (i, n) {
            /*var val = n.value, text = n.firstChild.nodeValue || n.innerText, py = (n.getAttribute("name") || n.name) || "", province = (n.getAttribute("data-province"));*/
            var val = $(this).attr("value"), text = $(this).text(), py = $(this).attr("name") || "", province = $(this).attr("data-province");
            root.append("<li data-value='" + val + "' data-index='" + i + "' data-name='" + py + "' data-text='" + text + "' data-province='" + province + "'><strong>" + text + "</strong><span>" + py + "</span></li>");
        });
        root.find("li").eq(0).addClass(api.getConf().css.current);
        api.setIndex(root.find("li").eq(0).attr("data-index"));
    }
    $.fn.selLandlordEnter = function (conf) {
        var api = $(this).data("selectinput");  // 获取selectApi
        var $apiid = $(this).attr("id");
        var $head = api.getHead(),  // 获取模拟select的 Head DOM  
        backHtml,
        $headIpt = $("<input/>").attr("type", "text");

        // configuration
        conf = api.getConf();
        normalShowForce = conf.normalShowForce ? true : false;

        api.onBeforeShow(function () {
            $head.html($headIpt.attr("value", $head.text()));
            $headIpt.css({
                width: $head.width()
            }).addClass("selectInput")[0].select();
            //  initShow(api);
            //  api.getRoot().addClass("select-list").show();
            // LandlordEnternormalShow(api);
            // setIptVal($head, $headIpt, "支持自动匹配");



            var iptval = getIptVal($headIpt);
            var data = getKeyDataC(cityInfoc), data = !!data ? data : api.getData();

            var searchResult = checkValInData(data, iptval);
            if (searchResult != null && searchResult.length > 0) {
                var root = api.getRoot();
                root.empty().removeClass("select-list");
                root.append('<div class="address_hotcity"><strong>请选择您要入住的城市</strong></div>');
                $.map(searchResult, function (n) {
                    n = n.split("|||");
                    //root.append("<li data-value='" + n[0] + "' data-index='" + n[4] + "' data-name='" + n[1] + "' data-text=" + n[2] + "><strong>" + n[2] + "</strong><span>" + n[1] + "</span></li>");
                    root.append("<li data-value='" + n[4] + "' data-index='" + n[n.length - 1] + "' data-name='" + n[1] + "' data-province='" + n[3] + "' data-text=" + n[2] + "><strong>" + n[2] + "</strong><span>" + n[1] + "</span></li>");
                });
                root.find("li").eq(0).addClass(conf.css.current);
                //api.setIndex(root.find("li").eq(0).attr("data-index"));
            } else {
                LandlordEnternormalShow(api);
            }


        });
        setIptVal($head, api.getHead().find("input"), api.getSelect().find("option[selected=selected]").text());

        api.onShow(function () {
            initCheckVal($headIpt);
            openCheckIpt($headIpt[0], api, function () {
                var iptval = getIptVal($headIpt);
                var data = getKeyDataC(cityInfoc), data = !!data ? data : api.getData();

                var searchResult = checkValInData(data, iptval);
                if (searchResult != null && searchResult.length > 0) {
                    var root = api.getRoot();
                    root.empty().removeClass("select-list");
                    root.append('<div class="address_hotcity"><strong>请选择您要入住的城市</strong></div>');
                    $.map(searchResult, function (n) {
                        n = n.split("|||");
                        //root.append("<li data-value='" + n[0] + "' data-index='" + n[4] + "' data-name='" + n[1] + "' data-text=" + n[2] + "><strong>" + n[2] + "</strong><span>" + n[1] + "</span></li>");
                        root.append("<li data-value='" + n[4] + "' data-index='" + n[n.length - 1] + "' data-name='" + n[1] + "' data-province='" + n[3] + "' data-text=" + n[2] + "><strong>" + n[2] + "</strong><span>" + n[1] + "</span></li>");
                    });
                    root.find("li").eq(0).addClass(conf.css.current);
                    api.setIndex(root.find("li").eq(0).attr("data-index"));
                } else {
                    var root = api.getRoot();
                    root.empty().removeClass("select-list");
                    root.append('<div class="address_hotcity"><strong>对不起，没有找到 ' + iptval + '</strong></div>');
                }
            })
        });

        api.change(function (e, elem) {
            var innerText = $(elem).attr("data-text");
            var innerValue = $(elem).attr("data-value");
            var innerprovince = $(elem).attr("data-province");
            $("#CityID" + $apiid).val(innerValue);
            $("#CityName" + $apiid).val(innerText);
            $("#ProvinceID" + $apiid).val(innerprovince);

            setIptVal($head, $headIpt, innerText);
        });

        api.onHide(function () {
            var selectIpt = api.getHead().find("input"),
			    $head = api.getHead(),
				$current = api.getRoot().find("li." + conf.css.current);

            closeCheckIpt();

            if ($current.length) {
                api.setValue($current);
            } else {
                var checkResult = checkIpt(selectIpt);
                if (checkResult == 1) {
                    setIptVal($head, selectIpt, "中文/拼音");
                } else if (checkResult == 2) {
                    if (checkValInData(api.getData(), selectIpt.val()).length) {
                        setIptVal($head, selectIpt, selectIpt.val());
                    } else {
                        setIptVal($head, selectIpt, "中文/拼音");
                    }
                }
            }
        });

        return api;
    };

    // jQuery plugin implementation
    /*  $.fn.areaSelect = function (conf) {
          var api = $(this).data("selectinput");  // 获取selectApi
          var $head = api.getHead(),  // 获取模拟select的 Head DOM  
          backHtml,
          $headIpt = $("<input/>").attr("type", "text");
  
          // configuration
          conf = api.getConf();
  
          api.onBeforeShow(function () {
              $head.html($headIpt.attr("value", $head.text()));
              $headIpt.css({
                  width: $head.width()
              }).addClass("selectInput")[0].select();
              areaInitShow(api);
              api.getRoot().addClass("select-list").show();
          });
  
  
          api.onShow(function () {
              initCheckVal($headIpt);
              openCheckIpt($headIpt[0], api, function() {
                  var iptval = getIptVal($headIpt);
             //     console.log(getKeyData());
                  var data = getKeyData(), data = !!data ? data : api.getData();
  
                  var searchResult = checkValInData(data, iptval);
                  if (searchResult != null && searchResult.length > 0) {
                      var root = api.getRoot();
                      root.empty().removeClass("select-list");
                      root.append('<div class="address_hotcity"><strong>请选择您要入住的城市</strong></div>');
                      $.map(searchResult, function(n) {
                          n = n.split("|||");
                          root.append("<li data-value='" + n[0] + "' data-index='" + n[4] + "' data-name='" + n[1] + "' data-text=" + n[2] + "><strong>" + n[2] + "</strong><span>" + n[1] + "</span></li>");
                      });
                      root.find("li").eq(0).addClass(conf.css.current);
                      api.setIndex(root.find("li").eq(0).attr("data-index"));
                  } else {
                      areaNormalShow(api);
                  }
              });
          });
  
          api.change(function (e, elem) {
              var innerText = $(elem).attr("data-text");
              setIptVal($head, $headIpt, innerText);
          });
  
          api.onHide(function () {
              var selectIpt = api.getHead().find("input"),
                  $head = api.getHead(),
                  $current = api.getRoot().find("li." + conf.css.current);
  
              closeCheckIpt();
  
              if ($current.length) {
                  api.setValue($current);
              } else {
                  var checkResult = checkIpt(selectIpt);
                  if (checkResult == 1) {
                      setIptVal($head, selectIpt, "中文/拼音");
                  } else if (checkResult == 2) {
                      if (checkValInData(api.getData(), selectIpt.val()).length) {
                          setIptVal($head, selectIpt, selectIpt.val());
                      } else {
                          setIptVal($head, selectIpt, "中文/拼音");
                      }
                  }
              }
          });
      };*/

    $.fn.worldAreaSelect = function (conf, cityInfo) {
        var api = $(this).data("selectinput");  // 获取selectApi
        var $head = api.getHead(),  // 获取模拟select的 Head DOM  
        backHtml,
        $headIpt = $("<input/>").attr("type", "text");

        // configuration
        conf = api.getConf();

        api.onBeforeShow(function () {
            $head.html($headIpt.attr("value", $head.text()));
            $headIpt.css({
                width: $head.width()
            }).addClass("selectInput")[0].select();
            areaInitShow(api, cityInfo);
            api.getRoot().addClass("select-list").show();
        });


        api.onShow(function () {
            initCheckVal($headIpt);
            openCheckIpt($headIpt[0], api, function () {
                var iptval = escape(getIptVal($headIpt));
                var data = getWorldKeyData(cityInfo), data = !!data ? data : api.getData();
                var root = api.getRoot();
                var searchResult = checkValInData(data, iptval);
                if (searchResult != null && searchResult.length > 0) {
                    root.empty().removeClass("select-list");
                    root.append('<div class="address_hotcity"><strong>请选择您要入住的城市</strong></div>');
                    $.map(searchResult, function (n) {
                        n = n.split("|||");
                        root.append("<li data-value='" + n[0] + "' data-index='" + n[4] + "' data-name='" + n[1] + "' data-text=" + n[2] + "><strong>" + n[2] + "</strong><span>" + n[1] + "</span></li>");
                    });
                    root.find("li").eq(0).addClass(conf.css.current);
                    api.setIndex(root.find("li").eq(0).attr("data-index"));
                } else {
                    root.empty().removeClass("select-list");
                    root.append('<div class="address_hotcity"><strong class="error-info">对不起，找不到:' + iptval + '</strong></div>');
                    // areaNormalShow(api);
                }
            });
        });

        api.change(function (e, elem) {
            var innerText = $(elem).attr("data-text");
            setIptVal($head, $headIpt, innerText);
        });

        api.onHide(function () {
            var selectIpt = api.getHead().find("input"),
                $head = api.getHead(),
                $current = api.getRoot().find("li." + conf.css.current);

            closeCheckIpt();

            if ($current.length) {
                api.setValue($current);
            } else {
                var checkResult = checkIpt(selectIpt);
                if (checkResult == 1) {
                    setIptVal($head, selectIpt, "中文/拼音");
                } else if (checkResult == 2) {
                    if (checkValInData(api.getData(), selectIpt.val()).length) {
                        setIptVal($head, selectIpt, selectIpt.val());
                    } else {
                        setIptVal($head, selectIpt, "中文/拼音");
                    }
                }
            }
        });
        return this;
    };

    // 初始化展示数据
    /* function areaInitShow(api,cityInfo) {
         var data = api.getSelect().find("option[data-show]"),
         index = api.getIndex(),
         root = api.getRoot(),
         info;
 
         try {
             info = cityInfo;
         } catch (e) {
             console.log("城市信息不存在，请检查");
             return false;
         }
 
         root.empty().append('<div id="m-area-drop" class="m-area-drop"></div>');
         var rootDiv = root.find("div");
 
 
         // add area
         $.each(info.areagroups, function (i, n) {
             var $div = $("<div class='area-item'><h2 class='area-name'>" + n.name + "</h2><div class='area-list'></div></div>");
             rootDiv.append($div);
 
             if (i % 2 == 1) {
                 $div.addClass("current");
             }
 
             if (i + 1 == info.areagroups.length) {
                 $div.css("border", "0px");
             }
 
             $div.hover(function () {
                 //$div.addClass("current");
             }, function () {
                 //$div.removeClass("current");
             })
 
             areaDrawContent(n.cityids, info.citys, $div.find("div.area-list"), api);
         })
     }*/

    function areaInitShow(api, cityInfo) {
        var data = api.getSelect().find("option[data-show]"),
        index = api.getIndex(),
        root = api.getRoot(),
        info;
        // draw tab content
        function drawContent(ids, citys, elem, api) {
            var cityids = typeof ids == "string" ? ids.split(",") : ids;

            elem.empty();
            $.map(cityids, function (i) {
                $.map(cityInfo.citys, function (n) {
                    if (n.id == i) {
                        elem.append($("<span/>").text(n.name).attr("data-value", i));
                    }
                })
            });

            // bind chose city event
            elem.find("span").unbind().bind("click", function () {
                var self = $(this), v = self.attr("data-value");
                $.each(cityInfo.citys, function (i, n) {
                    if (n.id == v) {
                        api.setHeadText(self.text()).setIndex(i);
                    }
                })
            });
        }
        try {
            info = cityInfo;
        } catch (e) {
            //   console.log("城市信息不存在，请检查");
            return false;
        }

        root.empty().append('<div><div class="address_tabs"></div><div class="address_content"></div></div>');
        // get cityinfo and group by tabs

        var rootDiv = root.find("div"), $tabElem = rootDiv.eq(1), $tabInfoElem = rootDiv.eq(2);

        // add tab of lettergroups
        $.each(info.areagroups, function (i, n) {
            var $span = $("<span/>").text(n.name).attr("data-cityids", n.cityids);
            $tabElem.append($span);
        });

        var $tabElemSpan = $tabElem.find("span");
        $tabElemSpan.first().addClass("current");
        $tabElemSpan.unbind().bind("click", function () {
            drawContent($(this).attr("data-cityids"), info.citys, $tabInfoElem, api);
            $tabElemSpan.removeClass("current");
            $(this).addClass("current");
            return false;
        });

        drawContent(info.areagroups[0].cityids, info.citys, $tabInfoElem, api);

        // added by liuyu 20131030
        api.getConf().IsNotSelectState = true;
    }

    // draw tab content
    function areaDrawContent(ids, citys, elem, api) {

        var cityids = typeof ids == "string" ? ids.split(",") : ids;

        elem.empty();
        $.map(cityids, function (i) {
            $.map(citys, function (n) {
                if (n.id == i) {
                    elem.append($("<span/>").text(n.name).attr("data-value", i));
                }
            })
        });

        // bind chose city event
        elem.find("span").unbind().bind("click", function () {
            var self = $(this), v = self.attr("data-value");
            $.each(citys, function (i, n) {
                if (n.id == v) {
                    api.setHeadText(self.text()).setIndex(i);
                }
            })
        });
    }



})(jQuery);
/*!
* jQuery Cookie Plugin
* https://github.com/carhartl/jquery-cookie
*
* Copyright 2011, Klaus Hartl
* Dual licensed under the MIT or GPL Version 2 licenses.
* http://www.opensource.org/licenses/mit-license.php
* http://www.opensource.org/licenses/GPL-2.0
*/
(function ($) {
    $.cookie = function (key, value, options) {

        // key and at least value given, set cookie...
        if (arguments.length > 1 && (!/Object/.test(Object.prototype.toString.call(value)) || value === null || value === undefined)) {
            options = $.extend({}, options, {path:'/'});

            if (value === null || value === undefined) {
                options.expires = -1;
            }

            if (typeof options.expires === 'number') {
                var days = options.expires, t = options.expires = new Date();
                t.setDate(t.getDate() + days);
            }

            value = String(value);

            return (document.cookie = [
                encodeURIComponent(key), '=', options.raw ? value : encodeURIComponent(value),
                options.expires ? '; expires=' + options.expires.toUTCString() : '', // use expires attribute, max-age is not supported by IE
                options.path ? '; path=' + options.path : '',
                options.domain ? '; domain=' + options.domain : '',
                options.secure ? '; secure' : ''
            ].join(''));
        }

        // key and possibly options given, get cookie...
        options = value || {
            path: '/'
        };
        var decode = options.raw ? function (s) { return s; } : decodeURIComponent;

        var pairs = document.cookie.split('; ');
        for (var i = 0, pair; pair = pairs[i] && pairs[i].split('='); i++) {
            if (decode(pair[0]) === key) return decode(pair[1] || ''); // IE saves cookies with empty string as "c; ", e.g. without "=" as opposed to EOMB, thus pair[1] may be undefined
        }
        return null;
    };
})(jQuery);
/*
HHcookie = {
    // --- ????cookie
    set: function (sName, sValue, expireHours) {
        var cookieString = sName + "=" + escape(sValue);
        //;?ж???????ù??????
        if (expireHours > 0) {
            var date = new Date();
            date.setTime(date.getTime + expireHours * 3600 * 1000);
            cookieString = cookieString + "; expire=" + date.toGMTString();
        }
        document.cookie = cookieString + "; path=/";
    },
    //--- ???cookie
    get: function (sName) {
        var aCookie = document.cookie.split("; ");
        for (var j = 0; j < aCookie.length; j++) {
            var aCrumb = aCookie[j].split("=");
            if (escape(sName) == aCrumb[0])
                return unescape(aCrumb[1]);
        }
        return null;
    }
}*/
/*!
 * jQuery Raty - A Star Rating Plugin - http://wbotelhos.com/raty
 * ---------------------------------------------------------------------
 *
 * jQuery Raty is a plugin that generates a customizable star rating.
 *
 * Licensed under The MIT License
 *
 * @version        2.1.0
 * @since          2010.06.11
 * @author         Washington Botelho
 * @documentation  wbotelhos.com/raty
 * @twitter        twitter.com/wbotelhos
 *
 * Usage with default values:
 * ---------------------------------------------------------------------
 * $('#star').raty();
 *
 * <div id="star"></div>
 *
 * $('.star').raty();
 *
 * <div class="star"></div>
 * <div class="star"></div>
 * <div class="star"></div>
 *
 */

;(function($) {

	var methods = {
		init: function(options) {
			return this.each(function() {

				var opt		= $.extend({}, $.fn.raty.defaults, options),
					$this	= $(this).data('options', opt);

				if (opt.number > 20) {
					opt.number = 20;
				} else if (opt.number < 0) {
					opt.number = 0;
				}

				if (opt.round.down === undefined) {
					opt.round.down = $.fn.raty.defaults.round.down;
				}

				if (opt.round.full === undefined) {
					opt.round.full = $.fn.raty.defaults.round.full;
				}

				if (opt.round.up === undefined) {
					opt.round.up = $.fn.raty.defaults.round.up;
				}

				if (opt.path != "" && opt.path.substring(opt.path.length - 1, opt.path.length) != '/') {
					opt.path += '/';
				}

				if (typeof opt.start == 'function') {
					opt.start = opt.start.call(this);
				}

				var isValidStart	= !isNaN(parseInt(opt.start, 10)),
					start			= '';

				if (isValidStart) {
					start = (opt.start > opt.number) ? opt.number : opt.start;
				} 

				var starFile	= opt.starOn,
					space		= (opt.space) ? 4 : 0,
					hint		= '';

				for (var i = 1; i <= opt.number; i++) {
					starFile = (start < i) ? opt.starOff : opt.starOn;

					hint = (i <= opt.hintList.length && opt.hintList[i - 1] !== null) ? opt.hintList[i - 1] : i;

					$this.append('<img src="' + opt.path + starFile + '" alt="' + i + '" title="' + hint + '" />');

					if (opt.space) {
						$this.append((i < opt.number) ? '&nbsp;' : '');
					}
				}

				var $score = $('<input/>', { type: 'hidden', name: opt.scoreName, id:opt.scoreName}).appendTo($this);

				if (isValidStart) {
					if (opt.start > 0) {
						$score.val(start);
					}

					methods.roundStar.call($this, start);
				}

				if (opt.iconRange) {
					methods.fillStar.call($this, start);	
				}

				methods.setTarget.call($this, start, opt.targetKeep);

				//var width = opt.width || (opt.number * opt.size + opt.number * space);

				if (opt.cancel) {
					var $cancel = $('<img src="' + opt.path + opt.cancelOff + '" alt="x" title="' + opt.cancelHint + '" class="raty-cancel"/>');

					if (opt.cancelPlace == 'left') {
						$this.prepend('&nbsp;').prepend($cancel);
					} else {
						$this.append('&nbsp;').append($cancel);
					}

					//width += opt.size + space;
				}

				if (opt.readOnly) {
					methods.fixHint.call($this);

					$this.children('.raty-cancel').hide();
				} else {
					$this.css('cursor', 'pointer');

					methods.bindAction.call($this);
				}

				//$this.css('width', width);
			});
		}, bindAction: function() {
			var self	= this,
				opt		= this.data('options'),
				$score	= this.children('input');

			self.mouseleave(function() {
				methods.initialize.call(self, $score.val());

				methods.setTarget.call(self, $score.val(), opt.targetKeep);
			});

			var $stars	= this.children('img').not('.raty-cancel'),
				action	= (opt.half) ? 'mousemove' : 'mouseover';

			if (opt.cancel) {
				self.children('.raty-cancel').mouseenter(function() {
					$(this).attr('src', opt.path + opt.cancelOn);

					$stars.attr('src', opt.path + opt.starOff);

					methods.setTarget.call(self, null, true);
				}).mouseleave(function() {
					$(this).attr('src', opt.path + opt.cancelOff);

					self.mouseout();
				}).click(function(evt) {
					$score.removeAttr('value');

					if (opt.click) {
			          opt.click.call(self[0], null, evt);
			        }
				});
			}

			$stars.bind(action, function(evt) {
				var value = parseInt(this.alt, 10);

				if (opt.half) {
					var position	= parseFloat((evt.pageX - $(this).offset().left) / opt.size),
						diff		= (position > .5) ? 1 : .5;

					value = parseFloat(this.alt) - 1 + diff;

					methods.fillStar.call(self, value);

					if (opt.precision) {
						value = value - diff + position;
					}

					methods.showHalf.call(self, value);
				} else {
					methods.fillStar.call(self, value);
				}

				self.data('score', value);

				methods.setTarget.call(self, value, true);
			}).click(function(evt) {
				$score.val((opt.half || opt.precision) ? self.data('score') : this.alt);

				if (opt.click) {
					opt.click.call(self[0], $score.val(), evt);
				}
			});
		}, cancel: function(isClick) {
			return this.each(function() {
				var $this = $(this);

				if ($this.data('readonly') == 'readonly') {
					return false;
				}

				if (isClick) {
					methods.click.call($this, null);
				} else {
					methods.start.call($this, null);
				}

				$this.mouseleave().children('input').removeAttr('value');
			});
		}, click: function(score) {
			return this.each(function() {
				var $this = $(this);

				if ($this.data('readonly') == 'readonly') {
					return false;
				}

				methods.initialize.call($this, score);

				var opt = $this.data('options');

				if (opt.click) {
					opt.click.call($this[0], score);
				} else {
					$.error('you must add the "click: function(score, evt) { }" callback.');
				}

				methods.setTarget.call($this, score, true);
			});
		}, fillStar: function(score) {
			var opt		= this.data('options'),
				$stars	= this.children('img').not('.raty-cancel'),
				qtyStar	= $stars.length,
				count	= 0,
				$star	,
				star	,
				icon	;

			for (var i = 1; i <= qtyStar; i++) {
				$star = $stars.eq(i - 1);

				if (opt.iconRange && opt.iconRange.length > count) {
					star = opt.iconRange[count];

					if (opt.single) {
						icon = (i == score) ? (star.on || opt.starOn) : (star.off || opt.starOff);
					} else {
						icon = (i <= score) ? (star.on || opt.starOn) : (star.off || opt.starOff);
					}

					if (i <= star.range) {
						$star.attr('src', opt.path + icon);
					}

					if (i == star.range) {
						count++;
					}
				} else {
					if (opt.single) {
						icon = (i == score) ? opt.starOn : opt.starOff;
					} else {
						icon = (i <= score) ? opt.starOn : opt.starOff;
					}

					$star.attr('src', opt.path + icon);
				}
			}
		}, fixHint: function() {
			var opt		= this.data('options'),
				$score	= this.children('input'),
				score	= parseInt($score.val(), 10),
				hint	= opt.noRatedMsg;

			if (!isNaN(score) && score > 0) {
				hint = (score <= opt.hintList.length && opt.hintList[score - 1] !== null) ? opt.hintList[score - 1] : score;
			}

			$score.attr('readonly', 'readonly');
			this.css('cursor', 'default').data('readonly', 'readonly').attr('title', hint).children('img').attr('title', hint);
		}, readOnly: function(isReadOnly) {
			return this.each(function() {
				var $this	= $(this),
					$cancel	= $this.children('.raty-cancel');

				if ($cancel.length) {
					if (isReadOnly) {
						$cancel.hide();
					} else {
						$cancel.show();
					}
				}

				if (isReadOnly) {
					$this.unbind();

					$this.children('img').unbind();

					methods.fixHint.call($this);
				} else {
					methods.bindAction.call($this);

					methods.unfixHint.call($this);
				}
			});
		}, roundStar: function(score) {
			var opt		= this.data('options'),
				diff	= (score - Math.floor(score)).toFixed(2);

			if (diff > opt.round.down) {
				var icon = opt.starOn;						// Full up: [x.76 .. x.99]

				if (diff < opt.round.up && opt.halfShow) {	// Half: [x.26 .. x.75]
					icon = opt.starHalf;
				} else if (diff < opt.round.full) {			// Full down: [x.00 .. x.5]
					icon = opt.starOff;
				}

				this.children('img').not('.raty-cancel').eq(Math.ceil(score) - 1).attr('src', opt.path + icon);
			}												// Full down: [x.00 .. x.25]
		}, score: function() {
			var score	= [],
				value	;

			this.each(function() {
				value = $(this).children('input').val();
				value = (value == '') ? null : parseFloat(value);

				score.push(value);
			});

			return (score.length > 1) ? score : score[0];
		}, setTarget: function(value, isKeep) {
			var opt = this.data('options');

			if (opt.target) {
				var $target = $(opt.target);

				if ($target.length == 0) {
					$.error('target selector invalid or missing!');
				} else {
					var score = value;

					if (score == null && !opt.cancel) {
						$.error('you must enable the "cancel" option to set hint on target.');
					} else {
						if (!isKeep || score == '') {
							score = opt.targetText;
						} else {
							if (opt.targetType == 'hint') {
								if (score === null && opt.cancel) {
									score = opt.cancelHint;
								} else {
									score = opt.hintList[Math.ceil(score - 1)];
								}
							} else {
								if (score != '' && !opt.precision) {
									score = parseInt(score, 10);
								} else {
									score = parseFloat(score).toFixed(1);
								}
							}
						}

						if (typeof (score) == "undefined")
						{
						    score = "";
						}


						if (opt.targetFormat.indexOf('{score}') < 0) {
							$.error('template "{score}" missing!');
						} else if (value !== null) {
							score = opt.targetFormat.toString().replace('{score}', score);
						}

						if ($target.is(':input')) {
							$target.val(score);
						} else {
							$target.html(score);
						}
					}
				}
			}
		}, showHalf: function(score) {
			var opt		= this.data('options'),
				diff	= (score - Math.floor(score)).toFixed(1);

			if (diff > 0 && diff < .6) {
				this.children('img').not('.raty-cancel').eq(Math.ceil(score) - 1).attr('src', opt.path + opt.starHalf);
			}
		}, start: function(score) {
			return this.each(function() {
				var $this = $(this);

				if ($this.data('readonly') == 'readonly') {
					return false;
				}

				methods.initialize.call($this, score);

				var opt = $this.data('options');

				methods.setTarget.call($this, score, true);
			});
		}, initialize: function(score) {
			var opt	= this.data('options');

			if (score < 0) {
				score = 0;
			} else if (score > opt.number) {
				score = opt.number;
			}

			methods.fillStar.call(this, score);

			if (score != '') {
				if (opt.halfShow) {
					methods.roundStar.call(this, score);
				}

				this.children('input').val(score);
			}
		}, unfixHint: function() {
			var opt		= this.data('options'),
				$imgs	= this.children('img').filter(':not(.raty-cancel)');

			for (var i = 0; i < opt.number; i++) {
				$imgs.eq(i).attr('title', (i < opt.hintList.length && opt.hintList[i] !== null) ? opt.hintList[i] : i);
			}

			this.css('cursor', 'pointer').removeData('readonly').removeAttr('title').children('input').attr('readonly', 'readonly');
		}
	};

	$.fn.raty = function(method) {
		if (methods[method]) {
			return methods[method].apply(this, Array.prototype.slice.call(arguments, 1));
		} else if (typeof method === 'object' || !method) {
			return methods.init.apply(this, arguments);
		} else {
			$.error('Method ' + method + ' does not exist!');
		} 
	};

	$.fn.raty.defaults = {
		cancel:			false,
		cancelHint:		'cancel this rating!',
		cancelOff:		'cancel-off.png',
		cancelOn:		'cancel-on.png',
		cancelPlace:	'left',
		click:			undefined,
		half:			false,
		halfShow:		true,
		hintList:		['bad', 'poor', 'regular', 'good', 'gorgeous'],
		iconRange:		undefined,
		noRatedMsg:		'暂时还没有评分',
		number:			5,
		path:			'img/',
		precision:		false,
		round:			{ down: .25, full: .6, up: .76 },
		readOnly:		false,
		scoreName:		'score',
		single:			false,
		size:			16,
		space:			true,
		starHalf:		'star-half.png',
		starOff:		'star-off.png',
		starOn:			'star-on.png',
		start:			0,
		target:			undefined,
		targetFormat:	'{score}',
		targetKeep:		false,
		targetText:		'',
		targetType:		'hint'
	//	width:			undefined
	};

})(jQuery);

/*!
 * jquery-powerFloat.js
 * jQuery 万能浮动层插件
 * http://www.zhangxinxu.com/wordpress/?p=1328
 * ? by zhangxinxu  
 * 2010-12-06 v1.0.0	插件编写，初步调试
 * 2010-12-30 v1.0.1	限定尖角字符字体，避免受浏览器自定义字体干扰
 * 2011-01-03 v1.1.0	修复连续获得焦点显示后又隐藏的bug
 						修复图片加载正则判断不准确的问题
 * 2011-02-15 v1.1.1	关于居中对齐位置判断的特殊处理
 * 2011-04-15 v1.2.0	修复浮动层含有过高select框在IE下点击会隐藏浮动层的问题，同时优化事件绑定			
 * 2011-09-13 v1.3.0 	修复两个菜单hover时间间隔过短隐藏回调不执行的问题
 * 2012-01-13 v1.4.0	去除ajax加载的存储
                    	修复之前按照ajax地址后缀判断是否图片的问题
						修复一些脚本运行出错
						修复hover延时显示时，元素没有显示但鼠标移出依然触发隐藏回调的问题
 * 2012-02-27 v1.5.0	为无id容器创建id逻辑使用错误的问题
 						修复无事件浮动出现时同页面点击空白区域浮动层不隐藏的问题
						修复点击与hover并存时特定时候o.trigger报为null错误的问题
 * 2012-03-29 v1.5.1	修复连续hover时候后面一个不触发显示的问题
 * 2012-05-02 v1.5.2	点击事件 浮动框再次点击隐藏的问题修复
 * 2012-11-02 v1.6.0	兼容jQuery 1.8.2
 * 2012-01-28 v1.6.1	target参数支持funtion类型，以实现类似动态Ajax地址功能
 */

(function ($) {
    $.fn.powerFloat = function (options) {
        return $(this).each(function () {
            var s = $.extend({}, defaults, options || {});
            var init = function (pms, trigger) {
                if (o.target && o.target.css("display") !== "none") {
                    o.targetHide();
                }
                o.s = pms;
                o.trigger = trigger;
            }, hoverTimer;

            switch (s.eventType) {
                case "hover": {
                    $(this).hover(function () {
                        if (o.timerHold) {
                            o.flagDisplay = true;
                        }

                        var numShowDelay = parseInt(s.showDelay, 10);

                        init(s, $(this));
                        //鼠标hover延时
                        if (numShowDelay) {
                            if (hoverTimer) {
                                clearTimeout(hoverTimer);
                            }
                            hoverTimer = setTimeout(function () {
                                o.targetGet.call(o);
                            }, numShowDelay);
                        } else {
                            o.targetGet();
                        }
                    }, function () {
                        if (hoverTimer) {
                            clearTimeout(hoverTimer);
                        }
                        if (o.timerHold) {
                            clearTimeout(o.timerHold);
                        }

                        o.flagDisplay = false;

                        o.targetHold();
                    });
                    if (s.hoverFollow) {
                        //鼠标跟随	
                        $(this).mousemove(function (e) {
                            o.cacheData.left = e.pageX;
                            o.cacheData.top = e.pageY;
                            o.targetGet.call(o);
                            return false;
                        });
                    }
                    break;
                }
                case "degHover": {
                    $(this).on("mouseover", s.degElem,function (ev) {
                        if (o.timerHold) {
                            o.flagDisplay = true;
                        }
                        var numShowDelay = parseInt(s.showDelay, 10);
                        init(s, $(this));
                        if (numShowDelay) {
                            if (hoverTimer) {
                                clearTimeout(hoverTimer);
                            }
                            hoverTimer = setTimeout(function () {
                                o.targetGet.call(o);
                            }, numShowDelay);
                        } else {
                            o.targetGet();
                        }
                    });

                    $(this).on("mouseout",s.degElem, function () {
                        if (hoverTimer) {
                            clearTimeout(hoverTimer);
                        }
                        if (o.timerHold) {
                            clearTimeout(o.timerHold);
                        }

                        o.flagDisplay = false;

                        o.targetHold();
                    });
                    break;
                }
                case "click": {
                    $(this).click(function (e) {
                        if (o.display && o.trigger && e.target === o.trigger.get(0)) {
                            o.flagDisplay = false;
                            o.displayDetect();
                        } else {
                            init(s, $(this));
                            o.targetGet();

                            if (!$(document).data("mouseupBind")) {
                                $(document).bind("mouseup", function (e) {
                                    var flag = false;
                                    if (o.trigger) {
                                        var idTarget = o.target.attr("id");
                                        if (!idTarget) {
                                            idTarget = "R_" + Math.random();
                                            o.target.attr("id", idTarget);
                                        }
                                        $(e.target).parents().each(function () {
                                            if ($(this).attr("id") === idTarget) {
                                                flag = true;
                                            }
                                        });
                                        if (s.eventType === "click" && o.display && e.target != o.trigger.get(0) && !flag) {
                                            o.flagDisplay = false;
                                            o.displayDetect();
                                        }
                                    }
                                    return false;
                                }).data("mouseupBind", true);
                            }
                        }
                    });

                    break;
                }
                case "focus": {
                    $(this).focus(function () {
                        var self = $(this);
                        setTimeout(function () {
                            init(s, self);
                            o.targetGet();
                        }, 200);
                    }).blur(function () {
                        o.flagDisplay = false;
                        setTimeout(function () {
                            o.displayDetect();
                        }, 190);
                    });
                    break;
                }
                case "custom":
                    {
                        this.showpl = function () {

                            var self = $(this);
                            setTimeout(function () {
                                init(s, self);
                                o.targetGet();
                            }, 200);
                        };

                        this.hidepl = function () {
                            o.flagDisplay = false;
                            setTimeout(function () {
                                o.displayDetect();
                            }, 190);
                        };

                        this.clear = function () {
                            this.showpl = function () { };
                            this.hidepl = function () { };
                        }

                        break;
                    }

                default: {
                    init(s, $(this));
                    o.targetGet();
                    // 放置页面点击后显示的浮动内容隐掉
                    $(document).unbind("mouseup").data("mouseupBind", false);
                }
            }
        });
    };

    var o = {
        targetGet: function () {
            //一切显示的触发来源
            if (!this.trigger) { return this; }
            var attr = this.trigger.attr(this.s.targetAttr), target = typeof this.s.target == "function" ? this.s.target.call(this.trigger) : this.s.target;

            switch (this.s.targetMode) {
                case "common": {
                    if (target) {
                        var type = typeof (target);
                        if (type === "object") {
                            if (target.size()) {
                                o.target = target.eq(0);
                            }
                        } else if (type === "string") {
                            if ($(target).size()) {
                                o.target = $(target).eq(0);
                            }
                        }
                    } else {
                        if (attr && $("#" + attr).size()) {
                            o.target = $("#" + attr);
                        }
                    }
                    if (o.target) {
                        o.targetShow();
                    } else {
                        return this;
                    }

                    break;
                }
                case "ajax": {
                    //ajax元素，如图片，页面地址
                    var url = target || attr;
                    this.targetProtect = false;

                    if (!url) { return; }

                    if (!o.cacheData[url]) {
                        o.loading();
                    }

                    //优先认定为图片加载
                    var tempImage = new Image();

                    tempImage.onload = function () {
                        var w = tempImage.width, h = tempImage.height;
                        var winw = $(window).width(), winh = $(window).height();
                        var imgScale = w / h, winScale = winw / winh;
                        if (imgScale > winScale) {
                            //图片的宽高比大于显示屏幕
                            if (w > winw / 2) {
                                w = winw / 2;
                                h = w / imgScale;
                            }
                        } else {
                            //图片高度较高
                            if (h > winh / 2) {
                                h = winh / 2;
                                w = h * imgScale;
                            }
                        }
                        var imgHtml = '<img class="float_ajax_image" src="' + url + '" width="' + w + '" height = "' + h + '" />';
                        o.cacheData[url] = true;
                        o.target = $(imgHtml);
                        o.targetShow();
                    };
                    tempImage.onerror = function () {
                        //如果图片加载失败，两种可能，一是100%图片，则提示；否则作为页面加载
                        if (/(\.jpg|\.png|\.gif|\.bmp|\.jpeg)$/i.test(url)) {
                            o.target = $('<div class="float_ajax_error">图片加载失败。</div>');
                            o.targetShow();
                        } else {
                            $.ajax({
                                url: url,
                                success: function (data) {
                                    if (typeof (data) === "string") {
                                        o.cacheData[url] = true;
                                        o.target = $('<div class="float_ajax_data">' + data + '</div>');
                                        o.targetShow();
                                    }
                                },
                                error: function () {
                                    o.target = $('<div class="float_ajax_error">数据没有加载成功。</div>');
                                    o.targetShow();
                                }
                            });
                        }
                    };
                    tempImage.src = url;

                    break;
                }
                case "list": {
                    //下拉列表
                    var targetHtml = '<ul class="float_list_ul">', arrLength;
                    if ($.isArray(target) && (arrLength = target.length)) {
                        $.each(target, function (i, obj) {
                            var list = "", strClass = "", text, href;
                            if (i === 0) {
                                strClass = ' class="float_list_li_first"';
                            }
                            if (i === arrLength - 1) {
                                strClass = ' class="float_list_li_last"';
                            }
                            if (typeof (obj) === "object" && (text = obj.text.toString())) {
                                if (href = (obj.href || "javascript:")) {
                                    list = '<a href="' + href + '" class="float_list_a">' + text + '</a>';
                                } else {
                                    list = text;
                                }
                            } else if (typeof (obj) === "string" && obj) {
                                list = obj;
                            }
                            if (list) {
                                targetHtml += '<li' + strClass + '>' + list + '</li>';
                            }
                        });
                    } else {
                        targetHtml += '<li class="float_list_null">列表无数据。</li>';
                    }
                    targetHtml += '</ul>';
                    o.target = $(targetHtml);
                    this.targetProtect = false;
                    o.targetShow();
                    break;
                }
                case "remind": {
                    //内容均是字符串
                    var strRemind = target || attr;
                    this.targetProtect = false;
                    if (typeof (strRemind) === "string") {
                        o.target = $('<span>' + strRemind + '</span>');
                        o.targetShow();
                    }
                    break;
                }
                default: {
                    var objOther = target || attr, type = typeof (objOther);
                    if (objOther) {
                        if (type === "string") {
                            //选择器
                            if (/^.[^:#\[\.,]*$/.test(objOther)) {
                                if ($(objOther).size()) {
                                    o.target = $(objOther).eq(0);
                                    this.targetProtect = true;
                                } else if ($("#" + objOther).size()) {
                                    o.target = $("#" + objOther).eq(0);
                                    this.targetProtect = true;
                                } else {
                                    o.target = $('<div>' + objOther + '</div>');
                                    this.targetProtect = false;
                                }
                            } else {
                                o.target = $('<div>' + objOther + '</div>');
                                this.targetProtect = false;
                            }

                            o.targetShow();
                        } else if (type === "object") {
                            if (!$.isArray(objOther) && objOther.size()) {
                                o.target = objOther.eq(0);
                                this.targetProtect = true;
                                o.targetShow();
                            }
                        }
                    }
                }
            }
            return this;
        },
        container: function () {
            //容器(如果有)重装target
            var cont = this.s.container, mode = this.s.targetMode || "mode";
            if (mode === "ajax" || mode === "remind") {
                //显示三角
                this.s.sharpAngle = true;
            } else {
                this.s.sharpAngle = false;
            }
            //是否反向
            if (this.s.reverseSharp) {
                this.s.sharpAngle = !this.s.sharpAngle;
            }

            if (mode !== "common") {
                //common模式无新容器装载
                if (cont === null) {
                    cont = "plugin";
                }
                if (cont === "plugin") {
                    if (!$("#floatBox_" + mode).size()) {
                        $('<div id="floatBox_' + mode + '" class="float_' + mode + '_box"></div>').appendTo($("body")).hide();
                    }
                    cont = $("#floatBox_" + mode);
                }

                if (cont && typeof (cont) !== "string" && cont.size()) {
                    if (this.targetProtect) {
                        o.target.show().css("position", "static");
                    }
                    o.target = cont.empty().append(o.target);
                }
            }
            return this;
        },
        setWidth: function () {
            var w = this.s.width;
            if (w === "auto") {
                if (this.target.get(0).style.width) {
                    this.target.css("width", "auto");
                }
            } else if (w === "inherit") {
                this.target.width(this.trigger.width());
            } else {
                this.target.css("width", w);
            }
            return this;
        },
        position: function () {
            if (!this.trigger || !this.target) {
                return this;
            }
            var pos, tri_h = 0, tri_w = 0, cor_w = 0, cor_h = 0, tri_l, tri_t, tar_l, tar_t, cor_l, cor_t,
				tar_h = this.target.data("height"), tar_w = this.target.data("width"),
				st = $(window).scrollTop(),

				off_x = parseInt(this.s.offsets.x, 10) || 0, off_y = parseInt(this.s.offsets.y, 10) || 0,
				mousePos = this.cacheData;
            //缓存目标对象高度，宽度，提高鼠标跟随时显示性能，元素隐藏时缓存清除
            if (!tar_h) {
                tar_h = this.target.outerHeight();
                if (this.s.hoverFollow) {
                    this.target.data("height", tar_h);
                }
            }
            if (!tar_w) {
                tar_w = this.target.outerWidth();
                if (this.s.hoverFollow) {
                    this.target.data("width", tar_w);
                }
            }

            pos = this.trigger.offset();
            tri_h = this.trigger.outerHeight();
            tri_w = this.trigger.outerWidth();
            tri_l = pos.left;
            tri_t = pos.top;

            var funMouseL = function () {
                if (tri_l < 0) {
                    tri_l = 0;
                } else if (tri_l + tri_h > $(window).width()) {
                    tri_l = $(window).width() - tri_w;
                }
            }, funMouseT = function () {
                if (tri_t < 0) {
                    tri_t = 0;
                } else if (tri_t + tri_h > $(document).height()) {
                    tri_t = $(document).height() - tri_h;
                }
            };
            //如果是鼠标跟随
            if (this.s.hoverFollow && mousePos.left && mousePos.top) {
                if (this.s.hoverFollow === "x") {
                    //水平方向移动，说明纵坐标固定
                    tri_l = mousePos.left
                    funMouseL();
                } else if (this.s.hoverFollow === "y") {
                    //垂直方向移动，说明横坐标固定，纵坐标跟随鼠标移动
                    tri_t = mousePos.top;
                    funMouseT();
                } else {
                    tri_l = mousePos.left;
                    tri_t = mousePos.top;
                    funMouseL();
                    funMouseT();
                }
            }


            var arrLegalPos = ["4-1", "1-4", "5-7", "2-3", "2-1", "6-8", "3-4", "4-3", "8-6", "1-2", "7-5", "3-2"],
				align = this.s.position, alignMatch = false, strDirect;
            $.each(arrLegalPos, function (i, n) {
                if (n === align) {
                    alignMatch = true;
                    return;
                }
            });
            if (!alignMatch) {
                align = "4-1";
            }

            var funDirect = function (a) {
                var dir = "bottom";
                //确定方向
                switch (a) {
                    case "1-4": case "5-7": case "2-3": {
                        dir = "top";
                        break;
                    }
                    case "2-1": case "6-8": case "3-4": {
                        dir = "right";
                        break;
                    }
                    case "1-2": case "8-6": case "4-3": {
                        dir = "left";
                        break;
                    }
                    case "4-1": case "7-5": case "3-2": {
                        dir = "bottom";
                        break;
                    }
                }
                return dir;
            };

            //居中判断
            var funCenterJudge = function (a) {
                if (a === "5-7" || a === "6-8" || a === "8-6" || a === "7-5") {
                    return true;
                }
                return false;
            };

            var funJudge = function (dir) {
                var totalHeight = 0, totalWidth = 0, flagCorner = (o.s.sharpAngle && o.corner) ? true : false;
                if (dir === "right") {
                    totalWidth = tri_l + tri_w + tar_w + off_x;
                    if (flagCorner) {
                        totalWidth += o.corner.width();
                    }
                    if (totalWidth > $(window).width()) {
                        return false;
                    }
                } else if (dir === "bottom") {
                    totalHeight = tri_t + tri_h + tar_h + off_y;
                    if (flagCorner) {
                        totalHeight += o.corner.height();
                    }
                    if (totalHeight > st + $(window).height()) {
                        return false;
                    }
                } else if (dir === "top") {
                    totalHeight = tar_h + off_y;
                    if (flagCorner) {
                        totalHeight += o.corner.height();
                    }
                    if (totalHeight > tri_t - st) {
                        return false;
                    }
                } else if (dir === "left") {
                    totalWidth = tar_w + off_x;
                    if (flagCorner) {
                        totalWidth += o.corner.width();
                    }
                    if (totalWidth > tri_l) {
                        return false;
                    }
                }
                return true;
            };
            //此时的方向
            strDirect = funDirect(align);

            if (this.s.sharpAngle) {
                //创建尖角
                this.createSharp(strDirect);
            }

            //边缘过界判断
            if (this.s.edgeAdjust) {
                //根据位置是否溢出显示界面重新判定定位
                if (funJudge(strDirect)) {
                    //该方向不溢出
                    (function () {
                        if (funCenterJudge(align)) { return; }
                        var obj = {
                            top: {
                                right: "2-3",
                                left: "1-4"
                            },
                            right: {
                                top: "2-1",
                                bottom: "3-4"
                            },
                            bottom: {
                                right: "3-2",
                                left: "4-1"
                            },
                            left: {
                                top: "1-2",
                                bottom: "4-3"
                            }
                        };
                        var o = obj[strDirect], name;
                        if (o) {
                            for (name in o) {
                                if (!funJudge(name)) {
                                    align = o[name];
                                }
                            }
                        }
                    })();
                } else {
                    //该方向溢出
                    (function () {
                        if (funCenterJudge(align)) {
                            var center = {
                                "5-7": "7-5",
                                "7-5": "5-7",
                                "6-8": "8-6",
                                "8-6": "6-8"
                            };
                            align = center[align];
                        } else {
                            var obj = {
                                top: {
                                    left: "3-2",
                                    right: "4-1"
                                },
                                right: {
                                    bottom: "1-2",
                                    top: "4-3"
                                },
                                bottom: {
                                    left: "2-3",
                                    right: "1-4"
                                },
                                left: {
                                    bottom: "2-1",
                                    top: "3-4"
                                }
                            };
                            var o = obj[strDirect], arr = [];
                            for (name in o) {
                                arr.push(name);
                            }
                            if (funJudge(arr[0]) || !funJudge(arr[1])) {
                                align = o[arr[0]];
                            } else {
                                align = o[arr[1]];
                            }
                        }
                    })();
                }
            }

            //已确定的尖角
            var strNewDirect = funDirect(align), strFirst = align.split("-")[0];
            if (this.s.sharpAngle) {
                //创建尖角
                this.createSharp(strNewDirect);
                cor_w = this.corner.width(), cor_h = this.corner.height();
            }

            //确定left, top值
            if (this.s.hoverFollow) {
                //如果鼠标跟随
                if (this.s.hoverFollow === "x") {
                    //仅水平方向跟随
                    tar_l = tri_l + off_x;
                    if (strFirst === "1" || strFirst === "8" || strFirst === "4") {
                        //最左
                        tar_l = tri_l - (tar_w - tri_w) / 2 + off_x;
                    } else {
                        //右侧
                        tar_l = tri_l - (tar_w - tri_w) + off_x;
                    }

                    //这是垂直位置，固定不动
                    if (strFirst === "1" || strFirst === "5" || strFirst === "2") {
                        tar_t = tri_t - off_y - tar_h - cor_h;
                        //尖角
                        cor_t = tri_t - cor_h - off_y - 1;

                    } else {
                        //下方
                        tar_t = tri_t + tri_h + off_y + cor_h;
                        cor_t = tri_t + tri_h + off_y + 1;
                    }
                    cor_l = pos.left - (cor_w - tri_w) / 2;
                } else if (this.s.hoverFollow === "y") {
                    //仅垂直方向跟随
                    if (strFirst === "1" || strFirst === "5" || strFirst === "2") {
                        //顶部
                        tar_t = tri_t - (tar_h - tri_h) / 2 + off_y;
                    } else {
                        //底部
                        tar_t = tri_t - (tar_h - tri_h) + off_y;
                    }

                    if (strFirst === "1" || strFirst === "8" || strFirst === "4") {
                        //左侧
                        tar_l = tri_l - tar_w - off_x - cor_w;
                        cor_l = tri_l - cor_w - off_x - 1;
                    } else {
                        //右侧
                        tar_l = tri_l + tri_w - off_x + cor_w;
                        cor_l = tri_l + tri_w + off_x + 1;
                    }
                    cor_t = pos.top - (cor_h - tri_h) / 2;
                } else {
                    tar_l = tri_l + off_x;
                    tar_t = tri_t + off_y;
                }

            } else {
                switch (strNewDirect) {
                    case "top": {
                        tar_t = tri_t - off_y - tar_h - cor_h;
                        if (strFirst == "1") {
                            tar_l = tri_l - off_x;
                        } else if (strFirst === "5") {
                            tar_l = tri_l - (tar_w - tri_w) / 2 - off_x;
                        } else {
                            tar_l = tri_l - (tar_w - tri_w) - off_x;
                        }
                        cor_t = tri_t - cor_h - off_y - 1;
                        cor_l = tri_l - (cor_w - tri_w) / 2;
                        break;
                    }
                    case "right": {
                        tar_l = tri_l + tri_w + off_x + cor_w;
                        if (strFirst == "2") {
                            tar_t = tri_t + off_y;
                        } else if (strFirst === "6") {
                            tar_t = tri_t - (tar_h - tri_h) / 2 + off_y;
                        } else {
                            tar_t = tri_t - (tar_h - tri_h) + off_y;
                        }
                        cor_l = tri_l + tri_w + off_x + 1;
                        cor_t = tri_t - (cor_h - tri_h) / 2;
                        break;
                    }
                    case "bottom": {
                        tar_t = tri_t + tri_h + off_y + cor_h;
                        if (strFirst == "4") {
                            tar_l = tri_l + off_x;
                        } else if (strFirst === "7") {
                            tar_l = tri_l - (tar_w - tri_w) / 2 + off_x;
                        } else {
                            tar_l = tri_l - (tar_w - tri_w) + off_x;
                        }
                        cor_t = tri_t + tri_h + off_y + 1;
                        cor_l = tri_l - (cor_w - tri_w) / 2;
                        break;
                    }
                    case "left": {
                        tar_l = tri_l - tar_w - off_x - cor_w;
                        if (strFirst == "2") {
                            tar_t = tri_t - off_y;
                        } else if (strFirst === "8") {
                            tar_t = tri_t - (tar_h - tri_h) / 2 - off_y;
                        } else {
                            tar_t = tri_t - (tar_h - tri_h) - off_y;
                        }
                        cor_l = tar_l + tar_w - 1;
                        cor_t = tri_t + (tri_h - cor_h) / 2;
                        break;
                    }
                }
            }
            //尖角的显示
            if (cor_h && cor_w && this.corner) {
                this.corner.css({
                    left: cor_l+this.s.offsets.x,
                    top: cor_t+this.s.offsets.y,
                    zIndex: this.s.zIndex + 1
                });
            }
            //浮动框显示
            this.target.css({
                position: "absolute",
                left: tar_l,
                top: tar_t,
                zIndex: this.s.zIndex
            });
            return this;
        },
        createSharp: function (dir) {
            var bgColor, bdColor, color1 = "", color2 = "";
            var objReverse = {
                left: "right",
                right: "left",
                bottom: "top",
                top: "bottom"
            }, dirReverse = objReverse[dir] || "top";

            if (this.target) {
                bgColor = this.target.css("background-color");
                if (parseInt(this.target.css("border-" + dirReverse + "-width")) > 0) {
                    bdColor = this.target.css("border-" + dirReverse + "-color");
                } 
                
                if (bdColor && bdColor !== "transparent") {
                    color1 = 'style="color:' + bdColor + ';"';
                } else {
                    color1 = 'style="display:none;"';
                }
                if (bgColor && bgColor !== "transparent") {
                    color2 = 'style="color:' + bgColor + ';"';
                } else {
                    color2 = 'style="display:none;"';
                }
            }

            var html = '<div id="floatCorner_' + dir + '" class="float_corner float_corner_' + dir + '">' +
					'<span class="corner corner_1" ' + color1 + '>◆</span>' +
					'<span class="corner corner_2" ' + color2 + '>◆</span>' +
				'</div>';
            if (!$("#floatCorner_" + dir).size()) {
                $("body").append($(html));
            }
            this.corner = $("#floatCorner_" + dir);
            return this;
        },
        targetHold: function () {
            if (this.s.hoverHold) {
                var delay = parseInt(this.s.hideDelay, 10) || 200;
                if (this.target) {
                    this.target.hover(function () {
                        o.flagDisplay = true;
                    }, function () {
                        if (o.timerHold) {
                            clearTimeout(o.timerHold);
                        }
                        o.flagDisplay = false;
                        o.targetHold();
                    });
                }

                o.timerHold = setTimeout(function () {
                    o.displayDetect.call(o);
                }, delay);
            } else {
                this.displayDetect();
            }
            return this;
        },
        loading: function () {
            this.target = $('<div><img src="'+staticFileRoot + '/PortalSite2/Images/loading.gif/></div>');
            this.targetShow();
            this.target.removeData("width").removeData("height");
            return this;
        },
        displayDetect: function () {
            //显示与否检测与触发
            if (!this.flagDisplay && this.display) {
                this.targetHide();
                this.timerHold = null;
            }
            return this;
        },
        targetShow: function () {
            o.cornerClear();
            this.display = true;
            this.container().setWidth().position();
            this.target.show();
            if ($.isFunction(this.s.showCall)) {
                this.s.showCall.call(this.trigger, this.target);
            }
            return this;
        },
        targetHide: function () {
            this.display = false;
            this.targetClear();
            this.cornerClear();
            if ($.isFunction(this.s.hideCall)) {
                this.s.hideCall.call(this.trigger);
            }
            this.target = null;
            this.trigger = null;
            this.s = {};
            this.targetProtect = false;
            return this;
        },
        targetClear: function () {
            if (this.target) {
                if (this.target.data("width")) {
                    this.target.removeData("width").removeData("height");
                }
                if (this.targetProtect) {
                    //保护孩子
                    this.target.children().hide().appendTo($("body"));
                }
                this.target.unbind().hide();
            }
        },
        cornerClear: function () {
            if (this.corner) {
                //使用remove避免潜在的尖角颜色冲突问题
                this.corner.remove();
            }
        },
        target: null,
        trigger: null,
        s: {},
        cacheData: {},
        targetProtect: false
    };

    $.powerFloat = {};
    $.powerFloat.hide = function () {
        o.targetHide();
    };
    $.powerFloat.refresh = function () {
        if (o.target) {
            o.targetShow();
        }
    }
    var defaults = {
        width: "auto", //可选参数：inherit，数值(px)
        offsets: {
            x: 0,
            y: 0
        },
        zIndex: 999,

        eventType: "hover", //事件类型，其他可选参数有：click, focus

        showDelay: 0, //鼠标hover显示延迟
        hideDelay: 0, //鼠标移出隐藏延时

        hoverHold: true,
        hoverFollow: false, //true或是关键字x, y

        targetMode: "common", //浮动层的类型，其他可选参数有：ajax, list, remind
        target: null, //target对象获取来源，优先获取，如果为null，则从targetAttr中获取。
        targetAttr: "rel", //target对象获取来源，当targetMode为list时无效

        container: null, //转载target的容器，可以使用"plugin"关键字，则表示使用插件自带容器类型
        reverseSharp: false, //是否反向小三角的显示，默认ajax, remind是显示三角的，其他如list和自定义形式是不显示的

        position: "4-1", //trigger-target
        edgeAdjust: true, //边缘位置自动调整

        showCall: $.noop,
        hideCall: $.noop

    };
})(jQuery);
/** 
* 高亮显示关键字, 构造函数 
* @param {} colors 颜色数组，其中每个元素是一个 '背景色,前景色' 组合 
*/  
(function () {
    var Highlighter = function (colors) {
        this.colors = colors;
        if (this.colors == null) {
            //默认颜色  
            this.colors = ['#ffff00,#000000', '#dae9d1,#000000', '#eabcf4,#000000',
            '#c8e5ef,#000000', '#f3e3cb, #000000', '#e7cfe0,#000000',
            '#c5d1f1,#000000', '#deeee4, #000000', '#b55ed2,#000000',
            '#dcb7a0,#333333', '#7983ab,#000000', '#6894b5, #000000'];

            // ^ $ . * + ? = ! : | \ / ( ) [ ] { }
            this.reserveKeywords = ['\\', '^', '$', '.', '*', '+', '?', '=', '!', ':', '|', '\/', '(', ')', '[', ']', '{', '}'];
        }
    };

    /** 
    * 高亮显示关键字 
    * @param {} node    html element 
    * @param {} keywords  关键字， 多个关键字可以通过空格隔开， 其中每个关键字会以一种颜色显式 
    *  
    * 用法： 
    * var hl = new Highlighter(); 
    * hl.highlight(document.body, '这个 世界 需要 和平'); 
    */
    Highlighter.prototype.highlight = function (node, keywords) {
        if (!keywords || !node || !node.nodeType || node.nodeType != 1)
            return;

        keywords = this.parsewords(keywords);
        if (keywords == null)
            return;

        for (var i = 0; i < keywords.length; i++) {
            this.colorword(node, keywords[i]);
        }
    };

    /** 
    * 对所有#text的node进行查找，如果有关键字则进行着色 
    * @param {} node 节点 
    * @param {} keyword 关键字结构体，包含了关键字、前景色、背景色 
    */
    Highlighter.prototype.colorword = function (node, keyword) {
        for (var i = 0; i < node.childNodes.length; i++) {
            var childNode = node.childNodes[i];

            if (childNode.nodeType == 3) {
                //childNode is #text
                var k = keyword.word;
                for (var j = 0; j < this.reserveKeywords.length; j++) {
                    k = k.replace(new RegExp("\\" + this.reserveKeywords[j], "g"), '\\' + this.reserveKeywords[j]);
                }
                //var re = new RegExp(keyword.word, 'i');
                var re = new RegExp(k, 'i');
                if (childNode.data.search(re) == -1) continue;
                //re = new RegExp(keyword.word, 'gi');
                re = new RegExp('(' + k + ')', 'gi');
                var forkNode = document.createElement('span');
                forkNode.setAttribute("style", "margin:0;padding:0;border:0 none;");
                //forkNode.innerHTML = childNode.data.replace(re, '<span style="background-color:'+keyword.bgColor+';color:'+keyword.foreColor+'" mce_style="background-color:'+keyword.bgColor+';color:'+keyword.foreColor+'">$1</span>');  
                forkNode.innerHTML = childNode.data.replace(re, '<span style="color:#cb0000;margin:0;padding:0;border:0 none;" mce_style="color:#cb0000;margin:0;padding:0;border:0 none;">$1</span>');
                node.replaceChild(forkNode, childNode);
            }
            else if (childNode.nodeType == 1) {
                //childNode is element  
                this.colorword(childNode, keyword);
            }
        }
    };

    /** 
    * 将空格分隔开的关键字转换成对象数组 
    * @param {} keywords 
    * @return {} 
    */
    Highlighter.prototype.parsewords = function (keywords) {
        keywords = keywords.replace(/\s+/g, ' ');
        keywords = keywords.split(' ');
        if (keywords == null || keywords.length == 0)
            return null;

        var results = [];
        for (var i = 0; i < keywords.length; i++) {
            var keyword = {};
            var color = this.colors[i % this.colors.length].split(',');
            keyword.word = keywords[i];
            keyword.bgColor = color[0];
            keyword.foreColor = color[1];
            results.push(keyword);
        }
        return results;
    };

    /** 
    * 按照字符串长度，由长到短进行排序 
    * @param {} list 字符串数组 
    */
    Highlighter.prototype.sort = function (list) {
        list.sort(function (e1, e2) {
            return e1.length < e2.length;
        });
    };
    window.Highlighter = Highlighter;
})();
/*
* DateInput zhangjingwei V1.0
* Released under the MIT, BSD, and GPL Licenses.
*/

(function ($, undefined) {

    /* TODO: 
    *  剔除键盘功能、选择日期、弹出速度、字符国际化、休息日样式
    *  增加双日历
    */

    $.tools = $.tools || { version: '1.3' };

    var instances = [],
         tool,
         LABELS = {};

    tool = $.tools.dateinput = {

        conf: {
            format: 'yyyy-mm-dd',
            monthRange: [0, 12],
            lang: 'zh-cn',
            offset: [0, 0],
            firstDay: 0, // The first day of the week, Sun = 0, Mon = 1, ...
            min: 0,
            max: undefined,
            trigger: 0,
            toggle: 0,
            editable: 0,
            houseData: null,
            mindate: null,
            editable: true,
            bookAck: 1,
            checkin: true,  // The date is checkin or checkout
            showActionBtns: true,
            css: {
                prefix: 'cal',
                input: 'date',

                // ids
                root: 0,
                head: 0,
                title: 0,
                prev: 0,
                next: 0,
                days: 0,

                body: 0,
                weeks: 0,
                today: 0,
                current: 0,

                // classnames
                week: 0,
                off: "disabled",
                sunday: 0,
                focus: "current",
                disabled: "disabled",
                deleted: "delete",
                trigger: 0
            }
        },

        localize: function (language, labels) {
            $.each(labels, function (key, val) {
                labels[key] = val.split(",");
            });
            LABELS[language] = labels;
        }

    };
    //@配置支持其他语言映射表
    // 多语言支持
    tool.localize("zh-cn", {
        months: '1月,2月,3月,4月,5月,6月,7月,8月,9月,10月,11月,12月',
        shortMonths: '1,2,3,4,5,6,7,8,9,10,11,12',
        days: '星期日,星期一,星期二,星期三,星期四,星期五,星期六',
        shortDays: '日,一,二,三,四,五,六'
    });


    //{{{ private functions


    // @return amount of days in certain month
    function dayAm(year, month) {
        return new Date(year, month + 1, 0).getDate();
    }

    function zeropad(val, len) {
        val = '' + val;
        len = len || 2;
        while (val.length < len) { val = "0" + val; }
        return val;
    }

    // thanks: http://stevenlevithan.com/assets/misc/date.format.js 
    var Re = /d{1,4}|m{1,4}|yy(?:yy)?|"[^"]*"|'[^']*'/g, tmpTag = $("<a/>");

    function format(date, fmt, lang) {
        var d = date.getDate(),
            D = date.getDay(),
            m = date.getMonth(),
            y = date.getFullYear(),

            flags = {
                d: d,
                dd: zeropad(d),
                ddd: LABELS[lang].shortDays[D],
                dddd: LABELS[lang].days[D],
                m: m + 1,
                mm: zeropad(m + 1),
                mmm: LABELS[lang].shortMonths[m],
                mmmm: LABELS[lang].months[m],
                yy: String(y).slice(2),
                yyyy: y
            };

        var ret = fmt.replace(Re, function ($0) {
            return $0 in flags ? flags[$0] : $0.slice(1, $0.length - 1);
        });

        // a small trick to handle special characters
        return tmpTag.html(ret).html();

    }

    function integer(val) {
        return parseInt(val, 10);
    }

    function isSameDay(d1, d2) {
        return d1.getFullYear() === d2.getFullYear() &&
            d1.getMonth() == d2.getMonth() &&
            d1.getDate() == d2.getDate();
    }

    function compareDate(date1, date2) {
        date1.setHours(0, 0, 0, 0);
        date2.setHours(0, 0, 0, 0);
        if (date1.getTime() < date2.getTime()) {
            return false;
        } else {
            return true;
        }
    }
    function parseDate(val, date) {
        if (val === undefined) { return; }
        if (val.constructor == Date) { return val; }

        if (typeof val == 'string') {

            // rfc3339?
            var els = val.split("-");
            if (els.length == 3) {
                return new Date(integer(els[0]), integer(els[1]) - 1, integer(els[2]));
            }

            // invalid offset
            if (!(/^-?\d+$/).test(val)) { return; }

            // convert to integer
            val = integer(val);
        }

        date.setDate(date.getDate() + val);
        return date;
    }


    function Dateinput(input, conf) {
        // variables
        var self = this,
             now = parseDate(input.val()) || conf.value || new Date,
			 yearNow = now.getFullYear(),
             monthNow = now.getMonth(),
             css = conf.css,
             labels = LABELS[conf.lang],
             root = $(".m-calendar"),
             title = root.find(".calendar-head"),
             trigger,
             pm, nm,
             currYear, currMonth, currDay,
             value = input.attr("value") || conf.value || input.val(),
             min = input.attr("min") || conf.min,
             max = input.attr("max") || conf.max,
             opened,
             scrolltimer,
             selectedCheckinDate,
             selectedCheckoutDate,
             isCheckinDateSetted,
             isCheckoutDateSetted;
        // zero min is not undefined     
        if (min === 0) { min = "0"; }
        // use sane values for value, min & max
        value = parseDate(value) || now;
        //min，max使用来设置日历控件的现实范围
        min = parseDate(min || new Date(yearNow + Math.floor((monthNow + conf.monthRange[0]) / 12), monthNow + conf.monthRange[0] % 12, 1), value);
        max = parseDate(max || new Date(yearNow + Math.floor((monthNow + conf.monthRange[1]) / 12), monthNow + conf.monthRange[1] % 12, 0), value);
        var fire = input.add(self); //将构造函数new对象加入到jquery对象中.

        // construct layout
        /*
        * 将原来一次绘制日历的方式分为两个部分
        * 先绘制外围DOM节点
        * 日历部分构件完成后，插入到外围节点中
        */
        if (!root.length) { //如果是第一次使用控件，则先创建外部html结构

            root = $('<div class="m-calendar">\
                    <div class="calendar-btn"><i class="cal-prev-btn" title="上个月"></i><i class="cal-next-btn" title="下个月"></i><i class="cal-close-btn" title="关闭"></i></div>\
                    <div class="calendar-head"><h2></h2></div>\
                    <div class="calendar-body"><div class="cal-table-list"></div></div>\
                    </div>');
            root.hide().css("position", "absolute");

            $("body").append(root);

        }
        function select(date, conf, e) {
            // current value
            value = date;
            currYear = date.getFullYear();
            currMonth = date.getMonth();
            currDay = date.getDate();

            // beforChange
            e = e || $.Event("api");
            e.type = "beforeChange";

            fire.trigger(e, [date]);
            if (e.isDefaultPrevented()) { return; }

            // formatting           
            input.val(format(date, conf.format, conf.lang));

            // change
            e.type = "change";
            fire.trigger(e, [date]);

            // store value into input
            input.data("date", date);

            self.hide(e);
        }


        function onShow(ev) {

            ev.type = "onShow";
            fire.trigger(ev);

            // click outside dateinput
            /*  $(document).bind("click.d", function (e) {
                  var el = e.target;
  
                  if (!$(el).parents(".m-calendar").length && el != input[0]) {
                      self.hide(e);
                  }
  
              });*/
        }
        //}}}

        // 获取所在月份的日历HTML
        function getCalHtml(year, month, day) {
            var date = integer(month) >= -2 ? new Date(integer(year), integer(month), integer(day == undefined || isNaN(day) ? 1 : day)) : year || value;//,
            //noOpen = noOpen ? true : false;
            var dd, $td, calData;
            if (date < min) {
                date = min;
            } else if (date > max) {
                date = max;
            }

            if (typeof year == 'string') { date = parseDate(year); }

            year = date.getFullYear(),
            month = date.getMonth(),
            day = date.getDate();

            // roll year & month
            if (month == -1) {
                month = 11;
                year--;
            } else if (month == 12) {
                month = 0;
                year++;
            }

            currMonth = month;
            currYear = year;
            currDay = day;

            var $calendarRoot = $("<div class='cal-content'><table><thead><tr/></thead><tbody></tbody></table></div>"),
                    days = $calendarRoot.find("thead tr"),
                    weeks = $calendarRoot.find("tbody");

            // days of the week
            for (var d = 0; d < 7; d++) {
                days.append($("<th/>").text(labels.shortDays[(d + conf.firstDay) % 7]));
            }
            // var $calendarNextRoot = $calendarRoot.clone();
            // pm.add(nm).removeClass(css.disabled);  //删除向前向后按钮disable状态
            var tmp = new Date(year, month, 1 - conf.firstDay), begin = tmp.getDay(), days = dayAm(year, month);
            if (conf.houseData) {
                if ((year - min.getFullYear()) == 0) {
                    calData = conf.houseData[month - conf.mindate.getMonth()];
                } else {
                    calData = conf.houseData[month + 12 - conf.mindate.getMonth()];
                }
            }
            for (var j = 0, num; j < 42; j++) {
                var noInventory = false;
                if (j % 7 == 0) {
                    var $curRow = $("<tr/>").appendTo(weeks);
                }
                $td = $("<td/>");
                if (j < begin || j >= begin + days) {
                    num = "";
                    dd = null;
                } else {
                    num = j - begin + 1;
                    dd = new Date(year, month, num);
                }

                if (num && calData) {
                    if (!compareDate(dd, new Date()) || dd > max) {
                        $td.html('<p><span class="date-box">' + num + '</span></p>');
                        $td.addClass("past-date");
                    } else if (calData.length && calData[num - 1] && calData[num - 1][0]) {
                        if (calData[num - 1][1] == -1) {
                            noInventory = true;
                        } else {
                            $td.html('<div class="defaultInfo"><p>' +
                                        '<span class="price-box"><dfn>￥</dfn>' + calData[num - 1][1] + '</span>' +
                                        '<span class="date-box">' + num + '</span>' +
                                    '</p>' +
                                    '<p class="room-text">还有' + calData[num - 1][2] + '套</p></div>' +
                                    '<div class="actionBtns" style="display:none;">' +
                                        '<span class="checkinBtn">入住</span><span class="checkoutBtn">退房</span>' +
                                    '</div>').data("curDate", new Date(year, month, num));
                            $td.addClass("available-date");
                        }
                    }
                    else {
                        noInventory = true;
                    }

                    if (noInventory) {
                        var roomText = "";
                        if (calData.length) {
                            if (calData[num - 1][2] < 1) {
                                roomText = "无房";
                            } else {
                                roomText = "暂不可订";
                            }
                        }
                        else {
                            roomText = "暂不可订";
                        }

                        $td.html('<div class="defaultInfo"><p><span class="date-box">' + num + '</span></p><p class="room-text">' + roomText + '</p></div>' +
                                    '<div class="actionBtns" style="display:none;">' +
                                            '<span class="checkoutBtn">退房</span>' +
                                        '</div>').data("curDate", new Date(year, month, num));
                        $td.addClass("default-date");
                    }
                } else {
                    $td.addClass("default-date");
                }
                //if (!$td.hasClass("past-date") && (dd >= parseDate(conf.startDate) && dd < parseDate(conf.endDate))) {
                //    $td.addClass("activation");
                //}
                $curRow.append($td);
            }
            return $calendarRoot;
        }

        //给构造函数new出的对象绑定一些方法
        $.extend(self, {


            /**
            *   @public
            *   展开日历
            */
            show: function (e) {
                if (root.find("div.calendar-tips").length === 0) {
                    root.append('<div class="calendar-tips"></div>');
                }
                var $calendarTips = root.find("div.calendar-tips").html("");
                var bookAck = parseInt(input.attr("data-expressbooking"), 10);
                if (!bookAck) {
                    $calendarTips.append('<div><i class="icon"></i>该公寓下单后还需管理公司确认是否有房</div>');
                }
                if (conf.tips) {
                    $calendarTips.append('<div><i class="icon"></i>' + conf.tips + '</div>');
                }
                if ($calendarTips.children().length == 0) {
                    root.find("div.calendar-tips").remove();
                }
                if (input.attr("readonly") || input.attr("disabled") || opened) { return; }

                // onBeforeShow
                e = e || $.Event();
                e.type = "onBeforeShow";
                fire.trigger(e);
                if (e.isDefaultPrevented()) { return; }

                $.each(instances, function () {
                    this.hide();
                });

                // prev / next month
                pm = root.find(".cal-prev-btn").unbind("click").click(function (e) {
                    if (!pm.hasClass("prev-btn-dis")) {
                        self.addMonth(-1);
                    }
                    return false;
                });

                nm = root.find(".cal-next-btn").unbind("click").click(function (e) {
                    if (!nm.hasClass("next-btn-dis")) {
                        self.addMonth(1);
                    }
                    return false;
                });

                root.find(".cal-close-btn").unbind("click").click(function () {
                    self.hide();
                });
                selectedCheckinDate = parseDate(conf.startDate);
                selectedCheckoutDate = parseDate(conf.endDate);
                isCheckoutDateSetted = false;
                isCheckinDateSetted = false;

                if (conf.showActionBtns) {
                    root.off("click", ".checkinBtn").on("click", ".checkinBtn", function () {
                        self.setCheckinDate($(this).closest("td").data("curDate"));
                    }).off("click", ".checkoutBtn").on("click", ".checkoutBtn", function () {
                        self.setCheckoutDate($(this).closest("td").data("curDate"));
                    }).off("mouseenter", ".available-date, .default-date").on("mouseenter", ".available-date, .default-date", function () {
                        $(this).children(".actionBtns").show().siblings().hide();
                    }).off("mouseleave", ".available-date, .default-date").on("mouseleave", ".available-date, .default-date", function () {
                        $(this).children(".defaultInfo").show().siblings().hide();
                    });
                }

                // set date
                self.setValue(value);

                // show calendar
                /*       var pos = input.offset();
            
                       // iPad position fix
                       if (/iPad/i.test(navigator.userAgent)) {
                           pos.top -= $(window).scrollTop();
                       }
            
                       var bodyWidth = $(document.body).outerWidth(true);
                       var posLeft = pos.left + conf.offset[1] + root.outerWidth(true);
                       if ((posLeft - bodyWidth) > 0) {
                           posLeft = posLeft - (posLeft - bodyWidth)
                       }
            
                       root.css({
                           top: pos.top + input.outerHeight({ margins: true }) + conf.offset[0],
                           left: posLeft - root.outerWidth(true)
                       });*/
                root.css({
                    top: ($(window).height() - root.outerHeight()) / 2 + $(window).scrollTop(),
                    left: ($(window).width() - root.outerWidth()) / 2 + $(window).scrollLeft()
                });
                $.mask.load({
                    color: "#000",
                    opacity: 0.6,
                    closeOnClick: false
                }, root);

                root.show();
                onShow(e);

                $(window).bind("resize.dateinput", function () {
                    var pos = input.offset(),
                     bodyWidth = $(document.body).outerWidth(true),
                     posLeft = pos.left + conf.offset[1] + root.outerWidth(true);

                    if ((posLeft - bodyWidth) > 0) {
                        posLeft = posLeft - (posLeft - bodyWidth)
                    }

                    root.css({
                        top: pos.top + input.outerHeight({ margins: true }) + conf.offset[0],
                        left: posLeft - root.outerWidth(true)
                    });
                }).bind("scroll.dateinput", function () {
                    clearTimeout(scrolltimer);
                    scrolltimer = setTimeout(function () {
                        /* var pos = input.offset(),
                              bodyWidth = $(document.body).outerWidth(true),
                              posLeft = pos.left + conf.offset[1] + root.outerWidth(true);
            
                         if ((posLeft - bodyWidth) > 0) {
                             posLeft = posLeft - (posLeft - bodyWidth)
                         }
            
                         root.css({
                             top: pos.top + input.outerHeight({ margins: true }) + conf.offset[0],
                             left: posLeft - root.outerWidth(true)
                         });*/
                        root.css({
                            top: ($(window).height() - root.outerHeight()) / 2 + $(window).scrollTop(),
                            left: ($(window).width() - root.outerWidth()) / 2 + $(window).scrollLeft()
                        });
                    }, 10);
                });
                opened = true;
                return self;
            },

            /**
            *   @public
            *
            *   设置日历输入框的值
            */
            setValue: function (year, month, day) {
                var calHtml = getCalHtml(year, month, day);
                root.find(".calendar-head h2").text(currYear + "." + (currMonth + 1));
                // date picking
                root.find(".cal-table-list").html(calHtml);
                if (new Date(currYear, currMonth, 1) < min) {
                    pm.addClass("prev-btn-dis");
                } else {
                    pm.removeClass("prev-btn-dis");
                }
                if (new Date(currYear, currMonth + 1, 1) > max) {
                    nm.addClass("next-btn-dis");
                } else {
                    nm.removeClass("next-btn-dis");
                }
                return self.updateSelectedDateStatus();
            },

            // 设置日历的值，并且不打开日历
            setValueNoOpen: function (year, month, day) {
                var date = integer(month) >= -2 ? new Date(integer(year), integer(month), integer(day == undefined || isNaN(day) ? 1 : day)) : year || value;//,
                //noOpen = noOpen ? true : false;

                if (date < min) {
                    date = min;
                } else if (date > max) {
                    date = max;
                }

                input.val(format(date, conf.format, conf.lang));
                input.data("date", date);
                value = date;

                return self;
            },

            //}}}

            setMin: function (val, fit) {
                min = parseDate(val);
                if (fit && value < min) { self.setValue(min); }
                return self;
            },

            setMax: function (val, fit) {
                max = parseDate(val);
                if (fit && value > max) { self.setValue(max); }
                return self;
            },

            today: function () {
                return self.setValue(now);
            },

            addDay: function (amount) {
                return this.setValue(currYear, currMonth, currDay + (amount || 1));
            },

            addMonth: function (amount) {
                var targetMonth = currMonth + amount,
                daysInTargetMonth = dayAm(currYear, targetMonth),
                targetDay = currDay <= daysInTargetMonth ? currDay : daysInTargetMonth;

                return this.setValue(currYear, targetMonth, targetDay);
            },

            addYear: function (amount) {
                return this.setValue(currYear + (amount || 2), currMonth, currDay);
            },

            destroy: function () {
                input.add(document).unbind("click.d");
                root.add(trigger).remove();
                input.removeData("dateinput").removeClass(css.input);
                if (original) { input.replaceWith(original); }
            },

            hide: function (duration) {

                if (opened) {

                    // onHide 
                    var e = $.Event();
                    e.type = "onHide";
                    fire.trigger(e);

                    // cancelled ?
                    //         if (e.isDefaultPrevented()) { return; }

                    $(document).unbind("click.d").unbind("keydown.d");
                    root.off("click", ".checkinBtn").off("click", ".checkoutBtn");
                    // do the hide
                    if (duration) {
                        root.fadeOut(duration);
                    } else {
                        root.hide();
                    }
                    opened = false;
                    $.mask.close();
                    $(window).unbind("resize.dateinput").unbind("scroll.dateinput");
                }

                return self;
            },

            getConf: function () {
                return conf;
            },

            getInput: function () {
                return input;
            },

            getCalendar: function () {
                return root;
            },

            getValue: function (dateFormat) {
                return dateFormat ? format(value, dateFormat, conf.lang) : value;
            },

            isOpen: function () {
                return opened;
            },

            setCheckinDate: function (date) {
                if (selectedCheckoutDate && (selectedCheckoutDate <= date || !self.checkInventory(date, selectedCheckoutDate))) {
                    selectedCheckoutDate = null;
                }
                isCheckinDateSetted = true;
                selectedCheckinDate = date;
                self.updateSelectedDateStatus();
                //入离日期都选中后，触发dateConfirmed事件
                if (selectedCheckinDate && selectedCheckoutDate && self.isOpen() && isCheckinDateSetted && isCheckoutDateSetted) {
                    input.trigger("dateConfirmed", { checkinDate: selectedCheckinDate, checkoutDate: selectedCheckoutDate });
                }
                return self;
            },

            setCheckoutDate: function (date) {
                if (selectedCheckinDate && (date <= selectedCheckinDate || !self.checkInventory(selectedCheckinDate, date))) {
                    selectedCheckinDate = null;
                }
                isCheckoutDateSetted = true;
                selectedCheckoutDate = date;
                self.updateSelectedDateStatus();
                //入离日期都选中后，触发dateConfirmed事件
                if (selectedCheckinDate && selectedCheckoutDate && self.isOpen() && isCheckinDateSetted && isCheckoutDateSetted) {
                    input.trigger("dateConfirmed", { checkinDate: selectedCheckinDate, checkoutDate: selectedCheckoutDate });
                }
                return self;
            },

            updateSelectedDateStatus: function () {
                root.find("td.available-date, td.default-date").each(function (i, td) {
                    var curDate = $(td).data("curDate");
                    if (!curDate) {
                        return;
                    }
                    if (selectedCheckinDate && selectedCheckoutDate && curDate.getTime() > selectedCheckinDate.getTime() && curDate.getTime() < selectedCheckoutDate.getTime()) {
                        $(td).removeClass("selectedCheckin selectedCheckout").addClass("durationDate").children(".defaultInfo").show().siblings().hide();
                    } else if (selectedCheckinDate && curDate.getTime() == selectedCheckinDate.getTime()) {
                        $(td).removeClass("durationDate").addClass("selectedCheckin");
                        //$(td).find(".title").text("入住").closest(".checkStatus").show().siblings().hide();
                    } else if (selectedCheckoutDate && curDate.getTime() == selectedCheckoutDate.getTime()) {
                        $(td).removeClass("durationDate").addClass("selectedCheckout");
                        //$(td).find(".title").text("退房").closest(".checkStatus").show().siblings().hide();
                    } else {
                        $(td).removeClass("selectedCheckin selectedCheckout durationDate").children(".defaultInfo").show().siblings().hide();
                    }
                });

                return self;
            },

            checkInventory: function (checkinDate, checkoutDate) {
                //checkinDate、checkoutDate，其中一个没有设置值，则不认为是一个区间，直接返回true
                if (checkinDate && checkoutDate) {
                    var date = new Date(checkinDate.getFullYear(), checkinDate.getMonth(), checkinDate.getDate());
                    for (; date < checkoutDate; date.setDate(date.getDate() + 1)) {
                        var inventory = self.getInventory(date);
                        if (!inventory || inventory <= 0) {
                            return false;
                        }
                    }
                }
                return true;
            },

            getInventory: function (date) {
                var year = date.getFullYear(),
                    month = date.getMonth(),
                    day = date.getDate(),
                    calData;
                // roll year & month
                if (month == -1) {
                    month = 11;
                    year--;
                } else if (month == 12) {
                    month = 0;
                    year++;
                }
                if (conf.houseData) {
                    if ((year - min.getFullYear()) == 0) {
                        calData = conf.houseData[month - conf.mindate.getMonth()];
                    } else {
                        calData = conf.houseData[month + 12 - conf.mindate.getMonth()];
                    }
                    if (calData[day - 1][0]) {
                        return calData[day - 1][1];
                    }
                }
                return 0;
            }
        });

        // callbacks    //这里用于给self绑定事件,在each方法中可以存储遍历的值
        $.each(['onBeforeShow', 'onShow', 'change', 'onHide', 'onEmpty'], function (i, name) {

            // configuration
            if ($.isFunction(conf[name])) {
                $(self).bind(name, conf[name]);
            }

            // API methods              
            self[name] = function (fn) {
                if (fn) { $(self).bind(name, fn); }
                return self;
            };
        });

        // show dateinput & assign keyboard shortcuts
        if (!conf.isDeleg) {
            input.bind("click.d", self.show);
        }

        input.attr({
            "autocomplete": "off",
            "spellcheck": "false",
            "dir": "ltr"//,
            //"draggable": "false"
        })

        // initial value        
        if (parseDate(input.val())) {
            select(value, conf);
        }

    }

    $.fn.dateinputFt = function (conf) {

        // configuration
        conf = $.extend(true, {}, tool.conf, conf);
        // already instantiated
        if (this.data("dateinput")) { return this; }
        var els;

        this.each(function () {
            var el = new Dateinput($(this), conf);
            instances.push(el);
            var input = el.getInput().data("dateinput", el);
            els = els ? els.add(input) : input;
        });

        return els ? els : this;
    };


})(jQuery);
/*
* DateInput zhangjingwei V1.0
* Released under the MIT, BSD, and GPL Licenses.
*/
(function ($, undefined) {

    /* TODO: 
    *  剔除键盘功能、选择日期、弹出速度、字符国际化、休息日样式
    *  增加双日历
    */

    $.tools = $.tools || { version: '1.3' };

    var instances = [],
         tool,
         LABELS = {};

    tool = $.tools.dateinput = {

        conf: {
            format: 'yyyy-mm-dd',
            monthRange: [0, 12],
            lang: 'zh-cn',
            offset: [0, 0],
            firstDay: 0, // The first day of the week, Sun = 0, Mon = 1, ...
            min: 0,
            max: undefined,
            trigger: 0,
            toggle: 0,
            editable: 0,
            houseData: null,
            mindate: null,
            editable: true,
            checkin: true,  // The date is checkin or checkout

            css: {
                prefix: 'cal',
                input: 'date',

                // ids
                root: 0,
                head: 0,
                title: 0,
                prev: 0,
                next: 0,
                days: 0,
                content: 0,
                body: 0,
                weeks: 0,
                today: 0,
                current: 0,

                // classnames
                week: 0,
                off: "disabled",
                sunday: 0,
                focus: "current",
                disabled: "disabled",
                deleted: "delete",
                trigger: 0
            }
        },

        localize: function (language, labels) {
            $.each(labels, function (key, val) {
                labels[key] = val.split(",");
            });
            LABELS[language] = labels;
        }

    };
    //@配置支持其他语言映射表
    // 多语言支持
    tool.localize("zh-cn", {
        months: '1月,2月,3月,4月,5月,6月,7月,8月,9月,10月,11月,12月',
        shortMonths: '1,2,3,4,5,6,7,8,9,10,11,12',
        days: '星期日,星期一,星期二,星期三,星期四,星期五,星期六',
        shortDays: '日,一,二,三,四,五,六'
    });


    //{{{ private functions


    // @return amount of days in certain month
    function dayAm(year, month) {
        return new Date(year, month + 1, 0).getDate();
    }

    function zeropad(val, len) {
        val = '' + val;
        len = len || 2;
        while (val.length < len) { val = "0" + val; }
        return val;
    }

    // thanks: http://stevenlevithan.com/assets/misc/date.format.js 
    var Re = /d{1,4}|m{1,4}|yy(?:yy)?|"[^"]*"|'[^']*'/g, tmpTag = $("<a/>");

    function format(date, fmt, lang) {
        var d = date.getDate(),
            D = date.getDay(),
            m = date.getMonth(),
            y = date.getFullYear(),

            flags = {
                d: d,
                dd: zeropad(d),
                ddd: LABELS[lang].shortDays[D],
                dddd: LABELS[lang].days[D],
                m: m + 1,
                mm: zeropad(m + 1),
                mmm: LABELS[lang].shortMonths[m],
                mmmm: LABELS[lang].months[m],
                yy: String(y).slice(2),
                yyyy: y
            };

        var ret = fmt.replace(Re, function ($0) {
            return $0 in flags ? flags[$0] : $0.slice(1, $0.length - 1);
        });

        // a small trick to handle special characters
        return tmpTag.html(ret).html();

    }

    function integer(val) {
        return parseInt(val, 10);
    }

    function isSameDay(d1, d2) {
        return d1.getFullYear() === d2.getFullYear() &&
            d1.getMonth() == d2.getMonth() &&
            d1.getDate() == d2.getDate();
    }

    function parseDate(val, date) {
        if (val === undefined) { return; }
        if (val.constructor == Date) { return val; }

        if (typeof val == 'string') {

            // rfc3339?
            var els = val.split("-");
            if (els.length == 3) {
                return new Date(integer(els[0]), integer(els[1]) - 1, integer(els[2]));
            }

            // invalid offset
            if (!(/^-?\d+$/).test(val)) { return; }

            // convert to integer
            val = integer(val);
        }

        date.setDate(date.getDate() + val);
        return date;
    }

    //}}}


    function Dateinput(input, conf) {
        // variables
        var self = this,
             now = parseDate(input.val()) || conf.value || new Date,
			 yearNow = now.getFullYear(),
             monthNow = now.getMonth(),
             css = conf.css,
             labels = LABELS[conf.lang],
             root = $("#" + css.root),
             title = root.find("#" + css.title),
             trigger,
             pm, nm,
             currYear, currMonth, currDay,
             value = input.attr("value") || conf.value || input.val(),
             min = input.attr("min") || conf.min,
             max = input.attr("max") || conf.max,
             opened,
             original,
             scrolltimer;
        // zero min is not undefined     
        if (min === 0) { min = "0"; }
        // use sane values for value, min & max
        value = parseDate(value) || now;
        //min，max使用来设置日历控件的现实范围
        min = parseDate(min || new Date(yearNow + Math.floor((monthNow + conf.monthRange[0]) / 12), monthNow + conf.monthRange[0] % 12, 1), value);
        max = parseDate(max || new Date(yearNow + Math.floor((monthNow + conf.monthRange[1]) / 12), monthNow + conf.monthRange[1] % 12, 0), value);

        // Replace built-in date input: NOTE: input.attr("type", "text") throws exception by the browser
        if (input.attr("type") == 'date') {// 如果是原生的date控件，则替换为text控件
            var original = input.clone(),
	          def = original.wrap("<div/>").parent().html(),
	          clone = $(def.replace(/type/i, "type=text data-orig-type"));

            if (conf.value) clone.val(conf.value);   // jquery 1.6.2 val(undefined) will clear val()

            input.replaceWith(clone);
            input = clone;
        }

        input.addClass(css.input);
        //console.log(self);
        var fire = input.add(self); //将构造函数new对象加入到jquery对象中.
        var bookStatus = {
            notCheck: 0,
            canCheckIn: 1,
            canCheckOut: 2,
            curCheckIn: 3,
        };
        var checkInDate;
        var checkOutDate;
        // construct layout
        /*
        * 将原来一次绘制日历的方式分为两个部分
        * 先绘制外围DOM节点
        * 日历部分构件完成后，插入到外围节点中
        */
        if (!root.length) { //如果是第一次使用控件，则先创建外部html结构

            // root
            root = $('<div><a/><a/><div/></div>')
                .hide().css({ position: 'absolute' }).attr("id", css.root).addClass("calendarBox");

            // elements
            root.children() //给初始化的html结构添加class和id属性
                .eq(0).attr("id", css.prev).addClass("calPrev").end()
                .eq(1).attr("id", css.next).addClass("calNext").end()
                    .eq(2).attr("id", css.content);
            root.append('<a href="javascript:void(0)"class="cal-close-btn" title="关闭"></a>');
            $("body").append(root);
        }
        pm = $("#" + css.prev);
        nm = $("#" + css.next);
        /*bind next prev event*/
        //root.off("click", "#" + css.prev).on("click", "#" + css.prev, function () {
        //    if (!$(this).hasClass(css.disabled)) {
        //        self.addMonth(-2);
        //    }
        //    return false;
        //});
        //root.off("click", "#" + css.next).on("click", "#" + css.next, function () {
        //    if (!$(this).hasClass(css.disabled)) {
        //        self.addMonth();
        //    }
        //    return false;
        //});
        ///*bind mouseenter mouseleave event*/
        //root.off("mouseenter").on("mouseenter", "td", function (e) {
        //    var $td = $(this);
        //    var curDate = $td.data("date");
        //    if (!curDate) {
        //        return;
        //    }
        //    if (checkInDate) {
        //        switch (self.checkBook(checkInDate, curDate)) {
        //            case bookStatus.curCheckIn:
        //                self.showTips($td,e);
        //                break;
        //            case bookStatus.canCheckIn:
        //                $td.data("tdTxt", $td.text()).text("入");
        //                break;
        //            case bookStatus.canCheckOut:
        //                $td.data("tdTxt", $td.text()).text("退");
        //                break;
        //            case bookStatus.notCheck:
        //                break;
        //        }
        //    } else {
        //        if (self.getInventory(curDate)) {
        //            $td.data("tdTxt", $td.text()).text("入");
        //        }
        //    }
        //});
        //root.off("mouseleave").on("mouseleave", "td", function () {
        //    var $td = $(this);
        //    if ($td.data("tdTxt") && !$td.hasClass("checkIn")) {
        //        $td.text($td.data("tdTxt"));
        //    }
        //    /*remove tips*/
        //    if ($td.hasClass("checkIn")) {
        //        $td.children(".calendar-small-tips").remove();
        //    }
        //});

        //root.off("click","td").on("click", "td", function () {
        //    var $td = $(this);
        //    var curDate = $td.data("date");
        //    if (checkInDate) {
        //        switch (self.checkBook(checkInDate, curDate)) {
        //            case bookStatus.curCheckIn:
        //                checkInDate = null;
        //                $td.removeClass("checkIn").text($td.data("tdTxt"));
        //                break;
        //            case bookStatus.canCheckIn:
        //                //  $td.data("tdTxt", $td.text()).text("入");
        //                self.updateCalUi();
        //                $td.addClass("checkIn").text("入");
        //                checkInDate = curDate;
        //                break;
        //            case bookStatus.canCheckOut:
        //                self.bookHouse(checkInDate,curDate);
        //                break;
        //            case bookStatus.notCheck:
        //                break;
        //        }
        //    } else {
        //        if (self.getInventory(curDate)) {
        //            $td.addClass("checkIn").text("入");
        //            checkInDate = curDate;
        //        }
        //    }
        //    return false;
        //});
        // layout elements
        var weeks = root.find("#" + css.weeks);  //没发现weeks元素???

        //{{{ pick

        function select(date, conf, e, el) {
            // current value
            value = date;
            currYear = date.getFullYear();
            currMonth = date.getMonth();
            currDay = date.getDate();

            // beforChange
            e = e || $.Event("api");
            e.type = "beforeChange";

            fire.trigger(e, el);
            if (e.isDefaultPrevented()) { return; }

            // formatting           
            input.val(format(date, conf.format, conf.lang));

            // change
            e.type = "change";
            fire.trigger(e, [date]);

            // store value into input
            input.data("date", date);

            self.hide(e);
        }
        //}}}


        //{{{ onShow

        function onShow(ev) {

            ev.type = "onShow";
            fire.trigger(ev);

            // click outside dateinput
            $(document).bind("click.d", function (e) {
                var el = e.target;

                if (!$(el).parents("#" + css.root).length && $(el).attr("id") != css.root && el != input[0] && (!trigger || el != trigger[0])) {
                    self.hide(e);
                }

            });
        }
        //}}}

        // 获取所在月份的日历HTML
        //noOpen 设置为不打开界面
        function getCalHtml(year, month, day, noOpen) {
            var date = integer(month) >= -2 ? new Date(integer(year), integer(month), integer(day == undefined || isNaN(day) ? 1 : day)) : year || value;//,
            //noOpen = noOpen ? true : false;
            var hasNoHouse = false;
            if (date < min) {
                date = min;
            } else if (date > max) {
                date = max;
            }

            if (typeof year == 'string') { date = parseDate(year); }

            year = date.getFullYear(),
            month = date.getMonth(),
            day = date.getDate();

            // roll year & month
            if (month == -1) {
                month = 11;
                year--;
            } else if (month == 12) {
                month = 0;
                year++;
            }

            ////if (!opened || noOpen) {
            ////    select(date, conf);
            ////    return self;
            ////}/* else {
            //    // formatting           
            //    input.val(format(date, conf.format, conf.lang));
            //    input.data("date", date);
            //    value = date;
            //}*/

            currMonth = month;
            currYear = year;
            currDay = day;

            var targetMonth = currMonth + 1,
            daysInTargetMonth = dayAm(currYear, targetMonth),
            targetDay = daysInTargetMonth,
			targetYear = currYear;

            // roll next year & next month
            if (targetMonth == -1) {
                targetMonth = 11;
                targetYear--;
            } else if (targetMonth == 12) {
                targetMonth = 0;
                targetYear++;
            }

            var dateNext = new Date(targetYear, targetMonth, targetDay);

            var $calendarRoot = $("<div class='calendar'><h2/><table><thead><tr/></thead><tbody></tbody></table></div>"),
                    days = $calendarRoot.children().eq(1).children().eq(0).children();

            // days of the week
            for (var d = 0; d < 7; d++) {
                days.append($("<th/>").text(labels.shortDays[(d + conf.firstDay) % 7]));
            }

            var $calendarNextRoot = $calendarRoot.clone();
            pm.add(nm).removeClass(css.disabled);  //删除向前向后按钮disable状态

            $.each([$calendarRoot, $calendarNextRoot], function (i, $n) {
                var d = i ? dateNext : date,
				   title = $n.children().eq(0),//tbody
				   weeks = $n.children().eq(1).children().eq(1),
				   dd,
                   caldata;

                var year = d.getFullYear(),
                month = d.getMonth(),
                day = d.getDate();

                if (conf.houseData) {
                    if ((year - min.getFullYear()) == 0) {
                        caldata = conf.houseData[month - min.getMonth()];
                    } else {
                        caldata = conf.houseData[month + 12 - min.getMonth()];
                    }
                }

                // variables
                var tmp = new Date(year, month, 1 - conf.firstDay), begin = tmp.getDay(),
                     days = dayAm(year, month);
                //prevDays = dayAm(year, month - 1);

                title.html(year + "年" + labels.shortMonths[month] + '月');

                // !begin === "sunday"
                //for (var j = !begin ? -7 : 0, a, num; j < (!begin ? 35 : 42); j++) {
                for (var j = 0, a, num; j < 42; j++) {
                    if (j % 7 == 0) {
                        var $curRow = $("<tr/>").appendTo(weeks);
                    }
                    $td = $("<td/>");

                    //  前后
                    //num = prevDays - begin + j + 1;
                    //date = new Date(year, month - 1, num);
                    //num = j - days - begin + 1;
                    //date = new Date(year, month + 1, num);
                    if (j < begin || j >= begin + days) {
                        $td.addClass(css.off);
                        num = "";
                        dd = null;
                    } else {
                        num = j - begin + 1;
                        dd = new Date(year, month, num);

                        // 对选中日期\今日进行样式处理
                        if (isSameDay(value, dd)) {
                            $td.attr("id", css.current).addClass(css.focus);
                        } else if (isSameDay(now, dd)) {
                            $td.attr("id", css.today);
                        }
                    }

                    // 日期正确则压入
                    $td.text(num).data("date", dd);
                    //if (checkInDate && dd && dd.getTime() === checkInDate.getTime()) {
                    //    $td.data("tdTxt", $td.text()).text("入").addClass("checkIn");
                    //}
                    // 对不可选日期作出样式处理
                    if (min && dd < min && dd != null) {
                        $td.add(pm).addClass(css.disabled);
                        $curRow.append($td);
                        continue;
                    }
                    if (max && dd > max) {
                        $td.add(nm).addClass(css.disabled);
                        $curRow.append($td);
                        continue;
                    }

                    // 对房态进行处理
                    if (num && caldata) {
                        if (caldata[num - 1]) {
                            var houseNum = caldata[num - 1][0];
                            if (houseNum <= 0) {
                                $td.addClass("no-house");
                                hasNoHouse = true;
                            } else {
                                $td.addClass("has-house-status");
                            }
                            //if (type == 0) {
                            //    $td.addClass(css.deleted);
                            //} else {
                            //    if (conf.checkin) {
                            //        if (type == 2 || type == 3) {
                            //            $td.addClass(css.deleted);
                            //        }
                            //    } else {
                            //        if (type == 3 || type == 2) {
                            //            $td.addClass(css.deleted);
                            //        }
                            //    }
                            //}
                        }
                    }
                    $curRow.append($td);
                }
            });

            var tips = hasNoHouse ? '<div style="clear:left;padding:2px 0 0 5px;">当前日历中<span style="color:#f60;">部分日期无房</span></div>' : '<div style="clear:left;padding:2px 0 0 5px;">当前日期全部可住</div>';

            if ($('#calendarTipsSpecified').length > 0 && $('#calendarTipsSpecified').val() != null) {
                tips += '<div style="clear:left;">' + $('#calendarTipsSpecified').val() + '</div>';
            }

            return $("<div/>").append($calendarRoot).append($calendarNextRoot).after(tips);
        }

        //给构造函数new出的对象绑定一些方法
        $.extend(self, {


            /**
            *   @public
            *   展开日历
            */
            show: function (e) {

                if (input.attr("readonly") || input.attr("disabled") || opened) { return; }

                // onBeforeShow
                e = e || $.Event();
                e.type = "onBeforeShow";
                fire.trigger(e);
                if (e.isDefaultPrevented()) { return; }

                $.each(instances, function () {
                    this.hide();
                });
                root.off("click", ".cal-close-btn").on("click", ".cal-close-btn", function () {
                    self.hide();
                });
                root.off("click", "#" + css.prev).on("click", "#" + css.prev, function () {
                    if (!$(this).hasClass(css.disabled)) {
                        self.addMonth(-2);
                    }
                    return false;
                });
                root.off("click", "#" + css.next).on("click", "#" + css.next, function () {
                    if (!$(this).hasClass(css.disabled)) {
                        self.addMonth();
                    }
                    return false;
                });
                /*bind mouseenter mouseleave event*/
                root.off("mouseenter").on("mouseenter", "td", function (e) {
                    var $td = $(this);
                    if ($td.hasClass("disabled")) {
                        return false;
                    }

                    var curDate = $td.data("date");
                    if (!curDate) {
                        return;
                    }

                    if (checkInDate) {
                        switch (self.checkBook(checkInDate, curDate)) {
                            case bookStatus.curCheckIn:
                                self.showTips($td, e);
                                break;
                            case bookStatus.canCheckIn:
                                $td.data("tdTxt", $td.text()).text("入");
                                break;
                            case bookStatus.canCheckOut:
                                $td.data("tdTxt", $td.text()).text("退");
                                break;
                            case bookStatus.notCheck:
                                break;
                        }
                    } else {
                       
                            $td.data("tdTxt", $td.text()).text("入");
                        
                    }
                });
                root.off("mouseleave").on("mouseleave", "td", function () {
                    var $td = $(this);
                    if ($td.data("tdTxt") && !$td.hasClass("checkIn")) {
                        $td.text($td.data("tdTxt"));
                    }
                    /*remove tips*/
                    if ($td.hasClass("checkIn")) {
                        $td.children(".calendar-small-tips").remove();
                    }
                });

                root.off("click", "td").on("click", "td", function () {
                    var $td = $(this);
                    if ($td.hasClass("disabled")) {
                        return false;
                    }

                    var curDate = $td.data("date");
                    if (checkInDate) {
                        switch (self.checkBook(checkInDate, curDate)) {
                            case bookStatus.curCheckIn:
                                checkInDate = null;
                                $td.removeClass("checkIn").text($td.data("tdTxt"));
                                break;
                            case bookStatus.canCheckIn:
                                //  $td.data("tdTxt", $td.text()).text("入");
                                self.updateCalUi();
                                $td.addClass("checkIn").text("入");
                                checkInDate = curDate;
                                break;
                            case bookStatus.canCheckOut:
                                input.trigger("dateConfirmed", { checkinDate: checkInDate, checkoutDate: curDate });
                                break;
                            case bookStatus.notCheck:
                                break;
                        }
                    } else {
                      
                            $td.addClass("checkIn").text("入");
                            checkInDate = curDate;
                      
                    }
                    return false;
                });
                opened = true;

                // set date
                self.setValue(value);

                // show calendar
                var pos = input.offset();

                // iPad position fix
                if (/iPad/i.test(navigator.userAgent)) {
                    pos.top -= $(window).scrollTop();
                }

                var bodyWidth = $(document.body).outerWidth(true);
                var posLeft = pos.left + conf.offset[1] + root.outerWidth(true);
                if ((posLeft - bodyWidth) > 0) {
                    posLeft = posLeft - (posLeft - bodyWidth)
                }

                root.css({
                    top: pos.top + input.outerHeight({ margins: true }) + conf.offset[0],
                    left: posLeft - root.outerWidth(true) * 2
                });

                root.show();
                onShow(e);

                $(window).bind("resize.dateinput", function () {
                    var pos = input.offset(),
                     bodyWidth = $(document.body).outerWidth(true),
                     posLeft = pos.left + conf.offset[1] + root.outerWidth(true);

                    if ((posLeft - bodyWidth) > 0) {
                        posLeft = posLeft - (posLeft - bodyWidth)
                    }

                    root.css({
                        top: pos.top + input.outerHeight({ margins: true }) + conf.offset[0],
                        left: posLeft - root.outerWidth(true) * 2
                    });
                }).bind("scroll.dateinput", function () {
                    clearTimeout(scrolltimer);
                    scrolltimer = setTimeout(function () {
                        var pos = input.offset(),
                             bodyWidth = $(document.body).outerWidth(true),
                             posLeft = pos.left + conf.offset[1] + root.outerWidth(true);

                        if ((posLeft - bodyWidth) > 0) {
                            posLeft = posLeft - (posLeft - bodyWidth)
                        }

                        root.css({
                            top: pos.top + input.outerHeight({ margins: true }) + conf.offset[0],
                            left: posLeft - root.outerWidth(true) * 2
                        });
                    }, 10);
                });

                return self;
            },

            /**
            *   @public
            *
            *   设置日历输入框的值
            */
            setValue: function (year, month, day, noOpen) {
                var calHtml = getCalHtml(year, month, day, noOpen);
                $("#" + css.content).html(calHtml);
                // date picking
                //$("#calcontent").html(calHtml).find("td").unbind("click").bind("click", function (e) {
                //    var el = $(this);
                //    if (!(el.hasClass(css.disabled) || el.hasClass(css.deleted))) {
                //        $("#" + css.current).removeAttr("id");
                //        el.attr("id", css.current);
                //        select(el.data("date"), conf, e, el);
                //        //console.log(el.data("date"));
                //    }
                //    return false;
                //});

                return self;
            },

            // 设置日历的值，并且不打开日历
            setValueNoOpen: function (year, month, day) {
                var date = integer(month) >= -2 ? new Date(integer(year), integer(month), integer(day == undefined || isNaN(day) ? 1 : day)) : year || value;//,
                //noOpen = noOpen ? true : false;

                if (date < min) {
                    date = min;
                } else if (date > max) {
                    date = max;
                }

                input.val(format(date, conf.format, conf.lang));
                input.data("date", date);
                value = date;

                return self;
            },

            //}}}

            setMin: function (val, fit) {
                min = parseDate(val);
                if (fit && value < min) { self.setValue(min); }
                return self;
            },

            setMax: function (val, fit) {
                max = parseDate(val);
                if (fit && value > max) { self.setValue(max); }
                return self;
            },

            today: function () {
                return self.setValue(now);
            },

            addDay: function (amount) {
                return this.setValue(currYear, currMonth, currDay + (amount || 1));
            },

            addMonth: function (amount) {
                var targetMonth = currMonth + (amount || 2),
                daysInTargetMonth = dayAm(currYear, targetMonth),
                targetDay = currDay <= daysInTargetMonth ? currDay : daysInTargetMonth;

                return this.setValue(currYear, targetMonth, targetDay);
            },

            addYear: function (amount) {
                return this.setValue(currYear + (amount || 2), currMonth, currDay);
            },

            destroy: function () {
                input.add(document).unbind("click.d");
                root.add(trigger).remove();
                input.removeData("dateinput").removeClass(css.input);
                if (original) { input.replaceWith(original); }
            },

            hide: function (e) {

                if (opened) {

                    // onHide 
                    e = $.Event();
                    e.type = "onHide";
                    fire.trigger(e);

                    // cancelled ?
                    if (e.isDefaultPrevented()) { return; }

                    $(document).unbind("click.d").unbind("keydown.d");

                    // do the hide
                    root.hide();
                    opened = false;
                    checkInDate = null;
                    $(window).unbind("resize.dateinput").unbind("scroll.dateinput");
                }

                return self;
            },

            getConf: function () {
                return conf;
            },

            getInput: function () {
                return input;
            },

            getCalendar: function () {
                return root;
            },

            getValue: function (dateFormat) {
                return dateFormat ? format(value, dateFormat, conf.lang) : value;
            },

            isOpen: function () {
                return opened;
            },

            refreshDateInput: function (houseData) {
                conf.houseData = houseData;
            },
            getInventory: function (date) {
                var houseStatus = conf.houseData;
                var now = new Date();
                var year = date.getFullYear(),
                    month = date.getMonth(),
                    day = date.getDate(),
                    calData;
                // roll year & month
                if (month == -1) {
                    month = 11;
                    year--;
                } else if (month == 12) {
                    month = 0;
                    year++;
                }
                if (houseStatus) {
                    if ((year - now.getFullYear()) == 0) {
                        calData = houseStatus[month - now.getMonth()];
                    } else {
                        calData = houseStatus[month + 12 - now.getMonth()];
                    }
                    if (calData[day - 1][0]) {
                        return true;
                    }
                }
                return false;
            },
            checkInventory: function (checkinDate, checkoutDate) {
                //checkinDate、checkoutDate，其中一个没有设置值，则不认为是一个区间，直接返回true
                if (checkinDate && checkoutDate) {
                    var date = new Date(checkinDate.getFullYear(), checkinDate.getMonth(), checkinDate.getDate());
                    for (; date < checkoutDate; date.setDate(date.getDate() + 1)) {
                        var inventory = self.getInventory(date);
                        if (!inventory || inventory <= 0) {
                            return false;
                        }
                    }
                }
                return true;
            },
            checkBook: function (checkInDate, checkOutDate) {
                if (checkInDate && checkOutDate) {
                    checkInDate = new Date(checkInDate.getFullYear(), checkInDate.getMonth(), checkInDate.getDate());
                    checkOutDate = new Date(checkOutDate.getFullYear(), checkOutDate.getMonth(), checkOutDate.getDate());
                    if (checkInDate.getTime() === checkOutDate.getTime()) {
                        return bookStatus.curCheckIn;
                    } else if (checkInDate.getTime() > checkOutDate.getTime()) {
                        return bookStatus.canCheckIn;
                    } else if (checkInDate.getTime() < checkOutDate.getTime()) {
                        return bookStatus.canCheckOut;
                    } else {
                        return bookStatus.notCheck;
                    }
                   
                } 
                   
            },
            showTips: function ($td) {
                $td.css("position","relative");
                $('<div class="calendar-small-tips">点击取消入住</div>').appendTo($td).css({
                    position: "absolute",
                    left: "-32px",
                    top: "-30px"
                });
            },
            updateCalUi: function () {
                var $checkIn = root.find("td.checkIn");
                $checkIn.removeClass("checkIn").text($checkIn.data("tdTxt"));
            }
        });

        // callbacks    //这里用于给self绑定事件,在each方法中可以存储遍历的值
        $.each(['onBeforeShow', 'onShow', 'change', 'beforeChange', 'onHide', 'onEmpty'], function (i, name) {

            // configuration
            if ($.isFunction(conf[name])) {
                $(self).bind(name, conf[name]);
            }

            // API methods              
            self[name] = function (fn) {
                if (fn) { $(self).bind(name, fn); }
                return self;
            };
        });

        // show dateinput & assign keyboard shortcuts
        input.bind("focus.d click.d", self.show).keydown(function (e) {

            var key = e.keyCode;

            // open dateinput with navigation keyw
            if (!opened && $(KEYS).index(key) >= 0) {
                self.show(e);
                return e.preventDefault();
            }

            if (conf.editable) {
                if (opened && (key == 8 || key == 46)) {
                    input.val("");
                    e = e || $.Event();
                    e.type = "onEmpty";
                    fire.trigger(e);
                    if (e.isDefaultPrevented()) { return; }
                }
            }

            if (key == 9) {
                self.hide();
            }

            // allow tab
            return key == 9 ? true : e.preventDefault();

        });

        input.attr({
            "autocomplete": "off",
            "spellcheck": "false",
            "dir": "ltr"//,
            //"draggable": "false"
        })

        // initial value        
        if (parseDate(input.val())) {
            select(value, conf);
        }

    }
    //@自定义一个:date选择器，用于选择日历控件元素
    $.expr[':'].date = function (el) {
        var type = el.getAttribute("type");
        return type && type == 'date' || !!$(el).data("dateinput");
    };


    $.fn.dateinputSingleStatus = function (conf) {

        // already instantiated
        if (this.data("dateinput")) { return this; }

        // configuration
        conf = $.extend(true, {}, tool.conf, conf);

        // CSS prefix @修改日历控件中的类名
        $.each(conf.css, function (key, val) {
            if (!val && key != 'prefix') {
                conf.css[key] = (conf.css.prefix || '') + (val || key);
            }
        });

        var els;

        this.each(function () {
            var el = new Dateinput($(this), conf);
            instances.push(el);
            var input = el.getInput().data("dateinput", el);
            els = els ? els.add(input) : input;
        });

        return els ? els : this;
    };


})(jQuery);
var houseSearch = {
    searchSubmit: function () {
        var self = this;
        var $subBtn = self.$subBtn;
        $subBtn.click(function (ev) {
            // 检查入离日期是否有添写
            var startDate = parseDate($("#startDate").val());
            var endDate = parseDate($("#endDate").val());
           
            if (!startDate || !endDate || compareDate(startDate, endDate))
            {
                var api = $("#startDate").data("dateinput");
                setTimeout(function () { api.show(); }, 200);
                return;
            }

            $subBtn.val('搜索中');
            var url = "";
            ev.preventDefault();
            var arr = ["lh", "lc", "ld", "d"];
            var sData = self.searchData;
            sData.address = self.$adress.val();
            var currentDestination = $.grep(self.cityInfo.citys, function (c) {
                return c.id == self.searchData.DestinationId;
            })[0];
            var isCurrentDuanzu = window["isDuanzu"] && !arr.contains(sData.SearchKeyword);
            var lanmarkPinyin,
                conditionArray = [],
                query_param = [];
            if (window.location.pathname.indexOf("se0") > -1) {
                conditionArray.push({ key: "se", val: "0" });
            }
            if (self.searchType === 1 && sData.SearchKeyword) {
                if (sData.SearchKeyword == "d" && !(parseInt(sData.Value).toString().length == sData.Value.length)) {
                    lanmarkPinyin = sData.Value;
                } else {
                    if (sData.SearchKeyword == "s" && !isCurrentDuanzu) {
                        conditionArray.push({ key: sData.SearchKeyword, val: sData.Note + "_s" + sData.Value });
                    } else {
                        conditionArray.push({ key: sData.SearchKeyword, val: sData.Value });
                    }

                    if (sData.ParentSearchKeyword && !isCurrentDuanzu) {
                        conditionArray.push({ key: sData.ParentSearchKeyword, val: sData.ParentValue, isParent: true });
                    }
                }
            } else if (self.searchType === 2 && sData.address) {
                if ((sData.lat == "" || sData.lng == "")) {
                    query_param.push({ key: "keyword", val: sData.address });
                } else {
                    query_param.push({ key: "adress", val: sData.address });
                    query_param.push({ key: "lat", val: sData.lat });
                    query_param.push({ key: "lng", val: sData.lng });
                }
            }
            if (self.vrchannel) {
                conditionArray.push({ key: "vr", val: self.vrchannel });
            }
            if (query_param.length > 0 || sData.SearchKeyword) {
                query_param.push({ key: "isFromInput", val: "true" });
            }

            if (self.srcPage) {
                query_param.push({ key: "srcPage", val: self.srcPage });
            }
            //self.setCookie();
            self.doRedirect(currentDestination, isCurrentDuanzu, lanmarkPinyin, conditionArray, query_param);
        });
    },

    setCookie: function () {
        var startDate = this.$startDate.val();
        var endDate = this.$endDate.val()
        $.cookie(this.serverDomain + "_PortalContext_StartDate", startDate, { expires: 1, path: '/', domain: this.serverDomain });
        $.cookie(this.serverDomain + "_PortalContext_EndDate", endDate, { expires: 1, path: '/', domain: this.serverDomain });
    },  

    doRedirect: function (currentDestination, isCurrentDuanzu, lanmarkPinyin, conditionArray, query_param) {
        var url = "";
        //如果目的地为区域
        if (currentDestination && currentDestination.scenicspotId > 0 && currentDestination.scenicspot.length > 0) {
            var scenicspotArray = currentDestination.scenicspot.split("|");
            if (isCurrentDuanzu) {
                url += "/duanzu_" + scenicspotArray[0] + "/";
            } else {
                url += "/" + scenicspotArray[0] + "_gongyu/";
            }
            if (isCurrentDuanzu) {
                url += scenicspotArray[1];
            } else {
                url += scenicspotArray[1] + "_s" + currentDestination.scenicspotId;
            }
        } else {
            if (isCurrentDuanzu) {
                url += "/duanzu_" + currentDestination.pinyin + "/";
            } else {
                url += "/" + currentDestination.pinyin + "_gongyu/";
            }
        }
        if (lanmarkPinyin && lanmarkPinyin.length > 0) {
            url += "d-" + lanmarkPinyin + "/";
        }
        var conditionString = "",
            locationString = "";
        $.each(conditionArray, function (i, v) {
            if ($.inArray(v.key, ["a", "s", "c"]) > -1) {
                if (v.key == "s" && (isCurrentDuanzu || !v.isParent)) {
                    //短租的区域搜索url格式为duanzu_beijing/chaoyangqu
                    //非短租的区域搜索url格式为beijing_gongyu/chaoyangqu_s123
                    locationString += v.val;
                } else {
                    locationString += v.key + v.val;
                }
            } else {
                conditionString += v.key + v.val;
            }
        });

        if (isCurrentDuanzu) {
            url += (locationString.length == 0 ? "select" : locationString) + "/" + conditionString;
        } else {
            url += locationString + conditionString;
        }

        if (url.slice(url.length - 1) != "/") {
            url += "/";
        }
        $("#mainSearchForm").find("input.dynamicFormData").remove();
        if (query_param.length > 0) {
            $.each(query_param, function (i, v) {
                $("#mainSearchForm").append("<input class='dynamicFormData' type='hidden' name='" + v.key + "' value='" + v.val + "'>");
            });
        }
        $("#mainSearchForm").attr({ "action": url, "target": "_top" }).trigger("submit");
    },

    addrInputInit: function () {
        var self = this;
        var $destInput = self.$destInput;
        var $adress = self.$adress;
        self.$addressDrop = $("#addressDrop");
        var adressFocusTimeout, desInputFocusTimeOut;
        self.prevValueKwd = $adress.val();
        var keys = {
            ESC: 27,
            TAB: 9,
            RETURN: 13,
            LEFT: 37,
            UP: 38,
            RIGHT: 39,
            DOWN: 40
        };

        $destInput.attr("autocomplete", "off");

        self.searchType = 2;
        $destInput.click(function (ev) {
            //ev.stopPropagation();
            self.prevValue = $(this).val();
        });
        $(document).on("click", function (ev) {
            if ($(ev.target).closest("#cityInput").length === 0 && !$(ev.target).is("#destInput")) {
                $("#cityInput").hide();
            }
            if ($(ev.target).closest("#kwdList").length === 0) {
                $("#kwdList").hide();
            }
            if ($(ev.target).closest("#addressDrop").length === 0) {
                self.$addressDrop.hide();
            }
        });

        $destInput.blur(function () {
            if ($destInput.data("enHide")) {
                $('#cityInput').hide();
                $destInput.val(self.searchData.DestinationName);
            }

            if (desInputFocusTimeOut) {
                clearTimeout(desInputFocusTimeOut);
            }
        });
        //此处有兼容性问题
        $destInput.bind("keydown", function (ev) {
            var $kwdList = $("#kwdList");
            var $curItem = $kwdList.find("a.hover");
            var $listItems = $kwdList.find("a");
            var index = $listItems.index($curItem);
            var lastIndex = $listItems.length - 1;
            if (ev.which == keys.DOWN && $kwdList.is(":visible")) {
                if (index === lastIndex) {
                    $curItem.removeClass("hover");
                    $listItems.first().addClass("hover");
                } else {
                    $curItem.removeClass("hover");
                    $listItems.eq(++index).addClass("hover");
                }
                ev.preventDefault();
            } else if (ev.which == keys.UP && $kwdList.is(":visible")) {
                if (index === 0) {
                    $curItem.removeClass("hover");
                    $listItems.last().addClass("hover");
                } else {
                    $curItem.removeClass("hover");
                    $listItems.eq(--index).addClass("hover");
                }
                ev.preventDefault();
            } else if (ev.which == keys.RETURN && $kwdList.is(":visible")) {
                ev.preventDefault();
                $curItem.trigger("click");
            }
        });

        $destInput.focus(function () {
            self.showCityInput();
            $("#kwdList").hide();
            desInputFocusTimeOut = setTimeout(function () { $destInput.select(); }, 30);
        });

        $destInput.bind("input propertychange", function (ev) {
            var keyWord = $.trim($(this).val());
            if (keyWord === "") {
                $("#cityInput").show();
                $("#kwdList").hide();
            } else if ($.trim(self.prevValue) != keyWord && keyWord != "") {
                $("#cityInput").hide();
                self.prevValue = keyWord;
                self.hasInputWord = true;
                self.$input = $destInput;
                self.destSearch(keyWord);
            }
        });

        $adress.bind("keydown", function (ev) {
            var $kwdList = $("#kwdList");
            var $curItem = $kwdList.find("a.hover");
            var $listItems = $kwdList.find("a");
            var index = $listItems.index($curItem);
            var lastIndex = $listItems.length - 1;
            if (ev.which == keys.DOWN && $kwdList.is(":visible")) {
                if (index === lastIndex) {
                    $curItem.removeClass("hover");
                    $listItems.first().addClass("hover");
                } else {
                    $curItem.removeClass("hover");
                    $listItems.eq(++index).addClass("hover");
                }
            } else if (ev.which == keys.UP && $kwdList.is(":visible")) {
                if (index === 0) {
                    $curItem.removeClass("hover");
                    $listItems.last().addClass("hover");
                } else {
                    $curItem.removeClass("hover");
                    $listItems.eq(--index).addClass("hover");
                }
            } else if (ev.which == keys.RETURN && $kwdList.is(":visible")) {
                ev.preventDefault();
                $curItem.trigger("click");
            }
        });

        $adress.bind("input propertychange", function (ev) {
            var kwd = $.trim($(this).val());
            self.$addressDrop.hide();
            self.searchType = 2;
            if (kwd === "") {
                self.$addressDrop.show();
                $("#kwdList").hide();
            } else if (kwd != $.trim(self.prevValueKwd) && kwd != "") {
                self.prevValueKwd = kwd;
                $("#kwdList").hide();
                clearTimeout(self.delayTimer);
                self.delayTimer = setTimeout(function () {
                    self.$input = $adress;
                    self.kwdSearch(kwd);
                }, 300);
            }
        });

        $adress.bind("click", function (ev) {
            ev.stopPropagation();
            self.prevValueKwd = $(this).val();
            $(this).next().hide();
        });

        //adress textbox获得焦点时显示位置关键词列表
        $adress.focus(function () {
            adressFocusTimeout = setTimeout(function () {
                self.$adress.select();
                self.refreshAddressDrop(true);
            }, 30);
        });

        $adress.bind("blur", function () {
            if (adressFocusTimeout) {
                clearTimeout(adressFocusTimeout);
            }
            if ($adress.data("enHide")) {
                if ($(this).val() == "") {
                    $(this).next().show();
                }
                self.$addressDrop.hide();
            }
        });

        $destInput.data("enHide", true);
        $adress.data("enHide", true);
        $(document).on("mouseover", "#cityInput", function () {
            $destInput.data("enHide", false);
        });

        $(document).on("mouseout", "#cityInput", function () {
            $destInput.data("enHide", true);
        });

        $(document).on("mouseover", "#kwdList", function () {
            $destInput.data("enHide", false);
        });

        $(document).on("mouseout", "#kwdList", function () {
            $destInput.data("enHide", true);
        });

        $(document).on("mouseover", "#addressDrop", function () {
            $adress.data("enHide", false);
        });

        $(document).on("mouseout", "#addressDrop", function () {
            $adress.data("enHide", true);
        });

        //百度搜索初始化
        self.baiduInit();
        if (self.ac) {
            self.ac.setInputValue(self.$adress.val());
        }
        if (self.$adress.val() && self.$adress.val().length > 0) {
            $adress.next().hide();
        }
        self.searchSubmit();
    },

    refreshAddressDrop: function (isShow) {
        var self = this;
        if (self.ac && self.ac.isBMapItemClicked) {
            //百度autocomplete触发的focus不予处理
            self.ac.isBMapItemClicked = false;
            return;
        }
        var destId = self.searchData.DestinationId;
        var url = "/UnitList/GetMark/" + destId + "?isDuanzu=" + window["isDuanzu"] + "&t=" + (new Date()).getTime();
        var ajaxObj = null;
        var addrPos = self.$adress.offset();

        if (self.$addressDrop.length === 0) {
            self.$addressDrop = $('<div id="addressDrop" class="m-add-drop"/>').appendTo("body").css({
                "position": "absolute",
                "display": "none",
                "top": addrPos.top + self.$adress.outerHeight(),
                "left": addrPos.left
            }).on("click", "a", function () {
                var $this = $(this);
                self.searchData.ParentSearchKeyword = null;
                self.searchData.ParentValue = null;
                self.searchData.SearchKeyword = $this.attr("data-type");
                self.searchData.Value = $this.attr("data-val");
                self.searchData.Note = $this.attr("data-pinyin");
                self.prevValueKwd = $this.text();
                self.$adress.val($this.text());
                self.$adress.next().hide();
                self.$addressDrop.hide();
                self.searchType = 1;
                self.$subBtn.click();
            });
            self.resetPosition(self.$adress, $("#addressDrop"));
            $(window).bind("resize.sel", function () {
                self.resetPosition(self.$adress, $("#addressDrop"));
            });
        }
        self.$addressDrop.empty();
        if (self.resCacheData[destId]) {
            self.$addressDrop.html(self.resCacheData[destId]);
            $("#kwdList").hide();
            if (self.resCacheData[destId].length > 0) {
                if (isShow) {
                    self.$addressDrop.show();
                }
                /*
                var css = getPosition();
                $addressDrop.css('left',css.left).show();
                */
            }
        } else {
            if (ajaxObj) {
                ajaxObj.abort();
            }
            ajaxObj = $.get(url, function (data) {
                self.resCacheData[destId] = data;
                ajaxObj = null;
                if (data && data.length > 0) {
                    self.$addressDrop.html(data);
                    if (isShow) {
                        self.$addressDrop.show();
                    }
                    /*
                    var css = getPosition();
                    $addressDrop.css('left',css.left).show();
                    */
                }
                $("#kwdList").hide();
            });
        }
    },
    baiduInit: function () {
        //百度地图API依赖于别的js文件，所以在document ready之后执行
        var self = this;
        $(function () {
            if (!window["BMap"]) {
                return;
            }
            self.ac = new BMap.Autocomplete({
                "input": "adress",
                "location": self.searchData.DestinationName,
                "onSearchComplete": function (s) {
                    self.hasBaiduResult = s.getNumPois() > 0;
                    self.ac.hide();
                }
            });
            var myGeo = new BMap.Geocoder();
            self.ac.addEventListener("onconfirm", function (e) { //鼠标点击下拉列表后的事件
                var _value = e.item.value, v = _value.province + _value.city + _value.district + _value.street + _value.business;
                //防止乱码
                self.ac.setInputValue($("<div/>").html(v).text());
                var cityName = _value.city;
                if (cityName && cityName.length > 1) {
                    if (cityName[_value.city.length - 1] == "市") {
                        cityName = cityName.substring(0, _value.city.length - 1);
                    }
                    var currentDestination = $.grep(self.cityInfo.citys, function (c) {
                        return c.name == cityName;
                    })[0];
                    if (currentDestination) {
                        self.setDestinationVal(currentDestination);
                        myGeo.getPoint(v, function (point) {
                            if (point) {
                                self.searchData.lat = point.lat;
                                self.searchData.lng = point.lng;
                                self.searchData.adress = v;
                                self.searchType = 2;
                            }
                            //触发搜索事件
                            self.$subBtn.click();
                        }, self.searchData.DestinationName);
                    } else {
                        self.resShow("对不起，该地我们还没有公寓", self.$input);
                    }
                } else {
                    self.$subBtn.click();
                }

                self.ac.isBMapItemClicked = true;
            });
            self.ac.setInputValue(self.$adress.val());
        });
    },
    destSearch: function (kwd) {
        var url = "/KeyWordSearch/?keyword=" + encodeURIComponent(kwd);
        var self = this;

        self.getSearchData(url).done(function (res) {
            if (!res || !res.IsSuccess || res.KeyWordSearchInfos.length <= 0) {
                self.resShow("对不起，找不到：" + kwd, self.$input);
                $("#cityInput").hide();
            } else {
                self.resShow(self.resCacheData[url].KeyWordSearchInfos, self.$input);
                $("#cityInput").hide();
            }
        });
    },
    getSearchData: function (url) {
        var self = this;
        if (self.resCacheData[url]) {
            var deffered = $.Deferred();
            deffered.resolve(self.resCacheData[url]);
            return deffered.promise();
        } else {
            if (self.ajaxObj) {
                self.ajaxObj.abort();
            }
            return self.ajaxObj = $.getJSON(url + "&agent=2" + "&time=" + $.now() + "&isDuanzu=" + (window["isDuanzu"] ? "true" : "false"), function (res) {
                if (res.IsSuccess) {
                    self.resCacheData[url] = res;
                }
            });
        }
    },
    kwdSearch: function (kwd) {
        var self = this;
        var url = "/KeyWordSearch/?DestinationId=" + self.searchData.DestinationId + "&keyword=" + encodeURIComponent(kwd);

        self.getSearchData(url).done(function (res) {
            if (!res || !res.IsSuccess || res.KeyWordSearchInfos.length <= 0) {
                if (self.hasBaiduResult && self.ac) {
                    self.ac.show();
                }
            } else {
                self.resShow(res.KeyWordSearchInfos, self.$input);
                $("#addressDrop").hide();
            }
        }).fail(function () {
            if (self.hasBaiduResult && self.ac) {
                self.ac.show();
            }
        });
    },
    resShow: function (resData, $input) {
        var self = this;
        var $kwdList = $("#kwdList");
        var $destInput = self.$destInput;
        var $adress = self.$adress;

        if ($kwdList.length === 0) {
            $kwdList = $('<div id="kwdList" class="m-kwd-list"></div>').appendTo("body");
            $kwdList.css({
                position: "absolute",
                left: $input.offset().left + self.kwdOffset[0] + "px",
                top: $input.offset().top + $input.outerHeight() + self.kwdOffset[1] + "px"
            });

            $kwdList.on("click", "a", function () {
                var kwdData = $(this).data("kwdData");
                //匹配到房屋时直接跳转到详情页
                if (kwdData.ConditionType == "u") {
                    window.open(kwdData.Note);
                    self.clearAdressInput();
                    $kwdList.hide();
                    return;
                }
                if (kwdData.Name && kwdData.ConditionType !== "dd") {
                    $adress.next().hide();
                    self.prevValueKwd = kwdData.Name;
                    $adress.val(kwdData.Name);
                } else {
                    self.clearAdressInput();
                }
                self.searchData = $.extend(true, {}, self.searchData, kwdData);
                self.setDestinationName(kwdData.DestinationName);
                self.searchType = 1;
                $kwdList.hide();
                //含有具体的搜索逻辑就自动搜索，提交
                if (kwdData.Name && kwdData.ConditionType !== "dd") {
                    self.$subBtn.click();
                }
            });

            $kwdList.on("mouseover", "a", function () {
                $kwdList.find("a").removeClass("hover");
                $(this).addClass("hover");
            });

        } else {
            $kwdList.empty();
            $kwdList.css({
                position: "absolute",
                left: $input.offset().left + self.kwdOffset[0] + "px",
                top: $input.offset().top + $input.outerHeight() + self.kwdOffset[0] + "px"
            });
        }

        if (typeof resData === "string") {
            $("<span class='error-info'>" + resData + "</span>").appendTo($kwdList);
        } else {
            var displaywithGroupData = {};
            $.each(resData, function (i, item) {
                var groupItems = displaywithGroupData[item.ConditionType] || [];
                groupItems.push(item);
                displaywithGroupData[item.ConditionType] = groupItems;
            });
            $.each(displaywithGroupData, function (key, valObj) {
                var $groupList = $("<div class='key-g'></div>");
                $.each(valObj, function (index, item) {
                    if (!item.Name) {
                        return;
                    }
                    var liString = '<a><span class="keywordName">' + item.Name;

                    if (item.ConditionType != "dd") {
                        liString += "，" + item.DestinationName;
                    }
                    liString += '</span>';
                    if (index == 0) {
                        liString += '<span class="keywordItem">' + item.ConditiontTypeName + '<i class="i-keyword-' + item.ConditionType + '"></i></span>';
                    }
                    liString += '</a>';
                    $groupList.append($(liString).data("kwdData", item));
                });
                $kwdList.append($groupList);
            });
        }

        $kwdList.find("a").first().addClass("hover");
        if (self.highLighter) {
            self.highLighter.highlight($kwdList[0], $("#adress").val());
        }
        $kwdList.show();
        self.clearBaiduRes();
    },
    clearRes: function () {
        var $kwdList = $("#kwdList");
        $kwdList.empty().hide();
    },
    clearBaiduRes: function () {
        if (this.ac) {
            this.ac.hide();
        }
    },
    clearAdressInput: function () {
        if (this.$adress.val() !== '') {
            this.$adress.val('').next().show();
        }
    },
    setDestinationVal: function (destination) {
        this.prevValue = destination.name;
        this.$destInput.val(destination.name);
        if (this.ac) {
            this.ac.setLocation(destination.name);
        }
        this.searchData.DestinationId = destination.id;
        this.searchData.DestinationName = destination.name;
        this.searchData.DestinationPinyin = destination.pinyin;
        this.refreshAddressDrop(false);
    },
    setDestinationName: function (destinationName) {
        //this.prevValue = destinationName;
        this.$destInput.val(destinationName);
        if (this.ac) {
            this.ac.setLocation(destinationName);
        }
        this.refreshAddressDrop(false);

        if ($("#startDate").val() == "") {
            $("#endDate").val("");
            $("#startDate").val("");
           
            var sep = "-";
            var oDate = minDate.split(sep)
            var bDate = new Date(oDate[0], oDate[1] - 1, oDate[2]);
            var eDate = new Date(oDate[0], oDate[1] - 1, oDate[2] - (-1));

            $("#startDate").data("dateinput").setValue(bDate, null, null, true, true);
            $("#endDate").data("dateinput").setValue(eDate, null, null, true, true);
            $("#startDate").data("dateinput").show();
        }

        //if (this.prevValue != destinationName)
        //{
            
        //    var mindate = parseDate(minDate);
        //    $("#endDate").val("");
        //    $("#startDate").val("");
        //    $("#startDate").data("dateinput").setValue(new Date(minDate), null, null, true, true);
        //    $("#endDate").data("dateinput").setValue(new Date(+mindate + 24 * 3600000), null, null, true, true);
        //    $("#startDate").data("dateinput").show();
            
        //    //$("#endDate").data("dateinput").setValueNoOpen("");
        //    //$("#startDate").data("dateinput").setValue("");
        //}
        this.prevValue = destinationName;
    },
    showCityInput: function () {
        var self = this;
        var $destInput = self.$destInput;
        var baseHtml = '<div id="cityInput" class="select-list"><div class="address_tabs"></div><div class="addr_wrap"></div></div>';
        var $root = null;
        var $addrTab = null;
        var $addrCon = null;
        var cityInputInfo = self.cityInfo;  //此处最好采用传参方式

        function drawCityContent(cityIds, isHide, isGrouping) {
            var citys = cityInputInfo.citys;
            var $cityCon = $("<div/>").addClass("address_content");
            var cityGroup = [];
            $.each(cityIds, function (i, id) {
                $.each(citys, function (j, cityItem) {
                    if (cityItem.id == id) {
                        //热门不分组
                        if (isGrouping) {
                            var firstCharacter = cityItem.pinyin.charAt(0).toUpperCase();
                            if (!cityGroup[firstCharacter]) {
                                var $cityContainer = $("<div class='cityContainer'/>");
                                $cityCon.append($("<div class='groupContainer'/>").append($("<div class='groupTitle'/>").text(firstCharacter)).append($cityContainer));
                                cityGroup[firstCharacter] = $cityContainer;
                            }
                            cityGroup[firstCharacter].append($("<span/>").text(cityItem.name).attr("data-value", cityItem.id).attr("data-pinyin", cityItem.pinyin));
                        } else {
                            $cityCon.append($("<span/>").text(cityItem.name).attr("data-value", cityItem.id).attr("data-pinyin", cityItem.pinyin));
                        }
                    }
                });
            });
            if (isHide) {
                $cityCon.hide();
            }
            $addrCon.append($cityCon);
        }

        if ($("#cityInput").length > 0) {
            $("#cityInput").show();
        } else {
            $root = $(baseHtml);

            $addrTab = $root.children().eq(0);
            $addrCon = $root.children().eq(1);
            $("<span/>").text(cityInputInfo.hotgroup.name).addClass("current").appendTo($addrTab);
            drawCityContent(cityInputInfo.hotgroup.cityids, false, false);

            $.each(cityInputInfo.lettergroups, function (i, item) {
                $("<span/>").text(item.name).appendTo($addrTab);
                drawCityContent(item.cityids, true, true);
            });
            /* $root.css({
                 position: "absolute",
                 left: $destInput.offset().left + self.destOffset[0] + "px",
                 top: $destInput.offset().top + $destInput.outerHeight() + self.destOffset[1] + "px",
                 zIndex: 9999
             });*/
            $addrTab.on("click", "span", function (ev) {
                ev.stopPropagation();
                $addrTab.find("span").removeClass("current");
                $(this).addClass("current");
                $addrCon.children().hide();
                $addrCon.children().eq($(this).index()).show();
            });

            $addrCon.on("click", "span", function (ev) {
                ev.stopPropagation();
                self.searchData.DestinationId = $(this).attr("data-value");
                self.searchData.DestinationName = $(this).text();
                self.searchData.DestinationPinyin = $(this).attr("data-pinyin");
                self.searchData.SearchKeyword = null;
                self.searchData.Value = null;
                self.clearAdressInput();
                self.setDestinationName($(this).text());
                $root.hide();
            });
            $("body").append($root);
            self.resetPosition($destInput, $root);
            $(window).bind("resize.sel", function () {
                self.resetPosition($destInput, $root);
            });
        }
    },
    resetPosition: function (elem, root) {
        var bodyWidth = $(document.body).outerWidth(true);
        var offset = elem.offset(), elemW = elem.innerWidth(), elemH = elem.innerHeight();
        var posLeft = offset.left + root.outerWidth(true) + this.destOffset[0];
        var posTop = offset.top + elem.outerHeight(true) + this.destOffset[1];
        if ((posLeft - bodyWidth) > 0) {
            posLeft = posLeft - (posLeft - bodyWidth)
        }
        root.css({
            position: "absolute",
            left: posLeft - root.outerWidth(true),
            top: posTop,
            zIndex: 9999
        });
    },
    dateInputInit: function ($startDate, $endDate) {
        var self = this;
        var mindate = parseDate(minDate),
          maxdate = parseDate(maxDate);

        $startDate.dateinput({
            min: mindate,
            max: new Date(+maxdate - 24 * 3600000),
            offset: self.dateOffset || [0, 0]
        });

        $endDate.dateinput({
            min: new Date(+mindate + 24 * 3600000),
            max: maxdate,
            offset: self.dateOffset || [0, 0]
        });

        var checkDateApi = $startDate.data("dateinput"),
            leaveDateApi = $endDate.data("dateinput");

        checkDateApi.change(function (event, date) {
            var leaveDay = parseDate(leaveDateApi.getInput().val()),
                 leaveMinDay = new Date(+date + 24 * 3600000);

            //  checkDateApi.getInput().next().hide();

            // 如果未设定离店时间或入住时间大于离店时间
            if (!leaveDay || compareDate(date, leaveDay)) {
                leaveDateApi.setMin(leaveMinDay).setValue(leaveMinDay).show();
            } else if (leaveDay) {
                leaveDateApi.setMin(leaveMinDay);
            }

        });
        leaveDateApi.change(function (event, date) {
            var startDay = parseDate(checkDateApi.getInput().val()),
                 startMaxDay = new Date(+date - 24 * 3600000);

            // leaveDateApi.getInput().next().hide();

            // 如果未设定入住时间或者入住时间大于离店时间
            if (!startDay || compareDate(startDay, date)) {
                checkDateApi.setValue(startMaxDay).show();
            }

        });
    }
};
function parseDate(val, date) {
    if (val === undefined) { return; }
    if (val.constructor == Date) { return val; }

    if (typeof val == 'string') {

        // rfc3339?
        var els = val.split("-");
        if (els.length == 3) {
            return new Date(integer(els[0]), integer(els[1]) - 1, integer(els[2]));
        }

        // invalid offset
        if (!(/^-?\d+$/).test(val)) { return; }

        // convert to integer
        val = integer(val);
    }

    date.setDate(date.getDate() + val);
    return date;
}

function compareDate(date1, date2, type) {
    var date1 = date1.getTime(), date2 = date2.getTime();
    return !type ? date1 - date2 >= 0 : date1 - date2 > 0;
}

function dateGtWeek(date1, date2) {
    return date1.getTime() > date2.getTime() - 7 * 24 * 3600000;
}

function integer(val) {
    return parseInt(val, 10);
}

/*
* 验证时间段是否合法
* 1、离店时间大于入住时间
* 2、离店时间与入住时间是否重复
*/
function getTimeCompare(checkin, checkout, oldtime) {
    return checkout - checkin > 0 && checkin + checkout - timeData[0] - timeData[1] != 0;
}


function changeToLeftTime(leftSeconds) {
    //alert("changeToLeftTime");
    var h = parseInt(leftSeconds / (60 * 60)),
    m = parseInt((leftSeconds - h * 3600) / 60),
    s = leftSeconds % 60;

    h = h > 9 ? h + '' : '0' + h;
    m = m > 9 ? m + '' : '0' + m;
    s = s > 9 ? s + '' : '0' + s;

    return h + ':' + m + ':' + s;
}

/* 卧室数筛选 */
(function ($) {
    // 倒计时
    $('*[leftSeconds]').each(function () {

        var el = $(this), seconds = el.attr('leftSeconds') - 0,

        timer = window.setInterval(function () {
            var s = changeToLeftTime(seconds--);
            el.html(s);
            if (seconds < 0) {
                window.clearInterval(timer);
                timer = null;
                window.location.href = window.location.href;
            }

        }, 1000)
    });
})(jQuery);
// core function
// compare date
// @ add "type" for bug ID:1470
//其他js使用公共函数
function compareDate(date1, date2, type) {
    var date1 = date1.getTime(), date2 = date2.getTime();
    return !type ? date1 - date2 >= 0 : date1 - date2 > 0;
}

Array.prototype.contains = Array.prototype.contains || function (item) {
    var len = this.length;
    while (len--) {
        if (this[len] === item) {
            return true;
        }
    }
    return false;
};

//初始化导航上的tips功能
/*function FloatPanel(srcId, desId, direction, highlightCss) {

    var src = $("#" + srcId), des = $("#" + desId), SHOW = false;
    direction = direction || 'bottom';

    src.bind("mouseenter", function () {
        if (!SHOW) {
            var el = $(this), position = el.offset();

            switch (direction) {

                case "top":
                    des.show().css({ 'top': position.top - des.height(), 'left': position.left, 'z-index': '990', 'position': 'absolute' });
                    break;
                case "left":
                    des.show().css({ 'top': position.top + el.outerHeight(), 'right': position.left, 'z-index': '990', 'position': 'absolute' });
                    break;
                case "middle-left":
                    des.show().css({ 'top': (position.top - (des.outerHeight() - el.outerHeight()) / 2), 'left': position.left - des.outerWidth(), 'z-index': '990', 'position': 'absolute' });
                    break;
                case "right":
                    des.show().css({ 'top': position.top, 'left': position.left + el.outerWidth(), 'z-index': '990', 'position': 'absolute' });
                    break;
                case "middle-right":
                    des.show().css({ 'top': (position.top - (des.outerHeight() - el.outerHeight()) / 2), 'left': position.left + el.outerWidth(), 'z-index': '990', 'position': 'absolute' });
                    break;
                case "right-bottom":
                    des.show().css({ 'top': position.top + el.outerHeight(), left: position.left - (des.outerWidth() - src.outerWidth()), 'z-index': '990', 'position': 'absolute' });
                    break;
                case "middle-bottom":
                    des.show().css({ 'top': position.top + el.outerHeight(), left: position.left - (des.outerWidth() - src.outerWidth()) / 2, 'z-index': '990', 'position': 'absolute' });
                    break;
                case "bottom":
                    des.show().css({ 'top': position.top + el.outerHeight(), 'left': position.left, 'z-index': '990', 'position': 'absolute' });
                    break;

            }

            if (highlightCss) {
                src.addClass(highlightCss);
            }
        }

    }).bind("mouseleave", function (event) {
        var e = $(event.relatedTarget);
        if (e.attr("id") != desId && e.parents("#" + desId).length == 0) {
            SHOW = false;
            if (highlightCss) {
                src.removeClass(highlightCss);
            }
            des.hide();
        }
    });
    des.bind("mouseleave", function (event) {
        var e = $(event.relatedTarget);
        if (e.attr("id") != srcId && e.parents("#" + srcId).length == 0) {
            SHOW = false;
            des.hide();
            if (highlightCss) {
                src.removeClass(highlightCss);
            }
        }
    });
}*/

(function () {
    //订单页初始化功能
    function getUserMessage(url) {
        $("#messageLoading").show();
        $.ajax({
            type: "Get",
            url: url,
            success: function (data) {
                $("#messageLoading").hide();
                $("#userMessage").html(data);
                $("#userMessage #mytujiaPage a").each(function () {
                    $(this).click(function () {
                        getUserMessage($(this).attr("href"));
                        return false;
                    });
                });
            }
        });
    }

    function getUserMessageSummary(url) {
        if (staticFileRoot)
            $("[remind]").html("<img src='" + staticFileRoot + "/common/images/ui-anim_basic_16x16.gif'/>");

        $.ajax({
            type: "Get",
            url: url,
            success: function (data) {
                for (var i in data) {
                    if ($("[remind='" + i + "']")) {
                        if (data[i] == "0")
                            $("[remind='" + i + "']").parent().remove();
                        else
                            $("[remind='" + i + "']").html(data[i]);
                    }

                    //if (i == "TotalCount" && data[i] != "0") {
                    //initmytujiamenu();
                    //}
                }
            }
        });
    }

    if ($("[remindSummaryUrl]").length) {
        getUserMessageSummary($("[remindSummaryUrl]").first().attr("remindSummaryUrl"));
        //getUserMessage($("#mytujiamenu").attr("remindUrl"));
    }
    //订单页初始化功能---end

    //顶部搜索功能
    var topSearch = {
        initCityInput: function () {
            //城市地址输入控件初始化
            $("#citySelect").selectinput({
                offset: [2, -184],
                css: {
                    rootclass: "selectList selectListW120",
                    headclass: "selectTitle-2",
                    mouseon: "mouseon",
                    current: "current"
                }
            }).selEnter();
        },

        initKeywordInput: function () {
            // 顶部搜索
            var $keyword = $("#keyword");
            $keyword.blur(function () {
                if (!$keyword.val()) { $keyword.val("景点/地址/特色").addClass("defaultColor") }
            }).focus(function () {
                if ($keyword.val() == "景点/地址/特色") { $keyword.val("").removeClass("defaultColor") }
            });

            $("#topSearchForm").submit(function () {
                if ($keyword.val() == "景点/地址/特色") { $keyword.val("") }
            });

            if (!$keyword.val()) {
                $keyword.val("景点/地址/特色");
            } else if ($keyword.val() != "景点/地址/特色") {
                $keyword.removeClass("defaultColor");
            }
        },

        modifyFormAction: function () {
            $(".searcSubmit").click(function () {
                var url = window.location.pathname;
                if (typeof ($("#citySelect option:selected").attr("scenicspot")) == "undefined") {
                    if (url.indexOf("se0") > -1) {
                        $("#topSearchForm").attr("action", "/" + $("#citySelect option:selected").attr("name") + "_gongyu/se0/");
                    }
                    else {
                        $("#topSearchForm").attr("action", "/" + $("#citySelect option:selected").attr("name") + "_gongyu/");
                    }
                }
                else {
                    var pinyin = $("#citySelect option:selected").attr("scenicspot");
                    var id = $("#citySelect option:selected").attr("scenicspotid");
                    var arr = pinyin.split('|');
                    if (url.indexOf("se0") > -1) {
                        $("#topSearchForm").attr("action", "/" + arr[0] + "_gongyu/" + arr[1] + "_s" + id + "se0/");
                    }
                    else {
                        $("#topSearchForm").attr("action", "/" + arr[0] + "_gongyu/" + arr[1] + "_s" + id + "/");
                    }
                }
            });
        },

        initAll: function () {
            this.initCityInput();
            this.initKeywordInput();
            this.modifyFormAction();
        }
    };

    //初始化顶部搜索
    if ($("#searchdrop").length) {
        topSearch.initAll();
    }

    /*初始化子导航下拉提示*/

    $("#phonetab").hover(function () {
        var ps = $(this).offset(),
            pl = ps.left + "px",
            pt = ps.top + $(this).outerHeight() + "px";
        $(this).addClass("active");
        $("#phonetabdrop").css({
            position: "absolute",
            left: pl,
            top: pt,
            "z-index": 999
        }).show();
    }, function () {
        $("#phonetabdrop").hide();
        $(this).removeClass("active");
    });

    //延迟加载顶部的html内容
    $("[lazyLoadUrl]").each(function () {
        var $that = $(this);

        loadLazyResource($that);
    });

    function loadLazyResource($resourceContainer) {
        if (staticFileRoot)
            $resourceContainer.html("<img src='" + staticFileRoot + "/common/images/ui-anim_basic_16x16.gif'/>　");

        $.ajax({
            url: $resourceContainer.attr("lazyLoadUrl"),
            dataType: "jsonp",
            jsonp: "callback",
            success: function (result) {
                $resourceContainer.html(result);
            }
        });
    }

    //底部seo展开逻辑-开始
    var landmark_letterstr = "abcdefghijklmnopqrstuvwxyz";
    if ($("#landmarkTab").length) {
        window.showLandmark = function (letter) {
            $("#landmarkTab>a").attr("class", "");
            $("#landmarkTabContent>div").css("display", "none");
            $("#landmarkTab>a").each(function () {
                if ($(this).html().toLocaleLowerCase() == letter) {
                    $(this).attr("class", "current");
                    var i = landmark_letterstr.indexOf(letter);
                    $("#landmarkTabContent>div").eq(i).css("display", "block");
                }
            });
        }
    }

    if ($(".seo-group").length) {
        $(".seo-group").each(function () {
            var _this = $(this),
                objH = _this.find("ul").eq(0).outerHeight(),
                liH = _this.find("li").eq(0).outerHeight();
            if (objH > liH) {
                _this.find("ul").height(liH);
                _this.find("span").show();
            }
            else {
                _this.find("span").hide();
            }

            _this.find("span").bind("click", function () {
                var el = $(this);
                if (el.hasClass("more-btn-top")) {
                    el.removeClass("more-btn-top").parent().find("ul").eq(0).height(liH);
                }
                else {
                    el.addClass("more-btn-top").parent().find("ul").eq(0).height(objH);
                }
            });
        });
    }



    //app下载
    var $appLayer = $(".m-dld-wrap");
    /*  if ($appLayer.length > 0) {
          var curTime = new Date().getTime();
          $appLayer.find(".close-btn").click(function () {
              $appLayer.hide();
          });
          var appNum = $.cookie("appNumHappy_new");
          if (appNum === null) {
              $.cookie("appNumHappy_new", 1, { expires: 100, domain: ".tujia.com" });
              $.cookie("appDateHappy_new", curTime, { expires: 100, domain: ".tujia.com" });
              $appLayer.show();
          } else {
              if (parseInt(appNum) < 3 && (curTime - parseInt($.cookie("appDateHappy_new"))) > 30 * 24 * 3600 * 1000) {
                  $.cookie("appNumHappy_new", ++appNum, { expires: 100, domain: ".tujia.com" });
                  $.cookie("appDateHappy_new", curTime, { expires: 100, domain: ".tujia.com" });
                  $appLayer.show();
              }
          }
  
      }*/
    if ($appLayer.length > 0) {
        $appLayer.find(".close-btn").click(function () {
            $appLayer.hide();
        });
        var appNum = $.cookie("appNumHappy_dc");
        if (appNum === null) {
            $.cookie("appNumHappy_dc", 1, { expires: 7, domain: ".tujia.com" });
            $appLayer.show();
        }

    }

    $(function () {
        if ($("#mytujia").length == 0) {
            $("[lazyLoadUrl]").each(function () {
                var $that = $(this);

                loadLazyResource($that);
            });
        }
    });
})();

//TraceLog相关逻辑
(function () {
    window.parseURL = function (url) {
        var a = document.createElement('a');
        a.href = url;
        return {
            source: url,
            protocol: a.protocol.replace(':', ''),
            host: a.host,
            port: a.port,
            query: a.search,
            params: (function () {
                var ret = {},
                    seg = a.search.replace(/^\?/, '').split('&'),
                    len = seg.length, i = 0, s;
                for (; i < len; i++) {
                    if (!seg[i]) { continue; }
                    s = seg[i].split('=');
                    ret[s[0]] = s[1];
                }
                return ret;
            })(),
            file: (a.pathname.match(/\/([^\/?#]+)$/i) || [, ''])[1],
            hash: a.hash.replace('#', ''),
            pathname: a.pathname.replace(/^([^\/])/, '/$1'),
            relative: (a.href.match(/tps?:\/\/[^\/]+(.+)/) || [, ''])[1],
            segments: a.pathname.replace(/^\//, '').split('/')
        };
    }

    window.traceLog = function(action, logData) {
        if (traceData && traceData.logService) {
            $(function () {
                $.ajax({
                    async: false,
                    url: traceData.logService + '/tracelog/' + action,
                    type: "GET",
                    dataType: 'jsonp',
                    data: $.extend({ "site": logData.site === undefined ? 2 : logData.site, "referrer": document.referrer }, logData)
                });
            });
        }
    }

    window.getValFromHash = function (key) {
        if (location.hash.length > 1) {
            var hash = location.hash.substring(1, location.hash.length);
            var hashArray = hash.split('&');
            if (hashArray.length > 0) {
                for (var i = 0; i < hashArray.length; i++) {
                    var kv = hashArray[i];
                    var indexOfEqualSign = kv.indexOf('=');
                    if (indexOfEqualSign > -1) {
                        var itemKey = kv.substring(0, indexOfEqualSign);
                        if (itemKey.toLowerCase() == key.toLowerCase()) {
                            return kv.substring(indexOfEqualSign + 1, kv.length);
                        }
                    }
                }
            }
        }

        return null;
    }

    window.getPrevId = function () {
        if (traceData && traceData.prevId) {
            return traceData.prevId;
        }

        return getValFromHash("prevId");
    }

    window.guid = function () {
        function s4() {
            return Math.floor((1 + Math.random()) * 0x10000)
              .toString(16)
              .substring(1);
        }
        return s4() + s4() + '-' + s4() + '-' + s4() + '-' +
          s4() + '-' + s4() + s4() + s4();
    }

    String.prototype.endWith = function (str) {
        if (str == null || str == "" || this.length == 0 || str.length > this.length)
            return false;
        if (this.substring(this.length - str.length) == str)
            return true;
        else
            return false;
        return true;
    }
    String.prototype.startWith = function (str) {
        if (str == null || str == "" || this.length == 0 || str.length > this.length)
            return false;
        if (this.substr(0, str.length) == str)
            return true;
        else
            return false;
        return true;
    }

    window.appendLogToUrl = function (url) {
        if (typeof (traceData) == "undefined") {
            return url;
        }

        var currentUrlObj = parseURL(url);
        var splitSign = '#';
        if(currentUrlObj.host == location.host && currentUrlObj.pathname == location.pathname)
        {
            splitSign = '?';
        }

        if (!url || url.toLowerCase().startWith("javascript:") || url.toLowerCase().startWith("#")) {
            return url;
        }

        var indexOfHash = url.indexOf(splitSign);
        if (indexOfHash < 0) {
            url += splitSign +'prevId=' + traceData.pageId;
            return url;
        }

        var hash = url.substr(indexOfHash + 1);
        if (hash) {
            if (hash.toLowerCase().indexOf('previd=') > -1) {
                return url;
            }

            if (hash.indexOf('=') > 0) {
                url += (url.endWith('&') ? '' : '&') + 'prevId=' + traceData.pageId;
            }
        } else {
            url += 'prevId=' + traceData.pageId;
        }
        return url;
    }

    window.openUrl = function (vUrl) {
        window.open(appendLogToUrl(vUrl));
    }

    $(document).on("click", "a", function () {
        if (typeof (traceData) == "undefined" || !traceData.pageId) {
            return;
        }

        var srcHref = $(this).attr("href");
        var url = appendLogToUrl(srcHref);
        if (url != srcHref) {
            $(this).attr('href', url);
        }
    });

    $(document).on("submit", "form", function () {
        if (typeof (traceData) == "undefined" || !traceData.pageId) {
            return;
        }

        var $form = $(this);
        if ($form.find('input[name="prevId"]').length <= 0) {
            $form.append($('<input name="prevId" type="hidden"/>').val(traceData.pageId));
        }
    });
})();


function getTujiacodeCookie(name) {
    var domain = getCookieDomain();
    var beforestr;
    if (domain.length > 1 && domain[0] == ".") {
        beforestr = domain.substring(1) + "_PortalContext_";
    } else {
        beforestr = domain + "_PortalContext_";
    }
    var nameEQ =beforestr+ name + "=";    
    var ca = document.cookie.split(';');       
    for(var i=0;i < ca.length;i++) {    
        var c = ca[i];                      
        while (c.charAt(0)==' ') {             
            c = c.substring(1,c.length);      
        }    
        if (c.indexOf(nameEQ) == 0) {     
            return unescape(c.substring(nameEQ.length,c.length));   
        }    
    }    
    return false;    
}

function getCookieDomain() {
    var pos = document.domain.indexOf(".");
    if (pos > 0) {
        return document.domain.substring(pos);
    } else {
        return document.domain;
    }
}
    
  
function clearTujiacodeCookie(name) {
    setTujiacodeCookie(name, "", -1);
}    
    
   
function setTujiacodeCookie(name, value, seconds) {
    if (document.domain == "localhost") {
        document.cookie = "localhost_PortalContext_" + name + "=" + escape(value);
        return;
    }

    var domain = getCookieDomain();
    var beforestr;
    if (domain.length > 1 && domain[0] == ".") {
        beforestr = domain.substring(1) + "_PortalContext_";
    } else {
        beforestr = domain + "_PortalContext_";
    }
    seconds = seconds || 0;   
    var expires = "";    
    if (seconds != 0 ) {      
        var date = new Date();    
        date.setTime(date.getTime()+(seconds*1000));    
        expires = "; expires="+date.toGMTString();    
    }
    document.cookie = beforestr + name + "=" + escape(value) + expires + "; path=/;domain=" + domain;
}  


var TujiaCookieName = ["OriginalCustomerSourceChannelID", "OriginalCustomerSourceChannelCode", "PromotionChannelID", "PromotionChannelCode", "SubCustomerSourceChannelCode", "HisPromotionChannelCode", "HisSubCustomerSourceChannelCode"];
var TujiaCookiehour = [0, 0, 0, 0, 0, 2592000, 2592000];

for(var cookieindex=0;cookieindex<TujiaCookieName.length;cookieindex++)
{
    if (getTujiacodeCookie("Temp" + TujiaCookieName[cookieindex]) != false)
    {
        var tujiacookievalue = getTujiacodeCookie("Temp" + TujiaCookieName[cookieindex]);
        setTujiacodeCookie(TujiaCookieName[cookieindex], tujiacookievalue, TujiaCookiehour[cookieindex])
    }
}
(function () {

    //是否存在指定变量 
    function isExitsVariable() {
        try {
            if (typeof (IfFromBaidu) == "undefined") {
                //alert("value is undefined"); 
                return false;
            } else {
                //alert("value is true"); 
                return true;
            }
        } catch (e) { }
        return false;
    }

    var addBaiduFromToken = isExitsVariable() ? IfFromBaidu : false;

    /*控制折叠和展开插件*/
    $.fn.foldAndExpand = function (confg) {
        var defaultConf = {
            foldItem: null
        };
        defaultConf = $.extend({}, defaultConf, confg);
        return this.each(function () {
            var $this = $(this);
            var $listItem = $this.closest(defaultConf.foldItem);
            $this.click(function () {
                if ($this.hasClass("j-more-btn")) {
                    $listItem.css({
                        overflow: "hidden",
                        height: defaultConf.height
                    });
                    $this.removeClass("j-more-btn");
                } else {
                    $listItem.css({
                        overflow: "visible",
                        height: "auto"
                    });
                    $this.addClass("j-more-btn");
                }
            });

        });
    };
    //列表页异步加载实现
    var asynSearchList = {
        //绑定搜索事件
        filterUIInit: function () {
            var self = this;
            self.pictureCacheData = {};
            self.$filterWraper = $("#filterWrapper, #hotelBrandCondition");
            self.$filterListGroupExceptLocation = self.$filterWraper.find("div.j-filterGroup-multiSelect");
            self.$filtersPanel = $("#filtersPanel");
            self.$selectedItemsContainer = self.$filtersPanel.find("div.j-filter-selectedItemsContainer");
            self.$searchResultCount = $("div.total-house-amount").find("span");
            self.$unitSearchResult = $("#unitSearchResult");
            self.$filterGroupDetails = $(".j-filter-locationItemDetail");

            self.initFilter();

            var tabIndex = $("#filter-list-type-ln").find(".j-filter-locationItemDetail").filter(function () {
                return $(this).find('ul.j-filter-list-ul > li > a.selected').length > 0;
            }).index() - 1;

            //地址过滤选项卡
            $(".j-filter-locationTabContainer .j-filter-locationTab li").powerFloat({
                target: function () {
                    var index = $(this).index();
                    return self.$filterGroupDetails.eq(index);
                },
                showCall: function ($target) {
                    var $wrapper = $(this).addClass("active").closest(".j-filter-locationTab");
                    var pos = $wrapper.offset();
                    $target.css({
                        "position": "absolute",
                        "top": pos.top + $wrapper.outerHeight(),
                        "left": pos.left,
                        "z-index": 9
                    });
                },
                hideCall: function () {
                    $(this).removeClass("active");
                },
                edgeAdjust: false,
            });

            //筛选条件Tab
            $(".filter-box .filter-list>ul>li").powerFloat({
                target: function () {
                    var index = $(this).index();
                    return self.$filterGroupDetail.children('.filter-group').eq(index);
                },
                showCall: function ($target) {
                    var $wrapper = $(this).addClass("active").closest(".filter-list");
                    var pos = $wrapper.offset();
                    $target.css({
                        "position": "absolute",
                        "top": pos.top + $wrapper.outerHeight() - 1,
                        "left": pos.left
                    });
                },
                hideCall: function () {
                    $(this).removeClass("active");
                },
                edgeAdjust: false,
            });

            //其他筛选项Tabs
            var otherTabIndex = $("#filter-list-type-other").find("li.active").index();
            $("#filter-list-type-other").tabs(".j-filter-otherItemDetail", {
                tabs: ".j-filter-otherTabs li",
                current: "active",
                initialIndex: otherTabIndex,
                onBeforeClick: function (e, index) {
                    if (this.getIndex() === index) {
                        this.getCurrentPane().toggle();
                        this.getCurrentTab().toggleClass("active");
                    }
                }
            });

            //控制折叠与展开
            $("#filter-list-type-s, #filter-list-type-c, #filter-list-type-la, #filter-list-type-lc, #filter-list-type-lh").find("span.more-btn").foldAndExpand({
                height: "26px",
                foldItem: ".filter-list-grouping"
            });
            $("#filter-list-type-sa").find("span.more-btn").foldAndExpand({
                height: "26px",
                foldItem: ".filter-content-group"
            });
            $("#filterWrapper > .j-filterGroup-multiSelect").each(function () {
                var $this = $(this);
                $this.find("span.more-btn").foldAndExpand({
                    height: "26px",
                    foldItem: $this
                });
            });
        },
        filterBindEvent: function () {
            var self = this;
            var $filterWraper = self.$filterWraper;
            var $localFilter = $("#filter-list-type-ln");
            var $listPrice = $("#filter-list-type-p");
            var $filtersPanel = self.$filtersPanel;
            var $listWraper = $("#listWrapper");
            var $dsFilter = $("#filter-list-type-ds");
            //位置房屋过滤事件

            //点击不限
            $filterWraper.find('a.unlimited').on('click', function () {
                var $this = $(this);
                if ($this.hasClass('selected')) {
                    return;
                }
                $this.closest('.filter-content, .filter-list-grouping').find('a').removeClass('selected');
                $this.closest('.filter-content, .filter-list-grouping').find('ul.location-list-show').hide();
                $this.addClass('selected');
                //点击房价的不限，清空自定义价格
                if ($this.closest('.j-filterGroup-multiSelect').is('#filter-list-type-p')) {
                    $("#MinPriceValue").val("");
                    $("#MaxPriceValue").val("");
                }
                self.refreshData();
            });

            

            //价格需要与自定义价格关联
            $("#filter-list-type-p").on("unlimitedClicked", function () {
                $("#MinPriceValue").val("");
                $("#MaxPriceValue").val("");
            }).on("optionClicked", function () {
                $("#MinPriceValue").val("");
                $("#MaxPriceValue").val("");
                self.setNoFilter($(this).children(".filter-content"));
            });

            ////房型需要与人数关联
            //$("#filter-list-type-hb").on("unlimitedClicked", function () {
            //    $("#peopleCountSelect").val("0");
            //    $("#peopleCountSelect").data("selectinput").setHeadText("不限");
            //}).on("optionClicked", function () {
            //    self.setNoFilter($(this).children(".filter-content"));
            //});

            //绑定自定义价格
            $('#pricerange input[type=text]').focus(function () {
                $('#pricerange input[type=button]').show();
            });

            $('body').bind("click", function (evt) {
                if (!$("#pricerange").has(evt.target).length) {
                    $('#pricerange input[type=button]').hide();
                }
            });

            $('#pricerange input[type=button]').click(function () {
                var minPrice, maxPrice;
                if ($("#MinPriceValue").val()) {
                    minPrice = $("#MinPriceValue").val();
                } else {
                    minPrice = 0;
                }

                if ($("#MaxPriceValue").val()) {
                    maxPrice = $("#MaxPriceValue").val();
                } else {
                    maxPrice = 0;
                }

                if (minPrice == 0 || maxPrice == 0) {
                    self.setNoFilter($listPrice.children('.filter-content'));
                    return;
                }
                $listPrice.find("ul.j-filter-list-ul a, .not a").removeClass("selected");
                self.refreshData();
            });

            //删除tags
            $filtersPanel.on("click", "a", function (ev) {
                var $curItem = $(ev.target);
                var $selectedItemsContainer = self.$selectedItemsContainer;
                if ($curItem.hasClass("del-all")) {
                    $selectedItemsContainer.children().each(function () {
                        deleteFiltertag($selectedItemsContainer, $(this));
                    });
                    $selectedItemsContainer.empty();
                } else {
                    deleteFiltertag($selectedItemsContainer, $curItem);
                }
                self.refreshData();
            });

            function deleteFiltertag($selectedItemsContainer, $curItem) {
                var type = $curItem.attr("data-type");
                var value = $curItem.attr("data-val");
                if (type === "ps") {
                    $("#MinPriceValue").val("");
                    $("#MaxPriceValue").val("");
                    self.setNoFilter($("#MinPriceValue").closest(".filter-content"));
                } else if (type === "kw") {
                    $("#adress").val('').next().show();
                }

                $curItem.remove();
                var $selItem = $filterWraper.find("a[data-type=" + type + "][data-val=" + value + "]");
                $.each(self.initConditiontData, function (index, valObj) {
                    if (valObj.ConditionType == type && valObj.Value == value) {
                        self.initConditiontData.splice(index, 1);
                    }
                });
                $selItem.removeClass("selected");
                self.setNoFilter($selItem);
                if ($selectedItemsContainer.children().not(".del-all").length === 0) {
                    $selectedItemsContainer.empty();
                    $filtersPanel.hide();
                }
            }
        },
        reqData: function (url, callBack) {
            var self = this;
            var $listWraper = $("#listWrapper");
            var $search = $("#search");
            var urlLoading = staticFileRoot + "/PortalSite2/Images/loading_50.gif";
            var $loadImg = $('<div class="loading-wrap"><img src="' + urlLoading + '"/>请稍候， 途途们正在为您实时查询!</div>');

            if (self.ajaxObj) {
                self.ajaxObj.abort();
            }
            self.ajaxObj = $.ajax({
                type: "get",
                url: encodeURI(url),
                cache: false,
                beforeSend: function () {

                },
                success: function (res) {
                    $loadImg.remove();
                    callBack(res);
                },
                error: function () {
                    $("div.total-house-amount").find("span").text(0);
                },
                complete: function () {
                    $loadImg.remove();
                }
            });

            //先发请求 再隐藏原有Dom元素
            $loadImg.height($(window).height() - $("#sortWrapper").offset().top + $(window).scrollTop() - 200);
            $listWraper.find(".house-list").hide();
            self.$unitSearchResult.hide();
            $loadImg.appendTo($listWraper);

            $("html,body").animate({ scrollTop: $search.offset().top + "px" }, 300);
        },
        getFilterData: function () {
            var self = this;
            self.filterData = [];
            //var pCount = $("#peopleCountSelect").val();

            var isAnyLocationCondtionSelected = false;
            var locationConditionTypes = ["s", "a", "c", "lm", "lc", "ld", "lh"];
            self.$filterWraper.find("a.selected").not(".unlimited").each(function () {
                var type = $(this).attr("data-type");
                var value = $(this).attr("data-val");
                var name = $(this).text();
                self.filterData.push({
                    "dataType": type,
                    "dataVal": value,
                    "name": name
                });
                if (locationConditionTypes.contains(type)) {
                    isAnyLocationCondtionSelected = true;
                }
            });

            //如果位置项被选中，则移除initConditiontData中dataType类型为d, keyword的筛选项
            if (isAnyLocationCondtionSelected) {
                $.each(self.initConditiontData, function (index, valObj) {
                    if (valObj.ConditionType == "kw" || valObj.ConditionType == "lm" || valObj.ConditionType == "gp") {
                        self.initConditiontData.splice(index, 1);
                    }
                });
            }

            //将初始值复制到新数组中
            $.each(self.initConditiontData, function (index, item) {
                self.filterData.push({
                    "dataType": item.ConditionType,
                    "dataVal": item.Value,
                    "name": item.Name
                });
            });

            var $MinPriceValue = $("#MinPriceValue");
            var $MaxPriceValue = $("#MaxPriceValue");
            if ($MinPriceValue.length > 0 && $MaxPriceValue.length > 0) {
                var minValue = $MinPriceValue.val();
                var maxValue = $MaxPriceValue.val();

                if (minValue !== "" && maxValue !== "") {
                    self.filterData.push({
                        "dataType": "ps",
                        "dataVal": minValue + "-" + maxValue,
                        "name": "￥" + minValue + "-" + maxValue
                    });
                }
            }

            //if (pCount && parseInt(pCount) !== 0) {
            //    self.filterData.push({
            //        "dataType": "pc",
            //        "dataVal": pCount,
            //        "name": "宜住人数：" + pCount
            //    });
            //}

            //排序
            var sortVal = $("#sortArea").attr("data-sortVal");
            if (sortVal && sortVal != "") {
                self.filterData.push({
                    "dataType": "o",
                    "dataVal": sortVal
                });
            }
        },
        getPictureData: function (unitId) {
            var self = this;
            if (self.getPictureAjaxObj) {
                self.getPictureAjaxObj.abort();
            }
            if (self.pictureCacheData[unitId]) {
                var deffered = $.Deferred();
                deffered.resolve(self.pictureCacheData[unitId]);
                return deffered.promise();
            } else {
                return self.getPictureAjaxObj = $.getJSON("/unitlist/GetPictures/?unitid=" + unitId, function (res) {
                    if (res.IsSuccess) {
                        self.pictureCacheData[unitId] = res;
                    }
                });
            }
        },
        bindListEvent: function () {
            var $listWraper = $("#listWrapper");
            var self = this;
            //绑定list折叠展开
            $listWraper.on("click", ".btn-box", function (ev) {
                var $this = $(this);
                var $icon = $this.find("i");
                var $parentBox = $this.closest(".m-table");
                if ($icon.hasClass("icon-caret-bottom")) {
                    $this.text($this.text().replace("展开全部产品", "收起全部产品"));
                    $parentBox.find("tr.moreStyle").removeClass("dn");
                    $icon.removeClass("icon-caret-bottom").addClass("icon-caret-top");
                } else {
                    $this.text($this.text().replace("收起全部产品", "展开全部产品"));
                    $parentBox.find("tr.moreStyle").addClass("dn");
                    $icon.removeClass("icon-caret-top").addClass("icon-caret-bottom");
                }
                $this.append($icon);
            });

            /*查看相册*/
            $listWraper.on("click", ".view-pic", function (ev) {
                var getPictureDeffered = self.getPictureData($(this).closest(".searchresult-list").attr("data-unitid"));
                getPictureDeffered.done(function (res) {
                    var imgData = $.parseJSON(res.data);
                    self.refreshAlbum(imgData);
                    $("#album-view").mask({
                        closeOnClick: false,
                        color: "#333"
                    });
                });
            });

            $listWraper.powerFloat({
                eventType: "degHover",
                degElem: "a.map-btn",
                targetMode: "ajax",
                targetAttr: "ref",
                position: "6-8",
                hoverHold: false
            });

            $listWraper.powerFloat({
                eventType: "degHover",
                degElem: ".j-freeservice[rel]",
                container: "plugin",
                reverseSharp: true,
                position: "7-5",
                showCall: function (target) {
                    target.find('h2').text('免费' + this.attr('title'));
                    target.find('.tips-info').text(this.attr('data-remark'));
                }
            });

            $listWraper.powerFloat({
                eventType: "degHover",
                degElem: ".ticket-available",
                container: "plugin",
                reverseSharp: true,
                position: "7-5"
            });

            $listWraper.powerFloat({
                eventType: "degHover",
                degElem: ".j-ReturnMoneyTips[rel]",
                container: "plugin",
                reverseSharp: true,
                position: "3-2",
                showCall: function (target) {
                    target.find('.tips-info .defaultPrice').text(this.attr('data-defaultprice'));
                    target.find('.tips-info .additionReduceReason').text(this.attr('data-additionreducereason'));
                    var defaultReduceAmount = this.attr('data-defaultreduceamount');
                    var additionReduceAmount = this.attr('data-additionreduceamount');
                    var totalReduceAmount = this.attr('data-totalreduceamount');
                    if (defaultReduceAmount > 0) {
                        target.find('.tips-info .defaultReduceAmount').text(defaultReduceAmount).parent();
                        target.find('.tips-info .defaultReduceTips').show();
                    } else {
                        target.find('.tips-info .defaultReduceTips').hide();
                    }
                    if (additionReduceAmount > 0) {
                        target.find('.tips-info .additionReduceAmount').text(additionReduceAmount).parent();
                        target.find('.tips-info .additionReduceTips').show();
                    } else {
                        target.find('.tips-info .additionReduceTips').hide();
                    }
                    if (defaultReduceAmount > 0 && additionReduceAmount > 0) {
                        target.find('.tips-info .totalReduceAmount').text(totalReduceAmount).parent();
                        target.find('.tips-info .totalReduceTips').show();
                    } else {
                        target.find('.tips-info .totalReduceTips').hide();
                    }
                }
            });

            $listWraper.powerFloat({
                eventType: "degHover",
                degElem: ".icon-card.j-icon-card[rel]",
                container: "plugin",
                reverseSharp: true,
                position: "3-2"
            });

            $listWraper.powerFloat({
                eventType: "degHover",
                degElem: ".icon-quality-hotel[rel]",
                container: "plugin",
                reverseSharp: true,
                position: "7-5"
            });

            $listWraper.powerFloat({
                eventType: "degHover",
                degElem: ".icon-payment[rel]",
                container: "plugin",
                reverseSharp: true,
                position: "7-5"
            });

            $listWraper.powerFloat({
                eventType: "degHover",
                degElem: "a.btn-booking",
                container: "plugin",
                reverseSharp: true,
                position: "8-6",
                showCall: function (target) {
                    var tipsObj = $.parseJSON(this.attr('data-tips'));
                    var $tipsInfo = target.find('.tips-info');
                    $tipsInfo.empty();
                    $.each(tipsObj, function (i, v) {
                        $tipsInfo.append($('<p><span class="h-text">*</span></p>').append(v));
                    });
                }
            });

            //TODO
            $listWraper.powerFloat({
                eventType: "degHover",
                degElem: ".exclusive-info[rel]",
                container: "plugin",
                reverseSharp: true,
                position: "7-5"
            });


            $listWraper.on("click", "a.has-empty-house", function (ev) {
                ev.stopPropagation();
                var $el = $(this);
                var unitId = $(this).attr("data-unitid");
                var urlLoading = staticFileRoot + "/PortalSite2/Images/loading.gif";
                var loadImg = $('<img src="' + urlLoading + '"/>').appendTo("body");
                loadImg.css({
                    position: "absolute",
                    left: $el.offset().left + 65,
                    top: $el.offset().top - 8
                });
                function toShortString(date) {
                    return date.getFullYear() + "-" + (date.getMonth() + 1) + "-" + date.getDate();
                }

                $el.off("dateConfirmed").on("dateConfirmed", function (e, selectedDate) {
                    var url = $el.attr("data-detaillink");
                    var queryStrinArray = [];
                    queryStrinArray.push('startDate=' + toShortString(selectedDate.checkinDate));
                    queryStrinArray.push('endDate=' + toShortString(selectedDate.checkoutDate));
                    openUrl(encodeURI(url + '?' + queryStrinArray.join("&")));
                });
                $.ajax({
                    type: "Get",
                    dataType: "json",
                    async: true,
                    cache: false,
                    url: unitCalendarUrl,
                    data: {
                        unitId: unitId,
                    },
                    error: function () {
                        loadImg.remove();
                    },
                    success: function (data) {
                        //var jstartDate = $("#startDate");
                        //var vBeginDate = null;
                        //var vcurDate = new Date();
                        //var visIE6 = true; //isIE6();

                        //if (jstartDate.val()) {
                        //    vBeginDate = visIE6 ? new Date(jstartDate.val().replace(/-/g, '/')) : new Date(jstartDate.val());
                        //    vBeginDate.setDate(1);
                        //} else {
                        //    vBeginDate = new Date();
                        //}
                        //if (vBeginDate < vcurDate) {
                        //    vBeginDate = vcurDate;
                        //} 

                        //var vmaxDate = new Date(vBeginDate);
                        //vmaxDate.setDate(vBeginDate.getDate() + 30 * 12);
                        //var vminDate = new Date(visIE6 ? minDate.replace(/-/g, '/') : minDate);

                        var jdt = $el.dateinputSingleStatus({
                            houseData: data,
                            min: minDate,
                            max: maxDate,
                            value: new Date(),
                            css: {
                                root: "bookCal",
                                prev: "bookPrev",
                                next: "bookNext",
                                content: "bookContent"
                            }
                        });
                        var jdtData = jdt.data("dateinput");
                        jdtData.show();
                        jdtData.getCalendar().show();
                        loadImg.remove();

                    }
                });

            });
            //哪天有房
            $listWraper.on("click", ".haveunits", function (ev) {
                ev.stopPropagation();
                var el = $(this);
                var spanID = $(this).attr("id");
                var arrIDs = spanID.split('_');
                var unitID = arrIDs[1];
                var spID = arrIDs[2];
                var urlLoading = staticFileRoot + "/PortalSite2/Images/loading.gif";
                var loadImg = $('<img src="' + urlLoading + '"/>').appendTo("body");
                loadImg.css({
                    position: "absolute",
                    left: el.offset().left + 65,
                    top: el.offset().top - 8
                });
                el.off("dateConfirmed").on("dateConfirmed", function (e, selectedDate) {
                    var $tbody = el.closest("tbody");
                    var destinationPinyin = $tbody.attr("data-destinationpinyin");
                    var scenicspot = $tbody.attr("data-scenicspot");
                    var unitDetailUrl = "/unitdetail/trytoorderpage";
                    var queryStrinArray = [];
                    queryStrinArray.push('unitId=' + unitID);
                    queryStrinArray.push('productId=' + spID);
                    queryStrinArray.push('checkinDate=' + toShortString(selectedDate.checkinDate));
                    queryStrinArray.push('checkoutDate=' + toShortString(selectedDate.checkoutDate));
                    queryStrinArray.push('scenicspot=' + scenicspot);
                    queryStrinArray.push('destinationPinyin=' + destinationPinyin);
                    openUrl(encodeURI(unitDetailUrl + '?' + queryStrinArray.join("&")));
                });

                function toShortString(date) {
                    return date.getFullYear() + "-" + (date.getMonth() + 1) + "-" + date.getDate();
                }

                $.ajax({
                    type: "Get",
                    dataType: "json",
                    async: true,
                    cache: false,
                    url: "/UnitDetail/GetJsonUnitInventory",
                    data: {
                        id: unitID,
                        productID: spID
                    },
                    success: function (data) {

                        var jstartDate = $("#startDate");
                        var vBeginDate = null;
                        var vcurDate = new Date();
                        var visIE6 = true; //isIE6();

                        if (jstartDate.val()) {
                            vBeginDate = visIE6 ? new Date(jstartDate.val().replace(/-/g, '/')) : new Date(jstartDate.val());
                            vBeginDate.setDate(1);
                        } else {
                            vBeginDate = new Date();
                        }
                        if (vBeginDate < vcurDate) {
                            vBeginDate = vcurDate;
                        }

                        var jdt = el.dateinputFt({
                            houseData: data.checkin,
                            min: mindate,
                            max: maxdate,
                            mindate: mindate,
                            value: vBeginDate,
                            checkin: false,
                            startDate: $("#startDate").val(),
                            endDate: $("#endDate").val(),
                            isDeleg: true,
                            tips: "在日历上选择入住和退房日期，可立即预订",
                            css: {
                                root: "tips"
                            }
                        });
                        var jdtData = jdt.data("dateinput");
                        jdtData.show();
                        jdtData.getCalendar().show();
                        loadImg.remove();

                    }
                });
                return false;
            });

            //套餐详情
            $listWraper.on("click", ".house-info > .m-table > table > tbody > tr", function (e) {
                if (!$(e.target).hasClass("link-ajax-login") && !$(e.target).closest("[id^='iphone-tip']").length > 0) {
                    openUrl($(this).data("link"));
                }
            });

            $listWraper.on("click", ".j-bookingBtn", function (e) {
                //阻止时间冒泡到tr上
                e.stopPropagation();
            });

            //排序绑定事件
            $("#sortArea>a").click(function (ev) {
                ev.stopPropagation();
                var $this = $(this);
                $this.siblings().removeClass("active select");
                var currentDataCat = $this.attr("data-cat");
                var $siblingCatItem = $(this).siblings("[data-cat=" + currentDataCat + "]");


                if ($siblingCatItem.length == 0) {
                    if ($this.hasClass("active")) {
                        return;
                    }
                    else {
                        $this.addClass("active");
                    }
                } else {
                    $siblingCatItem.addClass("active");
                    $this.removeClass("active");
                    $(this).hide();
                    $siblingCatItem.show();
                }

                $this.parent().attr("data-sortval", $this.attr("data-val"));
                self.refreshData();
            });

            //绑定分页事件
            $listWraper.on("click", "#pages a", function (ev) {
                ev.preventDefault();
                ev.stopPropagation();
                var $this = $(this);
                var href = $this.attr("href");
                var url = href;
                if (!href || href.indexOf("javascript:") == 0) {
                    url = $this.attr("data-href");
                }
                var regexMatch = /\/([\w\-]+\/)*(\d+)/.exec(url);
                var pageIndex = (regexMatch && regexMatch.length >= 3) ? regexMatch[2] : '1';
                self.refreshData(pageIndex);
            });

        },
        addFilterTag: function () {
            var self = this;
            var $filterTagWrap = self.$filtersPanel;
            var $selectedItemsContainer = self.$selectedItemsContainer;
            var tagCount = 0;
            $selectedItemsContainer.empty();

            $.each(self.filterData, function (key, valObj) {
                var value = valObj.dataVal;
                var type = valObj.dataType;
                //排序不放在已选择筛选项中
                if (type == "o") {
                    return;
                }
                if (!valObj.name || valObj.name.length <= 0) {
                    //return;
                }
                var name = valObj.name;
                if (valObj.dataType == "kw") {
                    name = "关键字：" + name;
                }
                $selectedItemsContainer.append('<a href="javascript:void(0)" class="filters-item j-filter-selectedItem" data-type="' + type + '" data-val="' + value + '">' + name + '</a>');
            });

            tagCount = $selectedItemsContainer.children().length;
            if (tagCount > 0) {
                $filterTagWrap.show();
                if (tagCount > 1) {
                    $selectedItemsContainer.append('<a href="javascript:void(0)" class="del-all dn">清除全部</a>');
                } else {
                    $selectedItemsContainer.find("a.del-all").remove();
                }
            } else {
                $filterTagWrap.hide();
            }
        },
        setNoFilter: function ($curItem) {
            var $ul;
            if ($curItem.is("ul")) {
                $ul = $curItem;
            } else {
                $ul = $curItem.closest("ul");
            }

            var $filterCk = $ul.closest(".j-filter-locationItemDetail, .j-filterGroup-multiSelect");
            //刷新不限状态
            if ($filterCk.find("a.selected:not(.unlimited)").length === 0) {
                if ($filterCk.is("#filter-list-type-p")) { //价格的话检查自定义价格
                    if ($('#MinPriceValue').val() == "" || $("#MaxPriceValue").val() == "") {
                        $filterCk.find("a.unlimited").addClass("selected");
                    }
                } else {
                    $filterCk.find("a.unlimited").addClass("selected");
                }
            }
            //隐藏子筛选项，子区域、地铁站
            if ($filterCk.is("#filter-list-type-s,#filter-list-type-lc")) {
                $filterCk.find(".filter-line").hide();
                if (!$ul.hasClass("location-list-show")) {
                    $filterCk.find("ul.location-list-show").hide();
                    $ul.siblings('[data-parentval=' + $curItem.attr('data-val') + ']').find("a.selected:not(.unlimited)").removeClass("selected");
                }
            }
        },
        refreshAlbum: function (imgData) {
            var $albumView = $("#album-view");
            var $slideItems = $("#slides-box").children();
            var $slideDetail = $slideItems.eq(0);
            var $detailImg = $slideDetail.find("div.loading-box").children();
            var $detailTitle = $slideDetail.find(".pic-name");
            var $slideThumb = $slideItems.eq(1);
            var $thumbList = $slideThumb.find(".pic-scroll").children().empty();
            var sList = "";
            $.each(imgData, function (index, item) {
                sList += '<li><img src="' + item.smallImgUrl + '" data-url="' + item.bigImgUrl + '" data-title="' + item.label + '"></li>';
            });
            $thumbList.html(sList);
            var $thumbItems = $thumbList.children();
            var thumbItemWidth = $thumbItems.width();
            $thumbList.width(thumbItemWidth * $thumbItems.length);
            $thumbList.css("left", 0);
            $detailImg.attr("src", imgData[0].bigImgUrl);
            $detailTitle.text(imgData[0].label);
            $thumbList.find("img").first().addClass("current");
            $albumView.show().css({
                position: "absolute",
                left: ($(window).width() - $albumView.outerWidth()) / 2,
                top: $(window).scrollTop() + ($(window).height() - $albumView.outerHeight()) / 2
            });
        },
        initAlbum: function () {
            var $albumView = $("#album-view");
            var thumbShowNum = 7;
            var $slideItems = $("#slides-box").children();
            var $slideDetail = $slideItems.eq(0);
            var $detailImg = $slideDetail.find("div.loading-box").children();
            var $detailTitle = $slideDetail.find(".pic-name");
            var $slideThumb = $slideItems.eq(1);
            var $thumbBtnPrev = $slideThumb.find("a.btn-prev");
            var $thumbBtnNext = $slideThumb.find("a.btn-next");
            var $thumbList = $slideThumb.find(".pic-scroll").children();
            var disableSwitch = false;
            function slideInFrame($toSlide, dir) {
                var thumbShowNum = 7;
                var thumbItemWidth = $thumbList.children().width();
                var index = $toSlide.parent().index();
                var left = Math.abs($thumbList.position().left);
                var leftDis = index * thumbItemWidth - left;
                var rightDis = left + (thumbShowNum - index - 1) * thumbItemWidth;
                if (leftDis >= 0 && rightDis >= 0) {
                    return 0;
                } else {
                    if (dir) {
                        return -rightDis;
                    } else {
                        return -leftDis;
                    }
                }
            }
            function switchSlide($curSlide, $toSlide, dir) {
                var url = $toSlide.attr("data-url")
                var title = $toSlide.attr("data-title");
                $curSlide = $curSlide.parent();
                var distance = slideInFrame($toSlide, dir);
                if (dir) {
                    $thumbList.stop(true, true).animate({
                        left: "-=" + distance
                    }, function () {
                        disableSwitch = false;
                    });
                } else {
                    $thumbList.stop(true, true).animate({
                        left: "+=" + distance
                    }, function () {
                        disableSwitch = false;
                    });
                }
                $curSlide.children().removeClass("current");
                $toSlide.addClass("current");
                $detailImg.attr("src", url);
                $detailTitle.html(title);
            }
            $thumbBtnPrev.click(function () {
                var $curImg = $thumbList.find("img.current");
                var $curItem = $curImg.parent();
                var $toImg = $curItem.prev().children();
                var $thumbItems = $thumbList.children();
                if (disableSwitch) {
                    return;
                }
                disableSwitch = true;
                if ($curItem.index() === 0) {
                    $toImg = $thumbItems.last().children();
                    switchSlide($curItem, $toImg, 1);
                } else {
                    switchSlide($curImg, $toImg, 0);
                }

            });
            $thumbBtnNext.click(function () {
                var $curImg = $thumbList.find("img.current");
                var $curItem = $curImg.parent();
                var $toImg = $curItem.next().children();
                var $thumbItems = $thumbList.children();
                if (disableSwitch) {
                    return;
                }
                disableSwitch = true;
                if ($curItem.index() === $thumbItems.length - 1) {
                    $toImg = $thumbItems.first().children();
                    switchSlide($curImg, $toImg, 0);
                } else {
                    switchSlide($curImg, $toImg, 1);
                }

            });
            $thumbList.on("click", "img", function () {
                var $this = $(this);
                var url = $this.attr("data-url")
                var title = $this.attr("data-title");
                $thumbList.find("img.current").removeClass("current");
                $this.addClass("current");
                $detailImg.attr("src", url);
                $detailTitle.html(title);
            });
            $slideDetail.on("click", ".btn-prev", function () {
                $thumbBtnPrev.trigger("click");
            });
            $slideDetail.on("click", ".btn-next", function () {
                $thumbBtnNext.trigger("click");
            });
            $(window).resize(function () {
                $albumView.css({
                    position: "absolute",
                    left: ($(window).width() - $albumView.outerWidth()) / 2,
                    top: $(window).scrollTop() + ($(window).height() - $albumView.outerHeight()) / 2
                });
            });
            $albumView.find(".close-btn").click(function () {
                $albumView.hide();
                $.mask.close();
            });
        },
        initFilter: function () {
            var self = this;
            self.initConditiontData = [];
            if (viewData) {
                if (viewData.IsShowDistance) {
                    $("#filter-list-type-ds").show();
                } else {
                    $("#filter-list-type-ds").hide();
                }
                if (viewData.IsShowKA) {
                    $("#KeyAccount").show();
                } else {
                    $("#KeyAccount").hide();
                }

                if (viewData.SelectedConditionItems) {
                    var $filterItem = self.$filterWraper.find('ul.j-filter-list-ul > li > a:not(.j-newPage)');
                    $.each(viewData.SelectedConditionItems, function (i, v) {
                        if (v.ConditionType == "ps") {
                            var valArray = v.Value.split('|');
                            $("#MinPriceValue").val(valArray[0]);
                            $("#MaxPriceValue").val(valArray[1]);
                            return;
                        }
                        var $matchItem = $filterItem.filter(function () {
                            var $this = $(this);
                            var isMatched = $this.attr('data-type') == v.ConditionType
                                && $this.attr('data-val') == v.Value
                                && $this.attr('data-identityid') == v.IdentityId
                            if (isMatched) {
                                var $parentul = $this.closest('ul');
                                $parentul.show();
                                if ($parentul.attr('data-parentval')) {
                                    $parentul.siblings('ul.j-filter-list-ul').find('li>a[data-val=' + $parentul.attr('data-parentval') + ']').addClass('selected').closest('ul').siblings('.not').find('.unlimited').removeClass('selected');
                                }
                            }
                            return isMatched;
                        });
                        if ($matchItem.length > 0) {
                            $matchItem.addClass('selected').closest('ul.j-filter-list-ul').siblings('.not').find('.unlimited').removeClass('selected');
                        } else {
                            self.initConditiontData.push(v);
                        }
                    });
                }
            }
        },
        setHashHeight: function () {
            //作为子Iframe时，需要设置hash来让父窗体知道子IFrame的高度
            if ($("#auto_iframe").length > 0) {
                try {
                    var hashH = document.documentElement.scrollHeight;
                    var urlC = 'http://hotel.kuxun.cn/partner/ifheight.html';
                    document.getElementById("auto_iframe").src = urlC + "#tujia_height:" + hashH;
                }
                catch (e)
                { }
            }
        },
        initView: function () {
            this.filterUIInit();
            this.filterBindEvent();
            this.bindListEvent();
            this.getFilterData();
            this.addFilterTag();
            this.initAlbum();
            this.setHashHeight();
        }
    };

    /*列表页图片异步加载*/
    function asynLoadImg($img) {
        var $self = $(this);
        var wScroll = $(window).scrollTop();
        var wHeight = $(window).height();
        $img.each(function () {
            var $self = $(this);
            var top = $self.offset().top;
            var height = $self.height();
            if ($self.data("isLoad")) {
                return;
            }
            if (wScroll > top - wHeight - 200) {
                $self.attr("src", $self.attr("data-origin"));
                $self.data("isLoad", true);
            }
        });
    }

    function asynImgDefault($img) {
        var placeholder = "data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAYAAAAfFcSJAAAAAXNSR0IArs4c6QAAAARnQU1BAACxjwv8YQUAAAAJcEhZcwAADsQAAA7EAZUrDhsAAAANSURBVBhXYzh8+PB/AAffA0nNPuCLAAAAAElFTkSuQmCC";
        $img.each(function () {
            var $self = $(this);
            if ($self.attr("src") === undefined || $self.attr("src") === false) {
                $self.attr("src", placeholder);
            }
        });
    }

    $(window).scroll(function () {
        asynLoadImg($("#unitSearchResult .house-list img"));
    });

    asynImgDefault($(".house-list img"));
    $(window).trigger("scroll");

    //长租列表页搜索初始化
    var changZuSearch = {
        //初始化城市地址输入组件
        InitCityInput: function () {
            var self = this;
            var hotCityListUrl = "/SpecialOffer/GetLongLeaseHotCityList/";
            var topCityCount = 30;
            var $destInput = $("#destInput");
            var cityInfo = {
                "citys": [],
                "lettergroups": [
                    { 'id': 60, 'name': 'A B C D E F G', 'cityids': [] },
                    { 'id': 61, 'name': 'H I J K L M N O', 'cityids': [] },
                    { 'id': 62, 'name': 'P Q R S T U V W', 'cityids': [] },
                    { 'id': 63, 'name': 'X Y Z', 'cityids': [] }
                ],
                "hotgroup": {
                    'name': '热门城市',
                    "cityids": []
                }
            };

            $.ajax({
                url: hotCityListUrl,
                dataType: 'JSON',
                // async: false,
                cache: false,
                success: function (cityList) {
                    $.each(cityList, function (i, v) {
                        cityInfo.citys.push({ 'id': v.ID, "cityid": v.CityID, 'name': v.CityName, 'pinyin': v.Pinyin, 'keyword': [v.Pinyin], 'cityPinyin': v.CityPinyin });
                    });

                    $.each(cityList, function (i, v) {
                        var idx = 0;
                        var c = v.Pinyin[0];
                        if (c <= 'g') {
                            idx = 0
                        } else if (c <= 'o') {
                            idx = 1
                        } else if (c <= 'w') {
                            idx = 2
                        } else {
                            idx = 3
                        };
                        cityInfo.lettergroups[idx].cityids.push(v.ID);
                    });

                    $.each(cityList.slice(0, topCityCount), function (i, v) {
                        cityInfo.hotgroup.cityids.push(v.ID);
                    });
                    //初始化默认城市
                    var curDestId = $destInput.attr("data-destid");
                    $.each(cityInfo.citys, function (index, item) {
                        if (parseInt(curDestId) === item.cityid) {
                            $destInput.attr("data-citypinyin", item.cityPinyin);
                            return false;
                        }
                    });
                    //初始化城市输入控件
                    $destInput.focus(function () {
                        self.showCityInput($destInput, cityInfo);
                    });

                    $(document).on("click", function (ev) {
                        if ($(ev.target).closest($destInput).length === 0 && !$(ev.target).is("#destInput")) {
                            $("#cityInput").hide();
                        }
                    });


                }
            });

        },
        showCityInput: function ($destInput, cityInfo) {
            var baseHtml = '<div id="cityInput" class="select-list"><div class="address_tabs"></div><div class="addr_wrap"></div></div>';
            var $root = null;
            var $addrTab = null;
            var $addrCon = null;
            var cityInputInfo = cityInfo; //此处最好采用传参方式

            function drawCityContent(cityIds, isHide) {
                var citys = cityInputInfo.citys;
                var $cityCon = $("<div/>").addClass("address_content");
                $.each(cityIds, function (i, id) {
                    $.each(citys, function (j, cityItem) {
                        if (id === cityItem.id) {
                            $("<span/>").text(cityItem.name).attr("data-value", cityItem.id).attr("data-pinyin", cityItem.pinyin).attr("data-citypinyin", cityItem.cityPinyin).appendTo($cityCon);
                        }
                    });
                });
                if (isHide) {
                    $cityCon.hide();
                }
                $addrCon.append($cityCon);
            }

            if ($("#cityInput").length > 0) {
                $("#cityInput").show();
            } else {
                $root = $(baseHtml);
                $addrTab = $root.children().eq(0);
                $addrCon = $root.children().eq(1);
                $("<span/>").text(cityInputInfo.hotgroup.name).addClass("current").appendTo($addrTab);
                drawCityContent(cityInputInfo.hotgroup.cityids, false);

                $.each(cityInputInfo.lettergroups, function (i, item) {
                    $("<span/>").text(item.name).appendTo($addrTab);
                    drawCityContent(item.cityids, true);
                });
                $root.css({
                    position: "absolute",
                    left: $destInput.offset().left + "px",
                    top: $destInput.offset().top + $destInput.outerHeight() + "px",
                    zIndex: 9999
                });
                $addrTab.on("click", "span", function (ev) {
                    ev.stopPropagation();
                    $addrTab.find("span").removeClass("current");
                    $(this).addClass("current");
                    $addrCon.children().hide();
                    $addrCon.children().eq($(this).index()).show();
                });

                $addrCon.on("click", "span", function (ev) {
                    ev.stopPropagation();
                    $destInput.val($(this).text());
                    $destInput.attr("data-destpinyin", $(this).attr("data-pinyin"));
                    $destInput.attr("data-destid", $(this).attr("data-value"));
                    $destInput.attr("data-cityPinyin", $(this).attr("data-cityPinyin"));
                    $root.hide();
                });
                $("body").append($root);

            }
        },
        subSearch: function () {
            var $subBtn = $("#searchHouse");
            var $destInput = $("#destInput");
            //对区域进行搜索
            $subBtn.click(function (ev) {
                ev.preventDefault();
                var cityPinyin = $destInput.attr("data-citypinyin");
                var destPinyin = $destInput.attr("data-destpinyin");

                if (cityPinyin == null) {
                    cityPinyin = destPinyin;
                }

                var destId = $destInput.attr("data-destid");

                var isChangzu = true;
                try {
                    var startDate = parseDate($('#startDate').val());
                    var endDate = parseDate($('#endDate').val());

                    isChangzu = startDate.getTime() + 5 * 24 * 3600000 <= endDate.getTime();
                }
                catch (e) {
                }
                var changzuStr = isChangzu ? "/changzu" : "/";

                if (!isChangzu) {
                    $('#pop_cityName').text($('#destInput').val());
                    $('#pop_window_changzu').show();
                }

                var url = "";
                if (cityPinyin !== destPinyin) {
                    url += "/" + cityPinyin + "_gongyu" + changzuStr + "/" + destPinyin + "_s" + destId;
                } else {
                    url += "/" + cityPinyin + "_gongyu" + changzuStr;
                }
                if (window.location.pathname.indexOf("se0") > -1) {
                    url += "/se0";
                }

                if (url.charAt(url.length - 1) != '/') {
                    url += "/";
                }

                $("#mainSearchForm").attr({ "action": url, "target": "_top" }).trigger("submit");
            });
        },
        InitAll: function () {

            // 长租列表页最小入离间隔天数
            var minDaySpan = 1;

            this.InitCityInput();
            this.subSearch();
            //初始化日期输入
            var mindate = parseDate(minDate),
             maxdate = parseDate(maxDate);

            $("#startDate").dateinput({
                min: mindate,
                max: new Date(+maxdate - 24 * 3600000)
            });

            $("#endDate").dateinput({
                min: new Date(+mindate + minDaySpan * 24 * 3600000),
                max: maxdate
            });

            var checkDateApi = $("#startDate").data("dateinput"),
                leaveDateApi = $("#endDate").data("dateinput");

            checkDateApi.change(function (event, date) {
                var leaveDay = parseDate(leaveDateApi.getInput().val()),
                     leaveMinDay = new Date(+date + minDaySpan * 24 * 3600000);

                //  checkDateApi.getInput().next().hide();

                // 如果未设定离店时间或入住时间大于离店时间
                if (!leaveDay || dateGtWeek(date, leaveDay)) {
                    leaveDateApi.setMin(leaveMinDay).setValue(leaveMinDay).show();
                } else if (leaveDay) {
                    leaveDateApi.setMin(leaveMinDay);
                }

            });
            leaveDateApi.change(function (event, date) {
                var startDay = parseDate(checkDateApi.getInput().val()),
                     startMaxDay = new Date(+date - 24 * 3600000);

                // leaveDateApi.getInput().next().hide();

                // 如果未设定入住时间或者入住时间大于离店时间
                if (!startDay || compareDate(startDay, date)) {
                    checkDateApi.setValue(startMaxDay).show();
                }
            });
        }
    };

    //设置scroll到房屋信息位置
    if (/gongyu\/\d{1,2}/.test(location.pathname)) {
        var $sortWrap = $("#sortWrapper");
        $(window).scrollTop($sortWrap.offset().top);
    }

    //初始化顶部房屋搜索部分


    //初始化异步加载部分
    asynSearchList.initView();
    window.isShow = true;

    function showRecom() {
        var $recomList = $("#recom-list");
        var $recomItems;
        var recomIndex = 0;
        var $listWraper = $("#listWrapper");
        var $container = $("#recom-list-carousel");
        var $prevBtn = $("#recom_carousel_prev");
        var $nextBtn = $("#recom_carousel_next");
        var $closeBtn = $("#recom_close");

        $closeBtn.click(function () {
            $recomList.slideUp();
            window.isShow = false;
        });
        if ($recomList.length > 0) {
            $recomItems = $recomList.find("li");
            $recomItems.slice(3).hide();
            setTimeout(function () {
                if (!window.isShow) {
                    return;
                }
                $recomList.slideDown(function () {
                    window.isShow = true;

                    if ($container.children().length <= 3) {
                        $prevBtn.hide();
                        $nextBtn.hide();
                        return;
                    }
                    var $focusimgcarousel = $container.carousel({
                        loop: true,
                        indicator: true,
                        duration: 0.5,
                        group: 3
                    });
                    $prevBtn.on('click', function (ev) {
                        ev.preventDefault();
                        $focusimgcarousel.carousel('prev');
                        //if ($focusimgcarousel.carousel("getMoveState") === "min") {
                        //    $prevBtn.hide();
                        //    $nextBtn.show();
                        //} else {
                        //    $nextBtn.show();
                        //}
                    });
                    $nextBtn.on('click', function (ev) {
                        ev.preventDefault();
                        $focusimgcarousel.carousel('next');
                        //if ($focusimgcarousel.carousel("getMoveState") === "max") {
                        //    $nextBtn.hide();
                        //    $prevBtn.show();
                        //} else {
                        //    $prevBtn.show();
                        //}
                    });
                });
            }, 1000);
        }
    }
    $(function () {
        showRecom();
    });

    (function initEduction() {
        var $educationContent = $("#educationContent");
        if ($educationContent.length > 0) {
            setTimeout(function () {
                var $bigImg = $educationContent.find("a:visible");
                $bigImg.animate({ height: "48px" }, function () {
                    $bigImg.hide().siblings().show();
                });
            }, 5000);
        }
    })();


    $(document).on('click', '#btnAjaxLogin', function () {
        if (!window['isLogin']) {
            showLogin();
        }
    });

    $(document).on('click', '.link-ajax-login', function () {
        if (!window['isLogin']) {
            showLogin();
        }

    });

    function showLogin() {
        $("#loginBtn").click();
        $("#account").focus();
        //$("#validateArea").hide();
    }
    /*显示推荐*/

    //$("#merit .lab-text:eq(0)").powerFloat({
    //    eventType: "degHover",
    //    target: $("#j-experience-info"),
    //    position: "7-5",
    //    edgeAdjust: false,
    //    reverseSharp: true,
    //    offsets: {
    //        x: -30,
    //        y: 0
    //    }
    //});
    window.listJsExecuteSuccessMark = {};

    if (traceLog && traceData) {
        traceLog("unitlist", {
            pageName: "UnitList",
            pageId: traceData.pageId,
            prevId: getPrevId(),
            ConditionString: JSON.stringify(traceData.conditionForTrace),
            url: traceData.url,
            params: traceData.params
        });
    }
})();
/*! jq.carousel / jQuery plugin - v2.4.3 - 2012-11-08 1:11:07
* http://5509.github.com/jq.carousel/
* Copyright (c) 2012 Kazunori Tokuda; Licensed MIT */

;(function($, undefined) {
 
  var Carousel = function(parent, conf) {
    this.namespace = 'Carousel';
    if ( this instanceof Carousel ) {
      return this.init(parent, conf);
    }
    return new Carousel(parent, conf);
  };
  Carousel.prototype = {

    init: function(parent, conf) {
      var self = this;

      self.conf = $.extend({
        vertical : false,   // boolean
        loop     : true,    // boolean
        easing   : 'swing', // or custom easing
        start    : 1,       // int
        group    : 1,       // int
        duration : 0.2,     // int or float, 0.2 => 0.2s
        indicator: false    // boolean
      }, conf);
      self.initSuccess = true;
      self.$elem = parent;
      if (self.$elem.length === 0 || self.$elem.children().length === 0) {
          self.initSuccess = false;
          return self;
      }
      self.$carousel_wrap = $('<div></div>');

      self._build();
      self._setIndicator();
      self._eventify();

      return self;
    },

    _build: function() {
      var self = this,
        conf = self.conf,
        start_pos = 0,
        box_total_size = 0;

      self.offset_prop = self.conf.vertical ? 'offsetHeight' : 'offsetWidth';
      self.float = conf.vertical ? 'none' : 'left';
      self.position = conf.vertical ? 'top' : 'left';
      self.prop = conf.vertical ? 'height' : 'width';

      self.view_size = self.$elem[0][self.offset_prop];
      self.total_size = 0;
      self.current = conf.start;

      self.$items = self.$elem.children();
      self.$items_original = self.$items.clone();
      self.items_length = self.$items.length;
      self.items_len_hidden = 0;

      self.$elem.html(
        self.$carousel_wrap
          .html(
            self.$items
          )
      );

      box_total_size = self.items_length * self.$items[0][self.offset_prop];

      // setup
      self.$items.css({
        float: self.float
      });
      each(self.$items, function(i) {
        var item = this;

        item.carousel_id = i;
        item.$elem = $(this);
        item.data_size = item[self.offset_prop];
        item.orig_size = item.$elem.css(self.prop);

        if ( self.items_len_hidden > self.view_size ) return;
        self.items_len_hidden = self.items_len_hidden + item.data_size;
      });
      self.item_size = self.$items.eq(0)[0].data_size;
      self.items_len_hidden = self.items_len_hidden / self.item_size;

      if ( conf.group !== 1 ) {
        self._groupSetup();
        if ( conf.loop ) {
          self._cloneGroup();
        }
      } else {
        // clone nodes
        if ( conf.loop ) {
          self._cloneItem();
        }
      }

      self.$elem.css({
        overflow: 'hidden',
        position: 'relative'
      });

      // carousel width and height
      if ( conf.loop ) {
        start_pos = self.items_len_hidden + self.current - 1;
        self.current_pos = -start_pos * self.item_size;
        self.default_pos = -self.items_len_hidden * self.item_size;
      } else {
        start_pos = self.items_length < conf.start ? 1 : conf.start;
        self.current_pos = -(start_pos-1) * self.item_size;
        self.default_pos = 0;
      }
      self.$carousel_wrap.css({
        position: 'relative'
      })
      .css(self.position, self.current_pos);

      if ( self.vertical ) {
        self.$carousel_wrap.css('width', self.$items.eq(0)[0].offsetWidth);
      } else {
        self.$carousel_wrap.css('height', self.$items.eq(0)[0].offsetHeight);
      }

      // max and min point
      self.max_point = self.default_pos - (self.item_size * self.items_length);
      self.min_point = self.default_pos;

      // move size
      self.move_size = self.item_size;

      if ( conf.group === 1 ) {
        self.$items = self.$carousel_wrap.children();
      } else {
        self.$items = self.$carousel_wrap.find('.carousel_group_inner');
      }
      self._setSize();
      self.$elem.trigger('carousel.ready');
    },

    _eventify: function() {
      var self = this,
        conf = self.conf,
        indicator = undefined;

      if ( !conf.indicator ) {
        return;
      }
      indicator = self.$indicator.data('indicator');
      self.$elem.bind({
        'Carousel.prev': function() {
          indicator.active();
        },
        'Carousel.next': function() {
          indicator.active();
        }
      });
    },

    _groupSetup: function() {
      var self = this,
        i = 0, k = 0,
        l = self.items_length,
        conf = self.conf,
        division = l / conf.group,
        group_length = Math.ceil(division),
        group = new Array(group_length),
        group_size = self.item_size * conf.group;

      for ( ; i < l; i++ ) {
        if ( i !== 0 && i % conf.group === 0 ) {
          k = k + 1;
        }
        if ( !group[k] ) {
          group[k] = $('<div class="carousel_group_inner"></div>');
          group[k]
            .css('float', self.float)
            .css(self.prop, group_size);
        }
        group[k].append(self.$items.eq(i));
      }
      for ( i = 0; i < group_length; i++ ) {
        self.$carousel_wrap.append(group[i]);
      }
      self.$items = self.$carousel_wrap.find('.carousel_group_inner');
      self.items_length = self.$items.length;
      self.items_len_hidden = 1;
      self.item_size = self.item_size * conf.group;
    },

    // returns first and last items
    _cloneItem: function() {
      var self = this,
        len = self.items_len_hidden,
        flexnth = function(state, n) {
          var i, $elems = this, nth = [];
          for ( i = 0; i < n; i++ ) {
            if ( i === n ) break;
            nth.push(
              $elems.eq(
                state !== '<' ? $elems.length-(1+i) : i
              ).clone()
            );
          }
          return $(nth);
        },
        reverse = function() {
          var elems = [];
          $.each(this, function(i, $item) {
            elems.unshift($item.clone());
          });
          return $(elems);
        },
        $first = reverse.call(flexnth.call(self.$items, '<', len)),
        $last = reverse.call(flexnth.call(self.$items, '>', len));

      each($first, function() {
        self.$items.eq(self.$items.length-1).after(this);
      });
      each($last, function() {
        self.$items.eq(0).before(this);
      });
    },

    _cloneGroup: function() {
      var self = this,
        len = self.items_len_hidden,
        $first = self.$items.eq(0).clone(),
        $last = self.$items.eq(self.items_length-1).clone();

      self.$items.eq(0).before($last);
      self.$items.eq(self.$items.length-1).after($first);
    },

    // refresh totalWitdh
    _getSize: function(index) {
      var self = this,
        $items = undefined;

      if ( self.conf.group === 1 ) {
        $items = self.$carousel_wrap.children();
      } else {
        $items = self.$elem.find('.carousel_group_inner');
      }

      self.total_size = 0;
      each($items, function(i) {
        var item = this;

        item.data_size = item[self.offset_prop];
        // set total_width
        self.total_size = self.total_size + item.data_size;
      });
    },

    _setSize: function() {
      var self = this;
      self._getSize();
      self.$carousel_wrap
        .css(self.prop, self.total_size);
    },

    _moveState: function() {
      var self = this,
        view_size = self.view_size,
        items_block_size = self.items_length * self.item_size;

      if ( items_block_size <= view_size ) {
        return false;
      } else
      if ( self.current === self.items_length ) {
        return 'max';
      } else
      if ( self.current === 1 ) {
        return 'min';
      } else {
        return true;
      }
    },

    _getNext: function(current) {
      var self = this,
        conf = self.conf;
      if ( current + 1 > self.items_length ) {
        current = 1;
      } else {
        current = current + 1;
      }
      return current;
    },

    _getPrev: function(current) {
      var self = this,
        conf = self.conf;
      if ( current - 1 === 0 ) {
        current = self.items_length;
      } else {
        current = current - 1;
      }
      return current;
    },

    _setCurrent: function(direction) {
      var self = this,
        num = undefined,
        current = self.current;
      // direction: true => next, false => prev
      if ( direction ) {
        num = self._getNext(current);
      } else {
        num = self._getPrev(current);
      }
      self.current = num;
    },

    _toNext: function() {
      var self = this,
        conf = self.conf,
        hidden_len = self.items_len_hidden,
        prop = {};

      if ( !self.conf.loop && self.current === self.items_length ) {
        return;
      }
      self._setCurrent(true);

      self.current_pos = self.current_pos - self.move_size;
      if ( self.current_pos < self.max_point ) {
        self.$carousel_wrap.css(self.position, self.default_pos);
        self.current_pos = self.default_pos - self.move_size;
      }

      prop[self.position] = self.current_pos;

      self.$carousel_wrap
      .animate(prop, {
        queue: false,
        easing: conf.easing,
        duration: conf.duration*1000,
        complete: function() {
          self.$elem.trigger('Carousel.next');
        }
      });
    },

    _toPrev: function() {
      var self = this,
        conf = self.conf,
        hidden_len = self.items_len_hidden,
        total_length = self.items_length + hidden_len,
        items_size = self.item_size * self.items_length,
        prop = {};

      if ( !self.conf.loop && self.current === 1 ) {
        return;
      }
      self._setCurrent(false);

      self.current_pos = self.current_pos + self.move_size;
      if ( self.default_pos < self.current_pos ) {
        self.$carousel_wrap.css(self.position, -self.item_size * total_length);
        self.current_pos = self.default_pos - items_size + self.move_size;
      }

      prop[self.position] = self.current_pos;

      self.$carousel_wrap
      .animate(prop, {
        queue: false,
        easing: conf.easing,
        duration: conf.duration*1000,
        complete: function() {
          self.$elem.trigger('Carousel.prev');
        }
      });

    },

    _getIndicator: function(num) {
      var self = this,
        indicator = Indicator(self, num),
        $indicator = $('<div class="carousel_indicator"></div>');

      $indicator.data('indicator', indicator);
      $indicator.append(indicator.$elems);

      return $indicator;
    },

    _setIndicator: function(num) {
      var self = this,
        indicator = undefined;
      if ( !self.conf.indicator ) {
        return;
      }
      if ( !self.$indicator ) {
        self.$indicator = self._getIndicator(num);
        self.$elem.after(self.$indicator);
      } else {
        indicator = self.$indicator.data('indicator');
        self.$indicator.append(
          indicator.refresh()
        );
      }
    },

    _callAPI: function(api, arguments) {
     var self = this;
     if(!self.initSuccess) {
            return;
     }
      if ( typeof self[api] !== 'function' ) {
        throw api + ' does not exist of Carousel methods.';
      } else
      if ( /^_/.test(api) && typeof self[api] === 'function' ) {
        throw 'Method begins with an underscore are not exposed.';
      }
      return self[api](arguments);
    },

    indicator: function(num) {
      var self = this;
      return self._getIndicator(num);
    },

    getCurrent: function() {
      var self = this;
      return self.current - 1;
    },

    getMoveState: function() {
      var self = this;
      return self._moveState();
    },

    prev: function() {
      var self = this;
      self._toPrev();

      return self.$elem;
    },

    next: function() {
      var self = this;
      self._toNext();

      return self.$elem;
    },

    reset: function(conf) {
      var self = this;
      self.$elem
        .empty()
        .append(self.$items_original);

      if ( conf ) {
        self.conf = $.extend(self.conf, conf);
      }
      self.$elem.trigger('Carousel.reset');
      return self.$elem;
    },

    refresh: function() {
      var self = this;
      self.total_size = 0;
      self._build();
      self._setIndicator();

      self.$elem.trigger('Carousel.refresh');
      return self.$elem;
    }
  };

  var Indicator = function(carousel, num) {
    this.namespace = 'Indicator';
    if ( this instanceof Indicator ) {
      return this.init(carousel, num);
    }
    return new Indicator(carousel, num);
  };
  Indicator.prototype = {
    init: function(carousel, num) {
      var self = this;
      self.carousel = carousel;
      self._build(num);
    },

    _build: function(num) {
      var self = this,
        carousel = self.carousel,
        current = carousel.getCurrent(),
        i = 0, l = carousel.items_length,
        indi = '',
        active = '';
        for ( ; i < l; i++ ) {
          if ( i === current ) {
            active = ' class="active"';
          } else {
            active = '';
          }
          indi = indi + '<span' + active + '>';
          indi = indi + (num ? i : '');
          indi = indi + '</span>';
        }
        self.$elems = $(indi);
    },

    _setActive: function() {
      var self = this,
        carousel = self.carousel;

        self.$elems.removeClass('active');
        self.$elems.eq(carousel.getCurrent()).addClass('active');
    },

    refresh: function() {
      var self = this;
      self.$elems.remove();
      self._build();
      return self.$elems;
    },

    active: function() {
      var self = this;
      self._setActive();
    }
  };

  function each(arr, func) {
    var i = 0,
        l = undefined;

    // arr === number
    if ( /^\d+$/.test(arr) ) {
      arr = new Array(arr);
    }
    l = arr.length;

    for ( ; i < l; i = i + 1 ) {
      func.apply(arr[i], ([i]).concat(arguments));
    }
  }

  // $.fn extend
  jQuery.fn.carousel = function(conf, arguments) {
    var carousel = this.data('carousel');

    if ( carousel ) {
      return carousel._callAPI(conf, arguments);
    } else {
      carousel = Carousel(this, conf);
      this.data('carousel', carousel);
      return this;
    }
  };

}(jQuery));

/**
 * @license 
 * jQuery Tools @VERSION Overlay - Overlay base. Extend it.
 * 
 * NO COPYRIGHTS OR LICENSES. DO WHAT YOU LIKE.
 * 
 * http://flowplayer.org/tools/overlay/
 *
 * Since: March 2008
 * Date: @DATE 
 */
(function ($) {

    // static constructs
    $.tools = $.tools || { version: '@VERSION' };

    $.tools.overlay = {

        addEffect: function (name, loadFn, closeFn) {
            effects[name] = [loadFn, closeFn];
        },

        conf: {
            close: null,
            closeOnClick: true,
            closeOnEsc: true,
            closeSpeed: 200,
            effect: 'default',

            // since 1.2. fixed positioning not supported by IE6
            fixed: !$.browser.msie || $.browser.version > 6,

            left: 'center',
            load: false, // 1.2
            mask: null,
            oneInstance: true,
            speed: 'normal',
            target: null, // target element to be overlayed. by default taken from [rel]
            top: '10%'
        }
    };


    var instances = [], effects = {};

    // the default effect. nice and easy!
    $.tools.overlay.addEffect('default',

    /* 
    onLoad/onClose functions must be called otherwise none of the 
    user supplied callback methods won't be called
    */
		function (pos, onLoad) {

		    var conf = this.getConf(),
				 w = $(window);

		    if (!conf.fixed) {
		        pos.top += w.scrollTop();
		        pos.left += w.scrollLeft();
		    }

		    pos.position = conf.fixed ? 'fixed' : 'absolute';
		    this.getOverlay().css(pos).fadeIn(conf.speed, onLoad);

		}, function (onClose) {
		    this.getOverlay().fadeOut(this.getConf().closeSpeed, onClose);
		}
	);


    function Overlay(trigger, conf) {

        // private variables
        var self = this,
			 fire = trigger.add(self),
			 w = $(window),
			 closers,
			 overlay,
			 opened,
			 maskConf = $.tools.expose && (conf.mask || conf.expose),
			 uid = Math.random().toString().slice(10);


        // mask configuration
        if (maskConf) {
            if (typeof maskConf == 'string') { maskConf = { color: maskConf }; }
            maskConf.closeOnClick = maskConf.closeOnEsc = false;
        }

        // get overlay and trigger
        var jq = conf.target || trigger.attr("rel");
        overlay = jq ? $(jq) : null || trigger;

        // overlay not found. cannot continue
        if (!overlay.length) { throw "Could not find Overlay: " + jq; }

        // trigger's click event
        if (trigger && trigger.index(overlay) == -1) {
            trigger.click(function (e) {
                self.load(e);
                return e.preventDefault();
            });
        }

        // API methods  
        $.extend(self, {

            load: function (e) {

                // can be opened only once
                if (self.isOpened()) { return self; }

                // find the effect
                var eff = effects[conf.effect];
                if (!eff) { throw "Overlay: cannot find effect : \"" + conf.effect + "\""; }

                // close other instances?
                if (conf.oneInstance) {
                    $.each(instances, function () {
                        this.close(e);
                    });
                }

                // onBeforeLoad
                e = e || $.Event();
                e.type = "onBeforeLoad";
                fire.trigger(e);
                if (e.isDefaultPrevented()) { return self; }

                // opened
                opened = true;

                // possible mask effect
                if (maskConf) { $(overlay).expose(maskConf); }

                // position & dimensions 
                var top = conf.top,
					 left = conf.left,
					 oWidth = overlay.outerWidth({ margin: true }),
					 oHeight = overlay.outerHeight({ margin: true });

                if (typeof top == 'string') {
                    top = top == 'center' ? Math.max((w.height() - oHeight) / 2, 0) :
						parseInt(top, 10) / 100 * w.height();
                }

                if (left == 'center') { left = Math.max((w.width() - oWidth) / 2, 0); }


                // load effect  		 		
                eff[0].call(self, { top: top, left: left }, function () {
                    if (opened) {
                        e.type = "onLoad";
                        fire.trigger(e);
                    }
                });

                // mask.click closes overlay
                if (maskConf && conf.closeOnClick) {
                    $.mask.getMask().one("click", self.close);
                }

                // when window is clicked outside overlay, we close
                if (conf.closeOnClick) {
                    $(document).on("click." + uid, function (e) {
                        if (!$(e.target).parents(overlay).length) {
                            self.close(e);
                        }
                    });
                }

                // keyboard::escape
                if (conf.closeOnEsc) {

                    // one callback is enough if multiple instances are loaded simultaneously
                    $(document).on("keydown." + uid, function (e) {
                        if (e.keyCode == 27) {
                            self.close(e);
                        }
                    });
                }


                return self;
            },

            close: function (e) {

                if (!self.isOpened()) { return self; }

                e = e || $.Event();
                e.type = "onBeforeClose";
                fire.trigger(e);
                if (e.isDefaultPrevented()) { return; }

                opened = false;

                // close effect
                effects[conf.effect][1].call(self, function () {
                    e.type = "onClose";
                    fire.trigger(e);
                });

                // unbind the keyboard / clicking actions
                $(document).off("click." + uid + " keydown." + uid);

                if (maskConf) {
                    $.mask.close();
                }

                return self;
            },

            getOverlay: function () {
                return overlay;
            },

            getTrigger: function () {
                return trigger;
            },

            getClosers: function () {
                return closers;
            },

            isOpened: function () {
                return opened;
            },

            // manipulate start, finish and speeds
            getConf: function () {
                return conf;
            }

        });

        // callbacks	
        $.each("onBeforeLoad,onStart,onLoad,onBeforeClose,onClose".split(","), function (i, name) {

            // configuration
            if ($.isFunction(conf[name])) {
                $(self).on(name, conf[name]);
            }

            // API
            self[name] = function (fn) {
                if (fn) { $(self).on(name, fn); }
                return self;
            };
        });

        // close button
        closers = overlay.find(conf.close || ".closeBtnIced");

        if (!closers.length && !conf.close) {
            closers = $('<a class="close"></a>');
            overlay.prepend(closers);
        }

        closers.live("click", function (e) {
            self.close(e);
        });

        // autoload
        if (conf.load) { self.load(); }

    }

    // jQuery plugin initialization
    $.fn.overlay = function (conf) {

        // already constructed --> return API
        var el = this.data("overlay");
        if (el) { return el; }

        if ($.isFunction(conf)) {
            conf = { onBeforeLoad: conf };
        }

        conf = $.extend(true, {}, $.tools.overlay.conf, conf);

        this.each(function () {
            var el = new Overlay($(this), conf), self = $(this);
            instances.push(el);
            self.data("overlay", el);
        });
        return conf.api ? el : this;
    };
    // bind resize event
    $(window).resize(function () {
        $.each(instances, function (i, el) {
            if (!el.isOpened()) {
                return true;
            }
            var conf = el.getConf(),
            w = $(window),
            oel = el.getOverlay(),
            top = conf.top,
            left = conf.left,
            oWidth = oel.outerWidth(true),
            oHeight = oel.outerHeight(true),
            pos;

            if (typeof top == 'string') {
                top = top == 'center' ? Math.max((w.height() - oHeight) / 2, 0) :
                    parseInt(top, 10) / 100 * w.height();
            }

            if (left == 'center') { left = Math.max((w.width() - oWidth) / 2, 0); }

            pos = { top: top, left: left }

            if (!conf.fixed) {
                pos.top += w.scrollTop();
                pos.left += w.scrollLeft();
            }

            pos.position = conf.fixed ? 'fixed' : 'absolute';
            oel.css(pos);
        });
    });

})(jQuery);


