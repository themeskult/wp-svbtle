$(function() {
 	$("a.button").click(function(){  
    $("a.button.checked").removeClass("checked");  
		$(this).prev("input.RadioClass").attr("checked","checked");
    $(this).addClass("checked");
	});
});