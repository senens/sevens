<div class="main-content">
	<div class="breadcrumbs" id="breadcrumbs">
		<?php use \yii\widgets\LinkPager; ?>

		<ul class="breadcrumb">
			<li>
				<i class="icon-home home-icon"></i>
				<a href="#">首页</a>
			</li>
			<li>
			
				<a href="#">评论管理</a>
			</li>
			<li class="active">评论列表</li>
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
				评论列表
				<!-- <small>
					<i class="icon-double-angle-right">房源展示</i>
					
				</small> -->
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
										<th>编号</th>
										<th>内容</th>
										<th>时间</th>
										<th>状态</th>
										<th>发表人</th>
										<th>操作</th>
									</tr>
								</thead>
								<?php foreach($data as $key=>$arr){ ?>
								<tbody>
									<tr id="d<?=$arr['c_id'] ?>">
										<td class="center">
											<label>
												<input type="checkbox" class="ace" />
												<span class="lbl"></span>
											</label>
										</td>
										<td><?php echo $arr['c_id'] ?></td>
										<td><?php echo $arr['c_desc'] ?></td>
										<td><?php echo $arr['c_time'] ?></td>
										<td><?php echo $arr['c_status'] ?></td>
										<td><?php echo $arr['u_id'] ?></td>
										<td>
											<div class="visible-md visible-lg hidden-sm hidden-xs action-buttons">
												
												<a class="red" href="javascript:void(0)" onclick="commentdel(<?=$arr['c_id']?>)">
													<i class="icon-trash bigger-130"></i>
												</a>

												
											</div>

											
										</td>
									</tr>
								</tbody>
								<?php } ?>
							</table>
							<div style="text-align:center">
								<?= LinkPager::widget(['pagination' => $pagination]) ?>
								</div>
						</div>
					</div>
				</div>


	</div><!-- /.page-content -->
</div><!-- /.main-content -->

<!-- basic scripts -->

		<!--[if !IE]> -->

	<!--	<script src="assets/js/ajaxgoogle.js"></script>-->

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
	function commentdel(id){
		//alert(id);die;

		var data={'id':id};
		var url= "index.php?r=comment/commentdel";
		$.get(url,data,function(msg){
			if(msg==1){
				$("#d"+id).remove();
		  	}
		  	else{
				alert("失败了，调整一下再来试试吧");
		  	}
		})
	}

	
	

</script>