$(function(e){

	/*-----Balance Statistics-----*/
	var myCanvas = document.getElementById("balance");
	myCanvas.height="340";
    var myChart = new Chart( myCanvas, {
		type: 'line',
		data: {
			labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
			datasets: [{
				label: 'Deposit Money',
				data: [100, 210, 180, 454, 454, 230, 230,656,656,350,350, 210, 410],
				backgroundColor: 'rgba(66, 91, 214, .1)',
				borderWidth: 3,
				borderColor: '#425bd6',
				hoverBorderColor: '#425bd6',
			}, {

			    label: 'Withdraw Money',
				data: [200, 530, 110, 110, 480, 520, 780,435,475,738, 454, 454, 230],
				backgroundColor: 'rgba(2, 195, 238, .04)',
				borderWidth: 3,
				borderColor: '#02c3ee',
				hoverBorderColor: '#02c3ee',
				borderDash: [9,6],
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
				enabled: false,
			},
			scales: {
				yAxes: [{
					gridLines: {
						display: true,
						drawBorder: false,
						zeroLineColor: 'rgba(142, 156, 173,0.1)',
						color: "rgba(142, 156, 173,0.1)",
					},
					scaleLabel: {
						display: false,
					},
					ticks: {
						beginAtZero: true,
						stepSize: 200,
						max: 1000,
						fontColor: "#8492a6",
						fontFamily: 'Poppins',
					},
				}],
				xAxes: [{
					ticks: {
						beginAtZero: true,
						fontColor: "#8492a6",
						fontFamily: 'Poppins',
					},
					gridLines: {
						color: "rgba(142, 156, 173,0.1)",
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
	/*-----Balance Statistics-----*/

});