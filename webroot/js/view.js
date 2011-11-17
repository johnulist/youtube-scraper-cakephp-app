$(document).ready(function() {

	$('.starbox').starbox({
	    average: $('.starbox').attr('a'),
		stars: 5,
		buttons: 10,
	    changeable: 'once',
	    autoUpdateAverage: true,
	    ghosting: true,
	}).bind('starbox-value-changed', function(event, value) {
		var id = $(this).attr('id');
	    $.getJSON('/videos/rating', { id: id, rating: value }, function(data) {
	        if(!data.error) {
	            $('.starbox').starbox('setOption', 'average', data.result);
	            $('#starbox-text').html('Thank you for voting! New average rating is: ' + data.resultNice +'/5');
	        }
	    });
	});

});
