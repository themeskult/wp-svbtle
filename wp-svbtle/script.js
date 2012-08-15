$(function() {
 	$(".double a.button").click(function(){  
    	$(".double a.button").removeClass("checked");  
		$("input.RadioClass").attr("checked",null);

		$(this).prev("input.RadioClass").attr("checked","checked");
	    $(this).addClass("checked");
	});
	
	$(".remove").click(function(){
		var answer = confirm('Are you sure?');
		return answer;
	});

     // preview in iframe on the edit page
	$("a.button.preview").click(function(e){
		// does the iframe exist already?
		if ($("iframe.preview").length) {                
               // stop the event propogation
		     e.preventDefault();
               // display the preview pane
               $("div.preview").fadeIn(500);
		} 
	});

     // close preview
	$("a.close").click(function(e){
          e.preventDefault();
          $("div.preview").fadeOut(500);
     });
});