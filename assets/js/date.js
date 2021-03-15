;(function ($, window, document, undefined) {
    'use strict';

jQuery(function() {
	if( jQuery(".wpb-date").length ){ 
		jQuery(".wpb-date").datetimepicker({dateFormat: 'yy/mm/dd'}); 
	} 
});

})(jQuery, window, document);