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
    <script src="<?php echo base_url(); ?>js/layer/layer.js"></script>

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

                                <th style="width: 160px">姓名</th>

                                <th>内容</th>
                                <th class="create_time"><a href="<?php echo base_url('Welcome/order');?>">时间</a> </th>
                                <th  class="status" ><a href="<?php echo base_url('Welcome/status');?>">状态</a></th>
                                <th class="action">操作</th>
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
    var getmaxidtimer;
    $(function(){

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
        var maxid=<?php echo $maxid ?> ;
        getmaxidtimer=setInterval("abc(<?php echo $maxid ?>)",3000);
    });

    function abc(maxid)
    {
      //  console.log("a");
        $.ajax({
            async: false,
            url: '<?php echo base_url('Welcome/checkIsHasNew/');?>/'+maxid,
            dataType: "json",
            type: "get",

            timeout: 10000,
            complete: function(data){
               var Maxid=data.responseText;
                if (Maxid=="")
                {
                    Maxid=0;
                }
                if (Maxid==1)
                {
                    if ($("body").find("div.layui-layer-title").text() === "新消息提醒")
                    return;
                    layer.open({
                        type: 1, //page层
                        area: ['200px', '100px'],
                        title: '新消息提醒',
                        shade: 0, //遮罩透明度
                        moveType: 1, //拖拽风格，0是默认，1是传统拖动
                        shift: 2, //0-6的动画形式，-1不开启
                        offset: 'rb',//右下角弹出
                        content: '<div style=" text-align: center;background: red; color: white"><a href="admin" class="nofify">有新的问题提交<br/> 重新载入</a></div></div>'
                    });
                    setTimeout('flash_title()',2000); //2秒之后调用一次
                    clearInterval(getmaxidtimer);
                }

            }

        });
    }
    function flash_title()
    {
        //当窗口效果为最小化，或者没焦点状态下才闪动
        if(isMinStatus() || !window.focus)
        {
            newMsgCount();
        }
        else
        {
            document.title='美敦力微信大屏幕';//窗口没有消息的时候默认的title内容
            window.clearInterval();
        }
    }
    //消息提示
    var flag=false;
    function newMsgCount(){
        if(flag){
            flag=false;
            document.title='【新提问】';
        }else{
            flag=true;
            document.title='【　　　】';
        }
        window.setTimeout('flash_title(0)',380);
    }
    //判断窗口是否最小化
    //在Opera中还不能显示
    var isMin = false;
    function isMinStatus() {
        //除了Internet Explorer浏览器，其他主流浏览器均支持Window outerHeight 和outerWidth 属性
        if(window.outerWidth != undefined && window.outerHeight != undefined){
            isMin = window.outerWidth <= 160 && window.outerHeight <= 27;
        }else{
            isMin = window.outerWidth <= 160 && window.outerHeight <= 27;
        }
        //除了Internet Explorer浏览器，其他主流浏览器均支持Window screenY 和screenX 属性
        if(window.screenY != undefined && window.screenX != undefined ){
            isMin = window.screenY < -30000 && window.screenX < -30000;//FF Chrome
        }else{
            isMin = window.screenTop < -30000 && window.screenLeft < -30000;//IE
        }
        return isMin;
    }
</script>
</body>
</html>
