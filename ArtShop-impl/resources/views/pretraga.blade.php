@extends('.layouts.app')

@section('content')

    <div class="row red">
        @if(empty($pictures))
            <div class="col-md-12 text-center">
                Nije pronadjena nijedna slika.
            </div>
        @else
            @php($pos = 0)
            @php($flag = 0)
            @foreach($pictures as $key => $picture)
                @if($picture->smer == "vertikalno")
                    @if($flag == 0)
                        @if($pos == 2 && count($pictures) > $key + 1 && $pictures[$key + 1]->smer == 'horizontalno')
                            <div class="col-md-6 col-sm-12 pretraga">
                                <a href="/picture/{{$pictures[$key + 1]->user_id}}"><img src="{{$pictures[$key + 1]->path}}"></a>
                            </div>
                            @php($flag = 1)
                        @endif
                        <div class="col-md-3 col-sm-6 pretraga">
                            <a href="/picture/{{$picture->user_id}}"><img src="{{$picture->path}}"></a>
                        </div>
                    @else
                        @php($flag = 0)
                    @endif
                    @php($pos += 1)
                    @php($pos %= 4)
                @else
                    @if($flag == 0)
                        @if($pos == 3 && count($pictures) > $key + 1 && $pictures[$key + 1]->smer == 'vertikalno')
                            <div class="col-md-3 col-sm-6 pretraga">
                                <a href="/picture/{{$pictures[$key + 1]->user_id}}"><img src="{{$pictures[$key + 1]->path}}"></a>
                            </div>
                            @php($flag = 1)
                        @endif
                        <div class="col-md-6 col-sm-12 pretraga">
                            <a href="/picture/{{$picture->user_id}}"><img src="{{$picture->path}}"></a>
                        </div>
                    @else
                        @php($flag = 0)
                    @endif
                    @php($pos += 2)
                    @php($pos %= 4)
                @endif
            @endforeach
        @endif
    </div>
@endsection



@section('footer')

    <footer>
        <img src="/images/logo.png" alt="ArtShopLogo" class="float-right img-fluid">
    </footer>

@endsection
