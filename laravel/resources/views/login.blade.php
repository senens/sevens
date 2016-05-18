<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<!-- <title><?php  $cfg_webname; ?>- 会员登录</title> -->
<link href="{{URL::asset('../public')}}/templets/style/login.css" rel="stylesheet" type="text/css" />
<script src="{{URL::asset('../public')}}/templets/js/j.js" language="javascript" type="text/javascript"></script>
<script type="text/javascript">
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

</script>
<style type="text/css">
<!--
.vermenu{
	background:#FFFFFF none repeat scroll 0 0;
	border:1px solid #EEEEEE;
	position:absolute;
	top: 208px;
}
-->
</style>
</head>
<body>
<div class="header">
  <div class="auto960">
    <ul class="userMenu fRight">
      <li> <a title="网站主页" href="../">网站主页</a> </li>
      <li> <a title="注册" href="../member/index_do.php?fmdo=user&dopost=regnew">注册</a> </li>
      <li> <a title="登录" href="../member/login.php">登录</a> </li>
      <li class="help"> <a href="http://help.dedecms.com" title="DEDECMS 帮助中心" target="_blank">帮助</a> </li>
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
<div class="login bor">
  <div class="main fLeft">
    <h3>请在这里登录<em><a href="index_do.php?fmdo=user&dopost=regnew">还没注册 点击这里</a></em></h3>
    <form name='form1' method='POST' action='index_do.php'>
      <input type="hidden" name="fmdo" value="login">
      <input type="hidden" name="dopost" value="login">
      <input type="hidden" name="gourl" value="<?php if(!empty($gourl)) echo $gourl;?>">
      <ul>
        <li> <span>用户名：</span>
          <input id="txtUsername" class="text login_from" type="text" name="userid"/>
        </li>
        <li> <span>密&nbsp;&nbsp;&nbsp;码：</span>
          <input id="txtPassword" class="text login_from2" type="password" name="pwd"/>
        </li>
        <li> <span>验证码：</span>
          <input id="vdcode" class="text login_from3" type="text" style="width: 50px; text-transform: uppercase;" name="vdcode"/>
          <img id="vdimgck" align="absmiddle" onclick="this.src=this.src+'?'" style="cursor: pointer;" alt="看不清？点击更换" src="../include/vdimgck.php"/>
           看不清？ <a href="#" onclick="changeAuthCode();">点击更换</a> </li>
        <li> <span>有效期：</span>
          <input type="radio" value="2592000" name="keeptime" id="ra1"/>
          <label for="ra1">一个月</label>
          <input type="radio" checked="checked" value="604800" name="keeptime" id="ra2"/>
          <label for="ra2">一周</label>
          <input type="radio" value="86400" name="keeptime"  id="ra3"/>
          <label for="ra3">一天</label>
          <input type="radio" value="0" name="keeptime"  id="ra4"/>
          <label for="ra4">即时</label></li>
        <li>
          <button id="btnSignCheck" class="button2" type="submit">登&nbsp;录</button>
          <a href="resetpassword.php">忘记密码？</a> </li>
      </ul>
    </form>
  </div>
  <div class="login_sidebar fRight">
    <p><span>还没有注册吗？</span><br />
      本站的账号都没有？你也太落伍了<br />
      赶紧去注册一个吧。</p>
    <button class="signUp" onclick="javascript:location='index_do.php?fmdo=user&dopost=regnew'">注册</button>
  </div>
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
