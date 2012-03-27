$(function() {
 	$(".double a.button").click(function(){  
    $(".double a.button.checked").removeClass("checked");  
		$(this).prev("input.RadioClass").attr("checked","checked");
    $(this).addClass("checked");
	});
	
	$(".remove").click(function(){
		confirm('Are you sure?');
	});
});