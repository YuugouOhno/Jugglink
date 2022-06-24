@extends('users.profile')

@section('profile_menue')
    <div class='post'>
        @foreach ($user->likes as $like)
        <div class='user'>
            {{--<image class='icon_image' src=''></image>--}}
            <p class='icon_image'>{{ $like->post->user->icon }}</p>
            <a href='{{ route("profile.posts", ["user" => ($like->post->user->id)]) }}' class='user_name'>{{ $$like->post->user->name }}</a>
        </div>
        <div class='post_title'>
            <p class='tool_number'>{{ $like->post->tool_number }}</p>
            <a href='{{ route("tools.show", ["tool" => ($like->post->tool->id)]) }}'>{{ $like->post->tool->name }}</a>
            <p class='technique_name'>{{ $like->post->technique }}</p>
        </div>
        <div class='post_body'>
            {{--<video class='post_video' src=''></video>--}}
            <p class='post_video'>{{ $like->post->video }}</p>
            <p class='post_text'>{{ $like->post->text }}</p>
        </div>
        <div class='post_reaction'>
            <like-component :post="{{ json_encode($like->post)}}"></like-component>
            <div class='coment'><a href='{{ route("comments.show", ["post" => ($like->post->id)])}}'><i class="fa-regular fa-comment"></i></a></div>
            <bookmark-component :post="{{ json_encode($like->post)}}"></bookmark-component>
        </div>
        @if($like->post->user->id == Auth::user()->id)
        {{--<form id="posts_delete_form" action='{{ route("posts.delete", ["post" => ($post->id)]) }}' method='POST'>
            @csrf
            @method('DELETE')
            <input type='button' value='delete' onclick="buttonClick()">
        </form>--}}
        <deletepost-component :post="{{ json_encode($like->post)}}"></deletepost-component>
        @endif
        @endforeach
    </div>
    <div class='paginate'>
        {{ $like->posts->links() }}
    </div>
@endsection

@section('script')
    {{--<script>
        function buttonClick(){
            if(confirm("削除しますか？")){
                document.getElementById("form").submit();
            }
        }
	</script>--}
@endsection