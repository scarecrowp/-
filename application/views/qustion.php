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
        <h1>问题管理</h1>
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
                    <a href="<?php echo base_url('Welcome/response');?>">导出为Excel表格</a>
                    <div style="float: right;width: 60px"> <a href="<?php echo base_url('Welcome/add');?>">添加</a></div>
                    <div style="float: right;width: 110px" id="del"> <a >清空所有数据</a></div>
                </div>
                <div class="widget-box">
                    <div class="widget-content nopadding">
                        <table class="table table-bordered table-striped with-check">
                            <thead>
                            <tr>
                                <th>#</th>

                                <th>姓名</th>

                                <th>内容</th>
                                <th class="create_time">时间</th>
                                <th width="20%">状态</th>
                                <th>操作</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php if($e){foreach((array)$e as $k=>$v){?>
                                <tr>
                                    <td><?php echo $k+1;?></td>
                                    <td><?php echo $v['for_name']?></td>
                                    <td><?php echo $v['content']?></td>
                                    <td><?php echo $v['create_time']?></td>
                                    <td>
                                        <form action="<?php echo base_url()?>Welcome/editStatus" method="post" id="myform<?php echo $k;?>">
                                            <div class="control-group">
                                                <div class="controls">

                                                    <label><input class="y" type="radio" <?php echo ($v['is_ok'] == '1') ? 'checked' : ''; ?> name="radios<?php echo $k;?>" value="1" /> 审核通过</label>


                                                </div>
                                            </div>
                                    </td>
                                    <td width="14%">
                                    <a href="add/<?php echo $v['id']?>">编辑</a>

                                        <button type="button" class="tomin btn btn-danger btn-mini"><i class="icon-remove icon-white"></i> 删除</button>
                                        <input type="hidden" name="id" value="<?php echo $v['id']?>">
                                        <input type="hidden" name="k" value="<?php echo $k; ?>">

                                        </form>
                                    </td>
                                </tr>


                            <?php }}?>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="tomin_pages" id="">
                    <?php echo $page; ?>
                    <a href="<?php echo base_url('Welcome/response');?>">导出为Excel表格</a>
                </div>

            </div>
        </div>

    </div>
</div>
<script type="text/javascript">
    $(function(){
        $('.create_time').click(function(){
            $.get('<?php echo base_url(); ?>Welcome/admin?o=d', function(data) {

            });
            }
        });
        $('.y').click(function(){

            $(this).parents('form').ajaxSubmit(function(data){

            });
            //  $(this).parents('.controls').find('.text').html('<input style="width:92%;" placeholder="请输入未通过原因……" name="returninfo" value="" type="text" />');
        });
        $('#del').click(function(){
            if(confirm('确定要删除所有数据吗？'))
            {
                $.get('<?php echo base_url(); ?>Welcome/deleteAll', function(data){
                    var type = data.indexOf('成功');
                    if(type > -1){
                        show_msg(data, window.location.href);
                    }else{
                        show_err_msg(data);
                    }
                });
            }

        });
        $('.n').click(function(){
            $(this).parents('form').ajaxSubmit(function(data){

            });
          //  $(this).parents('.controls').find('.text').html('');
        });
        $(function(){
            $('.tomin').click(function()
            {
                var id = $(this).parent().find('input').val();
                $.get('<?php echo base_url(); ?>Welcome/del/'+id, function(data){
                    var type = data.indexOf('成功');
                    if(type > 0){
                        show_msg(data, window.location.href);
                    }else{
                        show_err_msg(data);
                    }
                });
            });
        });
    });
</script>
</body>
</html>
