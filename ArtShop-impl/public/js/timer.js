$(document).ready(function () {

    function count(){
        let now = new Date();
        var s = 0;
        var m = 0;
        var h = 0;
        var d = 0;
        var diff = end-now;
        with(Math){
            s = floor(diff/1000);
            m = floor(s/60);
            h = floor(m/60);
            d = floor(h/24);
        }
        h=h%24;
        m=m%60;

        h=(h<10)?"0"+h:h;
        m=(m<10)?"0"+m:m;
        d=(d<10)?"0"+d:d;

        $('#trajanje').text(d + 'd ' + h + 'č '+ m + 'm');

        setTimeout(count, 60000);
    }

    count();
});
