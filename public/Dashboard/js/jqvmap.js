$(function(e){
  'use strict'

	//world map
	if ($('#world-map-gdp').length ){

		$('#world-map-gdp').vectorMap({
			map: 'world_en',
			backgroundColor: null,
			color: '#425bd6',
			hoverOpacity: 0.7,
			selectedColor: '#425bd6',
			enableZoom: true,
			showTooltip: true,
			scaleColors: ['#425bd6', '#02c3ee'],
			normalizeFunction: 'polynomial'
		});

	}

	//us map
	if ($('#usa_map').length ){

		$('#usa_map').vectorMap({
			map: 'usa_en',
			backgroundColor: null,
			color: '#02c3ee',
			hoverOpacity: 0.7,
			selectedColor: '#02c3ee',
			enableZoom: true,
			showTooltip: true,
			normalizeFunction: 'polynomial'
		});

	}

	//german
	if ($('#german').length ){
		$('#german').vectorMap({
			map : 'germany_en',
			backgroundColor: null,
			color: '#04b372',
			hoverOpacity: 0.7,
			selectedColor: '#04b372',
			enableZoom: true,
			showTooltip: true,
			normalizeFunction: 'polynomial'
		});
	}

	//russia
	if ($('#russia').length ){
		$('#russia').vectorMap({
			map : 'russia_en',
			backgroundColor: null,
			color: '#f43f86',
			hoverOpacity: 0.7,
			selectedColor: '#f43f86',
			enableZoom: true,
			showTooltip: true,
		});
	}

});