@extends('layouts.default')

@section('css', '/css/MyService/talk_show.css')

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

        @forelse($following_accounts as $following_account)

        <li class="friends-item">
          <form name="friend" action="{{ action('TalkController@talk_show') }}" method="GET">
            @csrf

            @if(count($following_accounts) == 1)
            <a href="javascript: friend.submit()">
              @endif

              @if(count($following_accounts) >= 2)
              <a href="javascript: friend[{{ $loop->iteration - 1 }}].submit()">
                @endif




                <div class="friends-img">
                  @if($following_account->user_following->img == null)
                  <img src="https://skilltrace-bucket.s3.ap-northeast-1.amazonaws.com/profile_img/no_img.png" alt="各々のトプ画">
                  @else
                  <img src="{{ $following_account->user_following->img }}" alt="自分のトプ画">
                  @endif
                </div><!-- /.friends-img -->

                <!-- 名前や年齢などの説明 -->

                <p class="friends-name">{{{ $following_account->user_following->name }}}</p>



              </a>

              <input type="hidden" name="id" value="{{ optional($following_account->user_following)->id }}">

          </form>

        </li><!-- /.friends-item -->

        @empty

        <p>見つかりませんでした</p>

        @endforelse

      </ul><!-- /.friends-list -->
    </div><!-- /.friends -->


    <!-- 右側 -->

    <div class="talk-friend col-md-8">

      <div class="talk-friend-top">

        <div class="talk-friend-top-ttl">
          <a class="back" href="{{ action('TalkController@talk') }}"><span>&lt;</span></a>

          <p>{{ $theFriendAccount->name }}とのトーク</p>

        </div><!-- /.talk-friend-top-ttl -->

      </div><!-- /.talk-friend-top -->

      <div class="talk-friend-middle">
        <!-- もしも自分の発言だったら -->
        @if(isset($talkDates))
        @foreach($talkDates as $talkDate)
        @if($talkDate->user_id == $myId)
        <div class="talk-own">
          <div class="talk-own-head">

            <!-- もしもyetがtrueだったら -->
            <!-- もし、相手がTalkController@talk_showを実行したら -->

            @if($talkDate->yet)
            <p class="talk-own-head-yet">既読</p>
            @endif

            <p class="talk-own-head-time">{{ $talkDate->created_at->format('H:i') }}</p>

          </div>

          <div class="talk-own-content">
            <p class="talk-own-content-txt">{{ $talkDate->talk_body }}</p>
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
            <p class="talk-opponent-body-txt">{{ $talkDate->talk_body }}</p>
          </div>

          <div class="talk-opponent-footer">
            <p class="talk-opponent-footer-time">{{ $talkDate->created_at->format('H:i') }}</p>
          </div>

        </div>
        @endif
        @endforeach
        @endif

      </div><!-- /.talk-friend-middle -->

      <div class="talk-friend-bottom">
        <form action="{{ action('TalkController@talk_content') }}" method="post">
          @csrf
          <div class="talk-send">

            <input type="hidden" name="id" value="{{ $theFriendAccount->id }}">

            <textarea name="message" id="message" resize="vertical" placeholder="メッセージを入力"></textarea>

            <div class="talk-send-button">
              <input class="" type="submit" value="送信">
            </div>

          </div>
        </form>
      </div><!-- /.talk-friend-bottom -->

    </div><!-- /.talk-friend -->
  </div><!-- /.row -->
</section><!-- /.talk -->


@endsection