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
      <form action="{{ route('talks.search') }}" method="get">
        @csrf
        <input type="text" name="name">
        <input class="btn" type="submit" value="検索">
      </form>

    </div><!-- /.section-ttl-wrapper -->


    <div class="talk-box">
      <ul class="friends-list">

        @forelse($followingAccounts as $followingAccount)

        <?php $theFriendId = $followingAccount->user_following->id; ?>

        <li class="friends-item">
          <form name="friend" action="{{ route('talks.show', ['theFriendId' => $theFriendId]) }}" method="GET">
            @csrf

            @if(count($followingAccounts) == 1)
            <a href="javascript: friend.submit()">
              @endif

              @if(count($followingAccounts) >= 2)
              <a href="javascript: friend[{{ $loop->iteration - 1 }}].submit()">
                @endif

                <div class="friend-img">
                  @if($followingAccount->user_following->img == null)
                  <img src="https://skilltrace-bucket.s3.ap-northeast-1.amazonaws.com/profile_img/no_img.png" alt="各々のトプ画">
                  @else
                  <img src="{{ $followingAccount->user_following->img }}" alt="自分のトプ画">
                  @endif
                </div><!-- /.friends-img -->

                <div class="friend-body">
                  <!-- 名前や年齢などの説明 -->
                  <div class="friend-body-top">
                    <p>{{ optional($followingAccount->user_following)->name }}</p>
                  </div><!-- /.friend-body-top -->

                  <div class="friend-body-middle">
                    <p>年齢：{{ optional($followingAccount->user_following)->age }}</p>
                    <p>住所：{{ optional($followingAccount->user_following->area)->area }}</p>
                  </div><!-- /.friend-body-middle -->

                  <div class="friend-body-bottom">
                    <p>エンジニア歴：{{ optional($followingAccount->user_following->history)->history }}</p>
                    <p>得意言語：{{ optional($followingAccount->user_following->language)->name }}</p>
                  </div><!-- /.friend-body-bottom -->

                </div><!-- /.friend-body -->
              </a>

          </form>
        </li><!-- /.friends-item -->

        @empty

        <p>見つかりませんでした</p>

        @endforelse


      </ul><!-- /.friends-list -->
    </div><!-- /.talk-box -->


  </section><!-- /.talk -->
</div><!-- /.inner -->

@endsection