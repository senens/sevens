<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>优客逸家 轻时尚单身公寓- 会员注册</title>
<link href="{{URL::asset('../public')}}/templets/style/login.css" rel="stylesheet" type="text/css" />
<script src="{{URL::asset('../public')}}/templets/js/j.js" language="javascript" type="text/javascript"></script>
<script src="{{URL::asset('../public')}}/templets/js/base.js" language="javascript" type="text/javascript"></script>
<script src='{{URL::asset('../public')}}/templets/js/CheckPassStrength.js' type="text/javascript" language="javascript"></script>
<script type="text/javascript" language="javascript" src='{{URL::asset('../public')}}/templets/js/reg_new.js'></script>
<script type="text/javascript" language="javascript">
<!--
var reMethod = "POST",pwdmin = 3;

function changeAuthCode() {
	var num = 	new Date().getTime();
	var rand = Math.round(Math.random() * 10000);
	num = num + rand;
	$('#ver_code').css('visibility','visible');
	if ($("#vdimgck")[0]) {
		$("#vdimgck")[0].src = "../include/vdimgck.php?tag=" + num;
	}
	return false;	
}

function hideVc()
{
	$('#ver_code').css('visibility','hidden');
}


$(document).ready(function(){ 
	$("#passwordLevel").removeClass().addClass("rank r0");
	$("#vdcode").focus(function(){
	  var leftpos = $("#vdcode").position().left;
	  var toppos = $("#vdcode").position().top - 42;
	  $('#ver_code').css('left', leftpos+'px');
	  $('#ver_code').css('top', toppos+'px');
	  $('#ver_code').css('visibility','visible');
	});
	$("input[type='password']").click(function(){
	  hideVc()
	});
	$("#txtUsername").click(function(){
	  hideVc()
	});
	$("input[type='radio']").focus(function(){
	  hideVc()
	});
	/*
	$("#vdcode").blur(function(){
		  $('#ver_code').css('visibility','hidden');
	});
	*/
})

-->
</script>
</head>
<body>
<div class="header">
  <div class="auto960">
    <ul class="userMenu fRight">
      <li> <a title="网站主页" href="../">网站主页</a> </li>
      <li> <a title="注册" href="../member/index_do.php?fmdo=user&dopost=regnew">注册</a> </li>
      <li> <a title="登录" href="../member/login.php">登录</a> </li>
      <li class="help"> <a title="DEDECMS 帮助中心" href="http://help.dedecms.com">帮助</a> </li>
    </ul>
    <span>
    <script type="text/javascript">
 var now=(new Date()).getHours();
 if(now>0&&now<=6){
document.write("午夜好，");
 }else if(now>6&&now<=11){
 document.write("早上好，");
 }else if(now>11&&now<=14){
 document.write("中午好，");
 }else if(now>14&&now<=18){
 document.write("下午好，");
 }else{
 document.write("晚上好，");
 }
</script>
    <i class="green">游客</i> 你可以选择到 </span> </div>
</div>
<div class="wrapper">
  <div class="logo fLeft"> <a href="/"> <img  style="margin:8px 0 0 25px;"alt="会员中心" src="{{URL::asset('../public')}}/templets/images/login_logo.gif"/></a></div>
  <div class="banner fRight"> <img src="{{URL::asset('../public')}}/templets/images/530x56.gif" width="530" height="56" /></div>
</div>
<div id="login" class="bor" >

  <div class="tip1"></div>
  <div class="theme fLeft">
    <form method="post" action="reg_new.php" id="regUser" name="form2">
      <input type="hidden" value="regbase" name="dopost"/>
      <input type="hidden" value="1" name="step"/>
      <input type="hidden" value="个人" name="mtype"/>
      <p style="text-align: right;" class="mB10"/>
      <ul>
        <li class="mL68">(带<i class="red"> * </i>号的表示为必填项目，用户名必须大于3位小于20位，密码必须大于3位)</li>
        <li><span>帐号类型：</span>
          <label><input type="radio" name="mtype" class="usermtype" value="个人" checked/>个人</label> &nbsp; <label><input type="radio" name="mtype" class="usermtype2" value="企业" />企业</label> &nbsp;        </li>
        <li><span>用户名：</span>
          <input type="text" class="intxt w200" id="txtUsername" name="userid"/>
        <i class="red">*</i> <em id="_userid">(可以使用中文，但禁止除[@][.]以外的特殊符号)</em> </li>
        <li><span id="uwname">用户笔名：</span>
          <input type="text" class="intxt w200" size="20" id="uname" name="uname"/>
          <i class="red">*</i> <em id="_uname"/> </li>
        <li><span>登陆密码：</span>
          <input type="password" onkeyup="setPasswordLevel(this, document.getElementById('passwordLevel'));" style="font-family: verdana;" class="intxt w200" id="txtPassword" name="userpwd"/>
          <i class="red">*</i> </li>
        <li><span>密码强度：</span>
          <input id="passwordLevel" class="rank r2" disabled="disabled" name="Input"/>
        </li>
        <li><span>确认密码：</span>
          <input type="password" class="intxt w200" size="20" value="" id="userpwdok" name="userpwdok"/>
          <i class="red">*</i> <em id="_userpwdok"><font color="red"><b>×两次输入密码不一致</b></font></em> </li>
                    <li><span>电子邮箱：</span>
            <input type="text" class="intxt w200" id="email" name="email"/>
            <i class="red">*</i> <em id="_email">(每个电子邮邮箱只能注册一个帐号)</em> </li>
          <li><span>安全问题：</span>
            <select name='safequestion' id='safequestion'><option value='0' selected>没安全提示问题</option>
<option value='1'>你最喜欢的格言什么？</option>
<option value='2'>你家乡的名称是什么？</option>
<option value='3'>你读的小学叫什么？</option>
<option value='4'>你的父亲叫什么名字？</option>
<option value='5'>你的母亲叫什么名字？</option>
<option value='6'>你最喜欢的偶像是谁？</option>
<option value='7'>你最喜欢的歌曲是什么？</option>
</select>
          <em id="_safequestion">(忘记密码时重设密码用)</em> </li>
          <li><span>问题答案：</span>
          <input id="safeanswer" class="intxt w200" type="text" value="" name="safeanswer"/>
          </li>
        <li><span>性别：</span>
            <input type="radio" value="男" name="sex"/>
            男
        <input type="radio" value="女" name="sex"/>
            女
            <input type="radio" checked="checked" value="" name="sex"/>
          保密        </li>
                </ul>
      <div><span style="height: 110px; width: 15%;" class="fLeft">会员注册协议：</span>
        <div class="contract"> 1、在本站注册的会员，必须遵守《互联网电子公告服务管理规定》，不得在本站发表诽谤他人，侵犯他人隐私，侵犯他人知识产权，传播病毒，政治言论，商业讯息等信息。<br/>
          2、在所有在本站发表的文章，本站都具有最终编辑权，并且保留用于印刷或向第三方发表的权利，如果你的资料不齐全，我们将有权不作任何通知使用你在本站发布的作品。<br/>
        3、在登记过程中，您将选择注册名和密码。注册名的选择应遵守法律法规及社会公德。您必须对您的密码保密，您将对您注册名和密码下发生的所有活动承担责任。</div>
      </div>
      <br />
      <ul>
        <li><span>&nbsp;</span>
          <input type="checkbox" checked="" value="" id="agree" name="agree"/>
          我已阅读并完全接受服务协议 </li>
        <li><span>&nbsp;</span>
          <button type="submit" id="btnSignCheck" class="buttonGreen142">完 善 信 息</button>
        </li>
      </ul>
    </form>
  </div>
  <br class="clear"/>
</div>
<script language="javascript" type="text/javascript">
	window.onload=function (){
		setInterval("document.getElementById('time').innerHTML=new Date().toLocaleString()+' 星期'+'日一二三四五六'.charAt(new Date().getDay());",1000);
	}
</script>
<div class="footer bor">
  <div class="fLeft mL10">Copyright &copy; 2004-2011 DEDECMS. 织梦科技 版权所有</div>
  <div class="fRight mR10" id="time">  </div>
</div>
</body>
</html>