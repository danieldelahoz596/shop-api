window.displayImages = (inputId, imgId) => {
    var reader = new FileReader();
    reader.onload = function (e) {
        document.getElementById(imgId).src = e.target.result;
    };
    reader.readAsDataURL(document.getElementById(inputId).files[0]);
}
