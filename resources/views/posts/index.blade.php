@extends('others.menue')

@section('title')
    <link rel="stylesheet" href="{{secure_asset('css/index.css')}}">
    <title>Jugglink</title>
@endsection

@section('main')
    <div class='post'>
        <example-component></example-component>
        @foreach ($posts as $post)
        <div class='user'>
            {{--<image class='icon_image' src=''></image>--}}
            <p class='icon_image'>{{ $post->user->icon }}</p>
            <a href='/profiles/users/{{$post->user->id}}' class='user_name'>{{ $post->user->name }}</a>
        </div>
        <div class='post_title'>
            <p class='tool_number'>{{ $post->tool_number }}</p>
            <a href="/tools/{{ $post->tool->id }}">{{ $post->tool->name }}</a>
            <p class='technique_name'>{{ $post->technique }}</p>
        </div>
        <div class='post_body'>
            {{--<video class='post_video' src=''></video>--}}
            <p class='post_video'>{{ $post->video }}</p>
            <p class='post_text'>{{ $post->text }}</p>
        </div>
        <div class='post_reaction'>
            <div class='favorite'>いいね</div>
            @if (!$post->isLikedBy(Auth::user()))
                <span class="likes">
                    <div class='like' method='POST'>
                        <i class="fas fa-heart like-toggle"></i>
                        <a　data-post-id="{{ $post->id }}"></a>
                    </div>
                    <span class="like-counter">{{$post->like_count}}</span>
                </span><!-- /.likes -->
            @else
                <span class="likes">
                    <div class='like' method='POST'>
                        <i class="fas fa-heart like-toggle"></i>
                        <a data-post-id="{{ $post->id }}">unlike</a>
                    </div>
                    <span class="like-counter">{{$post->like_count}}</span>
                </span><!-- /.likes -->
            @endif
            <div class='coment'><a href="/posts/{{ $post->id }}/comments"><i class="fa-regular fa-comment"></i></a></div>
            <div class='bookmark'>ブックマーク</div>
        </div>
        @if($post->user->id == Auth::user()->id)
        <form id="posts_delete_form" action='/posts/{{$post->id}}' method='POST'>
            @csrf
            @method('DELETE')
            <input type='button' value='delete' onclick="buttonClick()">
        </form>
        @endif
        @endforeach
    </div>
    <div class='paginate'>
        {{ $posts->links() }}
    </div>
@endsection

@section('script')
    <script src="{{ secure_asset('js/app.js') }}" type="module"></script>
    <script>
        function buttonClick(){
            if(confirm("削除しますか？")){
                document.getElementById("posts_delete_form").submit();
            }
        }
    </script>
@endsection