@extends('layouts.default')

@section('css', '/css/MyService/talk.css')

@section('title', 'トーク')

@section('content')

<section class="talk">

  <div class="section-ttl-wrapper">
    <div class="section-ttl">
      <h2>トーク</h2>
    </div><!-- /.section-ttl -->
    <!-- 検索 -->
    <form action="{{ action('TalkController@talk_search') }}" method="post">
      @csrf
      <input type="text" name="name">
      <input type="submit" value="検索">
    </form>
  </div><!-- /.section-ttl-wrapper -->


  <div class="talk-box">
    <ul class="talk-box-list">

      @forelse($following_accounts as $following_account)

      <li class="talk-box-item">
        <form name="friend" action="{{ action('TalkController@talk_show') }}" method="GET">
          @csrf

          @if(count($following_accounts) == 1)
          <a href="javascript: friend.submit()">
            @endif

            @if(count($following_accounts) >= 2)
            <a href="javascript: friend[{{ $loop->iteration - 1 }}].submit()">
              @endif

              <div class="friend-img">
                @if($following_account->user_following->img == null)
                <img src="/storage/no_img.png" alt="各々のトプ画">
                @else
                <img src="/storage/profile_images/{{ $following_account->user_following->img }}" alt="自分のトプ画">
                @endif
              </div><!-- /.friends-img -->

              <div class="talk-box-body">
                <!-- 名前や年齢などの説明 -->
                <div class="talk-box-top">
                  <p class="talk-box-name">{{{ $following_account->user_following->name }}}</p>
                  <p class="talk-box-age">年齢：{{{ $following_account->user_following->age }}}</p>
                </div><!-- /.talk-box-top -->

                <div class="talk-box-bottom">
                  <p class="talk-box-area">住所：{{{ $following_account->user_following->area->area }}}</p>
                  <p class="talk-box-history">エンジニア歴：{{{ $following_account->user_following->history->history }}}</p>
                  <p class="talk-box-favorite">得意言語：{{{ $following_account->user_following->language->name }}}</p>
                </div><!-- /.talk-box-bottom -->

              </div><!-- /.talk-box-body -->
            </a>

            <input type="hidden" name="id" value="{{ optional($following_account->user_following)->id }}">

        </form>
      </li><!-- /.talk-box-item -->

      @empty

      <p>見つかりませんでした</p>

      @endforelse


    </ul><!-- /.talk-box-list -->
  </div><!-- /.talk-box -->


</section><!-- /.talk -->

@endsection