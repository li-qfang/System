<script language="JavaScript"> 
<!--


//列表窗口缩放效果
$(document).ready(function() {
  listBody();
});
$(window).resize(function(){
  listBody();
});

$(document).ready(function() {
  $('#search-action').click(function(){
   var params $('#search-form').serialize();
   $.ajax({ 
   		url:'<?php echo base_url()?>computer/single',
		type:'POST',
		data:params,
		success: update_page
   });
  });
  
  function update_page (json)  //回传函数实体，参数为XMLhttpRequest.responseText
  {
  	var str="time" + json.time;
	alert(str);
  
  }

});

 //--> 
</script>