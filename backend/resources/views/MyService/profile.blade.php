@extends('layouts.default')

@section('css', '/css/MyService/profile.css')

@section('title', '自分のプロフィール編集')

@section('content')

<div class="inner">
  <section class="profile">

    <div class="profile-top">
      <a class="back" href="{{ route('home.home', ['userId' => $myId]) }}"><span>&lt;</span></a>
      <div class="section-ttl-wrapper">
        <div class="section-ttl">
          <h2>プロフィールの編集</h2>
        </div><!-- /.section-ttl -->
      </div><!-- /.section-ttl-wrapper -->

    </div><!-- /.profile-top -->

    <div class="profile-body">
      <div class="inner">

        <div class="profile-body-img">
          <p class="profile-body-img-tit">プロフィール写真</p>

          @if ($errors->has('profile_img'))
          <div class="alert alert-danger mt-3">
            <ul>

              @foreach($errors->get('profile_img') as $error)
              <li>{{ $error }}</li>
              @endforeach

            </ul>
          </div>
          @endif

          <div class="profile-body-img-content">
            @if($myAccount->img == null)
            <img src="https://skilltrace-bucket.s3.ap-northeast-1.amazonaws.com/profile_img/no_img.png" alt="no_img">
            @else
            <img src="{{ $myAccount->img }}" alt="自分のトプ画" width="100px" height="100px">
            @endif
          </div>

          <form action="{{ route('profiles.img_store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <input type="file" name="profile_img">
            <input class="btn" type="submit" value="登録する">
          </form>

        </div><!-- /.profile-body-img -->


        <div class="profile-body-detail">
          <form action="{{ route('profiles.store') }}" method="post">
            {{ csrf_field() }}

            <p class="profile-body-detail-ttl">プロフィール設定</p>

            <dl class="profile-body-detail-def">

              @if ($errors->has('name'))
              <div class="alert alert-danger mt-3">
                <ul>

                  <li>{{ $errors->first('name') }}</li>

                </ul>
              </div>
              @endif

              <div class="profile-box">
                <label>
                  <dt class="profile-box-ttl">名前：</dt>
                  <dd class="profile-box-data">
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

              <div class="profile-box">
                <label>
                  <dt class="profile-box-ttl">年齢：</dt>
                  <dd class="profile-box-data">
                    <input class="" id="age" name="age" type='number' value="{{ old('age') }}">
                  </dd>
                </label>
              </div>

              @if ($errors->has('area_id'))
              <div class="alert alert-danger mt-3">
                <ul>

                  <li>{{ $errors->first('area_id') }}</li>

                </ul>
              </div>
              @endif

              <div class="profile-box">
                <label>
                  <dt class="profile-box-ttl">住んでいる地域：</dt>
                  <dd class="profile-box-data">
                    <select class="col-8" id="area" name="area_id">

                      <option value="">選択してください</option>
                      <?php $i = 1; ?>
                      @foreach($areas as $area)
                      <option value="<?php echo $i ?>" @if( $myAccount->area_id == $i ) selected @endif>{{ $area->area }}</option>
                      <?php $i++ ?>
                      @endforeach

                    </select>
                  </dd>
                </label>
              </div>

              @if ($errors->has('history_id'))
              <div class="alert alert-danger mt-3">
                <ul>

                  <li>{{ $errors->first('history_id') }}</li>

                </ul>
              </div>
              @endif

              <div class="profile-box">
                <label>
                  <dt class="profile-box-ttl">エンジニア歴：</dt>
                  <dd class="profile-box-data">
                    <select class="col-8" id="history" name="history_id">

                      <option value="">選択してください</option>
                      <?php $i = 1; ?>
                      @foreach($histories as $history)
                      <option value="<?php echo $i ?>" @if($myAccount->history_id==$i ) selected @endif>{{ $history->history }}</option>
                      <?php $i++ ?>
                      @endforeach

                    </select>
                  </dd>
                </label>
              </div>

              @if ($errors->has('language_id'))
              <div class="alert alert-danger mt-3">
                <ul>

                  <li>{{ $errors->first('language_id') }}</li>

                </ul>
              </div>
              @endif

              <div class="profile-box">
                <label>
                  <dt class="profile-box-ttl">得意な言語：
                  </dt>
                  <dd class="profile-box-data">
                    <select class="col-8" id="favorite" name="language_id">

                      <option value="">選択してください</option>
                      <?php $i = 1; ?>
                      @foreach($languages as $language)
                      <option value="<?php echo $i ?>" @if($myAccount->language_id==$i ) selected @endif>{{ $language->name }}</option>
                      <?php $i++ ?>
                      @endforeach

                    </select>
                  </dd>
                </label>
              </div>

            </dl><!-- /.profile-body-detail-def -->

            <div class="profile-body-detail-button">
              <input class="btn" type="submit" value="設定完了">
            </div>

          </form>
        </div><!-- /.profile-body-detail -->

      </div><!-- /.inner -->
    </div><!-- /.profile-body -->

  </section><!-- /.profile -->
</div><!-- /.inner -->

@endsection
