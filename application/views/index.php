<!DOCTYPE html>
<html>
<head>
    <title></title>

    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <link rel="stylesheet" href="../css/dpm.css" />
    <style >
    </style>
</head>
<body>
    <div><img src="../images/logo.jpg" style="width: 100%">
        <div class="content">
            <div class="div-1" >
                您想提问的专家姓名：<br>
                Ask whom：
            </div>
            <form action="Welcome/submit" method="post" id="myform">
                <ul class="div-2">
                    <li style="padding-top: 2px" >@</li>
                    <li style="padding-left: 5px"><input type="text" name="for_name"  style=" width: 200px"></li>
                </ul>
                <div class="div-1">
                    您的问题：<br/>
                    Type your question：
                </div>
                <div class="div-3">
                    <textarea name="content" ></textarea>
                </div>
            </form>
            <div style="text-align: center; padding-top: 20px">
                <img src="../images/submit.png" id="bt" style="margin: auto" onclick="sutmitContent()">
            </div>
        </div>
        <script src="<?php echo base_url(); ?>js/jquery.min.js"></script>
        <script src="<?php echo base_url(); ?>js/jquery.form.js"></script>
        <script src="<?php echo base_url(); ?>js/layer/layer.js"></script>
        <script type="text/javascript">
            function sutmitContent()
            {
                $('#myform').ajaxSubmit(function(data){
                    var type = data.indexOf('成功');
                    if(type > 0){
                        layer.open({
                            content: '提交成功！',
                            style: 'background-color:#09C1FF; color:#fff; border:none;',
                            time: 2
                        });
                      $("input").val("");
                       $("textarea").val("");

                    }else{
                        show_err_msg(data);
                    }
                });
            }
//            $('#bt').click(function()
//            {
//                $('#myform').ajaxSubmit(function(data){
//                    var type = data.indexOf('成功');
//                    if(type > 0){
//                        layer.open({
//                            content: '提交成功！',
//                            style: 'background-color:#09C1FF; color:#fff; border:none;',
//                            time: 2
//                        });
//                      $("input").val("");
//                       $("textarea").val("");
//
//                    }else{
//                        show_err_msg(data);
//                    }
//                });
//            });

        </script>
    </div>
</body>
</html>
