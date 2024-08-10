"use strict";

// Define a function to handle the AJAX request
var updateDateRange = function(startDate, endDate) {
    var currentUrl = window.location.pathname;
    var ajaxRoute;
      // Determine the appropriate controller route based on the current URL
      if (currentUrl.includes('performance-analytics')) {
        ajaxRoute = '/performance-analytics';
    } else if (currentUrl.includes('google-analytics')) {
        ajaxRoute = '/google-analytics';
    } else if (currentUrl.includes('facebook-analytics')) {
        ajaxRoute = '/facebook-analytics';
    } else {
        ajaxRoute = '/dashboard';
    }

    $.ajax({
        url: ajaxRoute,
        type: 'GET',
        data: {
            start_date: startDate,
            end_date: endDate
        },
        success: function(response) {
            // Update UI with fetched data
            $('.data-container').html(response);
        },
        error: function(xhr, status, error) {
            console.error(error);
        }
    });
};

// Bind an event listener to the date picker
$('[data-kt-daterangepicker="true"]').on('apply.daterangepicker', function(ev, picker) {
    var startDate = picker.startDate.format('YYYY-MM-DD');
    var endDate = picker.endDate.format('YYYY-MM-DD');

    // Trigger the AJAX request to update the date range
    updateDateRange(startDate, endDate);
});
// Class definition
var KTLayoutToolbar = function () {
    // Private variables
    var toolbar;

    // Private functions
    var initForm = function () {
        var rangeSlider = document.querySelector("#kt_app_toolbar_slider");
        var rangeSliderValueElement = document.querySelector("#kt_app_toolbar_slider_value");

        if (!rangeSlider) {
            return;
        }

        noUiSlider.create(rangeSlider, {
            start: [5],
            connect: [true, false],
            step: 1,
            format: wNumb({
                decimals: 1
            }),
            range: {
                min: [1],
                max: [10]
            }
        });

        rangeSlider.noUiSlider.on("update", function (values, handle) {
            rangeSliderValueElement.innerHTML = values[handle];
        });

        var handle = rangeSlider.querySelector(".noUi-handle");

        handle.setAttribute("tabindex", 0);

        handle.addEventListener("click", function () {
            this.focus();
        });

        handle.addEventListener("keydown", function (event) {
            var value = Number(rangeSlider.noUiSlider.get());

            switch (event.which) {
                case 37:
                    rangeSlider.noUiSlider.set(value - 1);
                    break;
                case 39:
                    rangeSlider.noUiSlider.set(value + 1);
                    break;
            }
        });
    }

    // Public methods
    return {
        init: function () {
            // Elements
            toolbar = document.querySelector('#kt_app_toolbar');

            if (!toolbar) {
                return;
            }

            initForm();
        }
    };
}();

// On document ready
KTUtil.onDOMContentLoaded(function () {
    KTLayoutToolbar.init();
});