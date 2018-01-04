(function($){
  $(function(){

    $('.button-collapse').sideNav();
    
    $('select').material_select();
    
    $('.datepicker').pickadate({
	    selectMonths: true, // Creates a dropdown to control month
	    selectYears: 5, // Creates a dropdown of 15 years to control year
	    min: new Date(1999,3,20),
		max: new Date(2016,11,14),
		close: 'OK'
	});

  }); // end of document ready
})(jQuery); // end of jQuery name space