function openNav() {
    var nav = document.getElementById("nav");
    var contentOverlay = document.querySelector(".contentOverlay");
    var medicineImg = document.querySelector(".medicineimg");

    var contentOverlayClone = contentOverlay.cloneNode(true);
    var medicineImgClone = medicineImg.cloneNode(true);

    contentOverlay.parentNode.replaceChild(contentOverlayClone, contentOverlay);
    medicineImg.parentNode.replaceChild(medicineImgClone, medicineImg);

    nav.style.height = "100%";
}

function closeNav() {
    document.getElementById("nav").style.height = "0%";
}

function performSearch() {
    var searchInput = document.getElementById("searchInput").value;

    // Check if the search input is empty
    if (searchInput.trim() === "") {
        alert("Please enter any keyword to perform search");
    } else {
        redirectToSearch(searchInput);
    }
}

function handleSearchKeyPress(event) {
    if (event.key === 'Enter') {
        var searchInput = document.getElementById("searchInput").value;

        // Check if the search input is empty
        if (searchInput.trim() === "") {
            alert("Please enter any keyword to perform search.");
        } else {
            redirectToSearch(searchInput);
        }
    }
}

function redirectToSearch(searchInput) {
    window.location.href = "http://localhost/5007CEM/public_html/Search%20Result.php?s=" + encodeURIComponent(searchInput);
}

document.addEventListener("DOMContentLoaded", function () {
    var swiper = new Swiper(".blog-slider", {
        spaceBetween: 30,
        effect: "fade",
        loop: true,
        mousewheel: {
            invert: false
        },
        pagination: {
            el: ".blog-slider__pagination",
            clickable: true
        }
    });
});