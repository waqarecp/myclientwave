"use strict";
var KTAppCalendar = (function () {
    var e,
        t,
        n,
        a,
        o,
        r,
        l,
        d,
        i,
        c,
        s,
        u,
        m,
        v,
        y,
        _,
        f,
        p,
        b = JSON.parse($("#calendar_data").val()),
        k = {
            id: "",
            leadId: "",
            eventName: "",
            eventDescription: "",
            eventLocation: "",
            startDate: "",
            endDate: "",
            allDay: !1,
        };
    const g = () => {
            var e, t, n;
            f.show(),
                k.allDay
                    ? ((e = "All Day"),
                      (t = moment(k.startDate).format("Do MMM, YYYY")),
                      (n = moment(k.endDate).format("Do MMM, YYYY")))
                    : ((e = ""),
                      (t = moment(k.startDate).format("Do MMM, YYYY - h:mm a")),
                      (n = moment(k.endDate).format("Do MMM, YYYY - h:mm a"))),
                (s.innerText = k.eventName),
                (u.innerText = e),
                (m.innerText = k.eventDescription ? k.eventDescription : "--"),
                (v.innerText = k.eventLocation ? k.eventLocation : "--"),
                (y.innerText = t),
                (_.innerText = n),
                (document.getElementById("viewDetailsBtn").onclick =
                    function () {
                        k.leadId &&
                            window.open("../leads/" + k.leadId, "_blank");
                    }),
                (document.getElementById("eventName").onclick = function () {
                    k.leadId && window.open("../leads/" + k.leadId, "_blank");
                });
        },
        S = (e) => {
            (k.id = e.id),
                (k.leadId = e.leadId),
                (k.eventName = e.title),
                (k.eventDescription = e.description),
                (k.eventLocation = e.location),
                (k.startDate = e.startStr),
                (k.endDate = e.endStr),
                (k.allDay = e.allDay);
        };
    return {
        init: function () {
            const Y = document.getElementById("kt_modal_add_event");
            (l = Y.querySelector("#kt_modal_add_event_form")),
                l.querySelector('[name="calendar_event_name"]'),
                l.querySelector('[name="calendar_event_description"]'),
                l.querySelector('[name="calendar_event_location"]'),
                (t = l.querySelector("#kt_calendar_datepicker_start_date")),
                (n = l.querySelector("#kt_calendar_datepicker_end_date")),
                (a = l.querySelector("#kt_calendar_datepicker_start_time")),
                (o = l.querySelector("#kt_calendar_datepicker_end_time")),
                document.querySelector('[data-kt-calendar="add"]'),
                l.querySelector("#kt_modal_add_event_submit"),
                (i = l.querySelector("#kt_modal_add_event_cancel")),
                (c = Y.querySelector("#kt_modal_add_event_close")),
                l.querySelector('[data-kt-calendar="title"]'),
                (r = new bootstrap.Modal(Y));
            const x = document.getElementById("kt_modal_view_event");
            var D, w, B;
            (f = new bootstrap.Modal(x)),
                (s = x.querySelector('[data-kt-calendar="event_name"]')),
                (u = x.querySelector('[data-kt-calendar="all_day"]')),
                (m = x.querySelector('[data-kt-calendar="event_description"]')),
                (v = x.querySelector('[data-kt-calendar="event_location"]')),
                (y = x.querySelector('[data-kt-calendar="event_start_date"]')),
                (_ = x.querySelector('[data-kt-calendar="event_end_date"]')),
                x.querySelector("#kt_modal_view_event_edit"),
                (p = x.querySelector("#kt_modal_view_event_delete")),
                (D = document.getElementById("kt_calendar_app")),
                (w = moment().startOf("day")).format("YYYY-MM"),
                w.clone().subtract(1, "day").format("YYYY-MM-DD"),
                (B = w.format("YYYY-MM-DD")),
                w.clone().add(1, "day").format("YYYY-MM-DD"),
                (e = new FullCalendar.Calendar(D, {
                    eventMouseEnter: function (e) {
                        var t = e.event.extendedProps,
                            n = document.createElement("div");
                        n.classList.add("fc-tooltip"),
                            (n.innerHTML = `\n                <strong>Lead:</strong> ${
                                e.event.title
                            }<br>\n                <strong>Created By:</strong> ${
                                t.created_by
                            }\n                ${
                                1 == t.has_new_comments
                                    ? "<br><span class='badge badge-sm badge-danger'>New Updates Available</span>"
                                    : ""
                            }\n            `),
                            (n.style.position = "absolute"),
                            (n.style.zIndex = "10001"),
                            (n.style.background = "#fff"),
                            (n.style.border = "1px solid #ccc"),
                            (n.style.padding = "10px"),
                            (n.style.boxShadow =
                                "0 2px 10px rgba(0, 0, 0, 0.2)"),
                            document.body.appendChild(n),
                            e.el.addEventListener("mousemove", function (e) {
                                (n.style.left = e.pageX + 10 + "px"),
                                    (n.style.top = e.pageY + 10 + "px");
                            });
                    },
                    eventMouseLeave: function (e) {
                        document
                            .querySelectorAll(".fc-tooltip")
                            .forEach(function (e) {
                                e.remove();
                            });
                    },
                    headerToolbar: {
                        left: "prev,next today",
                        center: "title",
                        right: "dayGridMonth,timeGridWeek,timeGridDay",
                    },
                    initialDate: B,
                    navLinks: !0,
                    selectable: !0,
                    selectMirror: !0,
                    select: function (e) {
                        S(e);
                    },
                    eventClick: function (e) {
                        S({
                            id: e.event.id,
                            leadId: e.event.extendedProps.leadId,
                            title: e.event.title,
                            description: e.event.extendedProps.description,
                            location: e.event.extendedProps.location,
                            startStr: e.event.startStr,
                            endStr: e.event.endStr,
                            allDay: e.event.allDay,
                        }),
                            g();
                    },
                    editable: !0,
                    dayMaxEvents: !0,
                    events: b,
                    datesSet: function () {},
                    eventDidMount: function (e) {
                        var t = e.event.extendedProps;
                        if (t.colorCode)
                            (e.el.style.backgroundColor = t.colorCode),
                                (e.el.style.borderColor = t.colorCode);
                        else {
                            (e.el.style.backgroundColor = "#fff"),
                                (e.el.style.border = "1px solid #ccc");
                            const t = e.el.querySelector(".fc-event-main");
                            t && (t.style.color = "#000");
                        }
                    },
                })).render(),
                (d = FormValidation.formValidation(l, {
                    fields: {
                        calendar_event_name: {
                            validators: {
                                notEmpty: { message: "Event name is required" },
                            },
                        },
                        calendar_event_start_date: {
                            validators: {
                                notEmpty: { message: "Start date is required" },
                            },
                        },
                        calendar_event_end_date: {
                            validators: {
                                notEmpty: { message: "End date is required" },
                            },
                        },
                    },
                    plugins: {
                        trigger: new FormValidation.plugins.Trigger(),
                        bootstrap: new FormValidation.plugins.Bootstrap5({
                            rowSelector: ".fv-row",
                            eleInvalidClass: "",
                            eleValidClass: "",
                        }),
                    },
                })),
                flatpickr(t, { enableTime: !1, dateFormat: "Y-m-d" }),
                flatpickr(n, { enableTime: !1, dateFormat: "Y-m-d" }),
                flatpickr(a, {
                    enableTime: !0,
                    noCalendar: !0,
                    dateFormat: "H:i",
                }),
                flatpickr(o, {
                    enableTime: !0,
                    noCalendar: !0,
                    dateFormat: "H:i",
                }),
                i.addEventListener("click", function (e) {
                    e.preventDefault(),
                        Swal.fire({
                            text: "Are you sure you would like to cancel?",
                            icon: "warning",
                            showCancelButton: !0,
                            buttonsStyling: !1,
                            confirmButtonText: "Yes, cancel it!",
                            cancelButtonText: "No, return",
                            customClass: {
                                confirmButton: "btn btn-primary",
                                cancelButton: "btn btn-active-light",
                            },
                        }).then(function (e) {
                            e.value
                                ? (l.reset(), r.hide())
                                : "cancel" === e.dismiss &&
                                  Swal.fire({
                                      text: "Your form has not been cancelled!.",
                                      icon: "error",
                                      buttonsStyling: !1,
                                      confirmButtonText: "Ok, got it!",
                                      customClass: {
                                          confirmButton: "btn btn-primary",
                                      },
                                  });
                        });
                }),
                c.addEventListener("click", function (e) {
                    e.preventDefault(),
                        Swal.fire({
                            text: "Are you sure you would like to cancel?",
                            icon: "warning",
                            showCancelButton: !0,
                            buttonsStyling: !1,
                            confirmButtonText: "Yes, cancel it!",
                            cancelButtonText: "No, return",
                            customClass: {
                                confirmButton: "btn btn-primary",
                                cancelButton: "btn btn-active-light",
                            },
                        }).then(function (e) {
                            e.value
                                ? (l.reset(), r.hide())
                                : "cancel" === e.dismiss &&
                                  Swal.fire({
                                      text: "Your form has not been cancelled!.",
                                      icon: "error",
                                      buttonsStyling: !1,
                                      confirmButtonText: "Ok, got it!",
                                      customClass: {
                                          confirmButton: "btn btn-primary",
                                      },
                                  });
                        });
                }),
                ((e) => {
                    e.addEventListener("hidden.bs.modal", (e) => {
                        d && d.resetForm(!0);
                    });
                })(Y);
        },
    };
})();
KTUtil.onDOMContentLoaded(function () {
    KTAppCalendar.init();
});
