"use strict";

// Class definition
var KTChartsWidget27 = function () {
    var chart = {
        self: null,
        rendered: false
    };

    // Helper function to get data from hidden input
    var getLeadData = function() {
        var leadDataInput = document.getElementById("lead_data");
        if (!leadDataInput) {
            return { dates: [], values: [] };
        }

        var leadData = JSON.parse(leadDataInput.value);
        var dates = Object.keys(leadData);
        var values = Object.values(leadData);

        return { dates: dates, values: values };
    };

    // Private methods
    var initChart = function(chart) {
        var element = document.getElementById("kt_charts_widget_27");

        if (!element) {
            return;
        }

        // Get lead data
        var leadData = getLeadData();
        
        var labelColor = KTUtil.getCssVariableValue('--bs-gray-800');    
        var borderColor = KTUtil.getCssVariableValue('--bs-border-dashed-color');
        var maxValue = Math.max(...leadData.values) || 10; // Adjust maxValue based on data

        var options = {
            series: [{
                name: 'Leads',
                data: leadData.values                                                                                                              
            }],           
            chart: {
                fontFamily: 'inherit',
                type: 'bar',
                height: 350,
                toolbar: {
                    show: false
                }                             
            },                    
            plotOptions: {
                bar: {
                    borderRadius: 8,
                    horizontal: true,
                    distributed: true,
                    barHeight: 50,
                    dataLabels: {
                        position: 'bottom' // use 'bottom' for left and 'top' for right align(textAnchor)
                    }                                                       
                }
            },
            dataLabels: {
                enabled: true,              
                textAnchor: 'start',  
                offsetX: 0,                 
                formatter: function (val) {
                    return Math.round(val * 1000).toLocaleString(); // Format large numbers
                },
                style: {
                    fontSize: '14px',
                    fontWeight: '600',
                    align: 'left',                                                            
                }                                       
            },             
            legend: {
                show: false
            },                               
            colors: ['#3E97FF', '#F1416C', '#50CD89', '#FFC700', '#7239EA'],                                                                      
            xaxis: {
                categories: leadData.dates,
                labels: {
                    formatter: function (val) {
                        // Convert to thousands and add "K"
                        let newVal = val * 1000;
                        if (newVal >= 1000) {
                            return (newVal / 1000).toFixed(1).replace('.0', '') + 'K'; // Show values like 1K, 1.5K, 2K, etc.
                        } else {
                            return newVal.toFixed(0); // Show values below 1000 as whole numbers
                        }
                    },
                    style: {
                        colors: labelColor,
                        fontSize: '14px',
                        fontWeight: '600',
                        align: 'left'                                              
                    }                  
                },
                axisBorder: {
                    show: false
                }                         
            },
            yaxis: {
                labels: {       
                    formatter: function (val) {
                        if (Number.isInteger(val)) {
                            var percentage = Math.round((val / maxValue) * 100).toString(); 
                            return val + ' - ' + percentage + '%';
                        } else {
                            return val;
                        }
                    },            
                    style: {
                        colors: labelColor,
                        fontSize: '14px',
                        fontWeight: '600'                                                                 
                    },
                    offsetY: 2,
                    align: 'left' 
                }           
            },
            grid: {                
                borderColor: borderColor,                
                xaxis: {
                    lines: {
                        show: true
                    }
                },   
                yaxis: {
                    lines: {
                        show: false  
                    }
                },
                strokeDashArray: 4              
            },
            tooltip: {
                style: {
                    fontSize: '12px'
                },
                y: {
                    formatter: function (val) {
                        return val;
                    }
                }
            }                                 
        };

        chart.self = new ApexCharts(element, options);

        // Set timeout to properly get the parent elements width
        setTimeout(function() {
            chart.self.render();
            chart.rendered = true;
        }, 200);        
    }

    // Public methods
    return {
        init: function () {
            initChart(chart);

            // Update chart on theme mode change
            KTThemeMode.on("kt.thememode.change", function() {                
                if (chart.rendered) {
                    chart.self.destroy();
                }

                initChart(chart);
            });
        }   
    }
}();

// Webpack support
if (typeof module !== 'undefined') {
    module.exports = KTChartsWidget27;
}

// On document ready
KTUtil.onDOMContentLoaded(function() {
    KTChartsWidget27.init();
});
