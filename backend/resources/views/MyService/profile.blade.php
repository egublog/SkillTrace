@extends('layouts.default')

@section('css', '/css/MyService/profile.css')

@section('title', '自分のプロフィール編集')

@section('content')

<!-- プロフィール編集 -->


<div class="inner">
  <section class="profile">
  
    <div class="profile-top">
      <a class="back" href="{{ action('HomeController@my_home') }}"><span>&lt;</span></a>
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
  
          <!-- もしも何も写真の設定をしていなかったらデフォルトの画像 -->
          <!-- もしもすでに写真の設定をしていたらその画像が出るように -->
  
          @if ($errors->any())
          <div class="alert alert-danger">
            <ul>
              @foreach ($errors->all() as $error)
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
  
          <form action="{{ action('HomeController@profile_img_save') }}" method="post" enctype="multipart/form-data">
            @csrf
            <input type="file" name="profile_img">
            <input class="btn" type="submit" value="登録する">
          </form>
  
        </div><!-- /.profile-body-img -->
  
  
        <div class="profile-body-detail">
          <form action="{{ action('HomeController@profile_save') }}" method="post">
            {{ csrf_field() }}
  
            <p class="profile-body-detail-ttl">プロフィール設定</p>
  
  
            <dl class="profile-body-detail-def">
  
              <div class="profile-box">
                <label>
                  <dt class="profile-box-ttl">名前：</dt>
                  <dd class="profile-box-data">
                    <input class="" id="name" name="name">
                  </dd>
                </label>
              </div>
  
              <div class="profile-box">
                <label>
                  <dt class="profile-box-ttl">年齢：</dt>
                  <dd class="profile-box-data">
                    <input class="" id="age" name="age" type='number'>
                  </dd>
                </label>
              </div>
  
              <div class="profile-box">
                <label>
                  <dt class="profile-box-ttl">住んでいる地域：</dt>
                  <dd class="profile-box-data">
                    <select class="col-8" id="area" name="area_id">
                      <!-- DBとの接続で北海道から沖縄まで選択できるようにする -->
                      <?php $i = 1; ?>
                      @foreach($areas as $area)
                      <option value="<?php echo $i ?>">{{ $area->area }}</option>
                      <?php $i++ ?>
                      @endforeach
                    </select>
                  </dd>
                </label>
              </div>
  
              <div class="profile-box">
                <label>
                  <dt class="profile-box-ttl">エンジニア歴：</dt>
                  <dd class="profile-box-data">
                    <select class="col-8" id="history" name="history_id">
                      <!-- DBとの接続でエンジニア歴がどれくらいか選択できるようにする -->
                      <?php $i = 1; ?>
                      @foreach($histories as $history)
                      <option value="<?php echo $i ?>">{{ $history->history }}</option>
                      <?php $i++ ?>
                      @endforeach
  
                    </select>
                  </dd>
                </label>
              </div>
  
              <div class="profile-box">
                <label>
                  <dt class="profile-box-ttl">得意な言語：
                  </dt>
                  <dd class="profile-box-data">
                    <select class="col-8" id="favorite" name="language_id">
                      <!-- DBとの接続で得意な言語を選択できるようにする -->
                      <?php $i = 1; ?>
                      @foreach($languages as $language)
                      <option value="<?php echo $i ?>">{{ $language->name }}</option>
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