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
	.preview .ngeoi_html{float:left;}
	.preview .ngeoi_html img{float:left; width:100px; height:auto; padding:2px; border:1px solid #ddd; margin:5px 5px 0 0;}
	.preview .ngeoi_html .ngeoi_close{cursor:pointer;}
    </style>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /></head>
	<body>
		
        <?php $this->load->view('system/common');?>
		
		<div id="content">
			<div id="content-header">
				<h1>产品管理</h1>
			</div>
			<div id="breadcrumb">
				<a href=""><i class="icon-home"></i> 产品</a>
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
								<form action="<?php echo base_url()?>product/save" method="post" class="form-horizontal" id="myform" />
                                	<input type="hidden" name="action" value="1">
                                    <input type="hidden" name="id" value="<?php echo $e['id']?>">
									<div class="control-group">
										<label class="control-label">产品标题</label>
										<div class="controls">
											<input name="title" value="<?php echo $e['title']?>" type="text" />
										</div>
									</div>
                                    <div class="control-group">
										<label class="control-label">产品分类</label>
										<div class="controls">
											<select name="classid" style="width:30%;">
                                            	<option value="0">选择分类</option>
                                            	<?php if ($class){foreach ((array)$class as $v){?>
												<option value="<?php echo $v['id']?>" <?php if($e['classid'] == $v['id']){echo 'selected';}?> ><?php echo $v['classname']?></option>
												<?php }}?>
											</select>
										</div>
									</div>
                                    <div class="control-group">
										<label class="control-label">缩略图</label>
										<div class="controls">
                                            <div id="p1">
												<script type="text/plain" id="u1"></script>
                                                <input type="button" class="btn" value="上传（单张）"> （注：297*255像素）
                                                <div class="preview">
                                                <?php if(!empty($e['thumb'])){?>
                                                <div class="ngeoi_html">
                                                <input type="hidden" value="<?php echo $e['thumb'];?>" name="thumb">
                                                <img src="<?php echo $e['thumb'];?>">
                                                <div class="ngeoi_close" onclick="$(this).parent().remove();">×</div>
                                                </div>
                                                <?php }?>
                                                </div>
                                            </div>
										</div>
									</div>
                                    <div class="control-group">
										<label class="control-label">产品图片</label>
										<div class="controls">
											<div id="p2">
												<script type="text/plain" id="u2"></script>
                                                <input type="button" class="btn" value="上传（批量）"> （注：628*508像素）
                                                <div class="preview">
                                                <?php if($photo){foreach((array)$photo as $v){?>
                                                <div class="ngeoi_html">
                                                <input type="hidden" value="<?php echo $v['photo'];?>" name="photo[]">
                                                <img src="<?php echo $v['photo'];?>">
                                                <div class="ngeoi_close" onclick="$(this).parent().remove();">×</div>
                                                </div>
                                                <?php }}?>
                                                </div>
                                            </div>
										</div>
									</div>
									<div class="control-group">
										<label class="control-label">价格</label>
										<div class="controls">
											<input name="price" value="<?php echo $e['price']?>" type="text"  /> 元
										</div>
									</div>
                                    <div class="control-group">
										<label class="control-label">颜色</label>
										<div class="controls">
											<input name="color" value="<?php echo $e['color']?>" type="text"  />
										</div>
									</div>
                                    <div class="control-group">
										<label class="control-label">产品介绍</label>
										<div class="controls">
											<textarea name="content" id="proinfo"><?php echo $e['content']?></textarea>
										</div>
									</div>
                                    <div class="control-group">
										<label class="control-label">品牌介绍</label>
										<div class="controls">
											<textarea name="brand" id="brand"><?php echo $e['brand']?></textarea>
										</div>
									</div>
                                    <div class="control-group">
										<label class="control-label">设计灵感</label>
										<div class="controls">
											<textarea name="design" id="design"><?php echo $e['design']?></textarea>
										</div>
									</div>
                                    <div class="control-group">
										<label class="control-label">产品编号</label>
										<div class="controls">
											<input name="number" value="<?php echo $e['number']?>" type="text" />
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
		<script src="<?php echo base_url(); ?>ueditor/ueditor.config.js"></script>
        <script src="<?php echo base_url(); ?>ueditor/ueditor.all.js"></script>
        <script src="<?php echo base_url(); ?>ueditor/lang/zh-cn/zh-cn.js"></script>
        <script src="<?php echo base_url(); ?>js/jquery.deng.ue.min.js"></script>
        <script src="<?php echo base_url(); ?>js/jquery.form.js"></script>
        <script src="<?php echo base_url(); ?>js/tooltips.js"></script>
        <script type="text/javascript">
        $(function(){
			$('#p1').deng_ue_upload({'pattern': 0,'objectName': 'u1','pictureTextFieldName': 'thumb','descriptionTextFieldName': 'desc','previewBlockName': 'preview'});
			$('#p2').deng_ue_upload({'pattern': 1,'objectName': 'u2','pictureTextFieldName': 'photo','descriptionTextFieldName': 'desc','previewBlockName': 'preview'});
			var __proinfo = UE.getEditor('proinfo');
			var __brank = UE.getEditor('brand');
			var __design = UE.getEditor('design');
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
