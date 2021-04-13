@extends('layouts.default')

@section('css', '/css/MyService/friends-list.css')

@section('title', '友達一覧')

@section('content')

<section class="friends">

  <div class="friends-wrap">

    <a class="back" href="{{ route('home.home', ['userId' => $userId]) }}"><span>&lt;</span></a>

    <div class="section-ttl-wrapper">
      <div class="section-ttl">
        <h2>フレンドリスト</h2>
      </div><!-- /.section-ttl -->
    </div><!-- /.section-ttl-wrapper -->

  </div><!-- /.friends-wrap -->

  <div class="friends-follow">

    <form name="follower" class="follower" action="{{ route('followers.index', ['userId' => $userId]) }}" method="get">
      @csrf
      <a href="javascript: follower.submit()">フォロワー</a>
    </form>

    <form name="following" class="following" action="{{ route('following.index', ['userId' => $userId]) }}" method="get">
      @csrf
      <a href="javascript: following.submit()">フォロー中</a>
    </form>

  </div><!-- /.friends-wrap -->

  <!-- フォロワー -->
  @if(isset($followers))

  <ul class="friends-list follower-list">

    @forelse($followers as $follower)

    <?php $friendId = $follower->user_follower->id ?>

    <li class="friends-item">
      <form name="friend" action="{{ route('home.home', ['userId' => $friendId]) }}" method="get">
        @csrf
        <!-- followersの個数が一個だったらと2個以上だったらで場合わけ -->
        @if(count($followers) == 1)
        <a href="javascript: friend.submit()">
          @endif

          @if(count($followers) >= 2)
          <a href="javascript: friend[{{ $loop->iteration - 1 }}].submit()">
            @endif

            <div class="friend-img">

              @if($follower->user_follower->img == null)
              <img src="https://skilltrace-bucket.s3.ap-northeast-1.amazonaws.com/profile_img/no_img.png" alt="各々のトプ画">
              @else
              <img src="{{ $follower->user_follower->img }}" alt="自分のトプ画">
              @endif

            </div><!-- /.friends-img -->

            <div class="friend-body">

              <div class="friend-body-top">
                <p>{{ $follower->user_follower->name }}</p>
              </div><!-- /.friend-body-top -->
              
              <div class="friend-body-middle">
                <p>年齢：{{ optional($follower->user_follower)->age }}</p>
                <p>住所：{{ optional($follower->user_follower->area)->area }}</p>
              </div><!-- /.friend-body-middle -->

              <div class="friend-body-bottom">
                <p>エンジニア歴：{{ optional($follower->user_follower->history)->history }}</p>
                <p>得意言語：{{ optional($follower->user_follower->language)->name }}</p>
              </div><!-- /.friends-body-bottom -->

            </div><!-- /.friend-body -->

          </a>
      </form>
    </li>

    @empty

    <p class="no-hit">見つかりませんでした</p>

    @endforelse

  </ul><!-- /.friends-list -->
  @endif


  <!-- フォロー中 -->
  @if(isset($followings))

  <ul class="friends-list following-list">

    @forelse($followings as $following)

    <?php $friendId = $following->user_following->id; ?>


    <li class="friends-item">
      <form name="friend" action="{{ route('home.home', ['userId' => $friendId]) }}" method="get">
        @csrf
        <!-- followingsの個数が一個だったらと2個以上だったらで場合わけ -->
        @if(count($followings) == 1)
        <a href="javascript: friend.submit()">
          @endif

          @if(count($followings) >= 2)
          <a href="javascript: friend[{{ $loop->iteration - 1 }}].submit()">
            @endif

            <div class="friend-img">

              @if($following->user_following->img == null)
              <img src="https://skilltrace-bucket.s3.ap-northeast-1.amazonaws.com/profile_img/no_img.png" alt="各々のトプ画">
              @else
              <img src="{{ $following->user_following->img }}" alt="自分のトプ画">
              @endif

            </div><!-- /.friend-img -->

            <div class="friend-body">

              <div class="friend-body-top">
                <p>{{ optional($following->user_following)->name }}</p>
              </div><!-- /.friend-body-top -->
              
              <div class="friend-body-middle">
                <p>年齢：{{ optional($following->user_following)->age }}</p>
                <p>住所：{{ optional($following->user_following->area)->area }}</p=>
              </div><!-- /.friend-body-middle -->

              <div class="friend-body-bottom">
                <p>エンジニア歴：{{ optional($following->user_following->history)->history }}</pass=>
                <p>得意言語：{{ optional($following->user_following->language)->name }}</p=>
              </div><!-- /.friend-body-bottom -->

            </div><!-- /.friend-body -->

          </a>
      </form>
    </li><!-- /.friends-item -->

    @empty

    <p class="no-hit">見つかりませんでした</p>

    @endforelse

  </ul><!-- /.friends-list -->
  @endif

</section><!-- /.friends -->

@endsection