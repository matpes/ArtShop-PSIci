

var prikazi = id => {

    $(`#${id}`).show();
    //$(`#${id}`).style.display = 'flex';

}

var sakrij = id => {
    $(`#${id}`).hide();
    //$(`#${id}`).style.display = 'none';
}



var proveri = () => {
    let can = true;
    let ime = $('#ime').val();
    let prezime = $('#prezime').val();
    let grad = $('#grad').val();
    let ulica = $('#adresa').val();
    let brUlice = $('#brUlice').val();
    let zip = $('#zip').val();
    let brTelefona = $('#brTelefona').val();



    //IME
    if (ime !== '') {
        let regex = /[0-9]/;
        if (regex.test(ime)) {
            can = false;
            $('#imeNapomena').show();
            $('#imeNapomena').text('Ime ne moze imati brojeve');
        }else{
            $('#imeNapomena').hide();
        }
    } else {
        can = false;
        $('#imeNapomena').show();
        $('#imeNapomena').text('Morate uneti ime');
    }


    //PREZIME
    if (prezime !== '') {
        let regex = /[0-9]/;
        if (regex.test(prezime)) {
            can = false;
            $('#prezimeNapomena').show();
            $('#prezimeNapomena').text('Prezime ne moze imati brojeve');
        }else{
            $('#prezimeNapomena').hide();
        }
    } else {
        can = false;
        $('#prezimeNapomena').show();
        $('#prezimeNapomena').text('Morate uneti prezime');
    }

    //GRAD
    if (grad === '') {
        can = false;
        $('#gradNapomena').show();
        $('#gradNapomena').text('Morate uneti grad');
    }else{
        $('#gradNapomena').hide();
    }

    //ULICA
    if (ulica === '') {
        can = false;
        $('#adresaNapomena').show().text('Morate uneti ulicu');
    }else{
        $('#adresaNapomena').hide();
    }

    //BROJ ULICE
    if (brUlice === '') {
        can = false;
        $('#brUliceNapomena').show();
        $('#brUliceNapomena').text('Morate uneti broj ulice');
    }else{
        $('#brUliceNapomena').hide();
    }

    //ZIP
    if(zip !== ''){
        let mobileRegExp = /^(\d{5})$/;
        if (mobileRegExp.test(zip)) {
            $('#zipNapomena').hide();
        }else{
            can = false;
            $('#zipNapomena').show();
            $('#zipNapomena').text('Postanski boj se sastoji od 5 brojeva');

        }
    }else{
        can = false;
        $('#zipNapomena').show();
        $('#zipNapomena').text('Morate uneti postanski broj');
    }


    //TELEFON
    if(brTelefona !== ''){
        let mobileRegExp = /^(\d{10}|\d{3}-\d{3}-\d{4}|\d{3}\/\d{3}-\d{4}|\d{3}-\d{3}-\d{2}-\d{2}|\d{3}\/\d{3}-\d{2}-\d{2}|\(\d{3}\)\d{3}-\d{4})$/;
        if (mobileRegExp.test(brTelefona)) {
            $('#telefonNapomena').hide();
        }else{
            can = false;
            $('#telefonNapomena').show();
            $('#telefonNapomena').text('Broj telefona nije u dobrom formatu');

        }
    }else{
        can = false;
        $('#telefonNapomena').show();
        $('#telefonNapomena').text('Morate uneti broj telefona');
    }

    if(can){
        prikazi('potvrdi');
    }

}
