@extends('layouts.default')

@section('css', '/css/MyService/home.css')

@section('title', '自分のスキル確認')

@section('content')

<div class="inner">
  <section class="home-top">
    <div class="home-top-wrap">

      <div class="home-top-wrap-center">
  
        <div class="profile-img">
          @if($account->img == null)
          <img src="https://skilltrace-bucket.s3-ap-northeast-1.amazonaws.com/profile_img/no_img.png" alt="各々のトプ画">
          @else
          <img src="{{ $account->img }}" alt="自分のトプ画">
          @endif
        </div>
  
        @if(isset($account->name))
        <p>{{ $account->name }}</p>
        @endif

        <div class="home-top-wrap-center-follow">

          <form class="follower" name="follower" action="{{ route('followers.index', ['userId' => $userId]) }}" method="get">
            @csrf
            <a href="javascript: follower.submit()">フォロワー</a>
          </form>
  
          <form class="following" name="following" action="{{ route('following.index', ['userId' => $userId]) }}" method="get">
            @csrf
            <a href="javascript: following.submit()">フォロー中</a>
          </form>

        </div><!-- /.home-top-wrap-center-follow -->

      </div>

      <!-- 他人の画面 -->
      @if($userId != $myId)
      <div class="home-top-wrap-right">

        <follow-button :follow-check="{{ $followCheck }}" :user-id="{{ $userId }}"></follow-button>

      </div><!-- /.home-top-wrap-right -->
      @endif
  
    </div><!-- /.home-top-wrap -->
  
    <div class="home-top-detail">
      <dl>
  
        <div class="home-top-detail-wrapper">
          <dt>年齢</dt>
          @if(isset($account->age))
          <dd>{{ $account->age }}</dd>
          @endif
        </div><!-- /.home-top-detail-wrapper -->
  
        <div class="home-top-detail-wrapper">
          <dt>住所</dt>
          @if(isset($account->area->area))
          <dd>{{ $account->area->area }}</dd>
          @endif
        </div><!-- /.home-top-detail-wrapper -->
  
        <div class="home-top-detail-wrapper">
          <dt>エンジニア歴</dt>
          @if(isset($account->history->history))
          <dd>{{ $account->history->history }}</dd>
          @endif
        </div><!-- /.home-top-detail-wrapper -->
  
        <div class="home-top-detail-wrapper">
          <dt>得意な言語</dt>
          @if(isset($account->language->name))
          <dd>{{ $account->language->name }}</dd>
          @endif
        </div><!-- /.home-top-detail-wrapper -->
  
      </dl>
  
    </div><!-- /.home-top-detail -->
  
    <div class="home-top-button">

    <!-- 自分の画面 -->
      @if($userId == $myId)
      <a href="{{ route('profiles.index') }}">プロフィールの編集</a>
      @endif
  
      <!-- 他人の画面 -->
      @if($userId != $myId)
      <form name="friend" action="{{ route('talks.show', ['theFriendId' => $userId]) }}" method="get">
        @csrf
        <a href="javascript: friend.submit()">トークする</a>
      </form>
      @endif
  
    </div><!-- /.home-top-button -->
  
  </section><!-- /.home-top -->
  
  <hr>
  
  <section class="home-bottom">
  
    <div class="section-ttl-wrapper">
      <div class="section-ttl">
        <h2>スキル一覧</h2>
      </div><!-- /.section-ttl -->
    </div><!-- /.section-ttl-wrapper -->
  
    <ul class="home-skill-list">
  
      @if(isset($languages))
      @foreach($languages as $language)

      <?php $skillId = $language->language->id ?>
  
      <li class="home-skill-item">
  
        <form name="skill" action="{{ route('skills.show', ['userId' => $userId, 'skillId' => $skillId]) }}" method="get">
          @csrf
          <!-- languagesの個数が一個だったらと2個以上だったらで場合わけ -->
          @if(count($languages) == 1)
          <a href="javascript: skill.submit()">
            @endif
  
            @if(count($languages) >= 2)
            <a href="javascript: skill[{{ $loop->iteration - 1 }}].submit()">
              @endif
  
              @if(isset($language->language->name))
              <p>{{ $language->language->name }}</p>
              @endif
  
              <div class="devicon">
                @if(isset($language->language->favicon))
                <i class="devicon-{{ $language->language->favicon }} colored devicon-style"></i>
                @endif
              </div><!-- /.devicon -->

              <div class="star-count">

                @if($language->star_count != 0)
                @for($i = 0; $i < $language->star_count; $i++)
                  <span>⭐️</span>
                @endfor
                @endif

                @if($language->star_count == 0)
                <span>未入力</span>
                @endif

              </div><!-- /.star-count -->
  
            </a>
  
        </form>
      </li>
      @endforeach
      @endif
  
      <!-- 自分の画面 -->
      @if($userId == $myId)
      <li class="home-skill-item skill-add">
        <a href="{{ route('skills.create') }}">
          +
        </a>
      </li>
  
      <li class="home-skill-item">
        <a href="{{ route('skills.create') }}">
  
        </a>
      </li>
  
      @else
      <li class="home-skill-item">
        <a href="{{ route('skills.create') }}">
  
        </a>
      </li>
      @endif
  
    </ul><!-- /.home-skill-list -->
  
  </section><!-- /.home-bottom -->
</div><!-- /.inner -->

@endsection