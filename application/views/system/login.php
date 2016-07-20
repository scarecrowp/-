<!DOCTYPE html>
<html lang="en">
    <head>
        <title></title>
		<meta charset="UTF-8" />

        <meta name="viewport" content="width=device-width, initial-scale=1.0" />

		<link rel="stylesheet" href="<?php echo base_url();?>css/bootstrap.min.css" />

		<link rel="stylesheet" href="<?php echo base_url();?>css/bootstrap-responsive.min.css" />
        <link rel="stylesheet" href="<?php echo base_url();?>css/unicorn.login.css" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" /></head>

    <body>
        <div id="logo"></div>
        <div id="loginbox">            
            <form id="loginform" class="form-vertical" action="<?php echo base_url()?>index.php/login/ilogin" method="post" />
            	<input type="hidden" name="action" value="1">
				<p>警告：非管理人员请勿尝试操作。</p>
                <div class="control-group">
                    <div class="controls">
                        <div class="input-prepend">
                            <span class="add-on"><i class="icon-user"></i></span><input name="username" type="text" placeholder="帐号" />
                        </div>
                    </div>
                </div>
                <div class="control-group">
                    <div class="controls">
                        <div class="input-prepend">
                            <span class="add-on"><i class="icon-lock"></i></span><input name="password" type="password" placeholder="密码" />
                        </div>
                    </div>
                </div>
                <div class="form-actions">
                    <span class="pull-right"><input type="button" id="submit" class="btn btn-inverse" value="管理" /></span>
                </div>
            </form>
        </div>
        
        <script src="<?php echo base_url();?>js/jquery.min.js"></script>  
        <script src="<?php echo base_url();?>js/unicorn.login.js"></script> 
        <script src="<?php echo base_url(); ?>js/jquery.form.js"></script>
        <script src="<?php echo base_url(); ?>js/tooltips.js"></script>
        <script type="text/javascript">
        $(function(){
			$('#submit').click(function()
			{
				$('#loginform').ajaxSubmit(function(data){
					var type = data.indexOf('成功');
					if(type > 0){
						//show_msg(data, window.location.href);
						window.location.href='<?php echo base_url(); ?>admin';
					}else{
						show_err_msg(data);
					}
				});
			});
		});
        </script>
    </body>
</html>
