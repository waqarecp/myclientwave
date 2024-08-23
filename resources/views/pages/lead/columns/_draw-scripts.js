// Initialize KTMenu
KTMenu.init();

// Add click event listener to delete buttons
document.querySelectorAll('[data-kt-action="delete_row"]').forEach(function (element) {
    element.addEventListener('click', function () {
        Swal.fire({
            text: 'Are you sure you want to remove?',
            icon: 'warning',
            buttonsStyling: false,
            showCancelButton: true,
            confirmButtonText: 'Yes',
            cancelButtonText: 'No',
            customClass: {
                confirmButton: 'btn btn-danger',
                cancelButton: 'btn btn-secondary',
            }
        }).then((result) => {
            if (result.isConfirmed) {
                Livewire.dispatch('delete_lead', [this.getAttribute('data-kt-lead-id')]);
            }
        });
    });
});

// Add click event listener to update buttons
document.querySelectorAll('[data-kt-action="update_row"]').forEach(function (element) {
    element.addEventListener('click', function () {
        Livewire.dispatch('get_data', [this.getAttribute('data-kt-lead-id')]);
    });
});


// Listen for 'success' event emitted by Livewire
Livewire.on('success', (message) => {
    // Reload the lead-table datatable
    LaravelDataTables['lead-table'].ajax.reload();
});

$(document).ready(function() {
    // Show/Hide appointment date and time based on checkbox
    $('#appointment_sat').change(function() {
        if ($(this).is(':checked')) {
            $('.appointment_fields').show();
        } else {
            $('.appointment_fields').hide();
        }
    });
});