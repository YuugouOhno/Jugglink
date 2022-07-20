@extends('others.menue')

@section('title2')
    <title>ホーム/Jugglink</title>
    <link href="{{secure_asset('css/postmodal.css')}}" rel="stylesheet">
@endsection

@section('header2')
    <h4>ホーム</h4>
@endsection

@section('main2')

    <button id="modalOpen" class="button">Click Me</button>
    <div id="easyModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h1>Great job 🎉</h1>
                <span class="modalClose">×</span>
            </div>
            <div class="modal-body">
                <p>You've just displayed this awesome Modal Window!</p>
                <p>Let's enjoy learning JavaScript ☺️</p>
            </div>
        </div>
    </div>

    <div class='posts_container'>
        <posts-component :url="{{ json_encode('/infinity_posts/')}}" :id="{{ json_encode(0)}}"></posts-component>
    </div>
@endsection

@section('script2')
    <script>
        const buttonOpen = document.getElementById('modalOpen');
        const modal = document.getElementById('easyModal');
        const buttonClose = document.getElementsByClassName('modalClose')[0];
        
        buttonOpen.addEventListener('click', modalOpen);
        function modalOpen() {
          modal.style.display = 'block';
        }
        
        buttonClose.addEventListener('click', modalClose);
        function modalClose() {
          modal.style.display = 'none';
        }
        
        addEventListener('click', outsideClose);
        function outsideClose(e) {
          if (e.target == modal) {
            modal.style.display = 'none';
          }
        }
    </script>
@endsection