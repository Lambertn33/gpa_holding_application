$(function(e) {
    'use strict'

    /* Chartjs (#sales-summary) */
    var myCanvas = document.getElementById("sales-summary");
    myCanvas.height = "300";
    var myChart = new Chart(myCanvas, {
        type: 'bar',
        data: {
            labels: ["Jan", "Feb", "Mar", "Apr", "May", "June", "July", "Aug", "Sep", "Oct", "Nov", "Dec"],
            datasets: [{
                    label: 'This Month',
                    data: [28, 17, 28, 23, 15, 19, 28, 22, 15, 28, 21, 28],
                    backgroundColor: '#425bd6',
                    borderWidth: 1,
                    hoverBackgroundColor: '#425bd6',
                    hoverBorderWidth: 0,
                    borderColor: '#425bd6',
                    hoverBorderColor: '#425bd6',
                }, {

                    label: 'Last Month',
                    data: [45, 25, 40, 31, 22, 33, 48, 29, 25, 40, 32, 40],
                    backgroundColor: '#02c3ee',
                    borderWidth: 1,
                    hoverBackgroundColor: '#02c3ee',
                    hoverBorderWidth: 0,
                    borderColor: '#02c3ee',
                    hoverBorderColor: '#02c3ee',
                },
                {
                    data: [50, 50, 50, 50, 50, 50, 50, 50, 50, 50, 50, 50],
                    backgroundColor: '#eff6fe',
                    borderWidth: 1,
                    hoverBackgroundColor: '#eff6fe',
                    hoverBorderWidth: 0,
                    borderColor: '#eff6fe',
                    hoverBorderColor: '#eff6fe',
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
                        stepSize: 10,
                        max: 50,
                        fontColor: "#8492a6",
                        fontFamily: 'Poppins',
                    },
                }],
                xAxes: [{
                    barPercentage: 0.15,
                    barValueSpacing: 3,
                    barDatasetSpacing: 3,
                    barRadius: 5,
                    stacked: true,
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
    /* Chartjs (#sales-summary) closed */

    /* Visitors */
    var options9 = {
        series: [68, 50, 35],
        chart: {
            height: 370,
            type: 'radialBar',
        },
        plotOptions: {
            radialBar: {
                dataLabels: {
                    name: {
                        fontSize: '22px',
                        show: true,
                    },
                    value: {
                        fontSize: '16px',
                        color: '#7c8099',
                        show: true,
                    },
                    total: {
                        show: true,
                        label: 'TOTAL',
                        color: '#8492a6',
                    }
                },
                track: {
                    background: '#eff6fe',
                    strokeWidth: "40%",
                },
            }
        },
        stroke: {
            lineCap: "round"
        },
        labels: ['Mens', 'Womens', 'Kids'],
        colors: ['#425bd6', '#00c3ed', '#fee05c'],
    };
    var chart9 = new ApexCharts(document.querySelector("#visitors"), options9);
    chart9.render();
    /* End Visitors */

    /* Data Table */
    $('#example1').DataTable({
        "paging": false,
        order: [],
        columnDefs: [{ orderable: false, targets: [0] }],
        language: {
            searchPlaceholder: 'Search...',
            sSearch: '',
            lengthMenu: '_MENU_',
        }
    });
    /* End Data Table */

    /*--- Apex (#chart) ---*/
    var options = {
        chart: {
            height: 200,
            type: 'radialBar',
        },
        plotOptions: {
            radialBar: {
                startAngle: -125,
                endAngle: 125,
                size: 110,
                track: {
                    strokeWidth: "76%",
                    background: '#eff6fe',
                },
                dropShadow: {
                    enabled: false,
                    top: 0,
                    left: 0,
                    blur: 3,
                    opacity: 0.5
                },
                dataLabels: {
                    name: {
                        fontSize: '16px',
                        color: '#8492a6',
                        offsetY: 30,
                    },
                    hollow: {
                        size: "96%",
                        background: 'transparent',
                    },
                    value: {
                        offsetY: -10,
                        fontSize: '22px',
                        color: '#8492a6',
                        formatter: function(val) {
                            return val + "%";
                        }
                    }
                }
            }
        },
        colors: ['#425bd6'],
        stroke: {
            dashArray: 6
        },
        series: [76],
        labels: [""]
    };

    var chart = new ApexCharts(document.querySelector("#chart"), options);
    chart.render();
    /*--- Apex (#chart)closed ---*/

});