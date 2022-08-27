@extends('layout.main')

@section('content')

<script src="http://maps.google.com/maps/api/js?key=AIzaSyAUgxBPrGkKz6xNwW6Z1rJh26AqR8ct37A"></script>
<script src="{{ asset('js/gmaps.js') }}"></script>

@include('errors.alerts')
@include('errors.errors')

<header class="container" style="padding: 2rem; background-color:white">
    <h2 class="text-center">
        <strong>Cliente: {{ $user->name }}</strong>
        <br>
        <hr>
        <strong>Mapas</strong>
    </h2>
</header>

<div class="container" style="padding: 2rem; background-color:white">

    <div class="card">
        <div class="col-md-12 text-center p-3">
            <h3>Pontos únicos</h3>
        </div>
        <div class="col-md-12 mt-1 mb-3" style="height: 400px;">
            <div id="map1" style="height: 400px;"></div>
        </div>
        <div class="col-md-12 text-center p-2">
            <h3>Figuras</h3>
        </div>
        <div class="col-md-12 mt-1 mb-3" style="height: 400px;">
            <div id="map2" style="height: 400px;"></div>
        </div>
    </div>

    @php
        $count1 = 0;
        $count2 = 0;
        $count3 = 0;
    @endphp

    @foreach ($pontos as $p)
        <input type="hidden" name="" id="latitudePonto{{ $count1 }}" value="{{ $p->latitude }}">
        <input type="hidden" name="" id="longitudePonto{{ $count1 }}" value="{{ $p->longitude }}">
        @php
            $count1++;
        @endphp
    @endforeach

    <br>

    @foreach ($figuras as $f)
        @if (isset($f->pontos))
        <div id="figura{{ $count2 }}">
            @foreach ($f->pontos as $ponto)
                <input type="hidden" name="" id="figura{{ $count2 }}latitude{{ $count3 }}" value="{{ $ponto->latitude }}">
                <input type="hidden" name="" id="figura{{ $count2 }}longitude{{ $count3 }}" value="{{ $ponto->longitude }}">
                @php
                    $count3++;
                @endphp
            @endforeach
        </div>
        @endif
        @php
            $count2++;
            $count3 = 0;
        @endphp
    @endforeach
</div>

<script>

    let count1 = {{ $countPontos }};
    let count2 = {{ $countFiguras }};

    map1 = new GMaps({
        div: '#map1',
        zoom: 5,
        lat: -20.46818922,
        lng: -54.61853027
    });

    map2 = new GMaps({
        div: '#map2',
        zoom: 5,
        lat: -20.46818922,
        lng: -54.61853027
    });

    $(document).ready(function(){
        for (let i = 0; i < count1; i++) {

            if ($('#latitudePonto' + i).val() != '' && $('#longitudePonto' + i).val() != '') {
                map1.setCenter($('#latitudePonto' + i).val(), $('#longitudePonto' + i).val());

                map1.setZoom(12);

                map1.addMarker({
                    lat: $('#latitudePonto' + i).val(),
                    lng: $('#longitudePonto' + i).val(),
                    infoWindow: {
                        content: 'Ponto ' + (i + 1)
                    }
                });
            }

        }

        var count3 = {{ $count3 }};

        var figura = $('#figura' + 0)[0];
        var inputs = figura.getElementsByTagName('input').length;
        var inputs = inputs/2;
        console.log(inputs);

        for (let h = 0; h < count3; h++) {

            const element = $('#latitude' + h).val();
            console.log(element);

        }

        for (let g = 0; g < count2; g++) {
            var figura = $('#figura' + g);

        }

        for (var i = 0; i < count2; i++) {
            var count3 = 0; console.log(count3);
            path = []; console.log(path);

            figura = $('#figura' + i)[0];
            inputs = figura.getElementsByTagName('input').length;
            inputs = inputs/2;

            for (let n = 0; n < inputs; n++) {
                lati = $('#figura' + i + 'latitude' + n).val();
                long = $('#figura' + i + 'longitude' + n).val();

                if (lati != '' && long != '') {

                    map2.setCenter(lati, long);

                    map2.setZoom(12);

                    path.push([lati, long]);

                    map2.addMarker({
                        lat: lati,
                        lng: long,
                        infoWindow: {
                            content: 'Ponto ' + (n + 1)
                        }
                    });

                }

            } console.log(path);

            map2.drawPolygon({
                paths: path,
                strokeColor: '#BBD8E9',
                strokeOpacity: 1,
                strokeWeight: 3,
                fillColor: '#BBD8E9',
                fillOpacity: 0.6
            });

        }
    });

</script>

@endsection
