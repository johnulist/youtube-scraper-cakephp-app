$(document).ready(function(){
	
	$("input:text:visible:first").focus();
	
	// var cache = {},	lastXhr;
	// 
	// $("#VideoSearch").autocomplete({
	// 	delay: 400,
	// 	minLength: 2,
	// 	source: function( request, response ) {
	// 		var term = request.term;
	// 		if ( term in cache ) {
	// 			response( cache[ term ] );
	// 			return;
	// 		}
	// 
	// 		lastXhr = $.getJSON( "/videos/searchjson.json", request, function( data, status, xhr ) {
	// 			cache[ term ] = data;
	// 			if ( xhr === lastXhr ) {
	// 				response( data );
	// 			}
	// 		});
	// 	}
	// });
	// 
	//     $("#VideoSearch").keypress(function (e) {
	//        if (e.which == 32 | e.which == 61) {
	//          e.preventDefault();
	//        }
	//     }).val('');
	

	var timeout;
	var delay = 500;
	
	function reloadSearch() {
	
		var name = $('#VideoSearch').val();
	
		// $('#loading').show();
		
		timeout = setTimeout(function() {
			$('#all').load('/videos/search', {name: name}, function() {
				// $('#loading').hide();
			});
			setTimeout(function() {}, 500);
		}, delay);
	
	}
	
	$('#VideoSearch').keyup(function() {
		
		var name = $('#VideoSearch').val();
		
		if (name.length > 3 && name.length < 40) {
			if (timeout) {
	             clearTimeout(timeout);   
	        }
			reloadSearch();
		}
		
	});	
	
	
});