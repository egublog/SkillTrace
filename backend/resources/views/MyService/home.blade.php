@extends('layouts.default')

@section('css', '/css/MyService/home.css')

@section('title', '自分のスキル確認')

@section('content')

<!-- 自分のスキル確認 -->

<div class="inner">
  <section class="home-top">
    <div class="home-top-wrap">
      <!-- トプ画と名前とフォロワーフォローボタン -->
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
  

          <form class="follower" name="follower" action="{{ route('follower.index', ['userId' => $userId]) }}" method="get">
            @csrf
            <a href="javascript: follower.submit()">フォロワー</a>
          </form>
  
          <form class="following" name="following" action="{{ route('following.index', ['userId' => $userId]) }}" method="get">
            @csrf
            <a href="javascript: following.submit()">フォロー中</a>
          </form>


       
  
        </div><!-- /.home-top-wrap-center-follow -->
  
  
  
      </div>
  
      <!-- すでにフォローしていない場合
      →followテーブルのuser_id=myIdかつuser_to_idがfriendIdがない場合 -->
  
      @if($userId != $myId)
      @empty($follow_check)
      <div class="home-top-wrap-right">
        <form action="{{ route('following.follow', ['userId' => $userId]) }}" method="POST" name="follow">
          @csrf
  
          <a href="javascript: follow.submit()">
            フォローする
          </a>

        </form>
      </div><!-- /.home-top-wrap-right -->
      @endempty
      @endif

      @if($userId != $myId)
      @if(isset($follow_check))
      <div class="home-top-wrap-right">
        <form action="{{ route('following.follow', ['userId' => $userId]) }}" method="POST" name="follow">
          @csrf
  
          <a href="javascript: follow.submit()">
            フォローしました
          </a>

        </form>
      </div><!-- /.home-top-wrap-right -->
      @endif
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
  
      <!-- もしも自分のアカウントである場合 -->
      @if($userId == $myId)
      <a href="{{ route('profile.index') }}">プロフィールの編集</a>
      @endif
  
      <!-- もしも自分以外のアカウントである場合 -->
      @if($userId != $myId)
      <form name="friend" action="{{ route('talk.show', ['theFriendId' => $userId]) }}" method="get">
        @csrf
        <a href="javascript: friend.submit()">トークする</a>
        <input type="hidden" name="id" value="{{ $userId }}">
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
  
  
    <!-- もしskill_addでskillを選択して追加するボタンが押されたら、選択した物がここに追加される仕組みを作りたい -->
    <!-- ↓↓↓↓↓↓↓↓↓↓↓↓ -->
  
    <ul class="home-skill-list">
      <!-- もしもlanguagesテーブルの自分のIDのぶんだけのlanguage_idがあった場合に何かあればある分だけ表示 -->
  
      @if(isset($languages))
      @foreach($languages as $language)

      <?php $skillId = $language->language->id ?>
  
      <li class="home-skill-item">
  
        <form name="skill" action="{{ route('skill.show', ['userId' => $userId, 'skillId' => $skillId]) }}" method="get">
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
  
              <!-- もしもlanguagesテーブルのstar_countに何か入っていたらそのぶんだけ繰り返す -->
              <div class="star-count">
  
                <!-- もしも星の設定をしており、0以外の値が入っていたら -->
                @if($language->star_count != 0)
                @for($i = 0; $i < $language->star_count; $i++)
                  <span>⭐️</span>
                  @endfor
                  @endif
  
                  <!-- もしも星の設定をしておらず、0であれば -->
                  @if($language->star_count == 0)
                  <span>未入力</span>
                  @endif
  
              </div><!-- /.star-count -->
  
            </a>
  
        </form>
      </li>
      @endforeach
      @endif
  
      @if($userId == $myId)
      <li class="home-skill-item skill-add">
        <a href="{{ route('skill.add') }}">
          +
        </a>
      </li>
  
      <li class="home-skill-item">
        <a href="{{ route('skill.add') }}">
  
        </a>
      </li>
  
      @else
      <li class="home-skill-item">
        <a href="{{ route('skill.add') }}">
  
        </a>
      </li>
      @endif
  
    </ul><!-- /.home-skill-list -->
  
  
  </section><!-- /.home-bottom -->
</div><!-- /.inner -->

@endsection