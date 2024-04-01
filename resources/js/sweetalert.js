import Swal from 'sweetalert2';

window.addEventListener('error_login_swal',function(e){
    Swal.fire(e.detail[0]);
});

window.addEventListener('success_login_swal',function(e){
    Swal.fire({
        title: e.detail[0].title,
        timer: e.detail[0].timer,
        icon: e.detail[0].icon,
        toast: e.detail[0].toast,
        position: e.detail[0].position,
        text: e.detail[0].text
    }).then(function() {
        window.location = "/";
    });
})

window.addEventListener('logout_swal',function(e){
    Swal.fire({
        title: e.detail[0].title,
        timer: e.detail[0].timer,
        icon: e.detail[0].icon,
        toast: e.detail[0].toast,
        position: e.detail[0].position,
        text: e.detail[0].text
    }).then(function() {
        window.location = "/login"
    });
});

window.addEventListener('success_add_product',function(e){
    Swal.fire({
        title: e.detail[0].title,
        timer: e.detail[0].timer,
        icon: e.detail[0].icon,
        toast: e.detail[0].toast,
        position: e.detail[0].position,
        text: e.detail[0].text
    }).then(function() {
        window.location = "/user/account/profile/"
    });
});
