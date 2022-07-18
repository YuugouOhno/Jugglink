@extends('others.menue')

@section('title2')
    <link rel="stylesheet" href="css/map.css">
    <title>ジャグラー分布/Jugglink</title>
@endsection

@section('header2')
    <h4>ジャグラー分布</h4>
@endsection

@section('main2')
<div class='map_container'>
    <map-component></map-component>
    <form id="map_delete_form" action='{{ route("map.delete")}}' method='POST'>
        @csrf
        @method('DELETE')
        <input type='button' value='自身が追加した分布情報を削除' onclick="buttonClick()">
    </form>
</div>
@endsection

@section('script2')
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