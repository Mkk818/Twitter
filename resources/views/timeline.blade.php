<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Twitter</title>
    <link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/timeline.css') }}">
</head>
<body>
    <div class="wrapper">
        <form action="/timeline" method="post">
            @csrf
            <div class="post-box">
                <input type="text" name="tweet" placeholder="今なにしてる?">
                <button type="submit" class="submit-btn">ツイート</button>
            </div>
        </form>

        <div class="tweet-wrapper">
            @foreach($tweets as $tweet)
            <div class="tweet-box">
                <a href="{{ route('show', [$tweet->user->id]) }}"><img src="{{ asset('storage/images/'. $tweet->user->avatar) }}" alt="" class="avatar"></a>
                <div>{{ $tweet->tweet }}</div>
                <div class="destroy-btn">
                    @if($tweet->user_id == Auth::user()->id)
                    <form action="{{ route('destroy', [$tweet->id]) }}" method="post">
                        @csrf
                        <input type="submit" value="削除">
                    </form>
                    @endif
                </div>
            </div>
            <div style="padding:10px 40px">
                @if($tweet->likedBy(Auth::user())->count() > 0)
                <a href="/likes/{{ $tweet->likedBy(Auth::user())->firstOrFail()->id }}"><i class="fas fa-heart-broken"></i></a>
                @else
                <a href="/tweets/{{ $tweet->id}}/likes"><i class="far fa-heart"></i></a>
                @endif
                {{ $tweet->likes->count() }}
            </div>
            @endforeach
        </div>
    </div>
</body>
</html>