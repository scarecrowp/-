<?php
header("Content-type:text/html; charset=utf-8");
header("Content-Type: application/vnd.ms-excel; charset=utf-8");
header("Content-type:application/vnd.ms-excel");
header("Content-Disposition:attachment; filename=excel.xls");
?>
<html xmlns:o="urn:schemas-microsoft-com:office:office"
xmlns:x="urn:schemas-microsoft-com:office:excel"
xmlns="http://www.w3.org/TR/REC-html40">
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<meta http-equiv="Content-type" content="text/html;charset=UTF-8" />
<style id="Classeur1_16681_Styles"></style>
</head>
<body>
<div id="Classeur1_16681" align=center x:publishsource="Excel">
<table x:str border=0 cellpadding=0 cellspacing=0 width=100% style="border-collapse: collapse">
    <tr>
    	<th class=xl2216681 nowrap>被提问人</th>
        <th class=xl2216681 nowrap>内容</th>
        <th class=xl2216681 nowrap>时间</th>
        <th class=xl2216681 nowrap>是否上墙</th>

    </tr>
    <?php if($e){foreach($e as $k=>$v){ ?>
    <tr>
        <td class=xl2216681 nowrap><?php echo $v['for_name']; ?></td>
        <td class=xl2216681 nowrap><?php echo $v['content']; ?></td>
        <td class=xl2216681 nowrap><?php echo $v['create_time']; ?></td>

        <td class=xl2216681 nowrap><?php

            echo $v['is_ok']?'是':'否';

		?></td>

    </tr>
    <?php }} ?>
</table>
</div>
</body>
</html> 