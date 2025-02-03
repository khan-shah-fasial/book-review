
function toggle() {
    var blur = document.getElementById("blur");
    blur.classList.toggle("active");
    var popup = document.getElementById("popup");
    popup.classList.toggle("active");
}

$(document).ready(function () {
    function openModal() {
        $("#loginmodal").modal("show");
    }

    // Check if the URL contains '#sign' and open the modal if it does
    if (window.location.hash === "#sign") {
        openModal();
    }
});
