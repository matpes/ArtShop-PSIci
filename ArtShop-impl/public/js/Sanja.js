
var slideIndex = 0;
function plusSlides(n) {
    showSlides(slideIndex += n);
}
async function showSlides(n) {
    var i;
    var slides = document.getElementsByClassName("mySlides");
    if (n >= slides.length) {
        slideIndex = 0;
    } else if (n < 0) {
        slideIndex = slides.length - 1;
    }
    for (i = 0; i < slides.length; i++) {
        if (i != slideIndex)
            slides[i].style.display = "none";
    }
    slides[slideIndex].style.display = "block";
    await new Promise(r => setTimeout(r, 6000));
    showSlides(++slideIndex);
    // callSlideChange();
    // setTimeout(showSlides(), 10000); // Change image every 10 seconds
}
/*
function callSlideChange(){
    setTimeout(showSlides(++slideIndex), 100000); // Change image every 10 seconds
}*/
window.onload = function() {
    showSlides(0);
}
