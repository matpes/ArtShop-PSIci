
var slideIndex = 0;
function plusSlides(n) {
    showSlides(slideIndex += n);
}

function plusSlidesFollowers(n, j) {
    showSlidesFollowers(slideIndex += n, j);
}

async function showSlidesFollowers(n, j) {
    var i;
    var slides = document.getElementsByClassName("mySlides"+j);
    if(slides.length == 0)
        return;
    if (n >= slides.length) {
        slideIndex = 0;
    } else if (n < 0) {
        slideIndex = slides.length - 1;
    }
    for (i = 0; i < slides.length; i++) {
        if (i !== slideIndex)
            slides[i].style.display = "none";
    }
    slides[slideIndex].style.display = "block";
    await new Promise(r => setTimeout(r, 6000));
    showSlideFollowers(j);
    // callSlideChange();
    // setTimeout(showSlides(), 10000); // Change image every 10 seconds
}

function showSlideFollowers(j) {
    var i;
    var slides = document.getElementsByClassName("mySlides"+j);
    slideIndex++;
    if (slideIndex >= slides.length) {
        slideIndex = 0;
    } else if (slideIndex < 0) {
        slideIndex = slides.length - 1;
    }
    for (i = 0; i < slides.length; i++) {
        if (i !== slideIndex)
            slides[i].style.display = "none";
    }
    slides[slideIndex].style.display = "block";
    callSlideChange();
    // setTimeout(showSlides(), 10000); // Change image every 10 seconds
}

async function showSlides(n) {
    var i;
    var slides = document.getElementsByClassName("mySlides");
    if(slides.length == 0)
        return;
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
    showSlide();
    // callSlideChange();
    // setTimeout(showSlides(), 10000); // Change image every 10 seconds
}

function showSlide() {
    var i;
    var slides = document.getElementsByClassName("mySlides");
    slideIndex++;
    if (slideIndex >= slides.length) {
        slideIndex = 0;
    } else if (slideIndex < 0) {
        slideIndex = slides.length - 1;
    }
    for (i = 0; i < slides.length; i++) {
        if (i != slideIndex)
            slides[i].style.display = "none";
    }
    slides[slideIndex].style.display = "block";
    callSlideChange();
    // setTimeout(showSlides(), 10000); // Change image every 10 seconds
}

function callSlideChange(){
    setTimeout(showSlides(++slideIndex), 100000); // Change image every 10 seconds
}//*/
window.onload = function() {
    if(document.getElementsByClassName("mySlides").length > 0) {
        showSlides(0);
    }
}
