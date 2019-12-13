@extends('layouts.app')

@section('content')

    <div class="row">

        @foreach( $arrayPeliculas as $pelicula )
            <div class="col-xs-6 col-sm-4 col-md-3 text-center">

                <a href="{{ action('MovieController@show' , array('movie' => $pelicula)) }}">
                    <img src="{{$pelicula->poster}}" style="height:200px"/>
                    <h4 style="min-height:45px;margin:5px 0 10px 0">
                        {{$pelicula->title}}
                    </h4>
                </a>

            </div>
        @endforeach

    </div>

@stop