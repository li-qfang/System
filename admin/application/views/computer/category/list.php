<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="utf-8">
<head>
<title></title>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type"/>
<link href="<?php echo base_url()?>css/general.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url()?>css/main.css" rel="stylesheet" type="text/css" />
<script language="javascript" type="text/javascript" src="<?php echo base_url()?>js/jquery.js"></script>
<script language="JavaScript"> var base_url = '<?php echo base_url()?>'; </script>
<script language="javascript" type="text/javascript" src="<?php echo base_url()?>js/admin.js"></script>

<script language="JavaScript"> 
<!--
$(document).ready(function() {
  listBody();
});
$(window).resize(function(){
  listBody();
});

 //--> 
</script>

</head>

<body class=" x-border-layout-ct" style="position: relative;" >
<div id="msg"></div>
<div id="main-tabs" class="x-tab-panel x-border-panel ext-ie'" style="left: 5px; top: 0px; ">

 <div id="crt-menu" class="x-tab-panel-header x-unselectable">
 <div  id="crt-menu1" class="x-tab-strip-wrap">
 <ul id="crt-menu2" class="x-tab-strip x-tab-strip-top">
 <li class="x-tab-strip-active" >
 <a class="x-tab-right" href="#" onClick="return false;">
 <em class="x-tab-left">
 <span style="width: 130px;" class="x-tab-strip-inner">
 <span class="x-tab-strip-text">所有机器</span>
 </span>
 </em>
 </a>
 </li>
 <li class="x-tab-edge"></li>
 <div class="x-clear"></div>
 </ul>
 </div>
 </div>
 
 <!-- 菜单体 -->
 <div class="x-tab-panel-bwrap border-bottom x-panel-body">
 <div id="menu-body1" class="x-tab-panel-body x-tab-panel-body-top" >
 <div id="menu-body2" class="x-panel x-panel-noborder" >
 <div class="x-panel-bwrap">
 <div id="menu-body" class="x-panel-body x-panel-body-noheader x-panel-body-noborder x-border-layout-ct" >
 <div id="menu-body3" class="x-panel x-border-panel x-grid-panel" style="left: 0px; top: 0px;">
 <div style="position: relative;" class="x-panel-bwrap">

   <!-- 工具栏 -->
   <div id="tool" class="x-panel-tbar x-panel-tbar-noheader"><div class="x-toolbar " style="border-left:0 solid #99bbe8;"><table cellspacing="0"><tbody><tr>
	
	 <td onClick="window.location.href='<?php echo site_url('admin_user/add')?>'"><table style="width: hidden;" class="button x-btn-wrap x-btn x-btn-text-icon " border="0" cellpadding="0" cellspacing="0" ><tbody><tr>
	 <td class="x-btn-left"><i>&nbsp;</i></td>
	 <td class="x-btn-right"><i></i></td>
	 </tr></tbody></table></td>

	 </tr></tbody></table></div></div>
	 <!-- /工具栏 -->

	 <!-- 内容 -->
	 <div style="overflow:auto;border-left:0 solid #99bbe8;" id="content" class="x-panel-body border-top   
	 border-nobottom" >
	 <div class="list-div" id="listDiv" >
	     <table cellpadding="3" cellspacing="0" id="listTable" >
		 <tbody>
		 <tr class="x-grid3-header">
			<th >
			<div class="x-grid3-hd-inner ">编号<img class="x-grid3-sort-icon" src="<?php echo base_url()?>images/s.gif"></div></th>
            
			<th class="" >
			<div class="x-grid3-hd-inner">机器名称<img class="x-grid3-sort-icon" src="<?php echo base_url()?>images/s.gif"></div></th>

			<th class="" >
			<div class="x-grid3-hd-inner">ip地址<img class="x-grid3-sort-icon" src="<?php echo base_url()?>images/s.gif"></div></th>

			<th class="" >
			<div class="x-grid3-hd-inner">运行进程数目<img class="x-grid3-sort-icon" src="<?php echo base_url()?>images/s.gif"></div></th>

			<th class="" >
			<div class="x-grid3-hd-inner">cpu种类<img class="x-grid3-sort-icon" src="<?php echo base_url()?>images/s.gif"></div></th>
			
            <th class="" >
			<div class="x-grid3-hd-inner">总内存<img class="x-grid3-sort-icon" src="<?php echo base_url()?>images/s.gif"></div></th>
            
            <th class="" >
			<div class="x-grid3-hd-inner">总硬盘容量<img class="x-grid3-sort-icon" src="<?php echo base_url()?>images/s.gif"></div></th>
			
            <th class="" >
			<div class="x-grid3-hd-inner">机器位数<img class="x-grid3-sort-icon" src="<?php echo base_url()?>images/s.gif"></div></th>
            
            <th class="" >
			<div class="x-grid3-hd-inner">机器总运行时间<img class="x-grid3-sort-icon" src="<?php echo base_url()?>images/s.gif"></div></th>
		 </tr>
     
		 <?php foreach ($result as $value){ ?>
		 <tr class="x-grid3-row ">
			<td><div class="x-grid3-cell-inner "><?php echo $value['id'] ?></div></td>
			<td><div class="x-grid3-cell-inner "><?php echo $value['hostname'] ?></div></td>
			<td ><div class="x-grid3-cell-inner "><?php echo $value['ip'] ?></div></td>
			<td><div class="x-grid3-cell-inner "><?php echo $value['pro_number'] ?></div></td>
			<td ><div class="x-grid3-cell-inner "><?php echo $value['cpu_type'] ?></div></td>
            <td ><div class="x-grid3-cell-inner "><?php echo $value['total_mem'] ?> M</div></td>
            <td ><div class="x-grid3-cell-inner "><?php echo $value['total_disk'] ?> G</div></td>
            <td ><div class="x-grid3-cell-inner "><?php echo $value['system_bit'] ?></div></td>
            <td ><div class="x-grid3-cell-inner "><?php echo $value['day'] ?>天<?php echo $value['hour'] ?>小时<?php echo $value['minute'] ?>分钟<?php echo $value['second'] ?>秒</div></td>
			<td ><div class="x-grid3-cell-inner ">
			 
			</div></td>
		 </tr>
		 <?php } ?>
		</tbody></table>
		
	 </div>
     </div>
     <!-- /内容 -->
	  
 </div></div></div></div></div></div></div>
 <!-- /菜单体 -->

 
</div>
</body>
</html>

