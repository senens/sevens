 <div class="header navbar navbar-default ">
        <div class="container">
            <div class="navbar-header">
                <div class="slogan">
                    <a class="logo" href="/" title="邻京有屋 轻时尚单身公寓">
                        <img src="http://www.linjing.com/public/templets/htm/style/images/logo.png" width="249" height="36" alt="邻京有屋 轻时尚单身公寓" />
                    </a>
                </div>
                <div id="uoko-nav">
                    <ul class="navbar navbar-left">            
                        <li data-menu-active="controller_Home&&action_Index">
                        <a href="http://www.linjing.com/server.php">首页</a>
                        </li>                       
                        <!-- <li data-menu-active="controller_guanyuwomen&&action_Index">
                        <a href="http://www.linjing.com/server.php/index/abouts">关于我们</a>
                        </li> -->
                        <li data-menu-active="controller_Rent&&action_Index">
                        <a href="http://www.linjing.com/server.php/search">我要租房</a>                     
                        </li> 
                        
                        <li data-menu-active="controller_&&action_Questions">                        
                           <a href="http://www.linjing.com/server.php/index/notices">租前须知</a>
                        </li>
                            
                        <!-- <li data-menu-active="controller_affiliate&&action_Index" class="aboutList">
                        <a href="http://www.linjing.com/server.php/index/fang_join">房东加盟 <span class="caret"></span> 
                        </a>
                            
                        <ul class="aboutUoko"> 
                            <li><a href="http://www.linjing.com/server.php/index/style">装修风格</a></li>
                            
                            <li><a href="http://www.linjing.com/server.php/index/linjing">加盟邻京</a></li>
                            
                            <li><a href="http://www.linjing.com/server.php/index/message">业务详情</a></li>
                            
                        </ul>                            
                        </li> -->
                       
                        <li data-menu-active="controller_lianxiwomen&&action_Index">
                           
                        <a href="http://www.linjing.com/server.php/index/talk">关于我们</a>                            
                        </li>                           
                    </ul>
                </div>
                <ul class="navbar navbar-right">
                    <li class="js-payment">
                        <a  href="#" class="popover-payment" data-container="body" data-toggle="popover" data-placement="bottom">
                            <span class="sprite-payment"></span>网上交房租
                        </a>
                        <div class="popover-payment-box hidden">
                            <!--全局变量-->
                            <div class="payment-content">
                                <div class="payment-img-weixin">
                                    <img width="164" height="165" alt="微信租房,微信看房,微信合租" src="{{URL::asset('../public')}}/templets/htm/style/images/pay_cd.jpg">
                                </div>
                                <p class="text-muted text-center">
                                    （手机支付宝扫描支付）
                                </p>
                                <p>
                                    <span class="email-static">
                                        支付宝：wudiqingcha@163.com
                                    </span>
                                </p>
                            </div>
                        </div>
                    </li>
                    <li class="loginbar">
                    @if(Session::get('name'))
                        <a href="http://www.linjing.com/server.php/login/user" rel="nofollow"><font color="#ffe4c4">{{Session::get('name')}}</font></a>
                         <!-- <a href="http://www.linjing.com/server.php/login/user" rel="nofollow">用户中心</a> -->
                         <span class="">|</span>
                        <a href="http://www.linjing.com/server.php/login/unset">退出</a>
                    @else
                        <a href="http://www.linjing.com/server.php/login" rel="nofollow">登录</a>
                        <span class="">|</span>
                        <a href="http://www.linjing.com/server.php/register" rel="nofollow">注册</a>
                    @endif
                </ul>
            </div>
        </div>

    </div>
