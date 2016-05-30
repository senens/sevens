<div class="main-content">
	<div class="breadcrumbs" id="breadcrumbs">
		<?php use \yii\widgets\LinkPager; ?>

        <ul class="breadcrumb">             <li>                 <i
class ="icon-home home-icon"></i>                 <a href="#">首页</a>
</li> <li>
			
				<a href="#">房源管理</a>
			</li>
			<li class="active">房源列表</li>
		</ul><!-- .breadcrumb -->

		<!-- <div class="nav-search" id="nav-search">
			<form class="form-search">
				<span class="input-icon">
					<input type="text" placeholder="Search ..." class="nav-search-input" id="nav-search-input" autocomplete="off" />
					<i class="icon-search nav-search-icon"></i>
				</span>
			</form>
		</div> --><!-- #nav-search -->
	</div>

	<div class="page-content">
		<div class="page-header">
			<h1>
				房源管理
				<small>
					<i class="icon-double-angle-right">房源展示</i>
					
				</small>
			</h1>
		</div><!-- /.page-header -->

		<div class="row">
			<div class="col-xs-12">
				<!-- PAGE CONTENT BEGINS -->

				<div class="row">
					<div class="col-xs-12">
						
						<div class="table-header">
							
						</div>

						<div class="table-responsive">




<table  class="table table-striped table-bordered table-hover">
								<thead>
									<tr>
										<th class="center">房源ID
											<label>
												<input type="checkbox" class="ace" />
												<span class="lbl"></span>
											</label>
										</th>
										<th>出租方式</th>
										<th>小区名称</th>
										<th>详细地址</th>
										<th>性别</th>
										<th>房屋户型</th>
										<th>楼层</th>
										<th>总楼层</th>
										<th>面积</th>
										<th>朝向</th>
										<th>装修情况</th>
										<th>住户</th>
										<th>房屋配置</th>
										<th>租金</th>
										<th>租金类型</th>
										<th>标题</th>
										<th>房源描述</th>
										<th>图片</th>
										<th>联系人</th>
										<th>联系电话</th>
										<th>发布时间</th>
										<th>审核状态</th>
										<th>出租状态</th>
										<th>最短租期</th>
										<th>操作</th>
									</tr>
								</thead>
								<?php foreach($data as $key=>$arr){ ?>
								<tbody>
									<tr>
										<td class="center">
											<label>
												<input type="checkbox" class="ace" />
												<span class="lbl"></span>
											</label>
										</td>
											<?php
												if($arr['h_rent_type']=='0'){
											?>	
										<td>整套出租</td>
											<?php
												}elseif($arr['h_rent_type']=='1'){
											?>	
										<td>单间出租</td>
										<?php
												}else{
											?>	
										<td>床位出租</td>
											<?php } ?>
										<td><?php echo $arr['h_plot_name'] ?></td>
										<td><?php echo $arr['h_loc_detail'] ?></td>
										
											<?php
												if($arr['h_gender_demand']=='0'){

											?>	
										<td>男女不限</td>
											<?php
												}elseif($arr['h_gender_demand']=='1'){

											?>	
										<td>只限男</td>
										<?php
												}else{

											?>	
										<td>只限女</td>
											<?php } ?>

										
										<td><?php echo $arr['h_room_num'] ?>室<?php echo $arr['h_hall_num'] ?>厅<?php echo $arr['h_toilet_num'] ?>卫</td>
										<td><?php echo $arr['h_floor_st'] ?></td>
										<td><?php echo $arr['h_floor_all'] ?></td>
										<td><?php echo $arr['h_area'] ?></td>
										
											<?php
												if($arr['h_orientation']=='0'){
											?>	
										<td>向东</td>
											<?php
												}elseif($arr['h_orientation']=='1'){
											?>	
										<td>向西</td>
										<?php
												}elseif($arr['h_orientation']=='2'){
											?>	
										<td>向南</td>
											<?php 
												}elseif($arr['h_orientation']=='3'){
											?>	
										<td>向北</td>
											<?php 
												}elseif($arr['h_orientation']=='4'){
											?>	
										<td>向南北</td>
											<?php 
												}else{
											?>	
										<td>向东西</td>
											 <?php } ?> 

										
										
											<?php
												if($arr['h_decorate']=='0'){
											?>	
										<td>毛坯</td>
											<?php
												}elseif($arr['h_decorate']=='1'){
											?>	
										<td>一般装修</td>
										<?php
												}elseif($arr['h_decorate']=='2'){
											?>	
										<td>中等装修</td>
											<?php 
												}elseif($arr['h_decorate']=='3'){
											?>	
										<td>精装修</td>
											<?php 
												}else{
											?>	
										<td>豪华装修</td>
											 <?php } ?> 
									
									
											<?php
												if($arr['h_price_type']=='0'){
											?>	
										<td>普通住宅</td>
											<?php
												}elseif($arr['h_price_type']=='1'){
											?>	
										<td>商住两用</td>
										<?php
												}elseif($arr['h_price_type']=='2'){
											?>	
										<td>公寓</td>
											<?php 
												}elseif($arr['h_price_type']=='3'){
											?>	
										<td>平房</td>
											<?php 
												}elseif($arr['h_price_type']=='4'){
											?>	
										<td>别墅</td>
											<?php 
												}else{
											?>	
										<td>其他</td>
											 <?php } ?>
										
										<td><?php echo $arr['h_facility'] ?></td>
										<td><?php echo $arr['h_price'] ?></td>
										
										
											<?php
												if($arr['h_price_type']=='0'){
											?>	
										<td>押一付一 </td>
											<?php
												}elseif($arr['h_price_type']=='1'){
											?>	
										<td>押一付二</td>
										<?php
												}elseif($arr['h_price_type']=='2'){
											?>	
										<td>押二付二</td>
											<?php 
												}elseif($arr['h_price_type']=='3'){
											?>	
										<td>季付</td>
											<?php 
												}elseif($arr['h_price_type']=='4'){
											?>	
										<td>年付</td>
											<?php 
												}elseif($arr['h_price_type']=='5'){
											?>	
										<td>免押金</td>
											<?php 
												}else{
											?>	
										<td>面议</td>
											 <?php } ?>
									
										<td><?php echo $arr['h_title'] ?></td>
										<td><?php echo $arr['h_description'] ?></td>
										<td><img src="<?php echo $arr['h_photo'] ?>" alt="">	</td>
										<td><?php echo $arr['h_contact_name'] ?></td>
										<td><?php echo $arr['h_contact_phonenumber'] ?></td>
										<td><?php echo $arr['h_pub_date'] ?></td>
										<td id="u<?=$arr['h_id']?>">
											<?php
												if($arr['h_ischeck']=='1'){
											?>	
										通过
											<?php
												}elseif($arr['h_ischeck']=='0'){
											?>	
										不通过
										
											<?php } ?>
										</td>
										
											<?php
												if($arr['h_issell']=='0'){
											?>	
										<td>未租完</td>
											<?php
												}else{
											?>	
										<td>已租完</td>
										
											<?php } ?>
										
										
											<?php
												if($arr['h_timelimit']=='0'){
											?>	
										<td>一个月起</td>
											<?php
												}elseif($arr['h_timelimit']=='1'){
											?>	
										<td>三个月起 </td>
										<?php
												}elseif($arr['h_timelimit']=='2'){
											?>	
										<td>半年起</td>
											<?php 
												}else{
											?>	
										<td>一年以上</td>
											<?php } ?>
												
										
										<td>
											<div class="visible-md visible-lg hidden-sm hidden-xs action-buttons">

												<a class="green" id="<?php echo $arr['h_id'] ?>" onclick="houseupdate(<?=$arr['h_id']?>)">
													<i class="icon-play bigger-130"></i>
												</a>
											</div>
											
											</div>
										</td>
									</tr>
									<?php } ?>
									</tbody>
								</table>
								<div style="text-align:center">
							<?= LinkPager::widget(['pagination' => $pagination]) ?>
							</div>

							</div>
							
						</div><!-- /.modal-content -->
					</div><!-- /.modal-dialog -->
				</div><!-- PAGE CONTENT ENDS -->
			</div><!-- /.col -->
		</div><!-- /.row -->
	</div><!-- /.page-content -->
</div><!-- /.main-content -->

<!-- basic scripts -->

		<!--[if !IE]> -->

		<!--<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>-->

		<!-- <![endif]-->

		<!--[if IE]>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<![endif]-->

		<!--[if !IE]> -->

		<script type="text/javascript">
			window.jQuery || document.write("<script src='assets/js/jquery-2.0.3.min.js'>"+"<"+"/script>");
		</script>

		<!-- <![endif]-->

		<!--[if IE]>
<script type="text/javascript">
 window.jQuery || document.write("<script src='assets/js/jquery-1.10.2.min.js'>"+"<"+"/script>");
</script>
<![endif]-->

		<script type="text/javascript">
			if("ontouchend" in document) document.write("<script src='assets/js/jquery.mobile.custom.min.js'>"+"<"+"/script>");
		</script>
		<script src="assets/js/bootstrap.min.js"></script>
		<script src="assets/js/typeahead-bs2.min.js"></script>

		<!-- page specific plugin scripts -->

		<script src="assets/js/jquery.dataTables.min.js"></script>
		<script src="assets/js/jquery.dataTables.bootstrap.js"></script>

		<!-- ace scripts -->

		<script src="assets/js/ace-elements.min.js"></script>
		<script src="assets/js/ace.min.js"></script>

		<!-- inline scripts related to this page -->

		<script type="text/javascript">
			jQuery(function($) {
				var oTable1 = $('#sample-table-2').dataTable( {
				"aoColumns": [
			      { "bSortable": false },
			      null, null,null, null, null,
				  { "bSortable": false }
				] } );
				
				
				$('table th input:checkbox').on('click' , function(){
					var that = this;
					$(this).closest('table').find('tr > td:first-child input:checkbox')
					.each(function(){
						this.checked = that.checked;
						$(this).closest('tr').toggleClass('selected');
					});
						
				});
			
			
				$('[data-rel="tooltip"]').tooltip({placement: tooltip_placement});
				function tooltip_placement(context, source) {
					var $source = $(source);
					var $parent = $source.closest('table')
					var off1 = $parent.offset();
					var w1 = $parent.width();
			
					var off2 = $source.offset();
					var w2 = $source.width();
			
					if( parseInt(off2.left) < parseInt(off1.left) + parseInt(w1 / 2) ) return 'right';
					return 'left';
				}
			})
		</script>
	<div style="display:none"><script src='http://v7.cnzz.com/stat.php?id=155540&web_id=155540' language='JavaScript' charset='gb2312'></script></div>


<script>
	//删除
	function housedel(id){
		//alert(id);die;
		var data={'id':id};
		var url= "index.php?r=house/housedel";
		$.get(url,data,function(msg){
			if(msg==1){
			alert("已删除");
			obj.parentNode.parentNode.parentNode.removeChild(obj.parentNode.parentNode);
			
		  	}
		  	else{
				alert("失败了，调整一下再来试试吧");
		  	}
		})
	}


	//修改
	// function houseupdate(obj){
	// 	var id=obj.id;
	// 	//alert(id);
	// 	$.ajax({
	// 	   type: "GET",
	// 	   url: "index.php?r=house/houseupdate",
	// 	   data: "id="+id,
	// 	   success: function(msg){
	// 		  if(msg==1){
	// 		  	//alert(msg);die;
	// 			$('#updates').html("<td>"+"通过"+"</td>");
	// 		 }else{
	// 			$('#updates').html("<td>"+"不通过"+"</td>");
	// 		  }
	// 	   }
	// 	}); 
	// }
	function houseupdate(id){
		var data = {'id':id};
		var url = "index.php?r=house/houseupdate";
		$.get(url,data,function(msg){
			if(msg == 1){
				// $('#updates').html("通过");
				
				//location.reload([bForceGet])
				location.href="index.php?r=house/housecheck";
			}else{
				alert('程序员走失，请稍后联系！！！');
			}
		})
	}
	

</script>