@extends('others.menue')

@section('title')
    <link rel="stylesheet" href="css/map.css">
    <link rel="stylesheet" href="css/index.css">
    <title>map</title>
@endsection

@section('main')
<div class='map_container'>
    <map-component></map-component>
    <form id="map_delete_form" action='{{ route("map.delete")}}' method='POST'>
        @csrf
        @method('DELETE')
        <input type='button' value='自身が追加した分布情報を削除' onclick="buttonClick()">
    </form>
</div>
@endsection

@section('script')
<script type="application/javascript">const place = @json($place);</script>
<script type="application/javascript" src="https://maps.googleapis.com/maps/api/js?language=ja&region=JP&key={{ config('services.google.maps_key') }}&callback=initMap" async defer>
</script>
<script>
    function buttonClick(){
        if(confirm("削除しますか？")){
            document.getElementById("map_delete_form").submit();
        }
    }
</script>
@endsection