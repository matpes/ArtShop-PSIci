var ratedIndex = [];


$(document).ready(function () {
    resetAllStarColors();

    for(let i=0; i < 100; i++){
        ratedIndex[i]=-1;
    }



    $('.fa-star').on('click', function () {
        currRatedIndex = parseInt($(this).data('index'));
        id = Math.floor(parseInt(currRatedIndex)/10)
        ratedIndex[Math.floor(parseInt(currRatedIndex)/10)]=parseInt(currRatedIndex%10);
        $(`#pic${id}`).val(parseInt(currRatedIndex%10)+1);
        //saveToTheDB();
    });

    $('.fa-star').mouseover(function () {
        var currentIndex = parseInt($(this).data('index'));
        resetStarColors(currentIndex);
        setStars(currentIndex);
    });

    $('.fa-star').mouseleave(function () {
        var currentIndex = ratedIndex[Math.floor(parseInt($(this).data('index'))/10)];
        let calc = Math.floor(parseInt($(this).data('index'))/10) +''+currentIndex;
        resetStarColors(parseInt($(this).data('index')));
        if (currentIndex != -1)
            setStars(calc);
    });
});

function setStars(max) {
    for (var i=0; i <= max%10; i++)
        $('.fa-star:eq('+Math.floor(parseInt(max)/10)+''+i+')').css('color', 'goldenrod');
}

function resetStarColors(line) {
    for( let i = 0; i< 10; i++) {
        $('.fa-star:eq('+Math.floor(parseInt(line)/10)+''+i+')').css('color', 'white');
    }
}

function resetAllStarColors() {
        $('.fa-star').css('color', 'white');
}


