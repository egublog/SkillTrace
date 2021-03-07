@extends('layouts.default')

@section('css', '/css/MyService/activity.css')

@section('title', '通知')

@section('content')

<!-- usr, follow, user->area, user->history, user->language,  -->

<div class="inner">
    <section class="activity">
    
        <div class="section-ttl-wrapper">
            <div class="section-ttl">
                <h2>通知</h2>
            </div><!-- /.section-ttl -->
        </div><!-- /.section-ttl-wrapper -->
    
    
        <div class="activity-result">
            <ul class="friends-list">
    
                <!-- followテーブル、userテーブル、 -->
    
                <!-- user_to_id === $myId がある場合 -->
    
    
                @forelse($follower_accounts as $follower_account)
    
                <li class="friends-item">
    
                    <form name="friend" action="{{ action('HomeController@friend_home') }}" method="POST">
                        @csrf
    
                        @if(count($follower_accounts) == 1)
                        <a href="javascript: friend.submit()">
                            @endif
    
                            @if(count($follower_accounts) >= 2)
                            <a href="javascript: friend[{{ $loop->iteration - 1 }}].submit()">
                                @endif
    
    
    
                                <div class="friend-img">
                                    @if($follower_account->user_follower->img == null)
                                    <img src="https://skilltrace-bucket.s3.ap-northeast-1.amazonaws.com/profile_img/no_img.png" alt="各々のトプ画">
                                    @else
                                    <img src="{{ $follower_account->user_follower->img }}" alt="自分のトプ画">
                                    @endif
                                </div><!-- /.friends-result-img -->
    
                                <div class="activity-result-body">
                                    <!-- 名前や年齢などの説明 -->
                                    <div class="activity-result-body-top">
                                        <p class="activity-result-body-message">
                                            <!-- followテーブルのuser_idさん -->
                                            {{ optional($follower_account->user_follower)->name }}さんにフォローされました
                                        </p>
                                        <p class="activity-body-top-time">
                                            <!-- そのレコードが作成された時間（created_time） -->
                                            <span>{{ $follower_account->created_at->format('H:i') }}</span>
                                        </p>
                                    </div><!-- /.activity-result-body-top -->
    
                                    <div class="activity-result-body-bottom">
                                        <dl>
                                            <!-- フォローした人（user_id）の詳細 -->
                                            <dt>年齢：</dt>
                                            <dd>{{ optional($follower_account->user_follower)->age }}</dd>
                                            <dt>住所：</dt>
                                            <dd>{{ optional($follower_account->user_follower)->area->area }}</dd>
                                            <dt>エンジニア歴：</dt>
                                            <dd>{{ optional($follower_account->user_follower)->history->history }}</dd>
                                            <dt>得意な言語：</dt>
                                            <dd>{{ optional($follower_account->user_follower)->language->name }}</dd>
                                        </dl>
                                    </div><!-- /.activity-result-body-bottom -->
    
                                </div><!-- /.friends-body -->
    
                            </a>
    
    
                            <input type="hidden" name="id" value="{{ optional($follower_account->user_follower)->id }}">
    
                    </form>
                </li><!-- /.activity-result-item -->
    
                @empty
    
                <p>見つかりませんでした</p>
    
                @endforelse
    
    
            </ul><!-- /.activity-result-list -->
        </div><!-- /.activity-result -->
    
    </section><!-- /.activity -->
</div><!-- /.inner -->










@endsection