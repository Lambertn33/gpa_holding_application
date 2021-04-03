$(function(e){

	/*-----analytic-----*/
	var ctx = document.getElementById("analytic").getContext('2d');
	var myChart = new Chart(ctx, {

		data: {
			labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Aug', 'Sep', 'Oct'],
			datasets: [{
				label: 'Total Income',
				data: [100, 210, 180, 354,  270, 140, 220, 356, 256, 350, 280, 230, 410],
				borderWidth: 3,
				backgroundColor: 'transparent',
				borderColor: '#425bd6',
				pointBackgroundColor: '#ffffff',
				pointRadius: 0,
				type: 'line',
			},
			{

				label: 'Total Revenue',
				data: [200, 330, 150, 170, 380, 250, 180, 435, 375, 238, 354, 454, 230,],
				borderWidth: 3,
				backgroundColor: 'transparent',
				borderColor: '#c0d3f9',
				pointBackgroundColor: '#ffffff',
				pointRadius: 0,
				type: 'line',
				borderDash: [7,3],

			}]
		},
		options: {
			responsive: true,
			maintainAspectRatio: false,
			tooltips: {
				enabled: true,
			},
			tooltips: {
				mode: 'index',
				intersect: false,
			},
			hover: {
				mode: 'nearest',
				intersect: true
			},
			scales: {
				xAxes: [{
					ticks: {
						fontColor: "#8492a6",
					},
					barPercentage: 0.7,
					display: true,
					gridLines: {
						color:'rgba(142, 156, 173,0.1)',
						zeroLineColor: 'rgba(142, 156, 173,0.1)',
					}
				}],
				yAxes: [{
					ticks: {
						beginAtZero: true,
						stepSize: 100,
						max: 500,
						fontColor: "#8492a6",
					},
					display: true,
					gridLines: {
						color:'rgba(142, 156, 173,0.1)',
						zeroLineColor: 'rgba(142, 156, 173,0.1)',
					}
				}]
			},
			legend: {
				display: true,
				width:30,
				height:30,
				borderRadius:50,
				labels: {
					fontColor: "#8492a6"
				},
			},
		}
	});
	/*-----analytic-----*/

	/* Chartjs (#doChart) */
	var doughnut = document.getElementById("doChart");
	var myDoughnutChart = new Chart(doughnut, {
		type: 'doughnut',
		data: {
		labels:["Desktop","Tab", "Mobile"],
		datasets: [{
			data: [60, 40, 35],
			backgroundColor: ['#425bd6','#02c3ee','#ffe15b'],
			borderColor: ['#425bd6','#02c3ee','#ffe15b']
		 }]
	   },
	  options: {
			maintainAspectRatio : false,
			cutoutPercentage:75,
			legend: {
				display: false
			},
		},
		centerText: {
			display: true,
			text: "280"
		}
	});

	/* Chartjs (#doChart) closed */

	/*table-remove*/
	$('.table-remove').on("click",function () {
		$(this).parents('tr').detach();
	});
});
