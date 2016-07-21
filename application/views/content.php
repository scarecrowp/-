<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>美敦力</title>
    <link rel="stylesheet" type="text/css" href="../css/common.css"/>
    <link rel="stylesheet" type="text/css" href="../css/tooltipster.css"/>
    <link rel="stylesheet" type="text/css" href="../cs s/tooltipster-shadow.css"/>

    <!--<link rel="stylesheet" type="text/css" href="css/newyeas.css"/>-->

    <!--v6_Halloween.css?v=v070801-->

    <link rel="stylesheet" type="text/css" href="../css/item_li.css"/>
    <link rel="stylesheet" type="text/css" href="../css/animate.css"/>
    <style>#.vote-join-num, .voteOptionCount{display:none}

        .rateOpBtn { display:none !important; }</style>


    <style>
        .user-list li{ opacity:0.9 }
        .detail-box{

            opacity:1 }
        .bg {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;

            overflow: hidden;
            background-image: url(../images/pc_bg.jpg);
            background-size: cover;
            background-repeat: no-repeat;
        }
        .words-bottom{
            width: 700px;
        }
        #whole #header{
            text-align: center;
        }
        #whole h1{
            color: white;
            font-weight: 800;
            font-size: xx-large;
        }
        .head{
            text-align: center;
            line-height: 100px;
            font-size: x-large;
            color: black;
        }
        .t-row .cont {
            margin-top: -20px;
            max-height: 98px;
        }
    </style>
    <script src="../js/jq.js" type="text/javascript" charset="utf-8"></script>
    <script src="../js/jquery.tooltipster.min.js" type="text/javascript" charset="utf-8"></script>
    <script src="../js/scroll-marquee.js" type="text/javascript" charset="utf-8"></script>

</head>

<body>
<div class="bg"></div>


<div id="whole">
    <div id="header" class="clearfix">

 <img src="../images/logo.png" style="width: 100%">

    </div>
    <div id="container">
        <div class="con-inner scrollBox">
            <ul class="user-list" id="DATA_1">

            </ul>
        </div>
    </div>

    <script>
        function start(){
//  		GetContent();
            int=window.clearInterval(int);
            rint=window.clearInterval(rint);
            int=setInterval("GetContent()",3000);
            rint=setInterval("CNext()",3000);
        }
        function pause(){
            int=window.clearInterval(int);
            rint=window.clearInterval(rint);
        }

    </script>
    <script>


        var  Maxid="";
        var int;
        var rint;
        var urls="getmaxID";
        var table_1 = document.body.querySelector('#DATA_1');
        GetMaxId();
        function GetMaxId(){


            $.ajax({
                async: false,
                url: urls,
                dataType: "json",
                type: "post",
                timeout: 10000,
                complete: function(data){
                    Maxid=data.responseText;
                    if (Maxid=="")
                    {
                        Maxid=0;
                    }
                }
            });
        }


        function GetContent(){
            var jsons={'ID':Maxid};
            var Jsons=JSON.stringify(jsons);
            console.log('Maxid:'+Maxid);
            $.ajax({
                async: false,
                url: "getLastContent/"+Maxid,
                dataType: "json",
                type: "post",

                timeout: 10000,
                complete: function(data){
                    var jsonData = eval(data.responseText);
                    if(jsonData.length>0){
                        for(var i=0;i<jsonData.length;i++){
                            var  tid=Number(jsonData[i].id);
                            if(Maxid<tid){
                                Maxid=tid;
                            }

                            var li = document.createElement('li');
                            li.className+="clearfix";
                            li.className+=" t-row";
                            var htmlstr="";




                         //   htmlstr+='<div onclick="rclick(\''+jsonData[i].create_time+'\',\''+jsonData[i].for_name+'\',\''+jsonData[i].content+'\')"><div class="userimg left"><i class="elem"></i><span class="elem2"></span><a href="javascript:void(0);"class="head">@'+jsonData[i].for_name+':</a></div>';

                            var fontsize = "24";
//                            if(jsonData[i].content.length+jsonData[i].for_name.length<15){
//                                fontsize="60";
//                            }
//                            else if(jsonData[i].content.length<28){
//                                fontsize="34";
//                            }
                            htmlstr+='<table onclick="rclick(\''+jsonData[i].create_time+'\',\''+jsonData[i].for_name+'\',\''+jsonData[i].content+'\')"><tr><td style="font-size:'+fontsize+'px; padding-right: 10px"> <span>@'+jsonData[i].for_name+'</span><br/>'+
                                jsonData[i].content+'</td></tr></table>';
                         //   htmlstr+='<div class="cont-box left"><p class="c-word"><a href="javascript:void(0);"class="user-name msgUserName"> </a><span class="cont displayContent"style="font-size:'+fontsize+'px;">'+
                            //    jsonData[i].content+'</span></p></div><div class="btn-detail messageDetailBtn"style="display: none;"><div class="btn-style"><a href="javascript:void(0);"class="icon-arrow"></a></div></div></div>';

                            li.innerHTML=htmlstr;
                            table_1.appendChild(li);
                        }
                    }
                }
            });
        }

        start();


        $(".t-row").hover(function(){
                var bt_d = this.getElementsByClassName('messageDetailBtn');
                bt_d[0].style.display="block";
            }
            ,function(){
                var bt_d = this.getElementsByClassName('messageDetailBtn');
                bt_d[0].style.display="none";
            });

        $(".t-row").click(function(){
            $('.user-list').fadeOut(100);
            $('.detail-box').fadeIn(500);
        });

        function rclick(a,b,c){
            pause();
            var font ='24';
//            if(c.length<12){
//                font='60';
//                //document.getElementById('de_msg').innerHTML='<div class="detail-bar"style="cursor: default;"data-id="11520444"><div class="detail-top clearfix"><div class="userimg left"><i class="elem"></i><span class="elem2"></span><a href="javascript:;"class="head messageOneAvatar"></a></div><p class="detail-info"><a href="javascript:;"class="user-name-detail messageOneName">'+b+':</a><span class="messageDetailIntroLabel"></span></p></div><p class="detail-cont messageDetailContent"style="font-size:60px;">'+c+'</p><div class="imgb-show"></div></div>';
//            }
//            else if(c.length<28){
//               font='34';
//                // document.getElementById('de_msg').innerHTML='<div class="detail-bar"style="cursor: default;"data-id="11520444"><div class="detail-top clearfix"><div class="userimg left"><i class="elem"></i><span class="elem2"></span><a href="javascript:;"class="head messageOneAvatar"></a></div><p class="detail-info"><a href="javascript:;"class="user-name-detail messageOneName">'+b+':</a><span class="messageDetailIntroLabel"></span></p></div><p class="detail-cont messageDetailContent"style="font-size:34px;">'+c+'</p><div class="imgb-show"></div></div>';
//            }
//            else if(c.length<120){
//                font='24';
//            }
//            else
//            {
//                font = '18';
//            }

            var html='<table style="width: 100%; height: 500px"  border="0" cellspacing="0" cellpadding="0"><tr><td style="height: 32px;vertical-align: bottom;display:block;font-size:0  " valign="bottom"><img src="../images/t1.png" style="height: 32px"></td>';
            html+='<td class="t2"></td>';
            html+='<td style="display:block;font-size:0 "><img src="../images/t3.png"></td>';
            html+='<tr><td class="t4"></td>';
            html+='<td style="font-size:34px;background: #17cfee"> <span>@'+b+'</span><br/>'+c+'</td>';

            html+='<td class="t6"></td></tr>';

            html+='<tr><td><img src="../images/t7.png"></td>';

            html+='<td class="t8"></td>';
            html+='<td><img src="../images/t9.png"></td></tr>';
          //  document.getElementById('de_msg').innerHTML='<div class="detail-bar"style="cursor: default;"data-id="11520444"><div class="detail-top clearfix"><div class="userimg left"><i class="elem"></i><span class="elem2"></span><a href="javascript:;"class="head messageOneAvatar"></a></div><p class="detail-info"><a href="javascript:;"class="user-name-detail messageOneName">'+b+':</a><span class="messageDetailIntroLabel"></span></p></div><p class="detail-cont messageDetailContent"style="font-size:24px;">'+c+'</p><div class="imgb-show"></div></div>';
            document.getElementById('de_msg').innerHTML=html;
//   		$('.user-list').display="none";
            $('.detail-box').fadeIn(500);
        }


    </script>

    <div id="footer" class="clearfix">
        <!--logo开始-->
        <!--<div class="left-bottom left" >
                                           <span class="logo-b">
                   <img style="width:auto;height:auto;max-width:245px;" src="http://demo.wxscreen.com/images/common/logo-b.png" />
              </span>
                          </div>-->
        <!--logo结束-->

        <!--滚动公告-->

        <script>
            $(function(){
                //判断是否有公告
                var hasNotice = 2;
                if(hasNotice) {






                    //定时请求最新的消息
//          var prevData = [{"id":"9","company_id":"101039","user_id":"40044","title":"\u8fd9\u91cc\u53ef\u4ee5\u586b\u5199\u6d3b\u52a8\u73b0\u573a\u7684\u516c\u544a\u4e4b\u7c7b\u7684\uff0c\u6bd4\u5982\u627e\u4eba\uff0c\u4e34\u65f6\u901a\u77e5\u7b49\u7b49\u3002","add_time":"2015-03-31 11:29:42","status":"1","is_open":"1","open_time":"0000-00-00 00:00:00","close_time":"2015-03-31 11:29:42","update_time":"2015-03-31 12:22:48"},{"id":"12","company_id":"101039","user_id":"40044","title":"\u53ef\u4ee5\u53d1\u591a\u6761\u516c\u544a\u7684\u54e6~~~~","add_time":"2015-03-31 12:56:28","status":"1","is_open":"1","open_time":"2015-03-31 12:56:28","close_time":"0000-00-00 00:00:00","update_time":"2015-03-31 12:56:28"}];
//          var postUrl = 'http://demo.wxscreen.com/wxscreen/user/notice/get_latest_notice';

//          setInterval(function(){
//            $.post(postUrl, function(notice){
//              if(notice.info == "ok") {
//                //如果和之前的数据不相等的时候才进行更新
//                if(prevData.toString() != notice.data.toString()) {
//                  prevData = notice.data;
//                  var sHtml = '';
//                  for(var i=0; i<notice.data.length; i++) {
//                    sHtml += "<li>"+notice.data[i].title+"</li>";
//                  }
//                  $('.wb-list').html(sHtml);
//                  $('#wordScroll').kxbdSuperMarquee({
//                    isMarquee:true,
//                    isEqual:false,
//                    scrollDelay:40,
//                    direction:'left'
//                  });
//                }
//              }
//            }, "json")
//          } , 10000);
                }
            });
        </script>
        <!--滚动公告结束-->

        <!--按钮区-->
        <div class="btn-wrap3 center">
            <div class="btns">
                <a class="tooltip btnFullScreen btn-icon btn-full" title="全屏，快捷键“0”">全屏</a>
                <a class="tooltip btnOldest     btn-func btn-old" title="最旧一屏，快捷键“←”">最旧</a>
                <a class="tooltip btnPrev       btn-func btn-prev" title="上一屏，快捷键“↑”">上一条</a>
                <a class="tooltip btnPause      btn-func btn-begin" title="暂停，快捷键“空格”">暂停</a>
                <a class="tooltip btnNext       btn-func btn-next" title="下一屏，快捷键“↓”">下一条</a>
                <a class="tooltip btnNewest     btn-func btn-new" title="最新一屏，快捷键“→”">最新</a>
            </div>
        </div>

    </div>
    <script>
        document.onkeydown=keydown;

        function keydown(e){
            var e = e||event;
            var currKey = e.keyCode||e.which||e.charCode;
//	   if ((currKey>7&&currKey<14)||(currKey>31&&currKey<47))
//		   {
            switch (currKey)
            {
                case 37:
                    //[方向键左]

                    break;
                case 38:
                    //[方向键上]
                    $('#container').animate({scrollTop: Number($('#container').scrollTop())-Number(558)}, 800);
                    console.log(Number($('#container').scrollTop()));
                    break;
                case 39:
                    //[方向键右]

                    break;
                case 40:
                    //[方向键下]
                    $('#container').animate({scrollTop: Number($('#container').scrollTop())+Number(558)}, 800);
                    console.log(Number($('#container').scrollTop()));
                    break;
                case 96:
                    //[Number0]
                    document.documentElement.webkitRequestFullScreen();
                    break;
            }
//		   }
        }

        $('.btnFullScreen').click(function(){
            document.documentElement.webkitRequestFullScreen();
        });

        $('.btnPrev').click(function(){
            pause();
            CPrev();
        });

        function CPrev(){
            $('#container').animate({scrollTop: Number($('#container').scrollTop())-Number(558)}, 800);
            console.log(Number($('#container').scrollTop()));
        }

        $('.btnNext').click(function(){
            pause();
            CNext();
        });

        function CNext(){
            $('#container').animate({scrollTop: Number($('#container').scrollTop())+Number(558)}, 800);
            console.log(Number($('#container').scrollTop()));
        }

        $('.btnPause').click(function(){
            start();
        });

    </script>



    <!--单条详情-->
    <div class="detail-box messageDetailBox hidden">
        <div class="msg-detail-list messageDetailList" id="de_msg">

            <!--
                作者：i.loveu.forever@qq.com
                时间：2016-03-16
                描述：单条详情的内容
            -->





        </div>
        <a class="flbtn-close messageDetailCloseBtn" style="display:block;"></a>
    </div>

    <!--end 详情-->

</div>
</div>


<script>
    $('.messageDetailCloseBtn').click(function(){
        start();
        $('.detail-box').fadeOut(500);
// 			$('.user-list').display="block";
    });
    $(function(){
        // 初始化气泡提示
        $('.tooltip').tooltipster({ theme:'tooltipster-shadow', trigger: 'hover', delay: 0, speed:200 });


    });
</script>
</body>
</html>