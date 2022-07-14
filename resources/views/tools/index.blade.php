@extends('others.menue')

@section('title2')
    <title>道具/Jugglink</title>
@endsection

@section('header2')
    <h4>道具</h4>
@endsection

@section('main2')
    <div>
        <infinity-component :url="{{ json_encode('/infinity_tools/')}}" :id='{{ json_encode($tool)}}'></infinity-component>
    </div>
@endsection