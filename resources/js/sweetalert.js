const Swal = require('sweetalert2');

window.addEventListener('error_login_swal',function(e){
    Swal.fire(e.detail);
});

window.addEventListener('success_login_swal',function(e){
    Swal.fire({
        title: e.detail.title,
        timer: e.detail.timer,
        icon: e.detail.icon,
        toast: e.detail.toast,
        position: e.detail.postion,
        text: e.detail.text
    }).then(function() {
        window.location = "/";
    });
})