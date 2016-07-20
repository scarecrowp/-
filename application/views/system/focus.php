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
    <style type="text/css">
    .preview{width:100%; margin-top:5px;}
	.preview .ngeoi-html{float:left;}
	.preview .ngeoi-html img{float:left; width:200px; height:auto; padding:2px; border:1px solid #ddd; margin:5px 5px 0 0;}
	.preview .ngeoi-html .ngeoi-close{cursor:pointer;}
    </style>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /></head>
	<body>
		
        <?php $this->load->view('system/common');?>
		
		<div id="content">
			<div id="content-header">
				<h1>幻灯管理</h1>
			</div>
			<div id="breadcrumb">
				<a href=""><i class="icon-home"></i> 幻灯</a>
				<a href="" class="tip-bottom">新增 / 编辑</a>
			</div>
			<div class="container-fluid">
				<div class="row-fluid">
					<div class="span12">
						<div class="widget-box">
							<div class="widget-title">
								<span class="icon">
									<i class="icon-align-justify"></i>									
								</span>
								<h5>新增 / 编辑</h5>
							</div>
							<div class="widget-content nopadding">
								<form action="<?php echo base_url(); ?>system/focus/save" method="post" class="form-horizontal" id="myform" />
                                	<input type="hidden" name="action" value="1">
                                    <div class="control-group">
										<label class="control-label">幻灯片</label>
										<div class="controls">
                                            <div id="p1">
												<script type="text/plain" id="u1"></script>
                                                <input type="button" class="btn" value="上传（批量）"> （注：628*350像素 JPG格式图片）
                                                <div class="preview">
                                                <?php if($e){foreach((array)$e as $v){?>
                                                <div class="ngeoi-html">
                                                <img src="<?php echo $v['thumb']?>">
                                                <input type="hidden" value="<?php echo $v['thumb']?>" name="thumb[]">
                                                <input type="text" value="<?php echo $v['intro']?>" name="intro[]">
                                                <div class="ngeoi-close" onclick="$(this).parent().remove();">×</div>
                                                </div>
                                                <?php }} ?>
                                                </div>
                                            </div>
										</div>
									</div>
                                    <div class="form-actions">
										<button type="button" id="submit" class="btn btn-primary">保存</button>
									</div>
								</form>
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
		<script src="<?php echo base_url(); ?>ueditor/ueditor.config.js"></script>
        <script src="<?php echo base_url(); ?>ueditor/ueditor.all.js"></script>
        <script src="<?php echo base_url(); ?>ueditor/lang/zh-cn/zh-cn.js"></script>
        <script src="<?php echo base_url(); ?>js/jquery.ngeoi.ue.min.js"></script>
        <script type="text/javascript">
        $(function(){
			$('#p1').ngeoi_ue_image({parameter : ['u1', [['thumb', 'hidden'], ['', 0], ['intro', 1], ['', 0]], 'preview', 1]});
			$('#submit').click(function()
			{
				$('#myform').ajaxSubmit(function(data){
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
