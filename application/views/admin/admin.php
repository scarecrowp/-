<!DOCTYPE html>
<html lang="en">
	<head>
		<title></title>
		<meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<link rel="stylesheet" href="<?php echo base_url(); ?>css/bootstrap.min.css" />
		<link rel="stylesheet" href="<?php echo base_url(); ?>css/bootstrap-responsive.min.css" />
		<link rel="stylesheet" href="<?php echo base_url(); ?>css/uniform.css" />
		<link rel="stylesheet" href="<?php echo base_url(); ?>css/select2.css" />		
		<link rel="stylesheet" href="<?php echo base_url(); ?>css/unicorn.main.css" />
		<link rel="stylesheet" href="<?php echo base_url(); ?>css/unicorn.grey.css" class="skin-color" />	
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /></head>
	<body>
		
        <?php $this->load->view('system/common');?>
		
		<div id="content">
			<div id="content-header">
				<h1>用户管理</h1>
			</div>
			<div id="breadcrumb">
				<a href=""><i class="icon-home"></i> 用户</a>
				<a href="" class="current">列表</a>
			</div>
			<div class="container-fluid">
				<div class="row-fluid">
					<div class="span12">

						<div class="widget-box">
							<div class="widget-content nopadding">
								<table class="table table-bordered table-striped with-check">
									<thead>
										<tr>
											<th>#</th>
											<th>帐号</th>
											<th>密码</th>
                                            <th>操作</th>
										</tr>
									</thead>
									<tbody>
                                    	<?php if($e){foreach((array)$e as $k=>$v){?>
										<tr>
											<td><?php echo $k+1; ?></td>
											<td><?php echo $v['username']?></td>
											<td><?php echo $v['userpsw'];?></td>
											<td>
                                            	<?php
												$uname = $this->session->userdata('username');
												if($uname == $v['username'] || $uname == 'admin'){
												?>
                                            	<button onClick="javascript:location.href='<?php echo base_url(); ?>system/admin/edit/<?php echo $v['ID']?>';" class="btn btn-info btn-mini"><i class="icon-pencil icon-white"></i> 编辑</button>
                                                <button type="button" class="tomin btn btn-danger btn-mini"><i class="icon-remove icon-white"></i> 删除</button>
                                                <input type="hidden" id="v" value="<?php echo $v['ID']?>">
                                                <?php } ?>
                                            </td>
										</tr>
										<?php }} ?>
									</tbody>
								</table>							
							</div>
						</div>

					</div>
				</div>
                
			</div>
		</div>
		<script src="<?php echo base_url(); ?>js/jquery.min.js"></script>
        <script src="<?php echo base_url(); ?>js/jquery.ui.custom.js"></script>
        <script src="<?php echo base_url(); ?>js/bootstrap.min.js"></script>
        <script src="<?php echo base_url(); ?>js/jquery.uniform.js"></script>
        <script src="<?php echo base_url(); ?>js/select2.min.js"></script>
        <script src="<?php echo base_url(); ?>js/jquery.dataTables.min.js"></script>
        <script src="<?php echo base_url(); ?>js/unicorn.js"></script>
        <script src="<?php echo base_url(); ?>js/unicorn.tables.js"></script>
        <script src="<?php echo base_url(); ?>js/jquery.form.js"></script>
        <script src="<?php echo base_url(); ?>js/tooltips.js"></script>
        <script type="text/javascript">
        $(function(){
			$('.tomin').click(function()
			{
				var id = $(this).parent().find('input').val();
				$.get('<?php echo base_url(); ?>system/admin/del/'+id, function(data){
					var type = data.indexOf('成功');
					if(type > 0){
						show_msg(data, window.location.href);
					}else{
						show_err_msg(data);
					}
				});
			});
		});
        </script>
	</body>
</html>
