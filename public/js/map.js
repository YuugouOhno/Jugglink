console.log(map);
var map;
var marker = [];
var infoWindow = [];
var markerData = map;

function initMap() {
	// 地図の作成
	var mapLatLng = new google.maps.LatLng({lat: markerData[0]['lat'],lng: markerData[0]['lng']}); // 緯度経度のデータ作成
	map = new google.maps.Map(document.getElementById('map'), { // #mapに地図を埋め込む
		center: mapLatLng, // 地図の中心を指定
		zoom: 13 // 地図のズームを指定
	});

	// マーカー毎の処理
	for (var i = 0; i < markerData.length; i++) {
		const markerLatLng = new google.maps.LatLng({lat: markerData[i]['lat'], lng: markerData[i]['lng']}); // 緯度経度のデータ作成
		marker[i] = new google.maps.Marker({ // マーカーの追加
			position: markerLatLng, // マーカーを立てる位置を指定
			map: map // マーカーを立てる地図を指定
		});
		
		markerEvent(i); // マーカーにクリックイベントを追加

		console.log(markerData[i]);
	}
}