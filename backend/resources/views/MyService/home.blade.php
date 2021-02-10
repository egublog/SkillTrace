@extends('layouts.default')

@section('css', '/css/MyService/home.css')

@section('title', '自分のスキル確認')

@section('content')

<!-- 自分のスキル確認 -->

<section class="home-top">
  <div class="home-top-wrap">
    <!-- トプ画と名前とフォロワーフォローボタン -->
    <div class="home-top-wrap-center">

      <div class="profile-img">
        @if($account->img == null)
        <img src="/storage/no_img.png" alt="各々のトプ画">
        @else
        <img src="{{ $account->img }}" alt="自分のトプ画">
        @endif
      </div>

      @if(isset($account->name))
      <p>{{ $account->name }}</p>
      @endif


      <div class="home-top-wrap-center-follow">

        <form class="follower" name="follower" action="{{ action('HomeController@follower_list') }}" method="get">
          @csrf
          <a href="javascript: follower.submit()">フォロワー</a>
          <input type="hidden" name="follower" value="{{ $account->id }}">
        </form>

        <form class="following" name="following" action="{{ action('HomeController@following_list') }}" method="get">
          @csrf
          <a href="javascript: following.submit()">フォロー中</a>
          <input type="hidden" name="following" value="{{ $account->id }}">
        </form>

      </div><!-- /.home-top-wrap-center-follow -->



    </div>

    <!-- すでにフォローしていない場合
    →followテーブルのuser_id=myIdかつuser_to_idがfriendIdがない場合 -->

    @if($account->id !== $myId)
    @empty($follow_check)
    <div class="home-top-wrap-right">
      <form action="{{ action('HomeController@following') }}" method="POST" name="follow">
        @csrf

        <a href="javascript: follow.submit()">
          フォローする
        </a>
        <input type="hidden" name="id" value="{{ $account->id }}">
      </form>
    </div><!-- /.home-top-wrap-right -->
    @endempty
    @endif

    @if($account->id !== $myId)
    @if(isset($follow_check))
    <div class="home-top-wrap-right">
      <form action="{{ action('HomeController@following') }}" method="POST" name="follow">
        @csrf

        <a href="javascript: follow.submit()">
          フォローしました
        </a>
        <input type="hidden" name="id" value="{{ $account->id }}">
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
    @if($account->id === $myId)
    <a href="{{ action('HomeController@profile') }}">プロフィールの編集</a>
    @endif

    <!-- もしも自分以外のアカウントである場合 -->
    @if($account->id !== $myId)
    <form name="friend" action="{{ action('TalkController@talk_show') }}" method="get">
      @csrf
      <a href="javascript: friend.submit()">トークする</a>
      <input type="hidden" name="id" value="{{ $account->id }}">
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

    <li class="home-skill-item">

      <form name="skill" action="{{ action('SkillController@skill_item') }}" method="POST">
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


          <input type="hidden" name="id" value="{{ $language->id }}">

      </form>
    </li>
    @endforeach
    @endif

    @if($account->id === $myId)
    <li class="home-skill-item skill-add">
      <a href="{{ action('SkillController@skill_add') }}">
        +
      </a>
    </li>

    <li class="home-skill-item">
      <a href="{{ action('SkillController@skill_add') }}">

      </a>
    </li>

    @else
    <li class="home-skill-item">
      <a href="{{ action('SkillController@skill_add') }}">

      </a>
    </li>
    @endif

  </ul><!-- /.home-skill-list -->

  <!-- ページネーション機能をここにつけたい -->
  <div id="app2">
    <follow-button-component></follow-button-component>
  </div><!-- /#app2 -->

</section><!-- /.home-bottom -->

@endsection