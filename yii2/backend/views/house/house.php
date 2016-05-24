<div class="main-content">
	<div class="breadcrumbs" id="breadcrumbs">
		

        <ul class="breadcrumb">             <li>                 <i
class ="icon-home home-icon"></i>                 <a href="#">首页</a>
</li> <li>
			
				<a href="#">房源管理</a>
			</li>
			<li class="active">房源列表</li>
		</ul><!-- .breadcrumb -->

		<div class="nav-search" id="nav-search">
			<form class="form-search">
				<span class="input-icon">
					<input type="text" placeholder="Search ..." class="nav-search-input" id="nav-search-input" autocomplete="off" />
					<i class="icon-search nav-search-icon"></i>
				</span>
			</form>
		</div><!-- #nav-search -->
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
								<?php foreach($posts as $key=>$arr){ ?>
								<tbody>
									<tr>
										<td class="center">

											<label>
												<input type="checkbox" class="ace" />
												<span class="lbl"></span>
											</label>
										</td>

										<td><?php echo $arr['h_rent_type'] ?></td>
										<td><?php echo $arr['h_plot_name'] ?></td>
										<td><?php echo $arr['h_loc_detail'] ?></td>
										<td><?php echo $arr['h_gender_demand'] ?></td>
										<td><?php echo $arr['h_room_num'] ?>室<?php echo $arr['h_hall_num'] ?>厅<?php echo $arr['h_toilet_num'] ?>卫</td>
										<td><?php echo $arr['h_floor_st'] ?></td>
										<td><?php echo $arr['h_floor_all'] ?></td>
										<td><?php echo $arr['h_area'] ?></td>
										<td><?php echo $arr['h_orientation'] ?></td>
										<td><?php echo $arr['h_decorate'] ?></td>
										<td><?php echo $arr['h_type'] ?></td>
										<td><?php echo $arr['h_facility'] ?></td>
										<td><?php echo $arr['h_price'] ?></td>
										<td><?php echo $arr['h_price_type'] ?></td>
										<td><?php echo $arr['h_title'] ?></td>
										<td><?php echo $arr['h_description'] ?></td>
										<td><?php echo $arr['h_photo'] ?></td>
										<td><?php echo $arr['h_contact_name'] ?></td>
										<td><?php echo $arr['h_contact_phonenumber'] ?></td>
										<td><?php echo $arr['h_pub_date'] ?></td>
										<td><?php echo $arr['h_ischeck'] ?></td>
										<td><?php echo $arr['h_issell'] ?></td>
										<td><?php echo $arr['h_timelimit'] ?></td>
										<td>
											<div class="visible-md visible-lg hidden-sm hidden-xs action-buttons">
												<a class="blue" href="index.php?r=house/houseadd">
													<i class="icon-zoom-in bigger-130"></i>
												</a>

												<a class="green" href="index.php?r=house/houseupdate">
													<i class="icon-pencil bigger-130"></i>
												</a>

												<a class="red" href="index.php?r=house/housedel">
													<i class="icon-trash bigger-130"></i>
												</a>
											</div>

											
											</div>
										</td>
									</tr>
									<?php } ?>
									</tbody>
								</table>

							</div>
							<div class="modal-footer no-margin-top">
								<button class="btn btn-sm btn-danger pull-left" data-dismiss="modal">
									<i class="icon-remove"></i>
									Close
								</button>

								<ul class="pagination pull-right no-margin">
									<li class="prev disabled">
										<a href="#">
											<i class="icon-double-angle-left"></i>
										</a>
									</li>

									<li class="active">
										<a href="#">1</a>
									</li>

									<li>
										<a href="#">2</a>
									</li>

									<li>
										<a href="#">3</a>
									</li>

									<li class="next">
										<a href="#">
											<i class="icon-double-angle-right"></i>
										</a>
									</li>
								</ul>
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
	//
</script>