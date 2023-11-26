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

function scrollTo21Century() {
    var div = document.getElementById("21century");
    div.scrollIntoView({ behavior: 'smooth' });
}

function scrollToBlackmores() {
    var div = document.getElementById("blackmores");
    div.scrollIntoView({ behavior: 'smooth' });
}

function scrollToBrands() {
    var div = document.getElementById("brands");
    div.scrollIntoView({ behavior: 'smooth' });
}

function scrollToEurobio() {
    var div = document.getElementById("eurobio");
    div.scrollIntoView({ behavior: 'smooth' });
}

function scrollToSwisse() {
    var div = document.getElementById("swisse");
    div.scrollIntoView({ behavior: 'smooth' });
}

function scrollToVitahealth() {
    var div = document.getElementById("vitahealth");
    div.scrollIntoView({ behavior: 'smooth' });
}

function scrollToVitamode() {
    var div = document.getElementById("johor");
    div.scrollIntoView({ behavior: 'smooth' });
}

document.addEventListener("DOMContentLoaded", function() {
    // Get all header elements
    let collapseHeaders = document.querySelectorAll('.coll-header');
    
    // Iterate over each header
    collapseHeaders.forEach(function(collapseHeader) {
        // Get the corresponding content element for each header
        let collapseContent = collapseHeader.nextElementSibling;

        // Function to toggle the collapse content
        function toggleCollapse() {
            // Check the current state of the collapse
            if (collapseContent.style.visibility === "hidden" || collapseContent.style.visibility === "") {
                // Collapse is currently hidden or not explicitly set, then show it
                collapseContent.style.visibility = "visible";
                collapseContent.style.opacity = "1";
                collapseContent.style.maxHeight = collapseContent.scrollHeight + "px";
            } else {
                // Collapse is currently visible, then hide it
                collapseContent.style.visibility = "hidden";
                collapseContent.style.opacity = "0";
                collapseContent.style.maxHeight = "0px";
            }
        }

        // Event listener for the click event on the collapse header
        collapseHeader.addEventListener("click", toggleCollapse);
    });
});

document.addEventListener("DOMContentLoaded", function() {
    // Get all header elements
    let collapseHeaders = document.querySelectorAll('.coll-header');
    
    // Iterate over each header
    collapseHeaders.forEach(function(collapseHeader) {
        // Get the corresponding content element for each header
        let collapseContent = collapseHeader.nextElementSibling;

        // Function to toggle the collapse content
        function toggleCollapse() {
            // Toggle the visibility of .coll-content
            collapseContent.classList.toggle('hidden');

            // Change the button text based on the container's open/closed state
            let button = collapseHeader.querySelector('.containerButton');
            button.innerText = collapseContent.classList.contains('hidden') ? '+' : '-';
        }

        // Initial setup based on the initial visibility state
        toggleCollapse();

        // Event listener for the click event on the collapse header
        collapseHeader.addEventListener("click", toggleCollapse);
    });
});

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
