$(document).ready(function() {

	$(".tbl tr:nth-child(odd)").addClass("odd");
	$(".tbl tr").hover(function() {
		$(this).addClass("hover");
	}, function() {
		$(this).removeClass("hover");
	});

	$("a.image").fancybox({
		'hideOnContentClick': true
	});
	$("a.iframe").fancybox({
		'hideOnContentClick': true
	});


});


// $(document).ready(function() {
	
	// $("a#inline").fancybox({
	// 	'hideOnContentClick': true
	// });
	// 
	// /* Apply fancybox to multiple items */
	// 
	// $("a.group").fancybox({
	// 	'transitionIn'	:	'elastic',
	// 	'transitionOut'	:	'elastic',
	// 	'speedIn'		:	600, 
	// 	'speedOut'		:	200, 
	// 	'overlayShow'	:	false
	// });
	
// });