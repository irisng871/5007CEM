function openNav() {
    var nav = document.getElementById("nav");
    var contentOverlay = document.querySelector(".contentOverlay");
    var medicineImg = document.querySelector(".medicineimg");

    // Clone the contentOverlay element, clone means separate copy of original
    var contentOverlayClone = contentOverlay.cloneNode(true);
    var medicineImgClone = medicineImg.cloneNode(true);

    // Replace the original contentOverlay with the cloned element
    contentOverlay.parentNode.replaceChild(contentOverlayClone, contentOverlay);
    medicineImg.parentNode.replaceChild(medicineImgClone, medicineImg);

    nav.style.height = "100%";
}

function closeNav() {
    document.getElementById("nav").style.height = "0%";
}

function scrollToPerlis() {
    var div = document.getElementById("perlis");
    div.scrollIntoView({behavior: 'smooth'});
}

function scrollToKedah() {
    var div = document.getElementById("kedah");
    div.scrollIntoView({behavior: 'smooth'});
}

function scrollToPenang() {
    var div = document.getElementById("penang");
    div.scrollIntoView({behavior: 'smooth'});
}

function scrollToPerak() {
    var div = document.getElementById("perak");
    div.scrollIntoView({behavior: 'smooth'});
}

function scrollToSelangor() {
    var div = document.getElementById("selangor");
    div.scrollIntoView({behavior: 'smooth'});
}

function scrollToNegeriSembilan() {
    var div = document.getElementById("negerisembilan");
    div.scrollIntoView({behavior: 'smooth'});
}

function scrollToMelaka() {
    var div = document.getElementById("melaka");
    div.scrollIntoView({behavior: 'smooth'});
}

function scrollToKelantan() {
    var div = document.getElementById("kelantan");
    div.scrollIntoView({behavior: 'smooth'});
}

function scrollToTerengganu() {
    var div = document.getElementById("terengganu");
    div.scrollIntoView({behavior: 'smooth'});
}

function scrollToPahang() {
    var div = document.getElementById("pahang");
    div.scrollIntoView({behavior: 'smooth'});
}

function scrollToJohor() {
    var div = document.getElementById("johor");
    div.scrollIntoView({behavior: 'smooth'});
}

function scrollToSabah() {
    var div = document.getElementById("sabah");
    div.scrollIntoView({behavior: 'smooth'});
}

function scrollToSarawak() {
    var div = document.getElementById("sarawak");
    div.scrollIntoView({behavior: 'smooth'});
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
