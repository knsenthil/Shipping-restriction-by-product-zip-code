define([
    'jquery',
    'mage/url'
], function ($,url) {
    'use strict';
    console.log("Called this Hook.");
	var linkUrl = url.build('validatezipcode/index/index');
    $(document).ready(function () {
        $(document).on('blur', "[name='postcode']",function (){
			var param = 'zipcode='+$(this).val();
			$.ajax({
				showLoader: true,
				url: linkUrl,
				data: param,
				type: "POST"
			}).done(function (data) {
				if(data) {
					jQuery('li#opc-shipping_method').hide();
					alert('shipping options will not available for the entered zipcode');
					showLoader: false;
				}
			});
        });
    });
    return function (targetModule) {
        targetModule.crazyPropertyAddedHere = 'yes';
        return targetModule;
    };
});