<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<!-- <title><?php  $cfg_webname; ?>- 会员登录</title> -->
<link href="http://www.linjing.com/public/templets/style/login.css" rel="stylesheet" type="text/css" />
<script src="http://www.linjing.com/public/templets/js/j.js" language="javascript" type="text/javascript"></script>
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
      <li> <a title="注册" href="{{URL('register')}}">注册</a> </li>

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
    <h3>请在这里登录<em><a href="{{URL('register')}}">还没注册 点击这里</a></em></h3>
    <form name='form1' method='POST' action="{{URL('login/islogin')}}">
        <input type="hidden" name="_token"    value="<?php echo csrf_token() ?>"/>

      <input type="hidden" name="fmdo" value="login">
      <input type="hidden" name="dopost" value="login">
      <input type="hidden" name="gourl" value="<?php if(!empty($gourl)) echo $gourl;?>">
      <ul>
          <?php
          $value = Session::get('user_massage');
          ?>
          @if($value)
              <li> <span>用户名：</span>
                  <input id="txtUsername" class="text login_from" value="<?php echo $value['name']?>" type="text" name="userid"/>
              </li>
              <li> <span>密&nbsp;&nbsp;&nbsp;码：</span>
                <input id="txtPassword" class="text login_from2" type="password" value="<?php echo $value['pawd']?>"  name="pwd"/>
              </li>
         @else
              <li> <span>用户名：</span>
                  <input id="txtUsername" class="text login_from"  type="text" name="userid"/>
              </li>
              <li> <span>密&nbsp;&nbsp;&nbsp;码：</span>
                  <input id="txtPassword" class="text login_from2" type="password"   name="pwd"/>
              </li>
         @endif

        <li> <span>有效期：</span>

            <input type="radio" name="keeptime" value="month"/>一个月
            <input type="radio" name="keeptime" checked="checked" value="week"/>一周
            <input type="radio" name="keeptime" value="day"/>一天
            <input type="radio" name="keeptime" value="0"/>即使
         <li>
          <button id="btnSignCheck" class="button2" type="submit">登&nbsp;录</button>
          </li>
      </ul>
    </form>
  </div>
  <div class="login_sidebar fRight">
    <p><span>还没有注册吗？</span><br />
      本站的账号都没有？你也太落伍了<br />
      赶紧去注册一个吧。</p>
      <a href="{{URL('register')}}"><button class="signUp">注册</button></a>
  </div>
</div>
<script language="javascript" type="text/javascript">
	window.onload=function (){
		setInterval("document.getElementById('time').innerHTML=new Date().toLocaleString()+' 星期'+'日一二三四五六'.charAt(new Date().getDay());",1000);
	}
</script>
<div class="footer bor">
  <div class="fLeft mL10">Copyright &copy; 2004-2011 DEDECMS. 邻京有屋 版权所有</div>
  <div class="fRight mR10" id="time">  </div>
</div>
</body>
</html>
