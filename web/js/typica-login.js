jQuery(document).ready(function($) {

	$.backstretch([
      "/opHostingPlugin/bg1.png"
  	], {duration: 3000, fade: 750});
		
  $('.partsHeading').remove();
  $('#backLink').remove();

  var errMessage = $('#loginError').text();
  $('legend').after('<div style="color: #f00; padding-bottom: 10px;">' + errMessage + '</div>');

  $('#loginError').remove();
});


