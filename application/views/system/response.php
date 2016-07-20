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
    	<th class=xl2216681 nowrap>OpenID</th>
        <th class=xl2216681 nowrap>姓名</th>
        <th class=xl2216681 nowrap>手机号</th>
        <th class=xl2216681 nowrap>预约产品</th>
        <th class=xl2216681 nowrap>预约时间</th>
        <th class=xl2216681 nowrap>状态</th>
        <th class=xl2216681 nowrap>状态信息</th>
        <th class=xl2216681 nowrap>预约号</th>
        <th class=xl2216681 nowrap>收货信息</th>
    </tr>
    <?php if($e){foreach($e as $k=>$v){ ?>
    <tr>
        <td class=xl2216681 nowrap><?php echo $v['openid']; ?></td>
        <td class=xl2216681 nowrap><?php echo $v['truename']; ?></td>
        <td class=xl2216681 nowrap><?php echo $v['mobile']; ?></td>
        <td class=xl2216681 nowrap><?php
		$pro = $this->pub->get_one('product', $v['productid']);?><?php echo $pro['title'];?>/<?php echo $pro['price'];?>元</td>
        <td class=xl2216681 nowrap><?php echo date("Y-m-d H:i", $v['postdate'])?></td>
        <td class=xl2216681 nowrap><?php
        switch($v['status']){
			case 0: echo '未审核'; break;
			case 1: echo '已审核'; break;
			case 2: echo '已发货'; break;
			case 3: echo '未通过'; break;
		}
		?></td>
        <td class=xl2216681 nowrap><?php echo $v['returninfo']; ?></td>
        <td class=xl2216681 nowrap><?php echo $v['applycode']; ?></td>
        <td class=xl2216681 nowrap>
		<?php echo $v['province'].$v['city'].$v['area'].$v['address'].'&nbsp;'.$v['consignee'].'&nbsp;'.$v['telephone'].'&nbsp;'.$v['zipcode']; ?>
        </td>
    </tr>
    <?php }} ?>
</table>
</div>
</body>
</html> 