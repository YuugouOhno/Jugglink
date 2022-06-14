@extends('others.menue')

@section('title')
    <link rel="stylesheet" href="css/map.css">
    <title>map</title>
@endsection

@section('main')
    <div id='map'></div>
@endsection

@section('script')
<script type="application/javascript">const kasa = @json($map);</script>
<script type="application/javascript" src="{{ asset('js/map.js') }}"></script>
<script type="application/javascript" src="https://maps.googleapis.com/maps/api/js?language=ja&region=JP&key=AIzaSyBEjpCZvOUqe0z5J_ChT42H8cEWQ3moOk4&callback=initMap" async defer>
</script>
@endsection