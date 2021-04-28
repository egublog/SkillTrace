@extends('layouts.default')
csrf_field()
@section('css', '/css/MyService/search.css')

@section('title', '見つける')

@section('content')

<!-- user, user->area, user->history, user->language,  -->

<section class="search">

  <div class="section-ttl-wrapper">
    <div class="section-ttl">
      <h2>見つける</h2>
    </div><!-- /.section-ttl -->
  </div><!-- /.section-ttl-wrapper -->


  <div class="search-wrapper">

    <form action="{{ route('searches.search') }}" method="get">
      @csrf

      <dl class="search-wrapper-def">

        <div class="search-box">
          <label>
            <dt class="search-box-ttl">名前：</dt>
            <dd class="search-box-data">
              <input class="" id="name" name="name" value="{{ old('name') }}">
            </dd>
          </label>
        </div>

        @if ($errors->has('age'))
        <div class="alert alert-danger mt-3">
          <ul>

            @foreach($errors->get('age') as $error)
            <li>{{ $error }}</li>
            @endforeach

          </ul>
        </div>
        @endif

        <div class="search-box">
          <label>
            <dt class="search-box-ttl">年齢：</dt>
            <dd class="search-box-data">
              <input class="" id="age" name="age" type='number' value="{{ old('age') }}">
            </dd>
          </label>
        </div>

        <div class="search-box">
          <label>
            <dt class="search-box-ttl">住んでいる地域：</dt>
            <dd class="search-box-data">
              <select class="col-8" id="area" name="area_id">

                <option value="">指定しない</option>
                <?php $i = 1; ?>
                @foreach($areas as $area)
                <option value="<?php echo $i ?>" @if(old('area_id')==$i) selected @endif>{{ $area->area }}</option>
                <?php $i++ ?>
                @endforeach

              </select>
            </dd>
          </label>
        </div>

        <div class="search-box">
          <label>
            <dt class="search-box-ttl">エンジニア歴：</dt>
            <dd class="search-box-data">
              <select class="col-8" id="history" name="history_id">

                <option value="">指定しない</option>
                <?php $i = 1; ?>
                @foreach($histories as $history)
                <option value="<?php echo $i ?>" @if(old('history_id')==$i) selected @endif>{{ $history->history }}</option>
                <?php $i++ ?>
                @endforeach

              </select>
            </dd>
          </label>
        </div>

        <div class="search-box">
          <label>
            <dt class="search-box-ttl">得意な言語：</dt>
            <dd class="search-box-data">
              <select class="col-8" id="favorite" name="language_id">

                <option value="">指定しない</option>
                <?php $i = 1; ?>
                @foreach($languages as $language)
                <option value="<?php echo $i ?>" @if(old('language_id')==$i) selected @endif>{{ $language->name }}</option>
                <?php $i++ ?>
                @endforeach

              </select>
            </dd>
          </label>
        </div>

      </dl><!-- /.search-wrapper-def-->

      <div class="search-wrapper-button">
        <input class="btn" type="submit" value="検索">
      </div>

    </form>
  </div><!-- /.search-wrapper -->



  <!-- 検索結果 -->

  <ul class="friends-list">

    @if(isset($searchResultUsers))

    @forelse($searchResultUsers as $searchResultUser)

    <?php $friendId = $searchResultUser->id ?>

    <li class="friends-item">

      <form name="friend" action="{{ route('home.home', ['userId' => $friendId]) }}" method="get">
        @csrf
        <!-- search_result_usersの個数が一個だったらと2個以上だったらで場合わけ -->
        @if(count($searchResultUsers) == 1)
        <a href="javascript: friend.submit()">
          @endif

          @if(count($searchResultUsers) >= 2)
          <a href="javascript: friend[{{ $loop->iteration - 1 }}].submit()">
            @endif

            <div class="friend-img">
              @if($searchResultUser->img == null)
              <img src="https://skilltrace-bucket.s3.ap-northeast-1.amazonaws.com/profile_img/no_img.png" alt="各々のトプ画">
              @else
              <img src="{{ $searchResultUser->img }}" alt="自分のトプ画">
              @endif
            </div><!-- /.friends-img -->

            <div class="friend-body">

              <div class="friend-body-top">
                <p>{{ $searchResultUser->name }}</p>
              </div><!-- /.friend-body-top -->

              <div class="friend-body-middle">
                @if(isset($searchResultUser->age))
                <p>年齢： {{ $searchResultUser->age }}</p>
                @else
                <p>年齢： 未登録</p>
                @endif

                @if(isset($searchResultUser->area->area))
                <p>住所： {{ $searchResultUser->area->area }}</p>
                @else
                <p>住所： 未登録</p>
                @endif
              </div><!-- /.friend-body-middle -->

              <div class="friend-body-bottom">
                @if(isset($searchResultUser->history->history))
                <p>エンジニア歴： {{ $searchResultUser->history->history }}</p>
                @else
                <p>エンジニア歴： 未登録</p>
                @endif

                @if(isset($searchResultUser->language->name))
                <p>得意言語： {{ $searchResultUser->language->name }}</p>
                @else
                <p>得意言語： 未登録</p>
                @endif
              </div><!-- /.friend-body-bottom -->

            </div><!-- /.friends-body -->
          </a>
      </form>
    </li>

    @empty

    <p class="no-hit">見つかりませんでした</p>

    @endforelse
    @endif

  </ul><!-- /.friends-list -->

</section><!-- /.search -->

@endsection
