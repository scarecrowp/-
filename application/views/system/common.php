<?php 
$c = $this->uri->segment(2);
$m = $this->uri->segment(3);
$f = $this->uri->segment(4);
?>
<div id="header">
    <h1>系统管理</h1>		
</div>
 <div id="user-nav" class="navbar navbar-inverse">
    <ul class="nav btn-group">
        <li class="btn btn-inverse"><a href="javascript:;"><i class="icon-user"></i> <span class="text"><?php echo $this->session->userdata('username'); ?></span></a></li>
        <li class="btn btn-inverse"><a href="<?php echo base_url(); ?>login/logout"><i class="icon icon-share-alt"></i> <span class="text">退出</span></a></li>
    </ul>
</div>
<div id="sidebar">
    <ul>
<!--        <li class="submenu --><?php //if($c == 'product' && ($m == 'class_list' || $m == 'class_edit' || $m == 'edit' || $m =='')){echo 'active open';}?><!--">-->
<!--            <a href="--><?php //echo base_url(); ?><!--system/product"><i class="icon icon-th-list"></i> <span>产品管理</span> <span class="label">4</span></a>-->
<!--            <ul>-->
<!--                <li class="--><?php //if($m == 'class_list'){echo 'active';}?><!--"><a href="--><?php //echo base_url(); ?><!--product/class_list"><i class="icon-chevron-right"></i> 分类列表</a></li>-->
<!--                <li class="--><?php //if($m == 'class_edit'){echo 'active';}?><!--"><a href="--><?php //echo base_url(); ?><!--product/class_edit"><i class="icon-chevron-right"></i> 分类添加</a></li>-->
<!--                <li class="--><?php //if($m == ''){echo 'active';}?><!--"><a href="--><?php //echo base_url(); ?><!--product"><i class="icon-chevron-right"></i> 产品列表</a></li>-->
<!--                <li class="--><?php //if($m == 'edit'){echo 'active';}?><!--"><a href="--><?php //echo base_url(); ?><!--product/edit"><i class="icon-chevron-right"></i> 产品添加</a></li>-->
<!--            </ul>-->
<!--        </li>-->
<!--        <li class="submenu--><?php //if($c == 'product' && $m == 'applyList'){echo 'active open';}?><!--">-->
<!--        	<a href="--><?php //echo base_url(); ?><!--system/product"><i class="icon icon-th-list"></i> <span>预约管理</span><span class="label">4</span></a>-->
<!--        	<ul>-->
<!--                <li class="--><?php //if($f == '0'){echo 'active';}?><!--"><a href="--><?php //echo base_url(); ?><!--product/applyList/0"><i class="icon-chevron-right"></i> 未审核</a></li>-->
<!--                <li class="--><?php //if($f == '1'){echo 'active';}?><!--"><a href="--><?php //echo base_url(); ?><!--product/applyList/1"><i class="icon-chevron-right"></i> 已审核</a></li>-->
<!--                <li class="--><?php //if($f == '2'){echo 'active';}?><!--"><a href="--><?php //echo base_url(); ?><!--product/applyList/2"><i class="icon-chevron-right"></i> 已发货</a></li>-->
<!--                <li class="--><?php //if($f == '3'){echo 'active';}?><!--"><a href="--><?php //echo base_url(); ?><!--product/applyList/3"><i class="icon-chevron-right"></i> 未通过</a></li>-->
<!--            </ul>-->
<!--        	</li>-->
<!--        <li class="--><?php //if($c == 'focus' && $m == ''){echo 'active';}?><!--"><a href="--><?php //echo base_url(); ?><!--focus"><i class="icon icon-tint"></i> <span>幻灯管理</span></a></li>-->
<!--        <li class="submenu --><?php //if($c == 'admin' && ($m == 'edit' || $m == '')){echo 'active open';}?><!--">-->
<!--            <a href="--><?php //echo base_url(); ?><!--system/admin"><i class="icon icon-th-list"></i> <span>用户管理</span> <span class="label">2</span></a>-->
<!--            <ul>-->
<!--                <li class="--><?php //if($m == ''){echo 'active';}?><!--"><a href="--><?php //echo base_url(); ?><!--admin"><i class="icon-chevron-right"></i> 用户列表</a></li>-->
<!--                --><?php //
//				$username = $this->session->userdata('username');
//				if($username == 'admin'){
//				?>
<!--                <li class="--><?php //if($m == 'edit'){echo 'active';}?><!--"><a href="--><?php //echo base_url(); ?><!--admin/edit"><i class="icon-chevron-right"></i> 用户添加</a></li>-->
<!--                --><?php //} ?>
<!--            </ul>-->
<!--        </li>-->
        <li class="<?php if($c == 'focus' && $m == ''){echo 'active';}?>"><a href="<?php echo base_url(); ?>Welcome/admin"><i class="icon icon-tint"></i> <span>问题管理</span></a></li>
    </ul>
</div>