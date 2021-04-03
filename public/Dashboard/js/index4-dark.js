$(function () {

	/*-----Apex Chart-----*/
	window.Apex = {
	  chart: {
		foreColor: '#ccc',
		toolbar: {
		  show: false
		},
	  },
	  stroke: {
		width: 4
	  },
	  dataLabels: {
		enabled: false
	  },
	  tooltip: {
		enabled: false, 
		theme: 'dark'
	  },
	  grid: {
		borderColor: "#535A6C",
		xaxis: {
		  lines: {
			show: true
		  }
		}
	  }
	};
	/*-----Spark1-----*/
	var spark1 = {
	  chart: {
		id: 'spark1',
		group: 'sparks',
		type: 'line',
		height: 40,
		sparkline: {
		  enabled: true
		},
		dropShadow: {
		  enabled: false,
		  top: 1,
		  left: 1,
		  blur: 2,
		  opacity: 0.2,
		}
	  },
	  series: [{
		data: [25, 66, 41, 59, 25, 44, 12, 36, 9, 21]
	  }],
	  stroke: {
		curve: 'smooth'
	  },
	  markers: {
		size: 0
	  },
	  colors: ['#425bd6'],
	  tooltip: {
		x: {
		  show: false
		},
		y: {
		  title: {
			formatter: function formatter(val) {
			  return '';
			}
		  }
		}
	  }
	}
	new ApexCharts(document.querySelector("#spark1"), spark1).render();
	/*-----Spark1-----*/
	
	/*-----Spark2-----*/
	var spark2 = {
	  chart: {
		id: 'spark2',
		group: 'sparks',
		type: 'line',
		height: 40,
		sparkline: {
		  enabled: true
		},
		dropShadow: {
		  enabled: false,
		  top: 1,
		  left: 1,
		  blur: 2,
		  opacity: 0.2,
		}
	  },
	  series: [{
		data: [12, 14, 2, 47, 32, 44, 14, 55, 41, 69]
	  }],
	  stroke: {
		curve: 'smooth'
	  },
	  markers: {
		size: 0
	  },
	  colors: ['#02c3ee'],
	  tooltip: {
		x: {
		  show: false
		},
		y: {
		  title: {
			formatter: function formatter(val) {
			  return '';
			}
		  }
		}
	  }
	}
	new ApexCharts(document.querySelector("#spark2"), spark2).render();
	/*-----Spark2-----*/
	
	/*-----Spark3-----*/
	var spark3 = {
	  chart: {
		id: 'spark3',
		group: 'sparks',
		type: 'line',
		height: 40,
		sparkline: {
		  enabled: true
		},
		dropShadow: {
		  enabled: false,
		  top: 1,
		  left: 1,
		  blur: 2,
		  opacity: 0.2,
		}
	  },
	  series: [{
		data: [47, 45, 74, 32, 56, 31, 44, 33, 45, 19]
	  }],
	  stroke: {
		curve: 'smooth'
	  },
	  markers: {
		size: 0
	  },
	  colors: ['#f29f03'],
	  tooltip: {
		x: {
		  show: false
		},
		y: {
		  title: {
			formatter: function formatter(val) {
			  return '';
			}
		  }
		}
	  }
	}
	new ApexCharts(document.querySelector("#spark3"), spark3).render();
	/*-----Spark3-----*/
	
	/*-----Spark4-----*/
	var spark4 = {
	  chart: {
		id: 'spark4',
		group: 'sparks',
		type: 'line',
		height: 40,
		sparkline: {
		  enabled: true
		},
		dropShadow: {
		  enabled: false,
		  top: 1,
		  left: 1,
		  blur: 2,
		  opacity: 0.2,
		}
	  },
	  series: [{
		data: [15, 75, 47, 65, 14, 32, 19, 54, 44, 61]
	  }],
	  stroke: {
		curve: 'smooth'
	  },
	  markers: {
		size: 0
	  },
	  colors: ['#f94859'],
	  tooltip: {
		x: {
		  show: false
		},
		y: {
		  title: {
			formatter: function formatter(val) {
			  return '';
			}
		  }
		}
	  }
	}
	new ApexCharts(document.querySelector("#spark4"), spark4).render();
	/*-----Spark4-----*/
	
	/* Chart-js (#Revenue-chart) */
	var myCanvas = document.getElementById("revenue-chart");
	myCanvas.height="325";
    var myChart = new Chart( myCanvas, {
		type: 'bar',
		data: {
			labels: ["Jan", "Feb", "Mar", "Apr", "May", "June" ,"July", "Aug", "Sep", "Oct", "Nov", "Dec"],
			datasets: [{
				label: 'This Month',
				data: [1000, 2000, 3000, 2500, 3200, 2000, 3000, 2800,  2600, 1500, 2200, 1800],
				backgroundColor: '#425bd6',
				borderWidth: 1,
				hoverBackgroundColor: '#425bd6',
				hoverBorderWidth: 0,
				borderColor: '#425bd6',
				hoverBorderColor: '#425bd6',
			}, 
			{
				data: [4000, 4000, 4000, 4000, 4000, 4000, 4000, 4000, 4000, 4000, 4000, 4000],
				backgroundColor: '#272a52',
				borderWidth: 1,
				hoverBackgroundColor: '#272a52',
				hoverBorderWidth: 0,
				borderColor:'#272a52',
				hoverBorderColor: '#272a52',
			}
		  ]
		},
		options: {
			responsive: true,
			maintainAspectRatio: false,
			layout: {
				padding: {
					left: 0,
					right: 0,
					top: 0,
					bottom: 0
				}
			},
			tooltips: {
				enabled: true,
			},
			scales: {
				yAxes: [{
					gridLines: {
						display: true,
						drawBorder: false,
						zeroLineColor: 'rgba(255, 255, 255, 0.05)',
						color: "rgba(255, 255, 255, 0.05)",
					},
					scaleLabel: {
						display: false,
					},
					ticks: {
						stepSize: 500,
						max: 4000,
						min:500,
						fontColor: "#797c90",
						fontFamily: 'Poppins',
					},
				}],
				xAxes: [{
                    barPercentage: 0.2,
					barValueSpacing :3,
					barDatasetSpacing : 3,
					barRadius: 5,
					stacked: true,
					ticks: {
						beginAtZero: true,
						fontColor: "#797c90",
						fontFamily: 'Poppins',
					},
					gridLines: {
						color: "rgba(255, 255, 255, 0.05)",
						display: false
					},

				}]
			},
			legend: {
				display: false
			},
			elements: {
				point: {
					radius: 0
				}
			}
		}
	});
	/* Chart-js (#revenue-chart) closed */

	/* Chartjs (#doChart) */
	var doughnut = document.getElementById("visitors");
	var myDoughnutChart = new Chart(doughnut, {
		type: 'doughnut',
		data: {
		labels:["Online Visitors","Offline Visitors", ""],
		datasets: [{
			label: "My First dataset",
			data: [68, 45, 30],
			backgroundColor: ['#425bd6','#00c3ed','#272a52'],
			borderColor: ['#425bd6','#00c3ed','#272a52']
		 }]
	   },
	  options: {
			maintainAspectRatio : false,
			cutoutPercentage:80,
			legend: {
				display: false
			},
		}
	});
	/* Chartjs (#doChart) closed */
	
	/* Data Table */
	$('#example1').DataTable({
		"paging":   false,
		language: {
			searchPlaceholder: 'Search...',
			sSearch: '',
			lengthMenu: '_MENU_',
		}
	});
	/* End Data Table */

});