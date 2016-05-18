<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    
    <title>租前须知_邻京有屋 轻时尚单身公寓</title>
    <meta name="keywords" content="" />
    <meta name="description" content="" />
    
    <script language="javascript">
msg = "租前须知_邻京有屋 轻时尚单身公寓";

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
        body, html {
            position: relative;margin-bottom:0;
        }

        .back_box {
            background: #fff;
        }

        .question_list_box {
            width: 270px;
        }

            .question_list_box.affix {
                top: 10px;
            }

            .question_list_box.affix-bottom {
                position: absolute;
            }

        footer {
            position: static;
        }
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

    <input id="controller" type="hidden" value="" />
    
    <input id="action" type="hidden" value="Questions" />
        <!-- 引入公共头 -->
        @include('header')

    <div class="clearfix"></div>


    

<div class="body_back_f back_box">
    <div class="container container-backtop">
        <ol class="breadcrumb">
        
          <li><a href="{{URL('index')}}">首页</a></li>
            
            <li class="active"><a href="{{URL('index/notices')}}">租前须知</a></li>
            
        </ol>
        <div class="row">
            <div class="col-md-3 hidden-xs hidden-sm">
                <div id="myaffix" class=" question_list_box hidden-print " data-spy="affix" data-offset-top="20">
                    <h4 class="title">FAQ</h4>
                    <ul class="nav bs-sidenav list-unstyled lh28">

                            <li><a href="#1">1、纳尼？邻京有屋为啥没有中介费？</a></li>
                            <li><a href="#4">2、短租怎么算？</a></li>
                            <li><a href="#2">3、房租付款的方式？</a></li>
                            <li><a href="#8">4、解放钱包方便快捷，新一代“优客月付”</a></li>
                            <li><a href="#6">5、两个人住应该挑选什么样的房间？</a></li>
                            <li><a href="#70">6、邻京有屋入住安全吗？会不会有异性合租？</a></li>
                            <li><a href="#71">7、交定方式</a></li>
                            <li><a href="#72">8、交定签约</a></li>
                            <li><a href="#5">9、为什么邻京有屋的押金是两个月？</a></li>
                            <li><a href="#28">10、管理服务费都包括些神马？</a></li>
                            <li><a href="#3">11、所有的租房规则我都了解了，要怎么定房？</a></li>
                            <li><a href="#7">12、我是土豪，我要加配空调和电视？</a></li>
                            <li><a href="#9">13、关于物业水电气费？</a></li>
                            <li><a href="#15">14、我想讲价？</a></li>
                            <li><a href="#18">15、关于上门保洁？</a></li>
                            <li><a href="#19">16、关于隔间的臆想？</a></li>
                            <li><a href="#20">17、能不能养宠物？</a></li>
                            <li><a href="#22">18、我需要沙发 茶几 纱窗  男票 洗碗机 女朋友 总之我要求增配？</a></li>
                            <li><a href="#23">19、收了那么多钱，就没有免费的吗?</a></li>
                            <li><a href="#24">20、中途因为回老家、换工作、和男（女）朋友同居去了。换房、退租需要承担的费用？</a></li>
                            <li><a href="#26">21、你搬家我买单是什么意思？</a></li>
                            <li><a href="#27">22、售后问题找谁？</a></li>
                            <li><a href="#69">23、缴定金、续缴租金的收款账号是啥？</a></li>
                            <li><a href="#29">24、关于整租？</a></li>
                            <li><a href="#33">25、你好，我是彩蛋。。哈哈哈哈哈哈哈哈</a></li>

                    </ul>
                </div>
            </div>
            <div class=" col-md-9 question_con">

                    <div class="media media-box">
                        <div class="media-body">
                            <h4 class="title" id="1"><span class="i">Q1</span> 纳尼？邻京有屋为啥没有中介费？</h4>
                            <div class="content">
                                <span style="font-size:14px;">答：</span><br />
<p>
	<span style="font-size:14px;">咳咳，</span> 
</p>
<p>
	<span style="font-size:14px;">邻京有屋致力于“年轻人租房”的房屋租赁公司。</span> 
</p>
<p>
	<span style="font-size:14px;">业务涉房屋加盟托管、设计装修、租后管理服务。</span> 
</p>
<p>
	<span style="font-size:14px;">邻京有屋</span><span style="font-size:14px;line-height:1.5;">是新型的互联网租房模式。网上看房，预约入住，租房就这么简单。</span> 
</p>
<p>
	<span style="font-size:14px;line-height:1.5;">信息透明，价格透明，租客都是对生活有一定品质要求的年轻人。</span> 
</p>
<p>
	<br />
</p>
<p>
	<span style="line-height:1.5;font-size:14px;">当然，实在要给中介费，我们也收着。</span><img src="{{URL::asset('../public')}}/templets/htm/style/images/j_0042.gif" /> 
</p>
<p>
	<br />
</p>
                            </div>
                        </div>
                    </div>
                    <div class="media media-box">
                        <div class="media-body">
                            <h4 class="title" id="4"><span class="i">Q2</span> 短租怎么算？</h4>
                            <div class="content">
                                <p>
	答：
</p>
<p class="p" style="margin-left:0.0000pt;text-indent:0.0000pt;">
	1、3个月以下是不租哒，<span>短租=签约时间不足一年。</span> 
</p>
<p class="p" style="margin-left:0.0000pt;text-indent:0.0000pt;">
	2、签约租期不到一年，每月<span>租金会上浮200元，<span>管理服务费同样上浮。</span></span> 
</p>
<p class="p" style="margin-left:0.0000pt;text-indent:0.0000pt;">
	<span>    该政策于2015年8月1日起实施</span>
</p>
<p class="p" style="margin-left:0.0000pt;text-indent:0.0000pt;">
	3、租房请<span style="line-height:1.5;">详询400-000-4170。</span><img src="{{URL::asset('../public')}}/templets/htm/style/images/110.gif" border="0" alt="" /> 
</p>
<p>
	<br />
</p>
<p>
	<br />
</p>
<br />
                            </div>
                        </div>
                    </div>
                    <div class="media media-box">
                        <div class="media-body">
                            <h4 class="title" id="2"><span class="i">Q3</span> 房租付款的方式？</h4>
                            <div class="content">
                                <p class="p" style="margin-left:0.0000pt;">
	答：
</p>
<p class="p" style="margin-left:0.0000pt;">
	为满足大家各种需求，我们有多种付款方式，一定有最适合你的。
</p>
<p class="p" style="margin-left:0.0000pt;">
	下面简单介绍，也可详询400-000-4170。
</p>
<p class="p" style="margin-left:0.0000pt;">
	多项优惠的话只能任选其一，不能反复重叠的哟。
</p>
<p class="p" style="margin-left:0.0000pt;">
	1、月付（房租上浮6%）、季付、半年付（9.8折）、年付（9.5折）；
</p>
<p class="p" style="margin-left:0.0000pt;">
	2、大家都关心的月付问题，后面有专门为大家解答哟
</p>
<p class="p">
	3、银联代扣：实现房租、管理费、水电气费的一卡代缴，让租客更贴近“现代化”，目前所有租客都积极参与我们的银联代扣项目，方便快捷哦。
</p>
<p class="p">
	4、当然所有费用明细都能查到，不用担心数额不对的问题，若有疑问也不用着急，官网个人中心以及微信都有详细账单，也可通过客服或者管家查询核实。
</p>
<br />
                            </div>
                        </div>
                    </div>
                    <div class="media media-box">
                        <div class="media-body">
                            <h4 class="title" id="8"><span class="i">Q4</span> 解放钱包方便快捷，新一代“优客月付”</h4>
                            <div class="content">
                                <p>
	答：
</p>
<p>
	<br />
</p>
<p class="p" style="margin-left:0.0000pt;">
	优客月付已经上线，减少租客冗长的银行办理手续，只需与带看管家签订月付合同即可完成，当然还是有小小的条件：
</p>
<p class="p" style="margin-left:0.0000pt;">
	享受优客月付需要满足一年起租的条件哦，并缴纳每月租金6%的月付费率（银行收取）
</p>
<p class="p" style="margin-left:0.0000pt;">
	即：享受月付时，优客月付租金=1.06*租金
</p>
<p class="p" style="margin-left:0.0000pt;">
	首次支付：押二付一&nbsp;（毫无鸭梨耶~）<br />
=优客月付租金的押金*2&nbsp;+优客月付租金*1+&nbsp;优客月付租金的管理服务费*1<br />
管理服务费随房租征收，中途退租，退还剩余月份费用。<br />
附加增配项目：如加装空调等，都单独收取，不随租金上浮6%，但是会随服务管理费上浮10%。
</p>
<p class="MsoNormal" style="margin-left:0pt;text-indent:0pt;background-color:#FFFFFF;">
	------------------------------------------------------
</p>
<p class="p" style="margin-left:0.0000pt;">
	以600元房子为例：
</p>
<p class="p" style="margin-left:0.0000pt;">
	该房子的优客月付租金=1.06*租金=1.06*600=636<br />
因此需首次支付：<br />
优客月付押金：636元*2个月=1272元<br />
优客月付租金：636元*1个月=636元<br />
优客月付租金的管理服务费（636元*10%）=63.6元*1个月=63.6元<br />
共计：1971.6元
</p>
<p class="MsoNormal">
	------------------------------------------------------
</p>
<p class="p" style="margin-left:0.0000pt;">
	支付方式：&nbsp;现场：与签约管家用POS机支付<br />
预定：支付宝转款至&nbsp;sccaiwu@uoko.com
</p>
<p class="MsoNormal">
	------------------------------------------------------
</p>
<p class="p" style="margin-left:0.0000pt;">
	后续支付：剩余11个月房租，按月按时存入自己绑定的银行卡即可！
</p>
<p class="p" style="margin-left:0.0000pt;">
	注意昂：2015年3月4日10:00前优客月付租金还未上浮6%。成都建设路片区无法享受优客月付，只能选择农商月付，详询400-000-4170<br />
满足一年起租条件的，才能选择月付！！！中途解约都将有高昂的违约金，农商银行的违约成本更高，冤有头债有主：违约金是银行收取的···
</p>
<p>
	<br />
</p>
<p>
	<img src="{{URL::asset('../public')}}/templets/htm/style/images/j_0035.gif" /> 
</p>
                            </div>
                        </div>
                    </div>
                    <div class="media media-box">
                        <div class="media-body">
                            <h4 class="title" id="6"><span class="i">Q5</span> 两个人住应该挑选什么样的房间？</h4>
                            <div class="content">
                                <p>
	答：
</p>
<p>
	<span>
	<p class="p" style="margin-left:0.0000pt;">
		1、为了大家居住的舒适，公共卫生间、厨房的合理使用。
	</p>
	<p class="p" style="margin-left:0.0000pt;">
		2、邻京有屋的房源有三种类型适合两个人住：主卧、双人房、可住两人。这三种以外的房子，不能住两个人呢。
	</p>
	<p class="MsoNormal">
		3、可以住两个人的房间，房间详情都有标注，若超额入住可能被清退哦，好环境要大家营造
	</p>
</span>
</p>
<p>
	<img src="{{URL::asset('../public')}}/templets/htm/style/images/j_0030.gif" /> 
</p>
                            </div>
                        </div>
                    </div>
                    <div class="media media-box">
                        <div class="media-body">
                            <h4 class="title" id="70"><span class="i">Q6</span> 邻京有屋入住安全吗？会不会有异性合租？</h4>
                            <div class="content">
                                <p>
	答：
</p>
<p>
	<br />
</p>
<p class="p" style="margin-left:0.0000pt;text-indent:0.0000pt;">
	1、&nbsp;我们和你一样在意租客的素质。<br />
2、&nbsp;为了合租室友的稳定性，我们拒绝了大多数短租需求的租客。<br />
3、&nbsp;邻京有屋暂时没有男生/女生的公寓，如果同一套房子入住的大多为男生/女生，我们会尽量为大家匹配同性别的租客。<br />
4、&nbsp;我们也有签约租客认证，即：租客身份证复印件、租客学生证或单位名片、工牌复印件备案。<br />
5、&nbsp;对于合租来说，遇到合适的室友，确实是一件喜大普奔的事情。<span>为了创造这种可能性，</span>我们甚至对租客的年龄段也略有限制。
</p>
<p>
	<br />
</p>
                            </div>
                        </div>
                    </div>
                    <div class="media media-box">
                        <div class="media-body">
                            <h4 class="title" id="71"><span class="i">Q7</span> 交定方式</h4>
                            <div class="content">
                                <p class="MsoNormal">
	1.支付宝转账：
</p>
<p class="MsoNormal" style="margin-left:10.5pt;text-indent:0pt;">
	邻京有屋的支付宝账号：sccaiwu@uoko.com
</p>
<p class="MsoNormal">
	<!--[if !supportLists]-->2.<!--[endif]-->银行卡转账：
</p>
<p class="MsoNormal" style="margin-left:10.5pt;text-indent:0pt;">
	中国银行航空路支行<br />
卡号：1225&nbsp;6805&nbsp;3158<br />
开户行：四川优客投资管理有限公司
</p>
<p class="MsoNormal">
	<!--[if !supportLists]-->3.<!--[endif]-->现场交定：
</p>
<p class="MsoNormal" style="margin-left:10.5pt;text-indent:0pt;">
	与工作人员现场POS机刷卡，或者现场交付现金
</p>
<p class="MsoNormal">
	警示：
</p>
<p class="MsoNormal" style="margin-left:10.5pt;text-indent:0pt;">
	如果您收到来历不明的收款短信，
</p>
<p class="MsoNormal" style="margin-left:10.5pt;text-indent:0pt;">
	请与我们400-000-4170取得联系，并确认账号的真实性哦。
</p>
                            </div>
                        </div>
                    </div>
                    <div class="media media-box">
                        <div class="media-body">
                            <h4 class="title" id="72"><span class="i">Q8</span> 交定签约</h4>
                            <div class="content">
                                <p class="MsoNormal" style="margin-left:21pt;text-indent:-21pt;">
	<!--[if !supportLists]-->1、<!--[endif]-->交定后，以交定时间点开始计时，于交定的3天后开始计算租期（若是未交付房源，以交付时间点开始计时，<span>于交付的3天后开始计算租期</span>）。
</p>
<p class="MsoNormal" style="margin-left:21pt;text-indent:0pt;">
	即，交定后的3天（72小时）内务必与公司签约并支付尾款，否则定金作废！公司有权对交定房间再次出租。
</p>
<p class="MsoNormal" style="margin-left:21pt;text-indent:-21pt;">
	&nbsp; &nbsp; &nbsp; &nbsp;举个栗子：
</p>
<p class="MsoNormal" style="margin-left:21pt;text-indent:0pt;">
	如果是3月1日24:00前完成定金交付，那么，您务必在3月3日24:00前与公司签订租房合同，否则定金作废，且不退不换！
</p>
<p class="MsoNormal" style="margin-left:21pt;text-indent:-21pt;">
	<!--[if !supportLists]-->2、<!--[endif]-->如有特殊情况，需要提前沟通，在双方都同意的情况下+已完成首次房租支付+租期已经从交定后第3天开始计算的三个前提下，可以延迟到交定完成后的7天内签写租房合同。
</p>
<p class="MsoNormal" style="margin-left:21pt;text-indent:-21pt;">
	<!--[if !supportLists]-->3、<!--[endif]-->友情提示：房间以交定为准，逾期则定金不退不换！
</p>
                            </div>
                        </div>
                    </div>
                    <div class="media media-box">
                        <div class="media-body">
                            <h4 class="title" id="5"><span class="i">Q9</span> 为什么邻京有屋的押金是两个月？</h4>
                            <div class="content">
                                <p>
	答：<br />
1、 因为我们家的装修比别家好呀。<img src="{{URL::asset('../public')}}/templets/htm/style/images/41.gif" border="0" alt="" /><br />
2、 入住之后的水电气，物业费由我们垫付代缴，租客先入住，再按照实际耗用付费。<br />
3、 租客的违约成本高，对我们有利。<img src="{{URL::asset('../public')}}/templets/htm/style/images/41.gif" border="0" alt="" /> <br />
4、 合同期满我们会完全按照合同进行核算，并在7个工作日内返还押金到您的银行卡。<img src="{{URL::asset('../public')}}/templets/htm/style/images/j_0034.gif" />
</p>
                            </div>
                        </div>
                    </div>
                    <div class="media media-box">
                        <div class="media-body">
                            <h4 class="title" id="28"><span class="i">Q10</span> 管理服务费都包括些神马？</h4>
                            <div class="content">
                                <p>
	1、客服服务，入住之后的任何问题，欢迎向我们专业的客服人员寻求帮助。
</p>
<p>
	2、每月两次房屋公共区域卫生保洁！！我们的目标是没有蛀牙！
</p>
3、家电家具因自然损坏的而导致上门的维修。咱可是专职维修师父，甩桥头堡好几条街。<br />
<p>
	4、小区物业卫生、水电燃气的分摊代缴服务。不用跟室友谈钱，不用排队缴费，不用担心滞纳金。。
</p>
<p>
	5、真不靠管理服务费挣钱。纯粹是响应习大大的号召，实干兴邦！<img src="{{URL::asset('../public')}}/templets/htm/style/images/j_0040.gif" /> 
</p>
                            </div>
                        </div>
                    </div>
                    <div class="media media-box">
                        <div class="media-body">
                            <h4 class="title" id="3"><span class="i">Q11</span> 所有的租房规则我都了解了，要怎么定房？</h4>
                            <div class="content">
                                答：<br />
1、和我们工作人员确认房子是可租的。<br />
<p>
	2、邻京有屋所有房子以缴定金为定，不做口头预留。
</p>
<p>
	3、定房后三天内签订正式租房协议，预租房以实际交房时间为准。
</p>
<p>
	4、一旦定房，意味着这间房子不会再对外出租，请谨慎考虑，原则上定金不退。
</p>
<p>
	5、因为看上的房子没有缴定金，被别人先下手定了。气坏了概不负责。<img src="{{URL::asset('../public')}}/templets/htm/style/images/j_0041.gif" />
</p>
                            </div>
                        </div>
                    </div>
                    <div class="media media-box">
                        <div class="media-body">
                            <h4 class="title" id="7"><span class="i">Q12</span> 我是土豪，我要加配空调和电视？</h4>
                            <div class="content">
                                答：<br />
1、  邻京有屋的公寓统一配置没有空调、电视。<br />
2、  空调，在确认其房间达到加装空调的条件（有外机预留机位，或阳台的）。可以增配。<br />
3、  电视，在确认其房间达到加装电视的条件（房间有光纤接入口的）。可以增配。电视收看费自理。<br />
<p>
	4、 关于合租与整租加装付费：
</p>
<p>
	      初装在原租金的基础上+100元/台/月，押金和服务管理费相应上涨；
</p>
<p>
	      中途加装租金和服务管理费不上涨，但是单独缴纳空调费120元/台/月（按记租月算）。
</p>
5、 加装后，优客为空调免费增配一个电表，以单独计算用电量。<br />
6、 若自行加装的空调、电视：墙面凿孔留下的孔洞在退房时需恢复原样。优客会为其增配一个电表，收费150元/个。<br />
7、  我都给绕晕了，你们看懂没？    继续骚扰家妹儿  QQ：800072764 <img src="{{URL::asset('../public')}}/templets/htm/style/images/j_0039.gif" /><br />
                            </div>
                        </div>
                    </div>
                    <div class="media media-box">
                        <div class="media-body">
                            <h4 class="title" id="9"><span class="i">Q13</span> 关于物业水电气费？</h4>
                            <div class="content">
                                答：<br />
1、 小区物业、垃圾清运费按户均摊。
<p class="MsoNormal">
	2、电费以合同约定入住人数平均分，优客只结算人均费用；
</p>
<p class="MsoNormal">
	&nbsp; &nbsp; 水气费按定额1.5元/人/天收取。
</p>
<p class="MsoNormal">
	&nbsp; &nbsp; 除水气费外，如果有特殊需求或者其他分配方式请各位租客在按照优客的计算方式缴费后自行协商，优客不参与
</p>
<p class="MsoNormal">
	<span style="line-height:1.5;">3、 费用统一由优客管家跑腿代缴，再随下一季度房租一并征收。</span><img src="{{URL::asset('../public')}}/templets/htm/style/images/j_0033.gif" />
</p>
                            </div>
                        </div>
                    </div>
                    <div class="media media-box">
                        <div class="media-body">
                            <h4 class="title" id="15"><span class="i">Q14</span> 我想讲价？</h4>
                            <div class="content">
                                答：<br />
1、&nbsp; 邻京有屋的房间价格是按照房间大小、配置以及所在小区的区域位置来定价的。一房一价。<br />
2、&nbsp; 我们会根据出租空置情况调节价格。为了公平透明，价格公布后，谢绝任何形式的议价。<br />
3、&nbsp; 除此之外，半年付享租金9.8折的优惠。年付享9.5折优惠。9.5折！！！（租金、管理服务费）的优惠。<br />
4、&nbsp; 享受优惠后，又中途退租的，需补齐之前月份的优惠差价哦~<br />
                            </div>
                        </div>
                    </div>
                    <div class="media media-box">
                        <div class="media-body">
                            <h4 class="title" id="18"><span class="i">Q15</span> 关于上门保洁？</h4>
                            <div class="content">
                                答：<br />
1、 不是说平时地不用扫，垃圾不用倒！一屋不扫何以扫天下！<br />
2、 保洁阿姨是提供深度保洁的。每月两次，间隔15-20天，做不到精确哦，敬请谅解！<br />
3、 如果保洁质量不好，欢迎找小蜜反馈。也会有工作人员电话抽查保洁质量。<br />
4、 如果保洁阿姨把你们的鞋摆整齐了，把用水泡着的电饭煲洗了，请给她点个赞！<img src="{{URL::asset('../public')}}/templets/htm/style/images/j_0037.gif" /><br />
                            </div>
                        </div>
                    </div>
                    <div class="media media-box">
                        <div class="media-body">
                            <h4 class="title" id="19"><span class="i">Q16</span> 关于隔间的臆想？</h4>
                            <div class="content">
                                答：<br />
1、 邻京有屋的房子都不是按照隔间和非隔间来定价的。<br />
2、 我们的每个房间从设计之始，就会充分考虑入住的舒适性和私密性。<br />
3、 隔间的隔墙只是一小部分的墙面，另外在隔墙里面加入了隔音棉，最大限度的避免了不隔音的现象哦。<br />
<br />
<br />
涨姿势：<br />
经过隔音处理的房间隔音效果可以达到减50-60分贝。是达到了★★★★★级酒店的标准的。<br />
但，嘿咻的叫声一般是80-90分贝。玩命叫能达到100分贝。<br />
<br />
男性的声音可以到90分贝，因为那是重低音，就算是水泥实墙也挡不住的啊，魂淡！<img src="{{URL::asset('../public')}}/templets/htm/style/images/j_0031.gif" /><br />
                            </div>
                        </div>
                    </div>
                    <div class="media media-box">
                        <div class="media-body">
                            <h4 class="title" id="20"><span class="i">Q17</span> 能不能养宠物？</h4>
                            <div class="content">
                                答：<br />
1、&nbsp; 我们和你一样的爱宠物，但因为合租室友可能会对毛发过敏。也为了给你的爱宠一个宽敞的环境，合租房不能养宠物。<br />
2、&nbsp; 金鱼、乌龟除外。<img src="templets/htm/style/images/j_0030.gif" />
                            </div>
                        </div>
                    </div>
                    <div class="media media-box">
                        <div class="media-body">
                            <h4 class="title" id="22"><span class="i">Q18</span> 我需要沙发 茶几 纱窗  男票 洗碗机 女朋友 总之我要求增配？</h4>
                            <div class="content">
                                答：<br />
<p>
	1、 啥？
</p>
<p>
	2、邻京有屋提供的公寓配置为标准配置，因此可能无法满足您个人的全部喜好。
</p>
3、 当我们提供给您使用的软装，如窗帘、床垫等无法满足您的需求。<img src="templets/htm/style/images/j_0032.gif" /><br />
4、 您可以：自行更换，并保存好原配置物品，或交回邻京有屋。<br />
<p>
	5、 一句话说：房子是租来的，生活是自己的，喜欢什么，按荷包自己置办点，走的时候还能带走。多好。
</p>
<p>
	6、当然以上除了男票，女朋友我们办不到之外，其他都可以增配，但黑心老板说要给钱……钱……
</p>
                            </div>
                        </div>
                    </div>
                    <div class="media media-box">
                        <div class="media-body">
                            <h4 class="title" id="23"><span class="i">Q19</span> 收了那么多钱，就没有免费的吗?</h4>
                            <div class="content">
                                答：<br />
1、 宽带免费！！<br />
2、 在办理宽带时，我们会优先选择“电信”这样相对靠谱又贵的宽带运营商。<br />
3、 为了降低合租小伙伴们上网慢的疑难杂症。研发部门为每套房子配备了“<a target="_blank" href="http://www.hiwifi.com/">极路由</a>”→ 信号强，上网快。。（小白请自行百度之）<br />
4、 如出现不能上网的问题，在检查自己硬件设备没问题的前提下，电话求助第三方宽带运营商。<br />
                            </div>
                        </div>
                    </div>
                    <div class="media media-box">
                        <div class="media-body">
                            <h4 class="title" id="24"><span class="i">Q20</span> 中途因为回老家、换工作、和男（女）朋友同居去了。换房、退租需要承担的费用？</h4>
                            <div class="content">
                                答：<br />
1、 每一间房子都牵涉方方面面的事。如若变动，现在只能换租和退租。所以，请谨慎考虑。<img src="templets/htm/style/images/j_0038.gif" /><br />
<div>
	&nbsp;2、邻京有屋内部换房，换房需要支付原租金50%的换房费，特别说明：目前只能同城换房哟。 &nbsp;
</div>
3、 若要提前退租，请提前1个月告知，需支付1个月房租作为违约金。<br />
<br />
                            </div>
                        </div>
                    </div>
                    <div class="media media-box">
                        <div class="media-body">
                            <h4 class="title" id="26"><span class="i">Q21</span> 你搬家我买单是什么意思？</h4>
                            <div class="content">
                                <p>
	首次看房当天缴定。。包治拖延犹豫选择综合症！！！
</p>
<p>
	<span style="font-size:12px;line-height:1.5;">（定金为一个月租金），即赠送搬家抵金券！</span><img src="templets/htm/style/images/j_0034.gif" /> 
</p>
<br />
怎么用：<br />
1、需提前1-2天，按照搬家卡片<a href="http://www.cdppt.com/">http://www.cdppt.com/</a>上的联系方式进行联系，QQ最佳，其次是电话。<br />
2、告诉客服：大概物品和件数（编织袋）？起点的街道名？楼层？目的地的街道名？楼层？搬运日期和时间？确定搬家金额。<br />
<p>
	3、特别注意一：我们是按照普通的公里数和物品件数设置的搬家补贴，肯定不能满足所有亲们的搬家需求。
</p>
<p>
	4、特别注意二：行业规定超出三环外5公里需要<span>加收远程费，4元/公里。行业良心价！（我同事说，出租车出三环还不打表呢）</span>
</p>
5、搬家总额超过100元，需现场补给师傅多余的款项。<br />
6、搬家师傅很辛苦，请给他微笑和说声谢谢！<br />
7、该抵金券只作为搬家金额的抵用，不能用于其它费用的抵用，不兑现，不累加。<br />
                            </div>
                        </div>
                    </div>
                    <div class="media media-box">
                        <div class="media-body">
                            <h4 class="title" id="27"><span class="i">Q22</span> 售后问题找谁？</h4>
                            <div class="content">
                                答：<br />
<p>
	请找优客小蜜   QQ：800072764  //  热线：400-000-4170
</p>
<p>
	我们还开通了投诉邮箱哦：tucao@uoko.com <img src="templets/htm/style/images/j_0042.gif" />
</p>
                            </div>
                        </div>
                    </div>
                    <div class="media media-box">
                        <div class="media-body">
                            <h4 class="title" id="69"><span class="i">Q23</span> 缴定金、续缴租金的收款账号是啥？</h4>
                            <div class="content">
                                <p>
	缴定金之前请跟我们销售确认房子可租哦。
</p>
<p>
	<br />
</p>
<p>
	账房先生对外收款有两个方式：
</p>
<p>
	<br />
</p>
<p>
	中国银行航空路支行<br />
卡号：1225 6805 3158<br />
开户行：四川优客投资管理有限公司<br />
<br />
支付宝账号：<br />
sccaiwu@uoko.com
</p>
<p>
	如您收到不明来历的收款短信。
</p>
<p>
	请与我们客服小蜜028-86068388取得联系，并确认账号的真实性哦。
</p>
                            </div>
                        </div>
                    </div>
                    <div class="media media-box">
                        <div class="media-body">
                            <h4 class="title" id="29"><span class="i">Q24</span> 关于整租？</h4>
                            <div class="content">
                                答：<br />
整租房、标间是说房子在设计之初就是按整租来设计的。<br />
这种房子都统称为整租，收取基于租金10%的管理服务费。<br />
<p>
	我们也提供五大服务给选择我们整租的朋友：
</p>
<p>
	1、一月一次的全方位保洁
</p>
<p>
	2、日常维护与维修
</p>
<p>
	3、物业垃圾费代收代缴
</p>
<p>
	4、租住信息备案+协助办理暂住证
</p>
<p>
	5、获得搬家券和再租代金券
</p>
                            </div>
                        </div>
                    </div>
                    <div class="media media-box">
                        <div class="media-body">
                            <h4 class="title" id="33"><span class="i">Q25</span> 你好，我是彩蛋。。哈哈哈哈哈哈哈哈</h4>
                            <div class="content">
                                <p>
	我们只是朴素的希望，邻京有屋的存在。<br />
能够让你住得安心，舒适，有尊严。<br />
也希望你在邻京有屋找到志趣相投的朋友。<br />
不再是一个人。<br />
<br />
<br />
<br />
别只是忙于生存，<br />
你值得更美好的生活……<br />
	<div>
		<br />
	</div>
</p>
                            </div>
                        </div>
                    </div>
            </div>
        </div>

        <div class="bk30"></div>
    </div>

</div>


    <!-- 引入公共文件脚 -->
    @include('footer')


    <!-- 引入客服聊天扫码等插件 -->
    @include('chat')


    <div class="modal fade full-modal" id="weixin_home" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content weixin_home ">

            </div>
        </div>
    </div>


    
    <script>

        $(function ($) {
            var footer = $("#footer_u").offset().top;
            var e = $("#myaffix");
            var e_h = e.outerHeight();
            var h = footer - e_h;
            var d_t = e.offset().top;
            $(window).scroll(function () {
                var scrollTop = $(window).scrollTop();
                if (scrollTop > h) {
                    e.addClass("affix-bottom").css("top", h - 120);
                } else {
                    e.removeClass("affix-bottom").css("top", "10px");
                }
            });

        });

        $(function () {

            function getWindowHeight(){
                if ($(window).height() < 700) {
                    var leftScrollTop = $(window).height() - $(".title").height()
                    $(".bs-sidenav").css({
                        "height": leftScrollTop+"px",
                        "overflow-y": "scroll"
                    })
                }
            }
            getWindowHeight();
            $(window).resize(function () {
                getWindowHeight();
            })
           
           
        })
    </script>


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
