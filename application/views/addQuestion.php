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
        <a href=""><i class="icon-home"></i> 问题</a>
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
                        <form action="<?php echo base_url()?>Welcome/addQuestion" method="post" class="form-horizontal" id="myform" />
                            <input type="hidden" name="action" value="1">
                            <input type="hidden" name="id" value="<?php echo $e['id']?>">
                            <div class="control-group">
                                <label class="control-label">被提问人</label>
                                <div class="controls">
                                    <input name="for_name" value="<?php echo $e['for_name']?>" type="text" />
                                </div>
                            </div>


                            <div class="control-group">
                                <label class="control-label">内容</label>
                                <div class="controls">
                                    <textarea name="content" id="proinfo"><?php echo $e['content']?></textarea>
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

                $('#submit').click(function()
                {
                    $('#myform').ajaxSubmit(function(data){
                        var type = data.indexOf('成功');
                       window.location.href='<?php echo base_url()?>Welcome/admin';
                    });
                });
            });
        </script>
</body>
</html>
