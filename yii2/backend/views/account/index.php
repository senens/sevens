<?php
use yii\helpers\Html;
use yii\widgets\LinkPager;
?>

<div class="main-content">
	<div class="breadcrumbs" id="breadcrumbs">
		<script type="text/javascript">
			try{ace.settings.check('breadcrumbs' , 'fixed')}catch(e){}
		</script>

		<ul class="breadcrumb">
			<li>
				<i class="icon-home home-icon"></i>
				<a href="index.php?r=center/index">首页</a>
			</li>
			<li>
				
				<a href="index.php?r=account/index">账号管理</a>
			</li>
			<li class="active">管理员账号</li>
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
				账号管理
				<small>
					<i class="icon-double-angle-right">管理员账号</i>
					
				</small>
				<a href="index.php?r=account/add" class="btn btn-primary btn-lg active" role="button" style="float:right;margin-right:100px;">添加账号</a>
			</h1>

		</div>
		<!-- /.page-header -->

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
										<th>ID</th>
										<th>管理员</th>
										<th class="hidden-480">操作</th>
									</tr>
								</thead>

								<tbody>
								<?php foreach ($data as $key => $v) {?>
									
								
									<tr id="s<?=$v['u_id']?>">
										<td class="center">
											<label>
												<input type="checkbox" class="ace" />
												<span class="lbl"></span>
											</label>
										</td>

										<td>
											<a href="#"><?= $v['u_id']?></a>
										</td>
										<td>
											<?=$v['u_name']?>
										</td>

										<td>
											<div class="visible-md visible-lg hidden-sm hidden-xs action-buttons" >
												<a class="blue" href="index.php?r=account/add">
													<i class="icon-zoom-in bigger-130"></i>
												</a>

												<a class="green" href="index.php?r=account/edits&id=<?=$v['u_id']?>">
													<i class="icon-pencil bigger-130"></i>
												</a>

												<a class="red" href="javascript:del(<?=$v['u_id']?>)" >
													<i class="icon-trash bigger-130"></i>
												</a>
											</div>

											<div class="visible-xs visible-sm hidden-md hidden-lg">
												<div class="inline position-relative">
													<button class="btn btn-minier btn-yellow dropdown-toggle" data-toggle="dropdown">
														<i class="icon-caret-down icon-only bigger-120"></i>
													</button>

													<ul class="dropdown-menu dropdown-only-icon dropdown-yellow pull-right dropdown-caret dropdown-close">
														<li>
															<a href="#" class="tooltip-info" data-rel="tooltip" title="View">
																<span class="blue">
																	<i class="icon-zoom-in bigger-120"></i>
																</span>
															</a>
														</li>

														<li>
															<a href="#" class="tooltip-success" data-rel="tooltip" title="Edit">
																<span class="green">
																	<i class="icon-edit bigger-120"></i>
																</span>
															</a>
														</li>

														<li>
															<a href="#" class="tooltip-error" data-rel="tooltip" title="Delete">
																<span class="red">
																	<i class="icon-trash bigger-120"></i>
																</span>
															</a>
														</li>
													</ul>
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
					</div>
				</div>

				<div id="modal-table" class="modal fade" tabindex="-1">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header no-padding">
								<div class="table-header">
									<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
										<span class="white">&times;</span>
									</button>
									Results for "Latest Registered Domains
								</div>
							</div>

							<div class="modal-body no-padding">
								<table class="table table-striped table-bordered table-hover no-margin-bottom no-border-top">
									<thead>
										<tr>
											<th>Domain</th>
											<th>Price</th>
											<th>Clicks</th>

											<th>
												<i class="icon-time bigger-110"></i>
												Update
											</th>
										</tr>
									</thead>

									<tbody>
										<tr>
											<td>
												<a href="#">ace.com</a>
											</td>
											<td>$45</td>
											<td>3,330</td>
											<td>Feb 12</td>
										</tr>

										<tr>
											<td>
												<a href="#">base.com</a>
											</td>
											<td>$35</td>
											<td>2,595</td>
											<td>Feb 18</td>
										</tr>

										<tr>
											<td>
												<a href="#">max.com</a>
											</td>
											<td>$60</td>
											<td>4,400</td>
											<td>Mar 11</td>
										</tr>

										<tr>
											<td>
												<a href="#">best.com</a>
											</td>
											<td>$75</td>
											<td>6,500</td>
											<td>Apr 03</td>
										</tr>

										<tr>
											<td>
												<a href="#">pro.com</a>
											</td>
											<td>$55</td>
											<td>4,250</td>
											<td>Jan 21</td>
										</tr>
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

	

		<!-- <![endif]-->

		<!--[if IE]>
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
			//删除
			function del(id){
				var data = {'id':id};
				var url = "index.php?r=account/dels";
				$.get(url,data,function(msg){
					if(msg == 1){
						$('#s'+id).remove();
					}else{
						alert("删除失败");
					}
				})
			}
			//修改
			// function edit(id){
			// 	var data = {'id':id};
			// 	var url = "index.php?r=account/edits";
			// 	$.get(url,data,function(msg){
			// 		alert(msg)
			// 	})
			// }
		</script>
	