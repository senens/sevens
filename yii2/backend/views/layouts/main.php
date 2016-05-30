<?php

/* @var $this \yii\web\View */
/* @var $content string */

use backend\assets\AppAsset;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use common\widgets\Alert;

AppAsset::register($this);
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<title>邻京有屋后台首页</title>
	
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<!-- basic styles -->
	<link href="assets/css/bootstrap.min.css" rel="stylesheet" />
	<link rel="stylesheet" href="assets/css/font-awesome.min.css" />

	<!--[if IE 7]>
	  <link rel="stylesheet" href="assets/css/font-awesome-ie7.min.css" />
	<![endif]-->

	<!-- page specific plugin styles -->

	<!-- fonts -->

	<link rel="stylesheet" href="assets/css/css.css" />

	<!-- ace styles -->

	<link rel="stylesheet" href="assets/css/ace.min.css" />
	<link rel="stylesheet" href="assets/css/ace-rtl.min.css" />
	<link rel="stylesheet" href="assets/css/ace-skins.min.css" />

	<!--[if lte IE 8]>
	  <link rel="stylesheet" href="assets/css/ace-ie.min.css" />
	<![endif]-->

	<!-- inline styles related to this page -->

	<!-- ace settings handler -->

	<script src="assets/js/ace-extra.min.js"></script>

	<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->

	<!--[if lt IE 9]>
	<script src="assets/js/html5shiv.js"></script>
	<script src="assets/js/respond.min.js"></script>
	<![endif]-->
</head>

<body>
	<div class="navbar navbar-default" id="navbar">
		<script type="text/javascript">
			try{ace.settings.check('navbar' , 'fixed')}catch(e){}
		</script>

		<div class="navbar-container" id="navbar-container">
			<div class="navbar-header pull-left">
				<a href="#" class="navbar-brand">
					<small>
						<i class="icon-leaf"></i>
						邻京有屋后台管理系统
					</small>
				</a><!-- /.brand -->
			</div><!-- /.navbar-header -->

			<div class="navbar-header pull-right" role="navigation">
				<ul class="nav ace-nav">
					

					<!-- <li class="purple">
						<a data-toggle="dropdown" class="dropdown-toggle" href="#">
							<i class="icon-bell-alt icon-animated-bell"></i>
							<span class="badge badge-important">8</span>
						</a>
					
						<ul class="pull-right dropdown-navbar navbar-pink dropdown-menu dropdown-caret dropdown-close">
							<li class="dropdown-header">
								<i class="icon-warning-sign"></i>
								8条通知
							</li>
					
							<li>
								<a href="#">
									<div class="clearfix">
										<span class="pull-left">
											<i class="btn btn-xs no-hover btn-pink icon-comment"></i>
											新闻评论
										</span>
										<span class="pull-right badge badge-info">+12</span>
									</div>
								</a>
							</li>
					
							<li>
								<a href="#">
									<i class="btn btn-xs btn-primary icon-user"></i>
									切换为编辑登录..
								</a>
							</li>
					
							<li>
								<a href="#">
									<div class="clearfix">
										<span class="pull-left">
											<i class="btn btn-xs no-hover btn-success icon-shopping-cart"></i>
											新订单
										</span>
										<span class="pull-right badge badge-success">+8</span>
									</div>
								</a>
							</li>
					
							<li>
								<a href="#">
									<div class="clearfix">
										<span class="pull-left">
											<i class="btn btn-xs no-hover btn-info icon-twitter"></i>
											粉丝
										</span>
										<span class="pull-right badge badge-info">+11</span>
									</div>
								</a>
							</li>
					
							<li>
								<a href="#">
									查看所有通知
									<i class="icon-arrow-right"></i>
								</a>
							</li>
						</ul>
					</li>
					
					<li class="green">
						<a data-toggle="dropdown" class="dropdown-toggle" href="#">
							<i class="icon-envelope icon-animated-vertical"></i>
							<span class="badge badge-success">5</span>
						</a>
					
						<ul class="pull-right dropdown-navbar dropdown-menu dropdown-caret dropdown-close">
							<li class="dropdown-header">
								<i class="icon-envelope-alt"></i>
								5条消息
							</li>
					
							<li>
								<a href="#">
									<img src="assets/avatars/avatar.png" class="msg-photo" alt="Alex's Avatar" />
									<span class="msg-body">
										<span class="msg-title">
											<span class="blue">Alex:</span>
											不知道写啥 ...
										</span>
					
										<span class="msg-time">
											<i class="icon-time"></i>
											<span>1分钟以前</span>
										</span>
									</span>
								</a>
							</li>
					
							<li>
								<a href="#">
									<img src="assets/avatars/avatar3.png" class="msg-photo" alt="Susan's Avatar" />
									<span class="msg-body">
										<span class="msg-title">
											<span class="blue">Susan:</span>
											不知道翻译...
										</span>
					
										<span class="msg-time">
											<i class="icon-time"></i>
											<span>20分钟以前</span>
										</span>
									</span>
								</a>
							</li>
					
							<li>
								<a href="#">
									<img src="assets/avatars/avatar4.png" class="msg-photo" alt="Bob's Avatar" />
									<span class="msg-body">
										<span class="msg-title">
											<span class="blue">Bob:</span>
											到底是不是英文 ...
										</span>
					
										<span class="msg-time">
											<i class="icon-time"></i>
											<span>下午3:15</span>
										</span>
									</span>
								</a>
							</li>
					
							<li>
								<a href="inbox.html">
									查看所有消息
									<i class="icon-arrow-right"></i>
								</a>
							</li>
						</ul>
					</li> -->


					<li class="light-blue">
						<a data-toggle="dropdown" href="#" class="dropdown-toggle">
							<img class="nav-user-photo" src="assets/avatars/user.jpg" alt="Jason's Photo" />
							<span class="user-info">

								<?php
                                $session = Yii::$app->session;
                                 // 检查session是否开启 if ($session->isActive) ...
                                 // 开启session
                                 $session->open();
                                $username = $session->get('username');
                               // var_dump($username);die;
                                if($username){


                                ?>

                                <small>欢迎光临,</small>
                                <font style="color: red"><?php echo $username?></font>
                                <?php }else{?>
                                    <a href="index.php?r=login/index"> <p>登录</p></a>
                              <?php   }?>
							</span>

							<i class="icon-caret-down"></i>
						</a>

						<ul class="user-menu pull-right dropdown-menu dropdown-yellow dropdown-caret dropdown-close">
							<!-- <li>
								<a href="#">
									<i class="icon-cog"></i>
									设置
								</a>
							</li>
							
							<li>
								<a href="#">
									<i class="icon-user"></i>
									个人资料
								</a>
							</li> -->

							<li class="divider"></li>

							<li>
								<a href="index.php?r=login/exit">
									<i class="icon-off"></i>
									退出
								</a>
							</li>
						</ul>
					</li>
				</ul><!-- /.ace-nav -->
			</div><!-- /.navbar-header -->
		</div><!-- /.container -->
	</div>

	<div class="main-container" id="main-container">
		<script type="text/javascript">
			try{ace.settings.check('main-container' , 'fixed')}catch(e){}
		</script>

		<div class="main-container-inner">
			<a class="menu-toggler" id="menu-toggler" href="#">
				<span class="menu-text"></span>
			</a>

			<div class="sidebar" id="sidebar">
				<script type="text/javascript">
					try{ace.settings.check('sidebar' , 'fixed')}catch(e){}
				</script>

				<div class="sidebar-shortcuts" id="sidebar-shortcuts">
					<div class="sidebar-shortcuts-large" id="sidebar-shortcuts-large">
						<button class="btn btn-success">
							<i class="icon-signal"></i>
						</button>

						<button class="btn btn-info">
							<i class="icon-pencil"></i>
						</button>

						<button class="btn btn-warning">
							<i class="icon-group"></i>
						</button>

						<button class="btn btn-danger">
							<i class="icon-cogs"></i>
						</button>
					</div>

					<div class="sidebar-shortcuts-mini" id="sidebar-shortcuts-mini">
						<span class="btn btn-success"></span>

						<span class="btn btn-info"></span>

						<span class="btn btn-warning"></span>

						<span class="btn btn-danger"></span>
					</div>
				</div><!-- #sidebar-shortcuts -->

				<ul class="nav nav-list">
					<!-- <li>
						<a href="index.php?r=center/index">
							<i class="icon-dashboard"></i>
							<span class="menu-text"> 个人资料 </span>
						</a>
					</li> -->

					<li>
						<a href="index.php?r=account/index" class="dropdown-toggle">
							<i class="icon-desktop"></i>
							<span class="menu-text"> 账号管理 </span>
							<b class="arrow icon-angle-down"></b>
						</a>

						<ul class="submenu">
							<li>
								<a href="index.php?r=account/index">
									<i class="icon-double-angle-right"></i>
									管理员账号
								</a>
							</li>

							<li>
								<a href="index.php?r=account/landlord" class="dropdown-toggle">
									<i class="icon-double-angle-right"></i>
									房东账号管理
									<b class="arrow icon-angle-down"></b>
								</a>
								<ul class="submenu">
									<li>
										<a href="index.php?r=account/landlord">
											<i class="icon-leaf"></i>
											房东账号列表
										</a>
									</li>

									<li>
										<a href="index.php?r=account/landlordcheck" >
											<i class="icon-pencil"></i>
											房东账号审核
										</a>
									</li>
								</ul>
							</li>

							<li>
								<a href="index.php?r=account/renter" class="dropdown-toggle">
									<i class="icon-double-angle-right"></i>

									租客账号管理
									<b class="arrow icon-angle-down"></b>
								</a>
								<ul class="submenu">
									<li>
										<a href="index.php?r=account/renter">
											<i class="icon-leaf"></i>
											租客账号列表
										</a>
									</li>

									<li>
										<a href="index.php?r=account/rentercheck" >
											<i class="icon-pencil"></i>
											租客账号审核
										</a>
									</li>
								</ul>

							</li>
						</ul>
					</li>

					<li>
						<a href="index.php?r=house/index" class="dropdown-toggle">
							<i class="icon-list"></i>
							<span class="menu-text"> 房源管理 </span>

							<b class="arrow icon-angle-down"></b>
						</a>

						<ul class="submenu">
							<li>
								<a href="index.php?r=house/index">
									<i class="icon-double-angle-right"></i>
									房源列表
								</a>
							</li>

							<li>
								<a href="index.php?r=house/housecheck">
									<i class="icon-double-angle-right"></i>
									房源审核
								</a>
							</li>
							
						</ul>
					</li>

					<!-- <li>
						<a href="index.php?r=housess/index" >
							<i class="icon-edit"></i>
							<span class="menu-text"> 看房记录管理 </span>
					
							
						</a>
					</li> -->

					<li>
						<a href="index.php?r=comment/index" class="dropdown-toggle">
							<i class="icon-list-alt"></i>
							<span class="menu-text"> 评论管理 </span>
							<b class="arrow icon-angle-down"></b>
						</a>
						<ul class="submenu">
							<li>
								<a href="index.php?r=comment/index">
									<i class="icon-double-angle-right"></i>
									评论列表
								</a>
							</li>

							<li>
								<a href="index.php?r=comment/commentcheck">
									<i class="icon-double-angle-right"></i>
									评论审核
								</a>
							</li>
							
						</ul>
					</li>
					<li>
						<a href="index.php?r=active/index" class="dropdown-toggle">
							<i class="icon-list-alt"></i>
							<span class="menu-text"> 活动管理 </span>
							<b class="arrow icon-angle-down"></b>
						</a>
						<ul class="submenu">
							<li>
								<a href="index.php?r=active/index">
									<i class="icon-double-angle-right"></i>
									活动列表
								</a>
							</li>

							<li>
								<a href="index.php?r=active/activeadd">
									<i class="icon-double-angle-right"></i>
									添加活动
								</a>
							</li>
							
						</ul>
					</li>
					
				</ul><!-- /.nav-list -->

				<div class="sidebar-collapse" id="sidebar-collapse">
					<i class="icon-double-angle-left" data-icon1="icon-double-angle-left" data-icon2="icon-double-angle-right"></i>
				</div>

				<script type="text/javascript">
					try{ace.settings.check('sidebar' , 'collapsed')}catch(e){}
				</script>
			</div>
			
			<?= $content ?>

			<div class="ace-settings-container" id="ace-settings-container">
				<div class="btn btn-app btn-xs btn-warning ace-settings-btn" id="ace-settings-btn">
					<i class="icon-cog bigger-150"></i>
				</div>

				<div class="ace-settings-box" id="ace-settings-box">
					<div>
						<div class="pull-left">
							<select id="skin-colorpicker" class="hide">
								<option data-skin="default" value="#438EB9">#438EB9</option>
								<option data-skin="skin-1" value="#222A2D">#222A2D</option>
								<option data-skin="skin-2" value="#C6487E">#C6487E</option>
								<option data-skin="skin-3" value="#D0D0D0">#D0D0D0</option>
							</select>
						</div>
						<span>&nbsp; 选择皮肤</span>
					</div>

					<div>
						<input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-navbar" />
						<label class="lbl" for="ace-settings-navbar"> 固定导航条</label>
					</div>

					<div>
						<input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-sidebar" />
						<label class="lbl" for="ace-settings-sidebar"> 固定滑动条</label>
					</div>

					<div>
						<input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-breadcrumbs" />
						<label class="lbl" for="ace-settings-breadcrumbs">固定面包屑</label>
					</div>

					<div>
						<input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-rtl" />
						<label class="lbl" for="ace-settings-rtl">切换到左边</label>
					</div>

					<div>
						<input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-add-container" />
						<label class="lbl" for="ace-settings-add-container">
							切换窄屏
							<b></b>
						</label>
					</div>
				</div>
			</div><!-- /#ace-settings-container -->
		</div><!-- /.main-container-inner -->

		<a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse">
			<i class="icon-double-angle-up icon-only bigger-110"></i>
		</a>
	</div><!-- /.main-container -->

</body>
</html>


        
 