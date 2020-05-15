@extends('layouts.app')

@section('header')
<div class="myHeader">
    <div class="row-fluid">
        <div class="col-sm-12">
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
        </div>
        <hr>
    </div>
    @endsection
