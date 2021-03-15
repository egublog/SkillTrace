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

                                <div class="friend-body">
                                    <!-- 名前や年齢などの説明 -->
                                    <div class="friend-body-top">
                                        <p>{{ optional($follower_account->user_follower)->name }}</p>
                                        <span>さんにフォローされました</span>
                                    </div><!-- /.friend-body-top -->

                                    <div class="friend-body-middle">
                                        <p>年齢：{{ optional($follower_account->user_follower)->age }}</p>
                                        <p>住所：{{ optional($follower_account->user_follower)->area->area }}</p>
                                    </div><!-- /.friend-body-middle -->

                                    <div class="friend-body-bottom">
                                        <p>エンジニア歴：{{ optional($follower_account->user_follower)->history->history }}</p>
                                        <p>得意言語：{{ optional($follower_account->user_follower)->language->name }}</p>
                                    </div><!-- /.friend-body-bottom -->

                                </div><!-- /.friends-body -->

                            </a>

                            <input type="hidden" name="id" value="{{ optional($follower_account->user_follower)->id }}">

                    </form>
                </li><!-- /.friend-item -->

                @empty

                <p>見つかりませんでした</p>

                @endforelse


            </ul><!-- /.activity-result-list -->
        </div><!-- /.activity-result -->

    </section><!-- /.activity -->
</div><!-- /.inner -->










@endsection