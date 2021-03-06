<div class="main-content">
	<div class="breadcrumbs" id="breadcrumbs">
		<?php use \yii\widgets\LinkPager; ?>
		<ul class="breadcrumb">
			<li>
				<i class="icon-home home-icon"></i>
				<a href="#">首页</a>
			</li>
			<li>
			
				<a href="#">活动管理</a>
			</li>
			<li class="active">活动列表</li>
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
				活动管理
				<small>
					<i class="icon-double-angle-right">活动列表</i>
					
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
										<th class="center">
											<label>
												<input type="checkbox" class="ace" />
												<span class="lbl"></span>
											</label>
										</th>
										<th>广告主题</th>
										<th>图片</th>
										<th>背景颜色</th>
										<th>添加时间</th>
										<th>状态 </th>
										<th>操作 </th>
									</tr>
								</thead>
								<?php foreach($data as $key=>$arr){  ?>
								<tbody>
									<tr id="d<?=$arr['act_id'] ?>">
										<td class="center">
											<label>
												<input type="checkbox" class="ace" />
												<span class="lbl"></span>
											</label>
										</td>
										<td><?php echo $arr['act_name'] ?></td>
										<td><?php echo $arr['act_url'] ?></td>
										<td style="background:<?php echo $arr['act_bgcolor'] ?>"></td>
										<td><?php echo $arr['act_time'] ?></td>
										<td>
											<?php
												if($arr['act_status']=='1'){
											?>	
										显示中
											<?php
												}elseif($arr['act_status']=='0'){
											?>	
										没显示
											<?php } ?>
																			
										<td>
											<div class="visible-md visible-lg hidden-sm hidden-xs action-buttons">
												<a class="blue" href="index.php?r=active/activeadd">
													<i class="icon-zoom-in bigger-130"></i>
												</a>

												<a class="red" id="<?php echo $arr['act_id'] ?>" onclick="activedel(<?=$arr['act_id'] ?>)">
													<i class="icon-trash bigger-130"></i>
												</a>

											</div>
											
										</td>
									</tr>

									
									</tbody>
									<?php  } ?>
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

	<script src="assets/js/ajaxgoogle.js"></script>

		<!-- <![endif]-->

		<!--[if IE]>
<script src="assets/js/ajaxgoogle.js"></script>
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
	function activedel(id){
		//alert(id);die;
		var data={'id':id};
		var url= "index.php?r=active/activedel";
		$.get(url,data,function(msg){
			if(msg==1){
				$('#d'+id).remove();
		  	}
		  	else{
				alert("没删掉，调整一下再来试试吧");
		  	}
		})
	}

	

</script>