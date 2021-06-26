$(document).ready(function(){
	
	// main-menu
    var target = $('body').data('target'),
		subMenu = $('#'+target).data('target');
	$('#'+target).addClass('active');
	$('#'+subMenu).addClass('active');

	// sub-menu
	var subMenuTarget = $("div.container-fluid").data("target");
	$("a#" + subMenuTarget).addClass('active');

	// alert-box
	$("button.close").on("click", function(e){
		$(this).closest("div.alert").fadeOut(600);
		// $(this).closest("div.alert").remove();
		e.preventDefault();
	});
	
	// nice scroll
	$("#sidebar-wrapper").niceScroll({
		cursorcolor:"#787878"
	});


});

