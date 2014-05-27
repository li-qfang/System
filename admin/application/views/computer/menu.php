<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type"/>
<link href="<?php echo base_url()?>css/menu.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url()?>css/general.css" rel="stylesheet" type="text/css" />
<script language="javascript" type="text/javascript" src="<?php echo base_url()?>js/jquery.js"></script>
<script language="javascript" type="text/javascript" src="<?php echo base_url()?>js/menu.js"></script>
</head>

<body  class=" x-border-layout-ct" style="position: relative;">

<div id="menu" class="x-panel x-border-panel x-tree " style="width: 225px; position: absolute; visibility: visible; left:5px; z-index:1; height:100% ">

  <div id="menu-head" class="x-panel-header">
    <a href="#" class="toggleMenu"><div  class="x-tool x-tool-toggle x-tool-collapse-west" > </div></a>
    <span class="" >商品</span>
  </div>

  <div  class="x-panel-bwrap ">

	<div id="cmm-func" class="x-panel-tbar">
	<div  class="x-toolbar">
	  <table cellspacing="0">
	  <tr>
	      <td class="x-btn x-btn-text-icon">
			<table  cellspacing="0" cellpadding="0" border="0" style="width: auto;"><tbody><tr>
			<td class="x-btn-left"><i> </i></td>
			<td class="x-btn-center">
			<em >监控面板</button></em>
			</td>
			<td class="x-btn-right"><i> </i></td>
			</tr></tbody></table>
		  </td>
	  </tr>
	  </table>
	</div>
	</div>

	<div id="menu-body" class="x-panel-body" style="overflow: auto; width: 223px; height:600px">
    <ul  class="x-tree-root-ct x-tree-no-lines">
	<div class="x-tree-root-node">
    <li class="x-tree-node">
	
	  <!-- 商品管理 -->
	  <div  class="x-tree-node-el  feeds-node" >
		  <img  class="x-tree-ec-icon x-tree-elbow-end-minus" src="<?php echo base_url()?>images/s.gif" title="关闭">
		  <img class="x-tree-node-icon"  src="<?php echo base_url()?>images/s.gif"/>
		  <span >机器管理</span>
	  </div>
     
	  <ul  style="" class="x-tree-node-ct">
	  <li class="x-tree-node"><div  class="x-tree-node-el x-tree-node-leaf feed x-tree-selected " ><span class="x-tree-node-indent"><img class="x-tree-icon" src="<?php echo base_url()?>images/s.gif"/></span><img  class="x-tree-node-icon feed-icon" src="<?php echo base_url()?>images/s.gif"/><a href="<?php echo site_url('computer/category')?>" target="main-frame"><span >所有机器浏览</span></a></div></li>

	  <li class="x-tree-node"><div  class="x-tree-node-el x-tree-node-leaf feed" ><span class="x-tree-node-indent"><img class="x-tree-icon" src="<?php echo base_url()?>images/s.gif"/></span><img  class="x-tree-node-icon add-feed" src="<?php echo base_url()?>images/s.gif"/><a  href="<?php echo site_url('computer/single')?>" target="main-frame" ><span >单台机器监控</span></a></div></li>
     
	  <li class="x-tree-node"><div  class="x-tree-node-el x-tree-node-leaf feed" ><span class="x-tree-node-indent"><img class="x-tree-icon" src="<?php echo base_url()?>images/s.gif"/></span><img  class="x-tree-node-icon feed-icon" src="<?php echo base_url()?>images/s.gif"/><a  href="<?php echo site_url('warn')?>" target="main-frame" ><span >报警信息</span></a></div></li>  
      
      <li class="x-tree-node"><div  class="x-tree-node-el x-tree-node-leaf feed" ><span class="x-tree-node-indent"><img class="x-tree-icon" src="<?php echo base_url()?>images/s.gif"/></span><img  class="x-tree-node-icon feed-icon" src="<?php echo base_url()?>images/s.gif"/><a  href="<?php echo site_url('email')?>" target="main-frame" ><span >发送邮件</span></a></div></li>  
      
          
	  </ul>

	 
</div><!-- /menu -->

<div id="menu-xcollapsed" class="x-layout-collapsed x-layout-collapsed-west" style="display: none; width: 20px; position: absolute; visibility: visible; left: 5px;  z-index: 20;">
<a href="#" class="toggleMenu"><div class="x-tool x-tool-expand-west" ></div></a> 
</div>

</body>
</html>



