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

<!--[if lte IE 8]><script language="javascript" type="text/javascript" src="/js/flot/excanvas.min.js"></script><![endif]-->
     
<script type="text/javascript" src="<?php echo base_url()?>js/flot/jquery.flot.min.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>js/flot/jquery.flot.time.js"></script>   
<script type="text/javascript" src="<?php echo base_url()?>js/flot/jquery.flot.symbol.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>js/flot/jquery.flot.axislabels.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>js/flot/jshashtable-2.1.js"></script>   
<script type="text/javascript" src="<?php echo base_url()?>js/flot/jquery.numberformatter-1.2.3.min.js"></script>



<script language="JavaScript"> 
<!--
//画折线图的代码
var data1 = [];

var options = {
    series: {
        lines: {
            show: true
        },
        points: {
            radius: 3,
            fill: true,
            show: true            
        }
    },
    legend: {
        noColumns: 0,
        labelBoxBorderColor: "#000000",
        position: "nw"
    },
    grid: {
        hoverable: true,
        borderWidth: 2,
        borderColor: "#633200",
        backgroundColor: { colors: ["#ffffff", "#EDF5FF"] }
    },
    colors: ["#FF0000", "#0022FF"]
};

function get_Data()
{
	for(var i=0; i<<?php echo $number ?>; i++)
	{
		data1[i] = [i, i];
	}
}

var dataset = [
    { label: "Monitor", data: data1, points: { symbol: "triangle"} }
];

//列表窗口缩放效果
$(document).ready(function() {
  listBody();
});
$(window).resize(function(){
  listBody();
});

$(document).ready(function() {
  $('#search-action').click(function(){
   $.post('<?php echo site_url('computer/single')?>', $('#search-form').serialize(), function(data) {
	  get_Data();
	   
	 
	  $('.x-grid3-row').remove();
	  $('.x-grid3-row',data).appendTo($('#listTable tbody'));
	  pageStyle();
	  pageClick()
	  $('#listTable').alternateRowColors().eventRowColors();
	  
	  
	  $.plot($("#flot-placeholder1", data), dataset, options);
     
	   alert(<?php echo $number?>);
    });
  });

});

 //--> 
</script>

</head>

<body  class=" x-border-layout-ct" style="position: relative;" >
<div id="msg"></div>
<div id="main-tabs" class="x-tab-panel x-border-panel" style="left: 5px; top: 0px;">

  <div  id="crt-menu" class="x-tab-panel-header x-unselectable">
  <div  id="crt-menu1" class="x-tab-strip-wrap">
  <ul id="crt-menu2" class="x-tab-strip x-tab-strip-top">
  <li class="x-tab-strip-active" >
  <a class="x-tab-right" href="#" onClick="return false;">
  <em class="x-tab-left">
  <span style="width: 130px;" class="x-tab-strip-inner">
  <span class="x-tab-strip-text">单机监控</span>
  </span>
  </em>
  </a>
  </li>
  </ul>
  </div>
  </div>
  
  <!-- 菜单体 -->
  <div class="x-tab-panel-bwrap border-bottom x-panel-body" >
  <div id="menu-body1" class="x-tab-panel-body x-tab-panel-body-top" >
  <div id="menu-body2" class="x-panel x-panel-noborder" >
  <div  class="x-panel-bwrap">
  <div id="menu-body" class="x-panel-body x-panel-body-noheader x-panel-body-noborder x-border-layout-ct" style="">
  <div id="menu-body3" class="x-panel x-border-panel x-grid-panel" style="left: 0px; top: 0px;">
  <div style="position: relative;"  class="x-panel-bwrap">

      <!-- 工具栏 -->
      <div id="tool" class="x-panel-tbar x-panel-tbar-noheader "><div  class="x-toolbar " style="border-left:0 solid #99bbe8;"><table cellspacing="0"><tbody><tr>

	  </tr></tbody></table></div>

	  </div>
	  <!-- /工具栏 -->

	  <!-- 搜索栏 -->
	  <div id="search" class="x-panel-bbar x-panel-body" style="border-left:0 solid #99bbe8; border-bottom:0 solid #99bbe8;" >
	  <div  class="x-toolbar x-small-editor" style=" padding:2px 0 5px 20px;">
	  <form id="search-form" style="overflow:;">
	    
		  <select name='computer_id'  style="width:100px;height:22px;">
		  <option value='0'  >机器编号</option>
		  <?php foreach($computer as $value):  ?>
		  <option value='<?php echo $value['id'];  ?>' <?php if($computer_selected == $value['id']) echo 'selected' ?> ><?php echo $value['id'];  ?></option>
		 
		  <?php endforeach; ?>  
		  </select>
		  &nbsp; &nbsp; 
		  <select name='property'style="width:100px;height:22px;">
		  <option value='pro_number'  >选择属性（默认进程数）</option>
		  <option value='pro_number' <?php if($property_selected == 'pro_number') echo 'selected' ?> >进程数目</option>
		  <option value='free_mem' <?php if($property_selected == 'free_mem') echo 'selected' ?> >空闲内存</option>
		  <option value='free_disk' <?php if($property_selected == 'free_disk') echo 'selected' ?> >空闲硬盘</option>
		  <option value='free_rate' <?php if($property_selected == 'free_rate') echo 'selected' ?>>CPU空闲率</option>
		  <option value='send_data' <?php if($property_selected == 'send_data') echo 'selected' ?>>发送的数据</option>
		  <option value='received_data'   <?php if($property_selected == 'is_commend') echo 'selected' ?>>接收的数据</option>
		  </select>
		  &nbsp; &nbsp;
		  <select name='day'  style="height:22px;">
		  <option value='0'>天</option>
          <option value='0' <?php if($day_selected == '0') echo 'selected' ?> >无</option>
		  <option value='1' <?php if($day_selected == '1') echo 'selected' ?> >一天</option>
		  <option value='2' <?php if($day_selected == '2') echo 'selected' ?> >两天</option>
		  <option value='5' <?php if($day_selected == '5') echo 'selected' ?>>五天</option>
		  <option value='10' <?php if($day_selected == '10') echo 'selected' ?>>十天</option>
		  <option value='15'   <?php if($day_selected == '15') echo 'selected' ?>>十五天</option>
          <option value='30'   <?php if($day_selected == '30') echo 'selected' ?>>三十天</option>
		  </select>
          
          &nbsp; &nbsp;
		  <select name='hour'  style="height:22px;">
		  <option value='0'>小时</option>
          <option value='0' <?php if($hour_selected == '0') echo 'selected' ?> >无</option>
		  <option value='1' <?php if($hour_selected == '1') echo 'selected' ?> >一小时</option>
		  <option value='2' <?php if($hour_selected == '2') echo 'selected' ?> >两小时</option>
		  <option value='5' <?php if($hour_selected == '5') echo 'selected' ?>>五小时</option>
		  <option value='10' <?php if($hour_selected == '10') echo 'selected' ?>>十小时</option>
		  <option value='12'   <?php if($hour_selected == '12') echo 'selected' ?>>十二小时</option>
		  </select>
          
          &nbsp; &nbsp;
		  <select name='minute'  style="height:22px;">
		  <option value='1'>分钟（默认1）</option>
		  <option value='1' <?php if($minute_selected == '1') echo 'selected' ?> >一分钟</option>
		  <option value='2' <?php if($minute_selected == '2') echo 'selected' ?> >两分钟</option>
		  <option value='5' <?php if($minute_selected == '5') echo 'selected' ?>>五分钟</option>
		  <option value='10' <?php if($minute_selected == '10') echo 'selected' ?>>十分钟</option>
		  <option value='15'   <?php if($minute_selected == '15') echo 'selected' ?>>十五分钟</option>
          <option value='30'   <?php if($minute_selected == '30') echo 'selected' ?>>三十分钟</option>
		  </select>
          
          &nbsp; &nbsp;
		  <select name='number'  style="height:22px;">
		  <option value='5'>每次显示的数目（默认五个）</option>
		  <option value='5' <?php if($number_selected == '1') echo 'selected' ?> >五个</option>
		  <option value='10' <?php if($number_selected == '2') echo 'selected' ?> >十个</option>
		  <option value='20' <?php if($number_selected == '5') echo 'selected' ?>>二十个</option>
		  <option value='30' <?php if($number_selected == '10') echo 'selected' ?>>三十个</option>
		  <option value='50'   <?php if($number_selected == '15') echo 'selected' ?>>五十个</option>
		  </select>
		   
		  &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
		  <button id="search-action" class="x-btn-text" type="button">确定</button>
	  </form>
	  </div></div>
	  <!-- /搜索栏 -->
	   
	   
	  <div style="border-left:0 solid #99bbe8; border-bottom:0 solid #99bbe8;" id="content" class="x-panel-body" >
	  <div class="list-div " id="listDiv" style="margin-bottom:20px;">	      
	  <table cellpadding="3" cellspacing="0" id="listTable" >		          
	  <tbody>
	  
	  <tr class="x-grid3-row " >
            <td> <button id="draw" class="x-btn-text" type="button">确定</button></td>
      		 <td><div class="x-grid3-cell-inner "><?php echo $computer_id ?></div></td>
			 <td ><div class="x-grid3-cell-inner " ><?php echo $property; ?></div></td>
			 <td><div class="x-grid3-cell-inner "><?php echo $day ?></div></td>
			 <td ><div class="x-grid3-cell-inner "><?php echo $hour ?></div></td>
			 <td ><div class="x-grid3-cell-inner "><?php echo $result ?></div></td>
			 <td ><div class="x-grid3-cell-inner "><?php echo $number ?></div></td>
			 <div style="width:450px;height:300px;text-align:center;margin:10px">        
        	 <div id="flot-placeholder1" style="width:100%;height:100%;"></div>      
		  </tr>
	  
	  </tbody></table>
	  </div>


    </div>
	     
  </div></div></div></div></div></div></div>
  <!-- /菜单体 --> 
</div>
</body>
</html>

