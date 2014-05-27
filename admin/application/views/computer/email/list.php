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
 <span class="x-tab-strip-text">发送邮件</span>
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
  
<style type="text/css">
<!--
body {
	background-color: ;
}

body,td,th {
	font-size: 12px;
	color: #666666;
}
.spantitle{
	font-size: 14px;
	font-weight: bold;
	text-align: center;
}
-->
</style>
</head>

<body>
 
	
 
 

	<div class="framecenter">
		   
		  <p>&nbsp;</p>
		  <div class="pmx"></div>
		  <br />
<form name="contactForm" method="post" action="mail.php" target="ifrm">

 <table width="100%" >
<tr>
  <td><table width="100%" border="0" cellspacing="0" cellpadding="5">




<tr bgcolor="#F5F0DA"><td bgcolor="#FFFFFF">Name *</td>
<td bgcolor="#FFFFFF"><font color="#15428b" size="2.5" face="Arial">
 <select name='property'style="width:100px;height:22px;">
		  <option value='pro_number'  >联系人列表</option>
		  <option value='pro_number'  >contact1</option>
		  <option value='free_mem'  >contact2</option>
		  <option value='free_disk'  >contact3</option>
		  <option value='free_rate' >contact4</option>
		  <option value='send_data' >contact5</option>
		  <option value='received_data'  >contact6</option>
		  </select>
		  </select></font></td>
  
  
  <br>
</tr>
&nbsp; &nbsp;
<tr bgcolor="#F5F0DA"><td bgcolor="#FFFFFF"> Phone No. * </td>
<td bgcolor="#FFFFFF"><font color="#15428b" size="2" face="Arial">
  <input name="q2" type="text" value="" size="21" maxlength="" />
</font></td></tr>
&nbsp; &nbsp;
<tr bgcolor="#F5F0DA"><td bgcolor="#FFFFFF"> Suburb </td>
<td bgcolor="#FFFFFF"><font color="#15428b" size="2.5" face="Arial">
  <input name="q3" type="text" value="" size="21" maxlength="" />
</font></td></tr>
&nbsp; &nbsp;
<tr bgcolor="#F5F0DA"><td bgcolor="#FFFFFF"> E-Mail  * </td>
<td bgcolor="#FFFFFF"><input name="email" type="text" id="email" size="21" maxlength="100" /></td></tr>
<tr bgcolor="#F5F0DA"><td bgcolor="#FFFFFF"> Message  * </td>
<td bgcolor="#FFFFFF"> 
  <textarea name="q4" cols="75" rows="30" ></textarea>
 </td></tr>

<tr><td height="50" colspan="2"><input name="发送" type="submit" onclick=alert("邮件已经发送成功") value="发送" />
  <font size="1" face="Verdana, Arial, Helvetica, sans-serif" color="#15428b">
  <input name="重置" type="reset" value="重置" />
  </font></td>
</tr>
<tr>
  <td><font color="#15428b" size="1" face="Verdana, Arial, Helvetica, sans-serif"><b>*</b></font> 
	<font size="1" face="Verdana, Arial, Helvetica, sans-serif" color="#15428b">Required</font></td>
  <td align="right"><font size="1" face="Verdana, Arial, Helvetica, sans-serif"><font></td></tr>
</table></td></tr></table>
<input name="user" type="hidden" id="user" value="johnny_zhou" /><input name="formid" type="hidden" id="formid" value="351745" /><input name="subject" type="hidden" id="subject" value="Cleaning Enquiry" />
		  </form> 
	</div>
 
 
	<iframe frameborder=0 width="0" height="0" src="" scrolling="no" name="ifrm" ID="ifrm"></iframe></body>
</html>

 
</div>
</body>
</html>

