@extends('users.profile')

@section('profile_menue')
    <div class='posts_container'>
        @foreach ($likes as $like)
        <div class='post_container'>
            <div class='user'>
                @if($like->post->user->icon_path != 0)
                    <img  class='user_icon' src="{{ $like->post->user->icon_path }}">
                @else
                    <i class="fa-solid fa-circle-user" style="font-size:50px;"></i>
                @endif
                <a  class='user_name' href='{{ route("profile.posts", ["user" => ($like->post->user->id)]) }}'>{{ $like->post->user->name }}</a>
            </div>
            <div class='post_title'>
                <p class='tool_number'>{{ $like->post->tool_number }}</p>
                <a class='tool_name' href='{{ route("tools.show", ["tool" => ($like->post->tool->id)]) }}'>{{ $like->post->tool->tool_name }}</a>
                <p class='technique_name'>{{ $like->post->technique }}</p>
            </div>
            <div class='post_body'>
                <video controls loop autoplay muted>
                    <source src="{{ $like->post->video_path }}" type="video/mp4">
                </video>
                <p class='post_text'>{{ $like->post->text }}</p>
            </div>
            <div class='post_reaction'>
                <like-component :post="{{ json_encode($like->post)}}"></like-component>
                <button class='btn' onclick="location.href='{{ route("comments.show", ["post" => ($like->post->id)])}}'">
                    <i class="fa-regular fa-comment" style="color:purple;"></i>
                </button>
                <bookmark-component class='bookmark' :post="{{ json_encode($like->post)}}"></bookmark-component>
                @if($like->post->user->id == Auth::user()->id)
                <form class='delete' id="posts_delete_form" action='{{ route("posts.delete", ["post" => ($like->post->id)]) }}' method='POST' enctype="multipart/form-data">
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