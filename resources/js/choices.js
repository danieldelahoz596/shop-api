window.addEventListener('DOMContentLoaded', function() {
    var element = document.querySelector('#tags');
    var choices = new Choices(element, { allowHTML: true });
    for (let i = 1; i <= 6; i++) {
        document.getElementById(`image-upload-${i}`).addEventListener('change', function() {
            displayImages(`image-upload-${i}`, `image-preview-${i}`);
        });
    }
});
