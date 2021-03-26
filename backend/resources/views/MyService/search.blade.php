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
                <?php $i = 1; ?>
                @foreach($areas as $area)
                <option value="<?php echo $i ?>" @if(old('area_id') == $i) selected @endif>{{ $area->area }}</option>
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
                <?php $i = 1; ?>
                @foreach($histories as $history)
                <option value="<?php echo $i ?>" @if(old('history_id') == $i) selected @endif>{{ $history->history }}</option>
                <?php $i++ ?>
                @endforeach

              </select>
            </dd>
          </label>
        </div>

        <div class="search-box">
          <label>
            <dt class="search-box-ttl">得意な言語：
            </dt>
            <dd class="search-box-data">
              <select class="col-8" id="favorite" name="language_id">
                <?php $i = 1; ?>
                @foreach($languages as $language)
                <option value="<?php echo $i ?>" @if(old('language_id') == $i) selected @endif>{{ $language->name }}</option>
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
      <!-- もしも結果がヒットすれば -->

      @if(isset($search_result_users))

      @forelse($search_result_users as $search_result_user)

      <?php $friendId = $search_result_user->id ?>

      <li class="friends-item">

        <form name="friend" action="{{ route('home.home', ['userId' => $friendId]) }}" method="get">
          @csrf
          <!-- search_result_usersの個数が一個だったらと2個以上だったらで場合わけ -->
          @if(count($search_result_users) == 1)
          <a href="javascript: friend.submit()">
            @endif

            @if(count($search_result_users) >= 2)
            <a href="javascript: friend[{{ $loop->iteration - 1 }}].submit()">
              @endif

              <div class="friend-img">
                @if($search_result_user->img == null)
                <img src="https://skilltrace-bucket.s3.ap-northeast-1.amazonaws.com/profile_img/no_img.png" alt="各々のトプ画">
                @else
                <img src="{{ $search_result_user->img }}" alt="自分のトプ画">
                @endif
              </div><!-- /.friends-img -->

              <div class="friends-body">

                <div class="friends-body-top">
                  <p class="friends-body-top-name">{{ $search_result_user->name }}</p>
                  <p class="friends-body-top-age">年齢：{{ $search_result_user->age }}</p>
                </div><!-- /.friends-body-top -->

                <div class="friends-body-bottom">
                  <p class="friends-body-bottom-area">住所：{{ $search_result_user->area->area }}</p>
                  <p class="friends-body-bottom-history">エンジニア歴：{{ $search_result_user->history->history }}</p>
                  <p class="friends-body-bottom-favorite">得意言語：{{ $search_result_user->language->name }}</p>
                </div><!-- /.friends-body-bottom -->

              </div><!-- /.friends-body -->
            </a>


            <!-- <input type="hidden" name="id" value="{{ $search_result_user->id }}"> -->

        </form>

      </li>


      @empty

      <p class="no-hit">見つかりませんでした</p>


      @endforelse
      @endif

    </ul><!-- /.friends-list -->


</section><!-- /.search -->

@endsection