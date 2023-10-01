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
    div.scrollIntoView({ behavior: 'smooth' });
}

function scrollToKedah() {
    var div = document.getElementById("kedah");
    div.scrollIntoView({ behavior: 'smooth' });
}

function scrollToPenang() {
    var div = document.getElementById("penang");
    div.scrollIntoView({ behavior: 'smooth' });
}

function scrollToPerak() {
    var div = document.getElementById("perak");
    div.scrollIntoView({ behavior: 'smooth' });
}

function scrollToSelangor() {
    var div = document.getElementById("selangor");
    div.scrollIntoView({ behavior: 'smooth' });
}

function scrollToNegeriSembilan() {
    var div = document.getElementById("negerisembilan");
    div.scrollIntoView({ behavior: 'smooth' });
}

function scrollToMelaka() {
    var div = document.getElementById("melaka");
    div.scrollIntoView({ behavior: 'smooth' });
}

function scrollToKelantan() {
    var div = document.getElementById("kelantan");
    div.scrollIntoView({ behavior: 'smooth' });
}

function scrollToTerengganu() {
    var div = document.getElementById("terengganu");
    div.scrollIntoView({ behavior: 'smooth' });
}

function scrollToPahang() {
    var div = document.getElementById("pahang");
    div.scrollIntoView({ behavior: 'smooth' });
}

function scrollToJohor() {
    var div = document.getElementById("johor");
    div.scrollIntoView({ behavior: 'smooth' });
}

function scrollToSabah() {
    var div = document.getElementById("sabah");
    div.scrollIntoView({ behavior: 'smooth' });
}

function scrollToSarawak() {
    var div = document.getElementById("sarawak");
    div.scrollIntoView({ behavior: 'smooth' });
}

function getURLofState() {
    console.log("run geturl");
    try {
        const urlParams = new URLSearchParams(window.location.search);
        const state = urlParams.get('state');

        switch (state) {
            case null:
                console.log('no type found so do ntg');
                break;
            case 'Perlis':
                scrollToPerlis();
                break;
            case 'Kedah':
                scrollToKedah();
                break;
            case 'Penang':
                scrollToPenang();
                break;
            case 'Perak':
                scrollToPerak();
                break;
            case 'Selangor':
                scrollToSelangor();
                break;
            case 'NegeriSembilan':
                scrollToNegeriSembilan();
                break;
            case 'Melaka':
                scrollToMelaka();
                break;
            case 'Kelantan':
                scrollToKelantan();
                break;
            case 'Terengganu':
                scrollToTerengganu();
                break;
            case 'Pahang':
                scrollToPahang();
                break;
            case 'Johor':
                scrollToJohor();
                break;
            case 'Sabah':
                scrollToSabah();
                break;
            case 'Sarawak':
                scrollToSarawak();
                break;
            default:
                console.log('default case');
                break;
        }
    }
    catch (error) {
        console.log('geturl',error);
    }

}
