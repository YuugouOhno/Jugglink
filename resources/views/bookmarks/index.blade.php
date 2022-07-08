@extends('others.menue')

@section('main')
    <div class='posts_container'>
        @foreach ($bookmarks as $bookmark)
        <div class='post_container'>
            <div class='user'>
                @if($bookmark->post->user->icon_path != 0)
                    <img  class='user_icon' src="{{ $bookmark->post->user->icon_path }}">
                @else
                    <i class="fa-solid fa-circle-user" style="font-size:50px;"></i>
                @endif
                <a  class='user_name' href='{{ route("profile.posts", ["user" => ($bookmark->post->user->id)]) }}'>{{ $bookmark->post->user->name }}</a>
            </div>
            <div class='post_title'>
                <p class='tool_number'>{{ $bookmark->post->tool_number }}</p>
                <a class='tool_name' href='{{ route("tools.show", ["tool" => ($bookmark->post->tool->id)]) }}'>{{ $bookmark->post->tool->tool_name }}</a>
                <p class='technique_name'>{{ $bookmark->post->technique }}</p>
            </div>
            <div class='post_body'>
                <video controls loop autoplay muted>
                    <source src="{{ $bookmark->post->video_path }}" type="video/mp4">
                </video>
                <p class='post_text'>{{ $bookmark->post->text }}</p>
            </div>
            <div class='post_reaction'>
                <like-component :post="{{ json_encode($bookmark->post)}}"></like-component>
                <button class='btn' onclick="location.href='{{ route("comments.show", ["post" => ($bookmark->post->id)])}}'">
                    <i class="fa-regular fa-comment" style="color:purple;"></i>
                </button>
                <bookmark-component class='bookmark' :post="{{ json_encode($bookmark->post)}}"></bookmark-component>
                @if($bookmark->post->user->id == Auth::user()->id)
                <form class='delete' id="posts_delete_form" action='{{ route("posts.delete", ["post" => ($bookmark->post->id)]) }}' method='POST' enctype="multipart/form-data">
                    @csrf
                    @method('DELETE')
                    <button class='btn' onclick="buttonClick()">
                        <i class="fa-regular fa-trash-can" style="color:glay;"></i>
                    </button>
                </form>
                @endif
            </div>
        </div>
        @endforeach
    </div>
@endsection

@section('script')
    <script>
        function buttonClick(){
            if(confirm("削除しますか？")){
                document.getElementById("form").submit();
            }
        }
	</script>
@endsection