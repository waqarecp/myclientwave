"use strict";

var KTChartsWidget36 = (function () {
	var charts = [];

	var initChart = function(chartData, index) {
		var element = document.getElementById("kt_charts_widget_36_" + index);

		if (!element) {
			return;
		}

		var height = parseInt(KTUtil.css(element, 'height'));
	var labelColor = KTUtil.getCssVariableValue('--bs-gray-500');
	var borderColor = KTUtil.getCssVariableValue('--bs-border-dashed-color');
	var baseprimaryColor = KTUtil.getCssVariableValue('--bs-primary');
	var lightprimaryColor = KTUtil.getCssVariableValue('--bs-primary');
	var basesuccessColor = KTUtil.getCssVariableValue('--bs-success');
	var lightsuccessColor = KTUtil.getCssVariableValue('--bs-success');

	var options = {
		series: [{
			name: 'Sessions',
			data: chartData.sessionsData
		}, {
			name: 'Same Period 1 month ago',
			data: chartData.previousMonthData
		}],
		chart: {
			fontFamily: 'inherit',
			type: 'area',
			height: height,
			toolbar: {
				show: false
			}
		},
		plotOptions: { },
		legend: {
			show: false
		},
		dataLabels: {
			enabled: false
		},
		fill: {
			type: "gradient",
			gradient: {
				shadeIntensity: 1,
				opacityFrom: 0.4,
				opacityTo: 0.2,
				stops: [15, 120, 100]
			}
		},
		stroke: {
			curve: 'smooth',
			show: true,
			width: 3,
			colors: [baseprimaryColor, basesuccessColor]
		},
		xaxis: {
			categories: chartData.categories, // Use categories from chartData
			axisBorder: {
				show: false,
			},
			axisTicks: {
				show: false
			},
			tickAmount: 6,
			labels: {
				rotate: 0,
				rotateAlways: true,
				style: {
					colors: labelColor,
					fontSize: '12px'
				}
			},
			crosshairs: {
				position: 'front',
				stroke: {
					color: [baseprimaryColor, basesuccessColor],
					width: 1,
					dashArray: 3
				}
			},
			tooltip: {
				enabled: true,
				formatter: undefined,
				offsetY: 0,
				style: {
					fontSize: '12px'
				}
			}
		},
		yaxis: {
			max: 120,
			min: 30,
			tickAmount: 6,
			labels: {
				style: {
					colors: labelColor,
					fontSize: '12px'
				} 
			}
		},
		states: {
			normal: {
				filter: {
					type: 'none',
					value: 0
				}
			},
			hover: {
				filter: {
					type: 'none',
					value: 0
				}
			},
			active: {
				allowMultipleDataPointsSelection: false,
				filter: {
					type: 'none',
					value: 0
				}
			}
		},
		tooltip: {
			style: {
				fontSize: '12px'
			} 
		},
		colors: [lightprimaryColor, lightsuccessColor],
		grid: {
			borderColor: borderColor,
			strokeDashArray: 4,
			yaxis: {
				lines: {
					show: true
				}
			}
		},
		markers: {
			strokeColor: [baseprimaryColor, basesuccessColor],
			strokeWidth: 3
		}
	};

	var chart = new ApexCharts(element, options);
	chart.render();
	charts.push(chart);    

	};

	return {
		init: function(chartDataArray) {
			if (Array.isArray(chartDataArray)) {
				// If chartDataArray is an array
				chartDataArray.forEach(function(chartData, index) {
					initChart(chartData, index);
				});
			} else if (typeof chartDataArray === 'object' && chartDataArray !== null) {
				// If chartDataArray is an object
				Object.keys(chartDataArray).forEach(function(key, index) {
					var chartData = chartDataArray[key];
					initChart(chartData, index);
				});
			} 
		}
	}
})();

KTChartsWidget36.init(chartDataArray);

// Webpack support
if (typeof module !== 'undefined') {
    module.exports = KTChartsWidget36;
}

// On document ready
KTUtil.onDOMContentLoaded(function() {
    KTChartsWidget36.init();
});
