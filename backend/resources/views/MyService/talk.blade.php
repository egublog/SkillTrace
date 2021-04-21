@extends('layouts.default')

@section('css', '/css/MyService/talk.css')

@section('title', 'トーク')

@section('content')

<div class="inner">
  <section class="talk">

    <div class="section-ttl-wrapper">

      <div class="section-ttl">
        <h2>トーク</h2>
      </div><!-- /.section-ttl -->

      @if ($errors->has('name'))
      <div class="alert alert-danger mt-3">
        <ul>

          @foreach($errors->get('name') as $error)
          <li>{{ $error }}</li>
          @endforeach

        </ul>
      </div>
      @endif

      <!-- 検索 -->
      <form class="mt-3" action="{{ route('talks.search') }}" method="get">
        @csrf
        <input type="text" name="talk_search_name" value="{{ old('talk_search_name') }}">

        <div class="talk-wrapper-button">
          <input class="btn" type="submit" value="検索">
        </div><!-- /.talk-wrapper-button -->

      </form>

    </div><!-- /.section-ttl-wrapper -->


    <div class="talk-box">
      <ul class="friends-list">

        @forelse($talkingUsers as $talkingUser)

        <?php $talkingUserId = $talkingUser->id; ?>

        <li class="friends-item">
          <form name="friend" action="{{ route('talks.show', ['theFriendId' => $talkingUserId]) }}" method="GET">
            @csrf

            @if(count($talkingUsers) == 1)
            <a href="javascript: friend.submit()">
              @endif

              @if(count($talkingUsers) >= 2)
              <a href="javascript: friend[{{ $loop->iteration - 1 }}].submit()">
                @endif

                <div class="friend-img">
                  @if($talkingUser->img == null)
                  <img src="https://skilltrace-bucket.s3.ap-northeast-1.amazonaws.com/profile_img/no_img.png" alt="各々のトプ画">
                  @else
                  <img src="{{ $talkingUser->img }}" alt="自分のトプ画">
                  @endif
                </div><!-- /.friends-img -->

                <div class="friend-body">

                  <div class="friend-body-top">
                    <p>{{ $talkingUser->name }}</p>
                  </div><!-- /.friend-body-top -->

                  <div class="friend-body-middle">
                    @if(isset($talkingUser->age))
                    <p>年齢： {{ $talkingUser->age }}</p>
                    @else
                    <p>年齢： 未登録</p>
                    @endif

                    @if(isset($talkingUser->area->area))
                    <p>住所： {{ $talkingUser->area->area }}</p>
                    @else
                    <p>住所： 未登録</p>
                    @endif

                  </div><!-- /.friend-body-middle -->

                  <div class="friend-body-bottom">
                    @if(isset($talkingUser->history->history))
                    <p>エンジニア歴： {{ $talkingUser->history->history }}</p>
                    @else
                    <p>エンジニア歴： 未登録</p>
                    @endif

                    @if(isset($talkingUser->language->name))
                    <p>得意言語： {{ $talkingUser->language->name }}</p>
                    @else
                    <p>得意言語： 未登録</p>
                    @endif
                  </div><!-- /.friend-body-bottom -->

                </div><!-- /.friend-body -->
              </a>

          </form>
        </li><!-- /.friends-item -->

        @empty

        <p class="no-hit">見つかりませんでした</p>

        @endforelse


      </ul><!-- /.friends-list -->
    </div><!-- /.talk-box -->


  </section><!-- /.talk -->
</div><!-- /.inner -->

@endsection