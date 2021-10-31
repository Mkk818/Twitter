<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Twitter</title>
    <link rel="stylesheet" href="{{ asset('css/timeline.css') }}">
</head>

<body>
    <div class="wrapper">
        <form action="/timeline" method="post">
            @csrf
            <div class="post-box">
                <input type="text" name="tweet" id="" placeholder="今なにしてる？">
                <button type="submit" class="submit-btn">ツイート</button>
            </div>
        </form>
        <div class="tweet-wrapper">
            @foreach ($tweets as $tweet)
            <div class="tweet-box">
                {{-- <div class="user_icons"> --}}
                    <img src="{{ asset('storage/images/'. $tweet->user->avatar) }}" class="avatar" alt="">
                    {{-- <div>{{ $tweet->user->name }}</div> --}}
                {{-- </div> --}}
                <div>{{ $tweet->tweet }}</div>
                <div class="destroy-btn">
                    @if($tweet->user_id === Auth::user()->id)
                    <form action="{{ route('destroy', [$tweet->id]) }}" method="post">
                        @csrf
                        <input type="submit" value="削除">
                    </form>
                    @endif
                </div>
            </div>
            @endforeach
        </div>
    </div>
</body>

</html>