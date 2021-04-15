@extends('layouts.default')

@section('css', '/css/MyService/talk-show.css')

@section('title', 'トークの中身')

@section('content')

<!-- トーク -->

<!-- 飛ばすリンク先 -->
<!-- friend -->
<!-- profile -->

<section class="talk">

  <div class="row">
    <div class="friends col-md-4 hidden-sp">

      <p class="friends-ttl">友達一覧</p>
      <!-- 友達一覧 -->
      <ul class="friends-list">

        @forelse($followingAccounts as $followingAccount)

        <li class="friends-item">
          <form name="friend" action="{{ route('talks.show', ['theFriendId' => $followingAccount->user_following->id]) }}" method="GET">
            @csrf

            @if(count($followingAccounts) == 1)
            <a href="javascript: friend.submit()">
              @endif

              @if(count($followingAccounts) >= 2)
              <a href="javascript: friend[{{ $loop->iteration - 1 }}].submit()">
                @endif




                <div class="friends-img">
                  @if($followingAccount->user_following->img == null)
                  <img src="https://skilltrace-bucket.s3.ap-northeast-1.amazonaws.com/profile_img/no_img.png" alt="各々のトプ画">
                  @else
                  <img src="{{ $followingAccount->user_following->img }}" alt="自分のトプ画">
                  @endif
                </div><!-- /.friends-img -->

                <!-- 名前や年齢などの説明 -->

                <p class="friends-name">{{{ optional($followingAccount->user_following)->name }}}</p>



              </a>

          </form>

        </li><!-- /.friends-item -->

        @empty

        <p class="no-hit">見つかりませんでした</p>

        @endforelse

      </ul><!-- /.friends-list -->
    </div><!-- /.friends -->


    <!-- 右側 -->

    <div class="talk-friend col-md-8">

      <div class="talk-friend-top">

        <div class="talk-friend-top-ttl">
          <a class="back" href="{{ route('talks.index') }}"><span>&lt;</span></a>

          <p>{{ optional($theFriendAccount)->name }}とのトーク</p>

        </div><!-- /.talk-friend-top-ttl -->

      </div><!-- /.talk-friend-top -->

      <div class="talk-friend-middle" id="talk-middle-scroll">
        <!-- もしも自分の発言だったら -->
        @if(isset($talks))
        @foreach($talks as $talk)
        @if($talk->user_id == $myId)
        <div class="talk-own">
          <div class="talk-own-head">

            <!-- もし、相手がTalkController@talk-showを実行したら -->
            @if($talk->yet)
            <p class="talk-own-head-yet">既読</p>
            @endif

            <p class="talk-own-head-time">{{ $talk->created_at->format('H:i') }}</p>

          </div>

          <div class="talk-own-content">
            <p class="talk-own-content-txt">{{ $talk->talk_body }}</p>
          </div>

        </div>

        <!-- もしも相手の発言だったら -->
        @else
        <div class="talk-opponent">

          <div class="talk-opponent-img">
            @if($theFriendAccount->img == null)
            <img src="https://skilltrace-bucket.s3.ap-northeast-1.amazonaws.com/profile_img/no_img.png" alt="各々のトプ画">
            @else
            <img src="{{ $theFriendAccount->img }}" alt="自分のトプ画">
            @endif
          </div>

          <div class="talk-opponent-body">
            <p class="talk-opponent-body-txt">{{ $talk->talk_body }}</p>
          </div>

          <div class="talk-opponent-footer">
            <p class="talk-opponent-footer-time">{{ $talk->created_at->format('H:i') }}</p>
          </div>

        </div>
        @endif
        @endforeach
        @endif

      </div><!-- /.talk-friend-middle -->

      <div class="talk-friend-bottom">

        <form id="talk-txt" action="{{ route('talks.store', ['theFriendId' => $theFriendId]) }}" method="post">
          @csrf
          <div class="talk-send">

            @if ($errors->has('message'))
            <div class="alert alert-danger mt-3">
              <ul>

                @foreach($errors->get('message') as $error)
                <li>{{ $error }}</li>
                @endforeach

              </ul>
            </div>
            @endif

            <textarea name="message" id="message" resize="vertical" placeholder="メッセージを入力"></textarea>

          </div>
        </form>
      </div><!-- /.talk-friend-bottom -->

    </div><!-- /.talk-friend -->
  </div><!-- /.row -->
</section><!-- /.talk -->


@endsection