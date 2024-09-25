"use strict";

// Class Definition
var KTAuthNewPassword = (function () {
    // Elements
    var form;
    var submitButton;
    var validator;
    var passwordMeter;

    var handleForm = function (e) {
        // Init form validation rules. For more info check the FormValidation plugin's official documentation:https://formvalidation.io/
        validator = FormValidation.formValidation(form, {
            fields: {
                password: {
                    validators: {
                        notEmpty: {
                            message: "The password is required",
                        },
                        callback: {
                            message: "Please enter a valid password",
                            callback: function (input) {
                                if (input.value.length > 0) {
                                    return validatePassword();
                                }
                            },
                        },
                    },
                },
                "confirm-password": {
                    validators: {
                        notEmpty: {
                            message: "The password confirmation is required",
                        },
                        identical: {
                            compare: function () {
                                return form.querySelector('[name="password"]').value;
                            },
                            message: "The password and its confirmation do not match",
                        },
                    },
                },
            },
            plugins: {
                trigger: new FormValidation.plugins.Trigger({
                    event: {
                        password: false,
                    },
                }),
                bootstrap: new FormValidation.plugins.Bootstrap5({
                    rowSelector: ".fv-row",
                    eleInvalidClass: "", // comment to enable invalid state icons
                    eleValidClass: "", // comment to enable valid state icons
                }),
            },
        });

        form.querySelector('input[name="password"]').addEventListener("input", function () {
            if (this.value.length > 0) {
                validator.updateFieldStatus("password", "NotValidated");
            }
        });
    };

    var handleSubmitAjax = function (e) {
        // Handle form submit
        submitButton.addEventListener("click", function (e) {
            // Prevent button default action
            e.preventDefault();

            validator.revalidateField("password");

            // Validate form
            validator.validate().then(function (status) {
                if (status == "Valid") {
                    // Show loading indication
                    submitButton.setAttribute("data-kt-indicator", "on");

                    // Disable button to avoid multiple clicks
                    submitButton.disabled = true;

                    axios
                        .post(
                            submitButton.closest("form").getAttribute("action"),
                            new FormData(form)
                        )
                        .then(function (response) {
                            // Handle success response
                            if (response.data.status === "success") {
                                Swal.fire({
                                    text: response.data.message,
                                    icon: "success",
                                    confirmButtonText: "Ok, got it!",
                                    customClass: {
                                        confirmButton: "btn btn-primary",
                                    },
                                }).then(function () {
                                    var redirectUrl = form.getAttribute("data-kt-redirect-url");
                                    if (redirectUrl) {
                                        location.href = redirectUrl;
                                    }
                                });
                            } else {
                                // Handle any non-standard success response
                                Swal.fire({
                                    text: response.data.message,
                                    icon: "error",
                                    confirmButtonText: "Ok, got it!",
                                    customClass: {
                                        confirmButton: "btn btn-primary",
                                    },
                                });
                            }
                        })
                        .catch(function (error) {
                            // Handle error response
                            var errorMessage = error.response?.data?.message || "An error occurred, please try again.";
                            Swal.fire({
                                text: errorMessage,
                                icon: "error",
                                confirmButtonText: "Ok, got it!",
                                customClass: {
                                    confirmButton: "btn btn-primary",
                                },
                            });
                        })
                        .finally(() => {
                            // Hide loading indication
                            submitButton.removeAttribute("data-kt-indicator");

                            // Enable button
                            submitButton.disabled = false;
                        });
                } else {
                    // Show error popup when validation fails
                    Swal.fire({
                        text: "Sorry, it seems there are some errors detected, please try again.",
                        icon: "error",
                        buttonsStyling: false,
                        confirmButtonText: "Ok, got it!",
                        customClass: {
                            confirmButton: "btn btn-primary",
                        },
                    });
                }
            });
        });
    };

    var validatePassword = function () {
        return passwordMeter.getScore() > 50;
    };

    // Public Functions
    return {
        init: function () {
            form = document.querySelector("#kt_new_password_form");
            submitButton = document.querySelector("#kt_new_password_submit");
            passwordMeter = KTPasswordMeter.getInstance(
                form.querySelector('[data-kt-password-meter="true"]')
            );

            handleForm();
            handleSubmitAjax();
        },
    };
})();

// On document ready
KTUtil.onDOMContentLoaded(function () {
    KTAuthNewPassword.init();
});
