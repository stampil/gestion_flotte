$(function() {
	console.log('ready');
$('.title_deco').on('click',function(){
	var id = $(this).attr('id');
	console.log(id,'clicked');
	$('#content_'+id).toggle(500);
});
  
  
});