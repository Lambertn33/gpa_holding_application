(function($) {
	"use strict";
		
	//select box
	var select = document.getElementById('fruit_select');
	multi(select, {
		non_selected_header: 'Fruits',
		selected_header: 'Favorite fruits'
	});
	
	var select = document.getElementById('fruit_select1');
	multi(select, {
		enable_search: true
	} );
	
	//muti
	window.asd = $('.SlectBox').SumoSelect({ csvDispCount: 3, selectAll:true, captionFormatAllSelected: "Yeah, OK, so everything." });
	window.Search = $('.search-box').SumoSelect({ csvDispCount: 3, search: true, searchText:'Enter here.' });
	window.sb = $('.SlectBox-grp-src').SumoSelect({ csvDispCount: 3, search: true, searchText:'Enter here.', selectAll:true });
	$('.testselect1').SumoSelect();
	$('.testselect2').SumoSelect();
	$('.select1').SumoSelect({ okCancelInMulti: true, selectAll: true });
	$('.select3').SumoSelect({ selectAll: true });
	$('.search_test').SumoSelect({search: true, searchText: 'Enter here.'});
	
	
	//transfer
	var dataArray1 = [
		{
			"city": "Beijing",
			"value": 132
		},
		{
			"city": "Shanghai",
			"value": 422
		},
		{
			"city": "Chengdu",
			"value": 232
		},
		{
			"city": "Wuhan",
			"value": 765
		},
		{
			"city": "Tianjin",
			"value": 876
		},
		{
			"city": "Guangzhou",
			"value": 453
		},
		{
			"city": "Hongkong",
			"value": 125
		}
	];
	var settings1 = {
		"dataArray": dataArray1,
		"itemName": "city",
		"valueName": "value",
		"callable": function (items) {
			console.dir(items)
		}
	};
	$("#transfer1").transfer(settings1);
	var groupDataArray1 = [
		{
			"groupName": "China",
			"groupData": [
				{
					"city": "Beijing",
					"value": 122
				},
				{
					"city": "Shanghai",
					"value": 643
				},
				{
					"city": "Qingdao",
					"value": 422
				},
				{
					"city": "Tianjin",
					"value": 622
				}
			]
		},
		{
			"groupName": "Japan",
			"groupData": [
				{
					"city": "Tokyo",
					"value": 132
				},
				{
					"city": "Osaka",
					"value": 112
				},
				{
					"city": "Yokohama",
					"value": 191
				}
			]
		}
	];
	var settings3 = {
		"groupDataArray": groupDataArray1,
		"groupItemName": "groupName",
		"groupArrayName": "groupData",
		"itemName": "city",
		"valueName": "value",
		"callable": function (items) {
			console.dir(items)
		}
	};
	$("#transfer2").transfer(settings3);
		
	//Colorpicker
	$('.my-colorpicker1').colorpicker()
	
	//Timepicker
	$('.timepicker').timepicker({
		showInputs: false
	});
	
	//fancyfileuplod
	$('#demo').FancyFileUpload({
	params : {
		 action : 'fileuploader'
		},
		maxfilesize : 1000000
	});

		
})(jQuery);