<template>
    <div>
        <h1>ジャグラーの分布を確認しよう</h1>
        <div id='map' class='map'></div>
        <div>
            <div v-if="latitude !== 0">
                <button @click="addPin()">現在地を追加</button>
                <input type="hidden" v-model="latitude" >
                <input type="hidden" v-model="longitude">
            </div>
        </div>
    </div>
</template>
<script>
    export default {
        props: ['place'],
        data() {
            return {
                latitude: 0,
                longitude: 0
            }
        },
        mounted () {
            this.initMap();
            this.getCurrent();
        },
        methods: {
            getCurrent() { // 現在地の取得
                if (navigator.geolocation) {
                  navigator.geolocation.getCurrentPosition(
                    function(position){
                      let coords = position.coords;
                      // 緯度経度だけ取得
                      this.latitude = coords.latitude;
                      this.longitude = coords.longitude;
                      console.log(this.latitude, this.longitude, '現在地') 
                    }.bind(this),
                    function(error) {
                        switch (err.code) {
                            case 1 :
                                alert("位置情報の利用が許可されていません");
                                break;
                            case 2 :
                                alert("デバイスの位置が判定できません");
                                break;
                            case 3 :
                                alert("タイムアウトしました");
                                break;
                            default :
                                alert(err.message);
                        }
                    }
                  );
                } else {
                    alert("ブラウザが位置情報取得に対応していません");
                }
            },
            initMap() {
                var map;
                var marker = [];
                var infoWindow = [];
                var markerData = place;
            	// 地図の作成 
            	if (this.latitude != 0){ // 現在地が取得できている時
            	    var mapLatLng = new google.maps.LatLng({lat: this.latitude, lng: this.longitude }); // 地図の中心を現在地に
            	}else{ // 現在地が取得できていない時
            	    var mapLatLng = new google.maps.LatLng({lat: 35.68157417189571, lng: 139.76701766444776 }); // 地図の中心を東京に
            	}
            	map = new google.maps.Map(document.getElementById('map'), { // #mapに地図を埋め込む
            		center: mapLatLng, // 地図の中心を指定
            		zoom:8 // 地図のズームを指定
            	});
            	// マーカー毎の処理
        	    for (var i = 0; i < markerData.length; i++) {
        		    const markerLatLng = new google.maps.LatLng({lat: markerData[i]['latitude'], lng: markerData[i]['longitude']}); // 緯度経度のデータ作成
        	    	marker[i] = new google.maps.Marker({ // マーカーの追加
            			position: markerLatLng, // マーカーを立てる位置を指定
            			map: map // マーカーを立てる地図を指定
            		});
            	}
            },
            addPin() { // ピンの追加
                axios.post('/map/addPin', {
                    place:{ 
                        latitude: this.latitude,
                        longitude: this.longitude
                    }
                })
                .then(res => {
                    console.log(res);
                    if(res.status==200){
                        var map;
                        var marker;
                        var mapLatLng = new google.maps.LatLng({lat: this.latitude, lng: this.longitude }); // 緯度経度のデータ作成
                    	map = new google.maps.Map(document.getElementById('map'), { // #mapに地図を埋め込む
                    		center: mapLatLng, // 地図の中心を指定
                    		zoom:8 // 地図のズームを指定
                    	});
                        const markerLatLng = new google.maps.LatLng({lat: this.latitude, lng:this.longitude}); // 緯度経度のデータ作成
            	    	marker = new google.maps.Marker({ // マーカーの追加
                			position: markerLatLng, // マーカーを立てる位置を指定
                			map: map // マーカーを立てる地図を指定
                		});
                    }
                }).catch(function(error) {
                    console.log(error);
                });
            }
        }
    }
</script>
