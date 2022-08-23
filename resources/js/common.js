window._ = require('lodash');

// Select2 Multiple
$('.select2-multiple').select2({
    placeholder: "-- Select Permission(s) --",
    allowClear: true,
    width: '100%',
});

// SweetAlert Toast custom
window.Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 9000,
    timerProgressBar: false,
    didOpen: (toast) => {
        toast.addEventListener('mouseenter', Swal.stopTimer)
        toast.addEventListener('mouseleave', Swal.resumeTimer)
    }
})



