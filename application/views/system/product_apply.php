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
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
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
    </head>
	<body>
		
        <?php $this->load->view('system/common');?>
		
		<div id="content">
			<div id="content-header">
				<h1>预约管理</h1>
			</div>
			<div id="breadcrumb">
				<a href=""><i class="icon-home"></i> 预约</a>
				<a href="" class="current">列表</a>
			</div>
			<div class="container-fluid">
				<div class="row-fluid">
					<div class="span12">
						<div class="tomin_pages" id="">
                        <?php echo $page; ?>
                        <a href="<?php echo base_url('system/product/response');?>">导出为Excel表格</a>
						</div>
						<div class="widget-box">
							<div class="widget-content nopadding">
								<table class="table table-bordered table-striped with-check">
									<thead>
										<tr>
											<th>#</th>
											<th>OpenID</th>
											<th>姓名</th>
											<th>手机号</th>
											<th>预约时间</th>
                                            <th>预约产品</th>
											<th width="20%">状态</th>
                                            <th>操作</th>
										</tr>
									</thead>
									<tbody>
                                    	<?php if($e){foreach((array)$e as $k=>$v){?>
										<tr>
											<td><?php echo $k+1;?></td>
											<td><?php echo $v['openid']?></td>
											<td><?php echo $v['truename']?></td>
                                            <td><?php echo $v['mobile']?></td>
											<td style="text-align:center;"><?php echo date("Y/m/d", $v['postdate'])?><br><?php echo date("H:i", $v['postdate'])?></td>
                                            <td style="text-align:center; font-size:12px;"><?php
											$pro = $this->pub->get_one('product', $v['productid']);
											?> <a target="_blank" href="<?php echo base_url();?>/welcome/product/<?php echo $v['productid'];?>"><img src="<?php echo $pro['thumb'];?>" width="50" alt=""></a><br><?php echo $pro['title'];?><br><?php echo $pro['price'];?>元</td>
											<td>
                                            <form action="<?php echo base_url()?>system/product/apply_edit" method="post" id="myform<?php echo $k;?>">
                                            <div class="control-group">
                                                <div class="controls">
                                                    <label style="float:left;"><input class="n" type="radio" <?php echo ($v['status'] == '0') ? 'checked' : ''; ?> name="radios<?php echo $k;?>" value="0" /> 未审核</label>
                                                    <label><input class="n" type="radio" <?php echo ($v['status'] == '1') ? 'checked' : ''; ?> name="radios<?php echo $k;?>" value="1" /> 已审核</label>
                                                    <label style="float:left;"><input class="n" type="radio" <?php echo ($v['status'] == '2') ? 'checked' : ''; ?> name="radios<?php echo $k;?>" value="2" /> 已发货</label>
                                                    <label><input class="y" type="radio" <?php echo ($v['status'] == '3') ? 'checked' : ''; ?> name="radios<?php echo $k;?>" value="3" /> 未通过</label>
                                                    <div class="text">
                                                    <?php if($v['status'] == '3'){?>
                                                    <input style="width:92%;" name="returninfo" value="<?php echo $v['returninfo']?>" type="text" />
                                                    <?php }?>
                                                    </div>
                                                </div>
                                            </div>
                                            </td>
											<td width="14%">
                                            	<button type="button" class="btn btn-info btn-mini tj<?php echo $k;?>"><i class="icon-pencil icon-white"></i> 更新</button>
                                                <button type="button" class="btn btn-danger btn-mini del"><i class="icon-remove icon-white"></i> 删除</button>
                                                <input type="hidden" name="id" value="<?php echo $v['id']?>">
                                                <input type="hidden" name="k" value="<?php echo $k; ?>">
                                            </form>
                                            </td>
										</tr>
										<tr>
										  <td colspan="8" style="font-size:12px; border-bottom:2px solid #ddd;"><strong>收货地址</strong>：<?php echo $v['province']?><?php echo $v['city']?><?php echo $v['area']?>，<?php echo $v['address']?>&nbsp;&nbsp;&nbsp;<?php echo $v['zipcode']?>&nbsp;&nbsp;&nbsp;<?php echo $v['consignee']?>&nbsp;&nbsp;&nbsp;<?php echo $v['telephone']?>&nbsp;&nbsp;&nbsp;<span style="color:#999;">（预约号：<?php echo $v['applycode']?>）</span></td>
									  </tr>
                                      <script type="text/javascript">
                                      $(function(){
											$('.tj<?php echo $k;?>').click(function()
											{
												$('#myform<?php echo $k;?>').ajaxSubmit(function(data){
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
									  <?php }}?>
									</tbody>
								</table>							
							</div>
						</div>
						
						<div class="tomin_pages" id="">
                        <?php echo $page; ?>
                        <a href="<?php echo base_url('system/product/response');?>">导出为Excel表格</a>
						</div>

					</div>
				</div>
                
			</div>
		</div>
        <script type="text/javascript">
        $(function(){
			$('.y').click(function(){
				$(this).parents('.controls').find('.text').html('<input style="width:92%;" placeholder="请输入未通过原因……" name="returninfo" value="" type="text" />');
			});
			$('.n').click(function(){
				$(this).parents('.controls').find('.text').html('');
			});
			$('.del').click(function()
			{
				var id = $(this).parent().find('input').val();
				$.get('<?php echo base_url(); ?>system/product/apply_del/'+id, function(data){
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
