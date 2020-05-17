<header>
<div class="myHeader">
    <div class="row-fluid">
        <form class="col-sm-12">
            <form action="#">
                <div class="form-group noMargin">
                    <input type="text" name="" id="" class="form-control header_input_text"
                           placeholder="Slikar">
                    <input type="text" name="" id="" class="form-control header_input_text"
                           placeholder="Tematika">
                    <select name="" id="" class="form-control header_input_text">
                        <option value="stil">Stil</option>
                        <option value="klasicizam">Klasicizam</option>
                        <option value="kubizam">Kubizam</option>
                        <option value="barok">Barok</option>
                    </select>
                    <button type="submit" class="btn-dark gray_button"> Pretraži</button>
                </div>
            </form>
            @if(Auth::check())
                @if(!Auth::user()->isAdmin)
{{--DODATI KORPU--}}
                @endif
                <form method="GET" action="{{'userInfo'}}">
                    <img  class = "img-fluid img-rounded "  alt="profilna_slika" style="" type="submit"
                          width="60px" height="60px"
                          src=<?php if(is_null($user->picture_path)){ echo'images/avatar.png';}
                    else {$path = 'images/users/'.$user->picture_path; echo $path; } ?>>
                </form>

            @else
                <form method="GET" action="{{ route('login') }}">
                    <button type="submit" class="btn btn-warning">
                        {{ __('Uloguj se') }}
                    </button>
                </form>
                <form method="GET" action="{{ route('register') }}">
                    <button type="submit" class="btn btn-warning">
                        {{ __('Registruj se') }}
                    </button>
                </form>
            @endif
        </div>
        <hr>
    </div>
</header>
